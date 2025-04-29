<script setup>
import TitleSection from "@/Components/TitleSection.vue";
import MyBg from "@/Components/MyBg.vue";

defineProps({
  facilities: Object,
});
</script>

<template>
  <section class="py-12 relative overflow-hidden">
    <MyBg position="left" />
    <div class="container">
      <TitleSection
        beforeTitle="Galeri & Fasilitas"
        title="Galeri Kegiatan Siswa dan Fasilitas dalam Nuansa Islami"
      />
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        <div v-for="(f, i) in facilities" :key="i">
          <img
            :src="`/storage/${f.banner}`"
            alt=""
            loading="lazy"
            class="rounded-lg h-56 lg:h-64 w-full object-cover object-center"
          />
        </div>
      </div>
      <Link :href="route('fasilitas')" class="btn mt-8 block w-fit !py-3 !px-6"
        >Fasilitas Lainnya</Link
      >
    </div>
  </section>
</template>