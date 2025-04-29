<script setup>
import SectionHero from "@/Components/SectionHero.vue";
import SessionMsg from "@/Components/SessionMsg.vue";
import MyBg from "@/Components/MyBg.vue";
import PaginationInput from "@/Components/PaginationInput.vue";
import { router, usePage } from "@inertiajs/vue3";
import { computed } from "vue";

defineProps({
  facilities: Object,
  success: String,
});

const deleteFacility = (facility) => {
  if (confirm("Apakah kamu yakin?")) {
    router.delete(route("fasilitas.destroy", facility));
  }
};

const page = usePage();
const user = computed(() => page.props.auth.user);
</script>

<template>
  <Head>
    <title>Fasilitas</title>
    <meta
      head-key="description"
      name="description"
      content="Galeri Kegiatan Siswa dan Fasilitas dalam Nuansa Islami"
    />
  </Head>

  <SectionHero
    title="Fasilitas"
    description="Galeri Kegiatan Siswa dan Fasilitas dalam Nuansa Islami"
  />

  <section class="container py-8 relative">
    <!-- Editor -->
    <div v-if="user" class="flex items-center justify-between mb-6">
      <Link :href="route('fasilitas.create')" class="btn">Tambah</Link>
    </div>

    <SessionMsg :msg="success" />

    <div v-if="facilities.data.length" class="">
      <div v-for="(f, i) in facilities.data" :key="i" class="mb-8">
        <MyBg :position="i % 2 === 0 ? 'left' : 'right'" />
        <div class="mb-4 border-l-2 border-primary pl-4 space-y-1">
          <h3 class="h3 first-letter:uppercase">{{ f.name }}</h3>
          <div class="badge">{{ f.facilitycat.name }}</div>
          <p>{{ f.caption }}</p>
        </div>
        <div v-if="user" class="mb-4">
          <Link :href="route('fasilitas.edit', f)" class="link">ubah</Link>
          |
          <button class="link !text-red-500" @click="deleteFacility(f)">
            hapus
          </button>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-x-0 sm:gap-x-4 gap-y-4">
          <div class="w-full">
            <img
              :src="`/storage/${f.banner}`"
              :alt="f.name"
              class="rounded-md object-center object-cover"
              loading="lazy"
            />
          </div>
          <div class="col-span-2 grid grid-cols-2 lg:grid-cols-3 gap-2">
            <div v-for="(fi, j) in f.facilityimages" :key="j">
              <img
                :src="`/storage/${fi.image}`"
                alt=""
                loading="lazy"
                class="rounded-md h-64 object-cover object-center"
              />
            </div>
          </div>
        </div>
      </div>
      <div>
        <PaginationInput :paginator="facilities" />
      </div>
    </div>
    <div v-else>Fasilitas tidak ditemukan</div>
  </section>
</template>