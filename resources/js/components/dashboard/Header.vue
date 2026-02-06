<script setup lang="ts">
import { Link } from '@inertiajs/vue3'
</script>

<template>
  <header class="bg-white border-b border-gray-200 sticky top-0 z-50">
    <nav class="max-w-7xl mx-auto px-8 py-6 flex items-center gap-12">
      <h1 class="text-2xl font-bold text-gray-900">Curah Hujan</h1>
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
      </ul>
    </nav>
  </header>
</template>
