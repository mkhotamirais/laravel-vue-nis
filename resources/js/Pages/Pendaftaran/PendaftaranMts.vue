<script setup>
import SectionHero from "@/Components/SectionHero.vue";
import cl from "@/content_long.json";
import c from "@/content.json";
</script>

<template>
  <Head>
    <title>SPMB MTs</title>
    <meta
      head-key="description"
      name="description"
      content="Sistem Penerimaan Murid Baru Madrasah Tsanawiyah Nurul Iman Sindangkerta"
    />
  </Head>

  <SectionHero
    :title="cl.ppdb_mts.title"
    :description="cl.ppdb_mts.description"
  />

  <section class="py-12 leading-7 relative overflow-hidden">
    <MyBg position="left" />
    <div class="container">
      <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        <article class="space-y-4">
          <div class="flex">
            <a :href="c.daftar_url_long" class="btn">Daftar</a>
          </div>
          <div v-for="(item, i) in cl.ppdb_mts.content" :key="i">
            <h3 class="h3">{{ item.title }}</h3>
            <p class="">{{ item.description }}</p>
            <ul v-if="item.list" class="list-disc list-inside text-slate-600">
              <li v-for="(l, j) in item.list" :key="j" v-html="l"></li>
            </ul>
          </div>
        </article>
        <div class="bg-gray-50 h-full">
          <a
            v-for="(item, i) in cl.ppdb_mts.images"
            :key="i"
            :href="item.src"
            class="mb-4 block"
          >
            <img
              :src="item.src"
              :alt="item.alt"
              loading="lazy"
              width="500"
              height="500"
              class="object-contain object-center rounded-lg mx-auto"
            />
          </a>
        </div>
      </div>
    </div>
  </section>
</template>