<template>
    <Layout :tenant="tenant" v-slot="{ login, showModal, hideModal }">

            <div id="toast-danger" :class="{'hidden':alertText==''}" class="fixed top-0 right-0 z-40 mt-10 mr-5 flex items-center w-full lg:max-w-xs md:max-w-lg p-4 mb-4 text-gray-500 bg-white rounded-lg border border-red-400 dark:text-gray-400 dark:bg-gray-800" role="alert">
                <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-red-500 bg-red-100 rounded-lg dark:bg-red-800 dark:text-red-200">
                    <svg class="lg:w-5 lg:h-5 md:w-10 md:h-10" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 11.793a1 1 0 1 1-1.414 1.414L10 11.414l-2.293 2.293a1 1 0 0 1-1.414-1.414L8.586 10 6.293 7.707a1 1 0 0 1 1.414-1.414L10 8.586l2.293-2.293a1 1 0 0 1 1.414 1.414L11.414 10l2.293 2.293Z"/>
                    </svg>
                    <span class="sr-only">Error icon</span>
                </div>
                <div class="ms-3 lg:text-sm md:text-3xl font-medium" v-html="alertText"></div>
                <button type="button" class="ms-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2  p-1.5 inline-flex items-center justify-center h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700" data-dismiss-target="#toast-danger" aria-label="Close">
                    <span class="sr-only">Close</span>
                    <svg class="lg:w-5 lg:h-5 md:w-10 md:h-10"  aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                </button>
            </div>
            <!--Modal-->
            <div id="modalBuscar" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                <div class="relative w-full max-w-7xl max-h-full">
                    <!-- Modal content -->
                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                        <!-- Modal header -->
                        <div class="text-center bg-blue-600 text-white flex items-center justify-between lg:p-4 md:p-5 border-b rounded-t dark:border-gray-600 dark:bg-blue-900">
                            <h3 class="lg:text-xl md:text-3xl  font-semibol  dark:text-white">
                                Buscar
                            </h3>
                            <button type="button" class="text-white rounded-lg text-sm w-14 h-14 ms-auto inline-flex justify-center items-center" data-modal-hide="modalBuscar">
                                <svg class="lg:w-3 lg:h-3 md:w-6 md:h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                </svg>
                                <span class="sr-only">Close modal</span>
                            </button>
                        </div>
                        <!-- Modal body -->
                        <div class="p-4 md:p-5 space-y-4 dark:bg-gray-900">
                            <form @submit.prevent>
                                <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Buscar</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                        <svg class="lg:w-4 lg:h-4 md:w-6 md:h-6 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                        </svg>
                                    </div>
                                    <input type="search" @input="search" id="default-search" class="block w-full p-4 ps-10 lg:text-sm md:text-3xl text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Buscar código o dirección" required>
                                </div>
                            </form>

                            <div v-if="predios.length > 0" class="mt-3 relative overflow-x-auto overflow-y-auto h-96 shadow-md sm:rounded-lg">
                                <table class="w-full lg:text-sm md:text-3xl text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                    <thead class="text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                        <tr class="text-center font-semibold py-3 text-black bg-gray-100 dark:bg-gray-700 dark:text-white">
                                            <td colspan="8">Resultados de Búsqueda: {{ predios.length }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="col" class="px-6 py-3 whitespace-nowrap">
                                                ID
                                            </th>
                                            <th scope="col" class="px-6 py-3 whitespace-nowrap">
                                                Código catastral
                                            </th>
                                            <th scope="col" class="px-6 py-3 whitespace-nowrap">
                                                Orden
                                            </th>
                                            <th scope="col" class="px-6 py-3 whitespace-nowrap">
                                                Total
                                            </th>
                                            <th scope="col" class="px-6 py-3 whitespace-nowrap">
                                                Propietario
                                            </th>
                                            <th scope="col" class="px-6 py-3 whitespace-nowrap">
                                                Documento
                                            </th>
                                            <th scope="col" class="px-6 py-3 whitespace-nowrap">
                                                Dirección
                                            </th>
                                            <th scope="col" class="px-6 py-3 whitespace-nowrap">
                                                Tipo
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr @click="show(predio.id)" data-modal-hide="modalBuscar" v-for="predio in predios" :key="predio.id"  class="cursor-pointer bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-bluep hover:text-white dark:hover:bg-gray-600">
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                {{ predio.id }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                {{ predio.codigo_catastro }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                {{ predio.total }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                {{ predio.orden }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                {{ predio.nombre_propietario }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                {{ predio.documento }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                {{ predio.direccion }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                {{ predio.predio_tipo }}
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div v-else  class="flex justify-center h-96 items-center"></div>
                        </div>
                    </div>
                </div>
            </div>

            <ModalPse />
        <div class="xl:mt-24 xl:p-10 md:mt-48 mx-auto container">
            <h1 class="text-2xl md:text-5xl text-center font-medium text-gray-900 dark:text-white mb-8 mt-5">Impuesto predial unificado</h1>
            <!--Información predio-->
            <div class="mt-5 relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full lg:text-sm md:text-3xl text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <tbody>
                        <tr class="bg-gray-200 border-gray-200 dark:border-gray-700 dark:bg-gray-700 dark:text-white">
                            <td colspan="8" class="lg:text-base md:text-4xl py-2"><p class="px-5 py-2 font-bold">Información predial</p></td>
                        </tr>
                        <tr>
                            <td class="whitespace-nowrap border-b border-gray-300 text-bold text-black  bg-white dark:bg-gray-800 dark:border-gray-700 dark:text-white">
                                <p class="px-5 py-2 font-bold">Código catastral:</p>
                                <p class="px-5 py-2 text-black dark:text-gray-400">{{ predio.codigo_catastro }}</p>
                            </td>
                            <td class="whitespace-nowrap border-b border-gray-300 text-bold text-black  bg-white dark:bg-gray-800 dark:border-gray-700 dark:text-white">
                                <p class="px-5 py-2 font-bold">Total:</p>
                                <p class="px-5 py-2 text-black dark:text-gray-400">{{ predio.total }}</p>
                            </td>
                            <td class="whitespace-nowrap border-b border-gray-300 text-bold text-black  bg-white dark:bg-gray-800 dark:border-gray-700 dark:text-white">
                                <p class="px-5 py-2 font-bold">Orden:</p>
                                <p class="px-5 py-2  text-black dark:text-gray-400">{{ predio.orden }}</p>
                            </td>
                            <td class="whitespace-nowrap border-b border-gray-300 text-bold text-black  bg-white dark:bg-gray-800 dark:border-gray-700 dark:text-white">
                                <p class="px-5 py-2 font-bold">Dirección:</p>
                                <p class="px-5 py-2 text-black dark:text-gray-400">{{ predio.direccion }}</p>
                            </td>
                            <td class="whitespace-nowrap border-b border-gray-300 text-bold text-black  bg-white dark:bg-gray-800 dark:border-gray-700 dark:text-white">
                                <p class="px-5 py-2 font-bold">Avalúo vigente:</p>
                                <p class="px-5 py-2 text-black dark:text-gray-400">{{ formatNumber(predio.valor_avaluo) }}</p>
                            </td>
                        </tr>
                        <tr class="bg-gray-200 border-gray-200 dark: dark:border-gray-700 dark:bg-gray-700 dark:text-white">
                            <td colspan="8" class="lg:text-base md:text-4xl py-2"><p class="px-5 py-2 font-bold">Información del propietario</p></td>
                        </tr>
                        <tr>
                            <td colspan="4" class="whitespace-nowrap border-b border-gray-300 text-bold text-black  bg-white dark:bg-gray-800 dark:border-gray-700 dark:text-white">
                                <p class="px-5 py-2 font-bold">Nombre del propietario:</p>
                                <p class="px-5 py-2 text-black dark:text-gray-400">{{ predio.nombre_propietario }}</p>
                            </td>
                            <td colspan="4" class="whitespace-nowrap border-b border-gray-300 text-bold text-black  bg-white dark:bg-gray-800 dark:border-gray-700 dark:text-white">
                                <p class="px-5 py-2 font-bold">Documento:</p>
                                <p class="px-5 py-2 text-black dark:text-gray-400">{{ predio.documento }}</p>
                            </td>
                        </tr>
                        <tr class="bg-gray-200 border-gray-200 dark:border-gray-700 dark:bg-gray-700 dark:text-white">
                            <td colspan="8" class="lg:text-base md:text-4xl py-2"><p class="px-5 py-2 font-bold">Información Terreno y clasificación</p></td>
                        </tr>
                        <tr class="border-b border-gray-200 dark:border-gray-700">
                            <td colspan="2" class="whitespace-nowrap border-b border-gray-300 text-bold text-black  bg-white dark:bg-gray-800 dark:border-gray-700 dark:text-white">
                                <p class="px-5 py-2 font-bold">Área del terreno:</p>
                                <p v-if="predio.hectareas && predio.metros_cuadrados" class="px-5 py-2 text-black dark:text-gray-400">{{ predio.hectareas + ' Ha - ' + predio.metros_cuadrados + ' m²' }}</p>
                            </td>
                            <td class="whitespace-nowrap border-b border-gray-300 text-bold text-black  bg-white dark:bg-gray-800 dark:border-gray-700 dark:text-white">
                                <p class="px-5 py-2 font-bold">Área construida:</p>
                                <p v-if="predio.area_construida" class="px-5 py-2 text-black dark:text-gray-400">{{ predio.area_construida + ' m²' }}</p>
                            </td>
                            <td class="whitespace-nowrap border-b border-gray-300 text-bold text-black  bg-white dark:bg-gray-800 dark:border-gray-700 dark:text-white">
                                <p class="px-5 py-2 font-bold">Tipo predio:</p>
                                <p v-if="predio.predio_tipo" class="px-5 py-2 text-black dark:text-gray-400">{{ predio.predio_tipo }}</p>
                            </td>
                            <td  class="whitespace-nowrap border-b border-gray-300 text-bold text-black  bg-white dark:bg-gray-800 dark:border-gray-700 dark:text-white">
                                <p class="px-5 py-2 font-bold ">Destino socioeconómico:</p>
                                <p class="px-5 py-2 text-black dark:text-gray-400">{{ predio.destino_economico }}</p>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="flex justify-center items-center space-x-6 rtl:space-x-reverse mt-5">
                <button type="button" data-modal-target="modalBuscar" data-modal-toggle="modalBuscar" class="lg:w-auto md:w-full lg:px-3 lg:py-2.5 md:px-3 md:py-5 lg:text-sm md:text-4xl font-medium text-blue-600 border border-blue-600 bg-white hover:text-white hover:bg-blue-600 focus:outline-none rounded-lg dark:bg-blue-600 dark:text-white dark:hover:bg-blue-700 dark:hover:border-blue-700">Buscar</button>
            </div>
            <div v-if="predio != '' && vigencias.length > 0" class="lg:mt-auto md: mt-10">
                <div class="mb-4 border-b border-gray-200 dark:border-gray-700">
                    <ul class="flex flex-wrap -mb-px lg:text-sm md:text-4xl font-medium text-center" id="options-tab" data-tabs-toggle="#options-tab-content" role="tablist">
                        <li class="me-2" role="presentation">
                            <button class="inline-block p-4 border-b-2 rounded-t-lg" id="periodos-tab" data-tabs-target="#periodos" type="button" role="tab" aria-controls="periodos" aria-selected="false">Periodos a liquidar</button>
                        </li>
                        <li class="me-2" role="presentation">
                            <button class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300" @click="router.reload({ preserveState: true })" id="recibos-tab" data-tabs-target="#recibos" type="button" role="tab" aria-controls="recibos" aria-selected="false">Liquidaciones generadas</button>
                        </li>
                    </ul>
                </div>

                <div id="options-tab-content">
                    <div class="hidden rounded-lg bg-white dark:bg-gray-800" id="periodos" role="tabpanel" aria-labelledby="periodos-tab">
                        <div class="flex flex-wrap justify-start lg:space-x-3 md:space-x-0 md:mt-10 lg:space-y-0 md:space-y-6">
                            <button type="button" :disabled="vigencias.filter(vigencia => vigencia.isSelected).length == 0" @click="showWompi" :class="{'cursor-not-allowed text-gray-300 bg-gray-100 hover:bg-gray-100 dark:border dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:bg-gray-800':vigencias.filter(vigencia => vigencia.isSelected).length == 0,'text-blue-600 bg-white border border-blue-600 hover:bg-blue-600 hover:text-white dark:bg-blue-600 dark:text-white dark:hover:bg-blue-700':vigencias.filter(vigencia => vigencia.isSelected).length>0}" class="group flex lg:justify-between md:justify-center md:w-full lg:w-auto lg:space-x-3 md:space-x-6 items-center font-bold rounded-lg lg:text-sm md:text-4xl lg:px-2 lg:py-2.5 md:px-3 md:py-5">
                                <span>Pagar en línea</span>
                                <svg :class="{'fill-gray-300 group-hover:fill-gray-300 dark:fill-gray-400 dark:group-hover:fill-gray-400':vigencias.filter(vigencia => vigencia.isSelected).length == 0,'fill-blue-600 group-hover:fill-white dark:fill-white':vigencias.filter(vigencia => vigencia.isSelected)}" class="lg:w-5 lg:h-5 md:w-10 md:h-10"  xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" height="24px" viewBox="0 0 24 24" width="24px" fill="none"><g><rect fill="none" height="24" width="24"/></g><g><path d="M12,2C6.48,2,2,6.48,2,12s4.48,10,10,10s10-4.48,10-10S17.52,2,12,2z M12,20c-4.41,0-8-3.59-8-8c0-4.41,3.59-8,8-8 s8,3.59,8,8C20,16.41,16.41,20,12,20z M12.89,11.1c-1.78-0.59-2.64-0.96-2.64-1.9c0-1.02,1.11-1.39,1.81-1.39 c1.31,0,1.79,0.99,1.9,1.34l1.58-0.67c-0.15-0.44-0.82-1.91-2.66-2.23V5h-1.75v1.26c-2.6,0.56-2.62,2.85-2.62,2.96 c0,2.27,2.25,2.91,3.35,3.31c1.58,0.56,2.28,1.07,2.28,2.03c0,1.13-1.05,1.61-1.98,1.61c-1.82,0-2.34-1.87-2.4-2.09L8.1,14.75 c0.63,2.19,2.28,2.78,3.02,2.96V19h1.75v-1.24c0.52-0.09,3.02-0.59,3.02-3.22C15.9,13.15,15.29,11.93,12.89,11.1z"/></g></svg>
                            </button>
                            <button type="button" @click="createRecibo" :disabled="vigencias.filter(vigencia => vigencia.isSelected).length == 0" :class="{'cursor-not-allowed text-gray-300 bg-gray-100 hover:bg-gray-100 dark:border dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:bg-gray-800':vigencias.filter(vigencia => vigencia.isSelected).length == 0,'text-blue-600 bg-white border border-blue-600 hover:bg-blue-600 hover:text-white dark:bg-blue-600 dark:text-white dark:hover:bg-blue-700':vigencias.filter(vigencia => vigencia.isSelected).length>0}" class="group flex lg:justify-between md:justify-center md:w-full lg:w-auto lg:space-x-3 md:space-x-6 items-center font-bold rounded-lg lg:text-sm md:text-4xl lg:px-2 lg:py-2.5 md:px-3 md:py-5">
                                <span>Imprimir liquidación predial</span>
                                <svg :class="{'fill-gray-300 group-hover:fill-gray-300 dark:fill-gray-400 dark:group-hover:fill-gray-400':vigencias.filter(vigencia => vigencia.isSelected).length == 0,'fill-blue-600 group-hover:fill-white dark:fill-white':vigencias.filter(vigencia => vigencia.isSelected)}" class="lg:w-5 lg:h-5 md:w-10 md:h-10" xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 384 512"><path d="M14 2.2C22.5-1.7 32.5-.3 39.6 5.8L80 40.4 120.4 5.8c9-7.7 22.3-7.7 31.2 0L192 40.4 232.4 5.8c9-7.7 22.3-7.7 31.2 0L304 40.4 344.4 5.8c7.1-6.1 17.1-7.5 25.6-3.6s14 12.4 14 21.8V488c0 9.4-5.5 17.9-14 21.8s-18.5 2.5-25.6-3.6L304 471.6l-40.4 34.6c-9 7.7-22.3 7.7-31.2 0L192 471.6l-40.4 34.6c-9 7.7-22.3 7.7-31.2 0L80 471.6 39.6 506.2c-7.1 6.1-17.1 7.5-25.6 3.6S0 497.4 0 488V24C0 14.6 5.5 6.1 14 2.2zM96 144c-8.8 0-16 7.2-16 16s7.2 16 16 16H288c8.8 0 16-7.2 16-16s-7.2-16-16-16H96zM80 352c0 8.8 7.2 16 16 16H288c8.8 0 16-7.2 16-16s-7.2-16-16-16H96c-8.8 0-16 7.2-16 16zM96 240c-8.8 0-16 7.2-16 16s7.2 16 16 16H288c8.8 0 16-7.2 16-16s-7.2-16-16-16H96z"/></svg>
                            </button>
                            <button type="button" @click="createEstadoCuenta" class="group flex lg:justify-between md:justify-center md:w-full lg:w-auto lg:space-x-3 md:space-x-6 items-center text-blue-600 bg-white border border-blue-600 hover:bg-blue-600 hover:text-white  font-bold rounded-lg lg:text-sm md:text-4xl lg:px-2 lg:py-2.5 md:px-3 md:py-5 dark:bg-blue-600 dark:text-white dark:hover:bg-blue-700">
                                <span>Imprimir estado de cuenta</span>
                                <svg class="fill-blue-600 group-hover:fill-white dark:fill-white lg:w-5 lg:h-5 md:w-10 md:h-10" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"><path d="M64 0C28.7 0 0 28.7 0 64V448c0 35.3 28.7 64 64 64H320c35.3 0 64-28.7 64-64V160H256c-17.7 0-32-14.3-32-32V0H64zM256 0V128H384L256 0zM80 64h64c8.8 0 16 7.2 16 16s-7.2 16-16 16H80c-8.8 0-16-7.2-16-16s7.2-16 16-16zm0 64h64c8.8 0 16 7.2 16 16s-7.2 16-16 16H80c-8.8 0-16-7.2-16-16s7.2-16 16-16zm16 96H288c17.7 0 32 14.3 32 32v64c0 17.7-14.3 32-32 32H96c-17.7 0-32-14.3-32-32V256c0-17.7 14.3-32 32-32zm0 32v64H288V256H96zM240 416h64c8.8 0 16 7.2 16 16s-7.2 16-16 16H240c-8.8 0-16-7.2-16-16s7.2-16 16-16z"/></svg>
                            </button>
                            <button type="button" @click="createPazSalvo" class="cursor-not-allowed flex lg:justify-between md:justify-center md:w-full lg:w-auto lg:space-x-3 md:space-x-6 items-center text-gray-300 bg-gray-100  font-bold rounded-lg lg:text-sm md:text-4xl lg:px-2 lg:py-2.5 md:px-3 md:py-5 dark:border dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600">
                                <span>Imprimir paz y salvo</span>
                                <svg class="fill-gray-300 dark:fill-gray-400 lg:w-5 lg:h-5 md:w-10 md:h-10" xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 512 512"><path d="M128 0C92.7 0 64 28.7 64 64v96h64V64H354.7L384 93.3V160h64V93.3c0-17-6.7-33.3-18.7-45.3L400 18.7C388 6.7 371.7 0 354.7 0H128zM384 352v32 64H128V384 368 352H384zm64 32h32c17.7 0 32-14.3 32-32V256c0-35.3-28.7-64-64-64H64c-35.3 0-64 28.7-64 64v96c0 17.7 14.3 32 32 32H64v64c0 35.3 28.7 64 64 64H384c35.3 0 64-28.7 64-64V384zM432 248a24 24 0 1 1 0 48 24 24 0 1 1 0-48z"/></svg>
                            </button>
                        </div>
                        <div  class="mt-10 relative overflow-auto shadow-md sm:rounded-lg overflow-y-auto h-max-96">
                            <table  class="w-full lg:text-xs md:text-3xl text-center  text-gray-500 dark:text-gray-400">
                                <thead class="text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                    <tr>
                                        <th scope="col" class="p-4">
                                            <div class="flex items-center">
                                                <input id="checkbox-table-search-all" type="checkbox" :checked="isCheckAll" @change="evt => updateCheckAll(evt, [])" class="lg:w-4 lg:h-4 md:w-10 md:h-10 text-greenp1 bg-gray-100 border-gray-300 rounded focus:ring-greenp1 dark:focus:ring-greenp1 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                                <label for="checkbox-table-search-all" class="sr-only">Seleccionar</label>
                                            </div>
                                        </th>
                                        <th scope="col" class="px-6 py-3 whitespace-nowrap">
                                            Vigencia
                                        </th>
                                        <th scope="col" class="px-6 py-3 whitespace-nowrap">
                                            Avaluo predial
                                        </th>
                                        <th scope="col" class="px-6 py-3 whitespace-nowrap">
                                            Tasa x mil
                                        </th>
                                        <th scope="col" class="px-6 py-3 whitespace-nowrap">
                                            Predial
                                        </th>
                                        <th scope="col" class="px-6 py-3 whitespace-nowrap">
                                            Intereses Predial
                                        </th>
                                        <th scope="col" class="px-6 py-3 whitespace-nowrap">
                                            Descuentos predial
                                        </th>
                                        <th scope="col" class="px-6 py-3 whitespace-nowrap">
                                            Total Intereses Predial
                                        </th>
                                        <th  scope="col" class="px-6 py-3 whitespace-nowrap">
                                            Sobretasa Bomberil
                                        </th>
                                        <th  scope="col" class="px-6 py-3 whitespace-nowrap">
                                            Sobretasa Ambiental
                                        </th>
                                        <th  scope="col" class="px-6 py-3 whitespace-nowrap">
                                            Sobretasa intereses
                                        </th>
                                        <th  scope="col" class="px-6 py-3 whitespace-nowrap">
                                            Alumbrado
                                        </th>
                                        <th scope="col" class="px-6 py-3 whitespace-nowrap">
                                            Descuentos
                                        </th>
                                        <th scope="col" class="px-6 py-3 whitespace-nowrap">
                                            Valor Total
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="vigencia in vigencias" :key="vigencia.vigencia"  class="text-center bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                        <td class="w-4 p-4">
                                            <div class="flex items-center">
                                                <input id="checkbox-table-search-3" type="checkbox" :checked="vigencia.isSelected" @change="evt => updateCheckAll(evt, vigencia)" class="lg:w-4 lg:h-4 md:w-10 md:h-10 text-greenp1 bg-gray-100 border-gray-300 rounded focus:ring-greenp1 dark:focus:ring-greenp1 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                                <label for="checkbox-table-search-3" class="sr-only">checkbox</label>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ vigencia.vigencia }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ formatNumber(vigencia.valor_avaluo) }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ vigencia.tasa_por_mil }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ formatNumber(vigencia.predial) }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ formatNumber(vigencia.predial_intereses) }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ formatNumber(vigencia.predial_descuento_intereses) }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{formatNumber(vigencia.total_intereses)}}
                                        </td>
                                        <td  class="px-6 py-4">
                                            {{ vigencias[0].estatuto.bomberil ? formatNumber(vigencia.bomberil) : formatNumber(0) }}
                                        </td>
                                        <td  class="px-6 py-4">
                                            {{ vigencias[0].estatuto.bomberil ? formatNumber(vigencia.ambiental) : formatNumber(0) }}
                                        </td>
                                        <td  class="px-6 py-4">
                                            {{ vigencias[0].estatuto.ambiental || vigencias[0].estatuto.bomberil ? formatNumber(vigencia.ambiental_intereses + vigencia.bomberil_intereses) : formatNumber(0) }}
                                        </td>
                                        <td  class="px-6 py-4">
                                            {{ vigencias[0].estatuto.alumbrado ? formatNumber(vigencia.alumbrado) : formatNumber(0) }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ formatNumber(vigencia.descuento_intereses) }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ formatNumber(vigencia.total_liquidacion) }}
                                        </td>
                                    </tr>
                                    <tr class="text-center font-bold text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                        <td colspan="2" class="px-2 py-4 text-bold whitespace-nowrap">
                                            Total avaluo
                                        </td>
                                        <td colspan="2" class="px-2 py-4 text-bold whitespace-nowrap">
                                            Total Predial
                                        </td>
                                        <td colspan="2"  class="px-2 py-4 text-bold whitespace-nowrap">
                                            Total Bomberil
                                        </td>

                                        <td colspan="2"  class="px-2 py-4 text-bold whitespace-nowrap">
                                            Total Ambiental
                                        </td>

                                        <td colspan="2"  class="px-2 py-4 text-bold whitespace-nowrap ">
                                            Total Alumbrado
                                        </td>

                                        <td   class="px-2 py-4 text-bold whitespace-nowrap">
                                            Total Intereses
                                        </td>

                                        <td   class="px-2 py-4 text-bold whitespace-nowrap">
                                            Total Descuento
                                        </td>
                                        <td colspan="2" class="px-2 py-4 text-bold dark:text-white whitespace-nowrap">
                                            Total Liquidación
                                        </td>
                                    </tr>
                                    <tr class="text-center border-b border-gray-200 dark:border-gray-700">
                                        <td  colspan="2" class="px-2 py-4 dark:bg-gray-800">
                                            <p class="px-5 py-2">{{ formatNumber(getTotal().total_avaluo) }}</p>
                                        </td>
                                        <td colspan="2" class="px-2 py-4 dark:bg-gray-800">
                                            <p class="px-5 py-2">{{ formatNumber(getTotal().predial) }}</p>
                                        </td>
                                        <td  colspan="2" class="px-2 py-4 dark:bg-gray-800">
                                            <p class="px-5 py-2">{{ predio !='' && vigencias[0].estatuto.bomberil ? formatNumber(getTotal().bomberil) : formatNumber(0) }}</p>
                                        </td>
                                        <td colspan="2" class="px-2 py-4 dark:bg-gray-800">
                                            <p class="px-5 py-2">{{ predio !='' && vigencias[0].estatuto.ambiental ? formatNumber(getTotal().ambiental) : formatNumber(0) }}</p>
                                        </td>
                                        <td colspan="2"  class="px-2 py-4 dark:bg-gray-800">
                                            <p class="px-5 py-2">{{ predio !='' && vigencias[0].estatuto.alumbrado ? formatNumber(getTotal().alumbrado) : formatNumber(0) }}</p>
                                        </td>
                                        <td  class="px-2 py-4 dark:bg-gray-800">
                                            <p class="px-5 py-2 ">{{ formatNumber(getTotal().intereses) }}</p>
                                        </td>
                                        <td class="px-2 py-4  dark:bg-gray-800">
                                            <p class="px-5 py-2">{{ formatNumber(getTotal().descuentos) }}</p>
                                        </td>
                                        <td colspan="2" class="px-2 py-4 font-bold dark:bg-gray-800">
                                            <p class="px-5 py-2 dark:text-white">{{ formatNumber(getTotal().liquidacion) }}</p>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="hidden rounded-lg bg-gray-50 dark:bg-gray-800" id="recibos" role="tabpanel" aria-labelledby="recibos-tab">
                        <p class="lg:text-base md:text-3xl text-center dark:text-white">Haz click en cualquier recibo generado para volverlo a imprimir</p>
                        <div class="mt-3 relative overflow-auto shadow-md sm:rounded-lg max-h-96">
                            <table class="w-full lg:text-sm md:text-3xl text-center text-gray-500 dark:text-gray-400">
                                <thead class="text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 whitespace-nowrap">
                                            Nro
                                        </th>
                                        <th scope="col" class="px-6 py-3 whitespace-nowrap">
                                            Emisión
                                        </th>
                                        <th scope="col" class="px-6 py-3 whitespace-nowrap">
                                            Vencimiento
                                        </th>
                                        <th scope="col" class="px-6 py-3 whitespace-nowrap">
                                            Inicial
                                        </th>
                                        <th scope="col" class="px-6 py-3 whitespace-nowrap">
                                            Final
                                        </th>
                                        <th scope="col" class="px-6 py-3 whitespace-nowrap">
                                            Total
                                        </th>
                                        <th scope="col" class="px-6 py-3 whitespace-nowrap">
                                            Estado de pago
                                        </th>
                                    </tr>
                                </thead>
                                <tbody v-if="predio != '' && facturasGeneradas.length > 0">
                                    <tr v-for="factura in facturasGeneradas" :key="factura.id" @click="showRecibo(factura.id)" class="cursor-pointer bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">

                                        <td class="px-6 py-4">
                                            {{ factura.id }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ dateIsoToGregorian(factura.created_at) }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ dateIsoToGregorian(factura.data.pague_hasta) }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ factura.data.facturado_desde }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ factura.data.facturado_hasta }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ formatNumber(factura.data.totales.liquidacion) }}
                                        </td>
                                        <td class="px-6 py-4 text-center">
                                            <span v-if="factura.data.factura_pagada" class="bg-green-500 text-white lg:text-xs md:text-2xl font-medium me-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">Pagado</span>
                                            <span v-else class="bg-red-500 text-white lg:text-xs md:text-2xl font-medium me-2 px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300">Sin pagar</span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-20">
                <h3 class="text-xl md:text-3xl text-center font-medium text-gray-900 dark:text-white mb-8 mt-5">También te puede interesar</h3>
                <CardImpuestos :tenant="tenant" :login ="login" :showModal="showModal" :hideModal="hideModal"/>
            </div>
        </div>
    </Layout>
</template>

<script setup>
import Layout from './Layout.vue'
import { ref, computed, onMounted } from 'vue'
import { router } from '@inertiajs/vue3'
import ModalPse from './Components/ModalPse.vue'
import axios from 'axios'
import { Dismiss } from 'flowbite'
import CardImpuestos from './Components/CardImpuestos.vue';
import { loadScript } from "vue-plugin-load-script";


const props = defineProps({ tenant: Object, predios: Object, predio: Object})
let btnPayment=ref(null);
const isCheckAll = ref(true)
const alertText = ref("");
const integrity = ref("");
let alertTimeOut;
let predio = props.predio
let vigencias = predio.liquidacion?.vigencias ?? []
const facturasGeneradas = computed(() => props.predio?.factura_predials ?? [])
let checkout = {};

async function sha256(message) {

    // encode as UTF-8
    const msgBuffer = new TextEncoder().encode(message);

    // hash the message
    const hashBuffer = await crypto.subtle.digest('SHA-256', msgBuffer);

    // convert ArrayBuffer to Array
    const hashArray = Array.from(new Uint8Array(hashBuffer));

    // convert bytes to hex string
    integrity.value = hashArray.map(b => b.toString(16).padStart(2, '0')).join('');
}

function makeid(length) {
    let result = '';
    const characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    const charactersLength = characters.length;
    let counter = 0;
    while (counter < length) {
      result += characters.charAt(Math.floor(Math.random() * charactersLength));
      counter += 1;
    }
    return result;
}

function showWompi(){
    loadScript("https://checkout.wompi.co/widget.js")
    .then(() => {
            let currency = 'COP'
            let total = parseInt(getTotal().liquidacion+'00');
            let reference = makeid(7);
            let sign = 'test_integrity_MMP9tGxP6fm0LlwG4DKrflQjBedHBRZW';
            let concatString = new String(reference+total+currency+sign);
            sha256(concatString);
            checkout = new WidgetCheckout({
                currency: 'COP',
                amountInCents: total,
                reference: reference,
                publicKey: 'pub_test_a0o6QsjxremuUDqHpdVKzNbjqns4EL7p',
                signature: { integrity: integrity.value },
                redirectUrl: route('public.pago_confirmado'),
                taxInCents: {
                vat: 1900,
                consumption: 800,
                }
            });
            checkout.open(function ( result ) {
                console.log(result.transaction);
                console.log(result.id)
            })
        })
    .catch(function(e){
        console.log(e);
    });

}
onMounted(() => {
    isCheckAll.value = true
    vigencias.forEach(vigencia => vigencia.isSelected = true)
})
function showRecibo(id){
    let factura = {};
    facturasGeneradas.value.forEach(fa => {
        if(fa.id == id){
            factura = fa;
            return;
        }
    });
    let horaActual = new Date();
    let dateVencimiento = new Date(factura.data.pague_hasta);
    let dateActual =new Date();
    dateVencimiento.setHours(23,59,0,0)
    dateActual.setHours(horaActual.getHours(), horaActual.getMinutes(),0,0);
    if(factura.data.factura_pagada){
        window.clearTimeout(alertTimeOut)
        hideAlert("La factura ya está pagada");
        return false;
    }else if(dateActual > dateVencimiento){
        window.clearTimeout(alertTimeOut)
        hideAlert("La factura ya está vencida");
        return false;
    }
    window.open(route('public.factura_predials.show', { factura_predial: id }), '_blank')
}
function hideAlert(text){
    alertText.value = text;
    alertTimeOut = window.setTimeout(function(){
        alertText.value = "";
    },3000)


}
function dateIsoToGregorian(date){
    if(date !==undefined){
        date = date.substring(0,10);
        date = date.split("-");
        date = date[2]+"/"+date[1]+"/"+date[0];
    }
    return date;
}
function createEstadoCuenta() {
    predio.totales = getTotal(true);
    predio.factura_predials = undefined

    axios.post(route('public.estado_cuentas.store'), { data: predio })
    .then(res => {
        window.open(route('public.estado_cuentas.show', { estado_cuenta: res.data.id }), '_blank')
    })
}
function createPazSalvo(){
    window.open(route('public.paz_salvos'));
}
function createRecibo() {
    let periodosFacturados = vigencias.filter(vigencia => vigencia.isSelected);
    periodosFacturados = periodosFacturados.reverse()
    predio.totales = getTotal()
    predio.factura_pagada = false
    predio.facturado_desde = periodosFacturados[0].vigencia
    predio.facturado_hasta = periodosFacturados[periodosFacturados.length-1].vigencia;
    predio.factura_predials = undefined;

    axios.post(route('public.factura_predials.store'), { data: predio })
    .then(res => {
        window.open(route('public.factura_predials.show', { factura_predial: res.data.id }), '_blank')
    })
}

function search(evt) {
    router.get(route('public.impuesto_predial_unificado'), { search: evt.target.value }, { preserveState: true })
}

function show(predio_id) {
    router.get(route('public.impuesto_predial_unificado'), { predio_id: predio_id })
}

function formatNumber(value){
    let number = isNaN(value) ? 0 : value

    if (number < 0 ) {
        number = Math.abs(number)
        number = '- $' + new Intl.NumberFormat('es-co').format(number)
    } else {
        number = '$' + new Intl.NumberFormat('es-co').format(number)
    }

    return number
}

async function updateCheckAll(evt, vigencia) {
    if (evt.target.id === 'checkbox-table-search-all') {
        isCheckAll.value = evt.target.checked
        vigencias.forEach(vigencia => vigencia.isSelected = evt.target.checked)
    } else {
        vigencia.isSelected = evt.target.checked

        if (!evt.target.checked) {
            isCheckAll.value = false
        } else if (vigencias.every(vigencia => vigencia.isSelected)) {
            isCheckAll.value = true
        }
    }
}

function getTotal(bypass = false) {
    let result = {
        'bomberil': 0,
        'alumbrado': 0,
        'ambiental': 0,
        'intereses': 0,
        'descuentos': 0,
        'liquidacion': 0,
        'predial': 0,
        'total_avaluo': 0
    }

    if(vigencias.length > 0) {
        vigencias.filter(vigencia => bypass || vigencia.isSelected).forEach(vigencia => {
            result.bomberil += vigencia.bomberil
            result.alumbrado += vigencia.alumbrado
            result.ambiental += vigencia.ambiental
            result.intereses += vigencia.total_intereses
            result.descuentos += vigencia.descuento_intereses
            result.liquidacion += vigencia.total_liquidacion
            result.predial += vigencia.predial
            result.total_avaluo += vigencia.valor_avaluo
        })
    }

    return result
}
</script>
