<template>
    <Layout :tenant="tenant" v-slot="{ showModal, hideModal }">

        <!--Modal agregar representante-->
        <div id="modalRepresentante" data-modal-backdrop="static" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative p-4 w-full max-w-7xl max-h-full">
                <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    <!-- Modal header -->
                    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                        <h3 class="lg:text-xl md:text-3xl font-semibold text-gray-900 dark:text-white">
                            Nuevo representante
                        </h3>
                        <button type="button" class="text-gray-400 bg-transparent rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" @click="hideModal('modalRepresentante')">
                            <svg class="lg:w-3 lg:h-3 md:w-6 md:h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <div class="p-4 md:p-5 space-y-4">
                        <div class="grid lg:grid-cols-2 lg:gap-4 md:grid-cols-1">
                            <input type="hidden" :v-model="txtId">
                            <div class="relative z-0 w-full mb-5 group">
                                <label for="underline_select" class="sr-only">Tipo de documento</label>
                                <select v-model="txtSelectDocumento" class="block py-2.5 px-0 w-full lg:text-sm md:text-2xl text-gray-500 bg-transparent border-0 border-b-2 border-gray-200 appearance-none dark:text-gray-400 dark:border-gray-700 focus:outline-none focus:ring-0 focus:border-gray-200 peer">
                                    <option selected>Seleccione tipo de documento</option>
                                    <option value="Cédula de ciudadania">Cédula de ciudadania</option>
                                    <option value="Cédula extranjera">Cédula extranjera</option>
                                    <option value="NIT">NIT</option>
                                    <option value="Pasaporte">Pasaporte</option>
                                    <option value="Tarjeta de identidad">Tarjeta de identidad</option>
                                </select>
                            </div>
                            <div class="relative z-0 w-full mb-5 group">
                                <input type="text" class="block py-2.5 px-0 w-full lg:text-sm md:text-2xl text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " v-model="txtDocumento" required />
                                <label for="floating_first_name" class="peer-focus:font-medium absolute lg:text-sm md:text-2xl text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">No. de Documento</label>
                            </div>
                            <div class="relative z-0 w-full mb-5 group">
                                <input type="text" class="block py-2.5 px-0 w-full lg:text-sm md:text-2xl text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " v-model="txtNombre" required />
                                <label for="floating_last_name" class="peer-focus:font-medium absolute lg:text-sm md:text-2xl text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Primer nombre</label>
                            </div>
                            <div class="relative z-0 w-full mb-5 group">
                                <input type="text" class="block py-2.5 px-0 w-full lg:text-sm md:text-2xl text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " v-model="txtSegundoNombre"  />
                                <label for="floating_last_name" class="peer-focus:font-medium absolute lg:text-sm md:text-2xl text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Segundo nombre</label>
                            </div>
                            <div class="relative z-0 w-full mb-5 group">
                                <input type="text" class="block py-2.5 px-0 w-full lg:text-sm md:text-2xl text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " v-model ="txtApellido" required />
                                <label for="floating_last_name" class="peer-focus:font-medium absolute lg:text-sm md:text-2xl text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Primer apellido</label>
                            </div>
                            <div class="relative z-0 w-full mb-5 group">
                                <input type="text" class="block py-2.5 px-0 w-full lg:text-sm md:text-2xl text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " v-model="txtSegundoApellido" />
                                <label for="floating_last_name" class="peer-focus:font-medium absolute lg:text-sm md:text-2xl text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Segundo apellido</label>
                            </div>
                        </div>
                        <div class="grid lg:grid-cols-3 gap-2 md:grid-cols-1">
                            <div class="relative z-0 w-full mb-5 group">
                                <label for="underline_select" class="sr-only">Tipo de representante</label>
                                <select v-model="txtSelectRepresentante" class="block py-2.5 px-0 w-full lg:text-sm md:text-2xl text-gray-500 bg-transparent border-0 border-b-2 border-gray-200 appearance-none dark:text-gray-400 dark:border-gray-700 focus:outline-none focus:ring-0 focus:border-gray-200 peer">
                                    <option selected>Seleccione tipo de representante</option>
                                    <option value="Principal">Principal</option>
                                    <option value="Suplente">Suplente</option>
                                    <option value="Apoderado">Apoderado</option>
                                </select>
                            </div>
                            <div class="relative z-0 w-full mb-5 group">
                                <input type="text" class="block py-2.5 px-0 w-full lg:text-sm md:text-2xl text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder="" v-model="txtTelefono"  required/>
                                <label for="floating_last_name" class="peer-focus:font-medium absolute lg:text-sm md:text-2xl text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Número de celular</label>
                            </div>
                            <div class="relative z-0 w-full mb-5 group">
                                <input type="email" class="block py-2.5 px-0 w-full lg:text-sm md:text-2xl text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" "  v-model="txtCorreo" required/>
                                <label for="floating_last_name" class="peer-focus:font-medium absolute lg:text-sm md:text-2xl text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Correo</label>
                            </div>
                        </div>
                    </div>
                    <!-- Modal footer -->
                    <div class="flex items-center justify-end p-4 space-x-2 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600" >
                        <button @click="addRepresentante" type="button" class="text-blue-600 bg-white border border-blue-600 hover:text-white hover:bg-blue-600 font-medium rounded-lg lg:text-sm md:text-2xl px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Confirmar</button>
                        <button @click="hideModal('modalRepresentante')" type="button" class="text-red-600 bg-white border border-red-600 hover:text-white hover:bg-red-600 font-medium rounded-lg lg:text-sm md:text-2xl px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Cancelar</button>
                    </div>
                </div>
            </div>
        </div>
        <div id="modalEstablecimiento" data-modal-backdrop="static" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative p-4 w-full max-w-7xl max-h-full">
                <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    <!-- Modal header -->
                    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                        <h3 class="lg:text-xl md:text-3xl font-semibold text-gray-900 dark:text-white">
                            Nuevo establecimiento
                        </h3>
                        <button type="button" class="text-gray-400 bg-transparent rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" @click="hideModal('modalEstablecimiento')">
                            <svg class="lg:w-3 lg:h-3 md:w-6 md:h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <div class="p-4 md:p-5 space-y-4">
                        <div class="grid lg:grid-cols-2 lg:gap-4 md:grid-cols-1">
                            <div class="relative z-0 w-full mb-5 group">
                                <input type="text" class="block py-2.5 px-0 w-full lg:text-sm md:text-2xl text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" "  required />
                                <label for="floating_first_name" class="peer-focus:font-medium absolute lg:text-sm md:text-2xl text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Nombre</label>
                            </div>
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
                            <div class="grid grid-cols-2 gap-4">
                                <div class="relative z-0 w-full mb-5 group">
                                    <input type="text" class="block py-2.5 px-0 w-full lg:text-sm md:text-2xl text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" "   />
                                    <label for="floating_last_name" class="peer-focus:font-medium absolute lg:text-sm md:text-2xl text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Teléfono</label>
                                </div>
                                <div class="relative z-0 w-full mb-5 group">
                                    <input type="text" class="block py-2.5 px-0 w-full lg:text-sm md:text-2xl text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" "   />
                                    <label for="floating_last_name" class="peer-focus:font-medium absolute lg:text-sm md:text-2xl text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Fax</label>
                                </div>
                            </div>
                            <div class="relative z-0 w-full mb-5 group">
                                <input type="text" class="block py-2.5 px-0 w-full lg:text-sm md:text-2xl text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" "   />
                                <label for="floating_last_name" class="peer-focus:font-medium absolute lg:text-sm md:text-2xl text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Correo electrónico</label>
                            </div>
                            <div class="relative z-0 w-full mb-5 group">
                                <input type="text" class="block py-2.5 px-0 w-full lg:text-sm md:text-2xl text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" "  required />
                                <label for="floating_last_name" class="peer-focus:font-medium absolute lg:text-sm md:text-2xl text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Nro empleados</label>
                            </div>
                            <div class="grid grid-cols-2 gap-4">
                                <div class="relative z-0 w-full mb-5 group">
                                    <input type="date"  class="block py-2.5 px-0 w-full lg:text-sm md:text-3xl text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                                    <label for="floating_last_name" class="peer-focus:font-medium absolute lg:text-sm md:text-3xl text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Fecha apertura</label>
                                </div>
                                <div class="relative z-0 w-full mb-5 group">
                                    <input type="date"  class="block py-2.5 px-0 w-full lg:text-sm md:text-3xl text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                                    <label for="floating_last_name" class="peer-focus:font-medium absolute lg:text-sm md:text-3xl text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Fecha cierre</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Modal footer -->
                    <div class="flex items-center justify-end p-4 space-x-2 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600" >
                        <button type="button" class="text-blue-600 bg-white border border-blue-600 hover:text-white hover:bg-blue-600 font-medium rounded-lg lg:text-sm md:text-2xl px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Confirmar</button>
                        <button @click="hideModal('modalEstablecimiento')" type="button" class="text-red-600 bg-white border border-red-600 hover:text-white hover:bg-red-600 font-medium rounded-lg lg:text-sm md:text-2xl px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Cancelar</button>
                    </div>
                </div>
            </div>
        </div>
        <ModalDireccion @getAddress="data => { updateAddress(data); hideModal('modalDireccion') }" :hideModal="hideModal" />
        <div class="xl:mt-36 md:mt-48 mx-auto container">
            <div>
                <h1 class="text-center lg:text-2xl md:text-4xl mb-5 dark:text-white">Inscripción del contribuyente</h1>
                <ol id="inscripcion" class="flex items-center w-full p-3 space-x-2 lg:text-sm md:text-3xl gap-3  md:flex-wrap md:items-center font-medium text-center text-gray-500 bg-white border border-gray-200 rounded-lg shadow-sm dark:text-gray-400 sm:text-base dark:bg-gray-800 dark:border-gray-700 sm:p-4 sm:space-x-4 rtl:space-x-reverse">
                    <li class="flex items-center text-blue-600 dark:text-blue-500">
                        <span class="flex items-center justify-center w-5 h-5 me-2 text-xs border border-blue-600 rounded-full shrink-0 dark:border-blue-500">
                            1
                        </span>
                        Información <span class="hidden sm:inline-flex sm:ms-2">General</span>
                        <svg class="w-3 h-3 ms-2 sm:ms-4 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 12 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m7 9 4-4-4-4M1 9l4-4-4-4"/>
                        </svg>
                    </li>
                    <li :class="{'text-blue-600 dark:text-blue-500':pageForm>1}" class="flex items-center">
                        <span :class="{'border-blue-600  dark:border-blue-500':pageForm > 1, 'border-gray-500 dark:border-gray-400': pageForm<2}"  class=" flex items-center justify-center w-5 h-5 me-2 text-xs border rounded-full shrink-0 ">
                            2
                        </span>
                        Representante <span class="hidden sm:inline-flex sm:ms-2">Actividades</span>
                        <svg class="w-3 h-3 ms-2 sm:ms-4 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 12 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m7 9 4-4-4-4M1 9l4-4-4-4"/>
                        </svg>
                    </li>
                    <li :class="{'flex items-center text-blue-600 dark:text-blue-500':pageForm == 3, 'flex items-center':pageForm != 3}">
                        <span :class="{'border-blue-600  dark:border-blue-500':pageForm > 2, 'border-gray-500 dark:border-gray-400': pageForm<3}"  class=" flex items-center justify-center w-5 h-5 me-2 text-xs border rounded-full shrink-0 ">
                            3
                        </span>
                        Formularios y anexos
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
                        <h3 class="bg-gray-200 text-gray-500 font-bold p-4 lg:text-base md:text-3xl mb-5">Representante legal</h3>
                        <div>
                            <div class="relative overflow-auto max-h-56">
                                <table class="w-full lg:text-sm md:text-3xl text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                    <thead class="text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                        <tr>
                                            <th scope="col" class="px-2 py-2">
                                                Número de documento
                                            </th>
                                            <th scope="col" class="px-2 py-2">
                                                Nombre completo
                                            </th>
                                            <th scope="col" class="px-2 py-2">
                                                Tipo de representante
                                            </th>
                                            <th scope="col" class="px-2 py-2">
                                                Opciones
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="item in arrRepresentantes" :key="item.id"
                                        :data-nombre="item.nombre"
                                        :data-segundo-nombre="item.segundo_nombre"
                                        :data-apellido="item.apellido"
                                        :data-segundo-apellido="item.segundo_apellido"
                                        :data-tipo-documento="item.tipo_documento"
                                        :data-documento="item.documento"
                                        :data-representante="item.representante"
                                        :data-celular="item.celular"
                                        :data-correo="item.correo"
                                        :data-id = "item.id"
                                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                            <td class="px-2 py-2">
                                                {{item.documento}}
                                            </td>
                                            <td class="px-2 py-2">
                                               {{item.nombre+" "+item.segundo_nombre+" "+item.apellido+" "+item.segundo_apellido}}
                                            </td>
                                            <td class="px-2 py-2">
                                                {{item.representante}}
                                            </td>
                                            <td class="px-2 py-2 flex items-center space-x-2">
                                                <button type="button" @click="showModal('modalRepresentante'); editRepresentante(item.id)" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"><svg fill="none" class="fill-white lg:w-4 lg:h-4 md:w-7 md:h-7" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M362.7 19.3L314.3 67.7 444.3 197.7l48.4-48.4c25-25 25-65.5 0-90.5L453.3 19.3c-25-25-65.5-25-90.5 0zm-71 71L58.6 323.5c-10.4 10.4-18 23.3-22.2 37.4L1 481.2C-1.5 489.7 .8 498.8 7 505s15.3 8.5 23.7 6.1l120.3-35.4c14.1-4.2 27-11.8 37.4-22.2L421.7 220.3 291.7 90.3z"/></svg></button>
                                                <button type="button" @click="delRepresentante(item.id)" class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900"><svg fill="none" class="fill-white lg:w-4 lg:h-4 md:w-7 md:h-7" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M135.2 17.7L128 32H32C14.3 32 0 46.3 0 64S14.3 96 32 96H416c17.7 0 32-14.3 32-32s-14.3-32-32-32H320l-7.2-14.3C307.4 6.8 296.3 0 284.2 0H163.8c-12.1 0-23.2 6.8-28.6 17.7zM416 128H32L53.2 467c1.6 25.3 22.6 45 47.9 45H346.9c25.3 0 46.3-19.7 47.9-45L416 128z"/></svg></button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="flex justify-center mt-5">
                                <button type="button" @click="resetFields();showModal('modalRepresentante')" class="text-green-500  bg-white border border-green-500 hover:bg-green-500 hover:text-white font-medium rounded-lg lg:text-sm md:text-3xl px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Añadir representante legal </button>
                            </div>
                        </div>
                    </div>
                    <div>
                        <h3 class="bg-gray-200 text-gray-500 font-bold p-4 lg:text-base md:text-3xl mb-5">Actividad económica</h3>
                    </div>
                    <div>
                        <h3 class="bg-gray-200 text-gray-500 font-bold p-4 lg:text-base md:text-3xl mb-5">Establecimientos</h3>
                        <div>
                            <div class="relative overflow-auto max-h-56">
                                <table class="w-full lg:text-sm md:text-3xl text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                    <thead class="text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                        <tr>
                                            <th scope="col" class="px-2 py-2">
                                                Nombre de establecimiento
                                            </th>
                                            <th scope="col" class="px-2 py-2">
                                                Dirección del establecimiento
                                            </th>
                                            <th scope="col" class="px-2 py-2">
                                                Fecha de apertura
                                            </th>
                                            <th scope="col" class="px-2 py-2">
                                                Fecha de cierre
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr  class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                            <td class="px-2 py-2">

                                            </td>
                                            <td class="px-2 py-2">

                                            </td>
                                            <td class="px-2 py-2">

                                            </td>
                                            <td class="px-2 py-2 flex items-center space-x-2">
                                                <button type="button"  class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"><svg fill="none" class="fill-white lg:w-4 lg:h-4 md:w-7 md:h-7" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M362.7 19.3L314.3 67.7 444.3 197.7l48.4-48.4c25-25 25-65.5 0-90.5L453.3 19.3c-25-25-65.5-25-90.5 0zm-71 71L58.6 323.5c-10.4 10.4-18 23.3-22.2 37.4L1 481.2C-1.5 489.7 .8 498.8 7 505s15.3 8.5 23.7 6.1l120.3-35.4c14.1-4.2 27-11.8 37.4-22.2L421.7 220.3 291.7 90.3z"/></svg></button>
                                                <button type="button"  class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900"><svg fill="none" class="fill-white lg:w-4 lg:h-4 md:w-7 md:h-7" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M135.2 17.7L128 32H32C14.3 32 0 46.3 0 64S14.3 96 32 96H416c17.7 0 32-14.3 32-32s-14.3-32-32-32H320l-7.2-14.3C307.4 6.8 296.3 0 284.2 0H163.8c-12.1 0-23.2 6.8-28.6 17.7zM416 128H32L53.2 467c1.6 25.3 22.6 45 47.9 45H346.9c25.3 0 46.3-19.7 47.9-45L416 128z"/></svg></button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="flex justify-center mt-5">
                                <button type="button" @click="showModal('modalEstablecimiento')" class="text-green-500  bg-white border border-green-500 hover:bg-green-500 hover:text-white font-medium rounded-lg lg:text-sm md:text-3xl px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Añadir establecimiento </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="flex justify-end mt-5 space-x-2">
                <a href="#inscripcion" v-if="pageForm>1" @click="previousPage" type="button" class="bg-white text-blue-600 border border-blue-600 hover:bg-blue-600 hover:text-white font-bold rounded-lg lg:text-sm md:text-3xl w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Atrás</a>
                <a href="#inscripcion" v-if="pageForm < 3" type="button" @click="nextPage" class="bg-white text-blue-600 border border-blue-600 hover:bg-blue-600 hover:text-white font-bold rounded-lg lg:text-sm md:text-3xl w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Siguiente</a>
            </div>
        </div>
    </Layout>
</template>

<script setup>
import Layout from './Layout.vue'
import ModalDireccion from './Components/ModalDireccion.vue'
import { ref,reactive } from 'vue'

defineProps({ tenant: Object });
const txtDireccion = ref('')
const arrRepresentantes = reactive([]);
const pageForm = ref(1);

let txtDocumento = ref()
let txtSelectDocumento = ref('Seleccione tipo de documento');
let txtNombre = ref()
let txtSegundoNombre = ref()
let txtApellido= ref()
let txtSegundoApellido =ref()
let txtSelectRepresentante = ref('Seleccione tipo de representante')
let txtTelefono = ref()
let txtCorreo = ref()
let txtId = ref()
let contador = 0;

function updateAddress(data) {
    txtDireccion.value = data
}

function nextPage() {
    pageForm.value++
}

function addRepresentante(){
    let obj = {}
    if(txtId.value > 0){
        let index = arrRepresentantes.map(item=>item.id).indexOf(txtId.value);
        arrRepresentantes[index]['tipo_documento'] = txtSelectDocumento.value;
        arrRepresentantes[index]['documento'] = txtDocumento.value;
        arrRepresentantes[index]['nombre'] = txtNombre.value;
        arrRepresentantes[index]['segundo_nombre'] = txtSegundoNombre.value;
        arrRepresentantes[index]['apellido'] = txtApellido.value;
        arrRepresentantes[index]['segundo_apellido'] = txtSegundoApellido.value;
        arrRepresentantes[index]['representante'] = txtSelectRepresentante.value;
        arrRepresentantes[index]['telefono'] = txtTelefono.value;
        arrRepresentantes[index]['correo'] = txtCorreo.value;
    }else{
        contador +=1;
        obj =
        {
            "id":contador,
            "tipo_documento":txtSelectDocumento.value,
            "documento":txtDocumento.value,
            "nombre":txtNombre.value,
            "segundo_nombre":txtSegundoNombre.value,
            "apellido": txtApellido.value,
            "segundo_apellido":txtSegundoApellido.value,
            "representante": txtSelectRepresentante.value,
            "telefono":txtTelefono.value,
            "correo":txtCorreo.value,
        }
        arrRepresentantes.value =  arrRepresentantes.push(obj);
    }
    resetFields()
}
function resetFields(){
    txtSelectDocumento.value = 'Seleccione tipo de documento'
    txtSelectRepresentante.value = "Seleccione tipo de representante"
    txtDocumento.value = ""
    txtNombre.value = ""
    txtSegundoNombre.value = ""
    txtApellido.value = ""
    txtSegundoApellido.value = ""
    txtTelefono.value = ""
    txtCorreo.value = ""
    txtId.value ="";
}

function delRepresentante(id){
    let index = arrRepresentantes.map(item=>item.id).indexOf(id)
    arrRepresentantes.value = arrRepresentantes.splice(index,1);
}
function editRepresentante(id){
    let index = arrRepresentantes.map(item=>item.id).indexOf(id)
    let rep =arrRepresentantes[index];

    txtSelectDocumento.value = rep['tipo_documento'];
    txtSelectRepresentante.value = rep['representante'];
    txtDocumento.value = rep['documento'];
    txtNombre.value = rep['nombre'];
    txtSegundoNombre.value = rep['segundo_nombre'];
    txtApellido.value = rep['apellido'];
    txtSegundoApellido.value = rep['segundo_apellido'];
    txtTelefono.value = rep['telefono'];
    txtCorreo.value = rep['çorreo'];
    txtId.value = rep['id'];
}

function previousPage() {
    pageForm.value--
}
</script>
