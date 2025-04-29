
<script setup>
import { ref, watchEffect } from "vue";
import { usePage } from "@inertiajs/vue3";

const logoSrc = ref(
  "/storage/images/logos/logo-yayasan-nurul-iman-sindangkerta.png"
);
const logoAlt = ref("Logo Yayasan Nurul Iman Sindangkerta");
const logoName = ref("default");

const page = usePage();

const setLogoByPath = (path) => {
  if (path.startsWith("/ma")) {
    logoSrc.value = "/storage/images/logos/logo-ma-nurul-iman-sindangkerta.png";
    logoName.value = "MA";
  } else if (path.startsWith("/ponpes")) {
    logoSrc.value =
      "/storage/images/logos/logo-ponpes-nurul-iman-sindangkerta.png";
    logoName.value = "Ponpes";
  } else {
    logoSrc.value =
      "/storage/images/logos/logo-yayasan-nurul-iman-sindangkerta.png";
    logoName.value = "default";
  }
};

watchEffect(() => {
  setLogoByPath(page.url);
});
</script>

<template>
  <a href="/" class="flex items-center gap-3 text-white">
    <img :src="logoSrc" :alt="logoAlt" class="h-10 w-auto object-contain" />
    <div class="flex flex-col text-center *:leading-none gap-[2px]">
      <span class="text-2xl font-bold">Nurul Iman</span>
      <span class="tracking-[3px] text-sm">Sindangkerta</span>
    </div>
  </a>
</template>

