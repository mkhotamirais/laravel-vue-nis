<script setup>
import TitleSection from "@/Components/TitleSection.vue";
import { diffForHumans, smartTrim } from "@/functions";
import MyBg from "@/Components/MyBg.vue";
import { router } from "@inertiajs/vue3";

defineProps({
  infos: Object,
});

const params = route().params;

const searchCategory = (categoryName) => {
  const slugifiedCategory = categoryName
    .trim()
    .replace(/\s+/g, "-")
    .toLowerCase();

  router.get(route("informasi"), {
    category: slugifiedCategory,
    search: params.search,
    tag: params.tag,
  });
};

const selectTag = (tag) => {
  router.get(route("informasi"), {
    user_id: params.user_id,
    search: params.search,
    tag,
  });
};
</script>

<template>
  <section class="py-12">
    <MyBg />
    <div class="container">
      <TitleSection
        beforeTitle="Pusat Informasi"
        title="Seputar Kegiatan dan Prestasi Siswa serta Berita dan Artikel terkait
          Sekolah"
      />
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
        <div
          v-for="(info, i) in infos"
          :key="i"
          class="flex flex-col rounded-md overflow-hidden space-y-4"
        >
          <img
            :src="`/storage/${info.banner}`"
            :alt="smartTrim(info.title, 100)"
            class="h-48 w-full object-cover object-center"
            width="500"
            height="300"
            loading="lazy"
          />
          <Link :href="route('informasi.show', info)" class="hover:underline">
            <h3 class="h3">
              {{ smartTrim(info.title, 50) }}
            </h3>
          </Link>

          <div class="flex gap-2 items-center overflow-x-scroll">
            <button
              @click="searchCategory(info.infocat.name)"
              class="badge min-w-fit"
            >
              {{ info.infocat.name }}
            </button>
            <span class="font-extrabold">·</span>
            <button
              v-for="(tag, i) in info.tags.split(',')"
              :key="i"
              @click="selectTag(tag)"
              class="badge !bg-gray-600 min-w-fit"
            >
              {{ tag }}
            </button>
          </div>

          <p class="mb-2 text-sm text-gray-500">
            {{ diffForHumans(info.created_at) }}
          </p>
        </div>
      </div>
      <Link :href="route('informasi')" class="btn mt-8 block w-fit !py-3 !px-6"
        >Informasi Lainnya</Link
      >
    </div>
  </section>
</template>

<style scoped>
.overflow-x-scroll::-webkit-scrollbar {
  display: none;
}
</style>