<script setup>
import Layout from './Layout.vue'
import { router } from '@inertiajs/vue3';
import ModalPse from './Components/ModalPse.vue';

const props = defineProps({ predios: Object, predio: Object});
//const objTotal = ref('');
function search(evt) {
    router.get(route('public.impuesto_predial_unificado'), { search: evt.target.value }, { preserveState: true })
}

function show(predio_id) {
    router.get(route('public.impuesto_predial_unificado'), { predio_id: predio_id }, { preserveState: false });
}

function getTotal(vigencias){
    let bomberil = 0;
    let alumbrado = 0;
    let ambiental = 0;
    let obj={}
    if(vigencias!=null){
        for (let i = 0; i < vigencias.length; i++) {
            bomberil +=vigencias[i].bomberil;
            alumbrado +=vigencias[i].alumbrado;
            ambiental +=vigencias[i].ambiental;
        }
        obj={
            "bomberil":bomberil,
            "alumbrado":alumbrado,
            "ambiental":ambiental
        };
    }else{
        obj={
            "bomberil":0,
            "alumbrado":0,
            "ambiental":0
        };
    }

    return obj
}

</script>

<template>
    <Layout>
            <!--Modal-->
        <div id="modalBuscar" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative w-full max-w-7xl max-h-full">
                <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    <!-- Modal header -->
                    <div class="text-center bg-bluep text-white flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                        <h3 class="text-xl  font-semibol  dark:text-white">
                            Buscar predio
                        </h3>
                        <button type="button" class="text-white rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="modalBuscar">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <div class="p-4 md:p-5 space-y-4">
                        <form @submit.prevent>
                            <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Buscar</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                    </svg>
                                </div>
                                <input type="search" @input="search" id="default-search" class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Buscar por nombre, código, documento..." required>
                            </div>
                        </form>
                        <div v-if ="predios.length > 0" class="mt-3 relative overflow-x-auto overflow-y-auto h-96 shadow-md sm:rounded-lg">
                            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                    <tr class="text-center font-semibold py-3 text-black bg-gray-100">
                                        <td colspan="8">Resultados de Búsqueda: {{ predios.length }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="col" class="px-6 py-3">
                                            ID
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Código catastral
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Orden
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Total
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Propietario
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Documento
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Dirección
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Tipo Predio
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr @click="show(predio.id);" data-modal-hide="modalBuscar" v-for="predio in predios" :key="predio.id"  class="cursor-pointer bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-bluep hover:text-white dark:hover:bg-gray-600">
                                        <td class="px-6 py-4">
                                            {{ predio.id }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ predio.codigo_catastro }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ predio.total }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ predio.orden }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ predio.nombre_propietario }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ predio.documento }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ predio.direccion }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ predio.predio_tipo }}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <ModalPse/>
        <!--Información predio-->
        <div class="mb-4 border-b border-gray-200 dark:border-gray-700">
            <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="default-tab" data-tabs-toggle="#default-tab-content" role="tablist">
                <li class="me-2" role="presentation">
                    <button class="inline-block p-4 border-b-2 rounded-t-lg" id="predial-tab" data-tabs-target="#predial" type="button" role="tab" aria-controls="predial" aria-selected="false">Liquidación Predial</button>
                </li>
                <li class="me-2" role="presentation">
                    <button class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300" id="predialInfo-tab" data-tabs-target="#predialInfo" type="button" role="tab" aria-controls="predialInfo" aria-selected="false">Información Predio</button>
                </li>
            </ul>
        </div>
        <div id="default-tab-content">
            <div class="hidden rounded-lg bg-gray-50 dark:bg-gray-800" id="predial" role="tabpanel" aria-labelledby="predial-tab">
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <tbody>
                            <tr class="text-center bg-bluep border-b border-gray-200 dark:border-gray-700">
                                <td colspan="8" class="text-white text-2xl py-2">Liquidar Predial</td>
                            </tr>
                            <tr  class="border-b border-gray-200 dark:border-gray-700">
                                <td class="px-2 py-4 text-bold text-black  bg-gray-100">
                                    No liquidación:
                                </td>
                                <td class="px-2 py-4 bg-gray-50 dark:bg-gray-800">
                                    <input type="text" name="strNroLiquidacion" id="nroLiquidacion" class="bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 cursor-not-allowed dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500" value="123" readonly>
                                </td>
                                <td class="px-2 py-4 text-bold text-black  bg-gray-100">
                                    Fecha:
                                </td>
                                <td colspan="3" class="px-2 py-4 bg-gray-50 dark:bg-gray-800">
                                    <input type="text" id="strFecha" name="strFecha" class="bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 cursor-not-allowed dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500" value="11/01/2024" readonly>
                                </td>
                                <td class="px-2 py-4 text-bold text-black  bg-gray-100">
                                    Vigencia:
                                </td>
                                <td class="px-2 py-4 bg-gray-50 dark:bg-gray-800">
                                    <input type="text" name="strVigencia" id="strVigencia" class="bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 cursor-not-allowed dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500" value="2024" readonly>
                                </td>
                            </tr>
                            <tr class="border-b border-gray-200 dark:border-gray-700">
                                <td class="px-2 py-4 text-bold text-black bg-gray-100">
                                    Proyecto liquidación:
                                </td>
                                <td class="px-2 py-4">
                                    <input type="text" id="strProLiquidacion" name="strProLiquidacion" class="bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 cursor-not-allowed dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500" value="11/01/2024" readonly>
                                </td>
                                <td class="px-2 py-4 text-bold text-black  bg-gray-100">
                                    Código catastral:
                                </td>
                                <td class="px-2 py-4">
                                    <input type="input" name="intCodCat" id="intCodCat" class="bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 cursor-not-allowed dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500" :value="predio.codigo_catastro" readonly>
                                </td>
                                <td class="px-2 py-4">
                                    <div class="relative">
                                        <div class="absolute inset-y-0 end-0 top-0 flex items-center ps-3.5 pointer-events-none">
                                            <span class="px-2 text-1xl font-bold text-black">Total</span>
                                        </div>
                                        <input type="input" name="intTot" id="intTot" class="bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" :value="predio.total" readonly>
                                    </div>
                                </td>
                                <td class="px-2 py-4">
                                    <div class="relative">
                                        <div class="absolute inset-y-0 end-0 top-0 flex items-center ps-3.5 pointer-events-none">
                                            <span class="px-2 text-1xl font-bold text-black">Orden</span>
                                        </div>
                                        <input type="input" name="intOrd" id="intOrd" class="bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" :value="predio.orden" readonly>
                                    </div>
                                </td>
                                <td class="px-2 py-4 text-bold text-black  bg-gray-100">
                                    Tasa de interés mes actual:
                                </td>
                                <td class="px-2 py-4 bg-gray-50 dark:bg-gray-800">
                                    <div class="relative">
                                        <div class="absolute inset-y-0 end-0 top-0 flex items-center pe-3.5 pointer-events-none">
                                            <svg xmlns="http://www.w3.org/2000/svg" height="16" width="12" viewBox="0 0 384 512"><path d="M374.6 118.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-320 320c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l320-320zM128 128A64 64 0 1 0 0 128a64 64 0 1 0 128 0zM384 384a64 64 0 1 0 -128 0 64 64 0 1 0 128 0z"/></svg>
                                        </div>
                                        <input type="input" name="intTasaMo" id="intTasaMo" class="bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="10" readonly>
                                    </div>
                                </td>
                            </tr>
                            <tr class="border-b border-gray-200 dark:border-gray-700">
                                <td class="px-2 py-4 text-bold text-black bg-gray-100">
                                    Avaluo vigente:
                                </td>
                                <td class="px-2 py-4">
                                    <div class="relative">
                                        <div class="absolute inset-y-0 start-0 top-0 flex items-center ps-3.5 pointer-events-none">
                                            <svg xmlns="http://www.w3.org/2000/svg" height="16" width="10" viewBox="0 0 320 512"><path d="M160 0c17.7 0 32 14.3 32 32V67.7c1.6 .2 3.1 .4 4.7 .7c.4 .1 .7 .1 1.1 .2l48 8.8c17.4 3.2 28.9 19.9 25.7 37.2s-19.9 28.9-37.2 25.7l-47.5-8.7c-31.3-4.6-58.9-1.5-78.3 6.2s-27.2 18.3-29 28.1c-2 10.7-.5 16.7 1.2 20.4c1.8 3.9 5.5 8.3 12.8 13.2c16.3 10.7 41.3 17.7 73.7 26.3l2.9 .8c28.6 7.6 63.6 16.8 89.6 33.8c14.2 9.3 27.6 21.9 35.9 39.5c8.5 17.9 10.3 37.9 6.4 59.2c-6.9 38-33.1 63.4-65.6 76.7c-13.7 5.6-28.6 9.2-44.4 11V480c0 17.7-14.3 32-32 32s-32-14.3-32-32V445.1c-.4-.1-.9-.1-1.3-.2l-.2 0 0 0c-24.4-3.8-64.5-14.3-91.5-26.3c-16.1-7.2-23.4-26.1-16.2-42.2s26.1-23.4 42.2-16.2c20.9 9.3 55.3 18.5 75.2 21.6c31.9 4.7 58.2 2 76-5.3c16.9-6.9 24.6-16.9 26.8-28.9c1.9-10.6 .4-16.7-1.3-20.4c-1.9-4-5.6-8.4-13-13.3c-16.4-10.7-41.5-17.7-74-26.3l-2.8-.7 0 0C119.4 279.3 84.4 270 58.4 253c-14.2-9.3-27.5-22-35.8-39.6c-8.4-17.9-10.1-37.9-6.1-59.2C23.7 116 52.3 91.2 84.8 78.3c13.3-5.3 27.9-8.9 43.2-11V32c0-17.7 14.3-32 32-32z"/></svg>
                                        </div>
                                        <input type="input" name="intAvaVig" id="intAvaVig" class="bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" :value="predio.valor_avaluo" readonly>
                                    </div>
                                </td>
                                <td class="px-2 py-4 text-bold text-black  bg-gray-100">
                                    Tasa predial:
                                </td>
                                <td colspan="3" class="px-2 py-4 bg-gray-50 dark:bg-gray-800">
                                    <div class="relative">
                                        <div class="absolute inset-y-0 end-0 top-0 flex items-center ps-3.5 pointer-events-none">
                                            <span class="px-2 text-1xl font-bold text-black">x Mil</span>
                                        </div>
                                        <input type="input" name="intTasaPre" id="intTasaPre" class="bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="10" readonly>
                                    </div>
                                </td>
                                <td class="px-2 py-4 text-bold text-black  bg-gray-100">
                                    Descuento:
                                </td>
                                <td class="px-2 py-4 bg-gray-50 dark:bg-gray-800">
                                    <div class="relative">
                                        <div class="absolute inset-y-0 end-0 top-0 flex items-center pe-3.5 pointer-events-none">
                                            <svg xmlns="http://www.w3.org/2000/svg" height="16" width="12" viewBox="0 0 384 512"><path d="M374.6 118.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-320 320c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l320-320zM128 128A64 64 0 1 0 0 128a64 64 0 1 0 128 0zM384 384a64 64 0 1 0 -128 0 64 64 0 1 0 128 0z"/></svg>
                                        </div>
                                        <input type="input" name="intDescuento" id="intDescuento" class="bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="10" readonly>
                                    </div>
                                </td>
                            </tr>
                            <tr class="text-center border-b border-gray-200 dark:border-gray-700">
                                <td colspan="8" class="py-4 text-center">
                                    <div class="flex justify-center items-center space-x-6 rtl:space-x-reverse">
                                        <button type="button" data-modal-target="modalBuscar" data-modal-toggle="modalBuscar" class="py-2.5 px-5 me-2 mb-2 text-sm font-medium text-white focus:outline-none bg-bluep rounded-lg border dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Buscar</button>
                                        <button type="button" class="py-2.5 px-5 me-2 mb-2 text-sm font-medium text-white focus:outline-none bg-greenp1 rounded-lg border border-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Calcular</button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="hidden rounded-lg bg-gray-50 dark:bg-gray-800" id="predialInfo" role="tabpanel" aria-labelledby="predialInfo-tab">
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <tbody>
                            <tr class="text-center bg-bluep border-b border-gray-200 dark:border-gray-700">
                                <td colspan="8" class="text-white text-2xl py-2">Liquidar Predial</td>
                            </tr>
                            <tr class="border-b border-gray-200 dark:border-gray-700">
                                <td class="px-2 py-4 text-bold text-black  bg-gray-100">
                                    Código catastral:
                                </td>
                                <td class="px-2 py-4 bg-gray-50 dark:bg-gray-800">
                                    <input type="input" name="intCodCatInfo" id="intCodCatInfo" class="bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 cursor-not-allowed dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500" :value="predio.codigo_catastro" readonly>
                                </td>
                                <td  class="px-2 py-4 text-bold text-black  bg-gray-100">
                                    Tipo:
                                </td>
                                <td colspan="3" class="px-2 py-4 bg-gray-50 dark:bg-gray-800">
                                    <input type="input" class="bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 cursor-not-allowed dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500" :value="predio.predio_tipo" readonly>
                                </td>
                            </tr>
                            <tr class="border-b border-gray-200 dark:border-gray-700">
                                <td class="px-2 py-4 text-bold text-black  bg-gray-100">
                                    Documento:
                                </td>
                                <td  class="px-2 py-4 bg-gray-50 dark:bg-gray-800">
                                    <input type="text" class="bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 cursor-not-allowed dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500" :value="predio.documento" readonly>
                                </td>
                                <td class="px-2 py-4 text-bold text-black  bg-gray-100">
                                    Propietario:
                                </td>
                                <td colspan="3" class="px-2 py-4 bg-gray-50 dark:bg-gray-800">
                                    <input type="text" class="bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 cursor-not-allowed dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500" :value="predio.nombre_propietario" readonly>
                                </td>
                            </tr>
                            <tr class="border-b border-gray-200 dark:border-gray-700">
                                <td class="px-2 py-4 text-bold text-black  bg-gray-100">
                                    Dirección:
                                </td>
                                <td class="px-2 py-4 bg-gray-50 dark:bg-gray-800">
                                    <input type="text" name="strDireccion" id="strDireccion" class="bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 cursor-not-allowed dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500" :value="predio.direccion" readonly>
                                </td>
                                <td class="px-2 py-4 text-bold text-black  bg-gray-100">
                                    Terreno:
                                </td>
                                <td class="px-2 py-4 bg-gray-50 dark:bg-gray-800">
                                    <div class="relative">
                                        <div class="absolute inset-y-0 end-0 top-0 flex items-center ps-3.5 pointer-events-none">
                                            <span class="px-2 text-1xl font-bold text-black">Ha</span>
                                        </div>
                                        <input type="input" name="intTasaPre" id="intTasaPre" class="bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" :value="predio.hectareas" readonly>
                                    </div>
                                </td>
                                <td class="px-2 py-4 bg-gray-50 dark:bg-gray-800">
                                    <div class="relative">
                                        <div class="absolute inset-y-0 end-0 top-0 flex items-center ps-3.5 pointer-events-none">
                                            <span class="px-2 text-1xl font-bold text-black">m2</span>
                                        </div>
                                        <input type="input" name="intTasaPre" id="intTasaPre" class="bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" :value="predio.metros_cuadrados" readonly>
                                    </div>
                                </td>
                                <td class="px-2 py-4 bg-gray-50 dark:bg-gray-800">
                                    <div class="relative">
                                        <div class="absolute inset-y-0 end-0 top-0 flex items-center ps-3.5 pointer-events-none">
                                            <span class="px-2 text-1xl font-bold text-black">Área construida</span>
                                        </div>
                                        <input type="input" name="intTasaPre" id="intTasaPre" class="bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" :value="predio.area_construida" readonly>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="mb-4 border-b border-gray-200 dark:border-gray-700">
            <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="options-tab" data-tabs-toggle="#options-tab-content" role="tablist">
                <li class="me-2" role="presentation">
                    <button class="inline-block p-4 border-b-2 rounded-t-lg" id="periodos-tab" data-tabs-target="#periodos" type="button" role="tab" aria-controls="periodos" aria-selected="false">Periodos a liquidar</button>
                </li>
                <li class="me-2" role="presentation">
                    <button class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300" id="recibos-tab" data-tabs-target="#recibos" type="button" role="tab" aria-controls="recibos" aria-selected="false">Recibos generados</button>
                </li>
            </ul>
        </div>
        <div id="options-tab-content">
            <div class="hidden rounded-lg bg-white dark:bg-gray-800" id="periodos" role="tabpanel" aria-labelledby="periodos-tab">
                <div class="flex justify-start space-x-3">
                    <button type="button" data-modal-target="modalPse" data-modal-toggle="modalPse" class="flex justify-between space-x-3 items-center text-black bg-gray-100 hover:bg-gray-200  font-medium rounded-lg text-sm px-2 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                        <span>Pagar en línea</span>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 188.25 187.833" height="30" width="30" xmlns:v="https://vecta.io/nano"><radialGradient id="A" cx="96.011" cy="357.583" r="93.155" fx="45.827" fy="353.899" gradientTransform="matrix(1 0 0 1 0 -264)" gradientUnits="userSpaceOnUse"><stop offset=".316" stop-color="#2d5ca8"/><stop offset=".531" stop-color="#285496"/><stop offset=".729" stop-color="#1f4272"/><stop offset="1" stop-color="#0d2d4d"/></radialGradient><ellipse cx="94.345" cy="93.917" rx="93.157" ry="93.153" fill="url(#A)"/><path d="M119.47 71H97.417c-.099 0-.198-.014-.295.006-3.509.761-10.122 4.348-10.088 12.182C86.852 86.202 88.172 91 94.475 93h15.72c.696 0 4.989.982 4.704 8.47-.288 7.549-6.724 8.53-7.65 9.53H82.891c-.768 0-1.391.732-1.391 1.5s.623 1.5 1.391 1.5h24.492c.079 0 .157-.366.235-.38 3.344-.572 9.749-4.002 10.062-12.207.404-10.611-7.273-11.281-7.351-11.286.011-.003-15.516-.045-15.516-.045-5.301-.97-5.015-6.598-4.999-6.843.002-.034.003.054.003.02C89.76 76.152 96.514 74 97.581 74h21.89c.768 0 1.391-.732 1.391-1.5s-.624-1.5-1.392-1.5zm33.577-.157c-.127-.036-.259.157-.391.157h-16.478c-7.459 0-10.828 8.637-10.967 9.014-.023.061-.04.016-.055.08-.171.773-4.187 18.937-4.052 24.934.129 5.642 5.875 7.693 8.895 8.016.05.006.1-.043.151-.043h22.908c.778 0 1.41-.722 1.41-1.5s-.631-1.5-1.41-1.5h-22.822c-.717 0-6.212-.838-6.311-5.205-.053-2.344.614-6.83 1.418-11.362l31.881-.238c.68-.005 1.26-.482 1.377-1.153.062-.35 1.494-8.503 1.494-13.392-.001-5.817-6.76-7.724-7.048-7.808zm2.967 19.571l-30.154.252c.926-4.913 1.868-8.94 2.027-9.663.322-.805 3.088-7.004 8.291-7.004h16.255c.88 0 4.842 1.556 4.842 4.853 0 3.605-.866 9.106-1.261 11.562zM82.84 79.444C83.667 73.817 76.56 71 75.23 71l-15.344.166c-.121-.013-.246.067-.372.086-3.554.566-8.38 5.143-9.93 9.377l.024.029c-.155.472-.291 1.2-.498 2.294l-1.021 5.485-3.039 16.613-4.384 24.158a1.37 1.37 0 0 0 1.105 1.594c.082.015.164.023.245.023a1.37 1.37 0 0 0 1.347-1.128l3.957-21.805c3.579 4.515 8.031 4.989 8.254 5.01.055.006.11.01.167.005l14.091-.403c.121-.003.239-.022.354-.057 6.685-2.005 8.695-8.903 8.778-9.196a1.48 1.48 0 0 0 .033-.15l3.825-23.429c.01-.05.011-.178.018-.228zm-2.736-.053l-3.797 23.176c-.198.621-1.944 5.659-6.739 7.201l-13.8.394c-.636-.089-4.942-.881-7.732-6.195l4.139-22.397c1.279-3.436 5.416-7.128 7.737-7.525.526.032 1.245.033 2.24.035l5.333-.003 7.429-.02c1.628-.012 5.586 2.751 5.19 5.334z" fill="#fff"/><g fill="#fdb718"><ellipse cx="19.366" cy="66.019" rx="3.923" ry="4.185"/><path d="M15.405 52.808c0-1.839-1.119-3.384-2.665-3.945l-3.614 7.272c.658.531 1.468.858 2.356.858 2.167 0 3.923-1.874 3.923-4.185zM7.484 66.019c0-1.135-.427-2.162-1.115-2.916l-2.151 7.03c1.852-.335 3.266-2.043 3.266-4.114z"/><ellipse cx="19.913" cy="117.005" rx="3.923" ry="4.185"/><path d="M6.055 117.005c0-1.745-1.215-3.174-2.79-3.412l1.538 6.124c.757-.634 1.252-1.607 1.252-2.712zm9.332 13.647c0-2.311-1.756-4.185-3.923-4.185-1.547 0-2.871.963-3.51 2.35l2.635 5.906c.282.069.573.113.875.113 2.166.001 3.923-1.873 3.923-4.184zM22.046 104h-7.867c-.51-1-1.971-2.721-3.715-2.721-2.167 0-3.923 1.964-3.923 4.275s1.756 4.266 3.923 4.266c1.744 0 3.205-.821 3.715-2.821h6.44 2.217.188l8.251-15H44v-2H23.14l-8.575-15h-.598-2.207-8.684l-.561 3h10.803l7.018 12H1.25l-.062 2H28.87L22.046 104z"/></g><path d="M54.233 58.499h4.206a1.55 1.55 0 0 0 1.015 1.813l-.798 5.584h-4.424s-1.958-.725-.943-2.828c0 0 .925-1.124 1.741-1.124l4.052.136m7.915-3.581H62.79s-1.45.725-1.813 2.611c0 0-.979 2.756.181 4.786l.49.109H65.6m3.826-10.897L67.45 66.077m1.111-6.167s.503-.995 1.373-1.412c0 0 3.173-.308 3.735.49 0 0 .635.308.598 1.215l-.979 5.693" fill="none" stroke="#fff" stroke-miterlimit="10"/></svg>
                    </button>
                    <button type="button" class="flex justify-between space-x-3 items-center text-black bg-gray-100 hover:bg-gray-200  font-medium rounded-lg text-sm px-2 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                        <span>Imprimir recibo de pago</span>
                        <svg xmlns="http://www.w3.org/2000/svg" height="16" width="12" viewBox="0 0 384 512"><path d="M14 2.2C22.5-1.7 32.5-.3 39.6 5.8L80 40.4 120.4 5.8c9-7.7 22.3-7.7 31.2 0L192 40.4 232.4 5.8c9-7.7 22.3-7.7 31.2 0L304 40.4 344.4 5.8c7.1-6.1 17.1-7.5 25.6-3.6s14 12.4 14 21.8V488c0 9.4-5.5 17.9-14 21.8s-18.5 2.5-25.6-3.6L304 471.6l-40.4 34.6c-9 7.7-22.3 7.7-31.2 0L192 471.6l-40.4 34.6c-9 7.7-22.3 7.7-31.2 0L80 471.6 39.6 506.2c-7.1 6.1-17.1 7.5-25.6 3.6S0 497.4 0 488V24C0 14.6 5.5 6.1 14 2.2zM96 144c-8.8 0-16 7.2-16 16s7.2 16 16 16H288c8.8 0 16-7.2 16-16s-7.2-16-16-16H96zM80 352c0 8.8 7.2 16 16 16H288c8.8 0 16-7.2 16-16s-7.2-16-16-16H96c-8.8 0-16 7.2-16 16zM96 240c-8.8 0-16 7.2-16 16s7.2 16 16 16H288c8.8 0 16-7.2 16-16s-7.2-16-16-16H96z"/></svg>
                    </button>
                    <button type="button" class="flex justify-between space-x-3 items-center text-black bg-gray-100 hover:bg-gray-200  font-medium rounded-lg text-sm px-2 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                        <span>Imprimir estado de cuenta</span>
                        <svg xmlns="http://www.w3.org/2000/svg" height="16" width="12" viewBox="0 0 384 512"><path d="M64 0C28.7 0 0 28.7 0 64V448c0 35.3 28.7 64 64 64H320c35.3 0 64-28.7 64-64V160H256c-17.7 0-32-14.3-32-32V0H64zM256 0V128H384L256 0zM80 64h64c8.8 0 16 7.2 16 16s-7.2 16-16 16H80c-8.8 0-16-7.2-16-16s7.2-16 16-16zm0 64h64c8.8 0 16 7.2 16 16s-7.2 16-16 16H80c-8.8 0-16-7.2-16-16s7.2-16 16-16zm16 96H288c17.7 0 32 14.3 32 32v64c0 17.7-14.3 32-32 32H96c-17.7 0-32-14.3-32-32V256c0-17.7 14.3-32 32-32zm0 32v64H288V256H96zM240 416h64c8.8 0 16 7.2 16 16s-7.2 16-16 16H240c-8.8 0-16-7.2-16-16s7.2-16 16-16z"/></svg>
                    </button>
                    <button type="button" class="flex justify-between space-x-3 items-center text-black bg-gray-100 hover:bg-gray-200  font-medium rounded-lg text-sm px-2 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                        <span>Imprimir paz y salvo</span>
                        <svg xmlns="http://www.w3.org/2000/svg" height="16" width="16" viewBox="0 0 512 512"><path d="M128 0C92.7 0 64 28.7 64 64v96h64V64H354.7L384 93.3V160h64V93.3c0-17-6.7-33.3-18.7-45.3L400 18.7C388 6.7 371.7 0 354.7 0H128zM384 352v32 64H128V384 368 352H384zm64 32h32c17.7 0 32-14.3 32-32V256c0-35.3-28.7-64-64-64H64c-35.3 0-64 28.7-64 64v96c0 17.7 14.3 32 32 32H64v64c0 35.3 28.7 64 64 64H384c35.3 0 64-28.7 64-64V384zM432 248a24 24 0 1 1 0 48 24 24 0 1 1 0-48z"/></svg>
                    </button>
                </div>
                <div class="mt-3 relative overflow-x-auto shadow-md sm:rounded-lg">
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    Vigencia
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Código catastral
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Predial
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Intereses Predial
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Desc. Intereses
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Total. Int Predial
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Sobretasa Bomberil
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Intereses
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Descuentos
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Valor Total
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Dias mora
                                </th>
                                <th scope="col" class="p-4">
                                    Sel
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="vigencia in predio.vigencias" :key="predio.vigencias"  class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <td class="px-6 py-4">
                                    {{ vigencia.vigencia }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ predio.codigo_catastro }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ vigencia.valor_predial }}
                                </td>
                                <td class="px-6 py-4">
                                    364.00
                                </td>
                                <td class="px-6 py-4">
                                    $0.00
                                </td>
                                <td class="px-6 py-4">
                                    364.00
                                </td>
                                <td class="px-6 py-4">
                                    26.00
                                </td>
                                <td class="px-6 py-4">
                                    14.00
                                </td>
                                <td class="px-6 py-4">
                                    0.00
                                </td>
                                <td class="px-6 py-4">
                                    1,255.00
                                </td>
                                <td class="px-6 py-4">
                                    591
                                </td>
                                <td class="w-4 p-4">
                                    <div class="flex items-center">
                                        <input id="checkbox-table-search-3" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                        <label for="checkbox-table-search-3" class="sr-only">checkbox</label>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <tbody>
                            <tr class="border-b border-gray-200 dark:border-gray-700">
                                <td class="px-2 py-4 text-bold text-black  bg-gray-100">
                                    Total Liquidación:
                                </td>
                                <td class="px-2 py-4 bg-gray-50 dark:bg-gray-800">
                                    <input type="input" name="intTotalLiq" id="intTotalLiq" class="bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 cursor-not-allowed dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500"  readonly>
                                </td>
                                <td  class="px-2 py-4 text-bold text-black  bg-gray-100">
                                    Total Predial:
                                </td>
                                <td class="px-2 py-4 bg-gray-50 dark:bg-gray-800">
                                    <input type="input" name="intTotalPre" id="intTotalPre" class="bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 cursor-not-allowed dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500" value="0" readonly>
                                </td>
                                <td  class="px-2 py-4 text-bold text-black  bg-gray-100">
                                    Total Bomberil:
                                </td>
                                <td class="px-2 py-4 bg-gray-50 dark:bg-gray-800">
                                    <input type="input" name="intTotalSb" id="intTotalSb"  :value="getTotal(predio.vigencias).bomberil" class="bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 cursor-not-allowed dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500" readonly>
                                </td>
                                <td  class="px-2 py-4 text-bold text-black  bg-gray-100">
                                    Total Ambiental:
                                </td>
                                <td class="px-2 py-4 bg-gray-50 dark:bg-gray-800">
                                    <input type="input" name="intTotalSa" id="intTotalSa" :value="getTotal(predio.vigencias).ambiental" class="bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 cursor-not-allowed dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500"  readonly>
                                </td>
                                <td  class="px-2 py-4 text-bold text-black  bg-gray-100">
                                    Total Alumbrado:
                                </td>
                                <td class="px-2 py-4 bg-gray-50 dark:bg-gray-800">
                                    <input type="input" name="intTotalSa" id="intTotalSa" :value="getTotal(predio.vigencias).alumbrado" class="bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 cursor-not-allowed dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500"  readonly>
                                </td>
                                <td  class="px-2 py-4 text-bold text-black  bg-gray-100">
                                    Total Intereses:
                                </td>
                                <td class="px-2 py-4 bg-gray-50 dark:bg-gray-800">
                                    <input type="input" name="intTotalInt" id="intTotalInt" class="bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 cursor-not-allowed dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500" value="0" readonly>
                                </td>
                                <td  class="px-2 py-4 text-bold text-black  bg-gray-100">
                                    Total Descuento:
                                </td>
                                <td class="px-2 py-4 bg-gray-50 dark:bg-gray-800">
                                    <input type="input" name="intTotalDes" id="intTotalDes" class="bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 cursor-not-allowed dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500" value="0" readonly>
                                </td>
                            </tr>
                            <tr class="border-b border-gray-200 dark:border-gray-700">
                                <td class="px-2 py-4 text-bold text-black  bg-gray-100">
                                    Son:
                                </td>
                                <td colspan="20" class="px-2 py-4 bg-gray-50 dark:bg-gray-800">
                                    <input type="text" name="strDireccion" id="strDireccion" class="bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 cursor-not-allowed dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500" value="PESOS M/CTE">
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="hidden rounded-lg bg-gray-50 dark:bg-gray-800" id="recibos" role="tabpanel" aria-labelledby="recibos-tab">
                <div class="mt-3 relative overflow-x-auto shadow-md sm:rounded-lg">
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3"></th>
                                <th scope="col" class="px-6 py-3">
                                    Nro
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Nro Alterno
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Tipo
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Emisión
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Vencimiento
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Inicial
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Final
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Total
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Descuento
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Neto
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Pagada
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <td class="px-6 py-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" height="16" width="16" viewBox="0 0 512 512"><path fill="#77dd77" d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512z"/></svg>
                                </td>
                                <td class="px-6 py-4">
                                    11111111111111
                                </td>
                                <td class="px-6 py-4">
                                    11111111111112
                                </td>
                                <td class="px-6 py-4">
                                    AUTOMATICO
                                </td>
                                <td class="px-6 py-4">
                                    01/12/2023
                                </td>
                                <td class="px-6 py-4">
                                    02/12/2023
                                </td>
                                <td class="px-6 py-4">
                                    2020
                                </td>
                                <td class="px-6 py-4">
                                    2020
                                </td>
                                <td class="px-6 py-4">
                                    250.000
                                </td>
                                <td class="px-6 py-4">
                                    0
                                </td>
                                <td class="px-6 py-4">
                                    0
                                </td>
                                <td class="px-6 py-4">
                                    Si
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </Layout>
</template>
