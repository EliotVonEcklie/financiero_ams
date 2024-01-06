<script setup>
import Layout from '~Layouts/Private.vue'
import Form from '~Pages/UploadIgac/Form.vue'
import Results from '~Pages/UploadIgac/Results.vue'
import { ref } from 'vue'

const title = 'Importar Información Predial IGAC'
const step = ref(1)
</script>

<template>
    <Layout :title="title">
        <main class="p-4 mt-[69px] text-gray-900 dark:text-white">
            <h1 class="text-3xl text-left">{{ title }}</h1>

            <section class="border-t-2 mt-2 pt-6">
                <ol class="flex items-center w-full text-sm font-medium text-center text-gray-500 dark:text-gray-400 sm:text-base">
                    <li :class="{ 'text-blue-600 dark:text-blue-500': step == 1 }" class="flex md:w-full items-center sm:after:content-[''] after:w-full after:h-1 after:border-b after:border-gray-200 after:border-1 after:hidden sm:after:inline-block after:mx-6 xl:after:mx-10 dark:after:border-gray-700">
                        <span class="flex items-center after:content-['/'] sm:after:hidden after:mx-2 after:text-gray-200 dark:after:text-gray-500">
                            <div v-if="step == 1">
                                <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
                                </svg>
                            </div>
                            <div v-else>
                                <span class="me-2">1</span>
                            </div>
                            Subir <span class="hidden sm:inline-flex sm:ms-2">Archivos</span>
                        </span>
                    </li>
                    <li :class="{ 'text-blue-600 dark:text-blue-500': step == 2 }" class="flex md:w-full items-center after:content-[''] after:w-full after:h-1 after:border-b after:border-gray-200 after:border-1 after:hidden sm:after:inline-block after:mx-6 xl:after:mx-10 dark:after:border-gray-700">
                        <span class="flex items-center after:content-['/'] sm:after:hidden after:mx-2 after:text-gray-200 dark:after:text-gray-500">
                            <div v-if="step == 2">
                                <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
                                </svg>
                            </div>
                            <div v-else>
                                <span class="me-2">2</span>
                            </div>
                            Ver <span class="hidden sm:inline-flex sm:ms-2">Resultados</span>
                        </span>
                    </li>
                </ol>

                <div class="w-full mt-2">
                    <Transition name="fade" mode="out-in">
                        <component :is="step == 1 ? Form : Results" @step="step = 2"></component>
                    </Transition>
                </div>
            </section>
        </main>
    </Layout>
</template>
