<script setup>
import { Head, Link } from '@inertiajs/vue3'
import { onMounted } from 'vue'
import { initFlowbite } from 'flowbite'

onMounted(() => {
    initFlowbite()
})

defineProps({ title: String })
</script>

<template>
    <Head :title="title"></Head>

    <main>
        <button data-drawer-target="default-sidebar" data-drawer-toggle="default-sidebar" aria-controls="default-sidebar" type="button" class="inline-flex items-center p-2 mt-2 ms-3 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
            <span class="sr-only">Abrir menú</span>
            <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
            <path clip-rule="evenodd" fill-rule="evenodd" d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"></path>
            </svg>
        </button>

        <aside id="default-sidebar" class="fixed top-0 left-0 z-40 w-80 h-screen transition-transform -translate-x-full sm:translate-x-0" aria-label="Menú">
            <div class="h-full px-3 py-4 overflow-y-auto bg-gray-50 dark:bg-gray-800">
                <ul class="space-y-2 font-medium">
                    <li>
                        <Link :href="route('upload_igac.index')" :class="{ 'bg-gray-100 dark:bg-gray-700': $page.component.startsWith('UploadIgac') }" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                            <span class="ms-3">1. Importar Información Predial</span>
                        </Link>
                    </li>
                    <li>
                        <Link :href="route('destino_economicos.index')" :class="{ 'bg-gray-100 dark:bg-gray-700': $page.component.startsWith('DestinoEconomicos') }" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                            <span class="ms-3">2. Destinos Economicos</span>
                        </Link>
                    </li>
                    <li>
                        <Link :href="route('vigencia_unidad_monetarias.index')" :class="{ 'bg-gray-100 dark:bg-gray-700': $page.component.startsWith('VigenciaUnidadMonetarias') }" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                            <span class="flex-1 ms-3 whitespace-nowrap">3. Vigencias Unidades Monetarias</span>
                        </Link>
                    </li>
                    <li>
                        <Link :href="route('rango_avaluos.index')" :class="{ 'bg-gray-100 dark:bg-gray-700': $page.component.startsWith('RangoAvaluos') }" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                            <span class="flex-1 ms-3 whitespace-nowrap">4. Rangos Avaluos</span>
                        </Link>
                    </li>
                    <li>
                        <Link :href="route('estratificaciones.index')" :class="{ 'bg-gray-100 dark:bg-gray-700': $page.component.startsWith('Estratificaciones') }" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                            <span class="flex-1 ms-3 whitespace-nowrap">5. Estratificaciones</span>
                        </Link>
                    </li>
                </ul>
                <ul class="pt-4 mt-4 space-y-2 font-medium border-t border-gray-200 dark:border-gray-700">
                    <li>
                        <Link :href="route('unidad_monetarias.index')" :class="{ 'bg-gray-100 dark:bg-gray-700': $page.component.startsWith('UnidadMonetarias') }" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                            <span class="flex-1 ms-3 whitespace-nowrap">A. Unidades Monetarias</span>
                        </Link>
                    </li>
                    <li>
                        <Link :href="route('predio_tipos.index')" :class="{ 'bg-gray-100 dark:bg-gray-700': $page.component.startsWith('PredioTipos') }" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                            <span class="flex-1 ms-3 whitespace-nowrap">B. Tipos Predios</span>
                        </Link>
                    </li>
                    <li>
                        <Link :href="route('predio_estratos.index')" :class="{ 'bg-gray-100 dark:bg-gray-700': $page.component.startsWith('PredioEstratos') }" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                            <span class="flex-1 ms-3 whitespace-nowrap">C. Estratos</span>
                        </Link>
                    </li>
                </ul>
            </div>
        </aside>

        <div class="p-4 sm:ml-80 h-screen text-gray-900 dark:text-white">
            <h1 class="text-3xl text-left">{{ title }}</h1>

            <div class="border-t-2 mt-2 pt-6">
                <slot />
            </div>
        </div>
    </main>
</template>
