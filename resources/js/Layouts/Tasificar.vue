<script setup>
import Layout from '~Layouts/Private.vue'
import { Link } from '@inertiajs/vue3'

defineProps({ title: String })
</script>

<template>
    <Layout :title="title + ' - Tasificar'" sidebar>
        <aside id="default-sidebar" class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full bg-white border-r border-gray-200 sm:translate-x-0 dark:bg-gray-800 dark:border-gray-700" aria-label="Menú">
            <div class="h-full px-3 py-4 overflow-y-auto bg-gray-50 dark:bg-gray-800">
                <ul class="space-y-2 font-medium">
                    <li>
                        <Link :href="route('rango_avaluos.index')" :class="{ 'bg-gray-100 dark:bg-gray-700': $page.component.startsWith('Tasificar/RangoAvaluos') }" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                            <span class="flex-1 ms-3 whitespace-nowrap">Rangos Avaluos</span>
                        </Link>
                    </li>
                    <li>
                        <Link :href="route('estratificacions.index')" :class="{ 'bg-gray-100 dark:bg-gray-700': $page.component.startsWith('Tasificar/Estratificaciones') }" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                            <span class="flex-1 ms-3 whitespace-nowrap">Estratificaciones</span>
                        </Link>
                    </li>
                    <li>
                        <Link :href="route('tasificar.dispatch')" :disabled="$page.component.startsWith('Tasificar/Process')" class="flex items-center p-2 rounded-lg text-black hover:text-white dark:text-white border-2 border-green-500 dark:border-green-600 hover:bg-green-500 dark:bg-green-800 dark:hover:bg-green-600 group" :class="{ 'border-gray-700 bg-gray-500 text-white': $page.component.startsWith('Tasificar/Process') }">
                            <span class="flex-1 ms-3 whitespace-nowrap">Tasificar</span>
                            <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 20">
                                <path d="M8 5.625c4.418 0 8-1.063 8-2.375S12.418.875 8 .875 0 1.938 0 3.25s3.582 2.375 8 2.375Zm0 13.5c4.963 0 8-1.538 8-2.375v-4.019c-.052.029-.112.054-.165.082a8.08 8.08 0 0 1-.745.353c-.193.081-.394.158-.6.231l-.189.067c-2.04.628-4.165.936-6.3.911a20.601 20.601 0 0 1-6.3-.911l-.189-.067a10.719 10.719 0 0 1-.852-.34 8.08 8.08 0 0 1-.493-.244c-.053-.028-.113-.053-.165-.082v4.019C0 17.587 3.037 19.125 8 19.125Zm7.09-12.709c-.193.081-.394.158-.6.231l-.189.067a20.6 20.6 0 0 1-6.3.911 20.6 20.6 0 0 1-6.3-.911l-.189-.067a10.719 10.719 0 0 1-.852-.34 8.08 8.08 0 0 1-.493-.244C.112 6.035.052 6.01 0 5.981V10c0 .837 3.037 2.375 8 2.375s8-1.538 8-2.375V5.981c-.052.029-.112.054-.165.082a8.08 8.08 0 0 1-.745.353Z"/>
                            </svg>
                        </Link>
                    </li>
                </ul>
            </div>
        </aside>

        <main class="p-4 mt-[69px] sm:ml-64 text-gray-900 dark:text-white">
            <h1 class="text-3xl text-left">{{ title }}</h1>

            <section class="border-t-2 mt-2 pt-6">
                <slot />
            </section>
        </main>
    </Layout>
</template>
