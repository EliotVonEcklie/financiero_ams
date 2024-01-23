<template>
    <ModalConfirmarRegistro ref="rModalConfirmarRegistro" :documento="intVerContribuyente" :hideModal="hideModal" />

    <div id="modalRegistro" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full lg:max-w-2xl md:max-w-4xl max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div class="bg-bluep flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="lg:text-xl md:text-3xl font-semibold text-white dark:text-white">
                        Bienvenido
                    </h3>
                    <button type="button" class="text-white bg-transparent rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" @click="hideModal('modalRegistro')">
                        <svg class="lg:w-3 lg:h-3 md:w-6 md:h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <div class="p-4 md:p-5 space-y-4">
                    <!--
                    <div class="mb-4 border-b border-gray-200 dark:border-gray-700">
                        <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="default-tab" data-tabs-toggle="#default-tab-content" role="tablist">
                            <li class="me-2" role="presentation">
                                <button class="inline-block p-4 border-b-2 rounded-t-lg" id="profile-tab" data-tabs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Profile</button>
                            </li>
                            <li class="me-2" role="presentation">
                                <button class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300" id="dashboard-tab" data-tabs-target="#dashboard" type="button" role="tab" aria-controls="dashboard" aria-selected="false">Dashboard</button>
                            </li>
                            <li class="me-2" role="presentation">
                                <button class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300" id="settings-tab" data-tabs-target="#settings" type="button" role="tab" aria-controls="settings" aria-selected="false">Settings</button>
                            </li>
                            <li role="presentation">
                                <button class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300" id="contacts-tab" data-tabs-target="#contacts" type="button" role="tab" aria-controls="contacts" aria-selected="false">Contacts</button>
                            </li>
                        </ul>
                    </div>
                    <div id="tab-login">
                        <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="iniciar" role="tabpanel" aria-labelledby="iniciar-tab">
                            <p class="text-sm text-gray-500 dark:text-gray-400">This is some placeholder content the <strong class="font-medium text-gray-800 dark:text-white">Profile tab's associated content</strong>. Clicking another tab will toggle the visibility of this one for the next. The tab JavaScript swaps classes to control the content visibility and styling.</p>
                        </div>
                        <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="registrar" role="tabpanel" aria-labelledby="registrar-tab">
                            <p class="text-sm text-gray-500 dark:text-gray-400">This is some placeholder content the <strong class="font-medium text-gray-800 dark:text-white">Dashboard tab's associated content</strong>. Clicking another tab will toggle the visibility of this one for the next. The tab JavaScript swaps classes to control the content visibility and styling.</p>
                        </div>
                    </div>-->

                    <fwb-tabs  v-model="activetab" variant="underline">
                        <fwb-tab name="iniciar" title="Iniciar sesión" >
                            <div class="text-center flex flex-col items-center mb-5 justify-center">
                                <div class="mb-5 inline rounded-full p-8 bg-bluep">
                                    <svg class="w-24 h-24" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="#fff" d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512H418.3c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304H178.3z"/></svg>
                                </div>
                                <p class="lg:text-sm md:text-2xl text-gray-500 dark:text-gray-400">Ingrese por favor el número de Identificación o NIT, sin digito de verificación y su contraseña.</p>
                            </div>
                            <div class="relative z-0 w-full mb-5 group">
                                <input v-model="intUsuario" type="number" name="sesionUsuario" id="sesionUsuario"  class="[&::-webkit-inner-spin-button]:appearance-none block py-2.5 px-0 w-full lg:text-sm md:text-2xl text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                                <label for="sesionUsuario" class="peer-focus:font-medium absolute lg:text-sm md:text-2xl text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">NIT</label>
                                <div v-html="invalidUser"></div>
                            </div>
                            <div class="relative z-0 w-full mb-5 group">
                                <input v-model="strPass" type="password" name="sesionContrasena" id="sesionContrasena" class="block py-2.5 px-0 w-full lg:text-sm md:text-2xl text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                                <label for="sesionContrasena" class="peer-focus:font-medium absolute lg:text-sm md:text-2xl text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Contraseña</label>
                                <div v-html="invalidPass"></div>
                            </div>
                            <div class="flex justify-between items-center mb-5">
                                <button :disabled="loading" @click="loginUser" type="button" :class="{'text-white bg-greenp1 font-medium rounded-lg lg:text-sm md:text-2xl px-5 py-2.5 text-center me-2 inline-flex items-center': !loading,'text-black bg-white border border-gray-200 rounded-lg lg:text-sm md:text-2xl px-5 py-2.5 text-center me-2 inline-flex items-center':loading}">
                                    <div v-if="loading">
                                        <svg aria-hidden="true" role="status" class="inline w-4 h-4 me-3 text-gray-200 animate-spin dark:text-gray-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                                            <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="#1C64F2"/>
                                        </svg>
                                        Espere...
                                    </div>
                                    <div v-else>
                                        Iniciar sesión
                                    </div>
                                </button>
                                <a href="#" class="lg:text-sm md:text-2xl text- text-gray-500 dark:text-white">¿Olvidaste la contraseña?</a>
                            </div>
                            <hr>
                            <p class="lg:text-sm md:text-2xl text-gray-500 dark:text-gray-400">¿No tienes una cuenta? <button @click="changeTab('registrar')" type="button" class="text-black bg-white rounded-lg px-5 py-2.5 text-center dark:text-white dark:bg-gray-700">Registrate aquí</button></p>
                        </fwb-tab>
                        <fwb-tab name="registrar" title="Registrarse" @click="changeTab('registrar')">
                            <div class="text-center flex flex-col items-center justify-center mb-5">
                                <div class="mb-5 inline rounded-full p-8 bg-bluep">
                                    <svg class="w-24 h-24" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><path fill="#fff" d="M528 160V416c0 8.8-7.2 16-16 16H320c0-44.2-35.8-80-80-80H176c-44.2 0-80 35.8-80 80H64c-8.8 0-16-7.2-16-16V160H528zM64 32C28.7 32 0 60.7 0 96V416c0 35.3 28.7 64 64 64H512c35.3 0 64-28.7 64-64V96c0-35.3-28.7-64-64-64H64zM272 256a64 64 0 1 0 -128 0 64 64 0 1 0 128 0zm104-48c-13.3 0-24 10.7-24 24s10.7 24 24 24h80c13.3 0 24-10.7 24-24s-10.7-24-24-24H376zm0 96c-13.3 0-24 10.7-24 24s10.7 24 24 24h80c13.3 0 24-10.7 24-24s-10.7-24-24-24H376z"/></svg>
                                </div>
                                <p class="lg:text-xl md:text-2xl text-gray-500 dark:text-gray-400">Verificación de contribuyente</p>
                                <p class="lg:text-sm md:text-2xl text-gray-500 dark:text-gray-400">Ingrese por favor el Número de Identificación o NIT, sin digito de verificación</p>
                            </div>
                            <div class="relative z-0 w-full mb-5 group">
                                <input v-model="intVerContribuyente" type="number" name="registroUsuario" id="registroUsuario" class="[&::-webkit-inner-spin-button]:appearance-none block py-2.5 px-0 w-full lg:text-sm md:text-2xl text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " pattern="[0-9]+" required />
                                <label for="registroUsuario" class="peer-focus:font-medium absolute lg:text-sm md:text-2xl text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">NIT</label>
                                <div v-if="intVerContribuyente ==null ||intVerContribuyente < 100000 || intVerContribuyente > 9999999999">
                                    <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">Oops!</span> El número de documento es invalido!</p>
                                </div>
                            </div>
                            <div class="flex justify-between items-center">
                                <button :disabled="loading" @click="verifyUser" type="button" :class="{'text-white bg-greenp1 font-medium rounded-lg lg:text-sm md:text-2xl px-5 py-2.5 text-center me-2 inline-flex items-center': !loading,'text-black bg-white border border-gray-200 rounded-lg lg:text-sm md:text-2xl px-5 py-2.5 text-center me-2 inline-flex items-center':loading}">
                                    <div v-if="loading">
                                        <svg aria-hidden="true" role="status" class="inline w-4 h-4 me-3 text-gray-200 animate-spin dark:text-gray-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                                            <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="#1C64F2"/>
                                        </svg>
                                        Espere...
                                    </div>
                                    <div v-else>
                                        Confirmar
                                    </div>
                                </button>
                                <p class="lg:text-sm md:text-2xl text-gray-500 dark:text-gray-400">¿Ya tienes una cuenta? <button @click="changeTab('iniciar')" type="button" class="text-black bg-white rounded-lg px-5 py-2.5 text-center dark:text-white dark:bg-gray-700">Inicia sesión aquí</button></p>
                            </div>
                        </fwb-tab>
                    </fwb-tabs>
                </div>
            </div>
        </div>
    </div>
</template>
<script setup>
import { ref } from 'vue'
import { FwbTab, FwbTabs } from 'flowbite-vue'
import ModalConfirmarRegistro from './ModalConfirmarRegistro.vue'

const rModalConfirmarRegistro = ref(null)

const loading = ref(false)
const invalidContr = ref()
const invalidUser = ref()
const invalidPass = ref()

const intVerContribuyente = ref(null)
const intUsuario = ref(null)
const strPass = ref("")
const props = defineProps(['login'])
const emits = defineEmits(['hideModal',"showModal"])
let activetab = ref('iniciar')

function verifyUser(){
    if(intVerContribuyente.value !== null && intVerContribuyente.value > 100000 && intVerContribuyente.value < 9999999999){
        loading.value = true;
        setTimeout(() => {
            loading.value = false

            if (!props.login) {
                emits('showModal', 'modalConfirmarRegistro')
                emits('hideModal', 'modalRegistro')
            }
        }, 2000)
    }
}

function loginUser() {
    if (intUsuario.value !== null && strPass.value !== '' && intUsuario.value > 100000 && intUsuario.value < 9999999999) {
        loading.value = true

        setTimeout(() => {
            loading.value = false
            invalidUser.value = ''
            invalidPass.value = ''

            if(!flag){

            }
        }, 2000)
    } else if (intUsuario.value < 100000 || intUsuario.value > 9999999999 || intUsuario.value == null) {
        invalidUser.value = '<p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">Oops!</span> El número de documento es invalido!</p>';
    } else if (intUsuario.value ==null && strPass.value ==""){
        invalidUser.value = '<p class="mt-2 text-sm text-red-600 dark:text-red-500"><Este class="font-medium">Este campo es obligatorio!</p>';
        invalidPass.value ='<p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">Este campo es obligatorio!</p>';
    } else if (strPass.value === ''){
        invalidPass.value ='<p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">Este campo es obligatorio!</p>';
    }
}

function changeTab(tab){
    activetab.value = tab;
}
</script>
