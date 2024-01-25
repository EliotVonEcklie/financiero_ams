<script setup>
import { Head, useForm } from '@inertiajs/vue3'
import { onMounted } from 'vue'
import { initFlowbite } from 'flowbite'

onMounted(() => {
    initFlowbite()
})
const props = defineProps({ app_key: String })
const form = useForm({
    app_key: props.app_key,
    domain: null,
    db_name: null,
    db_username: null,
    db_password: null,
    nombre: null,
    nit: null,
    lema: null,
    imagen: null,
    direccion: null,
    entidad: null,
    correo: null,
    pagina: null,
    telefono: null
})
const title = 'Setup Municipio'
</script>
<template>
    <Head :title="title + ' Ideal10'"></Head>

    <main class="p-4 mt-4 max-w-screen-sm mx-auto text-gray-900 dark:text-white">
        <h1 class="text-3xl text-left">{{ title }}</h1>

        <section class="border-t-2 mt-2 pt-6">
            <form @submit.prevent="form.post(route('setup_municipio'))">
                <div class="mb-5">
                    <label for="app-key" class="block mb-2 text-sm font-medium">App Key</label>
                    <input v-model="form.app_key" type="text" id="app-key" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                </div>
                <div class="mb-5">
                    <label for="domain" class="block mb-2 text-sm font-medium">Dominio</label>
                    <input v-model="form.domain" type="text" id="domain" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                </div>
                <div class="mb-5">
                    <label for="db_name" class="block mb-2 text-sm font-medium">Nombre Base</label>
                    <input v-model="form.db_name" type="text" id="db_name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                </div>
                <div class="mb-5">
                    <label for="db_username" class="block mb-2 text-sm font-medium">Usuario Base</label>
                    <input v-model="form.db_username" type="text" id="db_username" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                </div>
                <div class="mb-5">
                    <label for="db_password" class="block mb-2 text-sm font-medium">Contraseña Base</label>
                    <input v-model="form.db_password" type="text" id="db_password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                </div>
                <div class="mb-5">
                    <label for="nombre" class="block mb-2 text-sm font-medium">Nombre</label>
                    <input v-model="form.nombre" type="text" id="nombre" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                </div>
                <div class="mb-5">
                    <label for="entidad" class="block mb-2 text-sm font-medium">Entidad</label>
                    <input v-model="form.entidad" type="text" id="entidad" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                </div>
                <div class="mb-5">
                    <label for="lema" class="block mb-2 text-sm font-medium">Lema</label>
                    <input v-model="form.lema" type="text" id="lema" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                </div>
                <div class="mb-5">
                    <label for="nit" class="block mb-2 text-sm font-medium">NIT</label>
                    <input v-model="form.nit" type="text" id="nit" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                </div>
                <div class="mb-5">
                    <label for="direccion" class="block mb-2 text-sm font-medium">Direccion</label>
                    <input v-model="form.direccion" type="text" id="direccion" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" >
                </div>
                <div class="mb-5">
                    <label for="correo" class="block mb-2 text-sm font-medium">Correo</label>
                    <input v-model="form.correo" type="text" id="correo" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" >
                </div>
                <div class="mb-5">
                    <label for="pagina" class="block mb-2 text-sm font-medium">Página Web</label>
                    <input v-model="form.pagina" type="text" id="pagina" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                </div>
                <label for="phone-input" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Numero de telefono</label>
                <div class="mb-5 relative">
                    <div class="absolute inset-y-0 start-0 top-0 flex items-center ps-3.5 pointer-events-none">
                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 19 18">
                            <path d="M18 13.446a3.02 3.02 0 0 0-.946-1.985l-1.4-1.4a3.054 3.054 0 0 0-4.218 0l-.7.7a.983.983 0 0 1-1.39 0l-2.1-2.1a.983.983 0 0 1 0-1.389l.7-.7a2.98 2.98 0 0 0 0-4.217l-1.4-1.4a2.824 2.824 0 0 0-4.218 0c-3.619 3.619-3 8.229 1.752 12.979C6.785 16.639 9.45 18 11.912 18a7.175 7.175 0 0 0 5.139-2.325A2.9 2.9 0 0 0 18 13.446Z"/>
                        </svg>
                    </div>
                    <input v-model="form.telefono" type="text" id="phone-input" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="123 456 7890">
                </div>

                <label for="imagen" class="block mb-2 text-sm font-medium">Imagen</label>
                <input class="block mb-5 w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" id="imagen" @input="form.imagen = $event.target.files[0]" type="file">

                <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Guardar</button>
            </form>
        </section>
    </main>
</template>

