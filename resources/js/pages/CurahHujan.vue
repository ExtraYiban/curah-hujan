<template>
    <Head title="Curah Hujan" />

    <div class="min-h-screen bg-gray-50 font-sans">
        <Header />
        <main class="mx-auto max-w-7xl p-8">
            <div class="mb-6 flex flex-wrap items-center justify-between gap-3">
                <h2 class="text-3xl font-bold text-gray-900">Data BMKG (Per 3 jam)</h2>
                <button
                    type="button"
                    @click="refreshGraphData"
                    :disabled="refreshingGraph || loadingGraph"
                    class="rounded-lg bg-cyan-600 px-4 py-2 text-sm font-semibold text-white shadow transition hover:bg-cyan-700 disabled:cursor-not-allowed disabled:bg-cyan-300"
                >
                    {{ refreshingGraph ? 'Memperbarui...' : 'Update Data Grafik' }}
                </button>
            </div>

            <!-- Three Sections -->
            <div class="space-y-6">
                <!-- Presipitasi Section -->
                <div class="rounded-2xl bg-white p-8 shadow-lg">
                    <h3 class="mb-4 text-xl font-bold text-gray-900">Presipitasi</h3>
                    <div class="relative h-80 rounded-lg bg-gray-50 p-4">
                        <!-- Y-axis label (mm) -->
                        <div class="absolute left-16 top-2 text-xs font-medium text-gray-600">mm</div>

                        <!-- Y-axis intensity labels -->
                        <div class="absolute bottom-12 left-0 top-12 flex w-14 flex-col justify-between text-xs text-gray-500">
                            <span class="text-left">Lebat</span>
                            <span class="text-left">Sedang</span>
                            <span class="text-left">Ringan</span>
                        </div>

                        <!-- Chart area -->
                        <div class="relative ml-16 mr-4 h-full pb-8 pt-6">
                            <svg class="h-full w-full" viewBox="0 0 800 240" preserveAspectRatio="none">
                                <!-- Grid lines -->
                                <line x1="0" y1="0" x2="800" y2="0" stroke="#e5e7eb" stroke-width="1" vector-effect="non-scaling-stroke" />
                                <line x1="0" y1="60" x2="800" y2="60" stroke="#e5e7eb" stroke-width="1" vector-effect="non-scaling-stroke" />
                                <line x1="0" y1="120" x2="800" y2="120" stroke="#e5e7eb" stroke-width="1" vector-effect="non-scaling-stroke" />
                                <line x1="0" y1="180" x2="800" y2="180" stroke="#e5e7eb" stroke-width="1" vector-effect="non-scaling-stroke" />
                                <line x1="0" y1="240" x2="800" y2="240" stroke="#e5e7eb" stroke-width="1" vector-effect="non-scaling-stroke" />

                                <rect
                                    v-for="(bar, index) in bmkgBars"
                                    :key="`rainfall-bar-${index}`"
                                    :x="bar.x"
                                    :y="bar.y"
                                    :width="bar.width"
                                    :height="bar.height"
                                    fill="rgb(6, 182, 212)"
                                    rx="6"
                                />
                            </svg>

                            <!-- X-axis labels (hours) -->
                            <div class="absolute bottom-0 left-0 right-0 flex justify-between px-2 text-xs text-gray-500">
                                <span v-for="(hourLabel, index) in barHourLabels" :key="`hour-label-${index}`">{{ hourLabel }}</span>
                            </div>
                        </div>

                        <div v-if="loadingGraph" class="absolute inset-0 flex items-center justify-center rounded-lg bg-white/70 text-sm font-medium text-gray-600">
                            Memuat data grafik...
                        </div>
                    </div>

                    <p v-if="graphError" class="mt-3 text-sm text-red-600">{{ graphError }}</p>
                </div>

                <!-- Data Prediksi: Curah hujan Section -->
                <div class="rounded-2xl bg-white p-8 shadow-lg">
                    <h3 class="mb-4 text-xl font-bold text-gray-900">Data Prediksi: Curah hujan</h3>
                    <div class="relative h-64 rounded-lg bg-gray-50 p-4">
                        <!-- Chart placeholder with line -->
                        <svg class="h-full w-full" viewBox="0 0 600 200" preserveAspectRatio="none">
                            <defs>
                                <linearGradient id="bmkgGradient" x1="0%" y1="0%" x2="0%" y2="100%">
                                    <stop offset="0%" style="stop-color: rgb(59, 130, 246); stop-opacity: 0.3" />
                                    <stop offset="100%" style="stop-color: rgb(59, 130, 246); stop-opacity: 0.05" />
                                </linearGradient>
                            </defs>

                            <!-- Multiple rainfall curves -->
                            <path :d="bmkgChartPath1" fill="none" stroke="rgb(147, 197, 253)" stroke-width="3" vector-effect="non-scaling-stroke" />
                            <path
                                :d="bmkgChartPath2"
                                fill="url(#bmkgGradient)"
                                stroke="rgb(59, 130, 246)"
                                stroke-width="3"
                                vector-effect="non-scaling-stroke"
                            />
                            <path :d="bmkgChartPath3" fill="none" stroke="rgb(96, 165, 250)" stroke-width="3" vector-effect="non-scaling-stroke" />
                        </svg>
                    </div>
                </div>

                <!-- Random Forest Section -->
                <div class="rounded-2xl bg-white p-8 shadow-lg">
                    <h3 class="mb-4 text-xl font-bold text-gray-900">Random Forest</h3>
                    <div class="relative h-64 rounded-lg bg-gray-50 p-4">
                        <!-- Chart placeholder with line -->
                        <svg class="h-full w-full" viewBox="0 0 600 200" preserveAspectRatio="none">
                            <defs>
                                <linearGradient id="forestGradient" x1="0%" y1="0%" x2="0%" y2="100%">
                                    <stop offset="0%" style="stop-color: rgb(34, 197, 94); stop-opacity: 0.3" />
                                    <stop offset="100%" style="stop-color: rgb(34, 197, 94); stop-opacity: 0.05" />
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
                <div class="rounded-2xl bg-white p-8 shadow-lg">
                    <h3 class="mb-4 text-xl font-bold text-gray-900">Vector Regression</h3>
                    <div class="relative h-64 rounded-lg bg-gray-50 p-4">
                        <!-- Chart placeholder with line -->
                        <svg class="h-full w-full" viewBox="0 0 600 200" preserveAspectRatio="none">
                            <defs>
                                <linearGradient id="vectorGradient" x1="0%" y1="0%" x2="0%" y2="100%">
                                    <stop offset="0%" style="stop-color: rgb(249, 115, 22); stop-opacity: 0.3" />
                                    <stop offset="100%" style="stop-color: rgb(249, 115, 22); stop-opacity: 0.05" />
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
import { Head } from '@inertiajs/vue3';
import { computed, onMounted, ref } from 'vue';
import Header from '../Components/dashboard/Header.vue';

interface BmkgForecast {
    local_datetime: string;
    tp: number | null;
}

interface BmkgResponse {
    success: boolean;
    message?: string;
    data?: {
        data?: {
            cuaca?: BmkgForecast[][];
        }[];
    };
}

interface BarPoint {
    x: number;
    y: number;
    width: number;
    height: number;
}

const bmkgForecasts = ref<BmkgForecast[]>([]);
const loadingGraph = ref(false);
const refreshingGraph = ref(false);
const graphError = ref('');

const defaultHourLabels = ['00', '03', '06', '09', '12', '15', '18', '21'];

const parseRainfall = (value: number | null | undefined): number => {
    if (typeof value !== 'number' || Number.isNaN(value)) {
        return 0;
    }

    return Math.max(0, value);
};

const bmkgRainfall = computed(() => {
    return bmkgForecasts.value.slice(0, 8).map((forecast) => parseRainfall(forecast.tp));
});

const rainfallScaleMax = computed(() => {
    const maxRainfall = Math.max(...bmkgRainfall.value, 0);
    return maxRainfall > 0 ? maxRainfall : 1;
});

const bmkgBars = computed<BarPoint[]>(() => {
    const values = bmkgRainfall.value;
    const count = values.length || 8;
    const chartWidth = 800;
    const chartHeight = 240;
    const step = chartWidth / count;
    const width = Math.min(64, step * 0.62);

    return Array.from({ length: count }, (_, index) => {
        const value = values[index] ?? 0;
        const height = (value / rainfallScaleMax.value) * chartHeight;
        const x = index * step + (step - width) / 2;
        const y = chartHeight - height;

        return {
            x,
            y,
            width,
            height,
        };
    });
});

const barHourLabels = computed(() => {
    if (bmkgForecasts.value.length === 0) {
        return defaultHourLabels;
    }

    const labels = bmkgForecasts.value.slice(0, 8).map((forecast) => {
        if (!forecast.local_datetime) {
            return '--';
        }

        const date = new Date(forecast.local_datetime.replace(' ', 'T'));
        if (Number.isNaN(date.getTime())) {
            return '--';
        }

        return date.toLocaleTimeString('id-ID', {
            hour: '2-digit',
            hour12: false,
        });
    });

    while (labels.length < 8) {
        labels.push(defaultHourLabels[labels.length]);
    }

    return labels;
});

const predictionPoints = computed(() => {
    const source = bmkgRainfall.value.slice(0, 7);
    const values = source.length > 0 ? source : [0, 0, 0, 0, 0, 0, 0];
    const maxValue = Math.max(...values, 1);

    return values.map((value, index) => {
        const x = index * 100;
        const normalized = value / maxValue;
        const y = 190 - normalized * 120;

        return {
            x,
            y,
        };
    });
});

const buildPath = (offset = 0, close = false): string => {
    const points = predictionPoints.value.map((point) => {
        const y = Math.max(18, Math.min(198, point.y + offset));
        return {
            x: point.x,
            y,
        };
    });

    const pathData = points.map((point, index) => `${index === 0 ? 'M' : 'L'} ${point.x} ${point.y}`).join(' ');

    if (!close) {
        return pathData;
    }

    return `${pathData} L 600 200 L 0 200 Z`;
};

const bmkgChartPath1 = computed(() => {
    return buildPath(18, false);
});

const bmkgChartPath2 = computed(() => {
    return buildPath(0, true);
});

const bmkgChartPath3 = computed(() => {
    return buildPath(-12, false);
});

const extractForecasts = (result: BmkgResponse): BmkgForecast[] => {
    const groupedForecasts = result.data?.data?.[0]?.cuaca;
    if (!Array.isArray(groupedForecasts)) {
        return [];
    }

    return groupedForecasts.flat().filter((forecast) => typeof forecast?.local_datetime === 'string');
};

const getCookieValue = (name: string): string | null => {
    const cookieMatch = document.cookie
        .split('; ')
        .find((cookie) => cookie.startsWith(`${name}=`));

    if (!cookieMatch) {
        return null;
    }

    const value = cookieMatch.split('=').slice(1).join('=');

    return decodeURIComponent(value);
};

const fetchGraphData = async (forceRefresh = false): Promise<void> => {
    graphError.value = '';

    if (forceRefresh) {
        refreshingGraph.value = true;
    } else {
        loadingGraph.value = true;
    }

    try {
        const csrfToken = document.querySelector<HTMLMetaElement>('meta[name="csrf-token"]')?.content;
        const xsrfToken = getCookieValue('XSRF-TOKEN');

        const response = await fetch(forceRefresh ? '/api/weather/refresh' : '/api/weather', {
            method: forceRefresh ? 'POST' : 'GET',
            headers: {
                Accept: 'application/json',
                'X-Requested-With': 'XMLHttpRequest',
                ...(xsrfToken ? { 'X-XSRF-TOKEN': xsrfToken } : {}),
                ...(csrfToken ? { 'X-CSRF-TOKEN': csrfToken } : {}),
                ...(forceRefresh ? { 'Content-Type': 'application/json' } : {}),
            },
            ...(forceRefresh ? { body: JSON.stringify({}) } : {}),
            credentials: 'same-origin',
        });

        const result = (await response.json()) as BmkgResponse;

        if (!response.ok || !result.success) {
            throw new Error(result.message ?? 'Gagal mengambil data BMKG.');
        }

        const forecasts = extractForecasts(result);
        if (forecasts.length === 0) {
            throw new Error('Data BMKG belum tersedia untuk ditampilkan.');
        }

        bmkgForecasts.value = forecasts;
    } catch (error) {
        graphError.value = error instanceof Error ? error.message : 'Gagal memperbarui data grafik.';
    } finally {
        loadingGraph.value = false;
        refreshingGraph.value = false;
    }
};

const refreshGraphData = async (): Promise<void> => {
    await fetchGraphData(true);
};

onMounted(async () => {
    await fetchGraphData();
});

// LSTM prediction chart
// const lstmChartPath = computed(() => {
//   const points = [
//     { x: 0, y: 150 },
//     { x: 100, y: 140 },
//     { x: 200, y: 120 },
//     { x: 300, y: 110 },
//     { x: 400, y: 100 },
//     { x: 500, y: 95 },
//     { x: 600, y: 105 },
//   ]
//   const pathData = points.map((point, index) => `${index === 0 ? 'M' : 'L'} ${point.x} ${point.y}`).join(' ')
//   return `${pathData} L 600 200 L 0 200 Z`
// })

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
    ];
    const pathData = points.map((point, index) => `${index === 0 ? 'M' : 'L'} ${point.x} ${point.y}`).join(' ');
    return `${pathData} L 600 200 L 0 200 Z`;
});

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
    ];
    const pathData = points.map((point, index) => `${index === 0 ? 'M' : 'L'} ${point.x} ${point.y}`).join(' ');
    return `${pathData} L 600 200 L 0 200 Z`;
});
</script>
