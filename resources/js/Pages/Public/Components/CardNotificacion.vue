<template>
    <div class="w-full h-auto p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
        <div class="grid grid-cols-2 gap-2">
            <div>
                <p class="lg:text-base md:text-2xl mb-1 font-normal text-gray-500 dark:text-gray-400">Identificación/ NIT</p>
                <p class="lg:text-base md:text-2xl font-normal text-black dark:text-gray-400">111111111</p>
            </div>
            <div>
                <p class="lg:text-base md:text-2xl mb-1 font-normal text-gray-500 dark:text-gray-400">Referencia Contribuyente</p>
                <p class="lg:text-base md:text-2xl font-normal text-black dark:text-gray-400">000000000000000</p>
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
                <p class="uppercase lg:text-base md:text-2xl font-normal text-black dark:text-gray-400">FACTURA OFICIAL</p>
            </div>
            <div>
                <p class="lg:text-base md:text-2xl mb-1 font-normal text-gray-500 dark:text-gray-400">Fecha de publicación</p>
                <p class="lg:text-base md:text-2xl font-normal text-black dark:text-gray-400">13/10/2023</p>
            </div>
        </div>
        <div class="mt-4 flex justify-center space-x-4">
            <button type="button" @click="showModal('modalMostrarNotificacion')" class="inline-flex items-center px-3 py-2 lg:text-sm md:text-2xl font-medium text-center border border-blue-600 bg-white text-blue-600 rounded-lg hover:bg-blue-600 hover:text-white  dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                Ver más
            </button>
            <button type="button" class="group inline-flex items-center space-x-2 px-3 py-2 lg:text-sm md:text-2xl font-medium text-center text-red-600 bg-white border border-red-600 rounded-lg hover:bg-red-600 hover:text-white  dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                <span>Imprimir</span>
                <svg class="lg:w-3 lg:h-3 md:w-6 md:h-6 fill-red-600 group-hover:fill-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M0 64C0 28.7 28.7 0 64 0L224 0l0 128c0 17.7 14.3 32 32 32l128 0 0 144-208 0c-35.3 0-64 28.7-64 64l0 144-48 0c-35.3 0-64-28.7-64-64L0 64zm384 64l-128 0L256 0 384 128zM176 352l32 0c30.9 0 56 25.1 56 56s-25.1 56-56 56l-16 0 0 32c0 8.8-7.2 16-16 16s-16-7.2-16-16l0-48 0-80c0-8.8 7.2-16 16-16zm32 80c13.3 0 24-10.7 24-24s-10.7-24-24-24l-16 0 0 48 16 0zm96-80l32 0c26.5 0 48 21.5 48 48l0 64c0 26.5-21.5 48-48 48l-32 0c-8.8 0-16-7.2-16-16l0-128c0-8.8 7.2-16 16-16zm32 128c8.8 0 16-7.2 16-16l0-64c0-8.8-7.2-16-16-16l-16 0 0 96 16 0zm80-112c0-8.8 7.2-16 16-16l48 0c8.8 0 16 7.2 16 16s-7.2 16-16 16l-32 0 0 32 32 0c8.8 0 16 7.2 16 16s-7.2 16-16 16l-32 0 0 48c0 8.8-7.2 16-16 16s-16-7.2-16-16l0-64 0-64z"/></svg>
            </button>
        </div>
    </div>
</template>

<script lang="ts" setup>
    defineProps({ showModal: Function})
</script>

<style scoped>

</style>
