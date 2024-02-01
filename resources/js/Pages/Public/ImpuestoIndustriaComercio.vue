<template>
    <Layout :tenant="tenant" v-slot="{ login, showModal, hideModal }">
        <div class="xl:mt-24 xl:p-10 md:mt-48 mx-auto container">
            <div>
                <h1 class="text-2xl md:text-5xl text-center font-medium text-gray-900 dark:text-white mb-8 mt-5">Impuesto industria y comercio</h1>
                <ol id="inscripcion" class="flex items-center w-full p-3 space-x-2 lg:text-sm md:text-3xl gap-3  md:flex-wrap md:items-center font-medium text-center text-gray-500 bg-white border border-gray-200 rounded-lg shadow-sm dark:text-gray-400 sm:text-base dark:bg-gray-800 dark:border-gray-700 sm:p-4 sm:space-x-4 rtl:space-x-reverse">
                    <li class="flex items-center text-blue-600 dark:text-blue-500">
                        <span class="flex items-center justify-center w-5 h-5 me-2 text-xs border border-blue-600 rounded-full shrink-0 dark:border-blue-500">
                            1
                        </span>
                        Contribuyente
                        <svg class="w-3 h-3 ms-2 sm:ms-4 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 12 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m7 9 4-4-4-4M1 9l4-4-4-4"/>
                        </svg>
                    </li>
                    <li :class="{'text-blue-600 dark:text-blue-500':pageForm>1}" class="flex items-center">
                        <span :class="{'border-blue-600  dark:border-blue-500':pageForm > 1, 'border-gray-500 dark:border-gray-400': pageForm<2}"  class=" flex items-center justify-center w-5 h-5 me-2 text-xs border rounded-full shrink-0 ">
                            2
                        </span>
                        Base gravable
                        <svg class="w-3 h-3 ms-2 sm:ms-4 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 12 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m7 9 4-4-4-4M1 9l4-4-4-4"/>
                        </svg>
                    </li>
                    <li :class="{'text-blue-600 dark:text-blue-500':pageForm>1}" class="flex items-center">
                        <span :class="{'border-blue-600  dark:border-blue-500':pageForm > 1, 'border-gray-500 dark:border-gray-400': pageForm<2}"  class=" flex items-center justify-center w-5 h-5 me-2 text-xs border rounded-full shrink-0 ">
                            3
                        </span>
                        Actividades gravables
                        <svg class="w-3 h-3 ms-2 sm:ms-4 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 12 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m7 9 4-4-4-4M1 9l4-4-4-4"/>
                        </svg>
                    </li>
                    <li :class="{'text-blue-600 dark:text-blue-500':pageForm>1}" class="flex items-center">
                        <span :class="{'border-blue-600  dark:border-blue-500':pageForm > 1, 'border-gray-500 dark:border-gray-400': pageForm<2}"  class=" flex items-center justify-center w-5 h-5 me-2 text-xs border rounded-full shrink-0 ">
                            4
                        </span>
                        Liquidación privada
                        <svg class="w-3 h-3 ms-2 sm:ms-4 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 12 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m7 9 4-4-4-4M1 9l4-4-4-4"/>
                        </svg>
                    </li>
                    <li :class="{'flex items-center text-blue-600 dark:text-blue-500':pageForm == 5, 'flex items-center':pageForm != 5}">
                        <span :class="{'border-blue-600  dark:border-blue-500':pageForm > 4, 'border-gray-500 dark:border-gray-400': pageForm<5}"  class=" flex items-center justify-center w-5 h-5 me-2 text-xs border rounded-full shrink-0 ">
                            5
                        </span>
                        Sanciones
                    </li>
                </ol>
                <form v-if="pageForm == 1" class="w-full mt-10">
                    <div>
                        <h3 class="bg-gray-200 text-gray-500 font-bold p-4 lg:text-base md:text-3xl mb-5">Información del contribuyente</h3>
                        <div class="grid lg:grid-cols-6 lg:gap-4 md:grid-cols-1">
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
                                <input type="text"  class="block py-2.5 px-0 w-full lg:text-sm md:text-3xl text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                                <label for="floating_last_name" class="peer-focus:font-medium absolute lg:text-sm md:text-3xl text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Matricula Mercantil</label>
                            </div>
                            <div class="relative z-0 w-full mb-5 group">
                                <input type="date"  class="block py-2.5 px-0 w-full lg:text-sm md:text-3xl text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                                <label for="floating_last_name" class="peer-focus:font-medium absolute lg:text-sm md:text-3xl text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Fecha Matricula Mercantil</label>
                            </div>
                            <div class="relative z-0 w-full mb-5 group">
                                <input type="date"  class="block py-2.5 px-0 w-full lg:text-sm md:text-3xl text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                                <label for="floating_last_name" class="peer-focus:font-medium absolute lg:text-sm md:text-3xl text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Fecha Inicio Actividades</label>
                            </div>
                        </div>
                        <div class="grid md:grid-cols-2 md:gap-4 ">
                            <div class="relative z-0 w-full mb-5 group">
                                <label for="underline_select" class="sr-only">Tipo de documento</label>
                                <select class="block py-2.5 px-0 w-full lg:text-sm md:text-3xl text-gray-500 bg-transparent border-0 border-b-2 border-gray-200 appearance-none dark:text-gray-400 dark:border-gray-700 focus:outline-none focus:ring-0 focus:border-gray-200 peer">
                                    <option selected>Seleccione tipo de persona</option>
                                    <option value="1">Natural</option>
                                    <option value="2">Jurídica</option>
                                    <option value="3">Sociedad de hecho</option>
                                </select>
                            </div>
                            <div class="relative z-0 w-full mb-5 group">
                                <input type="text" class="block py-2.5 px-0 w-full lg:text-sm md:text-3xl text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                                <label for="floating_first_name" class="peer-focus:font-medium absolute lg:text-sm md:text-3xl text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Nombre completo</label>
                            </div>
                        </div>
                        <div class="grid lg:grid-cols-6 lg:gap-4 md:grid-cols-3 items-center">
                            <div class="relative z-0 w-full mb-5 group">
                                <label for="underline_select" class="sr-only">Régimen</label>
                                <select class="block py-2.5 px-0 w-full lg:text-sm md:text-3xl text-gray-500 bg-transparent border-0 border-b-2 border-gray-200 appearance-none dark:text-gray-400 dark:border-gray-700 focus:outline-none focus:ring-0 focus:border-gray-200 peer">
                                    <option selected>Seleccione régimen</option>
                                    <option value="1">No aplica</option>
                                    <option value="2">Simplificado</option>
                                    <option value="3">Común</option>
                                    <option value="3">Simple</option>
                                </select>
                            </div>
                            <div class="relative z-0 w-full mb-5 group">
                                <div class="flex items-center">
                                    <input type="checkbox" value="" class="lg:w-4 lg:h-4 md:w-7 md:h-7 text-greenp1 bg-gray-100 border-gray-300 rounded focus:ring-greenp1 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    <label for="checked-checkbox" class="ms-2 lg:text-sm md:text-xl font-medium text-gray-900 dark:text-gray-300">¿Gran Contribuyente?</label>
                                </div>
                            </div>
                            <div class="relative z-0 w-full mb-5 group">
                                <div class="flex items-center">
                                    <input type="checkbox" value="" class="lg:w-4 lg:h-4 md:w-7 md:h-7 text-greenp1 bg-gray-100 border-gray-300 rounded focus:ring-greenp1 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    <label for="checked-checkbox" class="ms-2 lg:text-sm md:text-xl font-medium text-gray-900 dark:text-gray-300">¿Declara Alumbrado?</label>
                                </div>
                            </div>
                            <div class="relative z-0 w-full mb-5 group">
                                <div class="flex items-center">
                                    <input type="checkbox" value="" class="lg:w-4 lg:h-4 md:w-7 md:h-7 text-greenp1 bg-gray-100 border-gray-300 rounded focus:ring-greenp1 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    <label for="checked-checkbox" class="ms-2 lg:text-sm md:text-xl font-medium text-gray-900 dark:text-gray-300">¿Agente Retenedor?</label>
                                </div>
                            </div>
                            <div class="relative z-0 w-full mb-5 group">
                                <div class="flex items-center">
                                    <input type="checkbox" value="" class="lg:w-4 lg:h-4 md:w-7 md:h-7 text-greenp1 bg-gray-100 border-gray-300 rounded focus:ring-greenp1 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    <label for="checked-checkbox" class="ms-2 lg:text-sm md:text-xl font-medium text-gray-900 dark:text-gray-300">¿Agente Auto-Retenedor?</label>
                                </div>
                            </div>
                            <div class="relative z-0 w-full mb-5 group">
                                <div class="flex items-center">
                                    <input type="checkbox" value="" class="lg:w-4 lg:h-4 md:w-7 md:h-7 text-greenp1 bg-gray-100 border-gray-300 rounded focus:ring-greenp1 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    <label for="checked-checkbox" class="ms-2 lg:text-sm md:text-xl font-medium text-gray-900 dark:text-gray-300">¿Contribuyente Temporal?</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <h3 class="bg-gray-200 text-gray-500 font-bold p-4 lg:text-base sm:text-3xl mb-5">Información del contador o revisor fiscal</h3>
                        <div class="grid lg:grid-cols-4 lg:gap-4 md:grid-cols-2">
                            <div class="relative z-0 w-full mb-5 group">
                                <input type="text" class="block py-2.5 px-0 w-full lg:text-sm md:text-3xl text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                                <label for="floating_first_name" class="peer-focus:font-medium absolute lg:text-sm md:text-3xl text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Nombres y apellidos</label>
                            </div>
                            <div class="relative z-0 w-full mb-5 group">
                                <label for="underline_select" class="sr-only">Tipo de documento</label>
                                <select class="block py-2.5 px-0 w-full lg:text-sm md:text-3xl text-gray-500 bg-transparent border-0 border-b-2 border-gray-200 appearance-none dark:text-gray-400 dark:border-gray-700 focus:outline-none focus:ring-0 focus:border-gray-200 peer">
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
                                <label for="floating_last_name" class="peer-focus:font-medium absolute lg:text-sm md:text-3xl text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Tarjeta profesional</label>
                            </div>
                        </div>
                    </div>
                    <div>
                        <h3 class="bg-gray-200 text-gray-500 font-bold p-4 lg:text-base sm:text-3xl mb-5">Información de notificación judicial</h3>
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
                        <div class="grid lg:grid-cols-4 lg:gap-4 md:grid-cols-2">
                            <div class="relative z-0 w-full mb-5 group">
                                <input type="email" class="block py-2.5 px-0 w-full lg:text-sm md:text-3xl text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                                <label for="floating_last_name" class="peer-focus:font-medium absolute lg:text-sm md:text-3xl text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Correo fiscal</label>
                            </div>
                            <div class="relative z-0 w-full mb-5 group">
                                <input type="email" class="block py-2.5 px-0 w-full lg:text-sm md:text-3xl text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                                <label for="floating_last_name" class="peer-focus:font-medium absolute lg:text-sm md:text-3xl text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Correo comercial</label>
                            </div>
                            <div class="relative z-0 w-full mb-5 group">
                                <input type="text" class="block py-2.5 px-0 w-full lg:text-sm md:text-3xl text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                                <label for="floating_last_name" class="peer-focus:font-medium absolute lg:text-sm md:text-3xl text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Teléfono</label>
                            </div>
                            <div class="relative z-0 w-full mb-5 group">
                                <input type="text" class="block py-2.5 px-0 w-full lg:text-sm md:text-3xl text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                                <label for="floating_last_name" class="peer-focus:font-medium absolute lg:text-sm md:text-3xl text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Celular</label>
                            </div>
                        </div>
                    </div>
                    <div class="flex justify-end flex-col space-x-2">
                        <div class="relative z-0 w-full mb-5 group">
                            <div class="flex justify-end items-center">
                                <input checked type="checkbox" value="" class="lg:w-4 lg:h-4 md:w-7 md:h-7 text-greenp1 bg-gray-100 border-gray-300 rounded focus:ring-greenp1 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                <label for="checked-checkbox" class="ms-2 lg:text-sm md:text-3xl font-medium text-gray-900 dark:text-gray-300">Autorizar envio de correo</label>
                            </div>
                        </div>
                        <div class="relative z-0 w-full mb-5 group">
                            <div class="flex justify-end items-center">
                                <input checked type="checkbox" value="" class="lg:w-4 lg:h-4 md:w-7 md:h-7 text-greenp1 bg-gray-100 border-gray-300 rounded focus:ring-greenp1 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                <label for="checked-checkbox" class="ms-2 lg:text-sm md:text-3xl font-medium text-gray-900 dark:text-gray-300">Autorizar manejo de datos</label>
                            </div>
                        </div>
                    </div>
                </form>
                <form v-if="pageForm == 2" class="w-full mt-10">
                    <div>
                        <h3 class="bg-gray-200 text-gray-500 font-bold p-4 lg:text-base md:text-3xl mb-5">Actividad económica</h3>
                    </div>
                </form>
            </div>
            <div class="flex justify-end mt-5 space-x-2">
                <a href="#inscripcion" v-if="pageForm>1" @click="previousPage" type="button" class="bg-white text-blue-600 border border-blue-600 hover:bg-blue-600 hover:text-white font-bold rounded-lg lg:text-sm md:text-3xl w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Atrás</a>
                <a href="#inscripcion" v-if="pageForm < 5" type="button" @click="nextPage" class="bg-white text-blue-600 border border-blue-600 hover:bg-blue-600 hover:text-white font-bold rounded-lg lg:text-sm md:text-3xl w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Siguiente</a>
            </div>
        </div>
    </Layout>
</template>

<script lang="ts" setup>
    import Layout from './Layout.vue';
    import {ref,Ref} from 'vue';
    defineProps({ tenant: Object,showModal:Function,hideModal:Function, login:Boolean })

    const pageForm:Ref = ref(1);

    function nextPage() {
        pageForm.value++
    }
    function previousPage() {
        pageForm.value--
    }
</script>

<style scoped>

</style>
