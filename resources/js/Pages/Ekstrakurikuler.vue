<script setup>
import SectionHero from "@/Components/SectionHero.vue";
import SessionMsg from "@/Components/SessionMsg.vue";
import PaginationInput from "@/Components/PaginationInput.vue";
import MyBg from "@/Components/MyBg.vue";
import { router, usePage } from "@inertiajs/vue3";
import { computed } from "vue";

defineProps({
  success: String,
  extracurriculars: Object,
  category: String,
});

const page = usePage();
const user = computed(() => page.props.auth.user);

const categoryRole = (role) => {
  if (role == "editor_ma") {
    return "Ekskul MA";
  } else if (role == "editor_mts") {
    return "Ekskul MTS";
  } else if (role == "editor_ponpes") {
    return "Ekskul Ponpes";
  }
};

const searchCategory = (c) => {
  if (c == "Semua") {
    router.get(route("ekstrakurikuler"));
  } else {
    router.get(route("ekstrakurikuler"), { category: c });
  }
};

const deleteEkskul = (ec) => {
  if (confirm("Apakah kamu yakin?")) {
    router.delete(route("ekstrakurikuler.destroy", ec));
  }
};
</script>

<template>
  <Head>
    <title>Ekstrakurikuler</title>
    <meta
      head-key="description"
      name="description"
      content="Daftar Ekstrakurikuler di Nurul Iman Sindangkerta"
    />
  </Head>

  <SectionHero
    title="Ekstrakurikuler"
    description="Daftar Ekstrakurikuler di Nurul Iman Sindangkerta"
  />

  <section class="py-8 relative overflow-hidden">
    <MyBg position="left" />
    <div class="container">
      <!-- Editor -->
      <div v-if="user" class="flex items-center justify-between mb-6">
        <Link :href="route('ekstrakurikuler.create')" class="btn">Tambah</Link>
      </div>

      <SessionMsg :msg="success" />

      <div class="flex gap-2 mb-4">
        <button
          v-for="(c, i) in ['Semua', 'MA', 'MTs', 'Ponpes']"
          :key="i"
          class="btn"
          :class="category == c ? '!bg-primary-dark' : ''"
          @click="searchCategory(c)"
        >
          {{ c }}
        </button>
      </div>
      <div v-if="extracurriculars.data.length">
        <div class="">
          <div v-for="(ec, i) in extracurriculars.data" :key="i" class="">
            <div class="relative space-y-3 h-full mb-6">
              <h2 class="h2 mb-2">{{ ec.name }}</h2>
              <div class="badge">{{ categoryRole(ec.user.role) }}</div>
              <img
                :src="
                  ec.banner
                    ? `/storage/${ec.banner}`
                    : '/storage/images/logos/logo-yayasan-nurul-iman-sindangkerta.png'
                "
                :alt="ec.name"
                class="object-cover object-center rounded-lg bg-gray-100 sm:float-left w-full sm:w-96 h-60 mr-4 mb-4"
                loading="lazy"
              />

              <h3 class="h3">Pembimbing</h3>
              <p class="first-letter:uppercase">{{ ec.mentor }}</p>
              <h3 class="h3">Jadwal</h3>
              <p>{{ ec.schedule }}</p>
              <div>
                <h3 class="h3">Deskripsi</h3>

                <article v-html="ec.description" class="text-content"></article>
              </div>
              <div
                v-if="
                  (user && user.role == ec.user?.role) ||
                  (user && user.role == 'admin')
                "
                class=""
              >
                <Link :href="route('ekstrakurikuler.edit', ec)" class="link"
                  >ubah</Link
                >
                |
                <button class="link !text-red-500" @click="deleteEkskul(ec)">
                  hapus
                </button>
              </div>
            </div>
          </div>
        </div>

        <div>
          <PaginationInput :paginator="extracurriculars" />
        </div>
      </div>
      <div v-else>Ekstrakurikuler tidak ditemukan</div>
    </div>
  </section>
</template>