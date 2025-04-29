<script setup>
defineProps({
  user: Object,
});
</script>

<template>
  <section class="container">Dashboard/Index {{ user.name }}</section>
</template>