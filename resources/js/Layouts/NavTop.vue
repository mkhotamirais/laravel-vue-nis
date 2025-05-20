<script setup>
import c from "@/content.json";
</script>

<template>
  <!-- Top Header -->
  <section class="h-auto py-3 md:py-0 md:h-10 bg-white">
    <div
      class="container flex gap-3 flex-col md:flex-row items-center justify-between"
    >
      <div class="flex items-center">
        <img
          v-for="(logo, i) in c.logos"
          :key="i"
          :src="logo.src"
          :alt="logo.alt"
          width="50"
          height="50"
          class="h-6 w-auto object-contain mr-3"
        />
      </div>
      <p class="font-semibold !text-primary">YP H. Abdul Halim H Abdul Salam</p>
    </div>
  </section>
</template>