```vue
<script setup>
import { ref } from 'vue'

const isMenuOpen = ref(false)
let closeTimeout = null

const openMenu = () => {
  if (closeTimeout) clearTimeout(closeTimeout)
  isMenuOpen.value = true
}

const closeMenu = () => {
  closeTimeout = setTimeout(() => {
    isMenuOpen.value = false
  }, 200)
}
</script>

<template>
  <header class="flex justify-between items-center px-8 py-4 bg-white shadow-sm sticky top-0 z-50">
    <div class="flex items-center gap-4">
      <div class="w-10 h-10 bg-gray-300 rounded"></div>
      <div>
        <h1 class="text-sm text-gray-600 font-normal m-0">Sistem Pemantau Resiko Banjir</h1>
        <h2 class="text-lg text-gray-800 font-bold m-0">Samarinda</h2>
      </div>
    </div>
    <nav class="hidden md:flex gap-8">
      <a 
        href="#" 
        class="text-gray-500 font-medium hover:text-gray-800"
        @mouseenter="openMenu" 
        @mouseleave="closeMenu"
      >Profil</a>
      <a 
        href="#" 
        class="text-gray-500 font-medium hover:text-gray-800"
        @mouseenter="openMenu" 
        @mouseleave="closeMenu"
      >Cuaca</a>
      <a 
        href="#" 
        class="text-gray-500 font-medium hover:text-gray-800"
        @mouseenter="openMenu" 
        @mouseleave="closeMenu"
      >Map</a>
      <a 
        href="#" 
        class="text-gray-500 font-medium hover:text-gray-800"
        @mouseenter="openMenu" 
        @mouseleave="closeMenu"
      >Ketinggian Air Laut</a>
    </nav>
    <button 
      @click="isMenuOpen = !isMenuOpen"
      class="flex items-center gap-2 px-4 py-2 border border-gray-200 rounded-full bg-white cursor-pointer font-medium hover:bg-gray-50 transition-colors"
      :class="{ 'bg-gray-50 ring-2 ring-gray-100': isMenuOpen }"
    >
      <span>📞</span> Contact Center
    </button>

    <!-- Dropdown Menu / Modal -->
    <div 
      v-if="isMenuOpen" 
      class="absolute top-21.25 left-0 right-0 mx-auto w-full max-w-6xl px-8 animate-fade-in-down pointer-events-none"
      @mouseenter="openMenu"
      @mouseleave="closeMenu"
    >
      <div class="bg-white rounded-3xl p-10 shadow-2xl border border-gray-100 grid grid-cols-2 gap-16 pointer-events-auto">
        <!-- Left Column -->
        <div class="flex flex-col gap-4">
          <div class="h-6 bg-gray-200 rounded w-24 mb-2"></div>
          
          <div class="flex gap-4">
            <div class="h-4 bg-gray-200 rounded w-3/4"></div>
            <div class="h-4 bg-gray-200 rounded w-1/6"></div>
          </div>
          
          <div class="flex gap-4">
            <div class="h-4 bg-gray-200 rounded w-1/2"></div>
            <div class="h-4 bg-gray-200 rounded w-1/3"></div>
          </div>

          <div class="h-4 bg-gray-200 rounded w-1/3"></div>
          
          <div class="h-4 bg-gray-200 rounded w-3/4"></div>
          
          <div class="flex gap-4">
            <div class="h-4 bg-gray-200 rounded w-1/4"></div>
            <div class="h-4 bg-gray-200 rounded w-1/2"></div>
          </div>

          <div class="flex gap-4 mt-2">
             <div class="h-4 bg-gray-200 rounded w-1/6"></div>
             <div class="h-4 bg-gray-200 rounded w-1/6"></div>
             <div class="h-4 bg-gray-200 rounded w-1/3"></div>
          </div>

           <div class="h-4 bg-gray-200 rounded w-3/4 mt-2"></div>
        </div>

        <!-- Right Column -->
        <div class="flex flex-col gap-4">
           <div class="h-6 bg-gray-200 rounded w-24 mb-2"></div>
          
          <div class="flex gap-4">
            <div class="h-4 bg-gray-200 rounded w-2/3"></div>
            <div class="h-4 bg-gray-200 rounded w-1/5"></div>
          </div>
          
          <div class="flex gap-4">
            <div class="h-4 bg-gray-200 rounded w-1/3"></div>
            <div class="h-4 bg-gray-200 rounded w-1/2"></div>
          </div>

          <div class="h-4 bg-gray-200 rounded w-1/2"></div>
          
          <div class="h-4 bg-gray-200 rounded w-2/3"></div>
          
          <div class="flex gap-4">
            <div class="h-4 bg-gray-200 rounded w-1/3"></div>
            <div class="h-4 bg-gray-200 rounded w-1/3"></div>
          </div>

          <div class="flex gap-4 mt-2">
             <div class="h-4 bg-gray-200 rounded w-1/4"></div>
             <div class="h-4 bg-gray-200 rounded w-1/4"></div>
          </div>

           <div class="h-4 bg-gray-200 rounded w-5/6 mt-2"></div>
        </div>
      </div>
    </div>
  </header>
</template>
```
