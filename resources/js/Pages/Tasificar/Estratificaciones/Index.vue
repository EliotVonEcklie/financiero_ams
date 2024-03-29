<script setup>
import Layout from '~Layouts/Tasificar.vue'
import Table from '~Components/Table.vue'
import StateIndicator from '~Components/StateIndicator.vue'
import { router } from '@inertiajs/vue3'
import axios from 'axios'

defineProps({ estratificaciones: Array })

function softDelete(selectedElements) {
    selectedElements.forEach(async x =>
        await axios.put(route('estratificacions.update', x.id), { 'toggle': true })
    )

    router.reload()
}

function formatTarifa($numbers, tarifa) {
    if (tarifa.type == "\\App\\Models\\RangoAvaluo") {
        let desde = $numbers.currency(tarifa.desde, tarifa.unidad_monetaria)
        let hasta = tarifa.hasta === -1 ? 'En adelante' : $numbers.currency(tarifa.hasta, tarifa.unidad_monetaria)

        return `Rango ${tarifa.id} : ${desde} ~ ${hasta}`
    } else if (tarifa.type == "\\App\\Models\\PredioEstrato") {
        return 'Estrato ' + tarifa.estrato
    } else {
        return 'Tarifa Desconocida'
    }
}
</script>

<template>
    <Layout title="Estratificaciones">
        <Table
            empty-message="No hay estratificaciones registradas."
            :headers="['Id', 'Vigencia', 'Tipo Predio', 'Destino Económico', 'Tarifa', 'Tasa', 'Estado']"
            :elements="estratificaciones"
            allow-create allow-edit allow-soft-delete
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
                    {{ formatTarifa($numbers, element.tarifa) }}
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
