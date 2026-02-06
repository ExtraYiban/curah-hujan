<template>
  <Head title="Tentang Kami" />

  <div class="min-h-screen bg-gray-50 font-sans">
    <Header />
    <main class="max-w-7xl mx-auto p-8">
      <!-- Hero Section -->
      <div class="bg-linear-to-r from-blue-600 to-blue-800 rounded-lg shadow-lg p-12 text-white mb-8">
        <h1 class="text-4xl font-bold mb-4">Tentang Kami</h1>
        <p class="text-xl opacity-90">
            Sistem Pemantau Risiko Banjir Samarinda
        </p>
      </div>

      <!-- About Section -->
      <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
        <div class="bg-white rounded-lg shadow p-8">
          <div class="flex items-center mb-4">
            <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mr-4">
              <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
              </svg>
            </div>
            <h2 class="text-2xl font-bold text-gray-900">Visi Kami</h2>
          </div>
          <p class="text-gray-700 leading-relaxed">
            Menjadi sistem informasi terdepan dalam monitoring dan pelaporan data curah hujan,
            tinggi muka air, dan potensi banjir di Kota Samarinda untuk mendukung pengambilan
            keputusan yang cepat dan akurat dalam penanggulangan bencana.
          </p>
        </div>

        <div class="bg-white rounded-lg shadow p-8">
          <div class="flex items-center mb-4">
            <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center mr-4">
              <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
              </svg>
            </div>
            <h2 class="text-2xl font-bold text-gray-900">Misi Kami</h2>
          </div>
          <ul class="text-gray-700 leading-relaxed space-y-2">
            <li class="flex items-start">
              <span class="text-green-600 mr-2">•</span>
              <span>Menyediakan data curah hujan dan iklim yang akurat dan real-time</span>
            </li>
            <li class="flex items-start">
              <span class="text-green-600 mr-2">•</span>
              <span>Memantau tinggi muka air dan debit sungai secara berkelanjutan</span>
            </li>
            <li class="flex items-start">
              <span class="text-green-600 mr-2">•</span>
              <span>Memberikan informasi kualitas air yang mudah diakses</span>
            </li>
            <li class="flex items-start">
              <span class="text-green-600 mr-2">•</span>
              <span>Mendukung mitigasi bencana banjir di wilayah Samarinda</span>
            </li>
          </ul>
        </div>
      </div>

      <!-- Features Section -->
      <div class="bg-white rounded-lg shadow p-8 mb-8">
        <h2 class="text-2xl font-bold text-gray-900 mb-6">Fitur Sistem</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
          <div class="p-6 bg-blue-50 rounded-lg">
            <div class="w-10 h-10 bg-blue-600 rounded-lg flex items-center justify-center mb-3">
              <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 15a4 4 0 004 4h9a5 5 0 10-.1-9.999 5.002 5.002 0 10-9.78 2.096A4.001 4.001 0 003 15z" />
              </svg>
            </div>
            <h3 class="font-semibold text-gray-900 mb-2">Monitoring Curah Hujan</h3>
            <p class="text-sm text-gray-600">
              Pemantauan intensitas curah hujan secara real-time dengan data akurat dari BMKG
            </p>
          </div>

          <div class="p-6 bg-cyan-50 rounded-lg">
            <div class="w-10 h-10 bg-cyan-600 rounded-lg flex items-center justify-center mb-3">
              <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
              </svg>
            </div>
            <h3 class="font-semibold text-gray-900 mb-2">Data TMA & Debit</h3>
            <p class="text-sm text-gray-600">
              Informasi tinggi muka air dan debit sungai untuk antisipasi banjir
            </p>
          </div>

          <div class="p-6 bg-green-50 rounded-lg">
            <div class="w-10 h-10 bg-green-600 rounded-lg flex items-center justify-center mb-3">
              <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
              </svg>
            </div>
            <h3 class="font-semibold text-gray-900 mb-2">Peta Interaktif</h3>
            <p class="text-sm text-gray-600">
              Visualisasi peta banjir dan titik monitoring yang mudah dipahami
            </p>
          </div>

          <div class="p-6 bg-yellow-50 rounded-lg">
            <div class="w-10 h-10 bg-yellow-600 rounded-lg flex items-center justify-center mb-3">
              <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z" />
              </svg>
            </div>
            <h3 class="font-semibold text-gray-900 mb-2">Data Iklim</h3>
            <p class="text-sm text-gray-600">
              Informasi cuaca dan kondisi iklim terkini untuk wilayah Samarinda
            </p>
          </div>

          <div class="p-6 bg-indigo-50 rounded-lg">
            <div class="w-10 h-10 bg-indigo-600 rounded-lg flex items-center justify-center mb-3">
              <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z" />
              </svg>
            </div>
            <h3 class="font-semibold text-gray-900 mb-2">Kualitas Air</h3>
            <p class="text-sm text-gray-600">
              Monitoring kualitas air sungai untuk kesehatan lingkungan
            </p>
          </div>

          <div class="p-6 bg-purple-50 rounded-lg">
            <div class="w-10 h-10 bg-purple-600 rounded-lg flex items-center justify-center mb-3">
              <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
              </svg>
            </div>
            <h3 class="font-semibold text-gray-900 mb-2">Permohonan Data</h3>
            <p class="text-sm text-gray-600">
              Layanan permintaan data historis untuk penelitian dan analisis
            </p>
          </div>
        </div>
      </div>

      <!-- Technology Section -->
      <div class="bg-white rounded-lg shadow p-8 mb-8">
        <h2 class="text-2xl font-bold text-gray-900 mb-6">Teknologi yang Digunakan</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 max-w-2xl mx-auto">
          <div class="p-4 bg-gray-50 rounded-lg text-center">
            <div class="text-3xl mb-2">🐘</div>
            <h4 class="font-semibold text-gray-900">Laravel</h4>
            <p class="text-xs text-gray-600">Backend Framework</p>
          </div>
          <div class="p-4 bg-gray-50 rounded-lg text-center">
            <div class="text-3xl mb-2">⚡</div>
            <h4 class="font-semibold text-gray-900">Vue.js</h4>
            <p class="text-xs text-gray-600">Frontend Framework</p>
          </div>
        </div>
      </div>

      <!-- Team Section -->
      <div class="bg-white rounded-lg shadow p-8 mb-8">
        <h2 class="text-2xl font-bold text-gray-900 mb-6 text-center">Tim Kami</h2>
        <p class="text-gray-600 text-center mb-8 max-w-2xl mx-auto">
          Kenali tim yang berdedikasi di balik Sistem Pemantau Risiko Banjir Samarinda
        </p>

        <!-- Project Lead -->
        <div class="mb-8">
          <div class="bg-linear-to-br from-blue-50 to-blue-100 rounded-lg p-8 hover:shadow-lg transition-shadow max-w-md mx-auto">
            <div class="flex flex-col items-center">
              <div class="w-20 h-20 bg-blue-600 rounded-lg mb-4 flex items-center justify-center text-white shadow-lg">
                <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                </svg>
              </div>
              <h3 class="font-bold text-gray-900 text-lg mb-1">Muhammad Zidane Abdul Kadir</h3>
              <p class="text-sm text-blue-600 font-medium mb-3">Project Lead</p>
              <p class="text-sm text-gray-600 text-center">
                Arsitektur Sistem dan Manajemen Proyek
              </p>
            </div>
          </div>
        </div>

        <!-- Team Members -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
          <!-- Lead Developers -->
          <div class="bg-linear-to-br from-green-50 to-green-100 rounded-lg p-6 hover:shadow-lg transition-shadow">
            <div class="text-center mb-4">
              <div class="flex justify-center mb-4">
                <div class="w-16 h-16 bg-green-600 rounded-lg flex items-center justify-center text-white shadow">
                  <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M5 12a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v4a2 2 0 01-2 2M5 12a2 2 0 00-2 2v4a2 2 0 002 2h14a2 2 0 002-2v-4a2 2 0 00-2-2m-2-4h.01M17 16h.01" />
                  </svg>
                </div>
              </div>
              <p class="text-sm text-green-600 font-bold uppercase tracking-wide mb-4">Lead Developer</p>
            </div>
            <div class="space-y-3">
              <div class="text-center">
                <h3 class="font-bold text-gray-900 text-sm">Nurul Latifa</h3>
              </div>
              <div class="text-center">
                <h3 class="font-bold text-gray-900 text-sm">Setriyani</h3>
              </div>
              <div class="border-t border-green-200 pt-3">
                <p class="text-xs text-gray-600 text-center">
                  Pengembangan Backend dan Integrasi API
                </p>
              </div>
            </div>
          </div>

          <!-- Frontend Developers -->
          <div class="bg-linear-to-br from-purple-50 to-purple-100 rounded-lg p-6 hover:shadow-lg transition-shadow">
            <div class="text-center mb-4">
              <div class="flex justify-center mb-4">
                <div class="w-16 h-16 bg-purple-600 rounded-lg flex items-center justify-center text-white shadow">
                  <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4" />
                  </svg>
                </div>
              </div>
              <p class="text-sm text-purple-600 font-bold uppercase tracking-wide mb-4">Frontend Developer</p>
            </div>
            <div class="space-y-3">
              <div class="text-center">
                <h3 class="font-bold text-gray-900 text-sm">Alya Kamilla Fauziah</h3>
              </div>
              <div class="text-center">
                <h3 class="font-bold text-gray-900 text-sm">Mutia Rahmah</h3>
              </div>
              <div class="border-t border-purple-200 pt-3">
                <p class="text-xs text-gray-600 text-center">
                  Desain UI/UX dan Implementasi Frontend
                </p>
              </div>
            </div>
          </div>

          <!-- Data Analysts -->
          <div class="bg-linear-to-br from-orange-50 to-orange-100 rounded-lg p-6 hover:shadow-lg transition-shadow">
            <div class="text-center mb-4">
              <div class="flex justify-center mb-4">
                <div class="w-16 h-16 bg-orange-600 rounded-lg flex items-center justify-center text-white shadow">
                  <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                  </svg>
                </div>
              </div>
              <p class="text-sm text-orange-600 font-bold uppercase tracking-wide mb-4">Data Analyst</p>
            </div>
            <div class="space-y-3">
              <div class="text-center">
                <h3 class="font-bold text-gray-900 text-sm">Athasyahri Syawal Fahrezy</h3>
              </div>
              <div class="text-center">
                <h3 class="font-bold text-gray-900 text-sm">Tua Delima Sitompul</h3>
              </div>
              <div class="border-t border-orange-200 pt-3">
                <p class="text-xs text-gray-600 text-center">
                  Analisis Data Cuaca dan Pelaporan
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Contact Section -->
      <div class="bg-linear-to-r from-gray-800 to-gray-900 rounded-lg shadow-lg p-8 text-white">
        <h2 class="text-2xl font-bold mb-4 text-center">Hubungi Kami</h2>
        <div class="max-w-md mx-auto">
          <div class="text-center">
            <div class="flex items-center justify-center mb-2">
              <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
              </svg>
              <h3 class="font-semibold">Alamat</h3>
            </div>
            <p class="text-sm opacity-90">
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
import { Head } from '@inertiajs/vue3'
import Header from '../components/dashboard/Header.vue'
</script>
