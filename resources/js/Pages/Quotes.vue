<script setup>
import SectionHero from "@/Components/SectionHero.vue";
import Textarea from "@/Components/Textarea.vue";
import Input from "@/Components/Input.vue";
import PaginationInput from "@/Components/PaginationInput.vue";
import SessionMsg from "@/Components/SessionMsg.vue";
import { router, useForm, usePage } from "@inertiajs/vue3";
import { computed, ref } from "vue";

defineProps({ quotes: Object, success: String });

const page = usePage();
const user = computed(() => page.props.auth.user);

const form = useForm({ content: "", author: "" });
const editForm = useForm({
  content: "",
  author: "",
  _method: "PATCH",
});

const isEdit = ref(null);

const setIsEdit = (i, q) => {
  isEdit.value = i;
  editForm.content = q.content;
  editForm.author = q.author;
};

const cancelIsEdit = () => {
  isEdit.value = null;
  editForm.reset();
};

const submit = () => {
  form.post("/quote", {
    onSuccess: () => form.reset("content", "author"),
  });
};

const submitEdit = (q) => {
  editForm.patch(route("quote.update", q), {
    onSuccess: () => {
      editForm.reset();
      cancelIsEdit();
    },
    preserveScroll: true,
  });
};

const deleteQuote = (q) => {
  if (confirm("Apakah kamu yakin?")) {
    router.delete(route("quote.destroy", q));
  }
};
</script>

<template>
  <Head>
    <title>Fasilitas</title>
    <meta
      head-key="description"
      name="description"
      content="ata kata mutiara pilihan untuk menenangkan jiwa"
    />
  </Head>

  <SectionHero
    title="Quotes"
    description="Kata kata mutiara pilihan untuk menenangkan jiwa"
  />
  <section class="bg-gray-100">
    <!-- Admin -->
    <div v-if="user" class="container pt-8">
      <div class="bg-white p-4 md:p-8 rounded-lg">
        <SessionMsg :msg="success" />
        <h2 class="text-2xl font-bold">Tambah Quote Baru</h2>
        <form @submit.prevent="submit">
          <Textarea
            placeholder="Quote Content..."
            label="Content"
            rows="3"
            icon="quote-right"
            v-model="form.content"
            :error="form.errors.content"
          />
          <Input
            label="Author (nama, buku atau sumber lainya)"
            placeholder="Ahmad, Kitab, lainnya.."
            icon="user"
            v-model="form.author"
            :error="form.errors.author"
          />
          <button
            type="submit"
            class="btn btn-primary"
            :disabled="form.processing"
          >
            Submit
          </button>
        </form>
      </div>
    </div>
    <!-- Quotes -->
    <div class="container py-12">
      <div class="bg-white rounded-lg">
        <div
          v-for="(q, i) in quotes.data"
          :key="i"
          class="even:bg-gray-50 p-8 md:p-12"
        >
          <div v-if="isEdit === i">
            <form @submit.prevent="submitEdit(q)">
              <Textarea
                placeholder="Quote Content..."
                label="Content"
                rows="3"
                icon="quote-right"
                v-model="editForm.content"
                :error="editForm.errors.content"
              />
              <Input
                label="Author (nama, buku atau sumber lainya)"
                placeholder="Ahmad, Kitab, lainnya.."
                icon="user"
                v-model="editForm.author"
                :error="editForm.errors.author"
              />
              <button
                type="submit"
                class="btn btn-primary"
                :disabled="editForm.processing"
              >
                Submit
              </button>
            </form>
          </div>
          <article v-else>
            <blockquote
              class="text-xl md:text-2xl font-bold first-letter:uppercase mb-2"
            >
              <i>"{{ q.content }}</i>
            </blockquote>
            <div class="text-lg text-primary capitalize">
              <span>- </span>{{ q.author }}
            </div>
          </article>
          <div v-if="user" class="flex gap-3 mt-2">
            <div v-if="isEdit === i">
              <button class="link" @click="cancelIsEdit">Batal</button>
            </div>
            <div v-else class="flex gap-3">
              <button class="link" @click="setIsEdit(i, q)">Edit</button>
              <button class="link !text-red-500" @click="deleteQuote(q)">
                Hapus
              </button>
            </div>
          </div>
        </div>
        <div class="px-4">
          <PaginationInput :paginator="quotes" />
        </div>
      </div>
    </div>
  </section>
</template>