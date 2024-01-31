<template>
    <Layout :tenant="tenant">
        <div class="flex justify-center xl:mt-36 xl:p-10 md:mt-48 mx-auto container">
            <div class="p-4 lg:w-full lg:max-w-md md:w-full bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                <div class="relative flex flex-col items-center pb-10">
                    <svg class="bg-green-500 rounded-full relative h-20 w-20 -top-10 fill-white" xmlns="http://www.w3.org/2000/svg"  viewBox="0 -960 960 960" ><path d="M382-240 154-468l57-57 171 171 367-367 57 57-424 424Z"/></svg>
                    <h5 class="mb-1 lg:text-xl md:text-5xl font-medium text-gray-900 dark:text-white">Transacción aprobada</h5>
                    <span class="lg:text-sm md:text-4xl mt-4 text-gray-500 dark:text-gray-400">$200.000</span>
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
                <div class="mb-4 flex justify-center space-x-7 items-center px-4 py-2">
                    <p class="lg:text-base md:text-3xl text-center dark:text-white">Volviendo al inicio en</p>
                    <div class="relative flex justify-center">
                        <svg aria-hidden="true" role="status" class="inline lg:w-10 lg:h-10 md:w-20 md:h-20 animate-spin text-blue-600 delay-1000" viewBox="0 0 100 101"  xmlns="http://www.w3.org/2000/svg">
                        <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="#E5E7EB"/>
                        <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentColor"/>
                        </svg>
                        <span class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-full text-center lg:text-sm md:text-3xl">{{ timer }}</span>
                    </div>
                </div>
            </div>
        </div>
    </Layout>
</template>

<script lang="ts" setup>
    import Layout from './Layout.vue';
    import {ref} from 'vue';
    defineProps({ tenant: Object})
    let timer=ref(15);

    window.setInterval(function(){
        timer.value--;
        if(timer.value == 0){
            window.location.href=route('public.index');
        }
    },1000);
</script>

<style scoped>

</style>
