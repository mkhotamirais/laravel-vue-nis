<script setup>
import SessionMsg from "@/Components/SessionMsg.vue";
import Input from "@/Components/Input.vue";

import { useForm } from "@inertiajs/vue3";

const form = useForm({ password: "" });

const submit = () => {
  form.post(route("password.confirm"), {
    onFinish: () => form.reset(),
  });
};
</script>

<template>
  <Head title=" - Password Confirmation" />
  <section class="container w-full lg:w-1/2 mx-auto py-8">
    <SessionMsg :msg="form.errors.error" type="error" />
    <h1 class="text-2xl font-bold">Konfirmasi Password</h1>
    <p class="py-2">Sebelum melanjutkan, mohon konfirmasi password Anda.</p>

    <form @submit.prevent="submit" class="space-y-6">
      <Input
        label="Password"
        type="password"
        icon="key"
        placeholder="********"
        v-model="form.password"
        :error="form.errors.password"
      />
      <button class="btn" :disabled="form.processing">Konfirmasi</button>
    </form>
  </section>
</template>