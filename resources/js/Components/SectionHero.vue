<script setup>
defineProps({
  title: String,
  description: String,
});
</script>

<template>
  <section class="bg-primary-dark text-white">
    <div class="container py-12">
      <h1 class="h1 !text-white mb-2">{{ title }}</h1>
      <p class="!text-gray-200 first-letter:uppercase text-xl font-semibold">
        {{ description }}
      </p>
    </div>
  </section>
</template>