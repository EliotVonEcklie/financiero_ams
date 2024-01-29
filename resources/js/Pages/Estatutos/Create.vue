<script setup>
import Layout from '~Layouts/Private.vue'
import { useForm } from '@inertiajs/vue3'

const title = 'Crear Estatuto'
const form = useForm({
    nombre: null,
    vigencia_desde: null,
    vigencia_hasta: null,
    norma_predial: false,
    bomberil: false,
    bomberil_predial: true,
    bomberil_tarifa: true,
    bomberil_tasa: 0,
    ambiental: false,
    ambiental_predial: true,
    ambiental_tarifa: true,
    ambiental_tasa: 0,
    alumbrado: false,
    alumbrado_urbano: false,
    alumbrado_rural: false,
    alumbrado_tarifa: true,
    alumbrado_tasa: 0,
    recibo_caja: 0
})
</script>

<template>
    <Layout :title="title">
        <main class="p-4 pt-20 mx-auto text-gray-900 dark:text-white">
            <h1 class="text-3xl text-left">{{ title }}</h1>

            <section class="border-t-2 mt-2 pt-6">
                <form @submit.prevent="form.post(route('estatutos.store'))" class="max-w-3xl mx-auto">
                    <div class="mb-5">
                        <label for="nombre" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nombre</label>
                        <input v-model="form.nombre" type="text" id="nombre" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                    </div>

                    <div class="mb-5">
                        <label for="quantity-input" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Vigencia de inicio:</label>
                        <div class="relative flex items-center w-full">
                            <button type="button" id="decrement-button" data-input-counter-decrement="quantity-input" class="bg-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 dark:border-gray-600 hover:bg-gray-200 border border-gray-300 rounded-s-lg p-3 h-11 focus:ring-gray-100 dark:focus:ring-gray-700 focus:ring-2 focus:outline-none">
                                <svg class="w-3 h-3 text-gray-900 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 2">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h16"/>
                                </svg>
                            </button>
                            <input v-model="form.vigencia_desde" type="text" id="quantity-input" data-input-counter class="bg-gray-50 border-x-0 border-gray-300 h-11 text-center text-gray-900 text-sm focus:ring-blue-500 focus:border-blue-500 block w-full py-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="YYYY" required>
                            <button type="button" id="increment-button" data-input-counter-increment="quantity-input" class="bg-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 dark:border-gray-600 hover:bg-gray-200 border border-gray-300 rounded-e-lg p-3 h-11 focus:ring-gray-100 dark:focus:ring-gray-700 focus:ring-2 focus:outline-none">
                                <svg class="w-3 h-3 text-gray-900 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 1v16M1 9h16"/>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <div class="mb-5">
                        <label for="quantity-input" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Vigencia final:</label>
                        <div class="relative flex items-center w-full">
                            <button type="button" id="decrement-button" data-input-counter-decrement="quantity-input2" class="bg-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 dark:border-gray-600 hover:bg-gray-200 border border-gray-300 rounded-s-lg p-3 h-11 focus:ring-gray-100 dark:focus:ring-gray-700 focus:ring-2 focus:outline-none">
                                <svg class="w-3 h-3 text-gray-900 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 2">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h16"/>
                                </svg>
                            </button>
                            <input v-model="form.vigencia_hasta" type="text" id="quantity-input2" data-input-counter class="bg-gray-50 border-x-0 border-gray-300 h-11 text-center text-gray-900 text-sm focus:ring-blue-500 focus:border-blue-500 block w-full py-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="YYYY" required>
                            <button type="button" id="increment-button" data-input-counter-increment="quantity-input2" class="bg-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 dark:border-gray-600 hover:bg-gray-200 border border-gray-300 rounded-e-lg p-3 h-11 focus:ring-gray-100 dark:focus:ring-gray-700 focus:ring-2 focus:outline-none">
                                <svg class="w-3 h-3 text-gray-900 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 1v16M1 9h16"/>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <hr class="mb-4">

                    <div class="mb-5 grid grid-cols-4">
                        <label class="relative inline-flex items-center me-5 cursor-pointer">
                            <input type="checkbox" value="" class="sr-only peer" v-model="form.norma_predial">
                            <div class="w-11 h-6 bg-gray-200 rounded-full peer peer-focus:ring-4 peer-focus:ring-red-300 dark:peer-focus:ring-red-800 dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-red-600"></div>
                            <span class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300">Norma predial</span>
                        </label>

                        <label class="relative inline-flex items-center me-5 cursor-pointer">
                            <input type="checkbox" value="" class="sr-only peer" v-model="form.bomberil">
                            <div class="w-11 h-6 bg-gray-200 rounded-full peer dark:bg-gray-700 peer-focus:ring-4 peer-focus:ring-green-300 dark:peer-focus:ring-green-800 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-green-600"></div>
                            <span class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300">Bomberil</span>
                        </label>

                        <label class="relative inline-flex items-center me-5 cursor-pointer">
                            <input type="checkbox" value="" class="sr-only peer" v-model="form.ambiental">
                            <div class="w-11 h-6 bg-gray-200 rounded-full peer dark:bg-gray-700 peer-focus:ring-4 peer-focus:ring-purple-300 dark:peer-focus:ring-purple-800 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-purple-600"></div>
                            <span class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300">Ambiental</span>
                        </label>

                        <label class="relative inline-flex items-center me-5 cursor-pointer">
                            <input type="checkbox" value="" class="sr-only peer" v-model="form.alumbrado">
                            <div class="w-11 h-6 bg-gray-200 rounded-full peer dark:bg-gray-700 peer-focus:ring-4 peer-focus:ring-yellow-300 dark:peer-focus:ring-yellow-800 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-yellow-400"></div>
                            <span class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300">Alumbrado</span>
                        </label>
                    </div>

                    <div class="max-w-lg mx-auto">
                        <div v-if="form.bomberil" class="mb-5">
                            <h2 class="mb-4 text-xl">Parámetros Bomberil</h2>

                            <div @click="form.bomberil_predial = true" class="flex items-center mb-4">
                                <input checked id="default-radio-1" type="radio" value="" name="default-radio" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                <label for="default-radio-1" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Tarifa a base del predial</label>
                            </div>
                            <div @click="form.bomberil_predial = false" class="flex items-center mb-4">
                                <input id="default-radio-2" type="radio" value="" name="default-radio" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                <label for="default-radio-2" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Tarifa a base del avalúo</label>
                            </div>

                            <hr class="mb-4">

                            <div @click="form.bomberil_tarifa = true" class="flex items-center mb-4">
                                <input checked id="default-radio2-1" type="radio" value="" name="default-radio2" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                <label for="default-radio2-1" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Tipo de tarifa: tasa por mil</label>
                            </div>
                            <div @click="form.bomberil_tarifa = false" class="flex items-center mb-4">
                                <input id="default-radio2-2" type="radio" value="" name="default-radio2" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                <label for="default-radio2-2" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Tipo de tarifa: porcentaje</label>
                            </div>

                            <hr class="mb-4">

                            <label for="number-input" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tarifa bomberil:</label>
                            <input v-model="form.bomberil_tasa" type="number" id="number-input" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Valor" required>
                        </div>

                        <div v-if="form.ambiental" class="mb-5">
                            <h2 class="mb-4 text-xl">Parámetros Ambiental</h2>

                            <div @click="form.ambiental_predial = true" class="flex items-center mb-4">
                                <input checked id="default-radio3-1" type="radio" value="" name="default-radio3" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                <label for="default-radio3-1" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Tarifa a base del predial</label>
                            </div>
                            <div @click="form.ambiental_predial = false" class="flex items-center mb-4">
                                <input id="default-radio3-2" type="radio" value="" name="default-radio3" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                <label for="default-radio3-2" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Tarifa a base del avalúo</label>
                            </div>

                            <hr class="mb-4">

                            <div @click="form.ambiental_tarifa = true" class="flex items-center mb-4">
                                <input checked id="default-radio4-1" type="radio" value="" name="default-radio4" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                <label for="default-radio4-1" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Tipo de tarifa: tasa por mil</label>
                            </div>
                            <div @click="form.ambiental_tarifa = false" class="flex items-center mb-4">
                                <input id="default-radio4-2" type="radio" value="" name="default-radio4" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                <label for="default-radio4-2" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Tipo de tarifa: porcentaje</label>
                            </div>

                            <hr class="mb-4">

                            <label for="number-input2" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tarifa ambiental:</label>
                            <input v-model="form.ambiental_tasa" type="number" id="number-input2" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Valor" required>
                        </div>

                        <div v-if="form.alumbrado" class="mb-5">
                            <h2 class="mb-4 text-xl">Parámetros Alumbrado</h2>

                            <div class="flex items-center mb-4">
                                <input v-model="form.alumbrado_rural" id="default-checkbox" type="checkbox" value="" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                <label for="default-checkbox" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Cobrar a rurales</label>
                            </div>
                            <div class="flex items-center mb-4">
                                <input v-model="form.alumbrado_urbano" id="default-checkbox2" type="checkbox" value="" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                <label for="default-checkbox2" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Cobrar a urbanos</label>
                            </div>

                            <hr class="mb-4">

                            <div @click="form.alumbrado_tarifa = true" class="flex items-center mb-4">
                                <input checked id="default-radio6-1" type="radio" value="" name="default-radio6" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                <label for="default-radio6-1" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Tipo de tarifa: tasa por mil</label>
                            </div>
                            <div @click="form.alumbrado_tarifa = false" class="flex items-center mb-4">
                                <input id="default-radio6-2" type="radio" value="" name="default-radio6" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                <label for="default-radio6-2" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Tipo de tarifa: porcentaje</label>
                            </div>

                            <hr class="mb-4">

                            <label for="number-input3" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tarifa alumbrado:</label>
                            <input v-model="form.alumbrado_tasa" type="number" id="number-input3" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Valor" required>
                        </div>

                    </div>

                    <hr class="mb-4">

                    <label for="number-input4" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Cobro recibo de caja:</label>
                    <input v-model="form.recibo_caja" type="number" id="number-input4" class="mb-5 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>

                    <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Crear</button>
                </form>
            </section>
        </main>
    </Layout>
</template>
