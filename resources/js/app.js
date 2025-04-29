import "./bootstrap";
import "../css/app.css";

import { createApp, h } from "vue";
import { createInertiaApp, Head, Link } from "@inertiajs/vue3";
import { ZiggyVue } from "../../vendor/tightenco/ziggy";
import MainLayout from "./Layouts/MainLayout.vue";
import { register } from "swiper/element/bundle";

createInertiaApp({
    title: (title) => `Nurul Iman${title ? ` - ${title}` : ""}`,
    resolve: (name) => {
        const pages = import.meta.glob("./Pages/**/*.vue", { eager: true });
        let page = pages[`./Pages/${name}.vue`];
        page.default.layout = page.default.layout || MainLayout;
        return page;
    },
    setup({ el, App, props, plugin }) {
        createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue)
            .component("Head", Head)
            .component("Link", Link)
            .mount(el);
    },
    progress: {
        // delay: 250,
        delay: 100,
        // color: "#29d",
        color: "#84cc16",
        // includeCSS: true,
        // includeCSS: false,
        showSpinner: false,
    },
});

register();
