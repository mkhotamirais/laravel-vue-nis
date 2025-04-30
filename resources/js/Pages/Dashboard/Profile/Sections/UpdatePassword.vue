<script setup>
import SessionMsg from "@/Components/SessionMsg.vue";
import Input from "@/Components/Input.vue";

import { useForm } from "@inertiajs/vue3";

const form = useForm({
  current_password: "",
  password: "",
  password_confirmation: "",
});

const submit = () => {
  form.put(route("profile.password"), {
    onSuccess: () => form.reset(),
    onError: () => form.reset(),
    preserveScroll: true,
  });
};
</script>

<template>
  <section class="py-4 max-w-lg">
    <div class="mb-4">
      <h2 class="h2">Update Password</h2>
      <p>Update your account's profile information and email address.</p>
    </div>

    <SessionMsg :msg="form.recentlySuccessful" />
    <form @submit.prevent="submit" class="space-y-4">
      <Input
        label="Current Password"
        id="current-password"
        v-model="form.current_password"
        icon="key"
        type="password"
        placeholder="********"
        :error="form.errors.current_password"
      />
      <Input
        label="New Password"
        id="new-password"
        icon="key"
        v-model="form.password"
        type="password"
        placeholder="********"
        :error="form.errors.password"
      />
      <Input
        label="Confirm New Password"
        id="new-password-confirmation"
        icon="key"
        v-model="form.password_confirmation"
        type="password"
        placeholder="********"
      />

      <button class="btn" type="submit" :disabled="form.processing">
        Save
      </button>
    </form>
  </section>
</template>