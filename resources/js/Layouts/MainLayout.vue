<script setup>
import Logo from "@/Components/Logo.vue";
import NavDesktop from "@/Layouts/NavDesktop.vue";
import NavMobile from "@/Layouts/NavMobile.vue";
import NavUser from "@/Layouts/NavUser.vue";
import NavTop from "@/Layouts/NavTop.vue";
import SearchInfo from "@/Components/SearchInfo.vue";
import Footers from "@/Layouts/Footers.vue";

import { usePage } from "@inertiajs/vue3";
import { computed, ref } from "vue";

const page = usePage();
const user = computed(() => page.props.auth.user);

const navUser = ref(false);
const navMobile = ref(false);

const openNavUser = () => {
  navUser.value = true;
  navMobile.value = false;
};

const openNavMobile = () => {
  navMobile.value = true;
  navUser.value = false;
};

const closeBothNav = () => {
  navUser.value = navUser.value === true ? false : null;
  navMobile.value = navMobile.value === true ? false : null;
};
</script>

<template>
  <Head>
    <title>Home</title>
    <meta
      head-key="description"
      name="description"
      content="Nurul Iman Lembur ilmu, Majelis disiplin, Kancah ibadah dan Wahana perjuangan"
    />
  </Head>

  <div class="flex flex-col min-h-screen">
    <article v-if="user" class="bg-primary text-white text-center">
      <div class="container">
        Untuk para admin, apabila ada kendala teknis atau ada masukan untuk
        website ini, silahkan hubungi kontak dibawah <br />
        <a
          href="https://wa.me/6287766606133"
          class="text-gray-300 hover:underline"
          >Mkhotami Rais : 087766606133</a
        >
      </div>
    </article>

    <NavTop />

    <!-- Header -->
    <header
      class="h-16 bg-primary border-b border-primary-dark sticky top-0 z-40"
    >
      <div class="container flex items-center justify-between">
        <Logo />
        <div class="flex items-center">
          <NavDesktop :user="user" />
          <SearchInfo />
          <NavUser
            :user="user"
            :navUser="navUser"
            :openNavUser="openNavUser"
            :closeBothNav="closeBothNav"
          />
          <NavMobile
            :navMobile="navMobile"
            :openNavMobile="openNavMobile"
            :closeBothNav="closeBothNav"
          />
        </div>
      </div>
    </header>

    <!-- Main -->
    <main class="flex-1 relative">
      <slot></slot>
    </main>

    <!-- footer -->
    <Footers />
  </div>
</template>