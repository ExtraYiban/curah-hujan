<template>
    <div class="flex flex-col gap-6">
        <!-- Alert Box -->
        <div
            class="bg-linear-to-r flex items-center gap-4 rounded-lg border-l-4 border-orange-500 from-orange-50 to-orange-100 p-4 text-orange-900 shadow-sm"
        >
            <div class="shrink-0 text-3xl">⚠️</div>
            <div class="min-w-0 grow">
                <h4 class="m-0 mb-1.5 text-base font-bold">Peringatan Dini Cuaca di Sempaja</h4>
                <p class="m-0 text-sm leading-relaxed">
                    Des 2025 Pukul 08.24-11.00 WIB: Berpotensi Terjadi Hujan Sedang Hingga Lebat Disertai Petir Dan Angin Kencang Di Sempaja.
                    <a href="#" class="font-bold text-blue-600 no-underline hover:underline">Selengkapnya →</a>
                </p>
            </div>
            <div class="flex shrink-0 gap-2">
                <button
                    class="flex h-8 w-8 cursor-pointer items-center justify-center rounded-lg border border-orange-300 bg-white/50 text-orange-800 transition-colors hover:bg-white/80"
                >
                    ←
                </button>
                <button
                    class="flex h-8 w-8 cursor-pointer items-center justify-center rounded-lg border border-orange-300 bg-white/50 text-orange-800 transition-colors hover:bg-white/80"
                >
                    →
                </button>
            </div>
        </div>

        <!-- Weather Cards -->
        <div>
            <div class="mb-4 flex flex-wrap items-center justify-between gap-3">
                <h3 class="m-0 text-2xl font-semibold text-gray-800">Cuaca Saat Ini</h3>
                <div class="flex flex-wrap gap-2">
                    <button
                        @click="setFilter('now')"
                        :class="[
                            'cursor-pointer rounded-lg border px-3 py-1.5 text-xs font-semibold transition-all',
                            selectedFilter === 'now'
                                ? 'border-indigo-500 bg-indigo-500 text-white shadow-md'
                                : 'border-gray-300 bg-white text-gray-600 hover:border-gray-400 hover:bg-gray-50',
                        ]"
                    >
                        Saat Ini
                    </button>
                    <button
                        @click="setFilter('today')"
                        :class="[
                            'cursor-pointer rounded-lg border px-3 py-1.5 text-xs font-semibold transition-all',
                            selectedFilter === 'today'
                                ? 'border-indigo-500 bg-indigo-500 text-white shadow-md'
                                : 'border-gray-300 bg-white text-gray-600 hover:border-gray-400 hover:bg-gray-50',
                        ]"
                    >
                        Hari Ini
                    </button>
                    <button
                        @click="setFilter('tomorrow')"
                        :class="[
                            'cursor-pointer rounded-lg border px-3 py-1.5 text-xs font-semibold transition-all',
                            selectedFilter === 'tomorrow'
                                ? 'border-indigo-500 bg-indigo-500 text-white shadow-md'
                                : 'border-gray-300 bg-white text-gray-600 hover:border-gray-400 hover:bg-gray-50',
                        ]"
                    >
                        Besok
                    </button>
                    <button
                        @click="setFilter('dayAfter')"
                        :class="[
                            'cursor-pointer rounded-lg border px-3 py-1.5 text-xs font-semibold transition-all',
                            selectedFilter === 'dayAfter'
                                ? 'border-indigo-500 bg-indigo-500 text-white shadow-md'
                                : 'border-gray-300 bg-white text-gray-600 hover:border-gray-400 hover:bg-gray-50',
                        ]"
                    >
                        Lusa
                    </button>
                </div>
            </div>

            <div v-if="loading" class="flex h-48 items-center justify-center text-gray-500">
                <div class="text-center">
                    <div class="mb-2 text-2xl">⏳</div>
                    <div>Memuat data cuaca...</div>
                </div>
            </div>

            <div v-else class="grid grid-cols-2 gap-3 md:grid-cols-3 lg:grid-cols-5">
                <div
                    class="overflow-hidden rounded-xl bg-white shadow-md transition-shadow hover:shadow-lg"
                    v-for="(weather, index) in weatherData"
                    :key="index"
                >
                    <div class="bg-linear-to-br from-gray-50 to-gray-100 p-3">
                        <div class="mb-3 flex items-start justify-between">
                            <div>
                                <div class="text-xs font-medium text-gray-500">{{ weather.date }}</div>
                                <div class="text-xs text-gray-400">{{ weather.time }}</div>
                            </div>
                            <span class="text-3xl">{{ weather.icon }}</span>
                        </div>
                        <div class="text-3xl font-bold text-gray-800">{{ weather.temp }}°C</div>
                    </div>
                    <div class="flex h-20 flex-col justify-between bg-gray-600 px-3 py-3 text-white">
                        <div class="flex min-h-10 items-center text-sm font-semibold leading-tight">
                            {{ weather.condition }}
                        </div>
                        <div class="mt-1 flex items-center justify-between gap-2 text-xs">
                            <span class="shrink-0 opacity-90">{{ weather.feelsLike }}°C</span>
                            <span class="flex shrink-0 items-center justify-end gap-1 opacity-90">
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

<script setup lang="ts">
import { ref, onMounted } from 'vue';

interface WeatherDisplay {
    date: string;
    time: string;
    temp: number;
    icon: string;
    condition: string;
    feelsLike: number;
    rainfall: number;
}

interface RawForecast {
    datetime: string;
    t: number;
    t_d: number;
    hu: number;
    vs_text: string;
    weather: number;
    weather_desc: string;
    weather_desc_en: string;
    ws: number;
    wd: string;
    wd_to: string;
    tp: number;
    local_datetime: string;
}

interface RawWeatherData {
    lokasi: {
        adm1: string;
        adm2: string;
        adm3: string;
        adm4: string;
        provinsi: string;
        kotkab: string;
        kecamatan: string;
        desa: string;
        lon: number;
        lat: number;
        timezone: string;
    };
    data: {
        lokasi: RawWeatherData['lokasi'];
        cuaca: RawForecast[][];
    }[];
}

const weatherData = ref<WeatherDisplay[]>([]);
const selectedFilter = ref('now');
const loading = ref(false);
const rawWeatherData = ref<RawWeatherData | null>(null);

// Map BMKG weather codes to icons and conditions
const weatherCodeMap: Record<number, { icon: string; condition: string }> = {
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
};

const getWeatherIcon = (code: number) => {
    return weatherCodeMap[code]?.icon || '☁️';
};

const getWeatherCondition = (code: number, desc: string) => {
    return weatherCodeMap[code]?.condition || desc || 'Berawan';
};

const formatDate = (dateString: string) => {
    const date = new Date(dateString);
    const months = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
    return `${date.getDate()} ${months[date.getMonth()]}`;
};

const formatTime = (dateString: string) => {
    const date = new Date(dateString);
    return date.toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit' });
};

const fetchWeatherData = async () => {
    loading.value = true;
    try {
        // Call Laravel backend API instead of BMKG directly
        const response = await fetch('/api/weather');
        const result = await response.json();

        if (result.success && result.data) {
            rawWeatherData.value = result.data as RawWeatherData;
            updateDisplayedWeather();

            // Log cache info
            console.log('Weather data cached at:', result.cached_at);
            console.log('Cache expires in:', result.cache_expires_in, 'minutes');
        } else {
            throw new Error(result.message || 'Failed to fetch weather data');
        }
    } catch (error) {
        console.error('Failed to fetch weather data:', error);
        // Fallback data
        weatherData.value = [
            { date: '06 Feb', temp: 29, icon: '☁️', condition: 'Berawan', feelsLike: 27, time: '14:00', rainfall: 0.5 },
            { date: '06 Feb', temp: 26, icon: '⛅', condition: 'Cerah Berawan', feelsLike: 24, time: '17:00', rainfall: 0 },
            { date: '06 Feb', temp: 24, icon: '🌧️', condition: 'Hujan Ringan', feelsLike: 22, time: '20:00', rainfall: 2.7 },
            { date: '07 Feb', temp: 29, icon: '☁️', condition: 'Berawan', feelsLike: 27, time: '08:00', rainfall: 0.1 },
            { date: '07 Feb', temp: 31, icon: '⛅', condition: 'Cerah Berawan', feelsLike: 29, time: '11:00', rainfall: 0.3 },
        ];
    } finally {
        loading.value = false;
    }
};

const updateDisplayedWeather = () => {
    // Safe access using optional chaining
    if (!rawWeatherData.value?.data?.[0]?.cuaca) return;

    const allForecasts: RawForecast[] = rawWeatherData.value.data[0].cuaca.flat();
    const now = new Date();

    let filtered: RawForecast[] = [];

    switch (selectedFilter.value) {
        case 'now':
            // Show next few forecasts from current time
            filtered = allForecasts.slice(0, 5);
            break;
        case 'today':
            // Show today's forecasts
            const todayStr = now.toISOString().split('T')[0];
            filtered = allForecasts.filter((f) => f.local_datetime.startsWith(todayStr)).slice(0, 5);
            break;
        case 'tomorrow':
            // Show tomorrow's forecasts
            const tomorrow = new Date(now);
            tomorrow.setDate(tomorrow.getDate() + 1);
            const tomorrowStr = tomorrow.toISOString().split('T')[0];
            filtered = allForecasts.filter((f) => f.local_datetime.startsWith(tomorrowStr)).slice(0, 5);
            break;
        case 'dayAfter':
            // Show day after tomorrow's forecasts
            const dayAfter = new Date(now);
            dayAfter.setDate(dayAfter.getDate() + 2);
            const dayAfterStr = dayAfter.toISOString().split('T')[0];
            filtered = allForecasts.filter((f) => f.local_datetime.startsWith(dayAfterStr)).slice(0, 5);
            break;
    }

    weatherData.value = filtered.map((forecast) => ({
        date: formatDate(forecast.local_datetime),
        time: formatTime(forecast.local_datetime),
        temp: Math.round(forecast.t),
        icon: getWeatherIcon(forecast.weather),
        condition: getWeatherCondition(forecast.weather, forecast.weather_desc),
        feelsLike: Math.round(forecast.t - 2), // Approximate feels like
        rainfall: forecast.tp,
    }));
};

const setFilter = (filter: string) => {
    selectedFilter.value = filter;
    updateDisplayedWeather();
};

onMounted(() => {
    fetchWeatherData();
});
</script>
