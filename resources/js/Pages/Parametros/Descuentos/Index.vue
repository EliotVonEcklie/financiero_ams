<script setup>
import Layout from '~Layouts/Parametros.vue'
import Table from '~Components/Table.vue'
import StateIndicator from '~Components/StateIndicator.vue'
import { router } from '@inertiajs/vue3'
import axios from 'axios'

const props = defineProps({ descuentos: Array })

function softDelete(allSelected) {
    props.descuentos.forEach(async x => {
        if (allSelected || x.selected) {
            await axios.put(route('descuentos.update', x.id), { 'toggle': true })
        }
    })

    router.reload()
}
</script>

<template>
    <Layout title="Descuentos Incentivos">
        <Table
            empty-message="No hay descuentos registrados."
            :headers="['Id', 'Es Nacional', 'Hasta', 'Porcentaje', 'Estado']"
            :elements="descuentos"
            :allow-create="true" :allow-edit="true" :allow-soft-delete="true" :allow-delete="false"
            @create="router.get(route('descuentos.create'))"
            @edit="x => router.get(route('descuentos.edit', x))"
            @soft-delete="softDelete"
        >
            <template #id="{ element }">{{ element.id }}</template>

            <template #row="{ element }">
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    {{ element.es_nacional ? 'Si' : 'No' }}
                </th>

                <td class="px-6 py-4">
                    {{ element.hasta }}
                    <span v-if="!element.es_nacional">
                        {{ ' - ' + $month(element.hasta) }}
                    </span>
                </td>

                <td class="px-6 py-4">
                    {{ element.porcentaje + '%' }}
                </td>

                <td class="px-6 py-4">
                    <StateIndicator :state="element.state" />
                </td>
            </template>
        </Table>
    </Layout>
</template>
