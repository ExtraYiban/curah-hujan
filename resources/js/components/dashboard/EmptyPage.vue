<template>
  <div class="h-96 flex flex-col items-center justify-center bg-white rounded-xl shadow-sm border border-gray-100 p-8">
    <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mb-4">
      <span class="text-3xl">📄</span>
    </div>
    <h2 class="text-2xl font-bold text-gray-800 mb-2">{{ title }}</h2>
    <p class="text-gray-500 text-center max-w-md">
      Halaman ini masih kosong. Siap untuk ditambahkan konten baru.
    </p>
  </div>
</template>

<script setup lang="ts">
defineProps({
  title: {
    type: String,
    required: true
  }
})
</script>
