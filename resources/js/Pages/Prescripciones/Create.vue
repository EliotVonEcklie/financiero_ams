<script setup>
import Layout from '~Layouts/Private.vue'
import { computed, ref, watch } from 'vue'
import { Link } from '@inertiajs/vue3'
import { FwbButton, FwbModal } from 'flowbite-vue'
import axios from 'axios'
import { router } from '@inertiajs/vue3'

const props = defineProps({ predio: Object, propietarios: Object })

console.log(props);

const title = 'Consultar Prescripción: Predio ' + props.predio.codigo_catastro + ' - ID ' + props.predio.id

const estatutoFlags = computed(() => {
    return {
        descuento: props.predio.liquidacion.vigencias.some(v => v.predial_descuento > 0),
        predial_intereses: props.predio.liquidacion.vigencias.some(v => v.predial_intereses > 0),
        bomberil: props.predio.liquidacion.vigencias.some(v => v.estatuto.bomberil),
        descuento_bomberil: props.predio.liquidacion.vigencias.some(v => v.bomberil_descuento_intereses > 0),
        ambiental: props.predio.liquidacion.vigencias.some(v => v.estatuto.ambiental),
        descuento_ambiental: props.predio.liquidacion.vigencias.some(v => v.ambiental_descuento_intereses > 0),
        alumbrado: props.predio.liquidacion.vigencias.some(v => v.estatuto.alumbrado)
    }
})

const allSelected = ref(false)
function allSelectedUpdate() {
    allSelected.value = !allSelected.value

    if (!allSelected.value) {
        props.predio.liquidacion.vigencias.forEach(v => v.selected = false)
    }
}
watch(allSelected, allSelected => {
    if (allSelected) {
        props.predio.liquidacion.vigencias.forEach(v => v.selected = true)
    }
})

const selectedVigencias = computed(() => {
    return props.predio.liquidacion.vigencias.filter(v => v.selected)
})
watch(selectedVigencias, selectedVigencias => {
    allSelected.value = selectedVigencias.length === props.predio.liquidacion.vigencias.length
})

//generar la fecha actual

const today = new Date();
const dd = String(today.getDate()).padStart(2, '0');
const mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
const yyyy = today.getFullYear();
const todayDate = yyyy + '-' + mm + '-' + dd;

/* console.log(Date.now('YYYY-MM-DD')); */
const fecha = ref(todayDate)
const resolucion = ref('')
const pdfUrl = ref(null)
const errorText = ref('')
const isShowModal = ref(false)

function closeModal() {
    isShowModal.value = false
}

//crear una funcion que redireccione a prescripciones.store por medio de axios

function create(){
    props.predio.dataPres = {
        propietarios: propietarios,
        fecha: fecha.value,
        resolucion: resolucion.value
    };

    props.predio.totales = {
        bomberil: selectedVigencias.value.reduce((a, v) => a + v.bomberil, 0),
        alumbrado: selectedVigencias.value.reduce((a, v) => a + v.alumbrado, 0),
        ambiental: selectedVigencias.value.reduce((a, v) => a + v.ambiental, 0),
        intereses: selectedVigencias.value.reduce((a, v) => a + v.total_intereses, 0),
        descuentos: selectedVigencias.value.reduce((a, v) => a + v.descuento_intereses, 0),
        liquidacion: selectedVigencias.value.reduce((a, v) => a + v.total_liquidacion, 0),
        predial: selectedVigencias.value.reduce((a, v) => a + v.predial, 0)
    }

    props.predio.prescrito_desde = Math.min(...selectedVigencias.value.map(v => v.vigencia))
    props.predio.prescrito_hasta = Math.max(...selectedVigencias.value.map(v => v.vigencia))
    props.predio.private = true

    let { prescripciones: _,  ...clean_predio } = props.predio;

    axios.post(route('prescripciones.store'), { data: clean_predio })
    .then(res => console.log(res))
}

function openPdf(evt) {
    if (!evt.ctrlKey) {
        evt.target.dispatchEvent(new MouseEvent('click', { ctrlKey: true }))
    }
}
</script>

<template>
    <Layout :title="title">
        <main class="p-4 pt-20 text-gray-900 dark:text-white">
            <h1 class="text-3xl text-left">{{ title }}</h1>

            <section class="border-t-2 mt-2 pt-6">
                <FwbModal v-if="isShowModal" persistent>
                    <template #header>
                        <div class="flex items-center text-lg">
                            Error!
                        </div>
                    </template>
                    <template #body>
                        <div class="p-4 md:p-5 text-center">
                            <svg class="mx-auto mb-4 w-12 h-12 text-red-600" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                            </svg>

                            <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">{{ errorText }}</h3>

                            <FwbButton @click="closeModal" color="blue">
                                Vale
                            </FwbButton>
                        </div>
                    </template>
                </FwbModal>

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
                                <th scope="row" class="text-xs text-gray-700 uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-400 px-6 py-3">
                                    Documento Propietario
                                </th>
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ predio.documento }}
                                </th>
                                <th scope="row" class="text-xs text-gray-700 uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-400 px-6 py-3">
                                    Descuento Incentivo<br>Vigente
                                </th>
                                <td class="px-6 py-4">
                                    {{ predio.descuento_vigente >= 0
                                        ? predio.descuento_vigente + '%'
                                        : 'MORA'
                                    }}
                                </td>
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

                    <div v-if="pdfUrl" class="flex flex-row items-center">
                        <button @click="pdfUrl = ''" type="button" class="text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-5">Generar otro</button>

                        <a :href="pdfUrl" target="_blank" @click.prevent="openPdf" class="flex flex-row items-center justify-center text-white bg-gradient-to-r from-red-400 via-red-500 to-red-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-5">
                            Ver PDF
                            <svg class="w-5 h-5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                <path fill-rule="evenodd" d="M9 2.2V7H4.2l.4-.5 3.9-4 .5-.3Zm2-.2v5a2 2 0 0 1-2 2H4a2 2 0 0 0-2 2v7c0 1.1.9 2 2 2 0 1.1.9 2 2 2h12a2 2 0 0 0 2-2 2 2 0 0 0 2-2v-7a2 2 0 0 0-2-2V4a2 2 0 0 0-2-2h-7Zm-6 9a1 1 0 0 0-1 1v5a1 1 0 1 0 2 0v-1h.5a2.5 2.5 0 0 0 0-5H5Zm1.5 3H6v-1h.5a.5.5 0 0 1 0 1Zm4.5-3a1 1 0 0 0-1 1v5c0 .6.4 1 1 1h1.4a2.6 2.6 0 0 0 2.6-2.6v-1.8a2.6 2.6 0 0 0-2.6-2.6H11Zm1 5v-3h.4a.6.6 0 0 1 .6.6v1.8a.6.6 0 0 1-.6.6H12Zm5-5a1 1 0 0 0-1 1v5a1 1 0 1 0 2 0v-1h1a1 1 0 1 0 0-2h-1v-1h1a1 1 0 1 0 0-2h-2Z" clip-rule="evenodd"/>
                            </svg>
                        </a>
                    </div>
                    <div v-else>
                        <div class="flex flex-row gap-4 mb-5 border-2 rounded-md p-2">
                            <label for="text-input" class="my-auto block text-md font-medium text-gray-900 dark:text-white">Resolución:</label>
                            <input v-model="resolucion" type="text" id="text-input" class="w-64 h-10 me-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>

                            <label class="my-auto block text-md font-medium text-gray-900 dark:text-white">Fecha: </label>
                            <input
                                v-model="fecha"
                                type="date"
                                class="w-40 h-10 me-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                timezone="UTC-5"
                                format="yyyy-MM-dd"
                                required
                            >

                            <button @click="create" type="button" class="text-white bg-gradient-to-r from-green-400 via-green-500 to-green-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-green-300 dark:focus:ring-green-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Generar prescripción</button>
                        </div>
                    </div>
                </div>

                <div class="relative overflow-x-auto mb-5">
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="p-4 rounded-s-lg">
                                    <div class="flex items-center">
                                        <input id="checkbox-all-search" type="checkbox" :checked="allSelected" @input="allSelectedUpdate" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                        <label for="checkbox-all-search" class="sr-only">checkbox</label>
                                    </div>
                                </th>

                                <th scope="col" class="px-3 py-3">
                                    Vigencia
                                </th>

                                <th class="px-6 py-3">
                                    Avalúo
                                </th>
                                <th class="px-6 py-3">
                                    Tasa
                                </th>

                                <th class="px-6 py-3">
                                    Valor<br>Predial
                                </th>
                                <th v-if="estatutoFlags.descuento" class="px-6 py-3">
                                    Descuento<br>Incentivo
                                </th>
                                <th class="px-6 py-3">
                                    Recaudo<br>Predial
                                </th>
                                <th v-if="estatutoFlags.predial_intereses" class="px-6 py-3">
                                    Intereses<br>Predial
                                </th>

                                <th v-if="estatutoFlags.bomberil" class="px-6 py-3 border-l-2 border-l-gray-200 dark:border-l-gray-500">
                                    Bomberil
                                </th>
                                <th v-if="estatutoFlags.bomberil" class="px-6 py-3">
                                    Intereses<br>Bomberil
                                </th>
                                <th v-if="estatutoFlags.bomberil && estatutoFlags.descuento_bomberil" scope="col" class="px-6 py-3">
                                    Descuento<br>Bomberil
                                </th>

                                <th v-if="estatutoFlags.ambiental" class="px-6 py-3 border-l-2 border-l-gray-200 dark:border-l-gray-500">
                                    Ambiental
                                </th>
                                <th v-if="estatutoFlags.ambiental" class="px-6 py-3">
                                    Intereses<br>Ambiental
                                </th>
                                <th v-if="estatutoFlags.ambiental && estatutoFlags.descuento_ambiental" class="px-6 py-3">
                                    Descuento<br>Ambiental
                                </th>

                                <th v-if="estatutoFlags.alumbrado" class="px-6 py-3 border-l-2 border-l-gray-200 dark:border-l-gray-500">
                                    Alumbrado
                                </th>

                                <th class="px-6 py-3 border-l-2 border-l-gray-200 dark:border-l-gray-500">
                                    Liquidación
                                </th>
                                <th class="px-6 py-3 rounded-e-lg">
                                    Días de mora
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="vigencia in predio.liquidacion.vigencias" v-bind:key="vigencia.vigencia" class="bg-white dark:bg-gray-800">
                                <td class="w-4 max-w-5 p-4">
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

                                <td class="px-6 py-4">
                                    {{ $numbers.cop(vigencia.predial + vigencia.predial_descuento) }}
                                </td>
                                <td v-if="estatutoFlags.descuento" class="px-6 py-4">
                                    {{ vigencia.predial_descuento > 0 ? $numbers.cop(vigencia.predial_descuento) : 'N/A' }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $numbers.cop(vigencia.predial) }}
                                </td>
                                <td v-if="estatutoFlags.predial_intereses" class="px-6 py-4">
                                    {{ vigencia.predial_intereses > 0 ? $numbers.cop(vigencia.predial_intereses) : 'N/A' }}
                                </td>

                                <td v-if="estatutoFlags.bomberil" class="px-6 py-4 border-l-2 border-l-gray-200 dark:border-l-gray-500">
                                    {{ vigencia.estatuto.bomberil ? $numbers.cop(vigencia.bomberil) : 'N/A' }}
                                </td>
                                <td v-if="estatutoFlags.bomberil" class="px-6 py-4">
                                    {{ vigencia.estatuto.bomberil && vigencia.bomberil_intereses > 0 ? $numbers.cop(vigencia.bomberil_intereses) : 'N/A' }}
                                </td>
                                <td v-if="estatutoFlags.bomberil && estatutoFlags.descuento_bomberil" class="px-6 py-4">
                                    {{ vigencia.estatuto.bomberil && vigencia.bomberil_descuento_intereses > 0 ? $numbers.cop(vigencia.bomberil_descuento_intereses) : 'N/A' }}
                                </td>

                                <td v-if="estatutoFlags.ambiental" class="px-6 py-4 border-l-2 border-l-gray-200 dark:border-l-gray-500">
                                    {{ vigencia.estatuto.ambiental ? $numbers.cop(vigencia.ambiental) : 'N/A' }}
                                </td>
                                <td v-if="estatutoFlags.ambiental" class="px-6 py-4">
                                    {{ vigencia.estatuto.ambiental && vigencia.ambiental_intereses > 0 ? $numbers.cop(vigencia.ambiental_intereses) : 'N/A' }}
                                </td>
                                <td v-if="estatutoFlags.ambiental && estatutoFlags.descuento_ambiental" class="px-6 py-4">
                                    {{ vigencia.estatuto.ambiental && vigencia.ambiental_descuento_intereses > 0 ? $numbers.cop(vigencia.ambiental_descuento_intereses) : 'N/A' }}
                                </td>

                                <td v-if="estatutoFlags.alumbrado" class="px-6 py-4 border-l-2 border-l-gray-200 dark:border-l-gray-500">
                                    {{ vigencia.estatuto.alumbrado ? $numbers.cop(vigencia.alumbrado) : 'N/A' }}
                                </td>

                                <td class="px-6 py-4 border-l-2 border-l-gray-200 dark:border-l-gray-500">
                                    {{ $numbers.cop(vigencia.total_liquidacion) }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ vigencia.dias_mora > 0 ? vigencia.dias_mora + ' días' : 'Sín mora'}}
                                </td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr class="font-semibold text-gray-900 dark:text-white">
                                <th scope="row" class="px-6 py-3 text-base">Total</th>

                                <td class="px-6 py-3"></td>
                                <td class="px-6 py-3"></td>
                                <td class="px-6 py-3"></td>

                                <td class="px-6 py-3">
                                    {{ $numbers.cop(props.predio.liquidacion.vigencias.reduce((a, v) => a + v.predial + v.predial_descuento, 0)) }}
                                </td>
                                <td v-if="estatutoFlags.descuento" class="px-6 py-3">
                                    {{ $numbers.cop(props.predio.liquidacion.vigencias.reduce((a, v) => a + v.predial_descuento, 0)) }}
                                </td>
                                <td class="px-6 py-3">
                                    {{ $numbers.cop(props.predio.liquidacion.vigencias.reduce((a, v) => a + v.predial, 0)) }}
                                </td>
                                <td v-if="estatutoFlags.predial_intereses" class="px-6 py-3">
                                    {{ $numbers.cop(props.predio.liquidacion.vigencias.reduce((a, v) => a + v.predial_intereses, 0)) }}
                                </td>

                                <td v-if="estatutoFlags.bomberil" class="px-6 py-4 border-l-2 border-l-gray-200 dark:border-l-gray-500">
                                    {{ $numbers.cop(props.predio.liquidacion.vigencias.reduce((a, v) => a + v.bomberil, 0)) }}
                                </td>
                                <td v-if="estatutoFlags.bomberil" class="px-6 py-4">
                                    {{ $numbers.cop(props.predio.liquidacion.vigencias.reduce((a, v) => a + v.bomberil_intereses, 0)) }}
                                </td>
                                <td v-if="estatutoFlags.bomberil  && estatutoFlags.descuento_bomberil" class="px-6 py-4">
                                    {{ $numbers.cop(props.predio.liquidacion.vigencias.reduce((a, v) => a + v.bomberil_descuento_intereses, 0)) }}
                                </td>

                                <td v-if="estatutoFlags.ambiental" class="px-6 py-4 border-l-2 border-l-gray-200 dark:border-l-gray-500">
                                    {{ $numbers.cop(props.predio.liquidacion.vigencias.reduce((a, v) => a + v.ambiental, 0)) }}
                                </td>
                                <td v-if="estatutoFlags.ambiental" class="px-6 py-4">
                                    {{ $numbers.cop(props.predio.liquidacion.vigencias.reduce((a, v) => a + v.ambiental_intereses, 0)) }}
                                </td>
                                <td v-if="estatutoFlags.ambiental  && estatutoFlags.descuento_ambiental" class="px-6 py-4">
                                    {{ $numbers.cop(props.predio.liquidacion.vigencias.reduce((a, v) => a + v.ambiental_descuento_intereses, 0)) }}
                                </td>

                                <td v-if="estatutoFlags.alumbrado" class="px-6 py-4 border-l-2 border-l-gray-200 dark:border-l-gray-500">
                                    {{ $numbers.cop(props.predio.liquidacion.vigencias.reduce((a, v) => a + v.alumbrado, 0)) }}
                                </td>

                                <td class="px-6 py-3 border-l-2 border-l-gray-200 dark:border-l-gray-500">
                                    {{ $numbers.cop(props.predio.liquidacion.vigencias.reduce((a, v) => a + v.total_liquidacion, 0)) }}
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
