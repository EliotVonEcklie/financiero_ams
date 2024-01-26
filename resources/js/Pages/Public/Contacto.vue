<template>
    <Layout :tenant="tenant">
        <div class="mt-10 grid lg:grid-cols-2 md:grid-cols-1 gap-4">
            <div class="bg-bluep p-10 w-full h-auto mt-5 border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                <h2 class="text-2xl md:text-4xl text-center font-medium text-white dark:text-white mb-8 mt-5">Sientete libre de contactarnos</h2>
                <div class="grid lg:grid-cols-2 lg:gap-4 md:grid-cols-1">
                    <div class="relative z-0 w-full mb-5 group">
                        <input type="text" class="block py-2.5 px-0 w-full lg:text-sm md:text-2xl text-white bg-transparent border-0 border-b-2 border-white appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-white peer" placeholder=" " required />
                        <label for="floating_first_name" class="peer-focus:font-medium absolute lg:text-sm md:text-2xl text-white dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-white peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Nombres y apellidos</label>
                    </div>
                    <div class="relative z-0 w-full mb-5 group">
                        <input type="text" class="block py-2.5 px-0 w-full lg:text-sm md:text-2xl text-white bg-transparent border-0 border-b-2 border-white appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-white peer" placeholder=" " required />
                        <label for="floating_first_name" class="peer-focus:font-medium absolute lg:text-sm md:text-2xl text-white dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-white peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Correo electrónico</label>
                    </div>
                    <div class="relative z-0 w-full mb-5 group">
                        <input type="text" class="block py-2.5 px-0 w-full lg:text-sm md:text-2xl text-white bg-transparent border-0 border-b-2 border-white appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-white peer" placeholder=" " required />
                        <label for="floating_first_name" class="peer-focus:font-medium absolute lg:text-sm md:text-2xl text-white dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-white peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Teléfono</label>
                    </div>
                    <div class="relative z-0 w-full mb-5 group">
                        <input type="text" class="block py-2.5 px-0 w-full lg:text-sm md:text-2xl text-white bg-transparent border-0 border-b-2 border-white appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-white peer" placeholder=" " required />
                        <label for="floating_first_name" class="peer-focus:font-medium absolute lg:text-sm md:text-2xl text-white dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-white peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Asunto</label>
                    </div>
                </div>
                <div class="relative z-0 w-full mb-5 group">
                    <textarea rows="5" type="text" class="resize-none block py-2.5 px-0 w-full lg:text-sm md:text-2xl text-white bg-transparent border-0 border-b-2 border-white appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-white peer" placeholder=" " required ></textarea>
                    <label for="floating_first_name" class="peer-focus:font-medium absolute lg:text-sm md:text-2xl text-white dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-white peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Mensaje</label>
                </div>
                <button type="button"  class="inline-flex items-center px-3 py-2 lg:text-sm md:text-2xl font-medium text-center text-bluep bg-white rounded-lg border border-blue-600  dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    Enviar ahora
                </button>
            </div>
            <div class="p-10 w-full h-auto mt-5 border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                <h2 class="text-2xl md:text-4xl text-center font-medium text-gray-900 dark:text-white mb-8 mt-5">Detalles de contacto</h2>
                <ul class="flex flex-col space-y-5">
                    <li>
                        <h5 class="mb-2 lg:text-base md:text-3xl font-semibold tracking-tight text-gray-900 dark:text-white">Dirección</h5>
                        <div class="flex items-center space-x-4">
                            <svg class="lg:w-5 lg:h-5 md:w-7 md:h-7 fill-bluep" xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 384 512"><path d="M215.7 499.2C267 435 384 279.4 384 192C384 86 298 0 192 0S0 86 0 192c0 87.4 117 243 168.3 307.2c12.3 15.3 35.1 15.3 47.4 0zM192 128a64 64 0 1 1 0 128 64 64 0 1 1 0-128z"/></svg>
                            <p class="lg:text-base md:text-2xl">{{ tenant.direccion }}</p>
                        </div>
                    </li>
                    <li>
                        <h5 class="mb-2 lg:text-base md:text-3xl font-semibold tracking-tight text-gray-900 dark:text-white">Teléfono</h5>
                        <div class="flex items-center space-x-4">
                            <svg class="lg:w-5 lg:h-5 md:w-7 md:h-7 fill-bluep" xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 512 512"><path d="M164.9 24.6c-7.7-18.6-28-28.5-47.4-23.2l-88 24C12.1 30.2 0 46 0 64C0 311.4 200.6 512 448 512c18 0 33.8-12.1 38.6-29.5l24-88c5.3-19.4-4.6-39.7-23.2-47.4l-96-40c-16.3-6.8-35.2-2.1-46.3 11.6L304.7 368C234.3 334.7 177.3 277.7 144 207.3L193.3 167c13.7-11.2 18.4-30 11.6-46.3l-40-96z"/></svg>
                            <p class="lg:text-base md:text-2xl">{{ tenant.direccion }}</p>
                        </div>
                    </li>
                    <li>
                        <h5 class="mb-2 lg:text-base md:text-3xl font-semibold tracking-tight text-gray-900 dark:text-white">Correo</h5>
                        <div class="flex items-center space-x-4">
                            <svg class="lg:w-5 lg:h-5 md:w-7 md:h-7 fill-bluep" xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 512 512"><path d="M48 64C21.5 64 0 85.5 0 112c0 15.1 7.1 29.3 19.2 38.4L236.8 313.6c11.4 8.5 27 8.5 38.4 0L492.8 150.4c12.1-9.1 19.2-23.3 19.2-38.4c0-26.5-21.5-48-48-48H48zM0 176V384c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V176L294.4 339.2c-22.8 17.1-54 17.1-76.8 0L0 176z"/></svg>
                            <p class="lg:text-base md:text-2xl">{{ tenant.correo }}</p>
                        </div>
                    </li>
                    <li>
                        <h5 class="mb-2 lg:text-base md:text-3xl font-semibold tracking-tight text-gray-900 dark:text-white">Sitio Web</h5>
                        <div class="flex items-center space-x-4">
                            <svg class="lg:w-5 lg:h-5 md:w-7 md:h-7 fill-bluep" xmlns="http://www.w3.org/2000/svg"   viewBox="0 0 512 512"><path d="M352 256c0 22.2-1.2 43.6-3.3 64H163.3c-2.2-20.4-3.3-41.8-3.3-64s1.2-43.6 3.3-64H348.7c2.2 20.4 3.3 41.8 3.3 64zm28.8-64H503.9c5.3 20.5 8.1 41.9 8.1 64s-2.8 43.5-8.1 64H380.8c2.1-20.6 3.2-42 3.2-64s-1.1-43.4-3.2-64zm112.6-32H376.7c-10-63.9-29.8-117.4-55.3-151.6c78.3 20.7 142 77.5 171.9 151.6zm-149.1 0H167.7c6.1-36.4 15.5-68.6 27-94.7c10.5-23.6 22.2-40.7 33.5-51.5C239.4 3.2 248.7 0 256 0s16.6 3.2 27.8 13.8c11.3 10.8 23 27.9 33.5 51.5c11.6 26 20.9 58.2 27 94.7zm-209 0H18.6C48.6 85.9 112.2 29.1 190.6 8.4C165.1 42.6 145.3 96.1 135.3 160zM8.1 192H131.2c-2.1 20.6-3.2 42-3.2 64s1.1 43.4 3.2 64H8.1C2.8 299.5 0 278.1 0 256s2.8-43.5 8.1-64zM194.7 446.6c-11.6-26-20.9-58.2-27-94.6H344.3c-6.1 36.4-15.5 68.6-27 94.6c-10.5 23.6-22.2 40.7-33.5 51.5C272.6 508.8 263.3 512 256 512s-16.6-3.2-27.8-13.8c-11.3-10.8-23-27.9-33.5-51.5zM135.3 352c10 63.9 29.8 117.4 55.3 151.6C112.2 482.9 48.6 426.1 18.6 352H135.3zm358.1 0c-30 74.1-93.6 130.9-171.9 151.6c25.5-34.2 45.2-87.7 55.3-151.6H493.4z"/></svg>
                            <p class="lg:text-base md:text-2xl">{{ tenant.pagina }}</p>
                        </div>
                    </li>
                </ul>
                <div class="relative">
                    <div class="">

                    </div>
                </div>
                <ul class="flex space-x-5 mt-5">
                    <li class="p-2 relative rounded-full h-10 w-10 bg-black">
                        <a href="#" class="absolute top-1/2 right-1/2 -translate-y-1/2 translate-x-1/2 block h-full w-full" >
                            <svg class="lg:w-5 lg:h-5 md:w-7 md:h-7 fill-white absolute top-1/2 right-1/2 -translate-y-1/2 translate-x-1/2 block h-full w-full" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M80 299.3V512H196V299.3h86.5l18-97.8H196V166.9c0-51.7 20.3-71.5 72.7-71.5c16.3 0 29.4 .4 37 1.2V7.9C291.4 4 256.4 0 236.2 0C129.3 0 80 50.5 80 159.4v42.1H14v97.8H80z"/></svg>
                        </a>
                    </li>
                    <li class="p-2 relative rounded-full h-10 w-10 bg-black">
                        <a href="#" class="absolute top-1/2 right-1/2 -translate-y-1/2 translate-x-1/2 block h-full w-full" >
                            <svg class="lg:w-5 lg:h-5 md:w-7 md:h-7 fill-white absolute top-1/2 right-1/2 -translate-y-1/2 translate-x-1/2 block h-full w-full" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M459.4 151.7c.3 4.5 .3 9.1 .3 13.6 0 138.7-105.6 298.6-298.6 298.6-59.5 0-114.7-17.2-161.1-47.1 8.4 1 16.6 1.3 25.3 1.3 49.1 0 94.2-16.6 130.3-44.8-46.1-1-84.8-31.2-98.1-72.8 6.5 1 13 1.6 19.8 1.6 9.4 0 18.8-1.3 27.6-3.6-48.1-9.7-84.1-52-84.1-103v-1.3c14 7.8 30.2 12.7 47.4 13.3-28.3-18.8-46.8-51-46.8-87.4 0-19.5 5.2-37.4 14.3-53 51.7 63.7 129.3 105.3 216.4 109.8-1.6-7.8-2.6-15.9-2.6-24 0-57.8 46.8-104.9 104.9-104.9 30.2 0 57.5 12.7 76.7 33.1 23.7-4.5 46.5-13.3 66.6-25.3-7.8 24.4-24.4 44.8-46.1 57.8 21.1-2.3 41.6-8.1 60.4-16.2-14.3 20.8-32.2 39.3-52.6 54.3z"/></svg>
                        </a>
                    </li>
                    <li class="p-2 relative rounded-full h-10 w-10 bg-black">
                        <a href="#" class="absolute top-1/2 right-1/2 -translate-y-1/2 translate-x-1/2 block h-full w-full" >
                            <svg class="lg:w-5 lg:h-5 md:w-7 md:h-7 fill-white absolute top-1/2 right-1/2 -translate-y-1/2 translate-x-1/2 block h-full w-full" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M224.1 141c-63.6 0-114.9 51.3-114.9 114.9s51.3 114.9 114.9 114.9S339 319.5 339 255.9 287.7 141 224.1 141zm0 189.6c-41.1 0-74.7-33.5-74.7-74.7s33.5-74.7 74.7-74.7 74.7 33.5 74.7 74.7-33.6 74.7-74.7 74.7zm146.4-194.3c0 14.9-12 26.8-26.8 26.8-14.9 0-26.8-12-26.8-26.8s12-26.8 26.8-26.8 26.8 12 26.8 26.8zm76.1 27.2c-1.7-35.9-9.9-67.7-36.2-93.9-26.2-26.2-58-34.4-93.9-36.2-37-2.1-147.9-2.1-184.9 0-35.8 1.7-67.6 9.9-93.9 36.1s-34.4 58-36.2 93.9c-2.1 37-2.1 147.9 0 184.9 1.7 35.9 9.9 67.7 36.2 93.9s58 34.4 93.9 36.2c37 2.1 147.9 2.1 184.9 0 35.9-1.7 67.7-9.9 93.9-36.2 26.2-26.2 34.4-58 36.2-93.9 2.1-37 2.1-147.8 0-184.8zM398.8 388c-7.8 19.6-22.9 34.7-42.6 42.6-29.5 11.7-99.5 9-132.1 9s-102.7 2.6-132.1-9c-19.6-7.8-34.7-22.9-42.6-42.6-11.7-29.5-9-99.5-9-132.1s-2.6-102.7 9-132.1c7.8-19.6 22.9-34.7 42.6-42.6 29.5-11.7 99.5-9 132.1-9s102.7-2.6 132.1 9c19.6 7.8 34.7 22.9 42.6 42.6 11.7 29.5 9 99.5 9 132.1s2.7 102.7-9 132.1z"/></svg>
                        </a>
                    </li>
                    <li class="p-2 relative rounded-full h-10 w-10 bg-black">
                        <a href="#" class="absolute top-1/2 right-1/2 -translate-y-1/2 translate-x-1/2 block h-full w-full" >
                            <svg class="lg:w-5 lg:h-5 md:w-7 md:h-7 fill-white absolute top-1/2 right-1/2 -translate-y-1/2 translate-x-1/2 block h-full w-full" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><path d="M549.7 124.1c-6.3-23.7-24.8-42.3-48.3-48.6C458.8 64 288 64 288 64S117.2 64 74.6 75.5c-23.5 6.3-42 24.9-48.3 48.6-11.4 42.9-11.4 132.3-11.4 132.3s0 89.4 11.4 132.3c6.3 23.7 24.8 41.5 48.3 47.8C117.2 448 288 448 288 448s170.8 0 213.4-11.5c23.5-6.3 42-24.2 48.3-47.8 11.4-42.9 11.4-132.3 11.4-132.3s0-89.4-11.4-132.3zm-317.5 213.5V175.2l142.7 81.2-142.7 81.2z"/></svg>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </Layout>
</template>

<script lang="ts" setup>
    import Layout from './Layout.vue'
    import { ref,reactive } from 'vue'
    defineProps({ tenant: Object })
</script>

<style scoped>

</style>
