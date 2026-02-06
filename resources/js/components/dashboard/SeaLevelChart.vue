<template>
  <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 h-full flex flex-col">
    <div class="mb-4">
      <h3 class="m-0 text-xl font-bold text-gray-800">Data Ketinggian Air Laut - Balikpapan</h3>
      <div class="text-gray-500 text-sm mt-2">
        <span class="text-indigo-900 font-bold mr-2">December 2025</span>
        <span>Wednesday, 10</span>
      </div>
    </div>
    <div class="grow min-h-75 relative">
      <Line :data="chartData" :options="chartOptions" />
    </div>
    <div class="text-xs text-gray-400 mt-4 text-right">
      Source: <a href="https://telemetri.pushidrosal.id/enavigation/" target="_blank" class="text-green-500">Pushidrosal (Balikpapan Station)</a>
    </div>
  </div>
</template>

<script setup lang="ts">
import {
  Chart as ChartJS,
  CategoryScale,
  LinearScale,
  PointElement,
  LineElement,
  Title,
  Tooltip,
  Legend,
  Filler,
  type ChartOptions,
  type ChartData,
  type ScriptableContext
} from 'chart.js'
import { ref } from 'vue'
import { Line } from 'vue-chartjs'

ChartJS.register(
  CategoryScale,
  LinearScale,
  PointElement,
  LineElement,
  Title,
  Tooltip,
  Legend,
  Filler
)

const chartData = ref<ChartData<'line'>>({
  labels: ['00:00', '02:00', '04:00', '06:00', '08:00', '10:00', '12:00', '14:00', '16:00', '18:00', '20:00', '22:00'],
  datasets: [
    {
      label: 'Ketinggian Air (m)',
      backgroundColor: (context: ScriptableContext<'line'>) => {
        const ctx = context.chart.ctx;
        const gradient = ctx.createLinearGradient(0, 0, 0, 400);
        gradient.addColorStop(0, 'rgba(130, 106, 249, 0.5)');
        gradient.addColorStop(1, 'rgba(130, 106, 249, 0.0)');
        return gradient;
      },
      borderColor: '#826AF9',
      pointBackgroundColor: '#826AF9',
      pointBorderColor: '#fff',
      pointHoverBackgroundColor: '#fff',
      pointHoverBorderColor: '#826AF9',
      fill: true,
      tension: 0.4,
      data: [1.2, 1.8, 2.4, 2.1, 1.5, 0.9, 0.6, 0.9, 1.6, 2.3, 2.5, 1.9]
    }
  ]
})

const chartOptions = ref<ChartOptions<'line'>>({
  responsive: true,
  maintainAspectRatio: false,
  plugins: {
    legend: {
      display: false
    },
    tooltip: {
      mode: 'index',
      intersect: false,
    }
  },
  scales: {
    y: {
      beginAtZero: true,
      grid: {
        // @ts-expect-error - borderDash is a valid option but missing in types
        borderDash: [5, 5],
        color: '#f0f0f0'
      }
    },
    x: {
      grid: {
        display: false
      }
    }
  }
})
</script>
