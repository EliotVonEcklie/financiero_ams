<template>
    <header>
        <ModalRegistro :login="login" @showModal="showModal" @hideModal="hideModal" :tenant="tenant"/>
        <nav id="main-nav"  class="bg-white text-black dark:text-white fixed top-0 w-full px-3 transition-all bg-transparent border-gray-200 dark:bg-gray-900 md:top-0 md:z-40">
            <div class="flex flex-wrap justify-between items-center w-full p-3">
                <Link :href="tenant.pagina" class="flex items-center space-x-3 rtl:space-x-reverse">
                    <img :src="img" class="xl:h-20 lg:h-24 md:h-36" alt="Logo Entidad" />
                    <div class="flex flex-col">
                        <span  class="self-center xl:text-2xl lg:text-3xl font-semibold whitespace-nowrap md:text-3xl ">{{ tenant.nombre.toUpperCase() }} - META</span>
                        <span  class="xl:text-sm lg:text-2xl  md:text-2xl">{{ tenant.entidad.toUpperCase() }}</span>
                    </div>
                </Link>
                <div class="xl:block lg:hidden md:hidden px-4 py-3">
                    <div class="flex items-center justify-center">
                        <ul class="flex flex-row font-medium mt-0 space-x-8 rtl:space-x-reverse text-sm">
                            <li class="px-2.5 py-2.5  rounded-lg hover:bg-blue-600 hover:text-white">
                                <Link :href="route('public.index')" aria-current="page">Inicio</Link>
                            </li>
                            <li class="px-2.5 py-2.5  rounded-lg hover:bg-blue-600 hover:text-white">
                                <button id="dropdownNavbarLink" data-dropdown-toggle="dropdownNavbar" class="flex items-center justify-between w-full py-2 px-3 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:p-0 md:w-auto dark:text-white md:dark:hover:text-white dark:focus:text-white dark:border-gray-700 dark:hover:bg-gray-700 md:dark:hover:bg-transparent">Selección de impuesto <svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                                    </svg>
                                </button>
                                <!-- Dropdown menu -->
                                <div id="dropdownNavbar" class="z-50 hidden font-normal bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 dark:divide-gray-600">
                                    <ul class="py-2 text-sm text-gray-700 dark:text-gray-400" aria-labelledby="dropdownLargeButton">
                                        <li>
                                            <Link :href="route('public.impuesto_predial_unificado')" class="block px-4 py-2 hover:bg-blue-600 hover:text-white dark:hover:bg-blue-600 dark:hover:text-white">Impuesto Predial Unificado</Link>
                                        </li>
                                        <li>
                                            <Link v-if="login" href="#" class="text-start block px-4 py-2 hover:bg-blue-600 hover:text-white dark:hover:bg-gray-600 dark:hover:text-white">Impuesto de industria y comercio</Link>
                                            <button v-else type="button" @click="showModal('modalRegistro')" class="text-start block px-4 py-2 hover:bg-blue-600 hover:text-white dark:hover:bg-blue-600 dark:hover:text-white">Impuesto de industria y comercio</button>
                                        </li>
                                        <li>
                                            <Link v-if="login" href="#" class="text-start block px-4 py-2 hover:bg-blue-600 hover:text-white dark:hover:bg-gray-600 dark:hover:text-white">Retención de industria y comercio</Link>
                                            <button v-else type="button" @click="showModal('modalRegistro')" class="text-start block px-4 py-2 hover:bg-blue-600 hover:text-white dark:hover:bg-gray-600 dark:hover:text-white">Retención de industria y comercio</button>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="px-2.5 py-2.5  rounded-lg hover:bg-blue-600 hover:text-white">
                                <Link :href="route('public.normatividad')" >Normatividad</Link>
                            </li>
                            <li class="px-2.5 py-2.5  rounded-lg hover:bg-blue-600 hover:text-white">
                                <Link :href="route('public.notificaciones')" >Notificaciones jurídicas</Link>
                            </li>
                            <li class="px-2.5 py-2.5  rounded-lg hover:bg-blue-600 hover:text-white">
                                <Link :href="route('public.presentacion')" >Presentación electrónica</Link>
                            </li>
                            <li class="px-2.5 py-2.5  rounded-lg hover:bg-blue-600 hover:text-white">
                                <Link :href="route('public.contacto')">Contacto</Link>
                            </li>
                            <li class="flex items-center">
                                <button  type="button" @click="showModal('modalRegistro')" class="border border-blue-600 text-blue-600 dark:text-white hover:text-white hover:border-blue-600 hover:bg-blue-600 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center  dark:border-white dark:text-600 dark:hover:text-white dark:hover:bg-blue-600 dark:focus:ring-blue-600">Iniciar sesión</button>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="flex items-center lg:block xl:hidden md:block ">
                    <button type="button" @click="openMobileNav()" class="border border-blue-600 text-blue-600 hover:text-white hover:border-blue-600 hover:bg-blue-600 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center  dark:border-white dark:text-white dark:hover:bg-blue-600 dark:focus:ring-blue-600">
                        <span class="sr-only">Open main menu</span>
                        <svg class="lg:h-8 lg:w-8 md:w-14 md:h-14" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15"/>
                        </svg>
                    </button>
                </div>
            </div>
        </nav>
        <nav :class="{'translate-x-0 ':mobileNav, 'translate-x-full ':mobileNav==false}" class="fixed z-50 top-0 transition-all h-full w-screen ">
            <div class=" h-full bg-white overflow-y-auto dark:bg-gray-700" >
                <div class="flex justify-between items-center mt-4 p-4">
                    <Link :href="tenant.pagina" class="flex items-center space-x-3 rtl:space-x-reverse">
                        <img :src="img" class="xl:h-20 lg:h-24 md:h-36" alt="Logo Entidad" />
                        <div class="flex flex-col">
                            <span class="self-center text-2xl font-semibold whitespace-nowrap md:text-3xl dark:text-white">{{ tenant.nombre.toUpperCase() }} - META</span>
                            <span class="text-sm text-gray-900 md:text-2xl dark:text-white">{{ tenant.entidad.toUpperCase() }}</span>
                        </div>
                    </Link>
                    <button type="button" @click="openMobileNav()" class="mx-5 my-5 text-gray-400 bg-transparent rounded-lg text-sm w-8 h-8 inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white">
                        <svg class="w-20 h-20" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <ul class="mt-20 mb-20 ps-4 flex flex-col text-3xl space-y-20 font-medium">
                    <li class="p-5  w-full hover:bg-blue-600 transition-all ">
                        <Link :href="route('public.index')" class="block text-gray-900 hover:text-white hover:no-underline dark:text-white" aria-current="page">Inicio</Link>
                    </li>
                    <li class="p-5 hover:bg-blue-600 transition-all">
                        <Link :href="route('public.impuesto_predial_unificado')" class="block text-gray-900 hover:text-white hover:no-underline dark:text-white">Impuesto predial unificado</Link>
                    </li>
                    <li class="p-5 hover:bg-blue-600 transition-all">
                        <Link v-if="login" href="#" class="block text-gray-900 hover:text-white hover:no-underline dark:text-white">Impuesto industria y comercio</Link>
                        <button type="button" v-else @click="showModal('modalRegistro')" class="block text-gray-900 hover:text-white hover:no-underline dark:text-white">Impuesto industria y comercio</button>
                    </li>
                    <li class="p-5 hover:bg-blue-600 transition-all">
                        <Link v-if="login" href="#" class="block text-gray-900 hover:text-white hover:no-underline dark:text-white">Retención de industria y comercio</Link>
                        <button type="button" v-else @click="showModal('modalRegistro')" class="block text-gray-900 hover:text-white hover:no-underline dark:text-white">Retención de industria y comercio</button>
                    </li>
                    <li class="p-5 hover:bg-blue-600 transition-all">
                        <Link :href="route('public.normatividad')" class="block text-gray-900 hover:text-white hover:no-underline dark:text-white">Normatividad</Link>
                    </li>
                    <li class="p-5  w-full hover:bg-blue-600 transition-all ">
                        <Link :href="route('public.notificaciones')" class="block text-gray-900 hover:text-white hover:no-underline dark:text-white">Notificaciones jurídicas</Link>
                    </li>
                    <li class="p-5  w-full hover:bg-blue-600 transition-all ">
                        <Link :href="route('public.presentacion')" class="block text-gray-900 hover:text-white hover:no-underline dark:text-white">Presentación electrónica</Link>
                    </li>
                    <li class="p-5  w-full hover:bg-blue-600 transition-all ">
                        <Link :href="route('public.contacto')" class="block text-gray-900 hover:text-white hover:no-underline dark:text-white">Contacto</Link>
                    </li>
                    <li class="p-5  w-full hover:bg-blue-600 transition-all ">
                        <button type="button" @click="showModal('modalRegistro');" class="block text-gray-900 hover:text-white hover:no-underline dark:text-white">Iniciar sesión</button>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <main class="mb-8 ">
        <slot :login ="login" :showModal="showModal" :hideModal="hideModal" :navBarScrollActive="navBarScrollActive" />
    </main>
    <footer class="bg-gray-100 dark:bg-gray-900 mt-10 lg:h-auto md:h-screen p-10">
        <div class="grid grid-cols-1 lg:gap-5 md:gap-14">
            <div>
                <Link :href="tenant.pagina" class="text-center flex items-center flex-col md:justify-center">
                    <img :src="img" class="lg:h-16 md:h-24 mb-3" alt="Logo Entidad" />
                    <span class="self-center lg:text-base font-semibold md:text-2xl whitespace-nowrap dark:text-white">{{ tenant.nombre.toUpperCase() }} - META</span>
                    <span class="lg:text-sm text-gray-900 md:text-xl dark:text-white">{{ tenant.entidad.toUpperCase() }}</span>
                </Link>
            </div>
            <nav>
                <ul class="flex justify-center items-center lg:flex-row md:flex-col lg:space-x-10 md:space-x-0 lg:space-y-0 md:space-y-6 lg:text-base md:text-3xl dark:text-gray-400">
                    <li>
                        <Link :href="route('public.normatividad')" class="hover:underline">Inicio</Link>
                    </li>
                    <li>
                        <Link :href="route('public.normatividad')" class="hover:underline">Normatividad</Link>
                    </li>
                    <li>
                        <Link :href="route('public.notificaciones')" class="hover:underline">Notificaciones jurídicas</Link>
                    </li>
                    <li>
                        <Link :href="route('public.presentacion')" class="hover:underline">Presentación electrónica</Link>
                    </li>
                    <li>
                        <Link :href="route('public.contacto')" class="hover:underline">Contacto</Link>
                    </li>
                    <li> <Link :href="route('public.preguntas')" class="hover:underline">Preguntas frecuentes</Link></li>
                </ul>
            </nav>
            <ListRedesSociales :tenant ="tenant" class="flex justify-center"/>
        </div>
        <hr class="my-6 border-gray-200 sm:mx-auto dark:border-gray-700 lg:my-8" />
        <ul class="flex justify-center space-x-6 lg:text-base md:text-2xl text-gray-500 dark:text-gray-400 font-medium">
            <li v-if="tenant.telefono">
                <div class="flex space-x-2 items-center">
                    <svg class="lg:w-4 lg:h-4 md:w-7 md:h-7 dark:fill-gray-400" xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 512 512"><path d="M164.9 24.6c-7.7-18.6-28-28.5-47.4-23.2l-88 24C12.1 30.2 0 46 0 64C0 311.4 200.6 512 448 512c18 0 33.8-12.1 38.6-29.5l24-88c5.3-19.4-4.6-39.7-23.2-47.4l-96-40c-16.3-6.8-35.2-2.1-46.3 11.6L304.7 368C234.3 334.7 177.3 277.7 144 207.3L193.3 167c13.7-11.2 18.4-30 11.6-46.3l-40-96z"/></svg>
                    <span>{{ tenant.telefono }}</span>
                </div>
            </li>
            <li v-if="tenant.correo">
                <div class="flex space-x-2 items-center">
                    <svg class="lg:w-4 lg:h-4 md:w-7 md:h-7" xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 512 512"><path d="M48 64C21.5 64 0 85.5 0 112c0 15.1 7.1 29.3 19.2 38.4L236.8 313.6c11.4 8.5 27 8.5 38.4 0L492.8 150.4c12.1-9.1 19.2-23.3 19.2-38.4c0-26.5-21.5-48-48-48H48zM0 176V384c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V176L294.4 339.2c-22.8 17.1-54 17.1-76.8 0L0 176z"/></svg>
                    <span>{{ tenant.correo }}</span>
                </div>
            </li>
            <li v-if="tenant.pagina">
                <Link :href="tenant.pagina" class="flex space-x-2 items-center">
                    <svg class="lg:w-4 lg:h-4 md:w-7 md:h-7" xmlns="http://www.w3.org/2000/svg"   viewBox="0 0 512 512"><path d="M352 256c0 22.2-1.2 43.6-3.3 64H163.3c-2.2-20.4-3.3-41.8-3.3-64s1.2-43.6 3.3-64H348.7c2.2 20.4 3.3 41.8 3.3 64zm28.8-64H503.9c5.3 20.5 8.1 41.9 8.1 64s-2.8 43.5-8.1 64H380.8c2.1-20.6 3.2-42 3.2-64s-1.1-43.4-3.2-64zm112.6-32H376.7c-10-63.9-29.8-117.4-55.3-151.6c78.3 20.7 142 77.5 171.9 151.6zm-149.1 0H167.7c6.1-36.4 15.5-68.6 27-94.7c10.5-23.6 22.2-40.7 33.5-51.5C239.4 3.2 248.7 0 256 0s16.6 3.2 27.8 13.8c11.3 10.8 23 27.9 33.5 51.5c11.6 26 20.9 58.2 27 94.7zm-209 0H18.6C48.6 85.9 112.2 29.1 190.6 8.4C165.1 42.6 145.3 96.1 135.3 160zM8.1 192H131.2c-2.1 20.6-3.2 42-3.2 64s1.1 43.4 3.2 64H8.1C2.8 299.5 0 278.1 0 256s2.8-43.5 8.1-64zM194.7 446.6c-11.6-26-20.9-58.2-27-94.6H344.3c-6.1 36.4-15.5 68.6-27 94.6c-10.5 23.6-22.2 40.7-33.5 51.5C272.6 508.8 263.3 512 256 512s-16.6-3.2-27.8-13.8c-11.3-10.8-23-27.9-33.5-51.5zM135.3 352c10 63.9 29.8 117.4 55.3 151.6C112.2 482.9 48.6 426.1 18.6 352H135.3zm358.1 0c-30 74.1-93.6 130.9-171.9 151.6c25.5-34.2 45.2-87.7 55.3-151.6H493.4z"/></svg>
                    <span>{{ tenant.pagina }}</span>
                </Link>
            </li>
            <li v-if="tenant.direccion">
                <div class="flex space-x-2 items-center">
                    <svg class="lg:w-4 lg:h-4 md:w-7 md:h-7" xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 384 512"><path d="M215.7 499.2C267 435 384 279.4 384 192C384 86 298 0 192 0S0 86 0 192c0 87.4 117 243 168.3 307.2c12.3 15.3 35.1 15.3 47.4 0zM192 128a64 64 0 1 1 0 128 64 64 0 1 1 0-128z"/></svg>
                    <span>{{ tenant.direccion }}</span>
                </div>
            </li>
        </ul>
        <div class="flex justify-center">
            <span class="text-center lg:text-sm md:text-2xl text-gray-500 sm:text-center dark:text-gray-400 ">© 2024 <a href="#" class="hover:underline lg:text-sm md:text-2xl">Ideal 10 sas</a>. Todos los derechos reservados.</span>
        </div>
        <!--<div class="mx-auto w-full max-w-screen-xl p-4 py-6 lg:py-8 lg:flex lg:items-center justify-between lg:flex-row md:flex-col">
            <div class="mb-6">
                <Link :href="tenant.pagina" class="flex items-center md:justify-center">
                    <img :src="img" class="lg:h-8 me-3 md:h-24" alt="Logo Entidad" />
                    <div class="flex flex-col">
                        <span class="self-center lg:text-base font-semibold md:text-2xl whitespace-nowrap dark:text-white">{{ tenant.nombre.toUpperCase() }} - META</span>
                        <span class="lg:text-sm text-gray-900 md:text-xl dark:text-white">{{ tenant.entidad.toUpperCase() }}</span>
                    </div>
                </Link>
            </div>
            <div class="grid grid-cols-2 gap-8 sm:gap-6 sm:grid-cols-3 md:text-center">
                <div>
                    <h2 class="mb-6 lg:text-sm md:text-2xl font-semibold text-gray-900 uppercase dark:text-white">Centro de ayuda</h2>
                    <ul class="lg:text-base md:text-2xl text-gray-500 dark:text-gray-400 font-medium">
                        <li class="mb-4">
                            <Link :href="route('public.preguntas')" class="hover:underline">Preguntas frecuentes</Link>
                        </li>
                        <li class="mb-4">
                            <Link :href="route('public.manuales')" class="hover:underline">Manuales de sistema</Link>
                        </li>
                    </ul>
                </div>
                <div>
                    <h2 class="mb-6 lg:text-sm md:text-2xl font-semibold text-gray-900 uppercase dark:text-white">Líneas de atención</h2>
                    <ul class="lg:text-base md:text-2xl text-gray-500 dark:text-gray-400 font-medium">
                        <li class="mb-4">
                            <div class="flex space-x-2 items-center">
                                <svg class="lg:w-3 lg:h-3 md:w-7 md:h-7" xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 512 512"><path d="M164.9 24.6c-7.7-18.6-28-28.5-47.4-23.2l-88 24C12.1 30.2 0 46 0 64C0 311.4 200.6 512 448 512c18 0 33.8-12.1 38.6-29.5l24-88c5.3-19.4-4.6-39.7-23.2-47.4l-96-40c-16.3-6.8-35.2-2.1-46.3 11.6L304.7 368C234.3 334.7 177.3 277.7 144 207.3L193.3 167c13.7-11.2 18.4-30 11.6-46.3l-40-96z"/></svg>
                                <span>{{ tenant.telefono }}</span>
                            </div>
                        </li>
                        <li class="mb-4">
                            <div class="flex space-x-2 items-center">
                                <svg class="lg:w-3 lg:h-3 md:w-7 md:h-7" xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 512 512"><path d="M48 64C21.5 64 0 85.5 0 112c0 15.1 7.1 29.3 19.2 38.4L236.8 313.6c11.4 8.5 27 8.5 38.4 0L492.8 150.4c12.1-9.1 19.2-23.3 19.2-38.4c0-26.5-21.5-48-48-48H48zM0 176V384c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V176L294.4 339.2c-22.8 17.1-54 17.1-76.8 0L0 176z"/></svg>
                                <span>{{ tenant.correo }}</span>
                            </div>
                        </li>
                        <li class="mb-4">
                            <Link :href="tenant.pagina" class="flex space-x-2 items-center">
                                <svg class="lg:w-3 lg:h-3 md:w-7 md:h-7" xmlns="http://www.w3.org/2000/svg"   viewBox="0 0 512 512"><path d="M352 256c0 22.2-1.2 43.6-3.3 64H163.3c-2.2-20.4-3.3-41.8-3.3-64s1.2-43.6 3.3-64H348.7c2.2 20.4 3.3 41.8 3.3 64zm28.8-64H503.9c5.3 20.5 8.1 41.9 8.1 64s-2.8 43.5-8.1 64H380.8c2.1-20.6 3.2-42 3.2-64s-1.1-43.4-3.2-64zm112.6-32H376.7c-10-63.9-29.8-117.4-55.3-151.6c78.3 20.7 142 77.5 171.9 151.6zm-149.1 0H167.7c6.1-36.4 15.5-68.6 27-94.7c10.5-23.6 22.2-40.7 33.5-51.5C239.4 3.2 248.7 0 256 0s16.6 3.2 27.8 13.8c11.3 10.8 23 27.9 33.5 51.5c11.6 26 20.9 58.2 27 94.7zm-209 0H18.6C48.6 85.9 112.2 29.1 190.6 8.4C165.1 42.6 145.3 96.1 135.3 160zM8.1 192H131.2c-2.1 20.6-3.2 42-3.2 64s1.1 43.4 3.2 64H8.1C2.8 299.5 0 278.1 0 256s2.8-43.5 8.1-64zM194.7 446.6c-11.6-26-20.9-58.2-27-94.6H344.3c-6.1 36.4-15.5 68.6-27 94.6c-10.5 23.6-22.2 40.7-33.5 51.5C272.6 508.8 263.3 512 256 512s-16.6-3.2-27.8-13.8c-11.3-10.8-23-27.9-33.5-51.5zM135.3 352c10 63.9 29.8 117.4 55.3 151.6C112.2 482.9 48.6 426.1 18.6 352H135.3zm358.1 0c-30 74.1-93.6 130.9-171.9 151.6c25.5-34.2 45.2-87.7 55.3-151.6H493.4z"/></svg>
                                <span>{{ tenant.pagina }}</span>
                            </Link>
                        </li>
                    </ul>
                </div>
                <div>
                    <h2 class="mb-6 lg:text-sm md:text-2xl font-semibold text-gray-900 uppercase dark:text-white">Dirección</h2>
                    <ul class="lg:text-base md:text-2xl text-gray-500 dark:text-gray-400 font-medium">
                        <li class="mb-4">
                            <div class="flex space-x-2 items-center">
                                <svg class="lg:w-3 lg:h-3 md:w-7 md:h-7" xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 384 512"><path d="M215.7 499.2C267 435 384 279.4 384 192C384 86 298 0 192 0S0 86 0 192c0 87.4 117 243 168.3 307.2c12.3 15.3 35.1 15.3 47.4 0zM192 128a64 64 0 1 1 0 128 64 64 0 1 1 0-128z"/></svg>
                                <span>{{ tenant.direccion }}</span>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <hr class="my-6 border-gray-200 sm:mx-auto dark:border-gray-700 lg:my-8" />

        <div class="w-full mx-auto max-w-screen-xl p-4 md:flex md:items-center md:justify-between md:flex-col">
            <span class="lg:text-sm md:text-2xl text-gray-500 sm:text-center dark:text-gray-400 ">© 2023 <a href="#" class="hover:underline lg:text-sm md:text-2xl">Ideal 10 sas</a>. Todos los derechos reservados.</span>
            <ul class="flex flex-wrap items-center mt-3 lg:text-sm md:text-xl font-medium text-gray-500 dark:text-gray-400 sm:mt-0">
                <li>
                    <Link :href="route('public.normatividad')" class="hover:underline me-4 md:me-6">Normatividad</Link>
                </li>
                <li>
                    <Link :href="route('public.notificaciones')" class="hover:underline me-4 md:me-6">Notificaciones jurídicas</Link>
                </li>
                <li>
                    <Link :href="route('public.presentacion')" class="hover:underline me-4 md:me-6">Presentación electrónica</Link>
                </li>
                <li>
                    <Link :href="route('public.contacto')" class="hover:underline">Contacto</Link>
                </li>
            </ul>
        </div>-->
    </footer>
</template>

<script setup>
import { onMounted, ref } from 'vue'
import { Link } from '@inertiajs/vue3'
import { initFlowbite, Modal } from 'flowbite'
import ModalRegistro from './Components/ModalRegistro.vue'
import ListRedesSociales from './Components/ListRedesSociales.vue'

onMounted(() => {
    initFlowbite()
})

const props = defineProps({ tenant: Object })

const activeTab = ref('')
const login = ref(false)
const mobileNav = ref(false)
const navBarScrollActive = ref(false)
const img = 'data:image/png;base64,' + props.tenant.imagen

function showModal(id) {
    new Modal(document.getElementById(id), {
        backdrop: 'static',
        closable: true
    }).show()

    mobileNav.value = false
}

function hideModal(id) {
    new Modal(document.getElementById(id)).hide()
}

function openMobileNav() {
    mobileNav.value = !mobileNav.value
}

window.document.onscroll = () => {
    let navBar = document.getElementById("main-nav")
    if(window.scrollY > navBar.offsetTop){
        navBarScrollActive.value = true;
    }else{
        navBarScrollActive.value = false;
    }

}
</script>

<style>
    html{
        scroll-behavior: smooth;
    }
</style>
