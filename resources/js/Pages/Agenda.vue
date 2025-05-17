<script setup>
import SectionHero from "@/Components/SectionHero.vue";
import SessionMsg from "@/Components/SessionMsg.vue";
import CardAgenda from "@/Components/CardAgenda.vue";
import MyBg from "@/Components/MyBg.vue";
import { router, usePage } from "@inertiajs/vue3";
import { computed } from "vue";

defineProps({
  agendas: Object,
  success: String,
});

const deleteAgenda = (a) => {
  if (confirm("Apakah anda yakin ingin menghapus agenda ini?")) {
    router.delete(route("agenda.destroy", a), {
      preserveScroll: true,
    });
  }
};

const page = usePage();
const user = computed(() => page.props.auth.user);
</script>

<template>
  <Head>
    <title>Agenda Rutin dan Event</title>
    <meta
      head-key="description"
      name="description"
      content="Agenda dan pengumuman penting seputar kegiatan sekolah terkini"
    />
  </Head>

  <SectionHero
    title="Pengumuman & Agenda"
    description="Agenda dan pengumuman penting seputar kegiatan sekolah terkini"
  />

  <section class="py-8 overflow-hidden relative">
    <div class="container">
      <MyBg position="left" />
      <!-- Editor -->
      <div v-if="user" class="flex items-center justify-between mb-6">
        <Link :href="route('agenda.create')" class="btn">Tambah</Link>
      </div>

      <SessionMsg :msg="success" />

      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        <div v-for="(a, i) in agendas" :key="i">
          <CardAgenda :a="a">
            <div v-if="user" class="">
              <Link :href="route('agenda.edit', a)" class="link">ubah</Link>
              |
              <button class="link !text-red-500" @click="deleteAgenda(a)">
                hapus
              </button>
            </div>
          </CardAgenda>
        </div>
      </div>
    </div>
  </section>
</template>