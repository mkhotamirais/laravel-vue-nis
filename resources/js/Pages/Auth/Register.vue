<script setup>
import Input from "@/Components/Input.vue";

import { useForm } from "@inertiajs/vue3";

const form = useForm({
  name: "",
  email: "",
  password: "",
  password_confirmation: "",
});

const submit = () => {
  form.post("/register", {
    onFinish: () => form.reset("password", "password_confirmation"),
  });
};
</script>

<template>
  <section
    class="w-full sm:w-1/2 lg:w-1/3 mx-auto my-12 p-8 shadow-none sm:shadow-lg rounded-lg bg-white space-y-4"
  >
    <h1 class="h1">Register</h1>
    <p>
      Already have an account?
      <Link :href="route('login')" class="link">Login</Link>
    </p>
    <form @submit.prevent="submit">
      <Input
        label="Name"
        placeholder="Your name"
        icon="id-badge"
        v-model="form.name"
        :error="form.errors.name"
      />
      <Input
        label="Email"
        placeholder="example@email.com"
        icon="at"
        v-model="form.email"
        :error="form.errors.email"
      />
      <Input
        label="Password"
        placeholder="********"
        icon="key"
        type="password"
        v-model="form.password"
        :error="form.errors.password"
      />
      <Input
        label="Password Confirmation"
        placeholder="********"
        icon="key"
        type="password"
        v-model="form.password_confirmation"
      />

      <button type="submit" class="btn" :disabled="form.processing">
        Register
      </button>
    </form>
  </section>
</template>