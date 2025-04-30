<script setup>
import Input from "@/Components/Input.vue";
import Select from "@/Components/Select.vue";
import ImageUpload from "@/Components/ImageUpload.vue";
import ImagesUpload from "@/Components/ImagesUpload.vue";
import { useForm, usePage } from "@inertiajs/vue3";
import { computed } from "vue";

defineProps({ facilitycats: Object });

const form = useForm({
  name: "",
  facilitycat_id: "",
  caption: "",
  banner: null,
  images: [],
});

const page = usePage();
const user = computed(() => page.props.auth.user);

const banner = (e) => (form.banner = e);
const images = (e) => (form.images = e);

const imagesErrors = computed(() => {
  return Object.entries(form.errors)
    .filter(([key]) => key.startsWith("images."))
    .map(([, message]) => message);
});

const submit = () => {
  form.post(route("fasilitas.store"), {
    onSuccess: () => {
      form.reset();
    },
  });
};
</script>

<template>
  <section class="container py-4">
    <h1 class="h1">Tambah Fasilitas</h1>
    <p>Tambah Fasilitas dan Galery sekolah</p>
    <form @submit.prevent="submit" class="py-4 max-w-lg">
      <ImageUpload @image="(e) => banner(e)" :error="form.errors.banner" />
      <Input
        label="Name"
        icon="heading"
        placeholder="Nama fasilitas / galery.."
        v-model="form.name"
        :error="form.errors.name"
      />
      <Select
        label="Facility Category"
        icon="image"
        v-model="form.facilitycat_id"
        :error="form.errors.infocat_id"
      >
        <option value="">Pilih Kategori</option>
        <template v-for="(fc, i) in facilitycats" :key="i">
          <option
            v-if="user.role === 'admin' || user.role === fc.user.role"
            :value="fc.id"
          >
            {{ fc.name }}
          </option>
        </template>
      </Select>
      <Input
        label="Caption"
        icon="paragraph"
        placeholder="Caption.."
        v-model="form.caption"
        :error="form.errors.caption"
      />
      <ImagesUpload @images="(files) => images(files)" :error="imagesErrors" />
      <div class="flex gap-2">
        <button type="submit" class="btn" :disabled="form.processing">
          Tambah
        </button>
        <Link
          :href="route('fasilitas')"
          class="btn inline-block !bg-gray-500 hover:!bg-gray-600"
          >Kembali</Link
        >
      </div>
    </form>
  </section>
</template>