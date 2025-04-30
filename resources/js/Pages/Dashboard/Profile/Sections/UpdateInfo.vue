<script setup>
import Input from "@/Components/Input.vue";
import SessionMsg from "@/Components/SessionMsg.vue";
import { router, useForm } from "@inertiajs/vue3";

const props = defineProps({ user: Object, status: String });

const form = useForm({ name: props.user.name, email: props.user.email });

const submit = () => {
  form.patch(route("profile.update"), {
    preserveScroll: true,
  });
};

const resendEmail = (e) => {
  router.post(
    route("verification.send"),
    {},
    {
      onStart: () => (e.target.disabled = true),
      onFinish: () => (e.target.disabled = false),
    }
  );
};
</script>

<template>
  <section class="py-4 max-w-lg">
    <h2 class="h2 mb-4">Update Info</h2>

    <form @submit.prevent="submit" class="">
      <SessionMsg :msg="status" />
      <SessionMsg :msg="form.recentlySuccessful" />

      <Input
        label="Name"
        id="name"
        icon="id-badge"
        placeholder="Your name"
        v-model="form.name"
        :error="form.errors.name"
      />
      <Input
        label="Email"
        id="email"
        icon="at"
        placeholder="example@email.com"
        v-model="form.email"
        :error="form.errors.email"
      />

      <div v-if="user.email_verified_at === null" class="text-sm mb-2">
        <p class="text-yellow-500">Your email address is unverified.</p>
        <button
          @click="resendEmail"
          class="text-blue-500 underline cursor-pointer"
        >
          Click here to re-send the verification email.
        </button>
      </div>

      <button type="submit" class="btn" :disabled="form.processing">
        Save
      </button>
    </form>
  </section>
</template>