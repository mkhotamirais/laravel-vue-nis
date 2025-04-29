<script setup>
import Input from "@/Components/Input.vue";
import SessionMsg from "@/Components/SessionMsg.vue";

import { useForm } from "@inertiajs/vue3";

const form = useForm({
  email: "",
  password: "",
});

const submit = () => {
  form.post("/login", {
    onFinish: () => form.reset("password"),
  });
};
</script>

<template>
  <section
    class="w-full sm:w-1/2 lg:w-1/3 mx-auto my-12 p-8 shadow-none sm:shadow-lg rounded-lg bg-white space-y-4"
  >
    <h1 class="h1">Login</h1>
    <!-- <p>
      Already have an account?
      <Link :href="route('login')" class="link">Login</Link>
    </p> -->

    <SessionMsg :msg="form.errors.error" type="error" />

    <form @submit.prevent="submit">
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

      <div class="flex items-center justify-between mb-4">
        <div class="flex items-center">
          <input
            type="checkbox"
            id="remember"
            v-model="form.remember"
            class="mr-2"
          />
          <label for="remember" class="text-sm">Remember me</label>
        </div>
        <Link :href="route('password.request')" class="link"
          >Forgot Password?</Link
        >
      </div>

      <button type="submit" class="btn" :disabled="form.processing">
        Login
      </button>
    </form>
  </section>
</template>