<template>
    <!-- Main modal -->
    <div id="modalRepresentante" data-modal-backdrop="static" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-7xl max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="lg:text-xl md:text-3xl font-semibold text-gray-900 dark:text-white">
                        Nuevo representante
                    </h3>
                    <button type="button" class="text-gray-400 bg-transparent rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" @click="hideModal('modalRepresentante')">
                        <svg class="lg:w-3 lg:h-3 md:w-6 md:h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <div class="p-4 md:p-5 space-y-4">
                    <div class="grid lg:grid-cols-2 lg:gap-4 md:grid-cols-1">
                        <div class="relative z-0 w-full mb-5 group">
                            <label for="underline_select" class="sr-only">Tipo de documento</label>
                            <select v-model="txtSelectDocumento" class="block py-2.5 px-0 w-full lg:text-sm md:text-2xl text-gray-500 bg-transparent border-0 border-b-2 border-gray-200 appearance-none dark:text-gray-400 dark:border-gray-700 focus:outline-none focus:ring-0 focus:border-gray-200 peer">
                                <option selected>Seleccione tipo de documento</option>
                                <option value="Cédula de ciudadania">Cédula de ciudadania</option>
                                <option value="Cédula extranjera">Cédula extranjera</option>
                                <option value="NIT">NIT</option>
                                <option value="Pasaporte">Pasaporte</option>
                                <option value="Tarjeta de identidad">Tarjeta de identidad</option>
                            </select>
                        </div>
                        <div class="relative z-0 w-full mb-5 group">
                            <input type="text" class="block py-2.5 px-0 w-full lg:text-sm md:text-2xl text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " v-model="txtDocumento" required />
                            <label for="floating_first_name" class="peer-focus:font-medium absolute lg:text-sm md:text-2xl text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">No. de Documento</label>
                        </div>
                        <div class="relative z-0 w-full mb-5 group">
                            <input type="text" class="block py-2.5 px-0 w-full lg:text-sm md:text-2xl text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " v-model="txtNombre" required />
                            <label for="floating_last_name" class="peer-focus:font-medium absolute lg:text-sm md:text-2xl text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Primer nombre</label>
                        </div>
                        <div class="relative z-0 w-full mb-5 group">
                            <input type="text" class="block py-2.5 px-0 w-full lg:text-sm md:text-2xl text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " v-model="txtSegundoNombre"  />
                            <label for="floating_last_name" class="peer-focus:font-medium absolute lg:text-sm md:text-2xl text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Segundo nombre</label>
                        </div>
                        <div class="relative z-0 w-full mb-5 group">
                            <input type="text" class="block py-2.5 px-0 w-full lg:text-sm md:text-2xl text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " v-model ="txtApellido" required />
                            <label for="floating_last_name" class="peer-focus:font-medium absolute lg:text-sm md:text-2xl text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Primer apellido</label>
                        </div>
                        <div class="relative z-0 w-full mb-5 group">
                            <input type="text" class="block py-2.5 px-0 w-full lg:text-sm md:text-2xl text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " v-model="txtSegundoApellido" />
                            <label for="floating_last_name" class="peer-focus:font-medium absolute lg:text-sm md:text-2xl text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Segundo apellido</label>
                        </div>
                    </div>
                    <div class="grid lg:grid-cols-3 gap-2 md:grid-cols-1">
                        <div class="relative z-0 w-full mb-5 group">
                            <label for="underline_select" class="sr-only">Tipo de representante</label>
                            <select v-model="txtSelectRepresentante" class="block py-2.5 px-0 w-full lg:text-sm md:text-2xl text-gray-500 bg-transparent border-0 border-b-2 border-gray-200 appearance-none dark:text-gray-400 dark:border-gray-700 focus:outline-none focus:ring-0 focus:border-gray-200 peer">
                                <option selected>Seleccione tipo de representante</option>
                                <option value="Principal">Principal</option>
                                <option value="Sumplente">Suplente</option>
                                <option value="Apoderado">Apoderado</option>
                            </select>
                        </div>
                        <div class="relative z-0 w-full mb-5 group">
                            <input type="text" class="block py-2.5 px-0 w-full lg:text-sm md:text-2xl text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder="" v-model="txtTelefono"  required/>
                            <label for="floating_last_name" class="peer-focus:font-medium absolute lg:text-sm md:text-2xl text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Número de celular</label>
                        </div>
                        <div class="relative z-0 w-full mb-5 group">
                            <input type="email" class="block py-2.5 px-0 w-full lg:text-sm md:text-2xl text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" "  v-model="txtCorreo" required/>
                            <label for="floating_last_name" class="peer-focus:font-medium absolute lg:text-sm md:text-2xl text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Correo</label>
                        </div>
                    </div>
                </div>
                <!-- Modal footer -->
                <div class="flex items-center justify-end p-4 space-x-2 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                    <button @click="addRepresentante" type="button" class="text-white bg-greenp1 font-medium rounded-lg lg:text-sm md:text-2xl px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Confirmar</button>
                    <button @click="hideModal('modalRepresentante')" type="button" class="text-white bg-red-500 font-medium rounded-lg lg:text-sm md:text-2xl px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Cancelar</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref } from 'vue'

const props = defineProps(['idRepresentante','objRepresentante','hideModal']);
const emits = defineEmits(['addRepresentante']);
let txtDocumento = props.idRepresentante != "" ? props.objRepresentante['documento']  : ref('')
let txtSelectDocumento = props.idRepresentante != "" ? props.objRepresentante['tipo_documento']  : ref('')
let txtNombre = props.idRepresentante != "" ? props.objRepresentante['nombre']  : ref('')
let txtSegundoNombre = props.idRepresentante != "" ? props.objRepresentante['segundo_nombre']  : ref('')
let txtApellido= props.idRepresentante != "" ? props.objRepresentante['apellido']  : ref('')
let txtSegundoApellido = props.idRepresentante != "" ? props.objRepresentante['segundo_apellido']  : ref('')
let txtSelectRepresentante = props.idRepresentante != "" ? props.objRepresentante['representante']  : ref('')
let txtTelefono = props.idRepresentante != "" ? props.objRepresentante['telefono']  : ref('')
let txtCorreo = props.idRepresentante != "" ? props.objRepresentante['correo']  : ref('')
console.log(props.objRepresentante['documento']);
function addRepresentante(){
    let obj ={}
    if(props.idRepresentante.value !=""){
        obj ={
            "tipo_documento":txtSelectDocumento.value,
            "documento":txtDocumento.value,
            "nombre":txtNombre.value,
            "segundo_nombre":txtSegundoNombre.value,
            "apellido": txtApellido.value,
            "segundo_apellido":txtSegundoApellido.value,
            "representante": txtSelectRepresentante.value,
            "telefono":txtTelefono.value,
            "correo":txtCorreo.value,
        }
    }else{
        obj ={
            "tipo_documento":objRepresentante['tipo_documento'],
            "documento":objRepresentante['documento'],
            "nombre":objRepresentante['nombre'],
            "representante":objRepresentante['representante'],
            "telefono":objRepresentante['telefono'],
            "correo":objRepresentante['correo'],
        }
    }
    emits('addRepresentante',obj);
}
function setValues(){
    if(props.idRepresentante.value != 0){
        txtSelectDocumento.value=props.objRepresentante['tipo_documento']
        txtDocumento.value=props.objRepresentante['documento']
        txtNombre.value=props.objRepresentante['nombre']
        txtSegundoNombre.value=props.objRepresentante['segundo_nombre']
        txtApellido.value=props.objRepresentante['apellido']
        txtSegundoApellido.value=props.objRepresentante['segundo_apellido']
        txtSelectRepresentante.value=props.objRepresentante['representante']
        txtTelefono.value=props.objRepresentante['telefono']
        txtCorreo.value=props.objRepresentante['correo']
    }
}
</script>
