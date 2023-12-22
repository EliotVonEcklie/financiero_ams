<script setup>
import Layout from '../Layout.vue'
import { useForm, router } from '@inertiajs/vue3'
import { ref, onMounted } from 'vue'
import { FwbModal, FwbButton } from 'flowbite-vue'

const form = useForm({
    nombre: null
})
const codigos = ref([])
const isShowModal = ref(false)
const props = defineProps(['codigoDestinoEconomicos'])

function closeModal () {
    isShowModal.value = false
}

function showModal () {
    isShowModal.value = true
}

function submit() {
    form.post(this.$route('destino_economicos.store'), {
        onSuccess: () => {
            router.get(this.$route('destino_economicos.index'))
        }
    })
}

function isNewCodigo(codigo) {
    let flag = true

    props.codigoDestinoEconomicos.forEach(element => {
        if (element.codigo === codigo) {
            flag = false
        }
    });

    return flag
}

function addCodigo() {
    let codigo = document.getElementById('add-codigo').value

    if (codigos.value.includes(codigo)) {
        return
    }

    if (isNewCodigo(codigo)) {
        showModal()
    } else {
        confirmAddCodigo()
    }
}

function confirmAddCodigo() {
    if (isShowModal.value) {
        closeModal()
    }

    codigos.value.push(document.getElementById('add-codigo').value)
    document.getElementById('add-codigo').value = ''
}
</script>

<template>
    <Layout>
        <template #title>Crear Destino Económico</template>

        <form @submit.prevent="submit()" class="max-w-sm mx-auto">
            <div class="mb-5">
                <label for="nombre" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nombre</label>
                <input type="text" id="nombre" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
            </div>
            <div class="mb-5">
                <div v-if="codigoDestinoEconomicos.length > 0">
                    <label for="add-codigo" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
                    <div class="relative">
                        <input type="text" id="add-codigo" class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Busque un código...">
                        <button type="button" @click="addCodigo()" class="text-white absolute end-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            <svg class="w-[16px] h-[16px] text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.546.5a9.5 9.5 0 1 0 9.5 9.5 9.51 9.51 0 0 0-9.5-9.5ZM13.788 11h-3.242v3.242a1 1 0 1 1-2 0V11H5.304a1 1 0 0 1 0-2h3.242V5.758a1 1 0 0 1 2 0V9h3.242a1 1 0 1 1 0 2Z"/>
                            </svg>
                        </button>
                    </div>
                </div>
                <div v-else>
                    <p class="italic text-center">No hay códigos registrados.</p>
                </div>
            </div>
            <div v-if="codigos.length > 0" class="mb-5">
                <ul class="w-48 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                    <li v-for="codigo in codigos" class="w-full px-4 py-2 border-b border-gray-200 rounded-t-lg dark:border-gray-600">{{ codigo }}</li>
                </ul>
            </div>

            <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Crear</button>
        </form>

        <fwb-modal v-if="isShowModal" @close="closeModal" size="sm" not-escapable>
            <template #header>
            <div class="flex items-center text-lg">
                Advertencia
            </div>
            </template>
            <template #body>
            <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400">
                Ha seleccionado un código que no existe en la base de datos. Está seguro de querer agregarlo al destino económico?
            </p>
            <p class="italic text-sm leading-relaxed text-gray-500 dark:text-gray-400">
                El código se agregara a la base de datos si lo agrega al destino económico.
            </p>
            </template>
            <template #footer>
            <div class="flex justify-between">
                <fwb-button @click="closeModal" color="alternative">
                No, cancelar
                </fwb-button>
                <fwb-button @click="confirmAddCodigo" color="green">
                Si, estoy seguro
                </fwb-button>
            </div>
            </template>
        </fwb-modal>
    </Layout>
</template>
