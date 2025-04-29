<script setup>
import UserRole from "./UserRole.vue";
import SessionMsg from "@/Components/SessionMsg.vue";

defineProps({
  users: Object,
  success: String,
});
</script>

<template>
  <section class="container py-12">
    <SessionMsg :msg="success" />
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
      <div v-for="(user, i) in users" :key="i" class="p-3 rounded-xl shadow">
        <p>
          {{ user.name }}
        </p>
        <p>{{ user.email }}</p>
        <UserRole :user="user" />
      </div>
    </div>
  </section>
</template>