<script setup>
defineProps({ paginator: Object });

const makeLabel = (label) => {
  if (label.includes("Previous")) {
    return "<i class='fa-solid fa-chevron-left'></i>";
  } else if (label.includes("Next")) {
    return "<i class='fa-solid fa-chevron-right'></i>";
  } else {
    return label;
  }
};

const myClass = (link) => {
  return {
    "hover:!bg-slate-300 dark:hover:!bg-slate-500": link.url,
    "!opacity-30": !link.url,
    "font-bold text-indigo-500 dark:!text-indigo-400": link.active,
  };
};
</script>

<template>
  <div class="flex justify-between items-center w-full py-6">
    <div class="flex items-center rounded-md overflow-hidden shadow-lg">
      <div v-for="(link, i) in paginator.links" :key="i">
        <component
          :is="link.url ? 'Link' : 'span'"
          :href="link.url"
          v-html="makeLabel(link.label)"
          class="border-x border-slate-50 w-12 h-12 grid place-items-center bg-white dark:bg-slate-900 dark:border-slate-800"
          :class="myClass(link)"
        />
      </div>
    </div>
    <div>
      <p>
        Menampilkan {{ paginator.from }} sampai {{ paginator.to }} dari
        {{ paginator.total }}
      </p>
    </div>
  </div>
</template>