<script setup>
import Table from '../Table.vue'
import Layout from '../Layout.vue'
import { router } from '@inertiajs/vue3'

defineProps(['destinoEconomicos'])
</script>

<template>
    <Layout>
        <template #title>Destinos Económicos</template>

        <Table
            empty-message="No hay destinos económicos registrados."
            :headers="['Nombre', 'Códigos']"
            :elements="destinoEconomicos"
            :allow-create="true" :allow-edit="true" :allow-soft-delete="true" :allow-delete="false"
            @create="router.get($route('destino_economicos.create'))"
        >
            <template #id="{ element }">{{ element.nombre }}</template>

            <template #row="{ element }">
                <td class="px-6 py-4">
                    <div v-if="element.codigo_destino_economicos.length > 0">
                        <span v-for="codigoDestinoEconomico in element.codigo_destino_economicos">{{ codigoDestinoEconomico.codigo }}</span>
                    </div>

                    <div v-else>
                        <p class="italic text-center">No hay códigos registrados para este destino económico.</p>
                    </div>
                </td>
            </template>
        </Table>
    </Layout>
</template>
