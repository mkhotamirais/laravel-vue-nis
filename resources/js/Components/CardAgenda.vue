<script setup>
import { formatTime, smartTrim } from "../functions";

defineProps({
  a: Object,
});
</script>

<template>
  <div class="rounded-lg overflow-hidden shadow-lg h-full flex flex-col">
    <h3
      class="h3 !text-white bg-primary p-4 text-center first-letter:uppercase h-28 flex justify-center overflow-y-scroll"
      :class="a.title.length < 56 ? 'items-center' : ''"
    >
      <!-- {{ smartTrim(a.title, 56) }} -->
      {{ a.title }}
    </h3>
    <article class="bg-white p-4 space-y-2">
      <div class="badge">{{ a.agenda_status }}</div>
      <div class="first-letter:uppercase">
        <i class="fa-solid fa-location-dot mr-2"></i>
        {{ a.location }}
      </div>
      <div class="text-sm">
        <i class="fa-solid fa-calendar mr-2"></i>
        {{ formatTime(a.start_time) }} <br />
        <b>s.d.</b>
        {{ formatTime(a.end_time) }}
      </div>
      <p class="text-gray-600">
        <i class="fa-solid fa-info-circle mr-2 text-black inline"></i>
        {{ a.description }}
      </p>
      <slot></slot>
    </article>
  </div>
</template>

<style scoped>
::-webkit-scrollbar {
  display: none;
}
</style>