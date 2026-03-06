<template>
    <Head title="Admin Panel" />
    <Header />

    <div class=" flex flex-row">


        
            <aside class="w-64 bg-white shadow-lg">
                    <div class="p-6 border-b">
                        <h1 class="text-xl font-bold">Admin Panel</h1>
                    </div>
        
                    <nav class="p-4 space-y-2">
                        <a href="#" class="block rounded-lg px-4 py-2 hover:bg-gray-100">
                            Menu Admin
                        </a>
                        <a href="#" class="block rounded-lg px-4 py-2 hover:bg-gray-100">
                            Kembali
                        </a>
                    </nav>
                </aside>
        
            <div class="min-h-screen bg-gray-50 font-sans flex-1">
                
                <main class="mx-auto max-w-7xl p-8">
                    <div class="rounded-lg bg-white p-8 text-center shadow">
                        <h2 class="text-3xl font-bold text-gray-900">Selamat Datang Admin</h2>
                        <p class="mt-4 text-gray-600">Halaman ini masih dalam pengembangan</p>
                    </div>
                </main>
            </div>
    </div>
</template>

<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import Header from '../Components/dashboard/Header.vue';
</script>
