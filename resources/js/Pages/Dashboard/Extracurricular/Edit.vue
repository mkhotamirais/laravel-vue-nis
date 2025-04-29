<script setup>
import Input from "@/Components/Input.vue";
import Textarea from "@/Components/Textarea.vue";
import ImageUpload from "@/Components/ImageUpload.vue";

import { useForm } from "@inertiajs/vue3";

const props = defineProps({
  extracurricular: Object,
});

const form = useForm({
  name: props.extracurricular.name,
  mentor: props.extracurricular.mentor,
  description: props.extracurricular.description,
  schedule: props.extracurricular.schedule,
  banner: null,
  _method: "PATCH",
});

const banner = (e) => (form.banner = e);

const submit = () => {
  form.post(
    route("ekstrakurikuler.update", {
      extracurricular: props.extracurricular,
    }),
    {
      onSuccess: () => {
        form.reset();
      },
    }
  );
};
</script>

<template>
  <section class="container py-4">
    <h1 class="h1">Update Ekstrakurikuler</h1>
    <p>Update Ekskul Nurul Iman</p>
    <form @submit.prevent="submit" class="py-4 max-w-lg">
      <ImageUpload
        @image="(e) => banner(e)"
        :oldBanner="extracurricular.banner"
      />
      <Input
        label="Name"
        icon="heading"
        placeholder="Nama Ekskul.."
        v-model="form.name"
        :error="form.errors.name"
      />
      <Input
        label="Pembimbing"
        icon="user"
        placeholder="Nama pembimbing.."
        v-model="form.mentor"
        :error="form.errors.mentor"
      />
      <Textarea
        label="Description"
        icon="newspaper"
        placeholder="Deskripsi.."
        v-model="form.description"
        :error="form.errors.description"
      />
      <Textarea
        label="Jadwal"
        icon="clock"
        placeholder="Jadwal ekskul.."
        v-model="form.schedule"
        :error="form.errors.schedule"
      />

      <div class="flex gap-2">
        <button type="submit" class="btn" :disabled="form.processing">
          Simpan
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