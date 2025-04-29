<script setup>
defineProps({
  position: { type: String, default: "right" },
});
</script>

<template>
  <div
    :class="
      position === 'right' ? 'right-0 translate-x-96' : 'left-0 -translate-x-96'
    "
    class="-z-50 absolute size-[40rem] bg-primary/5 rounded-[5rem] rotate-45"
  ></div>
</template>