<script setup>
import Mybg from "@/Components/Mybg.vue";

defineProps({ heroImages: Object });
</script>

<template>
  <section class="relative overflow-hidden">
    <Mybg position="left" />

    <div class="container py-16">
      <div class="grid grid-cols-1 md:grid-cols-2 gap-6 items-center">
        <div class="space-y-4 py-4">
          <p class="text-xl lg:text-2xl">Selamat Datang di</p>
          <h1 class="">
            <span class="text-3xl lg:text-4xl font-bold"
              >Ponpes, RA, MTs, MA</span
            >
            <br />
            <span
              class="text-primary text-5xl md:text-6xl lg:text-7xl font-extrabold"
              >Nurul Iman Sindangkerta</span
            >
          </h1>
          <p class="text-xl lg:text-2xl font-medium">
            "Lembur ilmu, Majelis disiplin, Kancah ibadah dan Wahana perjuangan
          </p>
          <div class="mt-8 flex flex-col md:flex-row gap-4">
            <Link
              :href="route('ppdb')"
              class="block w-fit py-3 md:py-4 text-lg px-8 rounded-full bg-primary hover:bg-primary-dark transition-all text-white"
            >
              Daftar
            </Link>
            <a
              href="#agenda"
              class="block w-fit py-3 md:py-4 text-lg px-8 rounded-full border border-primary hover:bg-primary hover:text-white transition-all"
              >Agenda</a
            >
          </div>
        </div>
        <div class="" v-if="heroImages && heroImages.length">
          <swiper-container
            slides-per-view="1"
            speed="1000"
            :navigation="false"
            pagination="true"
            class="flex h-full"
            effect="fade"
            loop="true"
            :autoplay="{ delay: 8000, disableOnInteraction: false }"
            lazy="true"
          >
            <swiper-slide
              v-for="(hi, i) in heroImages"
              :key="i"
              class="overflow-hidden p-0 md:p-8"
            >
              <img
                width="400"
                height="300"
                :src="`/storage/${hi.banner}`"
                :alt="
                  hi?.name
                    ? 'Nurul Iman Sindangkerta Hero Image - ' + hi.name
                    : 'Nurul Iman Sindangkerta Hero Image'
                "
                class="object-cover object-center w-full h-80 lg:h-96 rounded-2xl"
                loading="lazy"
              />
            </swiper-slide>
          </swiper-container>
        </div>
      </div>
    </div>
  </section>
</template>