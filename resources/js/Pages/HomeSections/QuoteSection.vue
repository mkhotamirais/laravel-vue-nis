<script setup>
defineProps({
  quotes: Object,
});
</script>

<template>
  <section class="py-12 bg-primary text-white">
    <div class="container">
      <h2 class="text-center text-lg font-bold mb-4">Quote</h2>
      <swiper-container
        slides-per-view="1"
        :navigation="true"
        :pagination="false"
        class="h-full"
        loop="true"
        :autoplay="{ delay: 8000, disableOnInteraction: false }"
      >
        <swiper-slide v-for="(q, i) in quotes" :key="i" class="my-auto">
          <article class="text-center">
            <blockquote
              class="text-2xl md:text-3xl italic font-bold text-white drop-shadow-xl"
            >
              <span class="text-5xl">"</span>
              {{ q.content }}
            </blockquote>
            <p
              class="mt-6 text-lg !text-white font-semibold uppercase tracking-wider"
            >
              - <span class="!text-gray-200">{{ q.author }}</span>
            </p>
          </article>
        </swiper-slide>
      </swiper-container>

      <br />

      <Link href="/quote" class="link !text-secondary flex justify-end"
        >Quotes Lainnya</Link
      >
    </div>
  </section>
</template>

<style scoped>
swiper-container::part(button-prev),
swiper-container::part(button-next) {
  width: 1rem;
  height: 1rem;
  color: #fff;
  border-radius: 50%;
  padding: 1rem;
  margin-right: 1rem;
  background: rgba(255, 255, 255, 0.1);
}
</style>