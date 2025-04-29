<script setup>
import SectionHero from "@/Components/SectionHero.vue";
import MyBg from "@/Components/MyBg.vue";
import { contactMenus, socialsMenus } from "../menus";
</script>

<template>
  <SectionHero
    title="Kontak"
    description="Hubungi kami untuk informasi lebih lanjut"
  />

  <section class="relative py-12 overflow-hidden">
    <MyBg position="left" />

    <div class="container grid grid-cols-1 md:grid-cols-2 gap-8">
      <article class="space-y-6">
        <div class="space-y-3">
          <h2 class="h2">Alamat</h2>
          <p>
            Kp. Bangong Rt 02/01, Desa Pasirpogor, Kec. Sindangkerta, Kab.
            Bandung Barat, Jawa Barat, 40563
          </p>
        </div>
        <div class="space-y-3">
          <h2 class="h2">Kontak</h2>
          <div v-for="(item, i) in contactMenus" :key="i">
            <h3 class="h3 mb-2">{{ item.title }}</h3>
            <div v-if="item.subMenus.length">
              <Link
                v-for="(itm, j) in item.subMenus"
                :key="j"
                :href="itm.url"
                class="link w-fit pb-2 flex items-center gap-2"
              >
                <i :class="`${itm.icon}`"></i>
                {{ itm.title }}</Link
              >
            </div>
            <div v-else>-</div>
          </div>
        </div>
        <div class="space-y-3">
          <h2 class="h2">Sosial Media</h2>
          <div v-for="(item, i) in socialsMenus" :key="i">
            <h3 class="h3 mb-2">{{ item.title }}</h3>
            <div v-if="item.subMenus.length">
              <Link
                v-for="(itm, j) in item.subMenus"
                :key="j"
                :href="itm.url"
                class="link w-fit pb-2 flex items-center gap-2"
              >
                <i :class="`${itm.icon}`"></i>
                {{ itm.title }}</Link
              >
            </div>
            <div v-else>-</div>
          </div>
        </div>
      </article>
      <div>
        <iframe
          class="w-full aspect-video md:aspect-auto"
          src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3960.229450175394!2d107.39491247442088!3d-6.982227968373459!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68f123180eac09%3A0xcc118a310eb88034!2sRA%2FMTS%2FMAS%2FPONDOK%20PESANTREN%20NURUL%20IMAN%20BANGONG!5e0!3m2!1sen!2sid!4v1739604555499!5m2!1sen!2sid"
          width="100%"
          height="400"
          style="border: 0"
          allowfullscreen=""
          loading="lazy"
          referrerpolicy="no-referrer-when-downgrade"
        ></iframe>
      </div>
    </div>
  </section>
</template>