<script setup>
// import Mybg from "@/Components/Mybg.vue";
import { branchs } from "@/menus";

import TitleSection from "@/Components/TitleSection.vue";
</script>

<template>
  <section class="py-12 bg-slate-50">
    <!-- <Mybg /> -->
    <div class="container py-4 grid grid-cols-1 lg:grid-cols-2 gap-8">
      <article class="">
        <TitleSection
          beforeTitle="YP H. Abdul Halim H. Abdul Salam"
          title="Nurul Iman<br/> Sindangkerta"
        />

        <p class="leading-loose">
          Sekolah Nurul Iman menawarkan pendidikan lengkap mulai dari jenjang
          RA, MTS, MA, hingga Pondok Pesantren, dengan fokus utama pada
          pembentukan karakter melalui pengajaran akhlak mulia. Dengan kurikulum
          yang holistik, kami tidak hanya mendidik siswa secara akademis, tetapi
          juga membekali mereka dengan nilai-nilai moral yang akan membimbing
          mereka menjadi pribadi yang berbudi pekerti luhur. Bergabunglah dengan
          kami di Sekolah Nurul Iman, tempat di mana ilmu dan akhlak berjalan
          seiring untuk membentuk generasi penerus yang cerdas dan berakhlak
          mulia.
        </p>
      </article>
      <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
        <div
          v-for="(branch, i) in branchs"
          :key="i"
          class="p-4 rounded-lg h-full bg-white shadow-lg border-l-2 border-primary flex flex-col items-center justify-center"
        >
          <h3 class="text-xl font-bold text-secondary">
            {{ branch.title }}
          </h3>
          <div class="mb-4 text-center">
            <p class="text-6xl !text-primary">{{ branch.total }}</p>
            <p class="font-medium text-lg">Siswa</p>
          </div>
          <Link :href="branch.url" class="btn">Profile {{ branch.title }}</Link>
        </div>
      </div>
    </div>
  </section>
</template>