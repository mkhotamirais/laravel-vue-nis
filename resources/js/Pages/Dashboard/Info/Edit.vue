<script setup>
import Input from "@/Components/Input.vue";
import Textarea from "@/Components/Textarea.vue";
import TextareaCke from "@/Components/TextareaCke.vue";
import Select from "@/Components/Select.vue";
import ImageUpload from "@/Components/ImageUpload.vue";
import { useForm, usePage } from "@inertiajs/vue3";
import { computed } from "vue";

const props = defineProps({ info: Object, infocats: Object });

const form = useForm({
  title: props.info.title,
  infocat_id: props.info.infocat_id,
  content: props.info.content,
  tags: props.info.tags,
  banner: null,
  _method: "PATCH",
});

const page = usePage();
const user = computed(() => page.props.auth.user);
const banner = (e) => (form.banner = e);

const submit = () => {
  form.post(
    route("informasi.update", {
      info: props.info,
    })
  );
};
</script>

<template>
  <section class="container py-4">
    <h1 class="h1">Update Information</h1>
    <p>
      Informasi mencakup kegiatan dan prestasi siswa serta berita dan artikel
      sekolah
    </p>
    <form @submit.prevent="submit" class="py-4 max-w-lg">
      <ImageUpload @image="(e) => banner(e)" :oldBanner="info.banner" />
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
        <option value="">Pilih Kategori</option>
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
      <div class="flex gap-2">
        <button type="submit" class="btn" :disabled="form.processing">
          Simpan
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