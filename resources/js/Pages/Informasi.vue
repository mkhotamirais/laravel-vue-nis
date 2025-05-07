<script setup>
import SectionHero from "@/Components/SectionHero.vue";
import Input from "@/Components/Input.vue";
import PaginationInput from "@/Components/PaginationInput.vue";
import SessionMsg from "@/Components/SessionMsg.vue";
import Line from "@/Components/Line.vue";
import MyBg from "@/Components/MyBg.vue";
import { diffForHumans, smartTrim } from "../functions";
import { computed } from "vue";
import { router, usePage } from "@inertiajs/vue3";

defineProps({
  infos: Object,
  infocats: Object,
  infocatsMa: Object,
  infocatsMts: Object,
  infocatsRa: Object,
  infocatsPonpes: Object,
  success: String,
});

const page = usePage();
const user = computed(() => page.props.auth.user);

const params = route().params;

const deleteInfo = (info) => {
  if (confirm("Apakah kamu yakin?")) {
    router.delete(route("informasi.destroy", info));
  }
};

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
  <Head>
    <title>Informasi</title>
    <meta
      head-key="description"
      name="description"
      content="Seputar Kegiatan dan Prestasi Siswa serta Berita dan Artikel terkait Sekolah"
    />
  </Head>

  <SectionHero
    title="Informasi"
    description="Seputar Kegiatan dan Prestasi Siswa serta Berita dan Artikel terkait Sekolah"
  />

  <section class="py-8 relative overflow-hidden lg:overflow-visible">
    <MyBg position="left" />
    <div class="container">
      <!-- Editor -->
      <div v-if="user" class="flex items-center justify-between mb-6">
        <Link :href="route('informasi.create')" class="btn">Tambah</Link>
      </div>

      <SessionMsg :msg="success" />

      <div
        class="relative flex flex-col lg:flex-row gap-12 py-8 place-items-start"
      >
        <div class="w-full">
          <p
            v-if="params.search || params.category || params.tag"
            class="text-2xl font-semibold mb-8"
          >
            <span> Hasil untuk </span>
            <span v-if="params.search">
              pencarian
              <i class="text-primary"
                >"{{ params.search.replace(/-/g, " ") }}"</i
              >
            </span>
            <span v-if="params.category">
              kategori
              <i class="text-primary">
                {{ params.category }}
              </i>
            </span>
            <span v-if="params.tag">
              tag
              <i class="text-primary">
                {{ params.tag }}
              </i>
            </span>
            <br />
            <Link :href="route('informasi')" class="link !font-extrabold"
              >Setel Ulang</Link
            >
          </p>
          <div v-if="infos.data.length">
            <div
              v-for="(info, i) in infos.data"
              :key="i"
              class="relative h-full md:h-56 rounded overflow-hidden md:grid md:grid-cols-3 mb-6 gap-6"
            >
              <Link
                :href="route('informasi.show', info)"
                class="block md:col-span-1"
              >
                <img
                  :src="
                    info.banner
                      ? 'storage/' + info.banner
                      : 'storage/images/logos/logo-yayasan-nurul-iman-sindangkerta.png'
                  "
                  :alt="info.title"
                  width="500"
                  height="300"
                  loading="lazy"
                  :class="`object-cover h-56 md:h-full w-full bg-gray-100 mb-4`"
                />
              </Link>

              <article
                class="md:col-span-2 relative flex flex-col h-full md:h-56 space-y-2"
              >
                <Link
                  :href="route('informasi.show', info)"
                  class="hover:underline w-fit"
                >
                  <h3 class="h3 first-letter:uppercase">
                    {{ smartTrim(info.title, 50) }}
                  </h3>
                </Link>

                <div class="flex gap-x-2 gap-y-1 items-center flex-wrap">
                  <button
                    v-if="info.infocat"
                    @click="searchCategory(info.infocat.name)"
                    class="badge"
                  >
                    {{ info.infocat.name }}
                  </button>
                  <div v-else class="badge">uncategorized</div>
                  <span class="font-extrabold">·</span>
                  <button
                    v-for="(tag, i) in info.tags.split(',')"
                    :key="i"
                    @click="selectTag(tag)"
                    class="badge !bg-gray-600"
                  >
                    {{ tag }}
                  </button>
                </div>
                <p
                  class="text-gray-700 flex-1"
                  v-html="smartTrim(info.content, 250)"
                ></p>
                <p class="mt-auto text-sm text-gray-500">
                  {{ diffForHumans(info.created_at) }}
                </p>
              </article>
              <!-- Editor -->
              <div v-if="user" class="absolute right-0 bottom-0">
                <Link :href="route('informasi.edit', info)" class="link"
                  >ubah</Link
                >
                |
                <button class="link !text-red-500" @click="deleteInfo(info)">
                  hapus
                </button>
              </div>
            </div>
          </div>
          <div v-else class="text-xl">
            <i>Hasil tidak ditemukan</i>
          </div>
          <PaginationInput :paginator="infos" />
        </div>
        <div class="w-full lg:w-64 sticky top-24">
          <div class="">
            <h2 class="font-bold text-2xl text-primary">Kategori</h2>
            <Line />
            <!-- <button
            v-for="(ic, i) in infocats"
            @click="searchCategory(ic.name)"
            :key="i"
            class="first-letter:uppercase text-gray-600 py-1 hover:underline hover:text-primary block text-left"
          >
            {{ ic.name }}
          </button> -->

            <!-- Info MA -->
            <h3 class="h3-left first-letter:uppercase">Informasi MA</h3>
            <button
              v-for="(ic, i) in infocatsMa"
              @click="searchCategory(ic.name)"
              :key="i"
              class="first-letter:uppercase text-gray-600 py-1 hover:underline hover:text-primary block text-left"
            >
              {{ ic.name }}
              <span class="text-primary">({{ ic.infos_count }})</span>
            </button>

            <!-- Info Mts -->
            <h3 class="h3-left">Informasi MTs</h3>
            <button
              v-for="(ic, i) in infocatsMts"
              @click="searchCategory(ic.name)"
              :key="i"
              class="first-letter:uppercase text-gray-600 py-1 hover:underline hover:text-primary block text-left"
            >
              {{ ic.name }}
              <span class="text-primary">({{ ic.infos_count }})</span>
            </button>

            <!-- Info RA -->
            <h3 class="h3-left">Informasi RA</h3>
            <button
              v-for="(ic, i) in infocatsRa"
              @click="searchCategory(ic.name)"
              :key="i"
              class="first-letter:uppercase text-gray-600 py-1 hover:underline hover:text-primary block text-left"
            >
              {{ ic.name }}
              <span class="text-primary">({{ ic.infos_count }})</span>
            </button>

            <!-- Info Ponpes -->
            <h2 class="h3-left">Informasi Ponpes</h2>
            <button
              v-for="(ic, i) in infocatsPonpes"
              @click="searchCategory(ic.name)"
              :key="i"
              class="first-letter:uppercase text-gray-600 py-1 hover:underline hover:text-primary block text-left"
            >
              {{ ic.name }}
              <span class="text-primary">({{ ic.infos_count }})</span>
            </button>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>