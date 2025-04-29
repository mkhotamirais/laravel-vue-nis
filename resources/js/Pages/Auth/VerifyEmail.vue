<script setup>
import { useForm } from "@inertiajs/vue3";
import SessionMsg from "@/Components/SessionMsg.vue";

defineProps({ status: String });

const form = useForm({});

const submit = () => {
  form.post(route("verification.send"));
};
</script>

<template>
  <section class="py-4 w-2/3 mx-auto">
    <SessionMsg :msg="status" />
    <p class="py-4">
      Terima kasih telah mendaftar, sebelum memulai, mohon verifikasi alamat
      email Anda dengan menekan tombol pada link yang telah kami kirimkan ke
      email Anda.
    </p>
    <form @submit.prevent="submit">
      <p class="">
        Jika Anda belum mendapatkan email verifikasi, silakan klik tombol di
        bawah
      </p>
      <button class="link" :disabled="form.processing">
        Kirim ulang email verifikasi
      </button>
    </form>
  </section>
</template>