<template>
    <Head title="Cadastro de Trechos" />
    <div class="container p-4 mx-auto">
        <h1 class="mb-4 text-xl font-bold">Cadastro de Trechos</h1>
        <form @submit.prevent="submitForm">
            <div class="mb-4">
                <label for="data_referencia" class="block text-sm font-medium text-gray-700">Data de Referência</label>
                <input type="date" v-model="form.data_referencia" id="data_referencia" class="block w-full mt-1" required />
            </div>

            <div class="mb-4">
                <label for="uf_id" class="block text-sm font-medium text-gray-700">Unidade da Federação</label>
                <select v-model="form.uf_id" id="uf_id" class="block w-full mt-1" required>
                    <option v-for="uf in ufs" :key="uf.id" :value="uf.id">{{ uf.sigla }} - {{ uf.nome }}</option>
                </select>
            </div>

            <div class="mb-4">
                <label for="rodovia_id" class="block text-sm font-medium text-gray-700">Rodovia</label>
                <select v-model="form.rodovia_id" id="rodovia_id" class="block w-full mt-1" required>
                    <option v-for="rodovia in rodovias" :key="rodovia.id" :value="rodovia.id">{{ rodovia.uf_sigla }}-{{ rodovia.rodovia }}</option>
                </select>
            </div>

            <div class="mb-4">
                <label for="tipo_trecho" class="block text-sm font-medium text-gray-700">Tipo de Trecho</label>
                <select v-model="form.tipo_trecho" id="tipo_trecho" class="block w-full mt-1" required>
                    <option value="B">Tipo B</option>
                </select>
            </div>

            <div class="mb-4">
                <label for="km_inicial" class="block text-sm font-medium text-gray-700">Quilometragem Inicial</label>
                <input type="number" v-model="form.km_inicial" id="km_inicial" class="block w-full mt-1" required />
            </div>

            <div class="mb-4">
                <label for="km_final" class="block text-sm font-medium text-gray-700">Quilometragem Final</label>
                <input type="number" v-model="form.km_final" id="km_final" class="block w-full mt-1" required />
            </div>

            <button type="submit" class="px-4 py-2 text-white bg-blue-500 rounded">Cadastrar</button>
        </form>
        <TrechoList @edit="editTrecho" :key="trechoListKey" />
    </div>
</template>

<script setup>
import { Head, useForm } from '@inertiajs/vue3';
import axios from 'axios';
import { ref, computed, onMounted, watch } from 'vue';
import TrechoList from './TrechoList.vue';

const form = useForm({
    id: null,
    data_referencia: '',
    uf_id: '',
    rodovia_id: '',
    tipo_trecho: '',
    km_inicial: '',
    km_final: '',
    geo: ''
});

const ufs = ref([]);
const rodovias = ref([]);
const trechoListKey = ref(0);
const selectedUf = computed(() => ufs.value.find(uf => uf.id === form.uf_id));
const selectedRodovia = computed(() => rodovias.value.find(rodovia => rodovia.id === form.rodovia_id));

onMounted(() => {
    fetchUfs();
    fetchRodovias();
});

function fetchUfs() {
    axios.get('/ufs')
        .then(response => {
            ufs.value = response.data;
        })
        .catch(error => {
            console.error('Error fetching UFs:', error);
        });
}

// Watch the UF selection to fetch rodovias based on the selected UF
watch(() => form.uf_id, (newUfId) => {
    if (newUfId) {
        fetchRodovias(newUfId);
    }
});

function fetchRodovias(ufId) {
    axios.get(`/rodovias/${ufId}`)
        .then(response => {
            rodovias.value = response.data;
        })
        .catch(error => {
            console.error('Error fetching Rodovias:', error);
        });
}

function submitForm() {
    createTrecho();
}

function createTrecho() {
    if (!selectedUf.value || !selectedRodovia.value) {
        alert('Por favor, selecione UF e Rodovia antes de cadastrar.');
        return;
    }

    axios.post('/geo', {
        br: selectedRodovia.value.rodovia,
        tipo: form.tipo_trecho,
        uf: selectedUf.value.sigla,
        cd_tipo: 'null',
        data: form.data_referencia,
        kmi: form.km_inicial,
        kmf: form.km_final,
    })
        .then(response => {
            console.log(response.data);
            alert('Dados gravados com sucesso!');
            resetForm();
            trechoListKey.value += 1;
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Ocorreu um erro ao processar os dados.');
        });
}

function editTrecho(trecho) {
    form.id = trecho.id;
    form.data_referencia = trecho.data_referencia;
    form.uf_id = trecho.uf_id;
    form.rodovia_id = trecho.rodovia_id;
    form.tipo_trecho = trecho.tipo_trecho;
    form.km_inicial = trecho.km_inicial;
    form.km_final = trecho.km_final;
    form.geo = trecho.geo;
}

function cancelEdit() {
    resetForm();
}

function resetForm() {
    form.reset();
    form.clearErrors();
}
</script>

<style scoped>
/* Adicione estilos personalizados aqui, se necessário */
</style>
