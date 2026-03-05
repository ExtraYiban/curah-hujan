<template>
    <div class="h-128 flex flex-col rounded-xl border border-gray-100 bg-white p-6 shadow-sm">
        <div class="mb-6 flex flex-wrap items-center justify-between gap-4">
            <h3 class="m-0 text-xl font-bold text-gray-800">Peta Samarinda</h3>
            <div class="flex gap-3">
                <div
                    class="flex w-64 items-center gap-2 rounded-lg border border-gray-200 bg-gray-50 px-3 py-2 transition-all focus-within:border-indigo-500 focus-within:ring-2 focus-within:ring-indigo-500/20"
                >
                    <span class="text-sm text-gray-400">🔍</span>
                    <input
                        type="text"
                        placeholder="Cari lokasi..."
                        class="w-full border-none bg-transparent text-sm text-gray-700 placeholder-gray-400 outline-none"
                    />
                </div>
                <button
                    class="flex h-10 w-10 cursor-pointer items-center justify-center rounded-lg border-none bg-indigo-600 text-white shadow-sm transition-colors hover:bg-indigo-700"
                >
                    <span class="text-lg">☰</span>
                </button>
            </div>
        </div>
        <div class="relative z-0 grow overflow-hidden rounded-xl border border-gray-100">
            <l-map ref="map" v-model:zoom="zoom" :center="center" :use-global-leaflet="false">
                <l-tile-layer url="https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png" layer-type="base" name="OpenStreetMap"></l-tile-layer>

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

            <div class="z-1000 absolute left-4 top-4 flex flex-col gap-1 rounded bg-white p-1 shadow-md">
                <button
                    class="flex h-8 w-8 cursor-pointer items-center justify-center border border-gray-200 bg-white text-lg font-bold hover:bg-gray-50"
                    @click="zoomIn"
                >
                    +
                </button>
                <button
                    class="flex h-8 w-8 cursor-pointer items-center justify-center border border-gray-200 bg-white text-lg font-bold hover:bg-gray-50"
                    @click="zoomOut"
                >
                    -
                </button>
            </div>
        </div>
        <div class="mt-2 text-right text-xs text-gray-500">
            Source: <a href="https://inarisk.bnpb.go.id/" target="_blank" class="text-blue-600">InaRISK BNPB</a>
        </div>
    </div>
</template>

<script setup lang="ts">
import 'leaflet/dist/leaflet.css';
import { LMap, LTileLayer, LMarker, LPopup, LWmsTileLayer } from '@vue-leaflet/vue-leaflet';
import L from 'leaflet';
import { ref } from 'vue';

// Fix for marker icon missing in production
type LeafletIconDefault = any;
delete (L.Icon.Default.prototype as LeafletIconDefault)._getIconUrl;

L.Icon.Default.mergeOptions({
    iconRetinaUrl: new URL('leaflet/dist/images/marker-icon-2x.png', import.meta.url).href,
    iconUrl: new URL('leaflet/dist/images/marker-icon.png', import.meta.url).href,
    shadowUrl: new URL('leaflet/dist/images/marker-shadow.png', import.meta.url).href,
});

const zoom = ref(13);
const center = ref<[number, number]>([-0.5022, 117.1536]); // Samarinda coordinates

const zoomIn = () => {
    zoom.value++;
};

const zoomOut = () => {
    zoom.value--;
};
</script>
