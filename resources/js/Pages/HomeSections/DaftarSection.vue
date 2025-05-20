<script setup>
import c from "@/content.json";
</script>

<template>
  <section class="py-12 bg-primary">
    <div class="container flex flex-col justify-center items-center gap-6">
      <h2
        class="text-3xl md:text-4xl text-white text-center max-w-xl font-bold"
      >
        Nurul Iman tempat orang baik dan orang-orang yang ingin menjadi baik
      </h2>
      <a
        :href="c.daftar_url_long"
        class="py-4 px-8 text-lg bg-white hover:bg-white/90 text-primary block w-fit rounded-full"
        >Daftar Sekarang</a
      >
    </div>
  </section>
</template>