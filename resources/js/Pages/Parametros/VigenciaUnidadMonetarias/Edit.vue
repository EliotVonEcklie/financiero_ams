<script setup>
import Layout from '~Layouts/Parametros.vue'
import { useForm, router } from '@inertiajs/vue3'
import { onMounted } from 'vue'
import { initInputCounters, initDropdowns } from 'flowbite'
import { FwbSelect } from 'flowbite-vue'

onMounted(() => {
    initInputCounters()
    initDropdowns()
})

const props = defineProps({ vigenciaUnidadMonetaria: Object, unidadMonetarias: Array })
const form = useForm({
    vigencia: props.vigenciaUnidadMonetaria.vigencia,
    unidad_monetaria_id: props.vigenciaUnidadMonetaria.unidad_monetaria_id,
    valor: props.vigenciaUnidadMonetaria.valor
})
const unidadMonetariasSelect = props.unidadMonetarias.map(x => ({ value: x.id, name: x.tipo }))
</script>
<template>
    <Layout title="Editar Vigencia Unidad Monetaria">
        <form @submit.prevent="form.put(route('vigencia_unidad_monetarias.update', props.vigenciaUnidadMonetaria.id))" class="max-w-sm mx-auto">
            <div class="mb-5">
                <label for="quantity-input" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Ingrese Vigencia:</label>
                <div class="relative flex items-center w-full">
                <button type="button" id="decrement-button" data-input-counter-decrement="quantity-input" class="bg-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 dark:border-gray-600 hover:bg-gray-200 border border-gray-300 rounded-s-lg p-3 h-11 focus:ring-gray-100 dark:focus:ring-gray-700 focus:ring-2 focus:outline-none">
                    <svg class="w-3 h-3 text-gray-900 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 2">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h16"/>
                    </svg>
                </button>
                <input v-model="form.vigencia" type="text" id="quantity-input" data-input-counter aria-describedby="helper-text-explanation" class="bg-gray-50 border-x-0 border-gray-300 h-11 text-center text-gray-900 text-sm focus:ring-blue-500 focus:border-blue-500 block w-full py-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="YYYY" required>
                <button type="button" id="increment-button" data-input-counter-increment="quantity-input" class="bg-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 dark:border-gray-600 hover:bg-gray-200 border border-gray-300 rounded-e-lg p-3 h-11 focus:ring-gray-100 dark:focus:ring-gray-700 focus:ring-2 focus:outline-none">
                    <svg class="w-3 h-3 text-gray-900 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 1v16M1 9h16"/>
                    </svg>
                </button>
                </div>
                <p id="helper-text-explanation" class="mt-2 text-sm text-gray-500 dark:text-gray-400">Ingrese un año.</p>
            </div>

            <div class="relative w-full mb-5">
                <fwb-select
                    v-model="form.unidad_monetaria_id"
                    :options="unidadMonetariasSelect"
                    label="Unidad Monetaria"
                    placeholder="Seleccione una unidad"
                />
            </div>

            <label for="desde" class="mb-2 text-sm font-medium text-gray-900 dark:text-white">Valor:</label>
            <div class="relative w-full mb-5">
                <div class="absolute inset-y-0 start-0 top-0 flex items-center ps-3.5 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 2a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1M2 5h12a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V6a1 1 0 0 1 1-1Zm8 5a2 2 0 1 1-4 0 2 2 0 0 1 4 0Z"/>
                </svg>
                </div>
                <input v-model="form.valor" type="number" id="desde" class="block p-2.5 w-full z-20 ps-10 text-sm text-gray-900 bg-gray-50 rounded-lg border-e-gray-50 border-e-2 border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-e-gray-700  dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:border-blue-500" placeholder="Ingrese cantidad" step=".01" required>
            </div>

            <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Guardar</button>
        </form>
    </Layout>
</template>
