<template>
  <div class="bg-indigo-100 rounded-xl p-4 flex flex-col h-125">
    <div class="flex justify-between items-center mb-4">
      <h3 class="m-0 text-2xl text-gray-800">Peta Samarinda</h3>
      <div class="flex gap-4">
        <div class="bg-white rounded-full px-4 py-2 flex items-center gap-2 w-62.5">
          <span class="text-gray-400">🔍</span>
          <input type="text" placeholder="Search Location.." class="border-none outline-none w-full text-sm" />
        </div>
        <button class="bg-blue-900 text-white border-none rounded w-10 h-10 text-xl cursor-pointer flex items-center justify-center">☰</button>
      </div>
    </div>
    <div class="grow rounded-lg overflow-hidden relative z-0">
      <l-map ref="map" v-model:zoom="zoom" :center="center" :use-global-leaflet="false">
        <l-tile-layer
          url="https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png"
          layer-type="base"
          name="OpenStreetMap"
        ></l-tile-layer>
        
        <l-wms-tile-layer
          url="https://inarisk1.bnpb.go.id:8443/geoserver/wms"
          name="Risiko Banjir (InaRISK)"
          layers="raster:INDEKS_BAHAYA_BANJIR1"
          :transparent="true"
          format="image/png"
          version="1.1.0"
          layer-type="overlay"
        ></l-wms-tile-layer>
        
        <l-marker :lat-lng="center">
           <l-popup>Samarinda</l-popup>
        </l-marker>
      </l-map>
      
      <div class="absolute top-4 left-4 z-1000 flex flex-col gap-1 bg-white p-1 rounded shadow-md">
        <button class="w-8 h-8 bg-white border border-gray-200 cursor-pointer font-bold text-lg flex items-center justify-center hover:bg-gray-50" @click="zoomIn">+</button>
        <button class="w-8 h-8 bg-white border border-gray-200 cursor-pointer font-bold text-lg flex items-center justify-center hover:bg-gray-50" @click="zoomOut">-</button>
      </div>
    </div>
    <div class="text-xs text-gray-500 mt-2 text-right">
      Source: <a href="https://inarisk.bnpb.go.id/" target="_blank" class="text-blue-600">InaRISK BNPB</a>
    </div>
  </div>
</template>

<script setup>
import 'leaflet/dist/leaflet.css'
import { LMap, LTileLayer, LMarker, LPopup, LWmsTileLayer } from '@vue-leaflet/vue-leaflet'
import { ref } from 'vue'
import L from 'leaflet'

// Fix for Leaflet marker icons in Vite/Webpack
delete L.Icon.Default.prototype._getIconUrl;
L.Icon.Default.mergeOptions({
  iconRetinaUrl: new URL('leaflet/dist/images/marker-icon-2x.png', import.meta.url).href,
  iconUrl: new URL('leaflet/dist/images/marker-icon.png', import.meta.url).href,
  shadowUrl: new URL('leaflet/dist/images/marker-shadow.png', import.meta.url).href,
});

const zoom = ref(13)
const center = ref([-0.5022, 117.1536]) // Samarinda coordinates

const zoomIn = () => {
  zoom.value++
}

const zoomOut = () => {
  zoom.value--
}
</script>
