<script setup>
import Layout from '~Pages/Layout.vue'
import Table from '~Pages/Table.vue'
import StateIndicator from '~Pages/StateIndicator.vue'
import { router } from '@inertiajs/vue3'
import axios from 'axios'

const props = defineProps({ predioTipos: Array })

function softDelete(allSelected) {
    props.predioTipos.forEach(async x => {
        if (allSelected || x.selected) {
            await axios.put(route('predio_tipos.update', x.id), { 'toggle': true })
        }
    })

    router.reload()
}
</script>

<template>
    <Layout title="Tipos Predios">
        <Table
            empty-message="No hay tipos registrados."
            :headers="['Id', 'Nombre', 'Código', 'Estado']"
            :elements="predioTipos"
            :allow-create="true" :allow-edit="true" :allow-soft-delete="true" :allow-delete="false"
            @create="router.get(route('predio_tipos.create'))"
            @edit="x => router.get(route('predio_tipos.edit', x))"
            @soft-delete="softDelete"
        >
            <template #id="{ element }">{{ element.id }}</template>

            <template #row="{ element }">
                <td class="px-6 py-4">
                    {{ element.nombre }}
                </td>

                <td class="px-6 py-4">
                    {{ element.codigo }}
                </td>

                <td class="px-6 py-4">
                    <StateIndicator :state="element.state" />
                </td>
            </template>
        </Table>
    </Layout>
</template>
