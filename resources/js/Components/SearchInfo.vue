<script setup>
import { router, useForm, usePage } from "@inertiajs/vue3";
import { ref } from "vue";

const params = route().params;

const form = useForm({ search: params.search });

const openSearch = ref(false);

const submit = () => {
  const slugifiedSearch = form.search
    ?.trim()
    .replace(/\s+/g, "-")
    .toLowerCase();

  router.get(route("informasi"), {
    search: slugifiedSearch,
  });
};

const hideSearch = () => {
  openSearch.value = false;
};

const toggleSearch = () => {
  openSearch.value = !openSearch.value;
};
</script>

<template>
  <div class="mx-1 sm:relative">
    <div
      @click="hideSearch"
      v-show="openSearch"
      class="layer fixed inset-0 z-40"
    ></div>
    <div class="z-50">
      <button
        @click="toggleSearch"
        class="text-white leading-none h-16 w-8 lg:w-12\"
      >
        <i class="fa-solid fa-magnifying-glass"></i>
      </button>
      <form
        @submit.prevent="submit"
        class="z-50 absolute right-0 left-0 sm:left-auto min-w-64 rounded-md border-3 border-primary bg-white transition-all mt-0 sm:mt-2"
        :class="`${
          openSearch
            ? 'visible opacitiy-100 translate-y-0'
            : 'invisible opacity-0 -translate-y-3'
        }`"
      >
        <input
          type="search"
          class="bg-white w-full py-1 px-2 rounded-md h-full pr-12 text-sm focus:outline-primary"
          v-model="form.search"
          placeholder="Cari informasi.."
        />
        <button
          type="submit"
          class="absolute right-0 bottom-0 top-0 w-10 text-xl text-primary"
        >
          <i class="fa-solid fa-magnifying-glass"></i>
        </button>
      </form>
    </div>
  </div>
</template>