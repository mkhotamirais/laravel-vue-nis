<script setup>
import { useForm } from "@inertiajs/vue3";

const props = defineProps({
  user: Object,
});

const form = useForm({ role: props.user.role });

const submit = (user) => {
  if (confirm(`Change this user's role to ${form.role}?`)) {
    form.put(route("admin.updateRole", user.id), { role: form.role });
  }
};
</script>

<template>
  <form @change="submit(user)">
    <select
      name="role"
      id="role"
      v-model="form.role"
      :disabled="user.email === 'mkhotamirais@gmail.com'"
      class="disabled:text-gray-500"
    >
      <option value="admin">Admin</option>
      <option value="editor_ponpes">Editor Ponpes</option>
      <option value="editor_ra">Editor RA</option>
      <option value="editor_mts">Editor MTs</option>
      <option value="editor_ma">Editor MA</option>
      <option value="user">User</option>
    </select>
  </form>
</template>