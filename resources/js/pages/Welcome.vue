<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import { ref, onMounted } from 'vue';
import Header from '@/components/dashboard/Header.vue';
import WeatherMap from '@/components/WeatherMap.vue';
import axios from 'axios';

interface WeatherForecast {
  datetime: string;
  local_datetime: string;
  t: number;
  weather: number;
  weather_desc: string;
  hu: number;
  [key: string]: any;
}

interface WeatherData {
  lokasi: any;
  cuaca: WeatherForecast[][];
}

const weatherData = ref<WeatherData[] | null>(null);
const loading = ref(true);
const selectedDay = ref(0); // 0 = today, 1 = tomorrow, 2 = day after tomorrow
const weatherAlert = ref({ type: 'info', message: '' });

onMounted(async () => {
  try {
    const response = await axios.get('/api/weather');
    if (response.data.success) {
      weatherData.value = response.data.data.data;
      analyzeWeather24h();
    }
  } catch (error) {
    console.error('Failed to fetch weather data:', error);
  } finally {
    loading.value = false;
  }
});

const getWeatherIcon = (code: number) => {
  if (code === 0) return '☀️';
  if (code === 1 || code === 2) return '🌤️';
  if (code === 3) return '☁️';
  if (code === 4) return '🌥️';
  if (code === 5) return '🌫️';
  if (code === 10 || code === 45) return '🌫️';
  if (code >= 60 && code <= 63) return '🌧️';
  if (code >= 80 && code <= 99) return '⛈️';
  return '⛅';
};

const formatTime = (datetime: string) => {
  if (!datetime) return 'N/A';
  const date = new Date(datetime);
  return date.toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit' });
};

const analyzeWeather24h = () => {
  if (!weatherData.value || !weatherData.value[0]?.cuaca) return;

  const now = new Date();
  const next24h = new Date(now.getTime() + 24 * 60 * 60 * 1000);

  // Collect all forecasts from all available days
  const allForecasts: any[] = [];
  const cuacaData = weatherData.value[0].cuaca;

  for (let i = 0; i < cuacaData.length; i++) {
    if (Array.isArray(cuacaData[i])) {
      allForecasts.push(...cuacaData[i]);
    }
  }

  // Get all forecasts for next 24 hours
  const forecasts24h = allForecasts.filter((forecast: any) => {
    const forecastDate = new Date(forecast.local_datetime);
    return forecastDate >= now && forecastDate <= next24h;
  });

  if (forecasts24h.length === 0) return;
  // Analyze weather conditions
  const hasHeavyRain = forecasts24h.some((f: any) => f.weather >= 95); // Thunder
  const hasModerateRain = forecasts24h.some((f: any) => f.weather >= 60 && f.weather < 80);
  const hasLightRain = forecasts24h.some((f: any) => f.weather >= 10 && f.weather < 60);
  const isClear = forecasts24h.every((f: any) => f.weather <= 3);

  if (hasHeavyRain) {
    weatherAlert.value = {
      type: 'danger',
      message: 'Peringatan: Potensi hujan lebat disertai petir dalam 24 jam ke depan'
    };
  } else if (hasModerateRain) {
    weatherAlert.value = {
      type: 'warning',
      message: 'Peringatan: Potensi hujan sedang dalam 24 jam ke depan'
    };
  } else if (hasLightRain) {
    weatherAlert.value = {
      type: 'info',
      message: 'Info: Kemungkinan hujan ringan dalam 24 jam ke depan'
    };
  } else if (isClear) {
    weatherAlert.value = {
      type: 'success',
      message: 'Info: Cuaca cerah diprediksi untuk 24 jam ke depan'
    };
  } else {
    weatherAlert.value = {
      type: 'info',
      message: 'Info: Cuaca berawan dalam 24 jam ke depan'
    };
  }
};

const getFilteredForecasts = () => {
  if (!weatherData.value || !weatherData.value[0]?.cuaca) return [];

  const cuacaData = weatherData.value[0].cuaca;

  // BMKG API structure: cuaca[0] = today, cuaca[1] = tomorrow, cuaca[2] = day after
  if (cuacaData[selectedDay.value] && Array.isArray(cuacaData[selectedDay.value])) {
    return cuacaData[selectedDay.value].slice(0, 5);
  }

  return [];
};

const getDayLabel = (day: number) => {
  if (day === 0) return 'Hari Ini';
  if (day === 1) return 'Besok';
  return 'Lusa';
};
</script>

<template>
  <Head title="Beranda" />

  <div class="min-h-screen bg-gray-50 font-sans">
    <Header />

    <main class="max-w-7xl mx-auto p-8">
      <!-- Hero Section -->
      <div class="bg-gradient-to-r from-blue-600 to-cyan-600 rounded-2xl shadow-xl p-12 text-white mb-12">
        <h1 class="text-5xl font-bold mb-4">Selamat Datang di Sistem Monitoring Curah Hujan</h1>
        <p class="text-xl text-blue-100 mb-8">
          Platform monitoring dan analisis data curah hujan, TMA, debit, iklim, dan kualitas air secara real-time
        </p>
        <div class="flex gap-4">
          <Link
            href="/curah-hujan"
            class="px-6 py-3 bg-white text-blue-600 font-semibold rounded-lg shadow-lg hover:shadow-xl transition-all transform hover:scale-105"
          >
            Lihat Data Curah Hujan
          </Link>
          <Link
            href="/tentang-kami"
            class="px-6 py-3 bg-blue-500 hover:bg-blue-400 text-white font-semibold rounded-lg shadow-lg transition-all"
          >
            Tentang Kami
          </Link>
        </div>
      </div>

      <!-- Features Grid -->
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
        <!-- Curah Hujan - Enhanced with Weather Data -->
        <div class="bg-white rounded-2xl shadow-lg p-8 col-span-1 md:col-span-2 lg:col-span-3">
          <!-- Alert Banner - Dynamic -->
          <div
            v-if="weatherAlert.message"
            :class="[
              'border-l-4 p-4 mb-6 rounded-lg',
              weatherAlert.type === 'danger' ? 'bg-red-50 border-red-500' : '',
              weatherAlert.type === 'warning' ? 'bg-orange-50 border-orange-500' : '',
              weatherAlert.type === 'info' ? 'bg-blue-50 border-blue-500' : '',
              weatherAlert.type === 'success' ? 'bg-green-50 border-green-500' : ''
            ]"
          >
            <div class="flex items-center">
              <svg
                v-if="weatherAlert.type === 'danger' || weatherAlert.type === 'warning'"
                class="w-6 h-6 mr-3"
                :class="weatherAlert.type === 'danger' ? 'text-red-500' : 'text-orange-500'"
                fill="none" stroke="currentColor" viewBox="0 0 24 24"
              >
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
              </svg>
              <svg
                v-else-if="weatherAlert.type === 'success'"
                class="w-6 h-6 text-green-500 mr-3"
                fill="none" stroke="currentColor" viewBox="0 0 24 24"
              >
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
              </svg>
              <svg
                v-else
                class="w-6 h-6 text-blue-500 mr-3"
                fill="none" stroke="currentColor" viewBox="0 0 24 24"
              >
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
              </svg>
              <p
                :class="[
                  'font-medium',
                  weatherAlert.type === 'danger' ? 'text-red-800' : '',
                  weatherAlert.type === 'warning' ? 'text-orange-800' : '',
                  weatherAlert.type === 'info' ? 'text-blue-800' : '',
                  weatherAlert.type === 'success' ? 'text-green-800' : ''
                ]"
              >
                {{ weatherAlert.message }}
              </p>
            </div>
          </div>

          <div class="flex items-center justify-between mb-6">
            <div>
              <h3 class="text-3xl font-bold text-gray-900 mb-2">Curah Hujan</h3>
              <p class="text-gray-600">Data cuaca terkini untuk wilayah Samarinda</p>
            </div>
            <Link
              href="/curah-hujan"
              class="px-6 py-3 bg-gradient-to-r from-blue-600 to-cyan-600 text-white font-semibold rounded-lg shadow-lg hover:shadow-xl transition-all transform hover:scale-105"
            >
              Lihat Detail
            </Link>
          </div>

          <!-- Weather Cards Section -->
          <div class="mb-8 relative z-10">
            <div class="flex items-center justify-between mb-4">
              <h4 class="text-xl font-bold text-gray-900">Cuaca Saat Ini</h4>

              <!-- Day Selector -->
              <div class="flex gap-2">
                <button
                  v-for="day in [0, 1, 2]"
                  :key="day"
                  @click="selectedDay = day"
                  :class="[
                    'px-4 py-2 text-sm font-medium rounded-lg transition-all',
                    selectedDay === day
                      ? 'bg-gradient-to-r from-blue-600 to-cyan-600 text-white shadow-md'
                      : 'bg-gray-100 text-gray-700 hover:bg-gray-200'
                  ]"
                >
                  {{ getDayLabel(day) }}
                </button>
              </div>
            </div>

            <div v-if="loading" class="flex justify-center py-8">
              <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-blue-600"></div>
            </div>
            <div v-else-if="getFilteredForecasts().length > 0" class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4">
              <div
                v-for="(forecast, index) in getFilteredForecasts()"
                :key="index"
                class="bg-gradient-to-br from-blue-50 to-cyan-50 rounded-xl p-6 text-center shadow-md hover:shadow-lg transition-shadow"
              >
                <div class="text-sm text-gray-600 mb-2">{{ formatTime(forecast.local_datetime) }}</div>
                <div class="text-4xl mb-3">{{ getWeatherIcon(forecast.weather) }}</div>
                <div class="text-3xl font-bold text-gray-900 mb-2">{{ forecast.t }}°</div>
                <div class="text-sm text-gray-700 font-medium">{{ forecast.weather_desc }}</div>
                <div class="text-xs text-gray-500 mt-2">Kelembaban: {{ forecast.hu }}%</div>
              </div>
            </div>
            <div v-else class="text-center py-8 text-gray-500">
              <p>Data cuaca tidak tersedia untuk {{ getDayLabel(selectedDay).toLowerCase() }}</p>
            </div>
          </div>

          <!-- Map Section -->
          <div class="relative">
            <h4 class="text-xl font-bold text-gray-900 mb-4 relative z-20">Peta Samarinda</h4>
            <div class="h-96 rounded-xl overflow-hidden shadow-lg relative z-0">
              <WeatherMap />
            </div>
          </div>
        </div>

        <Link href="/tma-debit" class="bg-white rounded-2xl shadow-lg p-8 hover:shadow-xl transition-shadow group">
          <div class="w-16 h-16 bg-cyan-100 rounded-2xl flex items-center justify-center mb-6 group-hover:bg-cyan-200 transition-colors">
            <svg class="w-8 h-8 text-cyan-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4"></path>
            </svg>
          </div>
          <h3 class="text-2xl font-bold text-gray-900 mb-3">TMA & Debit</h3>
          <p class="text-gray-600">
            Monitoring tinggi muka air dan debit sungai untuk manajemen sumber daya air
          </p>
        </Link>

        <Link href="/iklim" class="bg-white rounded-2xl shadow-lg p-8 hover:shadow-xl transition-shadow group">
          <div class="w-16 h-16 bg-yellow-100 rounded-2xl flex items-center justify-center mb-6 group-hover:bg-yellow-200 transition-colors">
            <svg class="w-8 h-8 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path>
            </svg>
          </div>
          <h3 class="text-2xl font-bold text-gray-900 mb-3">Iklim</h3>
          <p class="text-gray-600">
            Data iklim dan cuaca untuk analisis pola iklim jangka panjang
          </p>
        </Link>

        <Link href="/kualitas-air" class="bg-white rounded-2xl shadow-lg p-8 hover:shadow-xl transition-shadow group">
          <div class="w-16 h-16 bg-green-100 rounded-2xl flex items-center justify-center mb-6 group-hover:bg-green-200 transition-colors">
            <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
          </div>
          <h3 class="text-2xl font-bold text-gray-900 mb-3">Kualitas Air</h3>
          <p class="text-gray-600">
            Monitoring kualitas air untuk memastikan keamanan dan kebersihan lingkungan
          </p>
        </Link>

        <Link href="/permohonan-data" class="bg-white rounded-2xl shadow-lg p-8 hover:shadow-xl transition-shadow group">
          <div class="w-16 h-16 bg-purple-100 rounded-2xl flex items-center justify-center mb-6 group-hover:bg-purple-200 transition-colors">
            <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
            </svg>
          </div>
          <h3 class="text-2xl font-bold text-gray-900 mb-3">Permohonan Data</h3>
          <p class="text-gray-600">
            Ajukan permintaan akses data untuk keperluan penelitian dan analisis
          </p>
        </Link>

        <Link href="/tentang-kami" class="bg-white rounded-2xl shadow-lg p-8 hover:shadow-xl transition-shadow group">
          <div class="w-16 h-16 bg-gray-100 rounded-2xl flex items-center justify-center mb-6 group-hover:bg-gray-200 transition-colors">
            <svg class="w-8 h-8 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
          </div>
          <h3 class="text-2xl font-bold text-gray-900 mb-3">Tentang Kami</h3>
          <p class="text-gray-600">
            Informasi lebih lanjut tentang sistem dan tim pengembang
          </p>
        </Link>
      </div>

      <!-- Info Section -->
      <div class="bg-white rounded-2xl shadow-lg p-8">
        <div class="flex items-start gap-6">
          <div class="w-16 h-16 bg-blue-100 rounded-2xl flex items-center justify-center flex-shrink-0">
            <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
            </svg>
          </div>
          <div>
            <h3 class="text-2xl font-bold text-gray-900 mb-4">Tentang Platform</h3>
            <p class="text-gray-600 leading-relaxed mb-4">
              Platform ini menyediakan data monitoring real-time untuk berbagai parameter hidrologi dan klimatologi.
              Sistem kami mengintegrasikan data dari berbagai sumber termasuk BMKG untuk memberikan informasi yang
              akurat dan up-to-date.
            </p>
            <p class="text-gray-600 leading-relaxed">
              Dengan visualisasi data yang interaktif dan mudah dipahami, platform ini membantu dalam pengambilan
              keputusan terkait manajemen sumber daya air dan mitigasi bencana.
            </p>
          </div>
        </div>
      </div>
    </main>

    <!-- Footer -->
    <footer class="bg-white border-t border-gray-200 mt-16 py-8">
      <div class="max-w-7xl mx-auto px-8 text-center text-gray-600">
        <p>© 2026 Sistem Monitoring Curah Hujan. All rights reserved.</p>
      </div>
    </footer>
  </div>
</template>
