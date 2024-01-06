<script setup>
import Table from '~Components/Table.vue'
import Layout from '~Components/Layout.vue'
import StateIndicator from '~Components/StateIndicator.vue'
import { Link, router } from '@inertiajs/vue3'
import axios from 'axios'

const props = defineProps({ rangoAvaluos: Array })

function softDelete(allSelected) {
    props.rangoAvaluos.forEach(async x => {
        if (allSelected || x.selected) {
            await axios.put(route('rango_avaluos.update', x.id), { 'toggle': true })
        }
    })

    router.reload()
}
</script>

<template>
    <Layout title="Rangos Avalúos">
        <Table
            empty-message="No hay rangos registrados."
            :headers="['Id', 'Desde', 'Hasta', 'Unidad Monetaria', 'Estado']"
            :elements="rangoAvaluos"
            :allow-create="true" :allow-edit="true" :allow-soft-delete="true" :allow-delete="false"
            @create="router.get(route('rango_avaluos.create'))"
            @edit="x => router.get(route('rango_avaluos.edit', x))"
            @soft-delete="softDelete"
        >
            <template #id="{ element }">{{ element.id }}</template>

            <template #row="{ element }">
                <td class="px-6 py-4">
                    {{ element.desde }}
                </td>

                <td class="px-6 py-4">
                    {{ element.hasta }}
                </td>

                <td class="px-6 py-4">
                    <Link :href="route('unidad_monetarias.index')">
                        {{ element.unidad_monetaria.tipo }}
                    </Link>
                </td>

                <td class="px-6 py-4">
                    <StateIndicator :state="element.state" />
                </td>
            </template>
        </Table>
    </Layout>
</template>
