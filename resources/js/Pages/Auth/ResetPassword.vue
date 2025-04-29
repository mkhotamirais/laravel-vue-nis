<script setup>
import Input from "../../Components/Input.vue";
import SessionMsg from "../../Components/SessionMsg.vue";
import { useForm } from "@inertiajs/vue3";

const props = defineProps({ token: String, email: String });

const form = useForm({
  token: props.token,
  email: props.email,
  password: "",
  password_confirmation: "",
});

const submit = () => {
  form.post(route("password.update"), {
    onFinish: () => form.reset("password", "password_confirmation"),
  });
};
</script>

<template>
  <Head title=" - Reset Password" />

  <section class="w-1/2 mx-auto py-8">
    <h1 class="font-bold text-2xl mb-4">Reset Password</h1>

    <SessionMsg :msg="form.errors.error" type="error" />

    <form @submit.prevent="submit" class="space-y-6">
      <Input
        label="Email"
        icon="at"
        placeholder="Email kamu"
        v-model="form.email"
        :error="form.password.email"
      />
      <Input
        label="Password"
        type="password"
        placeholder="********"
        icon="key"
        v-model="form.password"
        :error="form.errors.password"
      />
      <Input
        label="Password Confirmation"
        type="password"
        placeholder="********"
        icon="key"
        v-model="form.password_confirmation"
      />

      <button type="submit" class="btn" :disabled="form.processing">
        Reset Password
      </button>
    </form>
  </section>
</template>