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

  <section class="py-8 relative">
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
        <div v-for="(ec, i) in extracurriculars.data" :key="i" class="">
          <div
            class="relative grid grid-cols-1 sm:grid-cols-3 gap-x-0 md:gap-x-4 mb-6 bg-white rounded-lg overflow-hidden shadow-md"
          >
            <div
              v-if="
                (user && user.role == ec.user?.role) ||
                (user && user.role == 'admin')
              "
              class="mb-4 absolute right-0 top-0"
            >
              <Link :href="route('ekstrakurikuler.edit', ec)" class="link"
                >ubah</Link
              >
              |
              <button class="link !text-red-500" @click="deleteEkskul(ec)">
                hapus
              </button>
            </div>

            <div>
              <img
                :src="`/storage/${ec.banner}`"
                alt=""
                class="h-full w-full object-cover object-center"
              />
            </div>
            <article class="col-span-2 space-y-2 rounded-lg p-4">
              <h2 class="h2 mb-2">{{ ec.name }}</h2>
              <div class="badge">{{ categoryRole(ec.user.role) }}</div>
              <h3 class="h3">
                Pembimbing : <span class="text-gray-600">{{ ec.mentor }}</span>
              </h3>
              <h3 class="h3">
                Jadwal : <span class="text-gray-600">{{ ec.schedule }}</span>
              </h3>
              <div>
                <h3 class="h3">Deskripsi :</h3>
                <p>{{ ec.description }}</p>
              </div>
            </article>
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