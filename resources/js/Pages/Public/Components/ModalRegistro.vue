<script setup>
    import {ref} from 'vue';
    import { FwbTab, FwbTabs } from 'flowbite-vue'
    const activeTab = ref('iniciar');
    function showTab(tabName){
        activeTab.value =tabName;
    }
    /*const tabsElement = ref(null);
    const tabElements = ref([]);
    const tabs = ref(null);
    onMounted(() => {
        tabsElement.value = document.getElementById('session-tab');
        tabElements.value = [
            {
                id: 'iniciar-tab',
                triggerEl: document.querySelector('#iniciar'),
                targetEl: document.querySelector('#iniciar'),
            },
            {
                id: 'registrar-tab',
                triggerEl: document.querySelector('#registrar'),
                targetEl: document.querySelector('#registrar'),
            },
        ];
        tabs.value = new Tabs(tabsElement.value,tabElements.value);
        console.log('tabs.value:', tabs.value);
    });
    function showTabRegistrar(){
        tabs.value.show('registrar-tab');
        console.log('tabs.value function:', tabs.value);
    }*/

</script>
<template>
    <div id="modalRegistro" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-2xl max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div class="bg-bluep flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-xl font-semibold text-white dark:text-white">
                        Bienvenido
                    </h3>
                    <button type="button" class="text-white bg-transparent rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="modalRegistro">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <div class="p-4 md:p-5 space-y-4">
                    <fwb-tabs v-model="activeTab" variant="underline" class="p-5">
                        <fwb-tab name="iniciar" title="Iniciar sesión">
                            <div class="text-center flex flex-col items-center justify-center">
                                <div class="mb-5 inline rounded-full p-8 bg-bluep">
                                    <svg xmlns="http://www.w3.org/2000/svg" height="70" width="70" viewBox="0 0 448 512"><path fill="#fff" d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512H418.3c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304H178.3z"/></svg>
                                </div>
                                <p class="text-sm text-gray-500 dark:text-gray-400">Ingrese por favor el Número de Identificación o NIT, sin digito de verificación y su contraseña.</p>
                            </div>
                            <div class="relative z-0 w-full mb-5 group">
                                <input type="number" name="sesionUsuario" id="sesionUsuario"  class="[&::-webkit-inner-spin-button]:appearance-none block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                                <label for="sesionUsuario" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">NIT</label>
                            </div>
                            <div class="relative z-0 w-full mb-5 group">
                                <input type="password" name="sesionContrasena" id="sesionContrasena" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                                <label for="sesionContrasena" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Contraseña</label>
                            </div>
                            <div class="flex justify-between items-center mb-5">
                                <button data-modal-hide="modalRegistro" type="button" class="text-white bg-greenp1 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Iniciar sesión</button>
                                <a href="#" class="text-sm text- text-gray-500 dark:text-gray-400">¿Olvidaste la contraseña?</a>
                            </div>
                            <hr>
                            <p class="text-sm text-gray-500 dark:text-gray-400">¿No tienes una cuenta? <button @click="showTab('registrar')" type="button" class="text-black bg-white rounded-lg px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Registrate aquí</button></p>
                        </fwb-tab>
                        <fwb-tab name="registrar" title="Registrarse">
                            <div class="text-center flex flex-col items-center justify-center">
                                <div class="mb-5 inline rounded-full p-8 bg-bluep">
                                    <svg xmlns="http://www.w3.org/2000/svg" height="70" width="70" viewBox="0 0 576 512"><path fill="#fff" d="M528 160V416c0 8.8-7.2 16-16 16H320c0-44.2-35.8-80-80-80H176c-44.2 0-80 35.8-80 80H64c-8.8 0-16-7.2-16-16V160H528zM64 32C28.7 32 0 60.7 0 96V416c0 35.3 28.7 64 64 64H512c35.3 0 64-28.7 64-64V96c0-35.3-28.7-64-64-64H64zM272 256a64 64 0 1 0 -128 0 64 64 0 1 0 128 0zm104-48c-13.3 0-24 10.7-24 24s10.7 24 24 24h80c13.3 0 24-10.7 24-24s-10.7-24-24-24H376zm0 96c-13.3 0-24 10.7-24 24s10.7 24 24 24h80c13.3 0 24-10.7 24-24s-10.7-24-24-24H376z"/></svg>
                                </div>
                                <p class="text-1xl text-gray-500 dark:text-gray-400">Verificación de contribuyente</p>
                                <p class="text-sm text-gray-500 dark:text-gray-400">Ingrese por favor el Número de Identificación o NIT, sin digito de verificación</p>
                            </div>
                            <div class="relative z-0 w-full mb-5 group">
                                <input type="number" name="registroUsuario" id="registroUsuario" class="[&::-webkit-inner-spin-button]:appearance-none block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" "  required />
                                <label for="registroUsuario" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">NIT</label>
                            </div>
                            <div class="flex justify-between items-center">
                                <button data-modal-hide="modalRegistro" type="button" class="text-white bg-greenp1 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Confirmar</button>
                                <p class="text-sm text-gray-500 dark:text-gray-400">¿Ya tienes una cuenta? <button @click="showTab('iniciar')" type="button" class="text-black bg-white rounded-lg px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Inicia sesión aquí</button></p>
                            </div>
                        </fwb-tab>
                    </fwb-tabs>
                    <!--
                    <div class="mb-4 border-b border-gray-200 dark:border-gray-700">
                        <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="session-tab" data-tabs-toggle="#session-tab-content" role="tablist">
                            <li class="me-2" role="presentation">
                                <button class="inline-block p-4 border-b-2 rounded-t-lg" id="iniciar-tab" data-tabs-target="#iniciar" type="button" role="tab" aria-controls="iniciar" aria-selected="false">Iniciar sesión</button>
                            </li>
                            <li class="me-2" role="presentation">
                                <button class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300" id="registrar-tab" data-tabs-target="#registrar" type="button" role="tab" aria-controls="registrar" aria-selected="false">Registrarse</button>
                            </li>
                        </ul>
                    </div>
                    <div id="session-tab-content">
                        <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="iniciar" role="tabpanel" aria-labelledby="iniciar-tab">
                            <div class="relative z-0 w-full mb-5 group">
                                <input type="email" name="floating_email" id="floating_email" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                                <label for="floating_email" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Email address</label>
                            </div>
                            <div class="relative z-0 w-full mb-5 group">
                                <input type="password" name="floating_password" id="floating_password" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                                <label for="floating_password" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Password</label>
                            </div>
                            <div class="relative z-0 w-full mb-5 group">
                                <input type="password" name="repeat_password" id="floating_repeat_password" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                                <label for="floating_repeat_password" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Confirm password</label>
                            </div>
                            <div class="flex justify-end">
                                <a href="#" class="text-sm text- text-gray-500 dark:text-gray-400">¿Olvidaste la contraseña</a>
                            </div>
                            <div class="flex justify-center mb-5">
                                <button data-modal-hide="modalRegistro" type="button" class="text-white bg-greenp1 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Iniciar sesión</button>
                            </div>
                            <hr>
                            <p class="text-sm text-gray-500 dark:text-gray-400">¿No tienes una cuenta? <button @click="showTabRegistrar" type="button" class="text-black bg-gray-50 rounded-lg px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Registrate aquí</button></p>
                        </div>
                        <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="registrar" role="tabpanel" aria-labelledby="registrar-tab">
                            <p class="text-sm text-gray-500 dark:text-gray-400">This is some placeholder content the <strong class="font-medium text-gray-800 dark:text-white">Dashboard tab's associated content</strong>. Clicking another tab will toggle the visibility of this one for the next. The tab JavaScript swaps classes to control the content visibility and styling.</p>
                        </div>
                    </div>-->
                </div>
            </div>
        </div>
    </div>
</template>
