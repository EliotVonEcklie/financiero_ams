<script setup>
import Layout from '~Layouts/Private.vue'
import Table from '~Components/Table.vue'
import StateIndicator from '~Components/StateIndicator.vue'
import { ref } from 'vue'
import { router, Link } from '@inertiajs/vue3'
import { FwbButton, FwbModal } from 'flowbite-vue'
import axios from 'axios'

const title = 'Facturas Masivas'

defineProps({ facturaMasivas: Array })

const isShowModal = ref(false)
const softDeleteId = ref(null)

function closeModal (accept) {
    if (accept) {
        axios.delete(route('factura_predials.destroy', softDeleteId.value))
        .then(router.reload())
    }

    isShowModal.value = false
    softDeleteId.value = null
}

function showModal (id) {
    softDeleteId.value = id
    isShowModal.value = true
}

function softDelete(selectedElements) {
    selectedElements.forEach(async x =>
        await axios.delete(route('factura_predials.destroy', x.id))
    )

    router.reload()
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

                            <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Está seguro de querer anular esta factura masiva?</h3>

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
                    empty-message="No hay facturas registradas."
                    soft-delete-text="Anular Selección"
                    :headers="['Id', 'Fecha de Elaboración', 'Última Resolución', 'Deuda Mínima', 'Estado', 'Acción']"
                    :elements="facturaMasivas"
                    allow-soft-delete
                    @create="router.get(route('factura_masivas.create'))"
                    @soft-delete="softDelete"
                >
                    <template #id="{ element }">{{ element.id }}</template>

                    <template #row="{ element }">
                        <td class="px-3 py-4">
                            {{ $date(element.created_at) }}
                        </td>

                        <td class="px-3 py-4">
                            {{ element.last_resolucion }}
                        </td>

                        <td class="px-2 py-4">
                            {{ $numbers.cop(element.min_deuda) }}
                        </td>

                        <td class="px-5 py-4">
                            <div class="flex flex-row justify-between">
                                <StateIndicator :state="! element.processing" enabled="Procesado" disabled="Procesando..." />

                                <StateIndicator :state="element.state" disabled="Anulado" />

                                <button v-if="element.state && !element.factura_pagada" @click="showModal(element.id)" class="focus:outline-none text-white bg-red-700 focus:ring-4 focus:ring-red-300 font-medium rounded-lg dark:bg-red-600 dark:focus:ring-red-900 hover:bg-red-800 dark:hover:bg-red-700 px-2 py-2 ms-1">
                                    <svg class="w-6 h-6 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                        <path fill-rule="evenodd" d="M8.6 2.6A2 2 0 0 1 10 2h4a2 2 0 0 1 2 2v2h3a1 1 0 1 1 0 2v12a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V8a1 1 0 0 1 0-2h3V4c0-.5.2-1 .6-1.4ZM10 6h4V4h-4v2Zm1 4a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Zm4 0a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Z" clip-rule="evenodd"></path>
                                    </svg>
                                </button>
                            </div>
                        </td>

                        <td class="px-3 py-4 flex items-center justify-center">
                            <Link :href="route('factura_masivas.show', { factura_masiva: element.id })" class="text-white text-lg bg-gradient-to-r from-red-400 via-red-500 to-red-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg px-4 py-2.5 text-center flex flex-row gap-3 items-center">
                                Ver

                                <svg class="w-6 h-6 pointer-events-none" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 14v4.833A1.166 1.166 0 0 1 16.833 20H5.167A1.167 1.167 0 0 1 4 18.833V7.167A1.166 1.166 0 0 1 5.167 6h4.618m4.447-2H20v5.768m-7.889 2.121 7.778-7.778"/>
                                </svg>
                            </Link>
                        </td>
                    </template>
                </Table>
            </section>
        </main>
    </Layout>
</template>
