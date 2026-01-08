<template>
  <div class="flex flex-col gap-8">
    <!-- Alert Box -->
    <div class="bg-orange-100 border border-orange-200 rounded-lg p-4 flex items-center gap-4 text-orange-800">
      <div class="text-3xl">⚠️</div>
      <div class="grow">
        <h4 class="m-0 mb-2 text-base font-bold">Peringatan Dini Cuaca di Sempaja</h4>
        <p class="m-0 text-sm leading-relaxed">Des 2025 Pukul 08.24-11.00 WIB: Berpotensi Terjadi Hujan Sedang Hingga Lebat Disertai Petir Dan Angin Kencang Di Sempaja. <a href="#" class="text-blue-600 font-bold no-underline">Selengkapnya →</a></p>
      </div>
      <div class="flex gap-2">
        <button class="bg-transparent border border-orange-200 rounded-full w-8 h-8 cursor-pointer text-orange-800 flex items-center justify-center hover:bg-orange-200">←</button>
        <button class="bg-transparent border border-orange-200 rounded-full w-8 h-8 cursor-pointer text-orange-800 flex items-center justify-center hover:bg-orange-200">→</button>
      </div>
    </div>

    <!-- Weather Cards -->
    <div>
      <div class="flex justify-between items-center mb-4">
        <h3 class="m-0 text-2xl">Cuaca Saat Ini</h3>
        <div class="flex gap-2">
          <button class="px-4 py-2 border border-indigo-200 bg-indigo-50 text-indigo-600 rounded-full cursor-pointer text-sm font-medium">Saat Ini</button>
          <button class="px-4 py-2 border border-gray-200 bg-white rounded-full cursor-pointer text-sm hover:bg-gray-50">Hari Ini</button>
          <button class="px-4 py-2 border border-gray-200 bg-white rounded-full cursor-pointer text-sm hover:bg-gray-50">Lusa</button>
          <button class="px-4 py-2 border border-gray-200 bg-white rounded-full cursor-pointer text-sm hover:bg-gray-50">Besok</button>
        </div>
      </div>

      <div class="grid grid-cols-[repeat(auto-fill,minmax(120px,1fr))] gap-4">
        <div class="bg-white rounded-xl overflow-hidden shadow-sm" v-for="(weather, index) in weatherData" :key="index">
          <div class="p-4 bg-gray-50">
            <span class="text-xs text-gray-400 block mb-2">{{ weather.date }}</span>
            <div class="flex justify-between items-center">
              <span class="text-2xl font-bold text-gray-700">{{ weather.temp }}°C</span>
              <span class="text-2xl">{{ weather.icon }}</span>
            </div>
          </div>
          <div class="p-4 bg-gray-400 text-white text-center">
            <div class="text-sm font-bold mb-1">{{ weather.condition }}</div>
            <div class="text-[10px] opacity-90">Feels like {{ weather.feelsLike }}°Celsius</div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue'

const weatherData = ref([
  { date: '06 Okt', temp: 24, icon: '☁️', condition: 'Rainstorm', feelsLike: 22 },
  { date: '07 Okt', temp: 28, icon: '⛅', condition: 'Sunny cloudy', feelsLike: 27 },
  { date: '10 Okt', temp: 25, icon: '🌧️', condition: 'Rainstorm', feelsLike: 22 },
  { date: '06 Okt', temp: 24, icon: '⛈️', condition: 'Rainstorm', feelsLike: 22 },
  { date: '07 Okt', temp: 28, icon: '🌤️', condition: 'Sunny cloudy', feelsLike: 27 },
])
</script>
