<template>
    <Layout :tenant="tenant" v-slot="{ login, showModal, hideModal }" >
        <Carousel  :tenant="tenant" :login ="login" :showModal="showModal" :hideModal="hideModal"/>
        <div class="container mx-auto">
            <section class="mb-20 xl:block md:hidden">
                <div class="flex justify-center lg:flex-row md:flex-col lg:space-x-6 md:space-x-0 lg:space-y-0 md:space-y-6 mt-20">
                    <div class="flex justify-center">
                        <div class="flex items-center flex-col text-center max-w-sm p-6">
                            <svg class="lg:w-14 lg:h-14 md:w-24 md:h-24 fill-blue-600" xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" height="24px" viewBox="0 0 24 24" width="24px" fill="none"><g><rect fill="none" height="24" width="24"/></g><g><path d="M12,2C6.48,2,2,6.48,2,12s4.48,10,10,10s10-4.48,10-10S17.52,2,12,2z M12,20c-4.41,0-8-3.59-8-8c0-4.41,3.59-8,8-8 s8,3.59,8,8C20,16.41,16.41,20,12,20z M12.89,11.1c-1.78-0.59-2.64-0.96-2.64-1.9c0-1.02,1.11-1.39,1.81-1.39 c1.31,0,1.79,0.99,1.9,1.34l1.58-0.67c-0.15-0.44-0.82-1.91-2.66-2.23V5h-1.75v1.26c-2.6,0.56-2.62,2.85-2.62,2.96 c0,2.27,2.25,2.91,3.35,3.31c1.58,0.56,2.28,1.07,2.28,2.03c0,1.13-1.05,1.61-1.98,1.61c-1.82,0-2.34-1.87-2.4-2.09L8.1,14.75 c0.63,2.19,2.28,2.78,3.02,2.96V19h1.75v-1.24c0.52-0.09,3.02-0.59,3.02-3.22C15.9,13.15,15.29,11.93,12.89,11.1z"/></g></svg>
                            <h5 class="mb-4 lg:text-xl md:text-2xl font-bold dark:text-white">Pagos rápidos</h5>
                            <p class="lg:text-base md:text-2xl dark:text-gray-400">Realiza tus pagos en minutos, sin complicaciones ni demoras</p>
                        </div>
                    </div>
                    <div class="flex justify-center">
                        <div class="flex items-center flex-col text-center max-w-sm p-6">
                            <svg class="lg:w-14 lg:h-14 md:w-24 md:h-24 fill-blue-600" xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="none"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M6.5 10h-2v7h2v-7zm6 0h-2v7h2v-7zm8.5 9H2v2h19v-2zm-2.5-9h-2v7h2v-7zm-7-6.74L16.71 6H6.29l5.21-2.74m0-2.26L2 6v2h19V6l-9.5-5z"/></svg>
                            <h5 class="mb-4 lg:text-xl md:text-2xl font-bold dark:text-white">Todo en un Solo Lugar</h5>
                            <p class="lg:text-base md:text-2xl dark:text-gray-400">Centraliza tus obligaciones: impuestos prediales, industria y comercio, y retenciones, en una plataforma fácil de usar</p>
                        </div>
                    </div>
                    <div class="flex justify-center">
                        <div class="flex items-center flex-col text-center max-w-sm p-6">
                            <svg class="lg:w-14 lg:h-14 md:w-24 md:h-24 fill-blue-600" xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="none"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M12 1L3 5v6c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V5l-9-4zm0 10.99h7c-.53 4.12-3.28 7.79-7 8.94V12H5V6.3l7-3.11v8.8z"/></svg>
                            <h5 class="mb-4 lg:text-xl md:text-2xl font-bold dark:text-white">Seguridad garantizada</h5>
                            <p class="lg:text-base md:text-2xl dark:text-gray-400">Protegemos tu información con las últimas medidas de seguridad. Paga con confianza.</p>
                        </div>
                    </div>
                </div>
            </section>
            <section class="mb-20">
                <FormContacto :tenant="tenant"/>
            </section>
        </div>
    </Layout>
</template>

<script setup>
import Layout from './Layout.vue'
import FormContacto from './Components/FormContacto.vue';
import Carousel from './Components/Carousel.vue';

defineProps({ tenant: Object,showModal:Function,hideModal:Function, login:Boolean })

</script>
