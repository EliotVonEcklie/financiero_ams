<script setup>
import Layout from '~Layouts/Private.vue'
import { ref, watch } from 'vue'
import { Link, router } from '@inertiajs/vue3'
import Table from '~Components/Table.vue'

const title = 'Consultar Predio'
defineProps({ predios: Array })
const searchQuery = ref('')

watch(searchQuery, searchQuery => {
    router.reload({ data: { searchQuery }, only: ['predios'] })
})
</script>

<template>
    <Layout :title="title">
        <main class="p-4 mt-[69px] text-gray-900 dark:text-white">
            <h1 class="text-3xl text-left">{{ title }}</h1>

            <section class="border-t-2 mt-2 pt-6">
                <Table
                    empty-message="Ingrese un término de búsqueda, se puede consultar por: Documento propietario, Nombre propietario, Dirección o cédula catastral del predio."
                    :headers="['Id', 'Cédula Catastral', 'Total', 'Orden', 'Documento Propietario', 'Nombre Propietario', 'Dirección', 'Tipo de predio', 'Acción']"
                    :elements="predios"
                    v-model:searchQuery="searchQuery"
                >
                    <template #id="{ element }">{{ element.id }}</template>

                    <template #row="{ element }">
                        <td class="px-6 py-4">
                            {{ element.codigo_catastro }}
                        </td>

                        <td class="px-6 py-4">
                            {{ element.total }}
                        </td>

                        <td class="px-6 py-4">
                            {{ element.orden }}
                        </td>

                        <td class="px-6 py-4">
                            {{ element.documento }}
                        </td>

                        <td class="px-6 py-4">
                            {{ element.nombre_propietario }}
                        </td>

                        <td class="px-6 py-4">
                            {{ element.direccion }}
                        </td>

                        <td class="px-6 py-4">
                            {{ element.predio_tipo }}
                        </td>

                        <td class="px-6 py-4">
                            <Link :href="route('estado_cuentas.create')" :data="{ predio: element.id }" class="text-white bg-green-700 hover:bg-green-800 focus:outline-none focus:ring-4 focus:ring-green-300 font-medium rounded-full text-sm px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                                Consultar
                            </Link>
                        </td>
                    </template>
                </Table>
            </section>
        </main>
    </Layout>
</template>
