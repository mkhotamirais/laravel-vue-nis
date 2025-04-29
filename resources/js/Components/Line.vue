<script setup>
defineProps({
  color: { type: String, default: "border-primary" },
  thickness: { type: String, default: "border-2" },
});
</script>

<template>
  <div class="flex gap-1 py-2">
    <hr :class="['w-10 rounded-full', color, thickness]" />
    <hr :class="['w-3 rounded-full', color, thickness]" />
  </div>
</template>