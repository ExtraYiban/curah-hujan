<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, usePage } from '@inertiajs/vue3';
import { computed } from 'vue';

const page = usePage();
const user = computed(() => page.props.auth.user);
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <!-- Welcome Card -->
                <div class="bg-gradient-to-r from-blue-600 to-cyan-600 rounded-2xl shadow-lg p-8 mb-8 text-white">
                    <h1 class="text-3xl font-bold mb-2">Selamat Datang, {{ user.name }}! 👋</h1>
                    <p class="text-blue-100">Anda berhasil masuk ke sistem monitoring Curah Hujan</p>
                </div>

                <!-- Quick Links Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
                    <Link href="/curah-hujan" class="bg-white rounded-2xl shadow-lg p-6 hover:shadow-xl transition-shadow group">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center group-hover:bg-blue-200 transition-colors">
                                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 15a4 4 0 004 4h9a5 5 0 10-.1-9.999 5.002 5.002 0 10-9.78 2.096A4.001 4.001 0 003 15z"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-bold text-gray-900">Curah Hujan</h3>
                                <p class="text-sm text-gray-600">Data presipitasi</p>
                            </div>
                        </div>
                    </Link>

                    <Link href="/tma-debit" class="bg-white rounded-2xl shadow-lg p-6 hover:shadow-xl transition-shadow group">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 bg-cyan-100 rounded-lg flex items-center justify-center group-hover:bg-cyan-200 transition-colors">
                                <svg class="w-6 h-6 text-cyan-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-bold text-gray-900">TMA & Debit</h3>
                                <p class="text-sm text-gray-600">Tinggi muka air</p>
                            </div>
                        </div>
                    </Link>

                    <Link href="/iklim" class="bg-white rounded-2xl shadow-lg p-6 hover:shadow-xl transition-shadow group">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 bg-yellow-100 rounded-lg flex items-center justify-center group-hover:bg-yellow-200 transition-colors">
                                <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-bold text-gray-900">Iklim</h3>
                                <p class="text-sm text-gray-600">Data iklim</p>
                            </div>
                        </div>
                    </Link>

                    <Link href="/kualitas-air" class="bg-white rounded-2xl shadow-lg p-6 hover:shadow-xl transition-shadow group">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center group-hover:bg-green-200 transition-colors">
                                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-bold text-gray-900">Kualitas Air</h3>
                                <p class="text-sm text-gray-600">Monitoring kualitas</p>
                            </div>
                        </div>
                    </Link>

                    <Link href="/permohonan-data" class="bg-white rounded-2xl shadow-lg p-6 hover:shadow-xl transition-shadow group">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center group-hover:bg-purple-200 transition-colors">
                                <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-bold text-gray-900">Permohonan Data</h3>
                                <p class="text-sm text-gray-600">Ajukan permintaan</p>
                            </div>
                        </div>
                    </Link>

                    <Link href="/profile" class="bg-white rounded-2xl shadow-lg p-6 hover:shadow-xl transition-shadow group">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 bg-gray-100 rounded-lg flex items-center justify-center group-hover:bg-gray-200 transition-colors">
                                <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-bold text-gray-900">Profil Saya</h3>
                                <p class="text-sm text-gray-600">Kelola akun</p>
                            </div>
                        </div>
                    </Link>
                </div>

                <!-- Info Card -->
                <div class="bg-white rounded-2xl shadow-lg p-8">
                    <div class="flex items-start gap-4">
                        <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center flex-shrink-0">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-gray-900 mb-2">Informasi Akun</h3>
                            <div class="space-y-2 text-gray-600">
                                <p><span class="font-semibold">Email:</span> {{ user.email }}</p>
                                <p><span class="font-semibold">Status:</span> <span class="text-green-600 font-medium">Aktif</span></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
