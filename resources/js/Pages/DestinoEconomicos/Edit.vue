<script setup>
import Layout from '~Components/Layout.vue'
import { useForm, router } from '@inertiajs/vue3'

const props = defineProps({ destinoEconomico: Object, codigoDestinoEconomicos: Object })
const form = useForm({
    nombre: props.destinoEconomico.nombre,
    codigo_destino_economicos: []
})

function submit() {
    console.log(props.codigoDestinoEconomicos)
    form.codigo_destino_economicos = props.codigoDestinoEconomicos

    form.put(route('destino_economicos.update', props.destinoEconomico.id), {
        onSuccess: () => {
            router.get(route('destino_economicos.index'))
        }
    })
}
</script>

<template>
    <Layout title="Editar Destino Económico">
        <form @submit.prevent="submit" class="max-w-sm mx-auto">
            <div class="mb-5">
                <label for="nombre" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nombre</label>
                <input v-model="form.nombre" type="text" id="nombre" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
            </div>
            <div class="mb-5 w-full">
                <div v-if="codigoDestinoEconomicos.length > 0">
                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Seleccionar Códigos</label>
                    <ul class="w-full grid grid-cols-3 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                        <li v-for="codigoDestinoEconomico in codigoDestinoEconomicos" :key="codigoDestinoEconomico.id" class="w-full border-b border-r border-gray-200 dark:border-gray-600">
                            <div class="flex items-center ps-3">
                                <input :id="codigoDestinoEconomico.id + '-checkbox'" type="checkbox" v-model="codigoDestinoEconomico.selected" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                <label :for="codigoDestinoEconomico.id + '-checkbox'" class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{ codigoDestinoEconomico.codigo }}</label>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>

            <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Guardar</button>
        </form>
    </Layout>
</template>
