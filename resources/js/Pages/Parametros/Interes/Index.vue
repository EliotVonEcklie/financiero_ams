<script setup>
import Layout from '~Layouts/Parametros.vue'
import Table from '~Components/Table.vue'
import StateIndicator from '~Components/StateIndicator.vue'
import { router } from '@inertiajs/vue3'
import axios from 'axios'

const props = defineProps({ interes: Array })

function softDelete(allSelected) {
    props.interes.forEach(async x => {
        if (allSelected || x.selected) {
            await axios.put(route('interes.update', x.id), { 'toggle': true })
        }
    })

    router.reload()
}
</script>

<template>
    <Layout title="Tasas de Interés">
        <Table
            empty-message="No hay tasas registradas."
            :headers="['Id', 'Vigencia', 'Mes', 'Porcentaje Moratorio', 'Porcentaje Corriente', 'Estado']"
            :elements="interes"
            :allow-create="true" :allow-edit="true" :allow-soft-delete="true" :allow-delete="false"
            @create="router.get(route('interes.create'))"
            @edit="x => router.get(route('interes.edit', x))"
            @soft-delete="softDelete"
        >
            <template #id="{ element }">{{ element.id }}</template>

            <template #row="{ element }">
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    {{ element.vigencia }}
                </th>

                <td class="px-6 py-4">
                    {{ element.mes }} - {{ $month(element.mes) }}
                </td>

                <td class="px-6 py-4">
                    {{ element.moratorio + '%' }}
                </td>

                <td class="px-6 py-4">
                    {{ (element.corriente ?? 0) + '%' }}
                </td>

                <td class="px-6 py-4">
                    <StateIndicator :state="element.state" />
                </td>
            </template>
        </Table>
    </Layout>
</template>
