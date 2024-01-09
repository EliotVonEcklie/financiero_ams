<script setup>
import Layout from '~Layouts/Parametros.vue'
import Table from '~Components/Table.vue'
import StateIndicator from '~Components/StateIndicator.vue'
import { router } from '@inertiajs/vue3'
import axios from 'axios'

const props = defineProps({ vigenciaUnidadMonetarias: Array })

function softDelete(allSelected) {
    props.vigenciaUnidadMonetarias.forEach(async x => {
        if (allSelected || x.selected) {
            await axios.put(route('vigencia_unidad_monetarias.update', x.id), { 'toggle': true })
        }
    })

    router.reload()
}
</script>

<template>
    <Layout title="Vigencia Unidades Monetarias">
        <Table
            empty-message="No hay vigencias registradas."
            :headers="['Id', 'Vigencia', 'Unidad Monetaria', 'Valor', 'Estado']"
            :elements="vigenciaUnidadMonetarias"
            :allow-create="true" :allow-edit="true" :allow-soft-delete="true" :allow-delete="false"
            @create="router.get(route('vigencia_unidad_monetarias.create'))"
            @edit="x => router.get(route('vigencia_unidad_monetarias.edit', x))"
            @soft-delete="softDelete"
        >
            <template #id="{ element }">{{ element.id }}</template>

            <template #row="{ element }">
                <td class="px-6 py-4">
                    {{ element.vigencia }}
                </td>

                <td class="px-6 py-4">
                    {{ element.unidadMonetaria.tipo }}
                </td>

                <td class="px-6 py-4">
                    {{ '$ ' + element.valor }}
                </td>

                <td class="px-6 py-4">
                    <StateIndicator :state="element.state" />
                </td>
            </template>
        </Table>
    </Layout>
</template>
