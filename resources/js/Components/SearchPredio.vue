<script setup>
import { ref, watch } from 'vue'
import { Link, router } from '@inertiajs/vue3'
import Table from '~Components/Table.vue'

defineProps({ predios: Array, href: String })

const searchQuery = ref('')
watch(searchQuery, searchQuery => {
    router.reload({ data: { searchQuery }, only: ['predios'] })
})

// Make sure that the url is cleared when navigating
if (searchQuery.value !== '' && predios.length > 0) {
    router.reload()
}
</script>

<template>
    <Table
        empty-message="Ingrese un término de búsqueda, se puede consultar por: Documento, Nombre propietario, Dirección o Cédula catastral del predio."
        :headers="['Id', 'Cédula Catastral', 'Total', 'Orden', 'Documento Propietario', 'Nombre Propietario', 'Dirección', 'Tipo de predio', 'Acción']"
        :elements="predios"
        enable-search
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
                <Link :href="href" :data="{ predio: element.id }" class="text-white bg-green-700 hover:bg-green-800 focus:outline-none focus:ring-4 focus:ring-green-300 font-medium rounded-full text-sm px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                    Consultar
                </Link>
            </td>
        </template>
    </Table>
</template>
