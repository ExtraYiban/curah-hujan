<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <div class="flex min-h-screen flex-col bg-gradient-to-br from-blue-50 via-white to-cyan-50">
        <!-- Header -->
        <header class="border-b border-gray-200 bg-white">
            <nav class="mx-auto flex max-w-7xl items-center justify-between px-8 py-6">
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

                <Link href="/" class="flex items-center gap-2 font-medium text-gray-600 transition-colors hover:text-gray-900">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Kembali ke Beranda
                </Link>
            </nav>
        </header>

        <!-- Main Content -->
        <div class="flex flex-1 items-center justify-center px-4 py-12 sm:px-6 lg:px-8">
            <div class="w-full max-w-md">
                <div class="rounded-2xl bg-white p-8 shadow-xl sm:p-10">
                    <slot />
                </div>
            </div>
        </div>

        <!-- Footer -->
        <footer class="border-t border-gray-200 bg-white py-6">
            <div class="mx-auto max-w-7xl px-8 text-center text-sm text-gray-600">© 2026 Curah Hujan. All rights reserved.</div>
        </footer>
    </div>
</template>
