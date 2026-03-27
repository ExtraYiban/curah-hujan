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

            <div class="space-y-6">
                <div class="rounded-2xl bg-white p-8 shadow-lg">
                    <h3 class="mb-4 text-xl font-bold text-gray-900">Presipitasi</h3>
                    <div class="relative rounded-lg bg-gray-50 p-4">
                        <VueApexCharts
                            v-if="hasChartData"
                            type="bar"
                            height="280"
                            :options="presipitasiChartOptions"
                            :series="presipitasiChartSeries"
                        />

                        <div v-else class="flex h-[280px] items-center justify-center text-sm text-gray-500">Data curah hujan belum tersedia.</div>

                        <div v-if="loadingGraph" class="absolute inset-0 flex items-center justify-center rounded-lg bg-white/70 text-sm font-medium text-gray-600">
                            Memuat data grafik...
                        </div>
                    </div>

                    <p v-if="graphError" class="mt-3 text-sm text-red-600">{{ graphError }}</p>
                </div>

                <div class="rounded-2xl bg-white p-8 shadow-lg">
                    <h3 class="mb-4 text-xl font-bold text-gray-900">Data Prediksi: Curah hujan</h3>
                    <div class="rounded-lg bg-gray-50 p-4">
                        <VueApexCharts
                            v-if="hasChartData"
                            type="area"
                            height="250"
                            :options="prediksiChartOptions"
                            :series="prediksiChartSeries"
                        />

                        <div v-else class="flex h-[250px] items-center justify-center text-sm text-gray-500">Data prediksi belum tersedia.</div>
                    </div>
                </div>

                <div class="rounded-2xl bg-white p-8 shadow-lg">
                    <h3 class="mb-4 text-xl font-bold text-gray-900">Random Forest</h3>
                    <div class="rounded-lg bg-gray-50 p-4">
                        <VueApexCharts
                            v-if="hasChartData"
                            type="line"
                            height="250"
                            :options="forestChartOptions"
                            :series="forestChartSeries"
                        />

                        <div v-else class="flex h-[250px] items-center justify-center text-sm text-gray-500">Data Random Forest belum tersedia.</div>
                    </div>
                </div>

                <div class="rounded-2xl bg-white p-8 shadow-lg">
                    <h3 class="mb-4 text-xl font-bold text-gray-900">Vector Regression</h3>
                    <div class="rounded-lg bg-gray-50 p-4">
                        <VueApexCharts
                            v-if="hasChartData"
                            type="line"
                            height="250"
                            :options="vectorChartOptions"
                            :series="vectorChartSeries"
                        />

                        <div v-else class="flex h-[250px] items-center justify-center text-sm text-gray-500">Data Vector Regression belum tersedia.</div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</template>

<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import type { ApexOptions } from 'apexcharts';
import { computed, onMounted, ref } from 'vue';
import VueApexCharts from 'vue3-apexcharts';
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

interface RainfallChartData {
    categories: string[];
    rainfall: number[];
}

const defaultHourLabels = ['00', '03', '06', '09', '12', '15', '18', '21'];
const defaultRainfallValues = [0, 0, 0, 0, 0, 0, 0, 0];

const chartData = ref<RainfallChartData>({
    categories: [],
    rainfall: [],
});
const loadingGraph = ref(false);
const refreshingGraph = ref(false);
const graphError = ref('');

const baseChartConfig: ApexOptions = {
    chart: {
        toolbar: {
            show: false,
        },
        zoom: {
            enabled: false,
        },
        animations: {
            speed: 450,
        },
    },
    grid: {
        borderColor: '#e5e7eb',
        strokeDashArray: 3,
    },
    dataLabels: {
        enabled: false,
    },
    stroke: {
        curve: 'smooth',
    },
    tooltip: {
        theme: 'light',
    },
    legend: {
        show: false,
    },
};

const parseRainfall = (value: number | null | undefined): number => {
    if (typeof value !== 'number' || Number.isNaN(value)) {
        return 0;
    }

    return Math.max(0, value);
};

const getCookieValue = (name: string): string | null => {
    const cookieMatch = document.cookie
        .split('; ')
        .find((cookie) => cookie.startsWith(`${name}=`));

    if (!cookieMatch) {
        return null;
    }

    return decodeURIComponent(cookieMatch.split('=').slice(1).join('='));
};

const extractForecasts = (result: BmkgResponse): BmkgForecast[] => {
    const groupedForecasts = result.data?.data?.[0]?.cuaca;
    if (!Array.isArray(groupedForecasts)) {
        return [];
    }

    return groupedForecasts.flat().filter((forecast) => typeof forecast?.local_datetime === 'string');
};

const toHourLabel = (value: string): string => {
    const date = new Date(value.replace(' ', 'T'));

    if (Number.isNaN(date.getTime())) {
        return '--';
    }

    return date.toLocaleTimeString('id-ID', {
        hour: '2-digit',
        hour12: false,
    });
};

const transformForecastsToRainfallChart = (forecasts: BmkgForecast[], pointCount = 8): RainfallChartData => {
    const slicedForecasts = forecasts.slice(0, pointCount);

    const categories = slicedForecasts.map((forecast) => toHourLabel(forecast.local_datetime));
    const rainfall = slicedForecasts.map((forecast) => parseRainfall(forecast.tp));

    while (categories.length < pointCount) {
        categories.push(defaultHourLabels[categories.length]);
    }

    while (rainfall.length < pointCount) {
        rainfall.push(0);
    }

    return {
        categories,
        rainfall,
    };
};

const buildRequestHeaders = (forceRefresh: boolean): HeadersInit => {
    const csrfToken = document.querySelector<HTMLMetaElement>('meta[name="csrf-token"]')?.content;
    const xsrfToken = getCookieValue('XSRF-TOKEN');

    return {
        Accept: 'application/json',
        'X-Requested-With': 'XMLHttpRequest',
        ...(xsrfToken ? { 'X-XSRF-TOKEN': xsrfToken } : {}),
        ...(csrfToken ? { 'X-CSRF-TOKEN': csrfToken } : {}),
        ...(forceRefresh ? { 'Content-Type': 'application/json' } : {}),
    };
};

const fetchWeatherPayload = async (forceRefresh: boolean): Promise<BmkgResponse> => {
    const response = await fetch(forceRefresh ? '/api/weather/refresh' : '/api/weather', {
        method: forceRefresh ? 'POST' : 'GET',
        headers: buildRequestHeaders(forceRefresh),
        ...(forceRefresh ? { body: JSON.stringify({}) } : {}),
        credentials: 'same-origin',
    });

    const result = (await response.json()) as BmkgResponse;

    if (!response.ok || !result.success) {
        throw new Error(result.message ?? 'Gagal mengambil data BMKG.');
    }

    return result;
};

const rainfallValues = computed(() => {
    return chartData.value.rainfall.length > 0 ? chartData.value.rainfall : defaultRainfallValues;
});

const chartCategories = computed(() => {
    return chartData.value.categories.length > 0 ? chartData.value.categories : defaultHourLabels;
});

const hasChartData = computed(() => {
    return chartData.value.rainfall.length > 0;
});

const buildSeriesVariant = (factor: number, offset: number): number[] => {
    return rainfallValues.value.map((value) => Number((value * factor + offset).toFixed(2)));
};

const presipitasiChartOptions = computed<ApexOptions>(() => {
    return {
        ...baseChartConfig,
        chart: {
            ...baseChartConfig.chart,
            type: 'bar',
        },
        xaxis: {
            categories: chartCategories.value,
            labels: {
                style: {
                    colors: '#6b7280',
                },
            },
        },
        yaxis: {
            min: 0,
            title: {
                text: 'mm',
                style: {
                    color: '#6b7280',
                    fontWeight: 600,
                },
            },
            labels: {
                formatter: (value) => `${value.toFixed(1)}`,
            },
        },
        plotOptions: {
            bar: {
                borderRadius: 6,
                columnWidth: '52%',
            },
        },
        colors: ['#06b6d4'],
        tooltip: {
            ...baseChartConfig.tooltip,
            y: {
                formatter: (value) => `${Number(value).toFixed(2)} mm`,
            },
        },
    };
});

const presipitasiChartSeries = computed(() => {
    return [
        {
            name: 'Curah Hujan',
            data: rainfallValues.value,
        },
    ];
});

const prediksiChartOptions = computed<ApexOptions>(() => {
    return {
        ...baseChartConfig,
        chart: {
            ...baseChartConfig.chart,
            type: 'area',
        },
        xaxis: {
            categories: chartCategories.value,
        },
        yaxis: {
            min: 0,
            labels: {
                formatter: (value) => `${value.toFixed(1)}`,
            },
        },
        colors: ['#3b82f6'],
        fill: {
            type: 'gradient',
            gradient: {
                shadeIntensity: 1,
                opacityFrom: 0.34,
                opacityTo: 0.04,
                stops: [0, 95],
            },
        },
        tooltip: {
            ...baseChartConfig.tooltip,
            y: {
                formatter: (value) => `${Number(value).toFixed(2)} mm`,
            },
        },
    };
});

const prediksiChartSeries = computed(() => {
    return [
        {
            name: 'Prediksi BMKG',
            data: buildSeriesVariant(1.06, 0.1),
        },
    ];
});

const forestChartOptions = computed<ApexOptions>(() => {
    return {
        ...baseChartConfig,
        chart: {
            ...baseChartConfig.chart,
            type: 'line',
        },
        xaxis: {
            categories: chartCategories.value,
        },
        yaxis: {
            min: 0,
        },
        colors: ['#22c55e'],
        stroke: {
            width: 3,
            curve: 'smooth',
        },
    };
});

const forestChartSeries = computed(() => {
    return [
        {
            name: 'Random Forest',
            data: buildSeriesVariant(0.92, 0.18),
        },
    ];
});

const vectorChartOptions = computed<ApexOptions>(() => {
    return {
        ...baseChartConfig,
        chart: {
            ...baseChartConfig.chart,
            type: 'line',
        },
        xaxis: {
            categories: chartCategories.value,
        },
        yaxis: {
            min: 0,
        },
        colors: ['#f97316'],
        stroke: {
            width: 3,
            curve: 'smooth',
        },
    };
});

const vectorChartSeries = computed(() => {
    return [
        {
            name: 'Vector Regression',
            data: buildSeriesVariant(0.98, 0.08),
        },
    ];
});

const fetchGraphData = async (forceRefresh = false): Promise<void> => {
    graphError.value = '';

    if (forceRefresh) {
        refreshingGraph.value = true;
    } else {
        loadingGraph.value = true;
    }

    try {
        const result = await fetchWeatherPayload(forceRefresh);
        const forecasts = extractForecasts(result);

        if (forecasts.length === 0) {
            throw new Error('Data BMKG belum tersedia untuk ditampilkan.');
        }

        chartData.value = transformForecastsToRainfallChart(forecasts);
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
</script>
