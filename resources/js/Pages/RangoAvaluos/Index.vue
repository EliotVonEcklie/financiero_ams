<script setup>
import Table from '../Table.vue'
import Layout from '../Layout.vue'
import { router } from '@inertiajs/vue3'

defineProps(['rangoAvaluos'])
</script>

<template>
    <Layout title="Rangos Avalúos">
        <Table
            empty-message="No hay rangos registrados."
            :headers="['Id', 'Valor Inicial', 'Valor Final', 'Estado']"
            :elements="destinoEconomicos"
            :allow-create="true" :allow-edit="true" :allow-soft-delete="true" :allow-delete="false"
            @create="router.get($route('rango_avaluos.create'))"
        >
            <template #id="{ element }">{{ element.id }}</template>

            <template #row="{ element }">
                <td class="px-6 py-4">
                    {{ element.desde }}
                </td>
                <td class="px-6 py-4">
                    {{ element.hasta }}
                </td>
            </template>
        </Table>
    </Layout>
</template>
