import { createRouter, createWebHistory } from 'vue-router'
import Home from '../pages/Home.vue'
import CurahHujan from '../pages/CurahHujan.vue'
import TmaDebit from '../pages/TmaDebit.vue'
import Iklim from '../pages/Iklim.vue'
import KualitasAir from '../pages/KualitasAir.vue'
import PermohonanData from '../pages/PermohonanData.vue'

const routes = [
  {
    path: '/',
    name: 'beranda',
    component: Home
  },
  {
    path: '/curah-hujan',
    name: 'curahHujan',
    component: CurahHujan
  },
  {
    path: '/tma-debit',
    name: 'tmaDebit',
    component: TmaDebit
  },
  {
    path: '/iklim',
    name: 'iklim',
    component: Iklim
  },
  {
    path: '/kualitas-air',
    name: 'kualitasAir',
    component: KualitasAir
  },
  {
    path: '/permohonan-data',
    name: 'permohonanData',
    component: PermohonanData
  }
]

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes
})

export default router
