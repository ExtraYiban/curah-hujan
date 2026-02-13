<template>
  <Head title="Curah Hujan" />

  <div class="min-h-screen bg-gray-50 font-sans">
    <Header />
    <main class="max-w-7xl mx-auto p-8">
      <!-- Data BMKG Heading -->
      <h2 class="text-3xl font-bold text-gray-900 mb-6">Data BMKG (Per 3 jam)</h2>

      <!-- Three Sections -->
      <div class="space-y-6">
        <!-- Presipitasi Section -->
        <div class="bg-white rounded-2xl shadow-lg p-8">
          <h3 class="text-xl font-bold text-gray-900 mb-4">Presipitasi</h3>
          <div class="relative h-80 bg-gray-50 rounded-lg p-4">
            <!-- Y-axis label (mm) -->
            <div class="absolute left-16 top-2 text-xs text-gray-600 font-medium">
              mm
            </div>

            <!-- Y-axis intensity labels -->
            <div class="absolute left-0 top-12 bottom-12 w-14 flex flex-col justify-between text-xs text-gray-500">
              <span class="text-left">Lebat</span>
              <span class="text-left">Sedang</span>
              <span class="text-left">Ringan</span>
            </div>

            <!-- Chart area -->
            <div class="ml-16 mr-4 h-full pb-8 pt-6 relative">
              <svg class="w-full h-full" viewBox="0 0 800 240" preserveAspectRatio="none">
                <!-- Grid lines -->
                <line x1="0" y1="0" x2="800" y2="0" stroke="#e5e7eb" stroke-width="1" vector-effect="non-scaling-stroke"/>
                <line x1="0" y1="60" x2="800" y2="60" stroke="#e5e7eb" stroke-width="1" vector-effect="non-scaling-stroke"/>
                <line x1="0" y1="120" x2="800" y2="120" stroke="#e5e7eb" stroke-width="1" vector-effect="non-scaling-stroke"/>
                <line x1="0" y1="180" x2="800" y2="180" stroke="#e5e7eb" stroke-width="1" vector-effect="non-scaling-stroke"/>
                <line x1="0" y1="240" x2="800" y2="240" stroke="#e5e7eb" stroke-width="1" vector-effect="non-scaling-stroke"/>

                <!-- Bar chart (rainfall data per 3 hours) -->
                <rect x="50" y="180" width="60" height="60" fill="rgb(6, 182, 212)" />
                <rect x="150" y="120" width="60" height="120" fill="rgb(6, 182, 212)" />
                <rect x="250" y="150" width="60" height="90" fill="rgb(6, 182, 212)" />
                <rect x="350" y="100" width="60" height="140" fill="rgb(6, 182, 212)" />
                <rect x="450" y="140" width="60" height="100" fill="rgb(6, 182, 212)" />
                <rect x="550" y="160" width="60" height="80" fill="rgb(6, 182, 212)" />
                <rect x="650" y="190" width="60" height="50" fill="rgb(6, 182, 212)" />
              </svg>

              <!-- X-axis labels (hours) -->
              <div class="absolute bottom-0 left-0 right-0 flex justify-between text-xs text-gray-500 px-2">
                <span>00</span>
                <span>03</span>
                <span>06</span>
                <span>09</span>
                <span>12</span>
                <span>15</span>
                <span>18</span>
                <span>21</span>
              </div>
            </div>
          </div>
        </div>

        <!-- Data Prediksi: Curah hujan Section -->
        <div class="bg-white rounded-2xl shadow-lg p-8">
          <h3 class="text-xl font-bold text-gray-900 mb-4">Data Prediksi: Curah hujan</h3>
          <div class="relative h-64 bg-gray-50 rounded-lg p-4">
            <!-- Chart placeholder with line -->
            <svg class="w-full h-full" viewBox="0 0 600 200" preserveAspectRatio="none">
              <defs>
                <linearGradient id="bmkgGradient" x1="0%" y1="0%" x2="0%" y2="100%">
                  <stop offset="0%" style="stop-color:rgb(59, 130, 246);stop-opacity:0.3" />
                  <stop offset="100%" style="stop-color:rgb(59, 130, 246);stop-opacity:0.05" />
                </linearGradient>
              </defs>

              <!-- Multiple rainfall curves -->
              <path
                :d="bmkgChartPath1"
                fill="none"
                stroke="rgb(147, 197, 253)"
                stroke-width="3"
                vector-effect="non-scaling-stroke"
              />
              <path
                :d="bmkgChartPath2"
                fill="url(#bmkgGradient)"
                stroke="rgb(59, 130, 246)"
                stroke-width="3"
                vector-effect="non-scaling-stroke"
              />
              <path
                :d="bmkgChartPath3"
                fill="none"
                stroke="rgb(96, 165, 250)"
                stroke-width="3"
                vector-effect="non-scaling-stroke"
              />
            </svg>
          </div>
        </div>

        <!-- Random Forest Section -->
        <div class="bg-white rounded-2xl shadow-lg p-8">
          <h3 class="text-xl font-bold text-gray-900 mb-4">Random Forest</h3>
          <div class="relative h-64 bg-gray-50 rounded-lg p-4">
            <!-- Chart placeholder with line -->
            <svg class="w-full h-full" viewBox="0 0 600 200" preserveAspectRatio="none">
              <defs>
                <linearGradient id="forestGradient" x1="0%" y1="0%" x2="0%" y2="100%">
                  <stop offset="0%" style="stop-color:rgb(34, 197, 94);stop-opacity:0.3" />
                  <stop offset="100%" style="stop-color:rgb(34, 197, 94);stop-opacity:0.05" />
                </linearGradient>
              </defs>
              <path
                :d="forestChartPath"
                fill="url(#forestGradient)"
                stroke="rgb(34, 197, 94)"
                stroke-width="3"
                vector-effect="non-scaling-stroke"
              />
            </svg>
          </div>
        </div>

        <!-- Vector Regression Section -->
        <div class="bg-white rounded-2xl shadow-lg p-8">
          <h3 class="text-xl font-bold text-gray-900 mb-4">Vector Regression</h3>
          <div class="relative h-64 bg-gray-50 rounded-lg p-4">
            <!-- Chart placeholder with line -->
            <svg class="w-full h-full" viewBox="0 0 600 200" preserveAspectRatio="none">
              <defs>
                <linearGradient id="vectorGradient" x1="0%" y1="0%" x2="0%" y2="100%">
                  <stop offset="0%" style="stop-color:rgb(249, 115, 22);stop-opacity:0.3" />
                  <stop offset="100%" style="stop-color:rgb(249, 115, 22);stop-opacity:0.05" />
                </linearGradient>
              </defs>
              <path
                :d="vectorChartPath"
                fill="url(#vectorGradient)"
                stroke="rgb(249, 115, 22)"
                stroke-width="3"
                vector-effect="non-scaling-stroke"
              />
            </svg>
          </div>
        </div>
      </div>
    </main>
  </div>
</template>

<script setup lang="ts">
import { Head } from '@inertiajs/vue3'
import Header from '../components/dashboard/Header.vue'
import { computed } from 'vue'

// BMKG chart paths - multiple curves showing rainfall data
const bmkgChartPath1 = computed(() => {
  const points = [
    { x: 0, y: 180 },
    { x: 100, y: 160 },
    { x: 200, y: 170 },
    { x: 300, y: 150 },
    { x: 400, y: 165 },
    { x: 500, y: 140 },
    { x: 600, y: 155 },
  ]
  return points.map((point, index) => `${index === 0 ? 'M' : 'L'} ${point.x} ${point.y}`).join(' ')
})

const bmkgChartPath2 = computed(() => {
  const points = [
    { x: 0, y: 200 },
    { x: 100, y: 190 },
    { x: 200, y: 150 },
    { x: 300, y: 120 },
    { x: 400, y: 100 },
    { x: 500, y: 90 },
    { x: 600, y: 110 },
  ]
  const pathData = points.map((point, index) => `${index === 0 ? 'M' : 'L'} ${point.x} ${point.y}`).join(' ')
  return `${pathData} L 600 280 L 0 280 Z`
})

const bmkgChartPath3 = computed(() => {
  const points = [
    { x: 0, y: 220 },
    { x: 100, y: 210 },
    { x: 200, y: 200 },
    { x: 300, y: 180 },
    { x: 400, y: 190 },
    { x: 500, y: 170 },
    { x: 600, y: 185 },
  ]
  return points.map((point, index) => `${index === 0 ? 'M' : 'L'} ${point.x} ${point.y}`).join(' ')
})

// LSTM prediction chart
const lstmChartPath = computed(() => {
  const points = [
    { x: 0, y: 150 },
    { x: 100, y: 140 },
    { x: 200, y: 120 },
    { x: 300, y: 110 },
    { x: 400, y: 100 },
    { x: 500, y: 95 },
    { x: 600, y: 105 },
  ]
  const pathData = points.map((point, index) => `${index === 0 ? 'M' : 'L'} ${point.x} ${point.y}`).join(' ')
  return `${pathData} L 600 200 L 0 200 Z`
})

// Random Forest prediction chart
const forestChartPath = computed(() => {
  const points = [
    { x: 0, y: 160 },
    { x: 100, y: 145 },
    { x: 200, y: 130 },
    { x: 300, y: 115 },
    { x: 400, y: 105 },
    { x: 500, y: 100 },
    { x: 600, y: 110 },
  ]
  const pathData = points.map((point, index) => `${index === 0 ? 'M' : 'L'} ${point.x} ${point.y}`).join(' ')
  return `${pathData} L 600 200 L 0 200 Z`
})

// Vector Regression prediction chart
const vectorChartPath = computed(() => {
  const points = [
    { x: 0, y: 155 },
    { x: 100, y: 142 },
    { x: 200, y: 128 },
    { x: 300, y: 112 },
    { x: 400, y: 102 },
    { x: 500, y: 98 },
    { x: 600, y: 108 },
  ]
  const pathData = points.map((point, index) => `${index === 0 ? 'M' : 'L'} ${point.x} ${point.y}`).join(' ')
  return `${pathData} L 600 200 L 0 200 Z`
})
</script>
