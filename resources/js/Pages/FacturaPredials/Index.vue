<script setup>
import Layout from '~Layouts/Private.vue'
import { router } from '@inertiajs/vue3'
import axios from 'axios'
import Table from '~Components/Table.vue'
import StateIndicator from '~Components/StateIndicator.vue'

const title = 'Facturas Prediales Liquidaciones'

defineProps({ facturaPredials: Array })

function softDelete(selectedElements) {
    selectedElements.forEach(async x =>
        await axios.put(route('factura_predials.update', x.id), { 'toggle': true })
    )

    router.reload()
}

function softDeleteOne(id) {
    axios.put(route('factura_predials.update', id), { 'toggle': true })
    .then(router.reload())
}

function openPdf(evt) {
    evt.target.dispatchEvent(new MouseEvent('click', { ctrlKey: true }))
}
</script>

<template>
    <Layout :title="title">
        <main class="p-4 pt-20 text-gray-900 dark:text-white">
            <h1 class="text-3xl text-left">{{ title }}</h1>

            <section class="border-t-2 mt-2 pt-6">
                <Table
                    empty-message="No hay facturas registradas."
                    soft-delete-text="Anular Selección"
                    :headers="['Id', 'Fecha de Elaboración', 'Código Catastro', 'Total', 'Orden', 'Pague Hasta', 'Factura Pagada', 'Estado', 'Acción']"
                    :elements="facturaPredials"
                    allow-create allow-soft-delete
                    @create="router.get(route('factura_predials.search'))"
                    @soft-delete="softDelete"
                >
                    <template #id="{ element }">{{ element.id }}</template>

                    <template #row="{ element }">
                        <td class="px-6 py-4">
                            {{ $date(element.created_at) }}
                        </td>

                        <td class="px-6 py-4">
                            {{ element.codigo_catastro }}
                        </td>

                        <td class="px-6 py-4">
                            {{ element.total }}
                        </td>

                        <td class="px-6 py-4">
                            {{ element.orden }}
                        </td>

                        <td class="px-6 py-4">
                            {{ $date(element.pague_hasta) }}
                        </td>

                        <td class="px-6 py-4">
                            <StateIndicator :state="element.factura_pagada" enabled="Factura pagada" disabled="Factura sin pagar" />
                        </td>

                        <td class="px-6 py-4">
                            <StateIndicator :state="element.state" disabled="Anulado" @click="softDeleteOne(element.id)" :class="{ 'cursor-pointer': element.state }" />
                        </td>

                        <td class="px-6 py-4">
                            <a :href="route('factura_predials.show', { factura_predial: element.id })" target="_blank" @click.prevent="openPdf" class="text-white bg-gradient-to-r from-red-400 via-red-500 to-red-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">
                                Ver PDF
                            </a>
                        </td>
                    </template>
                </Table>
            </section>
        </main>
    </Layout>
</template>
