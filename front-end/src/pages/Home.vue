<template>
  <div class="min-h-screen bg-gray-50 font-sans">
    <Header />
    <main class="max-w-350 mx-auto p-8 flex flex-col gap-8">
      <div class="grid grid-cols-1 lg:grid-cols-[1.2fr_1fr] gap-8">
        <div class="h-100">
          <SeaLevelChart />
        </div>
        <div>
          <WeatherSection />
        </div>
      </div>
      <div class="w-full">
        <FloodMap />
      </div>
    </main>
  </div>
</template>

<script setup>
import Header from '../components/dashboard/Header.vue'
import SeaLevelChart from '../components/dashboard/SeaLevelChart.vue'
import WeatherSection from '../components/dashboard/WeatherSection.vue'
import FloodMap from '../components/dashboard/FloodMap.vue'
</script>
