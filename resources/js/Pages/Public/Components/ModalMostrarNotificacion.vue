<template>
    <div id="modalMostrarNotificacion" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full lg:max-w-2xl md:max-w-4xl max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div class="bg-blue-600 flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="lg:text-xl md:text-3xl font-semibold text-white dark:text-white">
                        Información de notificación jurídica
                    </h3>
                    <button type="button" class="bg-bluep text-white  bg-transparent rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" @click="hideModal('modalMostrarNotificacion')">
                        <svg class="lg:w-3 lg:h-3 md:w-6 md:h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <div class="lg:text-base md:text-2xl p-4 md:p-5 space-y-4">
                    <div class="grid grid-cols-2 gap-2">
                        <div>
                            <p class="lg:text-base md:text-2xl mb-1 font-normal text-gray-500 dark:text-gray-400">Identificación/ NIT</p>
                            <p class="lg:text-base md:text-2xl font-normal text-black dark:text-gray-400">111111111</p>
                        </div>

                        <div>
                            <p class="lg:text-base md:text-2xl mb-1 font-normal text-gray-500 dark:text-gray-400">Nombre contribuyente</p>
                            <p class="uppercase lg:text-base md:text-2xl font-normal text-black dark:text-gray-400">Nombres apellidos</p>
                        </div>
                        <div>
                            <p class="lg:text-base md:text-2xl mb-1 font-normal text-gray-500 dark:text-gray-400">No. Acto</p>
                            <p class="lg:text-base md:text-2xl font-normal text-black dark:text-gray-400">23100000000000</p>
                        </div>
                        <div>
                            <p class="lg:text-base md:text-2xl mb-1 font-normal text-gray-500 dark:text-gray-400">Tipo de acto</p>
                            <p class="uppercase lg:text-base md:text-2xl font-normal text-black dark:text-gray-400">Factura oficial #2311111111111111</p>
                        </div>
                        <div>
                            <p class="lg:text-base md:text-2xl mb-1 font-normal text-gray-500 dark:text-gray-400">Fecha de acto</p>
                            <p class="lg:text-base md:text-2xl font-normal text-black dark:text-gray-400">13/10/2023</p>
                        </div>
                        <div>
                            <p class="lg:text-base md:text-2xl mb-1 font-normal text-gray-500 dark:text-gray-400">Impuesto</p>
                            <p class="uppercase lg:text-base md:text-2xl font-normal text-black dark:text-gray-400">Impuesto predial unificado</p>
                        </div>
                        <div>
                            <p class="lg:text-base md:text-2xl mb-1 font-normal text-gray-500 dark:text-gray-400">Referencia Contribuyente</p>
                            <p class="lg:text-base md:text-2xl font-normal text-black dark:text-gray-400">000000000000000</p>
                        </div>
                        <div>
                            <p class="lg:text-base md:text-2xl mb-1 font-normal text-gray-500 dark:text-gray-400">Descargas</p>
                            <p class="lg:text-base md:text-2xl font-normal text-black dark:text-gray-400">99</p>
                        </div>
                        <div>
                            <p class="lg:text-base md:text-2xl mb-1 font-normal text-gray-500 dark:text-gray-400">Estado</p>
                            <p class="uppercase lg:text-base md:text-2xl font-normal text-black dark:text-gray-400">Publicada</p>
                        </div>
                        <div>
                            <p class="lg:text-base md:text-2xl mb-1 font-normal text-gray-500 dark:text-gray-400">Fecha de publicación</p>
                            <p class="lg:text-base md:text-2xl font-normal text-black dark:text-gray-400">13/10/2023</p>
                        </div>
                    </div>
                </div>
                <div class="flex justify-end items-center space-x-2 p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                    <button @click="hideModal('modalMostrarNotificacion')" type="button" class="text-gray-500 bg-white border border-gray-500 hover:text-white hover:bg-gray-500 font-medium rounded-lg lg:text-sm md:text-2xl px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
  </template>

<script lang="ts" setup>
    import { Ref,ref} from 'vue';
    const props = defineProps(['hideModal']);
</script>
