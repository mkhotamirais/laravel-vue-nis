<script setup>
import HeroSection from "./HomeSections/HeroSection.vue";
import ProfileSection from "./HomeSections/ProfileSection.vue";
import InformationSection from "./HomeSections/InformationSection.vue";
import QuoteSection from "./HomeSections/QuoteSection.vue";
import FasilitasSection from "./HomeSections/FasilitasSection.vue";
import DaftarSection from "./HomeSections/DaftarSection.vue";
import AgendaSection from "./HomeSections/AgendaSection.vue";

defineProps({
  heroImages: Object,
  infos: Object,
  quotes: Object,
  facilities: Object,
  agendas: Object,
});
</script>

<template>
  <Head title="Home" />
  <HeroSection :heroImages="heroImages" />
  <ProfileSection />
  <InformationSection :infos="infos" />
  <QuoteSection :quotes="quotes" />
  <FasilitasSection :facilities="facilities" />
  <DaftarSection />
  <AgendaSection :agendas="agendas" />
</template>
