<script setup>
import SectionHero from "@/Components/SectionHero.vue";
import MyBg from "@/Components/MyBg.vue";
</script>

<template>
  <Head>
    <title>PPDB</title>
    <meta
      head-key="description"
      name="description"
      content="Penerimaan Peserta Didik Baru Nurul Iman Sindangkerta"
    />
  </Head>
  <SectionHero
    title="PPDB"
    description="Penerimaan Peserta Didik Baru Nurul Iman Sindangkerta"
  />

  <section class="container py-12 leading-7 relative">
    <MyBg position="left" />
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center">
      <article class="space-y-4">
        <h2 class="h2">PPDB MA</h2>
        <div>
          <h3 class="h3">Periode Pendaftaran</h3>
          <p class="">10 Februari 2025 s.d. 10 Juli 2025</p>
        </div>
        <div>
          <h3 class="h3">Persyaratan Pendaftaran</h3>
          <ul class="list-disc list-inside text-slate-600">
            <li>Copy Surat Ket. Lulus 1 Lembar.</li>
            <li>Copy KTP/KK Orang Tua 2 Lembar.</li>
            <li>Copy Ijazah/STTB SMP/MTs 1 Lembar.</li>
            <li>Copy Kartu KIP/PKH 1 Lembar (jika ada).</li>
          </ul>
        </div>
        <div>
          <h3 class="h3">Fasilitas Pendaftaran</h3>
          <ul class="list-disc list-inside text-slate-600">
            <li>Sarana gedung 3 lantai representatif & memadai.</li>
            <li>Berada di lokasi Pondok Pesantren dan berasrama.</li>
            <li>
              Memiliki kegiatan unggulan bidang akademik dan non akademik.
            </li>
            <li>SDM tenaga pendidik profesional di bidangnya mulai S1 - S2.</li>
          </ul>
        </div>
        <div>
          <!-- "ppdb2" => "https://bit.ly/PPDBNI2025", -->
          <a
            href="https://docs.google.com/forms/d/e/1FAIpQLSf8uTlMAxlvO3w49gmxFcTUY6TVIl14nEhitsUs_E8mWtsPCQ/viewform"
            class="btn"
            >Daftar</a
          >
        </div>
      </article>
      <div class="bg-gray-50 h-full">
        <a href="/storage/images/ppdb-ma-2025.jpg">
          <img
            src="/storage/images/ppdb-ma-2025.jpg"
            alt="banner ppdb ma 2025"
            class="object-contain object-center h-[480px] rounded-lg mx-auto"
          />
        </a>
      </div>
    </div>
  </section>
</template>