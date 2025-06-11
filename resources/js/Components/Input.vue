<script setup>
import { ref } from "vue";

const model = defineModel();
const isShowPassword = ref(false);

const toggleShowPassword = () => {
  isShowPassword.value = !isShowPassword.value;
};
defineProps({
  label: String,
  id: String,
  icon: String,
  placeholder: { type: String, default: "" },
  type: { type: String, default: "text" },
  error: String,
  min: String,
});
</script>

<template>
  <div class="mb-3 w-full">
    <label :for="id" class="block text-sm font-medium text-slate-700">{{
      label
    }}</label>
    <div class="relative mt-1 rounded-md">
      <div
        class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3"
      >
        <span class="grid place-content-center text-sm text-slate-400">
          <i :class="`fa-solid fa-${icon}`"></i>
        </span>
      </div>
      <input
        :id="id"
        :name="id"
        :type="isShowPassword ? 'text' : type"
        :placeholder="placeholder"
        v-model="model"
        :class="[
          'border w-full rounded-md py-2 pl-9 text-sm border-slate-300 outline-0 focus:ring-1 focus:ring-inset focus:ring-primary focus:border-primary plaholder:text-slate-400',
          error
            ? 'border-red-500 ring-1 ring-red-500'
            : 'border-gray-300 ring-transparent',
          type === 'password' ? 'pr-10' : 'pr-3',
        ]"
        :min="min"
      />
      <div
        class="absolute inset-y-0 right-0 flex items-center pr-3 cursor-pointer"
        v-if="type === 'password'"
        @click="toggleShowPassword"
      >
        <span class="grid place-content-center text-sm text-slate-400">
          <i :class="`fa-solid fa-${isShowPassword ? 'eye-slash' : 'eye'}`"></i>
        </span>
      </div>
    </div>
    <small class="text-sm text-red-500">{{ error ? error : "" }}</small>
  </div>
</template>