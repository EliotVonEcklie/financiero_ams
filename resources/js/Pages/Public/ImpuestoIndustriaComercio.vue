<template>
    <Layout :tenant="tenant" v-slot="{ login, showModal, hideModal }">
    <ModalDireccion @getAddress="data => { updateAddress(data); hideModal('modalDireccion') }" :hideModal="hideModal" />
        <div class="xl:mt-24 xl:p-10 md:mt-48 mx-auto container">
            <div>
                <h1 class="text-2xl md:text-5xl text-center font-medium text-gray-900 dark:text-white mb-8 mt-5">Impuesto industria y comercio</h1>
                <ol ref="stepper" id="inscripcion" class="flex items-center w-full p-3 space-x-2 lg:text-sm md:text-3xl gap-3  md:flex-wrap md:items-center font-medium text-center text-gray-500 bg-white border border-gray-200 rounded-lg shadow-sm dark:text-gray-400 sm:text-base dark:bg-gray-800 dark:border-gray-700 sm:p-4 sm:space-x-4 rtl:space-x-reverse">
                    <li class="flex items-center">
                        <span class="flex items-center justify-center w-5 h-5 me-2 text-xs border rounded-full shrink-0">
                            1
                        </span>
                        Inicio
                        <svg class="w-3 h-3 ms-2 sm:ms-4 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 12 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m7 9 4-4-4-4M1 9l4-4-4-4"/>
                        </svg>
                    </li>
                    <li class="flex items-center">
                        <span class="flex items-center justify-center w-5 h-5 me-2 text-xs border rounded-full shrink-0">
                            2
                        </span>
                        Contribuyente
                        <svg class="w-3 h-3 ms-2 sm:ms-4 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 12 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m7 9 4-4-4-4M1 9l4-4-4-4"/>
                        </svg>
                    </li>
                    <li class="flex items-center">
                        <span   class=" flex items-center justify-center w-5 h-5 me-2 text-xs border rounded-full shrink-0 ">
                            3
                        </span>
                        Base gravable
                        <svg class="w-3 h-3 ms-2 sm:ms-4 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 12 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m7 9 4-4-4-4M1 9l4-4-4-4"/>
                        </svg>
                    </li>
                    <li  class="flex items-center">
                        <span   class=" flex items-center justify-center w-5 h-5 me-2 text-xs border rounded-full shrink-0 ">
                            4
                        </span>
                        Actividades gravables
                        <svg class="w-3 h-3 ms-2 sm:ms-4 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 12 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m7 9 4-4-4-4M1 9l4-4-4-4"/>
                        </svg>
                    </li>
                    <li  class="flex items-center">
                        <span   class=" flex items-center justify-center w-5 h-5 me-2 text-xs border rounded-full shrink-0 ">
                            5
                        </span>
                        Liquidación privada
                        <svg class="w-3 h-3 ms-2 sm:ms-4 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 12 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m7 9 4-4-4-4M1 9l4-4-4-4"/>
                        </svg>
                    </li>
                </ol>
                <div ref="pages">
                    <form  class="w-full mt-10">
                        <div>
                            <div class="grid lg:grid-cols-4 lg:gap-4 md:grid-cols-1">
                                <div class="relative z-0 w-full mb-5 group">
                                    <label for="underline_select" class="sr-only">Tipo de documento</label>
                                    <select id="underline_select" class="block py-2.5 px-0 w-full lg:text-sm md:text-3xl text-gray-500 bg-transparent border-0 border-b-2 border-gray-200 appearance-none dark:text-gray-400 dark:border-gray-700 focus:outline-none focus:ring-0 focus:border-gray-200 peer">
                                        <option selected>Seleccione tipo de documento</option>
                                        <option value="1">Cédula de ciudadania</option>
                                        <option value="2">Cédula extranjera</option>
                                        <option value="3">NIT</option>
                                        <option value="4">Pasaporte</option>
                                        <option value="5">Tarjeta de identidad</option>

                                    </select>
                                </div>
                                <div class="relative z-0 w-full mb-5 group">
                                    <input type="text" class="block py-2.5 px-0 w-full lg:text-sm md:text-3xl text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                                    <label for="floating_first_name" class="peer-focus:font-medium absolute lg:text-sm md:text-3xl text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">No. de Documento</label>
                                </div>
                                <div class="relative z-0 w-full mb-5 group">
                                    <input type="text" class="block py-2.5 px-0 w-full lg:text-sm md:text-3xl text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                                    <label for="floating_last_name" class="peer-focus:font-medium absolute lg:text-sm md:text-3xl text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">D.V</label>
                                </div>
                                <div class="relative z-0 w-full mb-5 group">
                                    <input type="text" class="block py-2.5 px-0 w-full lg:text-sm md:text-3xl text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                                    <label for="floating_last_name" class="peer-focus:font-medium absolute lg:text-sm md:text-3xl text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Nombres y apellidos</label>
                                </div>
                            </div>
                        </div>
                        <div>
                            <div class="grid lg:grid-cols-3 lg:gap-4 md:grid-cols-1">
                                <div class="relative z-0 w-full mb-5 group">
                                    <label for="underline_select" class="sr-only">Departamento</label>
                                    <select class="block py-2.5 px-0 w-full lg:text-sm md:text-3xl text-gray-500 bg-transparent border-0 border-b-2 border-gray-200 appearance-none dark:text-gray-400 dark:border-gray-700 focus:outline-none focus:ring-0 focus:border-gray-200 peer">
                                        <option selected>Seleccione departamento</option>
                                        <option value="1">Departamento</option>
                                        <option value="2">Departamento</option>
                                        <option value="3">Departamento</option>

                                    </select>
                                </div>
                                <div class="relative z-0 w-full mb-5 group">
                                    <label for="underline_select" class="sr-only">Municipio</label>
                                    <select class="block py-2.5 px-0 w-full lg:text-sm md:text-3xl text-gray-500 bg-transparent border-0 border-b-2 border-gray-200 appearance-none dark:text-gray-400 dark:border-gray-700 focus:outline-none focus:ring-0 focus:border-gray-200 peer">
                                        <option selected>Seleccione municipio</option>
                                        <option value="1">Municipio</option>
                                        <option value="2">Municipio</option>
                                        <option value="3">Municipio</option>
                                    </select>
                                </div>
                                <div class="relative z-0 w-full mb-5 group">
                                    <div class="relative w-full">
                                        <div class="flex">
                                            <input type="text" disabled class="block py-2.5 px-0 w-full lg:text-sm md:text-3xl text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" :value="txtDireccion" required />
                                            <label for="floating_first_name" class="peer-focus:font-medium absolute lg:text-sm md:text-3xl text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Dirección</label>
                                            <button type="button" @click="showModal('modalDireccion')" class="p-2.5 ms-2 text-sm font-medium text-blue-600  bg-white border-blue-600 hover:text-white hover:bg-blue-600 rounded-lg border dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                                <svg class="lg:w-4 lg:h-4 md:w-7 md:h-7" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                                </svg>
                                                <span class="sr-only">Search</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="grid lg:grid-cols-4 lg:gap-4 md:grid-cols-1">
                                <div class="relative z-0 w-full mb-5 group">
                                    <input type="email" class="block py-2.5 px-0 w-full lg:text-sm md:text-3xl text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                                    <label for="floating_last_name" class="peer-focus:font-medium absolute lg:text-sm md:text-3xl text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Correo</label>
                                </div>
                                <div class="relative z-0 w-full mb-5 group">
                                    <input type="text" class="block py-2.5 px-0 w-full lg:text-sm md:text-3xl text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                                    <label for="floating_last_name" class="peer-focus:font-medium absolute lg:text-sm md:text-3xl text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Teléfono</label>
                                </div>
                                <div class="relative z-0 w-full mb-5 group">
                                    <input type="number" class="block py-2.5 px-0 w-full lg:text-sm md:text-3xl text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                                    <label for="floating_last_name" class="peer-focus:font-medium absolute lg:text-sm md:text-3xl text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Número de establecimientos</label>
                                </div>
                                <div class="relative z-0 w-full mb-5 group">
                                    <label for="underline_select" class="sr-only">Clasificación de contribuyente</label>
                                    <select id="underline_select" class="block py-2.5 px-0 w-full lg:text-sm md:text-3xl text-gray-500 bg-transparent border-0 border-b-2 border-gray-200 appearance-none dark:text-gray-400 dark:border-gray-700 focus:outline-none focus:ring-0 focus:border-gray-200 peer">
                                        <option selected>Seleccione clasificación de contribuyente</option>
                                        <option value="1">Común</option>
                                        <option value="2">Simplificado</option>
                                        <option value="3">Contribuyente</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="flex justify-end items-center space-x-2">
                            <div class="flex items-center">
                                <input id="default-radio-1" type="radio" value="" name="default-radio" class="lg:w-4 lg:h-4 md:w-8 md:h-8 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                <label for="default-radio-1" class="ms-2 lg:text-sm md:text-3xl font-medium text-gray-900 dark:text-gray-300">Es consorcio o unión temporal</label>
                            </div>
                            <div class="flex items-center">
                                <input checked id="default-radio-2" type="radio" value="" name="default-radio" class="lg:w-4 lg:h-4 md:w-8 md:h-8 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                <label for="default-radio-2" class="ms-2 lg:text-sm md:text-3xl font-medium text-gray-900 dark:text-gray-300">Realiza Actividades a Través de Patrimonio Autónomo</label>
                            </div>
                        </div>
                    </form>
                    <form  class="w-full mt-10">
                        <div>
                            <div class="grid lg:grid-cols-4 lg:gap-4 md:grid-cols-1">
                                <div class="relative z-0 w-full mb-5 group">
                                    <label for="underline_select" class="sr-only">Tipo de documento</label>
                                    <select id="underline_select" class="block py-2.5 px-0 w-full lg:text-sm md:text-3xl text-gray-500 bg-transparent border-0 border-b-2 border-gray-200 appearance-none dark:text-gray-400 dark:border-gray-700 focus:outline-none focus:ring-0 focus:border-gray-200 peer">
                                        <option selected>Seleccione tipo de documento</option>
                                        <option value="1">Cédula de ciudadania</option>
                                        <option value="2">Cédula extranjera</option>
                                        <option value="3">NIT</option>
                                        <option value="4">Pasaporte</option>
                                        <option value="5">Tarjeta de identidad</option>

                                    </select>
                                </div>
                                <div class="relative z-0 w-full mb-5 group">
                                    <input type="text" class="block py-2.5 px-0 w-full lg:text-sm md:text-3xl text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                                    <label for="floating_first_name" class="peer-focus:font-medium absolute lg:text-sm md:text-3xl text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">No. de Documento</label>
                                </div>
                                <div class="relative z-0 w-full mb-5 group">
                                    <input type="text" class="block py-2.5 px-0 w-full lg:text-sm md:text-3xl text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                                    <label for="floating_last_name" class="peer-focus:font-medium absolute lg:text-sm md:text-3xl text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">D.V</label>
                                </div>
                                <div class="relative z-0 w-full mb-5 group">
                                    <input type="text" class="block py-2.5 px-0 w-full lg:text-sm md:text-3xl text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                                    <label for="floating_last_name" class="peer-focus:font-medium absolute lg:text-sm md:text-3xl text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Nombres y apellidos</label>
                                </div>
                            </div>
                        </div>
                        <div>
                            <div class="grid lg:grid-cols-3 lg:gap-4 md:grid-cols-1">
                                <div class="relative z-0 w-full mb-5 group">
                                    <label for="underline_select" class="sr-only">Departamento</label>
                                    <select class="block py-2.5 px-0 w-full lg:text-sm md:text-3xl text-gray-500 bg-transparent border-0 border-b-2 border-gray-200 appearance-none dark:text-gray-400 dark:border-gray-700 focus:outline-none focus:ring-0 focus:border-gray-200 peer">
                                        <option selected>Seleccione departamento</option>
                                        <option value="1">Departamento</option>
                                        <option value="2">Departamento</option>
                                        <option value="3">Departamento</option>

                                    </select>
                                </div>
                                <div class="relative z-0 w-full mb-5 group">
                                    <label for="underline_select" class="sr-only">Municipio</label>
                                    <select class="block py-2.5 px-0 w-full lg:text-sm md:text-3xl text-gray-500 bg-transparent border-0 border-b-2 border-gray-200 appearance-none dark:text-gray-400 dark:border-gray-700 focus:outline-none focus:ring-0 focus:border-gray-200 peer">
                                        <option selected>Seleccione municipio</option>
                                        <option value="1">Municipio</option>
                                        <option value="2">Municipio</option>
                                        <option value="3">Municipio</option>
                                    </select>
                                </div>
                                <div class="relative z-0 w-full mb-5 group">
                                    <div class="relative w-full">
                                        <div class="flex">
                                            <input type="text" disabled class="block py-2.5 px-0 w-full lg:text-sm md:text-3xl text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" :value="txtDireccion" required />
                                            <label for="floating_first_name" class="peer-focus:font-medium absolute lg:text-sm md:text-3xl text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Dirección</label>
                                            <button type="button" @click="showModal('modalDireccion')" class="p-2.5 ms-2 text-sm font-medium text-blue-600  bg-white border-blue-600 hover:text-white hover:bg-blue-600 rounded-lg border dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                                <svg class="lg:w-4 lg:h-4 md:w-7 md:h-7" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                                </svg>
                                                <span class="sr-only">Search</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="grid lg:grid-cols-4 lg:gap-4 md:grid-cols-1">
                                <div class="relative z-0 w-full mb-5 group">
                                    <input type="email" class="block py-2.5 px-0 w-full lg:text-sm md:text-3xl text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                                    <label for="floating_last_name" class="peer-focus:font-medium absolute lg:text-sm md:text-3xl text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Correo</label>
                                </div>
                                <div class="relative z-0 w-full mb-5 group">
                                    <input type="text" class="block py-2.5 px-0 w-full lg:text-sm md:text-3xl text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                                    <label for="floating_last_name" class="peer-focus:font-medium absolute lg:text-sm md:text-3xl text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Teléfono</label>
                                </div>
                                <div class="relative z-0 w-full mb-5 group">
                                    <input type="number" class="block py-2.5 px-0 w-full lg:text-sm md:text-3xl text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                                    <label for="floating_last_name" class="peer-focus:font-medium absolute lg:text-sm md:text-3xl text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Número de establecimientos</label>
                                </div>
                                <div class="relative z-0 w-full mb-5 group">
                                    <label for="underline_select" class="sr-only">Clasificación de contribuyente</label>
                                    <select id="underline_select" class="block py-2.5 px-0 w-full lg:text-sm md:text-3xl text-gray-500 bg-transparent border-0 border-b-2 border-gray-200 appearance-none dark:text-gray-400 dark:border-gray-700 focus:outline-none focus:ring-0 focus:border-gray-200 peer">
                                        <option selected>Seleccione clasificación de contribuyente</option>
                                        <option value="1">Común</option>
                                        <option value="2">Simplificado</option>
                                        <option value="3">Contribuyente</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="flex justify-end items-center space-x-2">
                            <div class="flex items-center">
                                <input id="default-radio-1" type="radio" value="" name="default-radio" class="lg:w-4 lg:h-4 md:w-8 md:h-8 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                <label for="default-radio-1" class="ms-2 lg:text-sm md:text-3xl font-medium text-gray-900 dark:text-gray-300">Es consorcio o unión temporal</label>
                            </div>
                            <div class="flex items-center">
                                <input checked id="default-radio-2" type="radio" value="" name="default-radio" class="lg:w-4 lg:h-4 md:w-8 md:h-8 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                <label for="default-radio-2" class="ms-2 lg:text-sm md:text-3xl font-medium text-gray-900 dark:text-gray-300">Realiza Actividades a Través de Patrimonio Autónomo</label>
                            </div>
                        </div>
                    </form>
                    <form  class="w-full mt-10">
                        <div class="mb-1 flex justify-between items-center lg:space-y-0 lg:flex-row md:flex-col md:space-y-3">
                            <p class="w-full lg:text-sm md:text-3xl">Total ingresos ordinarios y extraordinarios del periodo en todo el país:</p>
                            <div class="relative z-0 w-full mb-5 group">
                                <div class="relative">
                                    <div class="absolute inset-y-0 start-0 top-0 flex items-center ps-3.5 pointer-events-none">
                                        <svg class="lg:w-4 lg:h-4 md:w-7 md:h-7 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 17.3a5 5 0 0 0 2.6 1.7c2.2.6 4.5-.5 5-2.3.4-2-1.3-4-3.6-4.5-2.3-.6-4-2.7-3.5-4.5.5-1.9 2.7-3 5-2.3 1 .2 1.8.8 2.5 1.6m-3.9 12v2m0-18v2.2"/>
                                        </svg>
                                    </div>
                                    <input type="number"  v-model="intTotalPeriodo" class="bg-gray-50 border border-gray-300 text-gray-900 lg:text-sm md:text-3xl rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="0.00" required>
                                </div>
                            </div>
                        </div>
                        <div class="mb-1 flex justify-between items-center lg:space-y-0 lg:flex-row md:flex-col md:space-y-3">
                            <p class="w-full lg:text-sm md:text-3xl">Menos Ingresos Fuera de Este Municipio o Distrito:</p>
                            <div class="relative z-0 w-full mb-5 group">
                                <div class="relative">
                                    <div class="absolute inset-y-0 start-0 top-0 flex items-center ps-3.5 pointer-events-none">
                                        <svg class="lg:w-4 lg:h-4 md:w-7 md:h-7 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 17.3a5 5 0 0 0 2.6 1.7c2.2.6 4.5-.5 5-2.3.4-2-1.3-4-3.6-4.5-2.3-.6-4-2.7-3.5-4.5.5-1.9 2.7-3 5-2.3 1 .2 1.8.8 2.5 1.6m-3.9 12v2m0-18v2.2"/>
                                        </svg>
                                    </div>
                                    <input type="number"  v-model="intIngresoFuera" class="bg-gray-50 border border-gray-300 text-gray-900 lg:text-sm md:text-3xl rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"  required>
                                </div>
                            </div>
                        </div>
                        <div class="mb-1 flex justify-between items-center lg:space-y-0 lg:flex-row md:flex-col md:space-y-3">
                            <p class="w-full lg:text-sm md:text-3xl">Total Ingresos Ordinarios y Extraordinarios en Este Municipio:</p>
                            <div class="relative z-0 w-full mb-5 group">
                                <div class="relative">
                                    <div class="absolute inset-y-0 start-0 top-0 flex items-center ps-3.5 pointer-events-none">
                                        <svg class="lg:w-4 lg:h-4 md:w-7 md:h-7 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 17.3a5 5 0 0 0 2.6 1.7c2.2.6 4.5-.5 5-2.3.4-2-1.3-4-3.6-4.5-2.3-.6-4-2.7-3.5-4.5.5-1.9 2.7-3 5-2.3 1 .2 1.8.8 2.5 1.6m-3.9 12v2m0-18v2.2"/>
                                        </svg>
                                    </div>
                                    <input type="text"  :value="intTotalFormat" class="cursor-not-allowed bg-gray-50 border border-gray-300 text-gray-900 lg:text-sm md:text-3xl rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="0.00" disabled required>
                                </div>
                            </div>
                        </div>
                        <div class="mb-1 flex justify-between items-center lg:space-y-0 lg:flex-row md:flex-col md:space-y-3">
                            <p class="w-full lg:text-sm md:text-3xl">Menos Ingresos Por Devolución, Rebajas, Descuentos:</p>
                            <div class="relative z-0 w-full mb-5 group">
                                <div class="relative">
                                    <div class="absolute inset-y-0 start-0 top-0 flex items-center ps-3.5 pointer-events-none">
                                        <svg class="lg:w-4 lg:h-4 md:w-7 md:h-7 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 17.3a5 5 0 0 0 2.6 1.7c2.2.6 4.5-.5 5-2.3.4-2-1.3-4-3.6-4.5-2.3-.6-4-2.7-3.5-4.5.5-1.9 2.7-3 5-2.3 1 .2 1.8.8 2.5 1.6m-3.9 12v2m0-18v2.2"/>
                                        </svg>
                                    </div>
                                    <input type="number"  v-model="intIngresoDescuento" class="bg-gray-50 border border-gray-300 text-gray-900 lg:text-sm md:text-3xl rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="0.00" required>
                                </div>
                            </div>
                        </div>
                        <div class="mb-1 flex justify-between items-center lg:space-y-0 lg:flex-row md:flex-col md:space-y-3">
                            <p class="w-full lg:text-sm md:text-3xl">Menos Ingresos Por Exportaciones:</p>
                            <div class="relative z-0 w-full mb-5 group">
                                <div class="relative">
                                    <div class="absolute inset-y-0 start-0 top-0 flex items-center ps-3.5 pointer-events-none">
                                        <svg class="lg:w-4 lg:h-4 md:w-7 md:h-7 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 17.3a5 5 0 0 0 2.6 1.7c2.2.6 4.5-.5 5-2.3.4-2-1.3-4-3.6-4.5-2.3-.6-4-2.7-3.5-4.5.5-1.9 2.7-3 5-2.3 1 .2 1.8.8 2.5 1.6m-3.9 12v2m0-18v2.2"/>
                                        </svg>
                                    </div>
                                    <input type="number"  v-model="intIngresoExportacion" class="bg-gray-50 border border-gray-300 text-gray-900 lg:text-sm md:text-3xl rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="0.00" required>
                                </div>
                            </div>
                        </div>
                        <div class="mb-1 flex justify-between items-center lg:space-y-0 lg:flex-row md:flex-col md:space-y-3">
                            <p class="w-full lg:text-sm md:text-3xl">Menos Ingresos Por Venta de Activos Fijos:</p>
                            <div class="relative z-0 w-full mb-5 group">
                                <div class="relative">
                                    <div class="absolute inset-y-0 start-0 top-0 flex items-center ps-3.5 pointer-events-none">
                                        <svg class="lg:w-4 lg:h-4 md:w-7 md:h-7 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 17.3a5 5 0 0 0 2.6 1.7c2.2.6 4.5-.5 5-2.3.4-2-1.3-4-3.6-4.5-2.3-.6-4-2.7-3.5-4.5.5-1.9 2.7-3 5-2.3 1 .2 1.8.8 2.5 1.6m-3.9 12v2m0-18v2.2"/>
                                        </svg>
                                    </div>
                                    <input type="number"  v-model="intIngresoVenta" class="bg-gray-50 border border-gray-300 text-gray-900 lg:text-sm md:text-3xl rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="0.00" required>
                                </div>
                            </div>
                        </div>
                        <div class="mb-1 flex justify-between items-center lg:space-y-0 lg:flex-row md:flex-col md:space-y-3">
                            <p class="w-full lg:text-sm md:text-3xl">Menos Ingresos Por Actividades Excluidas o No Sujetas y Otros Ingresos No Gravados:</p>
                            <div class="relative z-0 w-full mb-5 group">
                                <div class="relative">
                                    <div class="absolute inset-y-0 start-0 top-0 flex items-center ps-3.5 pointer-events-none">
                                        <svg class="lg:w-4 lg:h-4 md:w-7 md:h-7 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 17.3a5 5 0 0 0 2.6 1.7c2.2.6 4.5-.5 5-2.3.4-2-1.3-4-3.6-4.5-2.3-.6-4-2.7-3.5-4.5.5-1.9 2.7-3 5-2.3 1 .2 1.8.8 2.5 1.6m-3.9 12v2m0-18v2.2"/>
                                        </svg>
                                    </div>
                                    <input type="number"  v-model="intIngresoActividades" class="bg-gray-50 border border-gray-300 text-gray-900 lg:text-sm md:text-3xl rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="0.00" required>
                                </div>
                            </div>
                        </div>
                        <div class="mb-1 flex justify-between items-center lg:space-y-0 lg:flex-row md:flex-col md:space-y-3">
                            <p class="w-full lg:text-sm md:text-3xl">Menos Ingresos Por Otras Actividades Exentas En Este Municipio o Distrito (Por Acuerdo):</p>
                            <div class="relative z-0 w-full mb-5 group">
                                <div class="relative">
                                    <div class="absolute inset-y-0 start-0 top-0 flex items-center ps-3.5 pointer-events-none">
                                        <svg class="lg:w-4 lg:h-4 md:w-7 md:h-7 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 17.3a5 5 0 0 0 2.6 1.7c2.2.6 4.5-.5 5-2.3.4-2-1.3-4-3.6-4.5-2.3-.6-4-2.7-3.5-4.5.5-1.9 2.7-3 5-2.3 1 .2 1.8.8 2.5 1.6m-3.9 12v2m0-18v2.2"/>
                                        </svg>
                                    </div>
                                    <input type="number"  v-model="intIngresoExentas" class="bg-gray-50 border border-gray-300 text-gray-900 lg:text-sm md:text-3xl rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="0.00" required>
                                </div>
                            </div>
                        </div>
                        <div class="mb-1 flex justify-between items-center lg:space-y-0 lg:flex-row md:flex-col md:space-y-3">
                            <p class="w-full lg:text-sm md:text-3xl fw-bold">Total ingresos gravables:</p>
                            <div class="relative z-0 w-full mb-5 group">
                                <div class="relative">
                                    <div class="absolute inset-y-0 start-0 top-0 flex items-center ps-3.5 pointer-events-none">
                                        <svg class="lg:w-4 lg:h-4 md:w-7 md:h-7 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 17.3a5 5 0 0 0 2.6 1.7c2.2.6 4.5-.5 5-2.3.4-2-1.3-4-3.6-4.5-2.3-.6-4-2.7-3.5-4.5.5-1.9 2.7-3 5-2.3 1 .2 1.8.8 2.5 1.6m-3.9 12v2m0-18v2.2"/>
                                        </svg>
                                    </div>
                                    <input type="text" :value="intTotalGravableFormat" class="cursor-not-allowed bg-gray-50 border border-gray-300 text-gray-900 lg:text-sm md:text-3xl rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="0.00" disabled required>
                                </div>
                            </div>
                        </div>
                    </form>
                    <form  class="w-full mt-10">
                        <div class="grid lg:grid-cols-4 md:grid-cols-1 mb-4 lg:space-x-2 md:space-x-0 lg:space-y-0 md:space-y-2">
                            <div>
                                <label  class="block mb-2 lg:text-sm md:text-3xl font-medium text-gray-900 dark:text-white">Actividad</label>
                                <select  class="bg-gray-50 border border-gray-300 text-gray-900 lg:text-sm md:text-3xl rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option selected>Seleccione una actividad</option>
                                    <option value="102">
                                        102-Producción y tansformación de alimentos
                                    </option>
                                    <option value="103">
                                        103-Demás actividades industriales no clasificadas previamente
                                    </option>
                                    <option value="201">
                                        201-Comercio de alimentos, abarrotes y supermercados; agrícolas e insumos agrícolas
                                    </option>
                                </select>
                            </div>
                            <div>
                                <label class="block mb-2 lg:text-sm md:text-3xl font-medium text-gray-900 dark:text-white">Ingresos gravados</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 start-0 top-0 flex items-center ps-3.5 pointer-events-none">
                                        <svg class="lg:w-4 lg:h-4 md:w-7 md:h-7 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 17.3a5 5 0 0 0 2.6 1.7c2.2.6 4.5-.5 5-2.3.4-2-1.3-4-3.6-4.5-2.3-.6-4-2.7-3.5-4.5.5-1.9 2.7-3 5-2.3 1 .2 1.8.8 2.5 1.6m-3.9 12v2m0-18v2.2"/>
                                        </svg>
                                    </div>
                                    <input type="number"  v-model="intTotalIngresosGravados"  class="bg-gray-50 border border-gray-300 text-gray-900 lg:text-sm md:text-3xl rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="0.00" required>
                                </div>
                            </div>
                            <div>
                                <label class="block mb-2 lg:text-sm md:text-3xl font-medium text-gray-900 dark:text-white">Tasa x mil</label>
                                <input type="text" value="5" disabled class="bg-gray-50 border border-gray-300 text-gray-900 lg:text-sm md:text-3xl rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"  required>
                            </div>
                            <div>
                                <label class="block mb-2 lg:text-sm md:text-3xl font-medium text-gray-900 dark:text-white">Impuesto</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 start-0 top-0 flex items-center ps-3.5 pointer-events-none">
                                        <svg class="lg:w-4 lg:h-4 md:w-7 md:h-7 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 17.3a5 5 0 0 0 2.6 1.7c2.2.6 4.5-.5 5-2.3.4-2-1.3-4-3.6-4.5-2.3-.6-4-2.7-3.5-4.5.5-1.9 2.7-3 5-2.3 1 .2 1.8.8 2.5 1.6m-3.9 12v2m0-18v2.2"/>
                                        </svg>
                                    </div>
                                    <input type="number"  value="0" class="cursor-not-allowed bg-gray-50 border border-gray-300 text-gray-900 lg:text-sm md:text-3xl rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" disabled required>
                                </div>
                            </div>
                        </div>
                        <fwb-accordion>
                            <fwb-accordion-panel>
                                <fwb-accordion-header class="text-gray-700 bg-gray-200">Otras actividades</fwb-accordion-header>
                                <fwb-accordion-content>
                                    <div  v-for="actividad in arrActividad" :key="actividad.id" class="grid lg:grid-cols-4 md:grid-cols-1 mb-4 lg:space-x-2 md:space-x-0 lg:space-y-0 md:space-y-2">
                                        <div>
                                            <label  class="block mb-2 lg:text-sm md:text-3xl font-medium text-gray-900 dark:text-white">Actividad</label>
                                            <select  class="bg-gray-50 border border-gray-300 text-gray-900 lg:text-sm md:text-3xl rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                                <option selected>Seleccione una actividad</option>
                                                <option value="102">
                                                    102-Producción y tansformación de alimentos
                                                </option>
                                                <option value="103">
                                                    103-Demás actividades industriales no clasificadas previamente
                                                </option>
                                                <option value="201">
                                                    201-Comercio de alimentos, abarrotes y supermercados; agrícolas e insumos agrícolas
                                                </option>
                                            </select>
                                        </div>
                                        <div>
                                            <label class="block mb-2 lg:text-sm md:text-3xl font-medium text-gray-900 dark:text-white">Ingresos gravados</label>
                                            <div class="relative">
                                                <div class="absolute inset-y-0 start-0 top-0 flex items-center ps-3.5 pointer-events-none">
                                                    <svg class="lg:w-4 lg:h-4 md:w-7 md:h-7 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 17.3a5 5 0 0 0 2.6 1.7c2.2.6 4.5-.5 5-2.3.4-2-1.3-4-3.6-4.5-2.3-.6-4-2.7-3.5-4.5.5-1.9 2.7-3 5-2.3 1 .2 1.8.8 2.5 1.6m-3.9 12v2m0-18v2.2"/>
                                                    </svg>
                                                </div>
                                                <input type="number"  @input="setValueIngresos($event,actividad.id)"  class="bg-gray-50 border border-gray-300 text-gray-900 lg:text-sm md:text-3xl rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="0.00" required>
                                            </div>
                                        </div>
                                        <div>
                                            <label class="block mb-2 lg:text-sm md:text-3xl font-medium text-gray-900 dark:text-white">Tasa x mil</label>
                                            <input type="text" value="5" disabled class="bg-gray-50 border border-gray-300 text-gray-900 lg:text-sm md:text-3xl rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"  required>
                                        </div>
                                        <div>
                                            <label class="block mb-2 lg:text-sm md:text-3xl font-medium text-gray-900 dark:text-white">Impuesto</label>
                                            <div class="relative">
                                                <div class="absolute inset-y-0 start-0 top-0 flex items-center ps-3.5 pointer-events-none">
                                                    <svg class="lg:w-4 lg:h-4 md:w-7 md:h-7 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 17.3a5 5 0 0 0 2.6 1.7c2.2.6 4.5-.5 5-2.3.4-2-1.3-4-3.6-4.5-2.3-.6-4-2.7-3.5-4.5.5-1.9 2.7-3 5-2.3 1 .2 1.8.8 2.5 1.6m-3.9 12v2m0-18v2.2"/>
                                                    </svg>
                                                </div>
                                                <div class="flex justify-between">
                                                    <input type="number"  value="0" class="cursor-not-allowed bg-gray-50 border border-gray-300 text-gray-900 lg:text-sm md:text-3xl rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" disabled required>
                                                    <button type="button" @click="delActividad(actividad.id)" class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900"><svg fill="none" class="fill-white lg:w-4 lg:h-4 md:w-7 md:h-7" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M135.2 17.7L128 32H32C14.3 32 0 46.3 0 64S14.3 96 32 96H416c17.7 0 32-14.3 32-32s-14.3-32-32-32H320l-7.2-14.3C307.4 6.8 296.3 0 284.2 0H163.8c-12.1 0-23.2 6.8-28.6 17.7zM416 128H32L53.2 467c1.6 25.3 22.6 45 47.9 45H346.9c25.3 0 46.3-19.7 47.9-45L416 128z"/></svg></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flex justify-center">
                                        <button type="button" @click="addActividad" class="text-green-500  bg-white border border-green-500 hover:bg-green-500 hover:text-white font-medium rounded-lg lg:text-sm md:text-3xl px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Agregar actividad</button>
                                    </div>
                                </fwb-accordion-content>
                            </fwb-accordion-panel>
                        </fwb-accordion>
                        <div class="mt-5 relative overflow-x-auto">
                            <table class="w-full text-sm text-center text-gray-500 dark:text-gray-400">
                                <thead class="text-xs text-gray-700 uppercase bg-gray-200 dark:bg-gray-700 dark:text-gray-400">
                                    <tr>
                                        <th scope="col" class="px-6 py-3">
                                            El Total de Ingresos debe ser igual a:
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Total Ingresos:
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Total Impuesto:
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Generación de Energía / Capacidad Instalada:
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Impuesto Ley 56 1981:
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                        <td>
                                            ${{ formatNumber(intTotalGravable) }}
                                        </td>
                                        <td class="px-6 py-4">
                                            ${{ formatNumber(totalIngresosGravados) }}
                                        </td>
                                        <td class="px-6 py-4">
                                            ${{ formatNumber(0) }}
                                        </td>
                                        <td class="px-6 py-4">
                                            ${{ formatNumber(0) }}
                                        </td>
                                        <td class="px-6 py-4">
                                            ${{ formatNumber(0) }}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </form>
                    <form  class="w-full mt-10">
                        <fwb-accordion>
                            <fwb-accordion-panel>
                                <fwb-accordion-header class="text-gray-700 bg-gray-200">Impuesto a cargo</fwb-accordion-header>
                                <fwb-accordion-content>
                                    <div class="mb-3">
                                        <div class="mb-1 flex justify-between items-center lg:space-y-0 lg:flex-row md:flex-col md:space-y-3">
                                            <p class="w-full lg:text-sm md:text-3xl">Total Impuesto de Industria y Comercio:</p>
                                            <div class="relative z-0 w-full mb-5 group">
                                                <div class="relative">
                                                    <div class="absolute inset-y-0 start-0 top-0 flex items-center ps-3.5 pointer-events-none">
                                                        <svg class="lg:w-4 lg:h-4 md:w-7 md:h-7 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 17.3a5 5 0 0 0 2.6 1.7c2.2.6 4.5-.5 5-2.3.4-2-1.3-4-3.6-4.5-2.3-.6-4-2.7-3.5-4.5.5-1.9 2.7-3 5-2.3 1 .2 1.8.8 2.5 1.6m-3.9 12v2m0-18v2.2"/>
                                                        </svg>
                                                    </div>
                                                    <input type="number"  class="cursor-not-allowed bg-gray-50 border border-gray-300 text-gray-900 lg:text-sm md:text-3xl rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="0.00" disabled required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-1 flex justify-between items-center lg:space-y-0 lg:flex-row md:flex-col md:space-y-3">
                                            <div class="flex items-center space-x-2 w-full">
                                                <p class="lg:text-sm md:text-3xl">Impuesto de Avisos y Tableros 15%, ¿Tiene avisos? </p>
                                                <div class="flex items-center">
                                                    <input id="default-radio-1" type="radio" value="" name="default-radio" class="lg:w-4 lg:h-4 md:w-8 md:h-8 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                                    <label for="default-radio-1" class="ms-2 lg:text-sm md:text-3xl font-medium text-gray-900 dark:text-gray-300">Si</label>
                                                </div>
                                                <div class="flex items-center">
                                                    <input checked id="default-radio-2" type="radio" value="" name="default-radio" class="lg:w-4 lg:h-4 md:w-8 md:h-8 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                                    <label for="default-radio-2" class="ms-2 lg:text-sm md:text-3xl font-medium text-gray-900 dark:text-gray-300">No</label>
                                                </div>
                                            </div>
                                            <div class="relative z-0 w-full mb-5 group">
                                                <div class="relative">
                                                    <div class="absolute inset-y-0 start-0 top-0 flex items-center ps-3.5 pointer-events-none">
                                                        <svg class="lg:w-4 lg:h-4 md:w-7 md:h-7 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 17.3a5 5 0 0 0 2.6 1.7c2.2.6 4.5-.5 5-2.3.4-2-1.3-4-3.6-4.5-2.3-.6-4-2.7-3.5-4.5.5-1.9 2.7-3 5-2.3 1 .2 1.8.8 2.5 1.6m-3.9 12v2m0-18v2.2"/>
                                                        </svg>
                                                    </div>
                                                    <input type="number"  class="cursor-not-allowed bg-gray-50 border border-gray-300 text-gray-900 lg:text-sm md:text-3xl rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" disabled placeholder="0.00" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-1 flex justify-between items-center lg:space-y-0 lg:flex-row md:flex-col md:space-y-3">
                                            <p class="w-full lg:text-sm md:text-3xl">Pago Por Unidades Comerciales Adicionales del Sector Financiero:</p>
                                            <div class="relative z-0 w-full mb-5 group">
                                                <div class="relative">
                                                    <div class="absolute inset-y-0 start-0 top-0 flex items-center ps-3.5 pointer-events-none">
                                                        <svg class="lg:w-4 lg:h-4 md:w-7 md:h-7 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 17.3a5 5 0 0 0 2.6 1.7c2.2.6 4.5-.5 5-2.3.4-2-1.3-4-3.6-4.5-2.3-.6-4-2.7-3.5-4.5.5-1.9 2.7-3 5-2.3 1 .2 1.8.8 2.5 1.6m-3.9 12v2m0-18v2.2"/>
                                                        </svg>
                                                    </div>
                                                    <input type="number"  class="bg-gray-50 border border-gray-300 text-gray-900 lg:text-sm md:text-3xl rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="0.00" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-1 flex justify-between items-center lg:space-y-0 lg:flex-row md:flex-col md:space-y-3">
                                            <p class="w-full lg:text-sm md:text-3xl">Sobretasa Bomberil (Ley 1575 de 2012) (Si la hay, Liquídela Según el Acuerdo Municipal o Distrital):</p>
                                            <div class="relative z-0 w-full mb-5 group">
                                                <div class="relative">
                                                    <div class="absolute inset-y-0 start-0 top-0 flex items-center ps-3.5 pointer-events-none">
                                                        <svg class="lg:w-4 lg:h-4 md:w-7 md:h-7 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 17.3a5 5 0 0 0 2.6 1.7c2.2.6 4.5-.5 5-2.3.4-2-1.3-4-3.6-4.5-2.3-.6-4-2.7-3.5-4.5.5-1.9 2.7-3 5-2.3 1 .2 1.8.8 2.5 1.6m-3.9 12v2m0-18v2.2"/>
                                                        </svg>
                                                    </div>
                                                    <input type="number"  class="bg-gray-50 border border-gray-300 text-gray-900 lg:text-sm md:text-3xl rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="0.00" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-1 flex justify-between items-center lg:space-y-0 lg:flex-row md:flex-col md:space-y-3">
                                            <p class="w-full lg:text-sm md:text-3xl">Sobretasa de Seguridad (Ley 1421 de 2011) (Si la hay, Liquídela Según el Acuerdo Municipal o Distrital):</p>
                                            <div class="relative z-0 w-full mb-5 group">
                                                <div class="relative">
                                                    <div class="absolute inset-y-0 start-0 top-0 flex items-center ps-3.5 pointer-events-none">
                                                        <svg class="lg:w-4 lg:h-4 md:w-7 md:h-7 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 17.3a5 5 0 0 0 2.6 1.7c2.2.6 4.5-.5 5-2.3.4-2-1.3-4-3.6-4.5-2.3-.6-4-2.7-3.5-4.5.5-1.9 2.7-3 5-2.3 1 .2 1.8.8 2.5 1.6m-3.9 12v2m0-18v2.2"/>
                                                        </svg>
                                                    </div>
                                                    <input type="number"  class="bg-gray-50 border border-gray-300 text-gray-900 lg:text-sm md:text-3xl rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="0.00" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </fwb-accordion-content>
                            </fwb-accordion-panel>
                        </fwb-accordion>
                        <div class="mt-4 px-4 py-1 flex justify-between items-center lg:space-y-0 lg:flex-row md:flex-col md:space-y-3">
                            <p class="w-full lg:text-sm md:text-3xl font-bold">Total impuesto a cargo:</p>
                            <div class="relative z-0 w-full mb-5 group">
                                <div class="relative">
                                    <div class="absolute inset-y-0 start-0 top-0 flex items-center ps-3.5 pointer-events-none">
                                        <svg class="lg:w-4 lg:h-4 md:w-7 md:h-7 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 17.3a5 5 0 0 0 2.6 1.7c2.2.6 4.5-.5 5-2.3.4-2-1.3-4-3.6-4.5-2.3-.6-4-2.7-3.5-4.5.5-1.9 2.7-3 5-2.3 1 .2 1.8.8 2.5 1.6m-3.9 12v2m0-18v2.2"/>
                                        </svg>
                                    </div>
                                    <input type="number"  class="cursor-not-allowed bg-gray-50 border border-gray-300 text-gray-900 lg:text-sm md:text-3xl rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="0.00" disabled required>
                                </div>
                            </div>
                        </div>
                        <fwb-accordion class="mb-3 mt-3">
                            <fwb-accordion-panel>
                                <fwb-accordion-header class="text-gray-700 bg-gray-200">Deducciones y anticipos</fwb-accordion-header>
                                <fwb-accordion-content>
                                    <div class="mb-1 flex justify-between items-center lg:space-y-0 lg:flex-row md:flex-col md:space-y-3">
                                        <p class="w-full lg:text-sm md:text-3xl">Menos Valor de Exención o Exoneración Sobre el Impuesto y No Sobre los Ingresos:</p>
                                        <div class="relative z-0 w-full mb-5 group">
                                            <div class="relative">
                                                <div class="absolute inset-y-0 start-0 top-0 flex items-center ps-3.5 pointer-events-none">
                                                    <svg class="lg:w-4 lg:h-4 md:w-7 md:h-7 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 17.3a5 5 0 0 0 2.6 1.7c2.2.6 4.5-.5 5-2.3.4-2-1.3-4-3.6-4.5-2.3-.6-4-2.7-3.5-4.5.5-1.9 2.7-3 5-2.3 1 .2 1.8.8 2.5 1.6m-3.9 12v2m0-18v2.2"/>
                                                    </svg>
                                                </div>
                                                <input type="number"  class="bg-gray-50 border border-gray-300 text-gray-900 lg:text-sm md:text-3xl rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="0.00"  required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-1 flex justify-between items-center lg:space-y-0 lg:flex-row md:flex-col md:space-y-3">
                                        <p class="w-full lg:text-sm md:text-3xl">Menos Retenciones que le practicaron a favor de este municipio o distrito en este periodo:</p>
                                        <div class="relative z-0 w-full mb-5 group">
                                            <div class="relative">
                                                <div class="absolute inset-y-0 start-0 top-0 flex items-center ps-3.5 pointer-events-none">
                                                    <svg class="lg:w-4 lg:h-4 md:w-7 md:h-7 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 17.3a5 5 0 0 0 2.6 1.7c2.2.6 4.5-.5 5-2.3.4-2-1.3-4-3.6-4.5-2.3-.6-4-2.7-3.5-4.5.5-1.9 2.7-3 5-2.3 1 .2 1.8.8 2.5 1.6m-3.9 12v2m0-18v2.2"/>
                                                    </svg>
                                                </div>
                                                <input type="number"  class="bg-gray-50 border border-gray-300 text-gray-900 lg:text-sm md:text-3xl rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="0.00"  required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-1 flex justify-between items-center lg:space-y-0 lg:flex-row md:flex-col md:space-y-3">
                                        <p class="w-full lg:text-sm md:text-3xl">Menos Autorretenciones practicadas a favor de este municipio o distrito en este periodo:</p>
                                        <div class="relative z-0 w-full mb-5 group">
                                            <div class="relative">
                                                <div class="absolute inset-y-0 start-0 top-0 flex items-center ps-3.5 pointer-events-none">
                                                    <svg class="lg:w-4 lg:h-4 md:w-7 md:h-7 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 17.3a5 5 0 0 0 2.6 1.7c2.2.6 4.5-.5 5-2.3.4-2-1.3-4-3.6-4.5-2.3-.6-4-2.7-3.5-4.5.5-1.9 2.7-3 5-2.3 1 .2 1.8.8 2.5 1.6m-3.9 12v2m0-18v2.2"/>
                                                    </svg>
                                                </div>
                                                <input type="number"  class="bg-gray-50 border border-gray-300 text-gray-900 lg:text-sm md:text-3xl rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="0.00"  required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-1 flex justify-between items-center lg:space-y-0 lg:flex-row md:flex-col md:space-y-3">
                                        <p class="w-full lg:text-sm md:text-3xl">Menos Anticipo Liquidado en el Año Anterior</p>
                                        <div class="relative z-0 w-full mb-5 group">
                                            <div class="relative">
                                                <div class="absolute inset-y-0 start-0 top-0 flex items-center ps-3.5 pointer-events-none">
                                                    <svg class="lg:w-4 lg:h-4 md:w-7 md:h-7 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 17.3a5 5 0 0 0 2.6 1.7c2.2.6 4.5-.5 5-2.3.4-2-1.3-4-3.6-4.5-2.3-.6-4-2.7-3.5-4.5.5-1.9 2.7-3 5-2.3 1 .2 1.8.8 2.5 1.6m-3.9 12v2m0-18v2.2"/>
                                                    </svg>
                                                </div>
                                                <input type="number"  class=" bg-gray-50 border border-gray-300 text-gray-900 lg:text-sm md:text-3xl rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="0.00"  required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-1 flex justify-between items-center lg:space-y-0 lg:flex-row md:flex-col md:space-y-3">
                                        <p class="w-full lg:text-sm md:text-3xl">Anticipo del Año Siguiente (Si Existe, Liquide Porcentaje Según Acuerdo Municipal o Distrital):</p>
                                        <div class="relative z-0 w-full mb-5 group">
                                            <div class="relative">
                                                <div class="absolute inset-y-0 start-0 top-0 flex items-center ps-3.5 pointer-events-none">
                                                    <svg class="lg:w-4 lg:h-4 md:w-7 md:h-7 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 17.3a5 5 0 0 0 2.6 1.7c2.2.6 4.5-.5 5-2.3.4-2-1.3-4-3.6-4.5-2.3-.6-4-2.7-3.5-4.5.5-1.9 2.7-3 5-2.3 1 .2 1.8.8 2.5 1.6m-3.9 12v2m0-18v2.2"/>
                                                    </svg>
                                                </div>
                                                <input type="number"  class=" bg-gray-50 border border-gray-300 text-gray-900 lg:text-sm md:text-3xl rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="0.00"  required>
                                            </div>
                                        </div>
                                    </div>
                                </fwb-accordion-content>
                            </fwb-accordion-panel>
                        </fwb-accordion>
                        <fwb-accordion>
                            <fwb-accordion-panel>
                                <fwb-accordion-header class="text-gray-700 bg-gray-200">Sanciones</fwb-accordion-header>
                                <fwb-accordion-content>
                                    <div  class="grid lg:grid-cols-4 md:grid-cols-1 mb-4 lg:space-x-2 md:space-x-0 lg:space-y-0 md:space-y-2">
                                        <div>
                                            <label  class="block mb-2 lg:text-sm md:text-3xl font-medium text-gray-900 dark:text-white">Sanción</label>
                                            <select  class="bg-gray-50 border border-gray-300 text-gray-900 lg:text-sm md:text-3xl rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                                <option selected>Seleccione una sanción</option>
                                                <option value="102">
                                                    Sanción por extemporaneidad - 14707801
                                                </option>
                                            </select>
                                        </div>
                                        <div>
                                            <label class="block mb-2 lg:text-sm md:text-3xl font-medium text-gray-900 dark:text-white">Ingresos gravados</label>
                                            <div class="relative">
                                                <div class="absolute inset-y-0 start-0 top-0 flex items-center ps-3.5 pointer-events-none">
                                                    <svg class="lg:w-4 lg:h-4 md:w-7 md:h-7 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 17.3a5 5 0 0 0 2.6 1.7c2.2.6 4.5-.5 5-2.3.4-2-1.3-4-3.6-4.5-2.3-.6-4-2.7-3.5-4.5.5-1.9 2.7-3 5-2.3 1 .2 1.8.8 2.5 1.6m-3.9 12v2m0-18v2.2"/>
                                                    </svg>
                                                </div>
                                                <input type="number"  @input="setValueIngresos($event,actividad.id)"  class="bg-gray-50 border border-gray-300 text-gray-900 lg:text-sm md:text-3xl rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="0.00" required>
                                            </div>
                                        </div>
                                        <div>
                                            <label class="block mb-2 lg:text-sm md:text-3xl font-medium text-gray-900 dark:text-white">Tasa x mil</label>
                                            <input type="text" value="5" disabled class="bg-gray-50 border border-gray-300 text-gray-900 lg:text-sm md:text-3xl rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"  required>
                                        </div>
                                        <div>
                                            <label class="block mb-2 lg:text-sm md:text-3xl font-medium text-gray-900 dark:text-white">Impuesto</label>
                                            <div class="relative">
                                                <div class="absolute inset-y-0 start-0 top-0 flex items-center ps-3.5 pointer-events-none">
                                                    <svg class="lg:w-4 lg:h-4 md:w-7 md:h-7 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 17.3a5 5 0 0 0 2.6 1.7c2.2.6 4.5-.5 5-2.3.4-2-1.3-4-3.6-4.5-2.3-.6-4-2.7-3.5-4.5.5-1.9 2.7-3 5-2.3 1 .2 1.8.8 2.5 1.6m-3.9 12v2m0-18v2.2"/>
                                                    </svg>
                                                </div>
                                                <div class="flex justify-between">
                                                    <input type="number"  value="0" class="cursor-not-allowed bg-gray-50 border border-gray-300 text-gray-900 lg:text-sm md:text-3xl rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" disabled required>
                                                    <button type="button" @click="delActividad(actividad.id)" class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900"><svg fill="none" class="fill-white lg:w-4 lg:h-4 md:w-7 md:h-7" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M135.2 17.7L128 32H32C14.3 32 0 46.3 0 64S14.3 96 32 96H416c17.7 0 32-14.3 32-32s-14.3-32-32-32H320l-7.2-14.3C307.4 6.8 296.3 0 284.2 0H163.8c-12.1 0-23.2 6.8-28.6 17.7zM416 128H32L53.2 467c1.6 25.3 22.6 45 47.9 45H346.9c25.3 0 46.3-19.7 47.9-45L416 128z"/></svg></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flex justify-center">
                                        <button type="button" @click="addActividad" class="text-green-500  bg-white border border-green-500 hover:bg-green-500 hover:text-white font-medium rounded-lg lg:text-sm md:text-3xl px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Agregar sanción</button>
                                    </div>
                                </fwb-accordion-content>
                            </fwb-accordion-panel>
                        </fwb-accordion>
                        <div class="mt-4 px-4 py-1 flex justify-between items-center lg:space-y-0 lg:flex-row md:flex-col md:space-y-3">
                            <p class="w-full lg:text-sm md:text-3xl font-bold">Total Sanciones:</p>
                            <div class="relative z-0 w-full mb-5 group">
                                <div class="relative">
                                    <div class="absolute inset-y-0 start-0 top-0 flex items-center ps-3.5 pointer-events-none">
                                        <svg class="lg:w-4 lg:h-4 md:w-7 md:h-7 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 17.3a5 5 0 0 0 2.6 1.7c2.2.6 4.5-.5 5-2.3.4-2-1.3-4-3.6-4.5-2.3-.6-4-2.7-3.5-4.5.5-1.9 2.7-3 5-2.3 1 .2 1.8.8 2.5 1.6m-3.9 12v2m0-18v2.2"/>
                                        </svg>
                                    </div>
                                    <input type="number"  class="cursor-not-allowed bg-gray-50 border border-gray-300 text-gray-900 lg:text-sm md:text-3xl rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="0.00" disabled required>
                                </div>
                            </div>
                        </div>
                        <div class="px-4 py-1 flex justify-between items-center lg:space-y-0 lg:flex-row md:flex-col md:space-y-3">
                            <p class="w-full lg:text-sm md:text-3xl font-bold">Total Saldo a Cargo:</p>
                            <div class="relative z-0 w-full mb-5 group">
                                <div class="relative">
                                    <div class="absolute inset-y-0 start-0 top-0 flex items-center ps-3.5 pointer-events-none">
                                        <svg class="lg:w-4 lg:h-4 md:w-7 md:h-7 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 17.3a5 5 0 0 0 2.6 1.7c2.2.6 4.5-.5 5-2.3.4-2-1.3-4-3.6-4.5-2.3-.6-4-2.7-3.5-4.5.5-1.9 2.7-3 5-2.3 1 .2 1.8.8 2.5 1.6m-3.9 12v2m0-18v2.2"/>
                                        </svg>
                                    </div>
                                    <input type="number"  class="cursor-not-allowed bg-gray-50 border border-gray-300 text-gray-900 lg:text-sm md:text-3xl rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="0.00" disabled required>
                                </div>
                            </div>
                        </div>
                        <div class="px-4 py-1 flex justify-between items-center lg:space-y-0 lg:flex-row md:flex-col md:space-y-3">
                            <p class="w-full lg:text-sm md:text-3xl font-bold">Total Saldo a Favor:</p>
                            <div class="relative z-0 w-full mb-5 group">
                                <div class="relative">
                                    <div class="absolute inset-y-0 start-0 top-0 flex items-center ps-3.5 pointer-events-none">
                                        <svg class="lg:w-4 lg:h-4 md:w-7 md:h-7 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 17.3a5 5 0 0 0 2.6 1.7c2.2.6 4.5-.5 5-2.3.4-2-1.3-4-3.6-4.5-2.3-.6-4-2.7-3.5-4.5.5-1.9 2.7-3 5-2.3 1 .2 1.8.8 2.5 1.6m-3.9 12v2m0-18v2.2"/>
                                        </svg>
                                    </div>
                                    <input type="number"  class="cursor-not-allowed bg-gray-50 border border-gray-300 text-gray-900 lg:text-sm md:text-3xl rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="0.00" disabled required>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="flex justify-end mt-5 space-x-2">
                <a href="#inscripcion"  :class="{'hidden':currentPage==0}" @click="previousPage" type="button" class="bg-white text-blue-600 border border-blue-600 hover:bg-blue-600 hover:text-white font-bold rounded-lg lg:text-sm md:text-3xl w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Atrás</a>
                <a href="#inscripcion"  :class="{'hidden':pages!= null && currentPage == pages.children.length-1}" type="button" @click="nextPage" class="bg-white text-blue-600 border border-blue-600 hover:bg-blue-600 hover:text-white font-bold rounded-lg lg:text-sm md:text-3xl w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Siguiente</a>
            </div>
        </div>
    </Layout>
</template>

<script lang="ts" setup>
    import {Ref,ref,computed,reactive, onMounted} from 'vue';
    import {
        FwbAccordion,
        FwbAccordionContent,
        FwbAccordionHeader,
        FwbAccordionPanel
    } from 'flowbite-vue'
    import Layout from './Layout.vue';
    import ModalDireccion from './Components/ModalDireccion.vue'
    defineProps({ tenant: Object,showModal:Function,hideModal:Function, login:Boolean })

    interface Actividad {id:number,value:number}
    interface Sancion {id:number,percent:number,value:number}


    const pageForm:Ref = ref(1);
    const txtDireccion:Ref<string> = ref('')
    const intTotalPeriodo:Ref<number> = ref(0);
    const intIngresoFuera:Ref<number> = ref(0);
    const intIngresoDescuento:Ref<number>=ref(0);
    const intIngresoExportacion:Ref<number>=ref(0);
    const intIngresoExentas:Ref<number>=ref(0);
    const intIngresoActividades:Ref<number>=ref(0);
    const intIngresoVenta:Ref<number>=ref(0);
    const intTotal:Ref<number> = ref(0);
    const intTotalGravable:Ref<number> = ref(0);
    const intTotalIngresosGravados:Ref<number>=ref(0);
    const intTotalGravableFormat = computed(function() :string | 0 {
        intTotalGravable.value = intTotal.value -(
            intIngresoDescuento.value+
            intIngresoActividades.value+
            intIngresoExentas.value+
            intIngresoExportacion.value+
            intIngresoVenta.value
        )
        intTotalIngresosGravados.value = intTotalGravable.value;
        return formatNumber(intTotalGravable.value);
    })
    const intTotalFormat = computed(function() :string | 0{
        intTotal.value = intTotalPeriodo.value-intIngresoFuera.value;

        return formatNumber(intTotal.value);
    });
    const pages:Ref<HTMLElement | null> = ref(null);
    const stepper:Ref<HTMLElement | null> = ref(null);
    let currentPage:number = 0;
    let arrActividad = reactive<Array<Actividad>>([]);
    let arrSanciones = reactive<Array<Actividad>>([]);
    let totalIngresosGravados = computed(function() :number{
        let total = 0;
        arrActividad.forEach(function(result){
            total += result.value;
        });
        return total+intTotalIngresosGravados.value;
    })
    let contadorActividad:number=0;
    let contadorSancion:number =0;

    function nextPage() :void{
        let arrPages:HTMLCollection = pages.value.children;
        let arrSteps:HTMLCollection = stepper.value.children;
        for (let i:number = 0; i < arrPages.length; i++) {
            arrPages[i].classList.add("hidden");
        }
        currentPage++;
        arrSteps[currentPage].classList.add("text-blue-600", "dark:text-blue-500");
        arrSteps[currentPage].children[0].classList.add("border-blue-600","dark:border-blue-500");
        arrPages[currentPage].classList.remove("hidden");
    }
    function previousPage() :void {
        let arrPages:HTMLCollection = pages.value.children;
        let arrSteps:HTMLCollection = stepper.value.children;
        for (let i:number = 0; i < arrPages.length; i++) {
            arrPages[i].classList.add("hidden");
        }
        arrSteps[currentPage].classList.remove("text-blue-600", "dark:text-blue-500");
        arrSteps[currentPage].children[0].classList.remove("border-blue-600","dark:border-blue-500");
        currentPage--;
        arrPages[currentPage].classList.remove("hidden");
    }

    function addActividad() :void{
        contadorActividad++;
        arrActividad.push({
            id:contadorActividad,
            value:0
        });
    }
    function delActividad(id) :void{
        let index = arrActividad.map(item=>item.id).indexOf(id);
        arrActividad.splice(index,1);
    }
    function setValueIngresos(event,id) :void{
        let arr = arrActividad
        let index = arr.map(item=>item.id).indexOf(id);
        arr[index].value = event.target.value != "" ? parseInt(event.target.value) : 0;
        arrActividad = arr;
    }
    function formatNumber(value:number | string) :string{
        return value = value < 0  ? 0 : new Intl.NumberFormat('es-co').format(value)
    }
    function updateAddress(data) :void {
        txtDireccion.value = data;
    }

    onMounted(() :void => {
        let arrPages:HTMLCollection = pages.value.children;
        let arrSteps:HTMLCollection = stepper.value.children;
        for (let i:number = 0; i < arrPages.length; i++) {
            if(i!=currentPage)arrPages[i].classList.add("hidden");
            if(i==currentPage){
                arrSteps[i].classList.add("text-blue-600", "dark:text-blue-500");
                arrSteps[i].children[0].classList.add("border-blue-600","dark:border-blue-500");
            }
        }
    })
</script>

<style scoped>
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
    }
    input[type=number] {
    -moz-appearance: textfield;
    }
</style>
