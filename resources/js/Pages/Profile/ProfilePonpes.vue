<script setup>
import SectionHero from "@/Components/SectionHero.vue";
import MyBg from "@/Components/MyBg.vue";
import cl from "@/content_long.json";
</script>

<template>
  <Head>
    <title>Profil Raudhatul Athfal</title>
    <meta
      head-key="description"
      name="description"
      content="Profile Raudhatul Athfal Nurul Iman Sindangkerta"
    />
  </Head>
  <SectionHero
    :title="cl.profil_ponpes.title"
    :description="cl.profil_ponpes.description"
  />

  <section class="py-12 relative overflow-hidden">
    <MyBg position="left" />
    <div class="container">
      <!-- Sambutan -->
      <div class="flex flex-col lg:flex-row gap-8">
        <div class="mb-8 max-w-2xl">
          <div class="mb-4">
            <h2 class="h2">{{ cl.profil_ponpes.sambutan.title }}</h2>
            <h3 class="h3">{{ cl.profil_ponpes.sambutan.head_master.name }}</h3>
          </div>
          <article class="leading-relaxed space-y-2">
            <p>
              <i> Assalamualaikum Warahmatullahi Wabarakatuh </i>
            </p>
            <img
              :src="cl.profil_ponpes.sambutan.head_master.src"
              :alt="cl.profil_ponpes.sambutan.head_master.alt"
              height="200"
              width="150"
              loading="lazy"
              class="float-left w-40 lg:w-56 mr-4 mb-4"
            />
            <p v-for="(p, i) in cl.profil_ra.sambutan.paragraph" :key="i">
              {{ p }}
            </p>
            <p>
              <i>
                Wallahul muwaffiq ila aqwamit tharieq, Wssalamualaikum
                Warahmatullahi Wabarakatuh
              </i>
            </p>
          </article>
        </div>
        <div class="mb-8 space-y-4">
          <!-- youtube -->
        </div>
      </div>

      <!-- Visi, Misi dan Tujuan -->
      <div class="mb-8 max-w-2xl">
        <div class="mb-4">
          <h2 class="h2">{{ cl.profil_ponpes.visi_misi.title }}</h2>
        </div>
        <article class="leading-relaxed space-y-2">
          <!-- Visi -->
          <div class="">
            <h3 class="h3">Visi</h3>
            <p class="ml-6">"{{ cl.profil_ponpes.visi_misi.visi }}"</p>
          </div>
          <!-- Misi -->
          <div>
            <h3 class="h3">Misi</h3>
            <ul class="list-disc list-inside text-gray-600 pl-6">
              <li v-for="(m, i) in cl.profil_ponpes.visi_misi.misi" :key="i">
                {{ m }}
              </li>
            </ul>
          </div>
        </article>
      </div>
      <!-- Sejarah -->
      <div class="mb-8 max-w-2xl">
        <div class="mb-4">
          <h2 class="h2">Sejarah Ponpes Nurul Iman</h2>
        </div>

        <article class="leading-relaxed space-y-2">
          <p v-for="(p, i) in cl.profil_ponpes.sejarah" :key="i">{{ p }}</p>
        </article>
      </div>
    </div>
  </section>
</template>