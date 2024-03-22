<script setup>
import Layout from '~Layouts/Private.vue'
import Table from '~Components/Table.vue'

const props = defineProps({ errors: Object, facturaMasiva: Object, resolucions: Array })
const title = 'Factura Masiva Consulta #' + props.facturaMasiva.id
</script>

<template>
    <Layout :title="title">
        <main class="p-4 pt-20 mx-auto text-gray-900 dark:text-white">
            <h1 class="text-3xl text-left">{{ title }}</h1>

            <div v-if="facturaMasiva.processing">
                <div class="flex items-center justify-center h-96">
                    <svg aria-hidden="true" class="w-8 h-8 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                        <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
                    </svg>
                    <p class="ms-2 text-blue-600">Procesando...</p>
                </div>
            </div>
            <div v-else>
                <section class="border-t-2 mt-2 pt-6">
                    <h2 class="text-2xl text-left mb-5">Información de factura</h2>

                    <div class="relative overflow-x-auto mb-5">
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <tbody>
                                <tr class="bg-white dark:bg-gray-800">
                                    <th scope="row" class="text-xs text-gray-700 uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-400 px-6 py-3">
                                        Deuda superior a
                                    </th>
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ $numbers.cop(facturaMasiva.min_deuda) }}
                                    </th>
                                    <th scope="row" class="text-xs text-gray-700 uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-400 px-6 py-3">
                                        Cobrar a predios rurales?
                                    </th>
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ facturaMasiva.rurales ? 'Sí' : 'No' }}
                                    </th>
                                    <th scope="row" class="text-xs text-gray-700 uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-400 px-6 py-3">
                                        Cobrar a predios urbanos?
                                    </th>
                                    <td class="px-6 py-4">
                                        {{ facturaMasiva.urbanos ? 'Sí' : 'No' }}
                                    </td>
                                    <th scope="row" class="text-xs text-gray-700 uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-400 px-6 py-3">
                                        Última Resolución
                                    </th>
                                    <td class="px-6 py-4">
                                        {{ facturaMasiva.last_resolucion }}
                                    </td>
                                    <th scope="row" class="text-xs text-gray-700 uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-400 px-6 py-3">
                                        Vigencias
                                    </th>
                                    <td class="px-6 py-4">
                                        {{ facturaMasiva.vigencias ?? 'Todas' }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </section>

                <section class="border-t-2 mt-2 pt-6">
                    <div class="flex flex-row justify-between">
                        <h2 class="text-2xl text-left mb-5">Resoluciones generadas</h2>

                        <a :href="route('factura_masivas.show_pdf', { facturaMasiva: facturaMasiva.id })" target="_blank" class="flex flex-row items-center justify-center text-white bg-gradient-to-r from-red-400 via-red-500 to-red-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-5">
                            Ver PDF
                            <svg class="w-5 h-5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                <path fill-rule="evenodd" d="M9 2.2V7H4.2l.4-.5 3.9-4 .5-.3Zm2-.2v5a2 2 0 0 1-2 2H4a2 2 0 0 0-2 2v7c0 1.1.9 2 2 2 0 1.1.9 2 2 2h12a2 2 0 0 0 2-2 2 2 0 0 0 2-2v-7a2 2 0 0 0-2-2V4a2 2 0 0 0-2-2h-7Zm-6 9a1 1 0 0 0-1 1v5a1 1 0 1 0 2 0v-1h.5a2.5 2.5 0 0 0 0-5H5Zm1.5 3H6v-1h.5a.5.5 0 0 1 0 1Zm4.5-3a1 1 0 0 0-1 1v5c0 .6.4 1 1 1h1.4a2.6 2.6 0 0 0 2.6-2.6v-1.8a2.6 2.6 0 0 0-2.6-2.6H11Zm1 5v-3h.4a.6.6 0 0 1 .6.6v1.8a.6.6 0 0 1-.6.6H12Zm5-5a1 1 0 0 0-1 1v5a1 1 0 1 0 2 0v-1h1a1 1 0 1 0 0-2h-1v-1h1a1 1 0 1 0 0-2h-2Z" clip-rule="evenodd"/>
                            </svg>
                        </a>
                    </div>

                    <div v-if="errors.pdf" class="flex items-center p-4 mb-5 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
                        <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                        </svg>
                        <span class="sr-only">Error</span>
                        <div>
                            {{ errors.pdf }}
                        </div>
                    </div>

                    <div class="relative overflow-x-auto mb-5">
                        <Table
                            empty-message="No hay resoluciones generadas."
                            :headers="['Id', 'Código Catastro', 'Documento', 'Nombre Propietario', 'Dirección', 'Acción']"
                            :elements="resolucions"
                        >
                            <template #id="{ element }">{{ element.id }}</template>

                            <template #row="{ element }">
                                <td class="px-3 py-4">
                                    {{ element.codigo_catastro }}
                                </td>

                                <td class="px-3 py-4">
                                    {{ element.documento }}
                                </td>

                                <td class="px-2 py-4">
                                    {{ element.nombre_propietario }}
                                </td>

                                <td class="px-6 py-4">
                                    {{ element.direccion }}
                                </td>

                                <td class="px-3 py-4 flex items-center justify-center">
                                    <a :href="route('factura_masivas.show_one_pdf', { facturaMasiva: facturaMasiva.id, resolucion: element.id })" target="_blank" class="text-white bg-gradient-to-r from-red-400 via-red-500 to-red-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg px-2.5 py-2.5 text-center">
                                        <svg class="w-8 h-8 pointer-events-none" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                            <path fill-rule="evenodd" d="M9 2.2V7H4.2l.4-.5 3.9-4 .5-.3Zm2-.2v5a2 2 0 0 1-2 2H4a2 2 0 0 0-2 2v7c0 1.1.9 2 2 2 0 1.1.9 2 2 2h12a2 2 0 0 0 2-2 2 2 0 0 0 2-2v-7a2 2 0 0 0-2-2V4a2 2 0 0 0-2-2h-7Zm-6 9a1 1 0 0 0-1 1v5a1 1 0 1 0 2 0v-1h.5a2.5 2.5 0 0 0 0-5H5Zm1.5 3H6v-1h.5a.5.5 0 0 1 0 1Zm4.5-3a1 1 0 0 0-1 1v5c0 .6.4 1 1 1h1.4a2.6 2.6 0 0 0 2.6-2.6v-1.8a2.6 2.6 0 0 0-2.6-2.6H11Zm1 5v-3h.4a.6.6 0 0 1 .6.6v1.8a.6.6 0 0 1-.6.6H12Zm5-5a1 1 0 0 0-1 1v5a1 1 0 1 0 2 0v-1h1a1 1 0 1 0 0-2h-1v-1h1a1 1 0 1 0 0-2h-2Z" clip-rule="evenodd"/>
                                        </svg>
                                    </a>
                                </td>
                            </template>
                        </Table>
                    </div>
                </section>
            </div>
        </main>
    </Layout>
</template>
