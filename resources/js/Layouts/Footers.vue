<script setup>
import Logo from "@/Components/Logo.vue";
import Line from "@/Components/Line.vue";
import c from "@/content.json";
</script>

<template>
  <!-- Footer -->
  <footer class="bg-primary text-white">
    <div
      class="container py-12 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8"
    >
      <!-- 1 -->
      <div class="space-y-3">
        <Logo />
        <blockquote class="!text-white">"{{ c.slogan }}"</blockquote>
        <address class="text-sm text-white">
          {{ c.address }}
        </address>
      </div>
      <!-- 2 -->
      <div>
        <div class="mb-2">
          <h3 class="font-bold text-lg">Tautan</h3>
          <Line thickness="border-1" color="white" class="!pt-1" />
        </div>
        <nav>
          <Link
            v-for="(link, i) in c.footer_menu_1"
            :href="link.url"
            :key="i"
            class="capitalize block text-gray-300 hover:text-white py-1 w-fit hover:underline"
            >{{ link.label }}</Link
          >
        </nav>
      </div>
      <!-- 3 -->
      <div>
        <div class="mb-2">
          <h3 class="font-bold text-lg">Tautan Lainnya</h3>
          <Line thickness="border-1" color="white" class="!pt-1" />
        </div>
        <nav>
          <a
            v-for="(link, i) in c.footer_menu_2"
            :href="link.url"
            :key="i"
            class="capialize block text-gray-300 hover:text-white py-1 w-fit hover:underline"
            >{{ link.label }}</a
          >
        </nav>
      </div>
      <!-- 4 -->
      <div>
        <div class="mb-2">
          <h3 class="font-bold text-lg">Jam Operasional</h3>
          <Line thickness="border-1" color="white" class="!pt-1" />
        </div>
        <p class="!text-gray-300">Senin - Sabtu : 08.00 - 15.00</p>
      </div>
    </div>
    <div class="bg-primary-dark">
      <div class="container py-3">
        <p class="!text-white text-sm">
          Copyright &copy; {{ new Date().getFullYear() }} Nurul Iman
        </p>
      </div>
    </div>
  </footer>
</template>