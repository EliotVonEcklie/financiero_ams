<template>
    <Layout :tenant="tenant">
        <div class="flex justify-center xl:mt-36 xl:p-10 md:mt-48 mx-auto container">
            <div class="p-4 w-full max-w-md bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                <div class="relative flex flex-col items-center pb-10">
                    <svg class="bg-green-500 rounded-full relative h-20 w-20 -top-10 fill-white" xmlns="http://www.w3.org/2000/svg"  viewBox="0 -960 960 960" ><path d="M382-240 154-468l57-57 171 171 367-367 57 57-424 424Z"/></svg>
                    <h5 class="mb-1 text-xl font-medium text-gray-900 dark:text-white">$220.000</h5>
                    <div class="mt-4 border-dashed border-2 w-full border-gray-300"> </div>
                </div>
                <div class="mb-4 flex justify-between px-4 py-2 border-b-2 border-gray-200">
                    <p class="lg:text-base md:text-3xl text-center text-gray-500 dark:text-white">Estado</p>
                    <span  class="bg-green-500 text-white lg:text-xs md:text-2xl font-medium me-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">Pagado</span>
                </div>
                <div class="mb-4 flex justify-between px-4 py-2 border-b-2 border-gray-200">
                    <p class="lg:text-base md:text-3xl text-center text-gray-500 dark:text-white">Fecha</p>
                    <p class="lg:text-base md:text-3xl text-center dark:text-white">31/01/2024</p>
                </div>
                <div class="mb-4 flex justify-between px-4 py-2 border-b-2 border-gray-200">
                    <p class="lg:text-base md:text-3xl text-center text-gray-500 dark:text-white">Transacción</p>
                    <p class="lg:text-base md:text-3xl text-center dark:text-white">192072-1706734692-42378</p>
                </div>
                <div class="mb-4 flex justify-between px-4 py-2 border-b-2 border-gray-200">
                    <p class="lg:text-base md:text-3xl text-center text-gray-500 dark:text-white">Referencia</p>
                    <p class="lg:text-base md:text-3xl text-center dark:text-white">rdTOhlt</p>
                </div>
            </div>
        </div>
    </Layout>
</template>

<script lang="ts" setup>
    import Layout from './Layout.vue';
    defineProps({ tenant: Object})
</script>

<style scoped>

</style>
