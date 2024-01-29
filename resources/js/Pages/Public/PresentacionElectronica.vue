<template>
    <Layout :tenant="tenant" v-slot="{ showModal, hideModal }">

        <h2 class="text-2xl md:text-4xl text-center font-medium text-gray-900 dark:text-white mb-8 mt-5">Presentación electrónica</h2>
        <div class="w-full h-auto p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
            <h5 class="mb-2 lg:text-2xl md:text-3xl font-semibold tracking-tight text-gray-900 dark:text-white">Normatividad</h5>
            <p class="mb-3 lg:text-base md:text-2xl font-normal text-gray-500 dark:text-gray-400">Aquí podra encontrar la clasificación de normatividad que reglamenta el uso de la Firma Electronica</p>
            <div class="mt-5 grid xl:grid-cols-8  lg:grid-cols-4 md:grid-cols-1 lg:gap-4 md:gap-10 ">
                <CardReglamento/>
                <CardReglamento/>
                <CardReglamento/>
                <CardReglamento/>
            </div>
        </div>
        <div class=" mt-5 w-full h-auto p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
            <h5 class="mb-2 lg:text-2xl md:text-3xl font-semibold tracking-tight text-gray-900 dark:text-white">Guías y videos</h5>
            <p class="mb-3 lg:text-base md:text-2xl font-normal text-gray-500 dark:text-gray-400">Guías y Videos del proceso integral de Presentación Electrónica de Declaraciones, en sus apartados finales encontrarás una serie de preguntas y respuestas que podrán surgir en el transcurso de la utilización de este servicio</p>
            <div class="mt-5 grid xl:grid-cols-4 lg:grid-cols-2 md:grid-cols-1 lg:gap-4 md:gap-10 ">
                <CardGuias/>
                <CardGuias/>
                <CardGuias/>
                <CardGuias/>
            </div>
        </div>
    </Layout>
</template>

<script lang="ts" setup>
    import Layout from './Layout.vue'
    import CardReglamento from './Components/CardReglamento.vue'
    import CardGuias from './Components/CardGuias.vue'
    import { ref,reactive } from 'vue'
    defineProps({ tenant: Object })
</script>

<style scoped>

</style>
