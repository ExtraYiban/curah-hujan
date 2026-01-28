```vue
<script setup>
import { RouterLink } from 'vue-router'
import { useRoute } from 'vue-router'

const route = useRoute()
</script>

<template>
  <header class="bg-white border-b border-gray-200 sticky top-0 z-50">
    <nav class="max-w-7xl mx-auto px-8 py-6 flex items-center gap-12">
      <h1 class="text-2xl font-bold text-gray-900">Curah Hujan</h1>
      <ul class="flex gap-8">
        <li>
          <RouterLink 
            to="/" 
            class="text-gray-700 hover:text-blue-600 font-medium transition-colors"
            :class="{ 'text-blue-600 border-b-2 border-blue-600 pb-1': route.path === '/' }"
          >
            Beranda
          </RouterLink>
        </li>
        <li>
          <RouterLink 
            to="/curah-hujan"
            class="text-gray-700 hover:text-blue-600 font-medium transition-colors"
            :class="{ 'text-blue-600 border-b-2 border-blue-600 pb-1': route.path === '/curah-hujan' }"
          >
            Curah Hujan
          </RouterLink>
        </li>
        <li>
          <RouterLink 
            to="/tma-debit"
            class="text-gray-700 hover:text-blue-600 font-medium transition-colors"
            :class="{ 'text-blue-600 border-b-2 border-blue-600 pb-1': route.path === '/tma-debit' }"
          >
            TMA & Debit
          </RouterLink>
        </li>
        <li>
          <RouterLink 
            to="/iklim"
            class="text-gray-700 hover:text-blue-600 font-medium transition-colors"
            :class="{ 'text-blue-600 border-b-2 border-blue-600 pb-1': route.path === '/iklim' }"
          >
            Iklim
          </RouterLink>
        </li>
        <li>
          <RouterLink 
            to="/kualitas-air"
            class="text-gray-700 hover:text-blue-600 font-medium transition-colors"
            :class="{ 'text-blue-600 border-b-2 border-blue-600 pb-1': route.path === '/kualitas-air' }"
          >
            Kualitas Air
          </RouterLink>
        </li>
        <li>
          <RouterLink 
            to="/permohonan-data"
            class="text-gray-700 hover:text-blue-600 font-medium transition-colors"
            :class="{ 'text-blue-600 border-b-2 border-blue-600 pb-1': route.path === '/permohonan-data' }"
          >
            Permohonan Data
          </RouterLink>
        </li>
      </ul>
    </nav>
  </header>
</template>
```
