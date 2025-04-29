<script setup>
import Logo from "@/Components/Logo.vue";
import NavDesktop from "@/Layouts/NavDesktop.vue";
import NavMobile from "@/Layouts/NavMobile.vue";
import Line from "@/Components/Line.vue";
import NavUser from "@/Layouts/NavUser.vue";
import NavTop from "@/Layouts/NavTop.vue";
import SearchInfo from "@/Components/SearchInfo.vue";

import { usePage } from "@inertiajs/vue3";
import { computed, ref } from "vue";
import { footerMenus1, footerMenus2 } from "../menus";

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
          class="text-secondary hover:underline"
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

    <!-- Footer -->
    <footer class="bg-primary text-white">
      <div
        class="container py-12 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8"
      >
        <!-- 1 -->
        <div class="space-y-3">
          <Logo />
          <blockquote class="!text-white">
            "Lembur ilmu, Majelis disiplin, Kancah ibadah dan Wahana perjuangan"
          </blockquote>
          <address class="text-sm text-white">
            Kp. Bangong Rt 02/01, Desa Pasirpogor, Kec. Sindangkerta, Kab.
            Bandung Barat, Jawa Barat, 40563
          </address>
        </div>
        <!-- 2 -->
        <div>
          <div class="mb-2">
            <h3 class="font-bold text-lg">Tautan</h3>
            <Line thickness="border-1" color="white" class="!pt-1" />
          </div>
          <nav>
            <Link
              v-for="(link, i) in footerMenus1"
              :href="link.url"
              :key="i"
              class="block text-gray-300 hover:text-white py-1 w-fit hover:underline"
              >{{ link.title }}</Link
            >
          </nav>
        </div>
        <!-- 3 -->
        <div>
          <div class="mb-2">
            <h3 class="font-bold text-lg">Tautan Lainnya</h3>
            <Line thickness="border-1" color="white" class="!pt-1" />
          </div>
          <nav>
            <a
              v-for="(link, i) in footerMenus2"
              :href="link.url"
              :key="i"
              class="block text-gray-300 hover:text-white py-1 w-fit hover:underline"
              >{{ link.title }}</a
            >
          </nav>
        </div>
        <!-- 4 -->
        <div>
          <div class="mb-2">
            <h3 class="font-bold text-lg">Jam Operasional</h3>
            <Line thickness="border-1" color="white" class="!pt-1" />
          </div>
          <p class="!text-gray-300">Senin - Sabtu : 07.00 - 15.00</p>
        </div>
      </div>
      <div class="bg-primary-dark">
        <div class="container py-3">
          <p class="!text-white text-sm">
            Copyright &copy; {{ new Date().getFullYear() }} Nurul Iman
          </p>
        </div>
      </div>
    </footer>
  </div>
</template>