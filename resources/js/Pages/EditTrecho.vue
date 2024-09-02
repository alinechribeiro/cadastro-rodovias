<template>
    <div className="container mx-auto p-4">
        <h2 className="text-2xl font-bold mb-4">Editar Trecho</h2>
        <form @submit.prevent="updateTrecho">
            <div className="mb-4">
                <label className="block text-gray-700">Data de Referência</label>
                <input v-model="form.data_referencia" type="date" className="w-full px-3 py-2 border rounded">
            </div>
            <div className="mb-4">
                <label className="block text-gray-700">UF</label>
                <input v-model="form.uf_id" type="text" className="w-full px-3 py-2 border rounded">
            </div>
            <div className="mb-4">
                <label className="block text-gray-700">Rodovia</label>
                <input v-model="form.rodovia_id" type="text" className="w-full px-3 py-2 border rounded">
            </div>
            <div className="mb-4">
                <label className="block text-gray-700">KM Inicial</label>
                <input v-model="form.quilometragem_inicial" type="number" className="w-full px-3 py-2 border rounded">
            </div>
            <div className="mb-4">
                <label className="block text-gray-700">KM Final</label>
                <input v-model="form.quilometragem_final" type="number" className="w-full px-3 py-2 border rounded">
            </div>
            <button type="submit" className="bg-blue-500 text-white px-4 py-2 rounded">Salvar Alterações</button>
        </form>
        <hr>
        <MapView />
    </div>
</template>

<script setup>
import {useForm, usePage} from '@inertiajs/vue3';
import {onMounted} from 'vue';
import axios from 'axios';
import MapView from './MapView.vue';

const form = useForm({
    id: null,
    data_referencia: '',
    uf_id: '',
    rodovia_id: '',
    quilometragem_inicial: '',
    quilometragem_final: '',
    geo: {},
});

const fetchTrecho = async () => {
    try {
        form.id = usePage().props.trecho.id;
        form.data_referencia = usePage().props.trecho.data_referencia;
        form.uf_id = usePage().props.trecho.uf_id;
        form.rodovia_id = usePage().props.trecho.rodovia_id;
        form.quilometragem_inicial = usePage().props.trecho.quilometragem_inicial;
        form.quilometragem_final = usePage().props.trecho.quilometragem_final;
        form.geo = JSON.parse(usePage().props.trecho.geo);
    } catch (error) {
        console.error('Error fetching trecho data:', error);
    }
};

const updateTrecho = async () => {
    try {
        const response = await axios.put(`/trechos/${form.id}`, form);

        // If the request is successful, redirect to the home page
        if (response.status === 200) {
            window.location.href = '/';
            // Inertia.visit('home'); // Redirect to the home page after successful update
        }
    } catch (error) {
        // Log the error to the console for debugging
        console.error('Error updating trecho:', error);

        // Optionally, you can display an error message to the user
        alert('Ocorreu um erro ao atualizar o trecho. Por favor, tente novamente.');
    }
};

onMounted(fetchTrecho);
</script>
