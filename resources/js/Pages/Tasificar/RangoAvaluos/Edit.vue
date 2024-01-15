<script setup>
import Layout from '~Layouts/Tasificar.vue'
import { useForm } from '@inertiajs/vue3'
import { FwbSelect } from 'flowbite-vue'
import { initDropdowns } from 'flowbite'
import { onMounted, ref } from 'vue'

onMounted(() => {
    initDropdowns()
})

const en_adelante = ref(false)
const props = defineProps({ rangoAvaluo: Object, unidadMonetarias: Object })
const form = useForm({
    desde: props.rangoAvaluo.desde,
    hasta: props.rangoAvaluo.hasta,
    unidad_monetaria_id: props.rangoAvaluo.unidad_monetaria_id
})
const unidadMonetariasSelect = props.unidadMonetarias.map(x => ({ value: x.id, name: x.nombre }))
</script>

<template>
    <Layout title="Editar Rango Avalúo">
        <form @submit.prevent="form.put(route('rango_avaluos.update', rangoAvaluo.id))" class="max-w-sm mx-auto">
            <label for="desde" class="mb-2 text-sm font-medium text-gray-900 dark:text-white">Desde:</label>
            <div class="relative w-full mb-5">
                <div class="absolute inset-y-0 start-0 top-0 flex items-center ps-3.5 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 2a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1M2 5h12a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V6a1 1 0 0 1 1-1Zm8 5a2 2 0 1 1-4 0 2 2 0 0 1 4 0Z"/>
                </svg>
                </div>
                <input v-model="form.desde" type="number" id="desde" class="block p-2.5 w-full z-20 ps-10 text-sm text-gray-900 bg-gray-50 rounded-lg border-e-gray-50 border-e-2 border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-e-gray-700  dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:border-blue-500" placeholder="Ingrese cantidad" step=".01" required>
            </div>

            <label for="hasta" class="mb-2 text-sm font-medium text-gray-900 dark:text-white">Hasta:</label>
            <div class="relative w-full mb-3">
                <div class="absolute inset-y-0 start-0 top-0 flex items-center ps-3.5 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 2a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1M2 5h12a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V6a1 1 0 0 1 1-1Zm8 5a2 2 0 1 1-4 0 2 2 0 0 1 4 0Z"/>
                </svg>
                </div>
                <input v-model="form.hasta" :disabled="en_adelante" type="number" id="hasta" class="block p-2.5 w-full z-20 ps-10 text-sm text-gray-900 bg-gray-50 rounded-lg border-e-gray-50 border-e-2 border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-e-gray-700  dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:border-blue-500" placeholder="Ingrese cantidad" step=".01" required>
            </div>

            <label class="relative inline-flex items-center mb-5 cursor-pointer">
                <input type="checkbox" v-model="en_adelante" @input="form.hasta = -1" class="sr-only peer">
                <div class="w-9 h-5 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600"></div>
                <span class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300">En adelante</span>
            </label>

            <div class="relative w-full mb-5">
                <fwb-select
                    v-model="form.unidad_monetaria_id"
                    :options="unidadMonetariasSelect"
                    label="Unidad Monetaria"
                    placeholder="Seleccione una unidad"
                />
            </div>

            <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Guardar</button>
        </form>
    </Layout>
</template>
