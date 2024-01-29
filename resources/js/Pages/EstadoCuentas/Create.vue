<script setup>
import Layout from '~Layouts/Private.vue'
import { computed, ref, watch } from 'vue'
import axios from 'axios'

const props = defineProps({ predio: Object })

const title = 'Consultar Estado de Cuenta: Predio ' + props.predio.codigo_catastro

const estatutoFlags = computed(() => {
    return {
        descuento: props.predio.liquidacion.vigencias.some(v => v.predial_descuento > 0),
        bomberil: props.predio.liquidacion.vigencias.some(v => v.estatuto.bomberil),
        descuento_bomberil: props.predio.liquidacion.vigencias.some(v => v.bomberil_descuento_intereses > 0),
        ambiental: props.predio.liquidacion.vigencias.some(v => v.estatuto.ambiental),
        descuento_ambiental: props.predio.liquidacion.vigencias.some(v => v.ambiental_descuento_intereses > 0),
        alumbrado: props.predio.liquidacion.vigencias.some(v => v.estatuto.alumbrado)
    }
})

const allSelected = ref(false)
watch(allSelected, allSelected => {
    props.predio.liquidacion.vigencias.forEach(v => v.selected = allSelected)
})

const selectedVigencias = computed(() => {
    return props.predio.liquidacion.vigencias.filter(v => v.selected)
})
watch(selectedVigencias, selectedVigencias => {
    allSelected.value = selectedVigencias.length === props.predio.liquidacion.vigencias.length
})

const pdfUrl = ref(null)

function create() {
    props.predio.totales = {
        bomberil: props.predio.liquidacion.vigencias.reduce((a, v) => a + v.bomberil, 0),
        alumbrado: props.predio.liquidacion.vigencias.reduce((a, v) => a + v.alumbrado, 0),
        ambiental: props.predio.liquidacion.vigencias.reduce((a, v) => a + v.ambiental, 0),
        intereses: props.predio.liquidacion.vigencias.reduce((a, v) => a + v.total_intereses, 0),
        descuentos: props.predio.liquidacion.vigencias.reduce((a, v) => a + v.descuento_intereses, 0),
        liquidacion: props.predio.liquidacion.vigencias.reduce((a, v) => a + v.total_liquidacion, 0),
        predial: props.predio.liquidacion.vigencias.reduce((a, v) => a + v.predial, 0),
        total_avaluo: props.predio.liquidacion.vigencias.reduce((a, v) => a + v.valor_avaluo, 0)
    }

    props.predio.private = true

    axios.post(route('estado_cuentas.store', props.predio.id), { data: props.predio })
    .then(res => pdfUrl.value = route('estado_cuentas.show', res.data.id))
}
</script>

<template>
    <Layout :title="title">
        <main class="p-4 pt-20 text-gray-900 dark:text-white">
            <h1 class="text-3xl text-left">{{ title }}</h1>

            <section class="border-t-2 mt-2 pt-6">
                <h2 class="text-2xl text-left mb-5">Información del predio</h2>

                <div class="relative overflow-x-auto mb-5">
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <tbody>
                            <tr class="bg-white dark:bg-gray-800 border-b-2 border-b-gray-200 dark:border-b-gray-500">
                                <th scope="row" class="text-xs text-gray-700 uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-400 px-6 py-3">
                                    Nombre Propietario
                                </th>
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ predio.nombre_propietario }}
                                </th>
                                <td class="px-6 py-4"></td>
                                <td class="px-6 py-4"></td>
                                <th scope="row" class="text-xs text-gray-700 uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-400 px-6 py-3">
                                    Documento Propietario
                                </th>
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ predio.documento }}
                                </th>
                            </tr>
                            <tr class="bg-white dark:bg-gray-800">
                                <th scope="row" class="text-xs text-gray-700 uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-400 px-6 py-3">
                                    Código Catastral
                                </th>
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ predio.codigo_catastro }}
                                </th>
                                <th scope="row" class="text-xs text-gray-700 uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-400 px-6 py-3">
                                    Total
                                </th>
                                <td class="px-6 py-4">
                                    {{ predio.total }}
                                </td>
                                <th scope="row" class="text-xs text-gray-700 uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-400 px-6 py-3">
                                    Orden
                                </th>
                                <td class="px-6 py-4">
                                    {{ predio.orden }}
                                </td>
                            </tr>
                            <tr class="bg-white dark:bg-gray-800">
                                <th scope="row" class="text-xs text-gray-700 uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-400 px-6 py-3">
                                    Área del terreno
                                </th>
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    <span v-if="predio.hectareas > 0">{{ predio.hectareas }} Ha y </span>{{ predio.metros_cuadrados }} m<sup>2</sup>
                                </th>
                                <th scope="row" class="text-xs text-gray-700 uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-400 px-6 py-3">
                                    Área Construida
                                </th>
                                <td class="px-6 py-4">
                                    {{ predio.area_construida }} m<sup>2</sup>
                                </td>
                                <th scope="row" class="text-xs text-gray-700 uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-400 px-6 py-3">
                                    Dirección
                                </th>
                                <td class="px-6 py-4">
                                    {{ predio.direccion }}
                                </td>
                            </tr>
                            <tr class="bg-white dark:bg-gray-800">
                                <th scope="row" class="text-xs text-gray-700 uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-400 px-6 py-3">
                                    Avalúo Vigente
                                </th>
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $numbers.cop(predio.valor_avaluo) }}
                                </th>
                                <th scope="row" class="text-xs text-gray-700 uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-400 px-6 py-3">
                                    Tipo de predio
                                </th>
                                <td class="px-6 py-4">
                                    {{ predio.predio_tipo }} (Código: {{ predio.predio_tipo_codigo }})
                                </td>
                                <th scope="row" class="text-xs text-gray-700 uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-400 px-6 py-3">
                                    Destino Económico
                                </th>
                                <td class="px-6 py-4">
                                    {{ predio.destino_economico }} (Código: {{ predio.codigo_destino_economico }})
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </section>

            <section class="border-t-2 mt-2 pt-6">
                <div class="flex flex-row justify-between">
                    <h2 class="text-2xl text-left mb-5">Selección de vigencias</h2>

                    <a v-if="pdfUrl" :href="pdfUrl" target="_blank" class="text-white bg-gradient-to-r from-red-400 via-red-500 to-red-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-5">Ver PDF</a>
                    <button v-else @click="create" type="button" class="text-white bg-gradient-to-r from-green-400 via-green-500 to-green-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-green-300 dark:focus:ring-green-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-5">Generar estado de cuenta</button>
                </div>

                <div class="relative overflow-x-auto mb-5">
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="p-4 rounded-s-lg">
                                    <div class="flex items-center">
                                        <input id="checkbox-all-search" type="checkbox" v-model="allSelected" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                        <label for="checkbox-all-search" class="sr-only">checkbox</label>
                                    </div>
                                </th>

                                <th scope="col" class="px-6 py-3">
                                    Vigencia
                                </th>

                                <th scope="col" class="px-6 py-3">
                                    Avalúo
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Tasa
                                </th>

                                <th v-if="estatutoFlags.descuento" scope="col" class="px-6 py-3">
                                    Descuento Incentivo
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Recaudo Predial
                                </th>

                                <th v-if="estatutoFlags.bomberil" scope="col" class="px-6 py-3 border-l-2 border-l-gray-200 dark:border-l-gray-500">
                                    Bomberil
                                </th>
                                <th v-if="estatutoFlags.bomberil" scope="col" class="px-6 py-3">
                                    Intereses
                                </th>
                                <th v-if="estatutoFlags.bomberil && estatutoFlags.descuento_bomberil" scope="col" class="px-6 py-3">
                                    Descuento
                                </th>

                                <th v-if="estatutoFlags.ambiental" scope="col" class="px-6 py-3 border-l-2 border-l-gray-200 dark:border-l-gray-500">
                                    Ambiental
                                </th>
                                <th v-if="estatutoFlags.ambiental" scope="col" class="px-6 py-3">
                                    Intereses
                                </th>
                                <th v-if="estatutoFlags.ambiental && estatutoFlags.descuento_ambiental" scope="col" class="px-6 py-3">
                                    Descuento
                                </th>

                                <th v-if="estatutoFlags.alumbrado" scope="col" class="px-6 py-3 border-l-2 border-l-gray-200 dark:border-l-gray-500">
                                    Alumbrado
                                </th>

                                <th scope="col" class="px-6 py-3 border-l-2 border-l-gray-200 dark:border-l-gray-500">
                                    Liquidación
                                </th>
                                <th scope="col" class="px-6 py-3 rounded-e-lg">
                                    Días de mora
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="vigencia in predio.liquidacion.vigencias" class="bg-white dark:bg-gray-800">
                                <td class="w-4 p-4">
                                    <div class="flex items-center">
                                        <input id="checkbox-table-search-1" type="checkbox" v-model="vigencia.selected" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                        <label for="checkbox-table-search-1" class="sr-only">checkbox</label>
                                    </div>
                                </td>

                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ vigencia.vigencia }}
                                </th>

                                <td class="px-6 py-4">
                                    {{ $numbers.cop(vigencia.valor_avaluo) }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ vigencia.tasa_por_mil }} x mil
                                </td>

                                <td v-if="estatutoFlags.descuento" class="px-6 py-4">
                                    {{ vigencia.predial_descuento > 0 ? $numbers.cop(vigencia.predial_descuento) : 'N/A' }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $numbers.cop(vigencia.predial) }}
                                </td>

                                <td v-if="estatutoFlags.bomberil" class="px-6 py-4 border-l-2 border-l-gray-200 dark:border-l-gray-500">
                                    {{ vigencia.estatuto.bomberil ? $numbers.cop(vigencia.bomberil) : 'N/A' }}
                                </td>
                                <td v-if="estatutoFlags.bomberil" class="px-6 py-4">
                                    {{ vigencia.estatuto.bomberil ? $numbers.cop(vigencia.bomberil_intereses) : 'N/A' }}
                                </td>
                                <td v-if="estatutoFlags.bomberil  && estatutoFlags.descuento_bomberil" class="px-6 py-4">
                                    {{ vigencia.estatuto.bomberil && vigencia.bomberil_descuento_intereses > 0 ? $numbers.cop(vigencia.bomberil_descuento_intereses) : 'N/A' }}
                                </td>

                                <td v-if="estatutoFlags.ambiental" class="px-6 py-4 border-l-2 border-l-gray-200 dark:border-l-gray-500">
                                    {{ vigencia.estatuto.ambiental ? $numbers.cop(vigencia.ambiental) : 'N/A' }}
                                </td>
                                <td v-if="estatutoFlags.ambiental" class="px-6 py-4">
                                    {{ vigencia.estatuto.ambiental ? $numbers.cop(vigencia.ambiental_intereses) : 'N/A' }}
                                </td>
                                <td v-if="estatutoFlags.ambiental  && estatutoFlags.descuento_ambiental" class="px-6 py-4">
                                    {{ vigencia.estatuto.ambiental && vigencia.ambiental_descuento_intereses > 0 ? $numbers.cop(vigencia.ambiental_descuento_intereses) : 'N/A' }}
                                </td>

                                <td v-if="estatutoFlags.alumbrado" class="px-6 py-4 border-l-2 border-l-gray-200 dark:border-l-gray-500">
                                    {{ vigencia.estatuto.alumbrado ? $numbers.cop(vigencia.alumbrado) : 'N/A' }}
                                </td>

                                <td class="px-6 py-4 border-l-2 border-l-gray-200 dark:border-l-gray-500">
                                    {{ $numbers.cop(vigencia.total_liquidacion) }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ vigencia.dias_mora }} días
                                </td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr class="font-semibold text-gray-900 dark:text-white">
                                <th scope="row" class="px-6 py-3 text-base">Total</th>

                                <td class="px-6 py-3"></td>
                                <td class="px-6 py-3"></td>
                                <td class="px-6 py-3"></td>

                                <td v-if="estatutoFlags.descuento" class="px-6 py-3">
                                    {{ $numbers.cop(selectedVigencias.reduce((a, v) => a + v.predial_descuento, 0)) }}
                                </td>
                                <td class="px-6 py-3">
                                    {{ $numbers.cop(selectedVigencias.reduce((a, v) => a + v.predial, 0)) }}
                                </td>

                                <td v-if="estatutoFlags.bomberil" class="px-6 py-4 border-l-2 border-l-gray-200 dark:border-l-gray-500">
                                    {{ $numbers.cop(selectedVigencias.reduce((a, v) => a + v.bomberil, 0)) }}
                                </td>
                                <td v-if="estatutoFlags.bomberil" class="px-6 py-4">
                                    {{ $numbers.cop(selectedVigencias.reduce((a, v) => a + v.bomberil_intereses, 0)) }}
                                </td>
                                <td v-if="estatutoFlags.bomberil  && estatutoFlags.descuento_bomberil" class="px-6 py-4">
                                    {{ $numbers.cop(selectedVigencias.reduce((a, v) => a + v.bomberil_descuento_intereses, 0)) }}
                                </td>

                                <td v-if="estatutoFlags.ambiental" class="px-6 py-4 border-l-2 border-l-gray-200 dark:border-l-gray-500">
                                    {{ $numbers.cop(selectedVigencias.reduce((a, v) => a + v.ambiental, 0)) }}
                                </td>
                                <td v-if="estatutoFlags.ambiental" class="px-6 py-4">
                                    {{ $numbers.cop(selectedVigencias.reduce((a, v) => a + v.ambiental_intereses, 0)) }}
                                </td>
                                <td v-if="estatutoFlags.ambiental  && estatutoFlags.descuento_ambiental" class="px-6 py-4">
                                    {{ $numbers.cop(selectedVigencias.reduce((a, v) => a + v.ambiental_descuento_intereses, 0)) }}
                                </td>

                                <td v-if="estatutoFlags.alumbrado" class="px-6 py-4 border-l-2 border-l-gray-200 dark:border-l-gray-500">
                                    {{ $numbers.cop(selectedVigencias.reduce((a, v) => a + v.alumbrado, 0)) }}
                                </td>

                                <td class="px-6 py-3 border-l-2 border-l-gray-200 dark:border-l-gray-500">
                                    {{ $numbers.cop(selectedVigencias.reduce((a, v) => a + v.total_liquidacion, 0)) }}
                                </td>
                                <td class="px-6 py-3"></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>

            </section>
        </main>
    </Layout>
</template>
