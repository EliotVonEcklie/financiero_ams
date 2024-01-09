<script setup>
import Layout from '~Layouts/Tasificar.vue'
import Table from '~Components/Table.vue'
import StateIndicator from '~Components/StateIndicator.vue'
import { router } from '@inertiajs/vue3'
import axios from 'axios'

const props = defineProps({ estratificaciones: Array })

function softDelete(allSelected) {
    props.estratificaciones.forEach(async x => {
        if (allSelected || x.selected) {
            await axios.put(route('estratificacions.update', x.id), { 'toggle': true })
        }
    })

    router.reload()
}
</script>

<template>
    <Layout title="Estratificaciones">
        <Table
            empty-message="No hay estratificaciones registradas."
            :headers="['Id', 'Vigencia', 'Tipo Predio', 'Destino Económico', 'Tarifa', 'Tasa', 'Estado']"
            :elements="estratificaciones"
            :allow-create="true" :allow-edit="true" :allow-soft-delete="true" :allow-delete="false"
            @create="router.get(route('estratificacions.create'))"
            @edit="x => router.get(route('estratificacions.edit', x))"
            @soft-delete="softDelete"
        >
            <template #id="{ element }">{{ element.id }}</template>

            <template #row="{ element }">
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    {{ element.vigencia }}
                </th>

                <td class="px-6 py-4">
                    {{ element.predioTipo.nombre }}
                </td>

                <td class="px-6 py-4">
                    {{ element.destinoEconomico.nombre }}
                </td>

                <td class="px-6 py-4">
                    {{ element.tarifa }}
                </td>

                <td class="px-6 py-4">
                    {{ element.tasa }}
                </td>

                <td class="px-6 py-4">
                    <StateIndicator :state="element.state" />
                </td>
            </template>
        </Table>
    </Layout>
</template>
