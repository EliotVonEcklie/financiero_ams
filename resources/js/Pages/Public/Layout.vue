<template>
    <header>
        <ModalRegistro :login="login" @showModal="showModal" @hideModal="hideModal"/>

        <nav class="bg-white border-gray-200 dark:bg-gray-900">
            <div class="flex flex-wrap justify-between items-center mx-auto max-w-screen-xl p-3">
                <a :href="route('public.index')" class="flex items-center space-x-3 rtl:space-x-reverse">
                    <img :src="{{ 'data:image/png;base64,' + tenant.imagen }}" class="lg:h-20 md:h-40" alt="Flowbite Logo" />
                    <div class="flex flex-col">
                        <span class="self-center lg:text-2xl font-semibold whitespace-nowrap md:text-3xl dark:text-white">{{ tenant.nombre.toUpperCase() }} - META</span>
                        <span class="lg:text-sm text-gray-900 md:text-2xl dark:text-white">{{ tenant.entidad.toUpperCase() }}</span>
                    </div>
                </a>
                <div class="flex items-center md:hidden lg:block">
                    <button type="button" @click="showModal('modalRegistro');" class="py-2.5 px-5 text-sm font-medium text-white focus:outline-none bg-greenp1 rounded-lg">Iniciar sesión</button>
                </div>
                <div class="flex items-center md:block lg:hidden ">
                    <button type="button" @click="openMobileNav();" class="py-2.5 px-2.5 font-medium text-white focus:outline-none bg-greenp1 rounded-lg border border-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                        <span class="sr-only">Open main menu</span>
                        <svg class="w-14 h-14" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15"/>
                        </svg>
                    </button>
                </div>
            </div>
        </nav>
        <nav :class="{'translate-x-0 ':mobileNav, 'translate-x-full ':mobileNav==false}" class="fixed z-50 top-0 transition-all h-full w-screen ">
            <div class=" h-full bg-white overflow-y-auto dark:bg-gray-700" >
                <div class="flex justify-between items-center mt-4 p-4">
                    <a :href="route('public.index')" class="flex items-center space-x-3 rtl:space-x-reverse">
                        <img :src="img_logo" class="h-20 md:h-40" alt="Flowbite Logo" />
                        <div class="flex flex-col">
                            <span class="self-center text-2xl font-semibold whitespace-nowrap md:text-3xl dark:text-white">{{ tenant.nombre.toUpperCase() }} - META</span>
                            <span class="text-sm text-gray-900 md:text-2xl dark:text-white">{{ tenant.entidad.toUpperCase() }}</span>
                        </div>
                    </a>
                    <button type="button" @click="openMobileNav();" class="mx-5 my-5 text-gray-400 bg-transparent rounded-lg text-sm w-8 h-8 inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white">
                        <svg class="w-20 h-20" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <ul class="mt-20 mb-20 ps-4 flex flex-col text-3xl space-y-20 font-medium">
                    <li class="p-5  w-full hover:bg-bluep ">
                        <a :href="route('public.index')" class="block text-gray-900 hover:text-white hover:no-underline dark:text-white" aria-current="page">Inicio</a>
                    </li>
                    <li class="p-5 hover:bg-bluep">
                        <a :href="route('public.impuesto_predial_unificado')" class="block text-gray-900 hover:text-white hover:no-underline dark:text-white">Impuesto predial unificado</a>
                    </li>
                    <li class="p-5 hover:bg-bluep">
                        <a href="#" class="block text-gray-900 hover:text-white hover:no-underline dark:text-white">Impuesto de industria y comercio</a>
                    </li>
                    <li class="p-5 hover:bg-bluep">
                        <a href="#" class="block text-gray-900 hover:text-white hover:no-underline dark:text-white">Retención de industria y comercio</a>
                    </li>
                    <li class="p-5 hover:bg-bluep">
                        <a href="#" class="block text-gray-900 hover:text-white hover:no-underline dark:text-white">Normatividad</a>
                    </li>
                    <li class="p-5  w-full hover:bg-bluep ">
                        <a href="#" class="block text-gray-900 hover:text-white hover:no-underline dark:text-white">Notificaciones jurídicas</a>
                    </li>
                    <li class="p-5  w-full hover:bg-bluep ">
                        <a href="#" class="block text-gray-900 hover:text-white hover:no-underline dark:text-white">Presentación electrónica</a>
                    </li>
                    <li class="p-5  w-full hover:bg-bluep ">
                        <a href="#" class="block text-gray-900 hover:text-white hover:no-underline dark:text-white">Contacto</a>
                    </li>
                    <li class="p-5  w-full hover:bg-bluep ">
                        <button type="button" @click="showModal('modalRegistro');" class="block text-gray-900 hover:text-white hover:no-underline dark:text-white">Iniciar sesión</button>
                    </li>
                </ul>
            </div>
        </nav>
        <nav class="lg:block md:hidden bg-blue-100  dark:bg-gray-700">
            <div class="max-w-screen-xl px-4 py-3 mx-auto">
                <div class="flex items-center justify-center">
                    <ul class="flex flex-row font-medium mt-0 space-x-8 rtl:space-x-reverse text-sm">
                        <li>
                            <a :href="route('public.index')" class="text-gray-900 dark:text-white hover:underline" aria-current="page">Inicio</a>
                        </li>
                        <li>
                            <button id="dropdownNavbarLink" data-dropdown-toggle="dropdownNavbar" class="flex items-center justify-between w-full py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:p-0 md:w-auto dark:text-white md:dark:hover:text-blue-500 dark:focus:text-white dark:border-gray-700 dark:hover:bg-gray-700 md:dark:hover:bg-transparent">Selección de impuesto <svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                                </svg>
                            </button>
                            <!-- Dropdown menu -->
                            <div id="dropdownNavbar" class="z-50 hidden font-normal bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 dark:divide-gray-600">
                                <ul class="py-2 text-sm text-gray-700 dark:text-gray-400" aria-labelledby="dropdownLargeButton">
                                    <li>
                                        <Link :href="route('public.impuesto_predial_unificado')" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Impuesto Predial Unificado</Link>
                                    </li>
                                    <li v-if="login">
                                        <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Impuesto de industria y comercio</a>
                                    </li>
                                    <li v-else>
                                        <button type="button" @click="showModal('modalRegistro');" class="text-start block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Impuesto de industria y comercio</button>
                                    </li>
                                    <li v-if="login">
                                        <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Retención de industria y comercio</a>
                                    </li>
                                    <li v-else>
                                        <button type="button" @click="showModal('modalRegistro');" class="text-start block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Retención de industria y comercio</button>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li>
                            <a href="#" class="text-gray-900 dark:text-white hover:underline">Normatividad</a>
                        </li>
                        <li>
                            <a href="#" class="text-gray-900 dark:text-white hover:underline">Notificaciones jurídicas</a>
                        </li>
                        <li>
                            <a href="#" class="text-gray-900 dark:text-white hover:underline">Presentación electrónica</a>
                        </li>
                        <li>
                            <a href="#" class="text-gray-900 dark:text-white hover:underline">Contacto</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <main class="mb-8 container mx-auto">
        <slot :login ="login" :showModal="showModal" :hideModal="hideModal"  />
    </main>
    <footer class="bg-gray-100 dark:bg-gray-900 h-50">
        <div class="mx-auto w-full max-w-screen-xl p-4 py-6 lg:py-8 lg:flex lg:items-center justify-between lg:flex-row md:flex-col">
            <div class="mb-6">
                <a :href="route('public.index')" class="flex items-center md:justify-center">
                    <img :src="img_logo"  class="lg:h-8 me-3 md:h-24" alt="FlowBite Logo" />
                    <div class="flex flex-col">
                        <span class="self-center lg:text-base font-semibold md:text-2xl whitespace-nowrap dark:text-white">{{ tenant.nombre.toUpperCase() }} - META</span>
                        <span class="lg:text-sm text-gray-900 md:text-xl dark:text-white">{{ tenant.entidad.toUpperCase() }}</span>
                    </div>
                </a>
            </div>
            <div class="grid grid-cols-2 gap-8 sm:gap-6 sm:grid-cols-3 md:text-center">
                <div>
                    <h2 class="mb-6 lg:text-sm md:text-2xl font-semibold text-gray-900 uppercase dark:text-white">Centro de ayuda</h2>
                    <ul class="lg:text-base md:text-2xl text-gray-500 dark:text-gray-400 font-medium">
                        <li class="mb-4">
                            <a href="#" class="hover:underline">Preguntas frecuentes</a>
                        </li>
                        <li>
                            <a href="#" class="hover:underline">Manuales de sistema</a>
                        </li>
                    </ul>
                </div>
                <div>
                    <h2 class="mb-6 lg:text-sm md:text-2xl font-semibold text-gray-900 uppercase dark:text-white">Líneas de atención</h2>
                    <ul class="lg:text-base md:text-2xl text-gray-500 dark:text-gray-400 font-medium">
                        <li class="mb-4">
                            <div class="flex space-x-2 items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" height="16" width="16" viewBox="0 0 512 512"><path d="M164.9 24.6c-7.7-18.6-28-28.5-47.4-23.2l-88 24C12.1 30.2 0 46 0 64C0 311.4 200.6 512 448 512c18 0 33.8-12.1 38.6-29.5l24-88c5.3-19.4-4.6-39.7-23.2-47.4l-96-40c-16.3-6.8-35.2-2.1-46.3 11.6L304.7 368C234.3 334.7 177.3 277.7 144 207.3L193.3 167c13.7-11.2 18.4-30 11.6-46.3l-40-96z"/></svg>
                                <span>{{ tenant.telefono }}</span>
                            </div>
                        </li>
                        <li>
                            <div class="flex space-x-2 items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" height="16" width="16" viewBox="0 0 512 512"><path d="M48 64C21.5 64 0 85.5 0 112c0 15.1 7.1 29.3 19.2 38.4L236.8 313.6c11.4 8.5 27 8.5 38.4 0L492.8 150.4c12.1-9.1 19.2-23.3 19.2-38.4c0-26.5-21.5-48-48-48H48zM0 176V384c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V176L294.4 339.2c-22.8 17.1-54 17.1-76.8 0L0 176z"/></svg>
                                <span>{{ tenant.correo }}</span>
                            </div>
                        </li>
                    </ul>
                </div>
                <div>
                    <h2 class="mb-6 lg:text-sm md:text-2xl font-semibold text-gray-900 uppercase dark:text-white">Dirección</h2>
                    <ul class="lg:text-base md:text-2xl text-gray-500 dark:text-gray-400 font-medium">
                        <li class="mb-4">
                            <div class="flex space-x-2 items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" height="16" width="12" viewBox="0 0 384 512"><path d="M215.7 499.2C267 435 384 279.4 384 192C384 86 298 0 192 0S0 86 0 192c0 87.4 117 243 168.3 307.2c12.3 15.3 35.1 15.3 47.4 0zM192 128a64 64 0 1 1 0 128 64 64 0 1 1 0-128z"/></svg>
                                <span>{{ tenant.direccion }}</span>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <hr class="my-6 border-gray-200 sm:mx-auto dark:border-gray-700 lg:my-8" />
        <div class="w-full mx-auto max-w-screen-xl p-4 md:flex md:items-center md:justify-between md:flex-col">
            <span class="lg:text-sm md:text-2xl text-gray-500 sm:text-center dark:text-gray-400 ">© 2023 <a href="#" class="hover:underline lg:text-sm md:text-2xl">Ideal 10 sas</a>. Todos los derechos reservados.
            </span>
            <ul class="flex flex-wrap items-center mt-3 lg:text-sm md:text-xl font-medium text-gray-500 dark:text-gray-400 sm:mt-0">
                <li>
                    <a href="#" class="hover:underline me-4 md:me-6">Normatividad</a>
                </li>
                <li>
                    <a href="#" class="hover:underline me-4 md:me-6">Notificaciones jurídicas</a>
                </li>
                <li>
                    <a href="#" class="hover:underline me-4 md:me-6">Presentación electrónica</a>
                </li>
                <li>
                    <a href="#" class="hover:underline">Contacto</a>
                </li>
            </ul>
        </div>
    </footer>
</template>

<script lang="ts" setup>
    import { initFlowbite } from 'flowbite'
    import { onMounted,Ref,ref } from 'vue'
    import { Link } from '@inertiajs/vue3'
    import ModalRegistro from './Components/ModalRegistro.vue'
    import {Modal} from 'flowbite';
    let activeTab:Ref<string | null>=ref('');
    let login:Ref<boolean>=ref(false);
    let mobileNav:Ref<boolean>=ref(false);

    defineProps({ tenant: Object })

    function showModal(id){
        const options = {
            backdrop: 'static',
            closable: true,
        };
        new Modal(document.getElementById(id),options).show();
        if(mobileNav.value){
            mobileNav.value = false;
        }
    }
    function hideModal(id){
        new Modal(document.getElementById(id)).hide();
    }
    function openMobileNav(){
        if(mobileNav.value == false){
            mobileNav.value = true;
        }else{
            mobileNav.value = false;
        }
    }
    onMounted(() => {
        initFlowbite();
    });
</script>
