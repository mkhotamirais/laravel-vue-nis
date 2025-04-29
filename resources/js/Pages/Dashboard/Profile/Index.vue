<script setup>
import UpdateInfo from "./Sections/UpdateInfo.vue";
import UpdatePassword from "./Sections/UpdatePassword.vue";
import DeleteAccount from "./Sections/DeleteAccount.vue";

defineProps({ user: Object, status: String });
</script>

<template>
  <div class="container py-4">
    <div class="max-w-lg">
      <h1 class="h1 capitalize">{{ user?.name }}'s Profile</h1>
      <hr />
      <UpdateInfo :user="user" :status="status" />
      <hr />
      <UpdatePassword />
      <hr />
      <DeleteAccount />
    </div>
  </div>
</template>