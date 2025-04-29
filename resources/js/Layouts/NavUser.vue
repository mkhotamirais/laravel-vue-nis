<script setup>
import { userMenus } from "../menus";

defineProps({
  user: Object,
  navUser: Boolean,
  openNavUser: Function,
  closeBothNav: Function,
});
</script>

<template>
  <div v-if="user" class="mx-1">
    <button
      @click="openNavUser"
      class="size-10 rounded-full bg-primary-dark text-white"
    >
      <i class="fa-solid fa-user"></i>
    </button>
    <div
      @click="closeBothNav"
      class="fixed inset-0 bg-black/20 !z-50 transition-all"
      :class="navUser ? 'visible opacity-100' : 'invisible opacity-0'"
    >
      <div
        @click="(e) => e.stopPropagation()"
        class="absolute h-full right-0 w-80 bg-primary transition-all text-white"
        :class="navUser ? 'translate-x-0' : 'translate-x-full'"
      >
        <div class="p-3 flex flex-col">
          <div class="flex items-center justify-between">
            <div class="flex items-center gap-3">
              <div
                class="uppercase size-10 rounded-full bg-primary-dark flex items-center justify-center"
              >
                {{ user.name[0] }}
              </div>
              <span class="!text-white capitalize font-semibold">{{
                user.name
              }}</span>
            </div>
            <button
              @click="closeBothNav"
              class="px-3 py-1 rounded-lg hover:bg-primary-dark"
            >
              <i class="fa-solid fa-xmark"></i>
            </button>
          </div>
          <div class="mt-4">
            <Link
              v-for="(menu, i) in userMenus"
              :href="menu.url"
              :key="i"
              class="btn block w-full text-left"
              @click="closeBothNav"
            >
              <i :class="`fa-solid fa-${menu.icon} mr-2`"></i>
              {{ menu.title }}
            </Link>
            <Link
              @click="closeBothNav"
              :href="route('logout')"
              method="post"
              as="button"
              class="btn block w-full text-left"
            >
              <i class="fa-solid fa-right-from-bracket mr-2"></i>
              Logout
            </Link>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>