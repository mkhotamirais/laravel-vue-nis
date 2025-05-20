<script setup>
import c from "@/content.json";

defineProps({ user: Object });
</script>

<template>
  <div class="hidden lg:flex">
    <nav class="flex">
      <div v-for="(menu, i) in c.main_menu" :key="i" class="relative group">
        <div class="flex items-center px-2 h-16">
          <Link
            :href="menu.url"
            class="px-2 py-2 text-white hover:text-gray-300 transition-all"
            :as="menu.sub_menu ? 'button' : 'a'"
          >
            {{ menu.label }}
          </Link>
          <span
            v-show="menu.sub_menu"
            class="group-hover:rotate-180 transition-all text-white text-[0.65rem]"
          >
            <i class="fa-solid fa-chevron-down"></i>
          </span>
        </div>
        <div
          v-show="menu.sub_menu"
          class="border border-primary-dark z-50 absolute rounded-md bg-primary min-w-full left-0 opacity-0 invisible translate-y-3 group-hover:opacity-100 group-hover:visible group-hover:translate-y-0 transition-all"
        >
          <div class="flex flex-col p-2">
            <Link
              v-for="(m, j) in menu.sub_menu"
              :key="j"
              :href="m.url"
              class="px-4 py-2 min-w-max w-full text-white hover:bg-primary-dark rounded-lg transition-all"
            >
              {{ m.label }}
            </Link>
          </div>
        </div>
      </div>
    </nav>
  </div>
</template>