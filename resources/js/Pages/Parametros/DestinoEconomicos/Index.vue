<script setup>
import Layout from '~Layouts/Parametros.vue'
import Table from '~Components/Table.vue'
import StateIndicator from '~Components/StateIndicator.vue'
import { router } from '@inertiajs/vue3'
import axios from 'axios'

const props = defineProps({ destinoEconomicos: Array })

function softDelete(allSelected) {
    props.destinoEconomicos.forEach(async x => {
        if (allSelected || x.selected) {
            console.log(route('destino_economicos.update', x.id))
            await axios.put(route('destino_economicos.update', x.id), { 'toggle': true })
        }
    })

    router.reload()
}
</script>

<template>
    <Layout title="Destinos Económicos">
        <Table
            empty-message="No hay destinos económicos registrados."
            :headers="['Id', 'Nombre', 'Códigos', 'Estado']"
            :elements="destinoEconomicos"
            :allow-create="true" :allow-edit="true" :allow-soft-delete="true" :allow-delete="false"
            @create="router.get(route('destino_economicos.create'))"
            @edit="x => router.get(route('destino_economicos.edit', x))"
            @soft-delete="softDelete"
        >
            <template #id="{ element }">{{ element.id }}</template>

            <template #row="{ element }">
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    {{ element.nombre }}
                </th>

                <td class="px-6 py-4">
                    <div v-if="element.codigo_destino_economicos.length > 0">
                        <p>{{ element.codigo_destino_economicos.map(x => x.codigo).join(', ') }}</p>
                    </div>

                    <div v-else>
                        <p class="italic text-center">No hay códigos registrados para este destino económico.</p>
                    </div>
                </td>

                <td class="px-6 py-4">
                    <StateIndicator :state="element.state" />
                </td>
            </template>
        </Table>
    </Layout>
</template>
