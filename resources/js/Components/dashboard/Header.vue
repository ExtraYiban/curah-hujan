<script setup lang="ts">
import { Link, usePage } from '@inertiajs/vue3';
import { computed } from 'vue';

const page = usePage();
const user = computed(() => page.props.auth?.user);
</script>

<template>
    <header class="sticky top-0 z-50 border-b border-gray-200 bg-white">
        <nav class="mx-auto flex max-w-7xl items-center justify-between px-8 py-6">
            <div class="flex items-center gap-12">
                <Link href="/" class="flex items-center gap-3">
                    <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-gradient-to-br from-blue-500 to-cyan-500">
                        <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M3 15a4 4 0 004 4h9a5 5 0 10-.1-9.999 5.002 5.002 0 10-9.78 2.096A4.001 4.001 0 003 15z"
                            ></path>
                        </svg>
                    </div>
                    <h1 class="text-2xl font-bold text-gray-900">Curah Hujan</h1>
                </Link>

                <ul class="flex gap-8">
                    <li>
                        <Link
                            href="/"
                            class="font-medium text-gray-700 transition-colors hover:text-blue-600"
                            :class="{ 'border-b-2 border-blue-600 pb-1 text-blue-600': $page.component === 'Welcome' }"
                        >
                            Beranda
                        </Link>
                    </li>
                    <li>
                        <Link
                            href="/curah-hujan"
                            class="font-medium text-gray-700 transition-colors hover:text-blue-600"
                            :class="{ 'border-b-2 border-blue-600 pb-1 text-blue-600': $page.component === 'CurahHujan' }"
                        >
                            Curah Hujan
                        </Link>
                    </li>
                    <li>
                        <Link
                            href="/tma-debit"
                            class="font-medium text-gray-700 transition-colors hover:text-blue-600"
                            :class="{ 'border-b-2 border-blue-600 pb-1 text-blue-600': $page.component === 'TmaDebit' }"
                        >
                            TMA & Debit
                        </Link>
                    </li>
                    <li>
                        <Link
                            href="/iklim"
                            class="font-medium text-gray-700 transition-colors hover:text-blue-600"
                            :class="{ 'border-b-2 border-blue-600 pb-1 text-blue-600': $page.component === 'Iklim' }"
                        >
                            Iklim
                        </Link>
                    </li>
                    <li>
                        <Link
                            href="/kualitas-air"
                            class="font-medium text-gray-700 transition-colors hover:text-blue-600"
                            :class="{ 'border-b-2 border-blue-600 pb-1 text-blue-600': $page.component === 'KualitasAir' }"
                        >
                            Kualitas Air
                        </Link>
                    </li>
                    <li>
                        <Link
                            href="/permohonan-data"
                            class="font-medium text-gray-700 transition-colors hover:text-blue-600"
                            :class="{ 'border-b-2 border-blue-600 pb-1 text-blue-600': $page.component === 'PermohonanData' }"
                        >
                            Permohonan Data
                        </Link>
                    </li>
                    <li>
                        <Link
                            href="/tentang-kami"
                            class="font-medium text-gray-700 transition-colors hover:text-blue-600"
                            :class="{ 'border-b-2 border-blue-600 pb-1 text-blue-600': $page.component === 'TentangKami' }"
                        >
                            Tentang Kami
                        </Link>
                    </li>
                </ul>
            </div>

            <!-- Auth Buttons -->
            <div class="flex items-center gap-4">
                <template v-if="user">
                    <Link href="/dashboard" class="flex items-center gap-2 font-medium text-gray-700 transition-colors hover:text-blue-600">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"
                            ></path>
                        </svg>
                        {{ user.name }}
                    </Link>
                    <Link
                        href="/logout"
                        method="post"
                        as="button"
                        class="rounded-lg bg-gray-100 px-4 py-2 font-medium text-gray-700 transition-colors hover:bg-gray-200"
                    >
                        Keluar
                    </Link>
                </template>
                <template v-else>
                    <Link href="/login" class="px-4 py-2 font-medium text-gray-700 transition-colors hover:text-blue-600"> Masuk </Link>
                    <Link
                        href="/register"
                        class="transform rounded-lg bg-gradient-to-r from-blue-600 to-cyan-600 px-5 py-2 font-semibold text-white shadow-md transition-all duration-200 hover:scale-105 hover:from-blue-700 hover:to-cyan-700"
                    >
                        Daftar
                    </Link>
                </template>
            </div>
        </nav>
    </header>
</template>
