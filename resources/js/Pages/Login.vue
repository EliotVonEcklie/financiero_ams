<script setup>
import { ref } from 'vue'
import { router, Head } from '@inertiajs/vue3'

defineProps({ errors: Object })
const username = ref('')
const password = ref('')
const title = 'Iniciar Sesión'
</script>

<template>
    <Head :title="title + ' - Ideal 10'"></Head>

    <main class="max-w-[90%] md:max-w-sm mx-auto mt-8 md:mt-16">
        <h1 class="text-2xl font-semibold text-gray-900 dark:text-white">{{ title + ' - Ideal 10' }}</h1>

        <form @submit.prevent="router.get(route('index'), { username: username, password: password })" class="mt-10">
            <div class="mb-5">
                <label for="username" class="block mb-2 text-sm font-medium" :class="{ 'text-gray-900 dark:text-white': !errors.username, 'text-red-700 dark:text-red-500': errors.username }">Nombre de usuario</label>
                <input v-model="username" type="text" id="username" class="text-sm rounded-lg block w-full p-2.5 border" :class="{ 'bg-gray-50 border-gray-300 text-gray-900 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500': !errors.username, 'bg-red-50 border-red-500 text-red-900 placeholder-red-700 focus:ring-red-500 focus:border-red-500 dark:bg-red-100 dark:border-red-400': errors.username }" required>
                <p v-if="errors.username" class="mt-2 text-sm text-red-600 dark:text-red-500">{{ errors.username }}</p>
            </div>
            <div class="mb-5">
                <label for="password" class="block mb-2 text-sm font-medium" :class="{ 'text-gray-900 dark:text-white': !errors.password, 'text-red-700 dark:text-red-500': errors.password }">Contraseña</label>
                <input v-model="password" type="password" id="password" class="text-sm rounded-lg block w-full p-2.5 border" :class="{ 'bg-gray-50 border-gray-300 text-gray-900 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500': !errors.password, 'bg-red-50 border-red-500 text-red-900 placeholder-red-700 focus:ring-red-500 focus:border-red-500 dark:bg-red-100 dark:border-red-400': errors.password }" required>
                <p v-if="errors.password" class="mt-2 text-sm text-red-600 dark:text-red-500">{{ errors.password }}</p>
            </div>

            <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">{{ title }}</button>
        </form>
    </main>
</template>
