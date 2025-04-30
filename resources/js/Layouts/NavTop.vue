<script setup>
import { logos } from "../menus";
</script>

<template>
  <!-- Top Header -->
  <section class="h-auto py-3 md:py-0 md:h-10 bg-white">
    <div
      class="container flex gap-4 flex-col md:flex-row items-center justify-between"
    >
      <div class="flex flex-col md:flex-row items-center">
        <div class="flex items-center">
          <img
            v-for="(logo, i) in logos"
            :key="i"
            :src="logo.src"
            :alt="logo.alt"
            width="50"
            height="50"
            class="h-6 w-auto object-contain mr-3"
          />
        </div>
        <p class="font-semibold tetx-lg md:text-sm">
          YP H. Abdul Halim H Abdul Salam
        </p>
      </div>
      <div
        class="flex flex-col md:flex-row items-center gap-0 md:gap-6 *:text-primary"
      >
        <div class="order-2 md:order-1">
          <a href="https://mailto:nuruliman@gmail.com" class=""
            >nuruliman@gmail.com</a
          >
        </div>
        <div class="flex order-1 md:order-2">
          <a href="#" aria-label="Kunjungi Facebook" class="p-2 px-3">
            <i class="fa-brands fa-facebook"></i>
          </a>
          <a href="#" aria-label="Kunjungi Instagram" class="p-2 px-3">
            <i class="fa-brands fa-instagram"></i>
          </a>
          <a href="#" aria-label="Kunjungi Twitter" class="p-2 px-3">
            <i class="fa-brands fa-twitter"></i>
          </a>
        </div>
      </div>
    </div>
  </section>
</template>