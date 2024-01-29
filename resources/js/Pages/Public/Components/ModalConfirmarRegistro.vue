<template>
    <div id="modalConfirmarRegistro" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full lg:max-w-2xl md:max-w-4xl max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div class="bg-bluep flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="lg:text-xl md:text-3xl font-semibold text-white dark:text-white">
                        Estimado usuario
                    </h3>
                    <button type="button" class="bg-bluep text-white  bg-transparent rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" @click="hideModal('modalConfirmarRegistro')">
                        <svg class="lg:w-3 lg:h-3 md:w-6 md:h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <div class="lg:text-base md:text-2xl p-4 md:p-5 space-y-4">
                    <p class="mb-5 leading-relaxed text-black dark:text-gray-400 text-center">
                        El número de documento {{ documento }} no existe actualmente como contribuyente del municipio. ¿Desea realizar el proceso de inscripción?
                    </p>
                    <hr>
                    <div class="flex justify-start items-center space-x-2">
                        <svg class="lg:w-10 lg:h-10 md:hidden" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="#00f" d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM216 336h24V272H216c-13.3 0-24-10.7-24-24s10.7-24 24-24h48c13.3 0 24 10.7 24 24v88h8c13.3 0 24 10.7 24 24s-10.7 24-24 24H216c-13.3 0-24-10.7-24-24s10.7-24 24-24zm40-208a32 32 0 1 1 0 64 32 32 0 1 1 0-64z"/></svg>
                        <p class=" text-gray-500 md:text-center">Recuerde tener a mano los datos necesarios para su inscripción como lo son cámara de comercio, RUT, cédula de ciudadanía, entre otros.</p>
                    </div>
                    <hr>
                    <div class="text-center mt-5 text-gray-500 dark:text-gray-400">
                        <p class="font-bold">Si está seguro de que ya está inscrito, puede comunicarse a nuestras líneas de atención.</p>
                        <p >Teléfonos: {{ tenant.telefono }}</p>
                        <p>Email: {{ tenant.correo }}</p>
                        <p>Dirección: {{ tenant.direccion }} - META</p>
                    </div>
                </div>
                <div class="flex justify-end items-center space-x-2 p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                    <a :href="route('public.inscripcion')" type="button" class="text-blue-600 border border-blue-600 bg-white font-medium rounded-lg lg:text-sm md:text-2xl px-5 py-2.5 text-center hover:bg-blue-600 hover:text-white dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Inscribirse</a>
                    <button @click="hideModal('modalConfirmarRegistro')" type="button" class="text-red-600 bg-white border border-red-600 font-medium rounded-lg lg:text-sm md:text-2xl px-5 py-2.5 text-center hover:bg-red-600 hover:text-white dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Cancelar</button>
                </div>
            </div>
        </div>
    </div>
  </template>

<script lang="ts" setup>
    import { Ref,ref} from 'vue';

    const props = defineProps(['documento','hideModal', 'tenant']);
</script>
