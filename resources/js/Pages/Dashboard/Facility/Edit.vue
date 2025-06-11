<script setup>
import Input from "@/Components/Input.vue";
import Select from "@/Components/Select.vue";
import ImageUpload from "@/Components/ImageUpload.vue";
import ImagesUpload from "@/Components/ImagesUpload.vue";
import { useForm, usePage } from "@inertiajs/vue3";
import { computed } from "vue";

const props = defineProps({
  facility: Object,
  facilitycats: Object,
});

const form = useForm({
  name: props.facility.name,
  facilitycat_id: props.facility.facilitycat_id,
  caption: props.facility.caption,
  banner: null,
  images: [],
  delete_images: [],
  _method: "PATCH",
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
  form.post(
    route("fasilitas.update", {
      facility: props.facility,
    })
  );
};
</script>

<template>
  <section class="container py-4">
    <h1 class="h1">Update Fasilitas</h1>
    <p>Update Fasilitas dan Galery sekolah</p>
    <form @submit.prevent="submit" class="py-4 max-w-lg">
      <ImageUpload
        @image="(e) => banner(e)"
        :oldBanner="facility.banner"
        :error="form.errors.banner"
      />
      <Input
        label="Name"
        id="name"
        icon="heading"
        placeholder="Nama fasilitas / galery.."
        v-model="form.name"
        :error="form.errors.name"
      />
      <Select
        label="Facility Category"
        id="facility-category"
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
        id="caption"
        icon="paragraph"
        placeholder="Caption.."
        v-model="form.caption"
        :error="form.errors.caption"
      />
      <!-- current images -->
      <div>
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 mt-2">
          <div
            v-for="(fi, i) in facility.facilityimages"
            :key="i"
            class="relative group"
          >
            <label>
              <img
                :src="`/storage/${fi.image}`"
                class="w-full h-32 object-cover object-center rounded-lg"
              />
              <input
                type="checkbox"
                v-model="form.delete_images"
                :value="fi.id"
              />
              Delete
            </label>
          </div>
        </div>
      </div>
      <ImagesUpload @images="(files) => images(files)" :error="imagesErrors" />
      <div class="flex gap-2">
        <button type="submit" class="btn" :disabled="form.processing">
          Simpan
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