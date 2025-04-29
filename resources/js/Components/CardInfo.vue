<script setup>
import { router } from "@inertiajs/vue3";
import { diffForHumans } from "../functions";

defineProps({
  info: Object,
});

const deleteInfo = (info) => {
  if (confirm("Apakah kamu yakin?")) {
    router.delete(route("information.destroy", info));
  }
};
</script>

<template>
  <div
    class="relative h-full md:h-60 rounded overflow-hidden md:flex md:flex-row sm:gap-6 mb-6"
  >
    <img
      :src="
        info.banner
          ? 'storage/' + info.banner
          : 'storage/images/logos/logo-yayasan-nurul-iman-sindangkerta.png'
      "
      alt="{{ info->title }}"
      loading="lazy"
      :class="`object-cover h-full w-full sm:w-56 bg-gray-100`"
    />

    <article class="relative w-full flex flex-col h-full space-y-2">
      <a href="" class="hover:underline w-fit">
        <h3 class="text-lg font-semibold first-letter:capitalize mt-4 sm:mt-0">
          {{ info.title.substring(0, 60) }}
          {{ info.title.length > 60 ? "..." : "" }}
        </h3>
      </a>

      <p class="mb-2 text-sm text-gray-500">
        {{ diffForHumans(info.created_at) }}
      </p>
      <div class="flex gap-2 items-center">
        <div class="badge">
          {{ info.infocat.name }}
        </div>
        <span class="font-extrabold">·</span>
        <div
          v-for="(tag, i) in info.tags.split(',')"
          :key="i"
          class="badge !bg-gray-600"
        >
          {{ tag }}
        </div>
      </div>
      <p class="text-gray-700 flex-1">
        {{ info.content.substring(0, 210) }}
        {{ info.content.length > 210 ? "..." : "" }}
      </p>
      <Link href="/" class="btn inline-block w-fit mt-2">Selengkapnya</Link>
    </article>
    <div class="absolute right-0 bottom-0">
      <Link :href="route('information.edit', info)" class="link">ubah</Link> |
      <button class="link !text-red-500" @click="deleteInfo(info)">
        hapus
      </button>
    </div>
  </div>
</template>