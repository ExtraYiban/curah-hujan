<template>
  <div class="bg-gray-50 rounded-xl p-6 h-full flex flex-col">
    <div class="mb-4">
      <h3 class="m-0 text-2xl text-gray-800">Data Ketinggian Air Laut</h3>
      <div class="text-gray-500 text-sm mt-2">
        <span class="text-indigo-900 font-bold mr-2">December 2025</span>
        <span>Wednesday, 10</span>
      </div>
    </div>
    <div class="grow min-h-75 relative">
      <Line :data="chartData" :options="chartOptions" />
    </div>
    <div class="text-xs text-gray-400 mt-4 text-right">
      Source: <a href="https://telemetri.pushidrosal.id/enavigation/" target="_blank" class="text-green-500">Pushidrosal</a>
    </div>
  </div>
</template>

<script setup>
import {
  Chart as ChartJS,
  CategoryScale,
  LinearScale,
  PointElement,
  LineElement,
  Title,
  Tooltip,
  Legend,
  Filler
} from 'chart.js'
import { Line } from 'vue-chartjs'
import { ref, onMounted } from 'vue'

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

const chartData = ref({
  labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
  datasets: [
    {
      label: 'Ketinggian Air',
      backgroundColor: (context) => {
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
      tension: 0.4, // Smooth curve
      data: [1.2, 1.5, 1.3, 1.8, 2.0, 2.2, 2.5, 2.3, 2.0, 1.8, 1.5, 1.3]
    }
  ]
})

const chartOptions = ref({
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

// In a real scenario, you would fetch data here
// onMounted(async () => {
//   try {
//     const response = await axios.get('https://telemetri.pushidrosal.id/enavigation/api/...')
//     // update chartData.value
//   } catch (e) {
//     console.error(e)
//   }
// })
</script>
