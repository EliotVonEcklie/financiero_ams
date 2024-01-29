<script setup>
import Layout from '~Layouts/Private.vue'
import { Link } from '@inertiajs/vue3'

defineProps({ title: String })
</script>

<template>
    <Layout :title="title + ' - Parámetros Generales'" sidebar>
        <aside id="default-sidebar" class="fixed top-0 left-0 z-40 w-[301px] pt-20 h-screen transition-transform -translate-x-full bg-white border-r border-gray-200 sm:translate-x-0 dark:bg-gray-800 dark:border-gray-700" aria-label="Menú">
            <div class="h-full px-3 py-4 overflow-y-auto bg-gray-50 dark:bg-gray-800">
                <ul class="space-y-2 font-medium">
                    <li>
                        <Link :href="route('destino_economicos.index')" :class="{ 'bg-gray-100 dark:bg-gray-700': $page.component.startsWith('Parametros/DestinoEconomicos') }" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                            <span class="flex-1 ms-3 whitespace-nowrap">Destinos Economicos</span>
                        </Link>
                    </li>
                    <li>
                        <Link :href="route('vigencia_unidad_monetarias.index')" :class="{ 'bg-gray-100 dark:bg-gray-700': $page.component.startsWith('Parametros/VigenciaUnidadMonetarias') }" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                            <span class="flex-1 ms-3 whitespace-nowrap">Vigencias Unidades Monetarias</span>
                        </Link>
                    </li>
                    <li>
                        <Link :href="route('interes.index')" :class="{ 'bg-gray-100 dark:bg-gray-700': $page.component.startsWith('Parametros/Interes') }" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                            <span class="flex-1 ms-3 whitespace-nowrap">Tasas de Interés</span>
                        </Link>
                    </li>
                    <li>
                        <Link :href="route('descuentos.index')" :class="{ 'bg-gray-100 dark:bg-gray-700': $page.component.startsWith('Parametros/Descuentos') }" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                            <span class="flex-1 ms-3 whitespace-nowrap">Descuentos Incentivos</span>
                        </Link>
                    </li>
                    <li>
                        <Link :href="route('unidad_monetarias.index')" :class="{ 'bg-gray-100 dark:bg-gray-700': $page.component.startsWith('Parametros/UnidadMonetarias') }" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                            <span class="flex-1 ms-3 whitespace-nowrap">Unidades Monetarias</span>
                        </Link>
                    </li>
                    <li>
                        <Link :href="route('predio_tipos.index')" :class="{ 'bg-gray-100 dark:bg-gray-700': $page.component.startsWith('Parametros/PredioTipos') }" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                            <span class="flex-1 ms-3 whitespace-nowrap">Tipos Predios</span>
                        </Link>
                    </li>
                    <li>
                        <Link :href="route('predio_estratos.index')" :class="{ 'bg-gray-100 dark:bg-gray-700': $page.component.startsWith('Parametros/PredioEstratos') }" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                            <span class="flex-1 ms-3 whitespace-nowrap">Estratos</span>
                        </Link>
                    </li>
                </ul>
            </div>
        </aside>

        <main class="p-4 pt-20 sm:ml-[301px] text-gray-900 dark:text-white">
            <h1 class="text-3xl text-left">{{ title }}</h1>

            <section class="border-t-2 mt-2 pt-6">
                <slot />
            </section>
        </main>
    </Layout>
</template>
