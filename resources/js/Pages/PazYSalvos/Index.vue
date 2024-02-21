<script setup>
import Layout from '~Layouts/Private.vue'
import { ref } from 'vue'
import { router } from '@inertiajs/vue3'
import axios from 'axios'
import Table from '~Components/Table.vue'
import StateIndicator from '~Components/StateIndicator.vue'
import { FwbButton, FwbModal } from 'flowbite-vue'

const title = 'Paz Y Salvos'

defineProps({ pazYSalvos: Array })

const isShowModal = ref(false)
const softDeleteId = ref(null)

function closeModal(accept) {
    if (accept) {
        axios.delete(route('paz_y_salvos.destroy', softDeleteId.value))
        .then(router.reload())
    }

    isShowModal.value = false
    softDeleteId.value = null
}

function showModal(id) {
    softDeleteId.value = id
    isShowModal.value = true
}

function softDelete(selectedElements) {
    selectedElements.forEach(async x =>
        await axios.delete(route('paz_y_salvos.destroy', x.id))
    )

    router.reload()
}

function openPdf(evt) {
    if (!evt.ctrlKey) {
        evt.target.dispatchEvent(new MouseEvent('click', { ctrlKey: true }))
    }
}
</script>

<template>
    <Layout :title="title">
        <main class="p-4 pt-20 text-gray-900 dark:text-white">
            <h1 class="text-3xl text-left">{{ title }}</h1>

            <section class="border-t-2 mt-2 pt-6">
                <FwbModal v-if="isShowModal" persistent>
                    <template #header>
                        <div class="flex items-center text-lg">
                            Advertencia!
                        </div>
                    </template>
                    <template #body>
                        <div class="p-4 md:p-5 text-center">
                            <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                            </svg>

                            <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Está seguro de querer anular este paz y salvo?</h3>

                            <FwbButton @click="closeModal(true)" color="red">
                                Sí, estoy seguro
                            </FwbButton>
                            <FwbButton @click="closeModal(false)" color="alternative" class="ms-4">
                                No, cancelar
                            </FwbButton>
                        </div>
                    </template>
                </FwbModal>

                <Table
                    empty-message="No hay paz y salvos."
                    soft-delete-text="Anular Selección"
                    :headers="['Id', 'Fecha de Elaboración', 'Código Catastro', 'Contribuyente', 'Válido Hasta', 'Recibo de Caja', 'Estado', 'Acción']"
                    :elements="pazYSalvos"
                    allow-create allow-soft-delete
                    @create="router.get(route('paz_y_salvos.search'))"
                    @soft-delete="softDelete"
                >
                    <template #id="{ element }">{{ element.id }}</template>

                    <template #row="{ element }">
                        <td class="px-3 py-4">
                            {{ $date(element.created_at) }}
                        </td>

                        <td class="px-3 py-4">
                            {{ element.codigo_catastro }}
                        </td>

                        <td class="px-2 py-4">
                            {{ element.contribuyente }}
                        </td>

                        <td class="px-6 py-4">
                            {{ $date(element.hasta) }}
                        </td>

                        <td class="px-3 py-4">
                            {{ element.tesorecibocaja_id }}
                        </td>

                        <td class="px-5 py-4">
                            <div class="flex flex-row justify-between">
                                <StateIndicator :state="element.state" disabled="Anulado" />

                                <button v-if="element.state && element.canDelete" @click="showModal(element.id)" class="focus:outline-none text-white bg-red-700 focus:ring-4 focus:ring-red-300 font-medium rounded-lg dark:bg-red-600 dark:focus:ring-red-900 hover:bg-red-800 dark:hover:bg-red-700 px-1.5 py-1.5 ms-1">
                                    <svg class="w-5 h-5 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                        <path fill-rule="evenodd" d="M8.6 2.6A2 2 0 0 1 10 2h4a2 2 0 0 1 2 2v2h3a1 1 0 1 1 0 2v12a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V8a1 1 0 0 1 0-2h3V4c0-.5.2-1 .6-1.4ZM10 6h4V4h-4v2Zm1 4a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Zm4 0a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Z" clip-rule="evenodd"></path>
                                    </svg>
                                </button>
                            </div>
                        </td>

                        <td class="px-3 py-4 flex items-center justify-center">
                            <a :href="route('paz_y_salvos.show', { paz_y_salvo: element.id })" target="_blank" @click.prevent="openPdf" class="text-white bg-gradient-to-r from-red-400 via-red-500 to-red-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg px-2.5 py-2.5 text-center">
                                <svg class="w-8 h-8 pointer-events-none" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                    <path fill-rule="evenodd" d="M9 2.2V7H4.2l.4-.5 3.9-4 .5-.3Zm2-.2v5a2 2 0 0 1-2 2H4a2 2 0 0 0-2 2v7c0 1.1.9 2 2 2 0 1.1.9 2 2 2h12a2 2 0 0 0 2-2 2 2 0 0 0 2-2v-7a2 2 0 0 0-2-2V4a2 2 0 0 0-2-2h-7Zm-6 9a1 1 0 0 0-1 1v5a1 1 0 1 0 2 0v-1h.5a2.5 2.5 0 0 0 0-5H5Zm1.5 3H6v-1h.5a.5.5 0 0 1 0 1Zm4.5-3a1 1 0 0 0-1 1v5c0 .6.4 1 1 1h1.4a2.6 2.6 0 0 0 2.6-2.6v-1.8a2.6 2.6 0 0 0-2.6-2.6H11Zm1 5v-3h.4a.6.6 0 0 1 .6.6v1.8a.6.6 0 0 1-.6.6H12Zm5-5a1 1 0 0 0-1 1v5a1 1 0 1 0 2 0v-1h1a1 1 0 1 0 0-2h-1v-1h1a1 1 0 1 0 0-2h-2Z" clip-rule="evenodd"/>
                                </svg>
                            </a>
                        </td>
                    </template>
                </Table>
            </section>
        </main>
    </Layout>
</template>
