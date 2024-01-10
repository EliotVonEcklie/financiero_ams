<script setup>
import Layout from '~Layouts/Parametros.vue'
import Table from '~Components/Table.vue'
import StateIndicator from '~Components/StateIndicator.vue'
import { router } from '@inertiajs/vue3'
import axios from 'axios'

const props = defineProps({ predioEstratos: Array })

function softDelete(allSelected) {
    props.predioEstratos.forEach(async x => {
        if (allSelected || x.selected) {
            await axios.put(route('predio_estratos.update', x.id), { 'toggle': true })
        }
    })

    router.reload()
}
</script>

<template>
    <Layout title="Estratos">
        <Table
            empty-message="No hay estratos registrados."
            :headers="['Id', 'Estrato', 'Estado']"
            :elements="predioEstratos"
            :allow-create="true" :allow-edit="true" :allow-soft-delete="true" :allow-delete="false"
            @create="router.get(route('predio_estratos.create'))"
            @edit="x => router.get(route('predio_estratos.edit', x))"
            @soft-delete="softDelete"
        >
            <template #id="{ element }">{{ element.id }}</template>

            <template #row="{ element }">
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    {{ element.estrato }}
                </th>

                <td class="px-6 py-4">
                    <StateIndicator :state="element.state" />
                </td>
            </template>
        </Table>
    </Layout>
</template>
