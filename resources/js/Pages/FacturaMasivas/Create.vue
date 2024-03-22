<script setup>
import Layout from '~Layouts/Private.vue'
import { useForm } from '@inertiajs/vue3'

const title = 'Crear Facturación Masiva'
const form = useForm({
    minDeuda: 0,
    rurales: true,
    urbanos: true
})
</script>

<template>
    <Layout :title="title">
        <main class="p-4 pt-20 mx-auto text-gray-900 dark:text-white">
            <h1 class="text-3xl text-left">{{ title }}</h1>

            <section class="border-t-2 mt-2 pt-6">
                <form @submit.prevent="form.post(router('factura_masivas.store'))" class="">
                    <label for="min-deuda" class="mb-3 text-sm font-medium text-gray-900 dark:text-white">Deuda superior a</label>
                    <div class="relative w-full mb-5">
                        <div class="absolute inset-y-0 start-0 top-0 flex items-center ps-3.5 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 2a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1M2 5h12a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V6a1 1 0 0 1 1-1Zm8 5a2 2 0 1 1-4 0 2 2 0 0 1 4 0Z"/>
                        </svg>
                        </div>
                        <input v-model="form.minDeuda" type="number" id="min-deuda" class="block p-2.5 w-full z-20 ps-10 text-sm text-gray-900 bg-gray-50 rounded-lg border-e-gray-50 border-e-2 border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-e-gray-700  dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:border-blue-500" placeholder="Ingrese cantidad" step=".1" required>
                    </div>
                    <div class="mb-5">
                        <div class="flex items-center mb-4">
                            <input v-model="form.rurales" id="rurales-checkbox" type="checkbox" value="" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                            <label for="rurales-checkbox" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Cobrar a rurales</label>
                        </div>
                        <div class="flex items-center mb-4">
                            <input v-model="form.urbanos" id="urbanos-checkbox" type="checkbox" value="" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                            <label for="urbanos-checkbox" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Cobrar a urbanos</label>
                        </div>
                    </div>
                    <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Guardar</button>
                </form>
            </section>
        </main>
    </Layout>
</template>
