<template>
  <div class="flex flex-col gap-6">
    <!-- Alert Box -->
    <div class="bg-linear-to-r from-orange-50 to-orange-100 border-l-4 border-orange-500 rounded-lg p-4 flex items-center gap-4 text-orange-900 shadow-sm">
      <div class="text-3xl shrink-0">⚠️</div>
      <div class="grow min-w-0">
        <h4 class="m-0 mb-1.5 text-base font-bold">Peringatan Dini Cuaca di Sempaja</h4>
        <p class="m-0 text-sm leading-relaxed">
          Des 2025 Pukul 08.24-11.00 WIB: Berpotensi Terjadi Hujan Sedang Hingga Lebat Disertai Petir Dan Angin Kencang Di Sempaja.
          <a href="#" class="text-blue-600 font-bold no-underline hover:underline">Selengkapnya →</a>
        </p>
      </div>
      <div class="flex gap-2 shrink-0">
        <button class="bg-white/50 hover:bg-white/80 border border-orange-300 rounded-lg w-8 h-8 cursor-pointer text-orange-800 flex items-center justify-center transition-colors">
          ←
        </button>
        <button class="bg-white/50 hover:bg-white/80 border border-orange-300 rounded-lg w-8 h-8 cursor-pointer text-orange-800 flex items-center justify-center transition-colors">
          →
        </button>
      </div>
    </div>

    <!-- Weather Cards -->
    <div>
      <div class="flex flex-wrap justify-between items-center mb-4 gap-3">
        <h3 class="m-0 text-2xl font-semibold text-gray-800">Cuaca Saat Ini</h3>
        <div class="flex gap-2 flex-wrap">
          <button
            @click="setFilter('now')"
            :class="[
              'px-3 py-1.5 border rounded-lg cursor-pointer text-xs font-semibold transition-all',
              selectedFilter === 'now'
                ? 'border-indigo-500 bg-indigo-500 text-white shadow-md'
                : 'border-gray-300 bg-white text-gray-600 hover:bg-gray-50 hover:border-gray-400'
            ]">
            Saat Ini
          </button>
          <button
            @click="setFilter('today')"
            :class="[
              'px-3 py-1.5 border rounded-lg cursor-pointer text-xs font-semibold transition-all',
              selectedFilter === 'today'
                ? 'border-indigo-500 bg-indigo-500 text-white shadow-md'
                : 'border-gray-300 bg-white text-gray-600 hover:bg-gray-50 hover:border-gray-400'
            ]">
            Hari Ini
          </button>
          <button
            @click="setFilter('tomorrow')"
            :class="[
              'px-3 py-1.5 border rounded-lg cursor-pointer text-xs font-semibold transition-all',
              selectedFilter === 'tomorrow'
                ? 'border-indigo-500 bg-indigo-500 text-white shadow-md'
                : 'border-gray-300 bg-white text-gray-600 hover:bg-gray-50 hover:border-gray-400'
            ]">
            Besok
          </button>
          <button
            @click="setFilter('dayAfter')"
            :class="[
              'px-3 py-1.5 border rounded-lg cursor-pointer text-xs font-semibold transition-all',
              selectedFilter === 'dayAfter'
                ? 'border-indigo-500 bg-indigo-500 text-white shadow-md'
                : 'border-gray-300 bg-white text-gray-600 hover:bg-gray-50 hover:border-gray-400'
            ]">
            Lusa
          </button>
        </div>
      </div>

      <div v-if="loading" class="flex justify-center items-center h-48 text-gray-500">
        <div class="text-center">
          <div class="text-2xl mb-2">⏳</div>
          <div>Memuat data cuaca...</div>
        </div>
      </div>

      <div v-else class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-3">
        <div
          class="bg-white rounded-xl overflow-hidden shadow-md hover:shadow-lg transition-shadow"
          v-for="(weather, index) in weatherData"
          :key="index">
          <div class="p-3 bg-linear-to-br from-gray-50 to-gray-100">
            <div class="flex justify-between items-start mb-3">
              <div>
                <div class="text-xs text-gray-500 font-medium">{{ weather.date }}</div>
                <div class="text-xs text-gray-400">{{ weather.time }}</div>
              </div>
              <span class="text-3xl">{{ weather.icon }}</span>
            </div>
            <div class="text-3xl font-bold text-gray-800">{{ weather.temp }}°C</div>
          </div>
          <div class="px-3 py-3 bg-gray-600 text-white flex flex-col justify-between h-20">
            <div class="text-sm font-semibold leading-tight min-h-10 flex items-center">
              {{ weather.condition }}
            </div>
            <div class="flex items-center justify-between text-xs gap-2 mt-1">
              <span class="opacity-90 shrink-0">{{ weather.feelsLike }}°C</span>
              <span class="opacity-90 flex items-center gap-1 justify-end shrink-0">
                <template v-if="weather.rainfall > 0">
                  <span>💧</span>
                  <span>{{ weather.rainfall }}</span>
                </template>
                <span v-else class="text-gray-500">—</span>
              </span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'

const weatherData = ref([])
const selectedFilter = ref('now')
const loading = ref(false)
const rawWeatherData = ref(null)

// Map BMKG weather codes to icons and conditions
const weatherCodeMap = {
  0: { icon: '☀️', condition: 'Cerah' },
  1: { icon: '☀️', condition: 'Cerah' },
  2: { icon: '⛅', condition: 'Cerah Berawan' },
  3: { icon: '☁️', condition: 'Berawan' },
  4: { icon: '🌫️', condition: 'Berawan Tebal' },
  5: { icon: '🌫️', condition: 'Udara Kabur' },
  10: { icon: '🌫️', condition: 'Asap' },
  45: { icon: '🌫️', condition: 'Kabut' },
  60: { icon: '🌦️', condition: 'Hujan Ringan' },
  61: { icon: '🌧️', condition: 'Hujan Ringan' },
  63: { icon: '🌧️', condition: 'Hujan Sedang' },
  65: { icon: '🌧️', condition: 'Hujan Lebat' },
  80: { icon: '🌧️', condition: 'Hujan Lokal' },
  95: { icon: '⛈️', condition: 'Hujan Petir' },
  97: { icon: '⛈️', condition: 'Hujan Petir' },
  17: { icon: '⛈️', condition: 'Petir' },
}

const getWeatherIcon = (code) => {
  return weatherCodeMap[code]?.icon || '☁️'
}

const getWeatherCondition = (code, desc) => {
  return weatherCodeMap[code]?.condition || desc || 'Berawan'
}

const formatDate = (dateString) => {
  const date = new Date(dateString)
  const months = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des']
  return `${date.getDate()} ${months[date.getMonth()]}`
}

const formatTime = (dateString) => {
  const date = new Date(dateString)
  return date.toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit' })
}

const fetchWeatherData = async () => {
  loading.value = true
  try {
    // Call Laravel backend API instead of BMKG directly
    const response = await fetch('/api/weather')
    const result = await response.json()

    if (result.success && result.data) {
      rawWeatherData.value = result.data
      updateDisplayedWeather()

      // Log cache info
      console.log('Weather data cached at:', result.cached_at)
      console.log('Cache expires in:', result.cache_expires_in, 'minutes')
    } else {
      throw new Error(result.message || 'Failed to fetch weather data')
    }
  } catch (error) {
    console.error('Failed to fetch weather data:', error)
    // Fallback data
    weatherData.value = [
      { date: '06 Feb', temp: 29, icon: '☁️', condition: 'Berawan', feelsLike: 27, time: '14:00', rainfall: 0.5 },
      { date: '06 Feb', temp: 26, icon: '⛅', condition: 'Cerah Berawan', feelsLike: 24, time: '17:00', rainfall: 0 },
      { date: '06 Feb', temp: 24, icon: '🌧️', condition: 'Hujan Ringan', feelsLike: 22, time: '20:00', rainfall: 2.7 },
      { date: '07 Feb', temp: 29, icon: '☁️', condition: 'Berawan', feelsLike: 27, time: '08:00', rainfall: 0.1 },
      { date: '07 Feb', temp: 31, icon: '⛅', condition: 'Cerah Berawan', feelsLike: 29, time: '11:00', rainfall: 0.3 },
    ]
  } finally {
    loading.value = false
  }
}

const updateDisplayedWeather = () => {
  if (!rawWeatherData.value?.data?.[0]?.cuaca) return

  const allForecasts = rawWeatherData.value.data[0].cuaca.flat()
  const now = new Date()

  let filtered = []

  switch (selectedFilter.value) {
    case 'now':
      // Show next few forecasts from current time
      filtered = allForecasts.slice(0, 5)
      break
    case 'today':
      // Show today's forecasts
      const todayStr = now.toISOString().split('T')[0]
      filtered = allForecasts.filter(f => f.local_datetime.startsWith(todayStr)).slice(0, 5)
      break
    case 'tomorrow':
      // Show tomorrow's forecasts
      const tomorrow = new Date(now)
      tomorrow.setDate(tomorrow.getDate() + 1)
      const tomorrowStr = tomorrow.toISOString().split('T')[0]
      filtered = allForecasts.filter(f => f.local_datetime.startsWith(tomorrowStr)).slice(0, 5)
      break
    case 'dayAfter':
      // Show day after tomorrow's forecasts
      const dayAfter = new Date(now)
      dayAfter.setDate(dayAfter.getDate() + 2)
      const dayAfterStr = dayAfter.toISOString().split('T')[0]
      filtered = allForecasts.filter(f => f.local_datetime.startsWith(dayAfterStr)).slice(0, 5)
      break
  }

  weatherData.value = filtered.map(forecast => ({
    date: formatDate(forecast.local_datetime),
    time: formatTime(forecast.local_datetime),
    temp: Math.round(forecast.t),
    icon: getWeatherIcon(forecast.weather),
    condition: getWeatherCondition(forecast.weather, forecast.weather_desc),
    feelsLike: Math.round(forecast.t - 2), // Approximate feels like
    rainfall: forecast.tp,
  }))
}

const setFilter = (filter) => {
  selectedFilter.value = filter
  updateDisplayedWeather()
}

onMounted(() => {
  fetchWeatherData()
})
</script>
