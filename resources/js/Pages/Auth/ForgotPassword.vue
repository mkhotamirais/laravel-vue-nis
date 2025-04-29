<script setup>
import Input from "../../Components/Input.vue";
import SessionMsg from "../../Components/SessionMsg.vue";
import { useForm } from "@inertiajs/vue3";

defineProps({ status: String });
const form = useForm({ email: "" });

const submit = () => {
  form.post(route("password.email"));
};
</script>

<template>
  <Head title=" - Forgot Password" />

  <section class="w-1/2 mx-auto py-8">
    <h1 class="font-bold text-2xl">Lupa Password</h1>
    <p class="mb-4">
      Kamu lupa password? Tidak masalah. Kami akan mengirimkan link reset
      password ke alamat email kamu.
    </p>

    <!-- Errors Messages -->
    <SessionMsg :msg="form.errors.error" type="error" />
    <SessionMsg :msg="status" />

    <form @submit.prevent="submit" class="space-y-6">
      <Input
        label="Email"
        icon="at"
        v-model="form.email"
        placeholder="Email kamu"
        :error="form.errors.email"
      />
      <button type="submit" class="btn" :disabled="form.processing">
        Kirim link reset password
      </button>
    </form>
  </section>
</template>