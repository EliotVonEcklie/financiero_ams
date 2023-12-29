<script setup>
import Layout from '../Layout.vue'
import { useForm } from '@inertiajs/vue3'
import { onMounted } from 'vue'
import { initInputCounters, initDropdowns } from 'flowbite'
import { FwbSelect } from 'flowbite-vue'

onMounted(() => {
    initInputCounters()
    initDropdowns()
})

const props = defineProps({ unidadMonetarias: Array })
const form = useForm({
    vigencia: null,
    unidad_monetaria_id: ''
})
const unidadMonetariasSelect = props.unidadMonetarias.map(x => ({ value: x.id, name: x.tipo }))
</script>

<template>
    <Layout title="Crear Vigencia Unidad Monetaria">
        <form @submit.prevent="form.post(route('vigencia_unidad_monetarias.store'))" class="max-w-sm mx-auto">
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

            <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Crear</button>
        </form>
    </Layout>
</template>
