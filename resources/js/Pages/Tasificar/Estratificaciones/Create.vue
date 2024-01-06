<script setup>
import Layout from '~Components/Layout.vue'
import { useForm } from '@inertiajs/vue3'
import { ref } from 'vue'
import { FwbSelect } from 'flowbite-vue'

const props = defineProps({
    predioTipos: Array,
    destinoEconomicos: Array,
    rangoAvaluos: Array,
    predioEstratos: Array
})
const form = useForm({
    vigencia: null,
    predio_tipo_id: '',
    destino_economico_id: '',
    tarifa: '',
    tasa: 0
})
const predioTiposSelect = props.predioTipos.map(x => ({ value: x.id, name: x.nombre }))
const destinoEconomicosSelect = props.destinoEconomicos.map(x => ({ value: x.id, name: x.nombre }))
const rangoAvaluosSelect = props.rangoAvaluos.map(x => ({
    value: { id: x.id, type: '\\App\\Models\\RangoAvaluo'},
    name: x.id + ' | ' + 'Desde ' + x.desde + ' hasta ' + x.hasta + ' - ' + x.unidadMonetaria.tipo
}))
const predioEstratosSelect = props.predioEstratos.map(x => ({
    value: { id: x.id, type: '\\App\\Models\\PredioEstrato' },
    name: 'Estrato ' + x.estrato
}))
const tab = ref(1)
</script>

<template>
    <Layout title="Crear Estratificaciones">
        <form @submit.prevent="form.post(route('estratificacions.store'))" class="max-w-sm mx-auto">
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
                    v-model="form.predio_tipo_id"
                    :options="predioTiposSelect"
                    label="Tipo de Predio"
                    placeholder="Seleccione un tipo"
                />
            </div>

            <div class="relative w-full mb-5">
                <fwb-select
                    v-model="form.destino_economico_id"
                    :options="destinoEconomicosSelect"
                    label="Destino Económico"
                    placeholder="Seleccione un destino"
                />
            </div>

            <div class="mb-5">
                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tipo de tarifa</label>
                <ul class="mb-2 flex flex-wrap text-sm font-medium text-center text-gray-500 border-b border-gray-200 dark:border-gray-700 dark:text-gray-400">
                    <li class="me-2">
                        <a href="#" @click="form.tarifa = ''; tab = 1" class="inline-block p-4 rounded-t-lg" :class="{ 'text-blue-600 bg-gray-100 dark:bg-gray-800 dark:text-blue-500': tab == 1, 'hover:text-gray-600 hover:bg-gray-50 dark:hover:bg-gray-800 dark:hover:text-gray-300': tab != 1 }">Rango avalúo</a>
                    </li>
                    <li class="me-2">
                        <a href="#" @click="form.tarifa = ''; tab = 2" class="inline-block p-4 rounded-t-lg" :class="{ 'text-blue-600 bg-gray-100 dark:bg-gray-800 dark:text-blue-500': tab == 2, 'hover:text-gray-600 hover:bg-gray-50 dark:hover:bg-gray-800 dark:hover:text-gray-300': tab != 2 }">Estrato</a>
                    </li>
                </ul>

                <div v-if="tab == 1">
                    <fwb-select
                        v-model="form.tarifa"
                        :options="rangoAvaluosSelect"
                        label=""
                        placeholder="Seleccione un rango avalúo"
                    />
                </div>
                <div v-else-if="tab == 2">
                    <fwb-select
                        v-model="form.tarifa"
                        :options="predioEstratosSelect"
                        label=""
                        placeholder="Seleccione un estrato"
                    />
                </div>
            </div>

            <div class="mb-5">
                <label for="quantity-input2" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tasa:</label>
                <div class="relative flex items-center w-full">
                    <button type="button" id="decrement-button" data-input-counter-decrement="quantity-input" class="bg-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 dark:border-gray-600 hover:bg-gray-200 border border-gray-300 rounded-s-lg p-3 h-11 focus:ring-gray-100 dark:focus:ring-gray-700 focus:ring-2 focus:outline-none">
                        <svg class="w-3 h-3 text-gray-900 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 2">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h16"/>
                        </svg>
                    </button>
                    <input v-model="form.tasa" type="text" id="quantity-input2" data-input-counter class="bg-gray-50 border-x-0 border-gray-300 h-11 text-center text-gray-900 text-sm focus:ring-blue-500 focus:border-blue-500 block w-full py-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Tasa" required>
                    <button type="button" id="increment-button" data-input-counter-increment="quantity-input" class="bg-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 dark:border-gray-600 hover:bg-gray-200 border border-gray-300 rounded-e-lg p-3 h-11 focus:ring-gray-100 dark:focus:ring-gray-700 focus:ring-2 focus:outline-none">
                        <svg class="w-3 h-3 text-gray-900 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 1v16M1 9h16"/>
                        </svg>
                    </button>
                </div>
            </div>

            <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Crear</button>
        </form>
    </Layout>
</template>
