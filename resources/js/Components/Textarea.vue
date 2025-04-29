<script setup>
const model = defineModel();
defineProps({
  label: String,
  icon: String,
  placeholder: { type: String, default: "" },
  type: { type: String, default: "text" },
  error: String,
  rows: { type: String, default: "6" },
});
</script>

<template>
  <div class="mb-3 w-full">
    <label :for="label" class="block text-sm font-medium text-slate-700">{{
      label
    }}</label>
    <div class="relative mt-1 rounded-md">
      <div
        class="pointer-events-none absolute left-0 top-3 flex items-center pl-3"
      >
        <span class="grid place-content-center text-sm text-slate-400">
          <i :class="`fa-solid fa-${icon}`"></i>
        </span>
      </div>
      <textarea
        :id="label"
        :rows="rows"
        :placeholder="placeholder"
        v-model="model"
        :class="[
          'border w-full rounded-md py-2 pr-3 pl-9 text-sm border-slate-300 outline-0 focus:ring-1 focus:ring-inset focus:ring-primary focus:border-primary plaholder:text-slate-400',
          error
            ? 'border-red-500 ring-1 ring-red-500'
            : 'border-gray-300 ring-transparent',
        ]"
      ></textarea>
    </div>
    <small class="text-sm text-red-500">{{ error ? error : "" }}</small>
  </div>
</template>