<template>
    <div class="flex h-96 flex-col items-center justify-center rounded-xl border border-gray-100 bg-white p-8 shadow-sm">
        <div class="mb-4 flex h-16 w-16 items-center justify-center rounded-full bg-gray-100">
            <span class="text-3xl">📄</span>
        </div>
        <h2 class="mb-2 text-2xl font-bold text-gray-800">{{ title }}</h2>
        <p class="max-w-md text-center text-gray-500">Halaman ini masih kosong. Siap untuk ditambahkan konten baru.</p>
    </div>
</template>

<script setup lang="ts">
defineProps({
    title: {
        type: String,
        required: true,
    },
});
</script>
