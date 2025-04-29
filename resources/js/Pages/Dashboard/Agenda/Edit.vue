<script setup>
import Input from "@/Components/Input.vue";
import Textarea from "@/Components/Textarea.vue";
import { useForm } from "@inertiajs/vue3";
import { ref, watch } from "vue";

const props = defineProps({
  agenda: Object,
});

const form = useForm({
  title: props.agenda.title,
  description: props.agenda.description,
  start_time: props.agenda.start_time,
  end_time: props.agenda.end_time,
  location: props.agenda.location,
  _method: "PATCH",
});

const minEndTime = ref("");
// Setiap start_time berubah, update minEndTime
watch(
  () => form.start_time,
  (newStartTime) => {
    minEndTime.value = newStartTime;
  }
);

const submit = () => {
  form.post(
    route("agenda.update", {
      agenda: props.agenda,
    })
  );
};
</script>

<template>
  <section class="container py-4">
    <h1 class="h1">Tambah Agenda</h1>
    <p>Tambah Pengumuman & Agenda Nurul Iman</p>
    <form @submit.prevent="submit" class="py-4 max-w-lg">
      <Input
        label="Title"
        icon="heading"
        placeholder="Judul agenda.."
        v-model="form.title"
        :error="form.errors.name"
      />
      <Textarea
        label="Description"
        icon="newspaper"
        placeholder="Deskripsi.."
        v-model="form.description"
        :error="form.errors.description"
      />
      <Input
        label="Waktu Mulai"
        icon="clock"
        type="datetime-local"
        v-model="form.start_time"
        :error="form.errors.start_time"
      />
      <Input
        label="Waktu Selesai"
        icon="clock"
        type="datetime-local"
        v-model="form.end_time"
        :error="form.errors.end_time"
        :min="minEndTime"
      />
      <Input
        label="Location"
        icon="location"
        placeholder="Lokasi.."
        v-model="form.location"
        :error="form.errors.location"
      />
      <button type="submit" class="btn" :disabled="form.processing">
        Simpan
      </button>
    </form>
  </section>
</template>