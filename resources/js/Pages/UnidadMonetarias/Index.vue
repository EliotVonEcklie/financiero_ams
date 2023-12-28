<script setup>
import Table from '../Table.vue'
import Layout from '../Layout.vue'
import StateIndicator from '../StateIndicator.vue'
import { router } from '@inertiajs/vue3'
import axios from 'axios'

const props = defineProps({ unidadMonetarias: Array })

function softDelete(allSelected) {
    props.unidadMonetarias.forEach(async x => {
        if (allSelected || x.selected) {
            await axios.put(route('unidad_monetarias.update', x.id), { 'toggle': true })
        }
    })

    router.reload()
}
</script>

<template>
    <Layout title="Unidades Monetarias">
        <Table
            empty-message="No hay unidades registradas."
            :headers="['Id', 'Tipo', 'Estado']"
            :elements="unidadMonetarias"
            :allow-create="true" :allow-edit="true" :allow-soft-delete="true" :allow-delete="false"
            @create="router.get(route('unidad_monetarias.create'))"
            @edit="x => router.get(route('unidad_monetarias.edit', x))"
            @soft-delete="softDelete"
        >
            <template #id="{ element }">{{ element.id }}</template>

            <template #row="{ element }">
                <td class="px-6 py-4">
                    {{ element.tipo }}
                </td>

                <td class="px-6 py-4">
                    <StateIndicator :state="element.state" />
                </td>
            </template>
        </Table>
    </Layout>
</template>
