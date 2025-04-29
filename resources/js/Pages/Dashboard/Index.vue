<script setup>
import { usePage } from "@inertiajs/vue3";
import { computed } from "vue";

const page = usePage();
const user = computed(() => page.props.auth.user);
</script>

<template>
  <section class="container py-12">
    <article class="mx-auto max-w-2xl text-center leading-loose">
      <h1 class="h1 mb-4">Selamat Datang {{ user.name }}</h1>
      <p class="text-xl">
        Anda login sebagai {{ user.role }}, anda bisa memodifikasi data sekolah,
        akses menu nya di (icon user pojok kanan atas), selamat bekerja.
      </p>
    </article>
  </section>
</template>