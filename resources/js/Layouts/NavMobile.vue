<script setup>
import Logo from "@/Components/Logo.vue";
import Line from "@/Components/Line.vue";

import c from "@/content.json";
import { ref } from "vue";

defineProps({
  navMobile: Boolean,
  openNavMobile: Function,
  closeBothNav: Function,
});

const showSubMenu = ref(null);

const openSubMenu = (index) => {
  showSubMenu.value = showSubMenu.value === index ? null : index;
};
</script>

<template>
  <div class="flex lg:hidden">
    <button
      @click="openNavMobile"
      class="px-3 py-1 text-white hover:bg-primary-dark rounded-lg text-xl"
      aria-label="Buka menu"
    >
      <i class="fa-solid fa-bars"></i>
    </button>
    <div
      @click="closeBothNav"
      :class="navMobile ? 'visible opacity-100' : 'invisible opacity-0'"
      class="fixed inset-0 bg-black/20 !z-50 transition-all"
    >
      <div
        @click="(e) => e.stopPropagation()"
        class="absolute h-full w-80 bg-primary transition-all"
        :class="navMobile ? 'translate-x-0' : '-translate-x-full'"
      >
        <div class="p-4">
          <div class="flex items-center justify-between gap-2">
            <Logo />
            <button
              @click="closeBothNav"
              class="text-xl text-white px-3 py-1 hover:bg-primary-dark rounded-lg"
            >
              <i class="fa-solid fa-xmark"></i>
            </button>
          </div>
          <Line color="border-white" class="py-4" />
          <nav class="flex flex-col gap-1">
            <div
              v-for="(menu, i) in c.main_menu"
              :key="i"
              class="relative group"
            >
              <div
                @click="openSubMenu(i)"
                class="btn flex items-center justify-between w-full"
              >
                <Link @click="closeBothNav" :href="menu.url" class="w-full">
                  {{ menu.label }}
                </Link>
                <span
                  v-show="menu.sub_menu"
                  class="group-hover:rotate-180 transition-all text-xs"
                >
                  <i class="fa-solid fa-chevron-down"></i>
                </span>
              </div>
              <div
                v-if="menu.sub_menu && showSubMenu === i"
                class="pl-4 flex flex-col"
              >
                <Link
                  @click="closeBothNav"
                  v-for="(m, j) in menu.sub_menu"
                  :key="j"
                  :href="m.url"
                  class="btn"
                  >{{ m.label }}</Link
                >
              </div>
            </div>
          </nav>
        </div>
      </div>
    </div>
  </div>
</template>