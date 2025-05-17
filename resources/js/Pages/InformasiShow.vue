<script setup>
import { diffForHumans, smartTrim, stripHtml } from "@/functions";
import Line from "@/Components/Line.vue";
import MyBg from "@/Components/MyBg.vue";

defineProps({
  info: Object,
  latestInfos: Object,
});
</script>

<template>
  <Head>
    <title>{{ smartTrim(info.title, 45) }}</title>
    <meta
      head-key="description"
      name="description"
      :content="smartTrim(stripHtml(info.content), 145)"
    />
  </Head>

  <section class="py-12 relative overflow-hidden lg:overflow-visible">
    <MyBg position="left" />
    <div class="container">
      <div class="flex flex-col lg:flex-row gap-8 place-items-start">
        <article class="w-full">
          <div class="mb-8 text-center">
            <h1 class="h1 mb-2 first-letter:uppercase">{{ info.title }}</h1>
            <p class="!text-gray-500">{{ diffForHumans(info.created_at) }}</p>
          </div>

          <img
            :src="
              info.banner
                ? `/storage/${info.banner}`
                : '/storage/images/logos/logo-yayasan-nurul-iman-sindangkerta.png'
            "
            :alt="smartTrim(info.title, 100)"
            class="w-full rounded-md mb-6"
            width="500"
            height="300"
            loading="lazy"
          />
          <p class="text-content" v-html="info.content"></p>
        </article>
        <div class="min-w-full md:min-w-80 sticky top-24">
          <div class="mb-2">
            <h3 class="h3 !text-2xl !font-bold !text-primary">
              Informasi Terbaru
            </h3>
            <Line />
          </div>
          <div>
            <div v-for="(info, i) in latestInfos" :key="i" class="">
              <Link
                :href="route('informasi.show', info)"
                class="mb-4 group flex h-20 gap-3 rounded-md overflow-hidden"
              >
                <img
                  :src="
                    info.banner
                      ? `/storage/${info.banner}`
                      : `/storage/images/logos/logo-yayasan-nurul-iman-sindangkerta.png`
                  "
                  :alt="smartTrim(info.title, 100)"
                  loading="lazy"
                  class="h-full !w-24 object-cover object-center"
                  width="500"
                  height="300"
                />
                <article>
                  <div class="group-hover:underline first-letter:uppercase">
                    {{ smartTrim(info.title, 50) }}
                  </div>
                  <div class="text-sm text-gray-400">
                    {{ diffForHumans(info.created_at) }}
                  </div>
                </article>
              </Link>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>