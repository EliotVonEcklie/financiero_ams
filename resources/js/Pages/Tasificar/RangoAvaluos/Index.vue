<script setup>
import Layout from '~Layouts/Tasificar.vue'
import Table from '~Components/Table.vue'
import StateIndicator from '~Components/StateIndicator.vue'
import { Link, router } from '@inertiajs/vue3'
import axios from 'axios'

defineProps({ rangoAvaluos: Array })

function softDelete(selectedElements) {
    selectedElements.forEach(async x =>
        await axios.put(route('rango_avaluos.update', x.id), { 'toggle': true })
    )

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
                    {{ $numbers.currency(element.desde, element.unidad_monetaria.nombre) }}
                </td>

                <td class="px-6 py-4">
                    {{ element.hasta === -1 ? 'En adelante' :
                        $numbers.currency(element.hasta, element.unidad_monetaria.nombre) }}
                </td>

                <td class="px-6 py-4">
                    <Link :href="route('unidad_monetarias.index')">
                        {{ element.unidad_monetaria.nombre }}
                    </Link>
                </td>

                <td class="px-6 py-4">
                    <StateIndicator :state="element.state" />
                </td>
            </template>
        </Table>
    </Layout>
</template>
