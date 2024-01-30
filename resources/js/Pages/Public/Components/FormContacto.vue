<template>
    <div class="mt-10 grid lg:grid-cols-2 md:grid-cols-1 gap-4">
        <div class="bg-blue-600 p-10 w-full h-auto mt-5 border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
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
            <button type="button" class="text-white  border border-white hover:bg-white hover:text-blue-600 hover:border-blue-600 font-medium rounded-lg lg:text-sm md:text-2xl px-5 py-2.5 text-center me-2 mb-2 dark:border-white dark:text-white dark:hover:text-white dark:hover:bg-blue-600">Enviar ahora</button>
        </div>
        <div class="p-10 w-full h-auto mt-5 border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
            <h2 class="text-2xl md:text-4xl text-center font-medium text-gray-900 dark:text-white mb-8 mt-5">Detalles de contacto</h2>
            <ul class="flex flex-col space-y-5">
                <li v-if="tenant.direccion">
                    <h5 class="mb-2 lg:text-base md:text-3xl font-semibold tracking-tight text-gray-900 dark:text-white">Dirección</h5>
                    <div class="flex items-center space-x-4">
                        <svg class="lg:w-5 lg:h-5 md:w-7 md:h-7 fill-blue-600" xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 384 512"><path d="M215.7 499.2C267 435 384 279.4 384 192C384 86 298 0 192 0S0 86 0 192c0 87.4 117 243 168.3 307.2c12.3 15.3 35.1 15.3 47.4 0zM192 128a64 64 0 1 1 0 128 64 64 0 1 1 0-128z"/></svg>
                        <p class="lg:text-base md:text-2xl dark:text-gray-300">{{ tenant.direccion }}</p>
                    </div>
                </li>
                <li v-if="tenant.telefono">
                    <h5 class="mb-2 lg:text-base md:text-3xl font-semibold tracking-tight text-gray-900 dark:text-white">Teléfono</h5>
                    <div class="flex items-center space-x-4">
                        <svg class="lg:w-5 lg:h-5 md:w-7 md:h-7 fill-blue-600" xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 512 512"><path d="M164.9 24.6c-7.7-18.6-28-28.5-47.4-23.2l-88 24C12.1 30.2 0 46 0 64C0 311.4 200.6 512 448 512c18 0 33.8-12.1 38.6-29.5l24-88c5.3-19.4-4.6-39.7-23.2-47.4l-96-40c-16.3-6.8-35.2-2.1-46.3 11.6L304.7 368C234.3 334.7 177.3 277.7 144 207.3L193.3 167c13.7-11.2 18.4-30 11.6-46.3l-40-96z"/></svg>
                        <p class="lg:text-base md:text-2xl dark:text-gray-300">{{ tenant.direccion }}</p>
                    </div>
                </li>
                <li v-if="tenant.correo">
                    <h5 class="mb-2 lg:text-base md:text-3xl font-semibold tracking-tight text-gray-900 dark:text-white">Correo</h5>
                    <div class="flex items-center space-x-4">
                        <svg class="lg:w-5 lg:h-5 md:w-7 md:h-7 fill-blue-600" xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 512 512"><path d="M48 64C21.5 64 0 85.5 0 112c0 15.1 7.1 29.3 19.2 38.4L236.8 313.6c11.4 8.5 27 8.5 38.4 0L492.8 150.4c12.1-9.1 19.2-23.3 19.2-38.4c0-26.5-21.5-48-48-48H48zM0 176V384c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V176L294.4 339.2c-22.8 17.1-54 17.1-76.8 0L0 176z"/></svg>
                        <p class="lg:text-base md:text-2xl dark:text-gray-300">{{ tenant.correo }}</p>
                    </div>
                </li>
                <li v-if="tenant.pagina">
                    <h5 class="mb-2 lg:text-base md:text-3xl font-semibold tracking-tight text-gray-900 dark:text-white">Sitio Web</h5>
                    <div class="flex items-center space-x-4">
                        <svg class="lg:w-5 lg:h-5 md:w-7 md:h-7 fill-blue-600" xmlns="http://www.w3.org/2000/svg"   viewBox="0 0 512 512"><path d="M352 256c0 22.2-1.2 43.6-3.3 64H163.3c-2.2-20.4-3.3-41.8-3.3-64s1.2-43.6 3.3-64H348.7c2.2 20.4 3.3 41.8 3.3 64zm28.8-64H503.9c5.3 20.5 8.1 41.9 8.1 64s-2.8 43.5-8.1 64H380.8c2.1-20.6 3.2-42 3.2-64s-1.1-43.4-3.2-64zm112.6-32H376.7c-10-63.9-29.8-117.4-55.3-151.6c78.3 20.7 142 77.5 171.9 151.6zm-149.1 0H167.7c6.1-36.4 15.5-68.6 27-94.7c10.5-23.6 22.2-40.7 33.5-51.5C239.4 3.2 248.7 0 256 0s16.6 3.2 27.8 13.8c11.3 10.8 23 27.9 33.5 51.5c11.6 26 20.9 58.2 27 94.7zm-209 0H18.6C48.6 85.9 112.2 29.1 190.6 8.4C165.1 42.6 145.3 96.1 135.3 160zM8.1 192H131.2c-2.1 20.6-3.2 42-3.2 64s1.1 43.4 3.2 64H8.1C2.8 299.5 0 278.1 0 256s2.8-43.5 8.1-64zM194.7 446.6c-11.6-26-20.9-58.2-27-94.6H344.3c-6.1 36.4-15.5 68.6-27 94.6c-10.5 23.6-22.2 40.7-33.5 51.5C272.6 508.8 263.3 512 256 512s-16.6-3.2-27.8-13.8c-11.3-10.8-23-27.9-33.5-51.5zM135.3 352c10 63.9 29.8 117.4 55.3 151.6C112.2 482.9 48.6 426.1 18.6 352H135.3zm358.1 0c-30 74.1-93.6 130.9-171.9 151.6c25.5-34.2 45.2-87.7 55.3-151.6H493.4z"/></svg>
                        <p class="lg:text-base md:text-2xl dark:text-gray-300">{{ tenant.pagina }}</p>
                    </div>
                </li>
            </ul>
            <ListRedesSociales :tenant="tenant" class="mt-5" />
        </div>
    </div>
</template>

<script lang="ts" setup>
    import ListRedesSociales from './ListRedesSociales.vue';
    defineProps({ tenant: Object });
</script>

<style scoped>

</style>
