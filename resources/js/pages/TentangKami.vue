<template>
    <Head title="Tentang Kami" />

    <div class="min-h-screen bg-gray-50 font-sans">
        <Header />
        <main class="mx-auto max-w-7xl p-8">
            <!-- Hero Section -->
            <div class="mb-12 rounded-2xl bg-gradient-to-r from-blue-600 to-cyan-600 p-12 text-white shadow-xl">
                <h1 class="mb-4 text-5xl font-bold">Tentang Kami</h1>
                <p class="text-xl text-blue-100">Sistem Pemantau Risiko Banjir Samarinda</p>
            </div>

            <!-- About Section -->
            <div class="mb-12 grid grid-cols-1 gap-8 lg:grid-cols-2">
                <div class="rounded-2xl bg-white p-8 shadow-lg hover:shadow-xl transition-shadow">
                    <div class="mb-6 flex items-center gap-4">
                        <div class="flex h-14 w-14 flex-shrink-0 items-center justify-center rounded-lg bg-blue-100">
                            <svg class="h-7 w-7 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
                                />
                            </svg>
                        </div>
                        <h2 class="text-2xl font-bold text-gray-900">Visi Kami</h2>
                    </div>
                    <p class="leading-relaxed text-gray-700">
                        Menjadi sistem informasi terdepan dalam monitoring dan pelaporan data curah hujan, tinggi muka air, dan potensi banjir di Kota
                        Samarinda untuk mendukung pengambilan keputusan yang cepat dan akurat dalam penanggulangan bencana.
                    </p>
                </div>

                <div class="rounded-2xl bg-white p-8 shadow-lg hover:shadow-xl transition-shadow">
                    <div class="mb-6 flex items-center gap-4">
                        <div class="flex h-14 w-14 flex-shrink-0 items-center justify-center rounded-lg bg-green-100">
                            <svg class="h-7 w-7 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"
                                />
                            </svg>
                        </div>
                        <h2 class="text-2xl font-bold text-gray-900">Misi Kami</h2>
                    </div>
                    <ul class="space-y-3 leading-relaxed text-gray-700">
                        <li class="flex items-start gap-3">
                            <span class="flex-shrink-0 text-green-600 font-bold">✓</span>
                            <span>Menyediakan data curah hujan dan iklim yang akurat dan real-time</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <span class="flex-shrink-0 text-green-600 font-bold">✓</span>
                            <span>Memantau tinggi muka air dan debit sungai secara berkelanjutan</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <span class="flex-shrink-0 text-green-600 font-bold">✓</span>
                            <span>Memberikan informasi kualitas air yang mudah diakses</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <span class="flex-shrink-0 text-green-600 font-bold">✓</span>
                            <span>Mendukung mitigasi bencana banjir di wilayah Samarinda</span>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Features Section -->
            <div class="mb-12 rounded-2xl bg-white p-8 shadow-lg">
                <h2 class="mb-8 text-3xl font-bold text-gray-900">Fitur Sistem</h2>
                <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
                    <div class="rounded-xl bg-gradient-to-br from-blue-50 to-blue-100 p-6 hover:shadow-md transition-shadow">
                        <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-lg bg-blue-600">
                            <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M3 15a4 4 0 004 4h9a5 5 0 10-.1-9.999 5.002 5.002 0 10-9.78 2.096A4.001 4.001 0 003 15z"
                                />
                            </svg>
                        </div>
                        <h3 class="mb-2 font-bold text-gray-900">Monitoring Curah Hujan</h3>
                        <p class="text-sm text-gray-700">Pemantauan intensitas curah hujan secara real-time dengan data akurat dari BMKG</p>
                    </div>

                    <div class="rounded-xl bg-gradient-to-br from-cyan-50 to-cyan-100 p-6 hover:shadow-md transition-shadow">
                        <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-lg bg-cyan-600">
                            <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"
                                />
                            </svg>
                        </div>
                        <h3 class="mb-2 font-bold text-gray-900">Data TMA & Debit</h3>
                        <p class="text-sm text-gray-700">Informasi tinggi muka air dan debit sungai untuk antisipasi banjir</p>
                    </div>

                    <div class="rounded-xl bg-gradient-to-br from-green-50 to-green-100 p-6 hover:shadow-md transition-shadow">
                        <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-lg bg-green-600">
                            <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0110.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
                                />
                            </svg>
                        </div>
                        <h3 class="mb-2 font-bold text-gray-900">Peta Interaktif</h3>
                        <p class="text-sm text-gray-700">Visualisasi peta banjir dan titik monitoring yang mudah dipahami</p>
                    </div>

                    <div class="rounded-xl bg-gradient-to-br from-yellow-50 to-yellow-100 p-6 hover:shadow-md transition-shadow">
                        <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-lg bg-yellow-600">
                            <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z"
                                />
                            </svg>
                        </div>
                        <h3 class="mb-2 font-bold text-gray-900">Data Iklim</h3>
                        <p class="text-sm text-gray-700">Informasi cuaca dan kondisi iklim terkini untuk wilayah Samarinda</p>
                    </div>

                    <div class="rounded-xl bg-gradient-to-br from-indigo-50 to-indigo-100 p-6 hover:shadow-md transition-shadow">
                        <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-lg bg-indigo-600">
                            <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"
                                />
                            </svg>
                        </div>
                        <h3 class="mb-2 font-bold text-gray-900">Kualitas Air</h3>
                        <p class="text-sm text-gray-700">Monitoring kualitas air sungai untuk kesehatan lingkungan</p>
                    </div>

                    <div class="rounded-xl bg-gradient-to-br from-purple-50 to-purple-100 p-6 hover:shadow-md transition-shadow">
                        <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-lg bg-purple-600">
                            <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"
                                />
                            </svg>
                        </div>
                        <h3 class="mb-2 font-bold text-gray-900">Permohonan Data</h3>
                        <p class="text-sm text-gray-700">Layanan permintaan data historis untuk penelitian dan analisis</p>
                    </div>
                </div>
            </div>
            <!-- Technology Section -->
            <div class="mb-12 rounded-2xl bg-white p-8 shadow-lg">
                <h2 class="mb-8 text-3xl font-bold text-gray-900">Teknologi yang Digunakan</h2>
                <div class="mx-auto grid max-w-2xl grid-cols-1 gap-6 md:grid-cols-2">
                    <div class="rounded-xl bg-gradient-to-br from-blue-50 to-blue-100 p-8 text-center hover:shadow-md transition-shadow">
                        <div class="mb-3 text-4xl">🐘</div>
                        <h4 class="font-bold text-gray-900">Laravel</h4>
                        <p class="text-sm text-gray-600 mt-2">Backend Framework</p>
                    </div>
                    <div class="rounded-xl bg-gradient-to-br from-green-50 to-green-100 p-8 text-center hover:shadow-md transition-shadow">
                        <div class="mb-3 text-4xl">⚡</div>
                        <h4 class="font-bold text-gray-900">Vue.js</h4>
                        <p class="text-sm text-gray-600 mt-2">Frontend Framework</p>
                    </div>
                </div>
            </div>

            <!-- Team Section -->
            <div class="mb-12 rounded-2xl bg-white p-8 shadow-lg">
                <h2 class="mb-4 text-center text-3xl font-bold text-gray-900">Tim Kami</h2>
                <p class="mx-auto mb-10 max-w-2xl text-center text-gray-600">
                    Kenali tim yang berdedikasi di balik Sistem Pemantau Risiko Banjir Samarinda
                </p>

                <!-- Project Lead -->
                <div class="mb-10 flex justify-center">
                    <div class="mx-auto max-w-sm rounded-2xl bg-gradient-to-br from-blue-50 to-blue-100 p-8 shadow-md hover:shadow-lg transition-shadow">
                        <div class="flex flex-col items-center">
                            <div class="mb-4 flex h-20 w-20 items-center justify-center rounded-lg bg-blue-600 text-white shadow-lg">
                                <svg class="h-12 w-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"
                                    />
                                </svg>
                            </div>
                            <h3 class="mb-1 text-lg font-bold text-gray-900">Muhammad Zidane Abdul Kadir</h3>
                            <p class="mb-3 text-sm font-medium text-blue-600">Project Lead</p>
                            <p class="text-center text-sm text-gray-600">Arsitektur Sistem dan Manajemen Proyek</p>
                        </div>
                    </div>
                </div>

                <!-- Team Members -->
                <div class="grid grid-cols-1 gap-6 md:grid-cols-3">
                    <!-- Lead Developers -->
                    <div class="rounded-2xl bg-gradient-to-br from-green-50 to-green-100 p-6 shadow-md hover:shadow-lg transition-shadow">
                        <div class="mb-4 text-center">
                            <div class="mb-4 flex justify-center">
                                <div class="flex h-16 w-16 items-center justify-center rounded-lg bg-green-600 text-white shadow">
                                    <svg class="h-10 w-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M5 12h14M5 12a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v4a2 2 0 01-2 2M5 12a2 2 0 00-2 2v4a2 2 0 002 2h14a2 2 0 002-2v-4a2 2 0 00-2-2m-2-4h.01M17 16h.01"
                                        />
                                    </svg>
                                </div>
                            </div>
                            <p class="text-sm font-bold uppercase tracking-wide text-green-600">Lead Developer</p>
                        </div>
                        <div class="space-y-3 text-center">
                            <div>
                                <h3 class="text-sm font-bold text-gray-900">Denny Mulia</h3>
                            </div>
                            <div>
                                <h3 class="text-sm font-bold text-gray-900">Muhammad Rafli Adila Risdi Saputra</h3>
                            </div>
                            <div class="border-t border-green-200 pt-3">
                                <p class="text-xs text-gray-600">Pengembangan Backend dan Integrasi API</p>
                            </div>
                        </div>
                    </div>

                    <!-- Frontend Developers -->
                    <div class="rounded-2xl bg-gradient-to-br from-purple-50 to-purple-100 p-6 shadow-md hover:shadow-lg transition-shadow">
                        <div class="mb-4 text-center">
                            <div class="mb-4 flex justify-center">
                                <div class="flex h-16 w-16 items-center justify-center rounded-lg bg-purple-600 text-white shadow">
                                    <svg class="h-10 w-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"
                                        />
                                    </svg>
                                </div>
                            </div>
                            <p class="text-sm font-bold uppercase tracking-wide text-purple-600">Frontend Developer</p>
                        </div>
                        <div class="space-y-3 text-center">
                            <div>
                                <h3 class="text-sm font-bold text-gray-900">Ahmad Rafi Irsyad</h3>
                            </div>
                            <div>
                                <h3 class="text-sm font-bold text-gray-900">Hammam Syamil</h3>
                            </div>
                            <div class="border-t border-purple-200 pt-3">
                                <p class="text-xs text-gray-600">Desain UI/UX dan Implementasi Frontend</p>
                            </div>
                        </div>
                    </div>

                    <!-- Data Analysts -->
                    <div class="rounded-2xl bg-gradient-to-br from-orange-50 to-orange-100 p-6 shadow-md hover:shadow-lg transition-shadow">
                        <div class="mb-4 text-center">
                            <div class="mb-4 flex justify-center">
                                <div class="flex h-16 w-16 items-center justify-center rounded-lg bg-orange-600 text-white shadow">
                                    <svg class="h-10 w-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"
                                        />
                                    </svg>
                                </div>
                            </div>
                            <p class="text-sm font-bold uppercase tracking-wide text-orange-600">Data Analyst</p>
                        </div>
                        <div class="space-y-3 text-center">
                            <div>
                                <h3 class="text-sm font-bold text-gray-900">Athasyahri Syawal Fahrezy</h3>
                            </div>
                            <div>
                                <h3 class="text-sm font-bold text-gray-900">Tua Delima Sitompul</h3>
                            </div>
                            <div class="border-t border-orange-200 pt-3">
                                <p class="text-xs text-gray-600">Analisis Data Cuaca dan Pelaporan</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Contact Section -->
            <div class="rounded-2xl bg-gradient-to-r from-gray-800 to-gray-900 p-12 text-white shadow-xl">
                <h2 class="mb-8 text-center text-3xl font-bold">Hubungi Kami</h2>
                <div class="mx-auto max-w-md">
                    <div class="text-center">
                        <div class="mb-4 flex items-center justify-center">
                            <svg class="mr-3 h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"
                                />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            <h3 class="text-lg font-bold">Alamat</h3>
                        </div>
                        <p class="text-blue-100">
                            Kota Samarinda<br />
                            Kalimantan Timur, Indonesia
                        </p>
                    </div>
                </div>
            </div>
        </main>
    </div>
</template>

<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import Header from '../Components/dashboard/Header.vue';
</script>
