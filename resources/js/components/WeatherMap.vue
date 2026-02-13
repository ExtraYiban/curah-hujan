<template>
  <div ref="mapContainer" class="h-full w-full rounded-xl shadow-lg relative"></div>
</template>

<script setup lang="ts">
import { ref, onMounted, onUnmounted } from 'vue';
import L from 'leaflet';
import 'leaflet/dist/leaflet.css';

const mapContainer = ref<HTMLElement | null>(null);
let map: L.Map | null = null;

onMounted(() => {
  if (mapContainer.value) {
    // Initialize map centered on Samarinda
    map = L.map(mapContainer.value, {
      zoomControl: true,
      attributionControl: true
    }).setView([-0.4922, 117.1436], 12);

    // Add OpenStreetMap tiles
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
      attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
      maxZoom: 19
    }).addTo(map);

    // Add marker for Samarinda
    const marker = L.marker([-0.4922, 117.1436]).addTo(map);
    marker.bindPopup('<b>Samarinda</b><br>Kalimantan Timur').openPopup();

    // Invalidate size to ensure proper rendering
    setTimeout(() => {
      if (map) {
        map.invalidateSize();
      }
    }, 100);
  }
});

onUnmounted(() => {
  if (map) {
    map.remove();
    map = null;
  }
});
</script>

<style scoped>
/* Override Leaflet default styles */
:deep(.leaflet-container) {
  border-radius: 0.75rem;
  z-index: 0;
  position: relative;
}

:deep(.leaflet-control-container) {
  position: absolute;
}

:deep(.leaflet-top),
:deep(.leaflet-bottom) {
  z-index: 10;
}
</style>
