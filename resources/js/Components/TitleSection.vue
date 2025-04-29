<script setup>
import Line from "./Line.vue";
defineProps({
  beforeTitle: String,
  title: String,
});
</script>

<template>
  <div class="mb-8 max-w-2xl relative">
    <!-- <div
      class="absolute size-80 rounded-full bg-primary/5 -translate-x-10 -translate-y-10"
    ></div> -->
    <p class="mb-2 !text-primary font-semibold">
      {{ beforeTitle }}
    </p>
    <h2 class="h2" v-html="title"></h2>
    <Line />
  </div>
</template>