<script setup>
import Input from "@/Components/Input.vue";
import Textarea from "@/Components/Textarea.vue";
import TextareaCke from "@/Components/TextareaCke.vue";
import ImageUpload from "@/Components/ImageUpload.vue";

import { useForm } from "@inertiajs/vue3";

const form = useForm({
  name: "",
  mentor: "",
  description: "",
  schedule: "",
  banner: null,
});

const banner = (e) => (form.banner = e);

const submit = () => {
  form.post(route("ekstrakurikuler.store"), {
    onSuccess: () => {
      form.reset();
    },
  });
};
</script>

<template>
  <section class="container py-4">
    <h1 class="h1">Tambah Ekstrakurikuler</h1>
    <p>Tambah Ekskul Nurul Iman</p>
    <form @submit.prevent="submit" class="py-4 max-w-lg">
      <ImageUpload @image="(e) => banner(e)" />
      <Input
        label="Name"
        id="name"
        icon="heading"
        placeholder="Nama Ekskul.."
        v-model="form.name"
        :error="form.errors.name"
      />
      <Input
        label="Pembimbing"
        id="mentor"
        icon="user"
        placeholder="Nama pembimbing.."
        v-model="form.mentor"
        :error="form.errors.mentor"
      />
      <!-- <Textarea
        label="Description"
        id="description"
        icon="newspaper"
        placeholder="Deskripsi.."
        v-model="form.description"
        :error="form.errors.description"
      /> -->
      <TextareaCke
        label="Description"
        id="description"
        v-model="form.description"
        :error="form.errors.description"
      />
      <!-- <Textarea
        label="Jadwal"
        id="jadwal"
        icon="clock"
        placeholder="Jadwal ekskul.."
        v-model="form.schedule"
        :error="form.errors.schedule"
      /> -->
      <TextareaCke
        label="Jadwal"
        id="schedule"
        v-model="form.schedule"
        :error="form.errors.schedule"
      />
      <div class="flex gap-2">
        <button type="submit" class="btn" :disabled="form.processing">
          Tambah
        </button>
        <Link
          :href="route('ekstrakurikuler')"
          class="btn inline-block !bg-gray-500 hover:!bg-gray-600"
          >Kembali</Link
        >
      </div>
    </form>
  </section>
</template>