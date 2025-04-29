<script setup>
import TitleSection from "@/Components/TitleSection.vue";
import CardAgenda from "@/Components/CardAgenda.vue";
import MyBg from "@/Components/MyBg.vue";

defineProps({
  agendas: Object,
});
</script>

<template>
  <section id="agenda" class="py-12 scroll-mt-16 relative overflow-hidden">
    <MyBg />
    <div class="container">
      <TitleSection
        beforeTitle="Pengumuman & Agenda"
        title="Informasi agenda dan pengumuman penting seputar kegiatan sekolah terkini"
      />
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        <div v-for="(a, i) in agendas" :key="i">
          <CardAgenda :a="a" />
        </div>
      </div>
      <Link :href="route('agenda')" class="btn mt-8 block w-fit !py-3 !px-6"
        >Agenda Lainnya</Link
      >
    </div>
  </section>
</template>