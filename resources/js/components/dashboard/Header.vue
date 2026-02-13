<script setup lang="ts">
import { Link, usePage } from '@inertiajs/vue3'
import { computed } from 'vue'

const page = usePage()
const user = computed(() => page.props.auth?.user)
</script>

<template>
  <header class="bg-white border-b border-gray-200 sticky top-0 z-50">
    <nav class="max-w-7xl mx-auto px-8 py-6 flex items-center justify-between">
      <div class="flex items-center gap-12">
        <Link href="/" class="flex items-center gap-3">
          <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-cyan-500 rounded-lg flex items-center justify-center">
            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 15a4 4 0 004 4h9a5 5 0 10-.1-9.999 5.002 5.002 0 10-9.78 2.096A4.001 4.001 0 003 15z"></path>
            </svg>
          </div>
          <h1 class="text-2xl font-bold text-gray-900">Curah Hujan</h1>
        </Link>

        <ul class="flex gap-8">
          <li>
            <Link
              href="/"
              class="text-gray-700 hover:text-blue-600 font-medium transition-colors"
              :class="{ 'text-blue-600 border-b-2 border-blue-600 pb-1': $page.component === 'Welcome' }"
            >
              Beranda
            </Link>
          </li>
          <li>
            <Link
              href="/curah-hujan"
              class="text-gray-700 hover:text-blue-600 font-medium transition-colors"
              :class="{ 'text-blue-600 border-b-2 border-blue-600 pb-1': $page.component === 'CurahHujan' }"
            >
              Curah Hujan
            </Link>
          </li>
          <li>
            <Link
              href="/tma-debit"
              class="text-gray-700 hover:text-blue-600 font-medium transition-colors"
              :class="{ 'text-blue-600 border-b-2 border-blue-600 pb-1': $page.component === 'TmaDebit' }"
            >
              TMA & Debit
            </Link>
          </li>
          <li>
            <Link
              href="/iklim"
              class="text-gray-700 hover:text-blue-600 font-medium transition-colors"
              :class="{ 'text-blue-600 border-b-2 border-blue-600 pb-1': $page.component === 'Iklim' }"
            >
              Iklim
            </Link>
          </li>
          <li>
            <Link
              href="/kualitas-air"
              class="text-gray-700 hover:text-blue-600 font-medium transition-colors"
              :class="{ 'text-blue-600 border-b-2 border-blue-600 pb-1': $page.component === 'KualitasAir' }"
            >
              Kualitas Air
            </Link>
          </li>
          <li>
            <Link
              href="/permohonan-data"
              class="text-gray-700 hover:text-blue-600 font-medium transition-colors"
              :class="{ 'text-blue-600 border-b-2 border-blue-600 pb-1': $page.component === 'PermohonanData' }"
            >
              Permohonan Data
            </Link>
          </li>
          <li>
            <Link
              href="/tentang-kami"
              class="text-gray-700 hover:text-blue-600 font-medium transition-colors"
              :class="{ 'text-blue-600 border-b-2 border-blue-600 pb-1': $page.component === 'TentangKami' }"
            >
              Tentang Kami
            </Link>
          </li>
        </ul>
      </div>

      <!-- Auth Buttons -->
      <div class="flex items-center gap-4">
        <template v-if="user">
          <Link
            href="/dashboard"
            class="text-gray-700 hover:text-blue-600 font-medium transition-colors flex items-center gap-2"
          >
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
            </svg>
            {{ user.name }}
          </Link>
          <Link
            href="/logout"
            method="post"
            as="button"
            class="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium rounded-lg transition-colors"
          >
            Keluar
          </Link>
        </template>
        <template v-else>
          <Link
            href="/login"
            class="px-4 py-2 text-gray-700 hover:text-blue-600 font-medium transition-colors"
          >
            Masuk
          </Link>
          <Link
            href="/register"
            class="px-5 py-2 bg-gradient-to-r from-blue-600 to-cyan-600 hover:from-blue-700 hover:to-cyan-700 text-white font-semibold rounded-lg shadow-md transition-all duration-200 transform hover:scale-105"
          >
            Daftar
          </Link>
        </template>
      </div>
    </nav>
  </header>
</template>
