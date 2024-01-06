<script setup>
import Layout from '~Layouts/Private.vue'
import { Link } from '@inertiajs/vue3'

defineProps({ title: String })
</script>

<template>
    <Layout :title="title + ' - Tasificar'">
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
