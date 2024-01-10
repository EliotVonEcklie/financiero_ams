<script setup>
import Layout from '~Layouts/Private.vue'
import Table from '~Components/Table.vue'
import StateIndicator from '~Components/StateIndicator.vue'
import { router } from '@inertiajs/vue3'
import axios from 'axios'

const title = 'Estatutos'
const props = defineProps({ estatutos: Array })

function softDelete(allSelected) {
    props.estatutos.forEach(async x => {
        if (allSelected || x.selected) {
            await axios.put(route('estatutos.update', x.id), { 'toggle': true })
        }
    })

    router.reload()
}
</script>

<template>
    <Layout :title="title">
        <main class="p-4 mt-[69px] mx-auto text-gray-900 dark:text-white">
            <h1 class="text-3xl text-left">{{ title }}</h1>

            <section class="border-t-2 mt-2 pt-6">
                <Table
                    empty-message="No hay estatutos registrados."
                    :headers="['Id', 'Nombre', 'Vigencias', 'Norma Predial', 'Bomberil', 'Ambiental', 'Alumbrado', 'Recibo de caja', 'Estado']"
                    :elements="estatutos"
                    :allow-create="true" :allow-edit="true" :allow-soft-delete="true" :allow-delete="false"
                    @create="router.get(route('estatutos.create'))"
                    @edit="x => router.get(route('estatutos.edit', x))"
                    @soft-delete="softDelete"
                >
                    <template #id="{ element }">{{ element.id }}</template>

                    <template #row="{ element }">
                        <th scope="row" class="px-6 py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ element.nombre }}
                        </th>

                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ element.vigencia_desde }} - {{ element.vigencia_hasta }}
                        </th>

                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ element.norma_predial ? 'Aplica' : 'No aplica' }} norma predial
                        </th>

                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            <ul v-if="element.bomberil">
                                <li>A base del {{ element.bomberil_predial ? 'predial' : 'avalúo' }}</li>
                                <li>{{ element.bomberil_tasa }}{{ element.bomberil_tarifa ? ' x mil' : '%' }}</li>
                            </ul>
                            <span v-else>No aplica</span>
                        </th>

                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            <ul v-if="element.ambiental">
                                <li>Sobretasa</li>
                                <li>A base del {{ element.ambiental_predial ? 'predial' : 'avalúo' }}</li>
                                <li>{{ element.ambiental_tasa }}{{ element.ambiental_tarifa ? ' x mil' : '%' }}</li>
                            </ul>
                            <span v-else>Participación</span>
                        </th>

                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            <ul v-if="element.alumbrado">
                                <li v-if="element.alumbrado_rural">Se cobra a rurales</li>
                                <li v-if="element.alumbrado_urbano">Se cobra a urbanos</li>
                                <li>A base del {{ element.alumbrado_predial ? 'predial' : 'avalúo' }}</li>
                                <li>{{ element.alumbrado_tasa }}{{ element.alumbrado_tarifa ? ' x mil' : '%' }}</li>
                            </ul>
                            <span v-else>No aplica</span>
                        </th>

                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            <span v-if="element.recibo_caja === 0">
                                No aplica recibo de caja
                            </span>
                            <span v-else>
                                $ {{ element.recibo_caja }}
                            </span>
                        </th>

                        <td class="px-6 py-4">
                            <StateIndicator :state="element.state" />
                        </td>
                    </template>
                </Table>
            </section>
        </main>
    </Layout>
</template>
