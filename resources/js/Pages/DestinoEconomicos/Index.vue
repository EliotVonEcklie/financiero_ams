<script setup>
import Table from '../Table.vue'
import Layout from '../Layout.vue'
import { router } from '@inertiajs/vue3'

defineProps(['destinoEconomicos'])
</script>

<template>
    <Layout title="Destinos Económicos">
        <Table
            empty-message="No hay destinos económicos registrados."
            :headers="['Id', 'Nombre', 'Códigos']"
            :elements="destinoEconomicos"
            :allow-create="true" :allow-edit="true" :allow-soft-delete="true" :allow-delete="false"
            @create="router.get(route('destino_economicos.create'))"
            @edit="(x) => router.get(route('destino_economicos.edit', x))"
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
            </template>
        </Table>
    </Layout>
</template>
