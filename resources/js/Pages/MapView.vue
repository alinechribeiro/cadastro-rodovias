<template>
  <div style="height:600px; width:800px">
      <l-map :zoom="4" :center="[-15.7942, -47.8822]" style="height: 100%; width: 100%;">
      <l-tile-layer
        url="https://tile.openstreetmap.org/{z}/{x}/{y}.png"
        attribution='&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
      />
      <l-geo-json :geojson="geojson" :options="geojsonOptions" />
    </l-map>
  </div>
</template>

<script setup>
import "leaflet/dist/leaflet.css";
import {ref, onMounted} from "vue";
import { LMap, LGeoJson, LTileLayer } from "@vue-leaflet/vue-leaflet";
import { circleMarker } from "leaflet";
import {useForm, usePage} from '@inertiajs/vue3';

// Reactive state
const geojson = ref(JSON.parse(usePage().props.trecho.geo));
const geojsonOptions = ref({
  pointToLayer: (feature, latLng) =>
    circleMarker(latLng, { radius: 8 }),
});
</script>

<!-- <style scoped> -->
<!-- Add any scoped styles here if needed -->
<!-- </style> -->
