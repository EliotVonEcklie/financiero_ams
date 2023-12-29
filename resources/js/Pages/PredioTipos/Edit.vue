<script setup>
import Layout from '~Pages/Layout.vue'
import { useForm, router } from '@inertiajs/vue3'

const props = defineProps({ predioTipo: Object })
const form = useForm({
    tipo: props.predioTipo.tipo
})

function submit() {
    form.put(route('predio_tipos.update', props.predioTipo.id), {
        onSuccess: () => {
            router.get(route('predio_tipos.index'))
        }
    })
}
</script>

<template>
    <Layout title="Editar tipo predio">
        <form @submit.prevent="submit" class="max-w-sm mx-auto">
            <div class="mb-5">
                <label for="tipo" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tipo</label>
                <input v-model="form.tipo" type="text" id="tipo" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
            </div>

            <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Guardar</button>
        </form>
    </Layout>
</template>
