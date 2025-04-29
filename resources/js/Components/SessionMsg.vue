<script setup>
defineProps({
  msg: String,
  type: { type: String, default: "success" },
});
</script>

<template>
  <p
    v-show="msg"
    class="py-2 px-4 rounded-lg my-1"
    :class="
      type === 'success'
        ? '!text-green-500 !bg-green-100 border-green-500'
        : '!text-red-500 !bg-red-100 border-red-500'
    "
  >
    <small>
      {{ msg === true ? "Saved" : msg }}
    </small>
  </p>
</template>