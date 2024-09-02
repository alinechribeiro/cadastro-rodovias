<template>
    <div class="container mx-auto p-4">
        <h2 class="text-2xl font-bold mb-4">Lista de Trechos</h2>
        <table class="min-w-full bg-white">
            <thead>
            <tr>
                <th class="py-2 px-4 border-b">Data de Referência</th>
                <th class="py-2 px-4 border-b">UF</th>
                <th class="py-2 px-4 border-b">Rodovia</th>
                <th class="py-2 px-4 border-b">KM Inicial</th>
                <th class="py-2 px-4 border-b">KM Final</th>
                <th class="py-2 px-4 border-b">Ações</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="trecho in trechos.data" :key="trecho.id">
                <td class="py-2 px-4 border-b">{{ trecho.data_referencia }}</td>
                <td class="py-2 px-4 border-b">{{ trecho.uf_sigla }}</td>
                <td class="py-2 px-4 border-b">{{ trecho.uf_sigla }}-{{ trecho.rodovia_numero }}</td>
                <td class="py-2 px-4 border-b">{{ trecho.quilometragem_inicial }}</td>
                <td class="py-2 px-4 border-b">{{ trecho.quilometragem_final }}</td>
                <td class="py-2 px-4 border-b">
                    <button @click="editTrecho(trecho)" class="bg-blue-500 text-white px-2 py-1 rounded mr-2">Editar</button>
                    <button @click="deleteTrecho(trecho.id)" class="bg-red-500 text-white px-2 py-1 rounded">Excluir</button>
                </td>
            </tr>
            </tbody>
        </table>
        <div class="mt-4">
            <button v-for="link in trechos.links" :key="link.label" @click="changePage(link.url)" :disabled="!link.url" :class="{'bg-blue-500 text-white': link.active}" class="px-2 py-1 rounded mr-2">
                {{ decodeHtml(link.label) }}
            </button>
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import axios from 'axios';

const trechos = ref({ data: [], links: [] });
const currentPage = ref(1);
const form = ref({
    data_referencia: '',
    uf_id: '',
    rodovia_id: '',
    quilometragem_inicial: '',
    quilometragem_final: '',
});
const fetchTrechos = async (page = 1) => {
    try {
        const response = await axios.get(`/trechos?page=${page}`);
        trechos.value = response.data;
    } catch (error) {
        console.error('Error fetching trechos:', error);
    }
};

const changePage = (url) => {
    if (url) {
        const page = new URL(url).searchParams.get('page');
        fetchTrechos(page);
    }
};

const editTrecho = (trecho) => {
    window.location.href = `/trechos/${trecho.id}/edit`;
};

const deleteTrecho = async (id) => {
    if (confirm('Tem certeza que deseja apagar esse trecho?')) {
        try {
            await axios.delete(`/trechos/${id}`);
            fetchTrechos(currentPage.value);
        } catch (error) {
            console.error('Error deleting trecho:', error);
        }
    }
};

function decodeHtml(html) {
    const txt = document.createElement('textarea');
    txt.innerHTML = html;
    return txt.value;
}

onMounted(() => {
    fetchTrechos();
});
</script>
