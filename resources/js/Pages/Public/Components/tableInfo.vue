<script setup>
import { router } from '@inertiajs/vue3'

defineProps(
    {predios: Object},
    {predio:Object}
);


function search(evt) {
    router.get(route('public.impuesto_predial_unificado'), { search: evt.target.value }, { preserveState: true })
}

function show(predio_id) {
    router.get(route('public.impuesto_predial_unificado'), { predio_id: predio_id }, { preserveState: false })
}
</script>

<template>
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
                                <tr @click="show(predio.id)" v-for="predio in predios" :key="predio.id"  class="cursor-pointer bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-bluep hover:text-white dark:hover:bg-gray-600">
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
                        <tr class="border-b border-gray-200 dark:border-gray-700">
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
                                <input type="input" name="intCodCat" id="intCodCat" class="bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 cursor-not-allowed dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500" value="1234567890" readonly>
                            </td>
                            <td class="px-2 py-4">
                                <input type="input" name="intOrd" id="intOrd" class="bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 cursor-not-allowed dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500" value="004" readonly>
                            </td>
                            <td class="px-2 py-4">
                                <input type="input" name="intTot" id="intTot" class="bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 cursor-not-allowed dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500" value="007" readonly>
                            </td>
                            <td class="px-2 py-4 text-bold text-black  bg-gray-100">
                                Tasa de interés de mora:
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
                                    <input type="input" name="intAvaVig" id="intAvaVig" class="bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="1234567890" readonly>
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
                                <input type="input" name="intCodCatInfo" id="intCodCatInfo" class="bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 cursor-not-allowed dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500" value="1234567890" readonly>
                            </td>
                            <td  class="px-2 py-4 text-bold text-black  bg-gray-100">
                                Tipo:
                            </td>
                            <td colspan="3" class="px-2 py-4 bg-gray-50 dark:bg-gray-800">
                                <select id="countries" disabled  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option value="1">Rural</option>
                                </select>
                            </td>
                        </tr>
                        <tr class="border-b border-gray-200 dark:border-gray-700">
                            <td class="px-2 py-4 text-bold text-black  bg-gray-100">
                                Documento:
                            </td>
                            <td  class="px-2 py-4 bg-gray-50 dark:bg-gray-800">
                                <input type="text" id="strDocumento" name="strDocumento" class="bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 cursor-not-allowed dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500" value="1234567890" readonly>
                            </td>
                            <td class="px-2 py-4 text-bold text-black  bg-gray-100">
                                Propietario:
                            </td>
                            <td colspan="3" class="px-2 py-4 bg-gray-50 dark:bg-gray-800">
                                <input type="text" id="strDocumento" name="strDocumento" class="bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 cursor-not-allowed dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500" value="MARIA CELMIRA ROMERO CASTRO" readonly>
                            </td>
                        </tr>
                        <tr class="border-b border-gray-200 dark:border-gray-700">
                            <td class="px-2 py-4 text-bold text-black  bg-gray-100">
                                Dirección:
                            </td>
                            <td class="px-2 py-4 bg-gray-50 dark:bg-gray-800">
                                <input type="text" name="strDireccion" id="strDireccion" class="bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 cursor-not-allowed dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500" value="Cra 12 N 34-56" readonly>
                            </td>
                            <td class="px-2 py-4 text-bold text-black  bg-gray-100">
                                Terreno:
                            </td>
                            <td class="px-2 py-4 bg-gray-50 dark:bg-gray-800">
                                <div class="relative">
                                    <div class="absolute inset-y-0 end-0 top-0 flex items-center ps-3.5 pointer-events-none">
                                        <span class="px-2 text-1xl font-bold text-black">Ha</span>
                                    </div>
                                    <input type="input" name="intTasaPre" id="intTasaPre" class="bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="32" readonly>
                                </div>
                            </td>
                            <td class="px-2 py-4 bg-gray-50 dark:bg-gray-800">
                                <div class="relative">
                                    <div class="absolute inset-y-0 end-0 top-0 flex items-center ps-3.5 pointer-events-none">
                                        <span class="px-2 text-1xl font-bold text-black">m2</span>
                                    </div>
                                    <input type="input" name="intTasaPre" id="intTasaPre" class="bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="8125" readonly>
                                </div>
                            </td>
                            <td class="px-2 py-4 bg-gray-50 dark:bg-gray-800">
                                <div class="relative">
                                    <div class="absolute inset-y-0 end-0 top-0 flex items-center ps-3.5 pointer-events-none">
                                        <span class="px-2 text-1xl font-bold text-black">Área construida</span>
                                    </div>
                                    <input type="input" name="intTasaPre" id="intTasaPre" class="bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="235" readonly>
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
        <div class="hidden rounded-lg bg-gray-50 dark:bg-gray-800" id="periodos" role="tabpanel" aria-labelledby="periodos-tab">
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
                                Sobretasa Bombe
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
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <td class="px-6 py-4">
                                2023
                            </td>
                            <td class="px-6 py-4">
                                0001000000010067000000000
                            </td>
                            <td class="px-6 py-4">
                                850.50
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
                                <input type="input" name="intTotalLiq" id="intTotalLiq" class="bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 cursor-not-allowed dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500" value="0" readonly>
                            </td>
                            <td  class="px-2 py-4 text-bold text-black  bg-gray-100">
                                Total Predial:
                            </td>
                            <td class="px-2 py-4 bg-gray-50 dark:bg-gray-800">
                                <input type="input" name="intTotalPre" id="intTotalPre" class="bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 cursor-not-allowed dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500" value="0" readonly>
                            </td>
                            <td  class="px-2 py-4 text-bold text-black  bg-gray-100">
                                Total Sobre Bomberil:
                            </td>
                            <td class="px-2 py-4 bg-gray-50 dark:bg-gray-800">
                                <input type="input" name="intTotalSb" id="intTotalSb" class="bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 cursor-not-allowed dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500" value="0" readonly>
                            </td>
                            <td  class="px-2 py-4 text-bold text-black  bg-gray-100">
                                Total Sobre Ambiental:
                            </td>
                            <td class="px-2 py-4 bg-gray-50 dark:bg-gray-800">
                                <input type="input" name="intTotalSa" id="intTotalSa" class="bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 cursor-not-allowed dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500" value="0" readonly>
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
                            <td colspan="12" class="px-2 py-4 bg-gray-50 dark:bg-gray-800">
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
</template>
