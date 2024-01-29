<template>
    <div class="relative mb-40">
        <img class="object-cover lg:h-[30rem] md:h-[40rem] w-full brightness-50 " :src="banner" alt="image description">
        <div class="text-center absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 flex justify-center items-center flex-col space-y-5">
            <h1 class="font-bold text-white lg:text-6xl md:text-5xl">Un solo destino para tus impuestos</h1>
            <p class="lg:text-base lg:block md:hidden text-white">Centraliza tus obligaciones en un solo lugar. Desde impuestos prediales hasta retenciones de industria y comercio, nuestro portal te ofrece la solución integral que necesitas. Aprovecha la facilidad, ¡comienza ahora mismo!</p>
        </div>
        <div class="absolute -bottom-[8rem] left-1/2 -translate-x-1/2 flex justify-center space-x-6 ">
            <div class="flex justify-center">
                <div class="lg:w-auto md:w-72 p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                    <a :href="route('public.impuesto_predial_unificado')" class="flex justify-center items-center">
                        <svg class="w-20 h-20 fill-blue-600" xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 24 24"  fill="none"><path d="M0 0h24v24H0z" fill="none"/><path d="M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8z"/></svg>
                    </a>
                    <div class="mt-5 flex justify-center">
                        <a :href="route('public.impuesto_predial_unificado')" class="lg:text-sm md:text-2xl text-blue-600 hover:text-white border border-blue-600 hover:bg-blue-600 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg px-5 py-2.5 text-center  dark:border-blue-500 dark:text-blue-500 dark:hover:text-white dark:hover:bg-blue-500 dark:focus:ring-blue-600">Impuesto predial unificado</a>
                    </div>
                </div>
            </div>
            <div class="flex justify-center ">
                <div v-if="login" class="lg:w-auto md:w-72 p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                    <a  :href="route('public.impuesto_industria_comercio')" class="flex justify-center items-center">
                        <svg class="w-20 h-20 fill-blue-600" xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24"  viewBox="0 0 24 24"  fill="none"><g><rect fill="none" height="24" width="24"/></g><g><path d="M22,10v12H2V10l7-3v2l5-2l0,0l0,3H22z M17.2,8.5L18,2h3l0.8,6.5H17.2z M11,18h2v-4h-2V18z M7,18h2v-4H7V18z M17,14h-2v4h2 V14z"/></g></svg>
                    </a>
                    <div class="mt-5 flex justify-center">
                        <button type="button" @click="showModal('modalRegistro')" class="lg:text-sm md:text-2xl text-blue-600 hover:text-white border border-blue-600 hover:bg-blue-600 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg px-5 py-2.5 text-center  dark:border-blue-500 dark:text-blue-500 dark:hover:text-white dark:hover:bg-blue-500 dark:focus:ring-blue-600">Industria y comercio</button>
                    </div>
                </div>
                <div v-else class="lg:w-auto md:w-72 p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                    <div  @click="showModal('modalRegistro')" class="flex justify-center items-center">
                        <svg class="w-20 h-20 fill-blue-600" xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24"  viewBox="0 0 24 24"  fill="none"><g><rect fill="none" height="24" width="24"/></g><g><path d="M22,10v12H2V10l7-3v2l5-2l0,0l0,3H22z M17.2,8.5L18,2h3l0.8,6.5H17.2z M11,18h2v-4h-2V18z M7,18h2v-4H7V18z M17,14h-2v4h2 V14z"/></g></svg>
                    </div>
                    <div class="mt-5 flex justify-center">
                        <button type="button" @click="showModal('modalRegistro')" class="lg:text-sm md:text-2xl text-blue-600 hover:text-white border border-blue-600 hover:bg-blue-600 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg px-5 py-2.5 text-center  dark:border-blue-500 dark:text-blue-500 dark:hover:text-white dark:hover:bg-blue-500 dark:focus:ring-blue-600">Industria y comercio</button>
                    </div>
                </div>
            </div>
            <div class="flex justify-center">
                <div v-if="login" class="lg:w-auto md:w-72 p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                    <a :href="route('public.impuesto_predial_unificado')" class="flex justify-center items-center">
                        <svg class="w-20 h-20 fill-blue-600" xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 24 24" fill="none"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M8 16h8v2H8zm0-4h8v2H8zm6-10H6c-1.1 0-2 .9-2 2v16c0 1.1.89 2 1.99 2H18c1.1 0 2-.9 2-2V8l-6-6zm4 18H6V4h7v5h5v11z"/></svg>
                    </a>
                    <div class="mt-5 flex justify-center">
                        <button type="button" @click="showModal('modalRegistro')" class="lg:text-sm md:text-2xl text-blue-600 hover:text-white border border-blue-600 hover:bg-blue-600 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg px-5 py-2.5 text-center  dark:border-blue-500 dark:text-blue-500 dark:hover:text-white dark:hover:bg-blue-500 dark:focus:ring-blue-600">Retención industria </button>
                    </div>
                </div>
                <div v-else class="lg:w-auto md:w-72 p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                    <div @click="showModal('modalRegistro')" class="flex justify-center items-center">
                        <svg class="w-20 h-20 fill-blue-600" xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 24 24" fill="none"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M8 16h8v2H8zm0-4h8v2H8zm6-10H6c-1.1 0-2 .9-2 2v16c0 1.1.89 2 1.99 2H18c1.1 0 2-.9 2-2V8l-6-6zm4 18H6V4h7v5h5v11z"/></svg>
                    </div>
                    <div class="mt-5 flex justify-center">
                        <button type="button" @click="showModal('modalRegistro')" class="lg:text-sm md:text-2xl text-blue-600 hover:text-white border border-blue-600 hover:bg-blue-600 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg px-5 py-2.5 text-center  dark:border-blue-500 dark:text-blue-500 dark:hover:text-white dark:hover:bg-blue-500 dark:focus:ring-blue-600">Retención industria </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!--
    <div id="controls-carousel" class="relative w-full lg:block md:hidden" data-carousel="static">
            <div class="relative h-[50vh] overflow-hidden">
                <div class="relative hidden duration-700 ease-in-out" data-carousel-item>
                    <img :src="banner" class="brightness-50 absolute object-cover block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
                    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2">HolaXDDDDDD</div>
                </div>
                <div class="hidden duration-700 ease-in-out" data-carousel-item="active">
                    <img :src="banner" class="brightness-50 object-cover absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
                </div>
            </div>
            <button type="button" class="absolute top-0 start-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-prev>
                <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                    <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 1 1 5l4 4"/>
                    </svg>
                    <span class="sr-only">Previous</span>
                </span>
            </button>
            <button type="button" class="absolute top-0 end-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-next>
                <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                    <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                    </svg>
                    <span class="sr-only">Next</span>
                </span>
            </button>
        </div>-->

</template>

<script lang="ts" setup>
    import banner from '~/img/public/banner2.jpg'
    defineProps({ tenant: Object,showModal:Function,hideModal:Function, login:Boolean })
</script>

<style scoped>

</style>
