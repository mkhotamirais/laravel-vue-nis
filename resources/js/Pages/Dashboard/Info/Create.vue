<script setup>
import Input from "@/Components/Input.vue";
import Textarea from "@/Components/Textarea.vue";
import TextareaCke from "@/Components/TextareaCke.vue";
import Select from "@/Components/Select.vue";
import ImageUpload from "@/Components/ImageUpload.vue";
import ImagesUpload from "@/Components/ImagesUpload.vue";
import { useForm, usePage } from "@inertiajs/vue3";
import { computed } from "vue";

defineProps({ infocats: Object });

const form = useForm({
  title: null,
  infocat_id: null,
  content: "",
  tags: null,
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
  form.post(route("informasi.store"), {
    onSuccess: () => {
      form.reset();
    },
  });
};
</script>

<template>
  <section class="container py-4">
    <h1 class="h1">Tambah Information</h1>
    <p>
      Informasi mencakup kegiatan dan prestasi siswa serta berita dan artikel
      sekolah
    </p>
    <form @submit.prevent="submit" class="py-4 max-w-lg">
      <ImageUpload @image="(e) => banner(e)" :error="form.errors.banner" />
      <Input
        label="Title"
        id="title"
        icon="heading"
        placeholder="Judul.."
        v-model="form.title"
        :error="form.errors.title"
      />
      <Select
        label="Information Category"
        id="information-category"
        icon="sitemap"
        v-model="form.infocat_id"
        :error="form.errors.infocat_id"
      >
        <option :value="null">Pilih Kategori</option>
        <template v-for="(ic, i) in infocats" :key="i">
          <option
            v-if="user.role === 'admin' || user.role === ic.user.role"
            :value="ic.id"
          >
            {{ ic.name }}
          </option>
        </template>
      </Select>
      <Input
        label="Tags (pisah dengan koma)"
        id="tags"
        icon="tags"
        placeholder="tag1, tag2, tag3"
        v-model="form.tags"
        :error="form.errors.tags"
      />
      <!-- <Textarea
        id="info_content"
        label="Content"
        icon="newspaper"
        placeholder="Content.."
        v-model="form.content"
        :error="form.errors.content"
      /> -->
      <TextareaCke
        label="Content"
        id="info_content"
        v-model="form.content"
        :error="form.errors.content"
      />
      <ImagesUpload @images="(files) => images(files)" :error="imagesErrors" />

      <div class="flex gap-2">
        <button type="submit" class="btn" :disabled="form.processing">
          Tambah
        </button>
        <Link
          :href="route('informasi')"
          class="btn inline-block !bg-gray-500 hover:!bg-gray-600"
          >Kembali</Link
        >
      </div>
    </form>
  </section>
</template>