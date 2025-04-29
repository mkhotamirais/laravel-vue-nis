<script setup>
import Input from "@/Components/Input.vue";
import SessionMsg from "@/Components/SessionMsg.vue";
// import PaginationLinks from "@/Components/PaginationLinks.vue";
import PaginationInput from "@/Components/PaginationInput.vue";
import { router, useForm } from "@inertiajs/vue3";
import { ref } from "vue";

const props = defineProps({
  infocats: Object,
  success: String,
  searchTerm: String,
});

const form = useForm({ name: "" });
const editForm = useForm({ name: "" });
const searchForm = useForm({ search: props.searchTerm });

const isEdit = ref(null);

const setIsEdit = (i, ic) => {
  isEdit.value = i;
  editForm.name = ic.name;
};

const cancelIsEdit = () => {
  isEdit.value = null;
  editForm.reset();
};

const submit = () => {
  form.post(route("information-category.store"), {
    onSuccess: () => form.reset(),
    preserveScroll: true,
  });
};

const submitEdit = (ic) => {
  editForm.put(route("information-category.update", ic), {
    onSuccess: () => {
      editForm.reset();
      cancelIsEdit();
    },
    preserveScroll: true,
  });
};

const deleteInfocat = (ic) => {
  if (confirm("Apakah kamu yakin?")) {
    router.delete(route("information-category.destroy", ic));
  }
};

const search = () => {
  searchForm.get(
    route("information-category.index", { search: searchForm.search })
  );
};
</script>

<template>
  <section class="container py-4">
    <h1 class="h1">Information Category</h1>
    <hr class="my-2" />

    <SessionMsg :msg="success" />

    <!--  Add and Filters -->
    <div class="max-w-lg py-4">
      <form @submit.prevent="submit" class="flex items-end gap-2">
        <Input
          label="Tambah Category"
          icon="sitemap"
          placeholder="Name"
          v-model="form.name"
          :error="form.errors.name"
        />
        <button type="submit" class="btn mb-3" :disabled="form.processing">
          Tambah
        </button>
      </form>

      <form @submit.prevent="search" class="flex gap-2 items-end">
        <Input
          label="Cari"
          type="search"
          placeholder="Cari.."
          icon="magnifying-glass"
          v-model="searchForm.search"
        />
        <button class="btn mb-3">Cari</button>
      </form>
    </div>

    <!-- List & Pagination -->
    <div v-if="infocats.data.length">
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-4">
        <div v-for="(ic, i) in infocats.data" :key="i" class="shadow-md p-3">
          <form @submit.prevent="submitEdit(ic)" v-if="isEdit === i" class="">
            <Input
              placeholder="Edit name"
              icon="sitemap"
              v-model="editForm.name"
              :error="editForm.errors.name"
            />
            <button type="submit" class="btn" :disabled="editForm.processing">
              simpan
            </button>
          </form>
          <div v-else>
            <p>
              {{ ic.name }}
            </p>
            <span class="text-sm text-gray-400">By {{ ic.user.name }}</span>
          </div>

          <div class="flex gap-3 mt-2">
            <div v-if="isEdit === i">
              <button class="link" @click="cancelIsEdit">Batal</button>
            </div>
            <div v-else class="flex gap-3">
              <button class="link" @click="setIsEdit(i, ic)">Edit</button>
              <button class="link !text-red-500" @click="deleteInfocat(ic)">
                Hapus
              </button>
            </div>
          </div>
        </div>
      </div>
      <PaginationInput :paginator="infocats" />
    </div>

    <div v-else>
      <i>Pencarian "{{ props.searchTerm }}" tidak ditemukan!</i>
    </div>
  </section>
</template>
