<template>
    <Layout :tenant="tenant" v-slot="{ login, showModal, hideModal }">
        <div id="controls-carousel" class="relative w-full" data-carousel="static">
            <!-- Carousel wrapper -->
            <div class="relative h-56 overflow-hidden rounded-lg md:h-98">
                <!-- Item 1 -->
                <div class="hidden duration-700 ease-in-out" data-carousel-item>
                    <img :src="banner" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
                </div>
                <!-- Item 2 -->
                <div class="hidden duration-700 ease-in-out" data-carousel-item="active">
                    <img :src="banner" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
                </div>
            </div>
            <!-- Slider controls -->
            <button type="button" class="absolute top-0 start-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-prev>
                <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                    <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 1 1 5l4 4"/>
                    </svg>
                    <span class="sr-only">Previous</span>
                </span>
            </button>
            <button type="button" class="absolute top-0 end-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-next>
                <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                    <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                    </svg>
                    <span class="sr-only">Next</span>
                </span>
            </button>
        </div>
        <h2 class="text-2xl md:text-4xl text-center font-medium text-gray-900 dark:text-white mb-8 mt-5">Selección de impuestos</h2>
        <div class="grid lg:grid-cols-3 gap-4 h-72 md:grid-cols-1 md:h-full">
            <div class="lg:w-full lg:h-72  bg-white dark:bg-gray-900 relative">
                <a :href="route('public.impuesto_predial_unificado')" class="flex justify-center items-center">
                    <svg class="lg:w-56 lg:h-56 md:h-96 md:w-96" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0,0,256,256"><defs><linearGradient x1="48" y1="41.583" x2="48" y2="50.252" gradientUnits="userSpaceOnUse" id="color-1"><stop offset="0" stop-color="#84b6f4"></stop><stop offset="1" stop-color="#b0f2c2"></stop></linearGradient><linearGradient x1="26" y1="11.833" x2="26" y2="52.17" gradientUnits="userSpaceOnUse" id="color-2"><stop offset="0" stop-color="#77dd77"></stop><stop offset="1" stop-color="#84b6f4"></stop></linearGradient><linearGradient x1="25" y1="11.833" x2="25" y2="52.17" gradientUnits="userSpaceOnUse" id="color-3"><stop offset="0" stop-color="#77dd77"></stop><stop offset="1" stop-color="#84b6f4"></stop></linearGradient><linearGradient x1="32" y1="11.833" x2="32" y2="52.17" gradientUnits="userSpaceOnUse" id="color-4"><stop offset="0" stop-color="#77dd77"></stop><stop offset="1" stop-color="#84b6f4"></stop></linearGradient></defs><g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal"><g transform="scale(4,4)"><path d="M50,42h-4c-0.552,0 -1,0.448 -1,1v7h6v-7c0,-0.552 -0.448,-1 -1,-1z" fill="url(#color-1)"></path><path d="M25,41h2v4h-2z" fill="url(#color-2)"></path><path d="M19,30h12v2h-12z" fill="url(#color-3)"></path><path d="M56,32v-2c0,-1.103 -0.897,-2 -2,-2h-12v-2c1.103,0 2,-0.897 2,-2v-2c0,-1.103 -0.897,-2 -2,-2h-0.382l-3.447,-6.895c-0.342,-0.681 -1.027,-1.105 -1.79,-1.105h-22.762c-0.763,0 -1.448,0.424 -1.791,1.106l-3.446,6.894h-0.382c-1.103,0 -2,0.897 -2,2v2c0,1.103 0.897,2 2,2v24c0,1.103 0.897,2 2,2h9h12h9h2h12c1.103,0 2,-0.897 2,-2v-12c1.103,0 2,-0.897 2,-2v-2c0,-1.103 -0.897,-2 -2,-2zM54,30v2h-12v-2zM13.619,14h22.762l3.001,6h-28.764zM8,22h34v2h-34zM40,26v6v4v2v4h-4v2h4v2h-9v-9c0,-1.654 -1.346,-3 -3,-3h-6c-1.654,0 -3,1.346 -3,3v9h-9v-2h4v-2h-4v-16zM10,50v-2h9v2zM21,50v-13c0,-0.552 0.448,-1 1,-1h6c0.552,0 1,0.448 1,1v13zM31,50v-2h9v2zM54,50h-12v-12h12zM56,36h-14v-2h14z" fill="url(#color-4)"></path></g></g></svg>
                </a>
                <div class=" flex lg:p-4 justify-center lg:absolute lg:bottom-0 lg:w-full md:p-2">
                    <a :href="route('public.impuesto_predial_unificado')" class="py-2.5 px-5 mb-2 font-medium text-white focus:outline-none bg-greenp1 rounded-lg border border-gray-200 lg:text-sm md:text-3xl dark:bg-greenp1 dark:text-white">
                        Predial unificado
                    </a>
                </div>
            </div>
            <div v-if="login" class="lg:w-full lg:h-72  bg-white dark:bg-gray-900 relative">
                <a href="#" class="flex justify-center items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="lg:w-56 lg:h-56 md:h-96 md:w-96" viewBox="0 0 180 140"  xmlns:v="https://vecta.io/nano"><path d="M7.692 56.129h5.641v78.065H7.692V56.129z" fill="url(#A)"/><path d="M31.795 20h5.641v39.355h-5.641V20z" fill="url(#A)"/><path d="M26.154 65.161h5.641v23.226h-5.641V65.161z" fill="url(#A)"/><path d="M44.615 65.161h5.641v23.226h-5.641V65.161z" fill="url(#A)"/><path d="M50.256 12.903V20H31.795v-7.097h18.462z" fill="url(#A)"/><path d="M44.615 20h5.641v39.355h-5.641V20z" fill="url(#A)"/><path d="M71.795 20h5.641v39.355h-5.641V20z" fill="url(#A)"/><path d="M90.256 12.903V20H71.795v-7.097h18.462z" fill="url(#A)"/><path d="M84.615 20h5.641v39.355h-5.641V20z" fill="url(#A)"/><path d="M35.385 101.935h5.641v32.259h-5.641v-32.259z" fill="url(#A)"/><path d="M90.256 101.935h5.641v32.259h-5.641v-32.259z" fill="url(#A)"/><path d="M126.667 52.258v7.097H84.615v-7.097h42.052z" fill="url(#A)"/><path d="M77.436 52.258v7.097h-32.82v-7.097h32.821z" fill="url(#A)"/><path d="M50.256 65.161v7.097H26.154v-7.097h24.103z" fill="url(#A)"/><path d="M50.256 81.29v7.097H26.154V81.29h24.103z" fill="url(#A)"/><path d="M81.539 65.161h5.641v23.226h-5.641V65.161z" fill="url(#A)"/><path d="M100 65.161h5.641v23.226H100V65.161z" fill="url(#A)"/><path d="M105.641 65.161v7.097H81.539v-7.097h24.103z" fill="url(#A)"/><path d="M105.641 81.29v7.097H81.539V81.29h24.103z" fill="url(#A)"/><path d="M37.436 52.258v7.097H7.692v-7.097h29.744z" fill="url(#A)"/><path d="M95.897 94.839v7.096H35.385v-7.096h60.513z" fill="url(#A)"/><path d="M129.311 16.636l4.995.863-12.901 118.252-4.995-.862 12.901-118.253z" fill="url(#A)"/><path d="M167.773 135.244l4.995-.863-12.901-118.252-4.995.862 12.901 118.253z" fill="url(#A)"/><path d="M0 134.194h180V140H0v-5.806z" fill="url(#A)"/><path d="M121.538 5.806h46.154v5.806h-46.154V5.806z" fill="url(#A)"/><path d="M121.538 11.613h46.154v5.807h-46.154v-5.806z" fill="url(#A)"/><path d="M118.974 0h51.282v5.806h-51.282V0z" fill="url(#A)"/><path d="M149.231 60h14.359v5.161h-14.359V60z" fill="url(#A)"/><path d="M145.128 77.419h18.462v5.161h-18.462v-5.161z" fill="url(#A)"/><path d="M140 94.839h25.128V100H140v-5.161z" fill="url(#A)"/><path d="M12.308 121.29h23.077v6.452H12.308v-6.452z" fill="url(#A)"/><path d="M12.308 127.742h23.077v6.452H12.308v-6.452z" fill="url(#A)"/><path d="M95.897 121.29h23.077v6.452H95.897v-6.452z" fill="url(#A)"/><path d="M95.897 127.742h23.077v6.452H95.897v-6.452z" fill="url(#A)"/><defs><linearGradient id="A" x1="90" y1="0" x2="90" y2="140" gradientUnits="userSpaceOnUse"><stop stop-color="#84b6f4"/><stop offset=".305" stop-color="#b0f2c2"/><stop offset=".675" stop-color="#7d7"/><stop offset=".985" stop-color="#84b6f4"/></linearGradient></defs></svg>
                </a>
                <div class=" flex lg:p-4 justify-center lg:absolute lg:bottom-0 lg:w-full md:p-2">
                    <a  href="#" class="py-2.5 px-5 mb-2 font-medium text-white focus:outline-none bg-greenp1 rounded-lg border border-gray-200 lg:text-sm md:text-3xl dark:bg-greenp1 dark:text-white">
                        Industria y comercio
                    </a>
                </div>
            </div>
            <div v-else class="lg:w-full lg:h-72  bg-white dark:bg-gray-900 relative">
                <div>
                    <div @click="showModal('modalRegistro')" class="cursor-pointer flex justify-center items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="lg:w-56 lg:h-56 md:h-96 md:w-96" viewBox="0 0 180 140"  xmlns:v="https://vecta.io/nano"><path d="M7.692 56.129h5.641v78.065H7.692V56.129z" fill="url(#A)"/><path d="M31.795 20h5.641v39.355h-5.641V20z" fill="url(#A)"/><path d="M26.154 65.161h5.641v23.226h-5.641V65.161z" fill="url(#A)"/><path d="M44.615 65.161h5.641v23.226h-5.641V65.161z" fill="url(#A)"/><path d="M50.256 12.903V20H31.795v-7.097h18.462z" fill="url(#A)"/><path d="M44.615 20h5.641v39.355h-5.641V20z" fill="url(#A)"/><path d="M71.795 20h5.641v39.355h-5.641V20z" fill="url(#A)"/><path d="M90.256 12.903V20H71.795v-7.097h18.462z" fill="url(#A)"/><path d="M84.615 20h5.641v39.355h-5.641V20z" fill="url(#A)"/><path d="M35.385 101.935h5.641v32.259h-5.641v-32.259z" fill="url(#A)"/><path d="M90.256 101.935h5.641v32.259h-5.641v-32.259z" fill="url(#A)"/><path d="M126.667 52.258v7.097H84.615v-7.097h42.052z" fill="url(#A)"/><path d="M77.436 52.258v7.097h-32.82v-7.097h32.821z" fill="url(#A)"/><path d="M50.256 65.161v7.097H26.154v-7.097h24.103z" fill="url(#A)"/><path d="M50.256 81.29v7.097H26.154V81.29h24.103z" fill="url(#A)"/><path d="M81.539 65.161h5.641v23.226h-5.641V65.161z" fill="url(#A)"/><path d="M100 65.161h5.641v23.226H100V65.161z" fill="url(#A)"/><path d="M105.641 65.161v7.097H81.539v-7.097h24.103z" fill="url(#A)"/><path d="M105.641 81.29v7.097H81.539V81.29h24.103z" fill="url(#A)"/><path d="M37.436 52.258v7.097H7.692v-7.097h29.744z" fill="url(#A)"/><path d="M95.897 94.839v7.096H35.385v-7.096h60.513z" fill="url(#A)"/><path d="M129.311 16.636l4.995.863-12.901 118.252-4.995-.862 12.901-118.253z" fill="url(#A)"/><path d="M167.773 135.244l4.995-.863-12.901-118.252-4.995.862 12.901 118.253z" fill="url(#A)"/><path d="M0 134.194h180V140H0v-5.806z" fill="url(#A)"/><path d="M121.538 5.806h46.154v5.806h-46.154V5.806z" fill="url(#A)"/><path d="M121.538 11.613h46.154v5.807h-46.154v-5.806z" fill="url(#A)"/><path d="M118.974 0h51.282v5.806h-51.282V0z" fill="url(#A)"/><path d="M149.231 60h14.359v5.161h-14.359V60z" fill="url(#A)"/><path d="M145.128 77.419h18.462v5.161h-18.462v-5.161z" fill="url(#A)"/><path d="M140 94.839h25.128V100H140v-5.161z" fill="url(#A)"/><path d="M12.308 121.29h23.077v6.452H12.308v-6.452z" fill="url(#A)"/><path d="M12.308 127.742h23.077v6.452H12.308v-6.452z" fill="url(#A)"/><path d="M95.897 121.29h23.077v6.452H95.897v-6.452z" fill="url(#A)"/><path d="M95.897 127.742h23.077v6.452H95.897v-6.452z" fill="url(#A)"/><defs><linearGradient id="A" x1="90" y1="0" x2="90" y2="140" gradientUnits="userSpaceOnUse"><stop stop-color="#84b6f4"/><stop offset=".305" stop-color="#b0f2c2"/><stop offset=".675" stop-color="#7d7"/><stop offset=".985" stop-color="#84b6f4"/></linearGradient></defs></svg>
                    </div>
                    <div class=" flex lg:p-4 justify-center lg:absolute lg:bottom-0 lg:w-full md:p-2">
                        <button type="button" @click="showModal('modalRegistro')" class="py-2.5 px-5 mb-2 font-medium text-white focus:outline-none bg-greenp1 rounded-lg border border-gray-200 lg:text-sm md:text-3xl dark:bg-greenp1 dark:text-white">
                            Industria y comercio
                        </button>
                    </div>
                </div>
            </div>
            <div v-if="login" class="lg:w-full lg:h-72  bg-white dark:bg-gray-900 relative">
                <a href="#" class="flex justify-center items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0,0,256,256" class="lg:w-56 lg:h-56 md:h-96 md:w-96"><defs><linearGradient x1="41" y1="25.5" x2="41" y2="36.571" gradientUnits="userSpaceOnUse" id="color-1"><stop offset="0" stop-color="#84b6f4"></stop><stop offset="1" stop-color="#b0f2c2"></stop></linearGradient><linearGradient x1="32" y1="5.75" x2="32" y2="57.868" gradientUnits="userSpaceOnUse" id="color-2"><stop offset="0" stop-color="#77dd77"></stop><stop offset="1" stop-color="#84b6f4"></stop></linearGradient><linearGradient x1="32" y1="5.75" x2="32" y2="57.868" gradientUnits="userSpaceOnUse" id="color-3"><stop offset="0" stop-color="#77dd77"></stop><stop offset="1" stop-color="#84b6f4"></stop></linearGradient><linearGradient x1="26" y1="5.75" x2="26" y2="57.868" gradientUnits="userSpaceOnUse" id="color-4"><stop offset="0" stop-color="#77dd77"></stop><stop offset="1" stop-color="#84b6f4"></stop></linearGradient><linearGradient x1="26" y1="5.75" x2="26" y2="57.868" gradientUnits="userSpaceOnUse" id="color-5"><stop offset="0" stop-color="#77dd77"></stop><stop offset="1" stop-color="#84b6f4"></stop></linearGradient><linearGradient x1="26" y1="5.75" x2="26" y2="57.868" gradientUnits="userSpaceOnUse" id="color-6"><stop offset="0" stop-color="#77dd77"></stop><stop offset="1" stop-color="#84b6f4"></stop></linearGradient><linearGradient x1="41" y1="5.75" x2="41" y2="57.868" gradientUnits="userSpaceOnUse" id="color-7"><stop offset="0" stop-color="#77dd77"></stop><stop offset="1" stop-color="#84b6f4"></stop></linearGradient><linearGradient x1="20" y1="5.75" x2="20" y2="57.868" gradientUnits="userSpaceOnUse" id="color-8"><stop offset="0" stop-color="#77dd77"></stop><stop offset="1" stop-color="#84b6f4"></stop></linearGradient><linearGradient x1="24" y1="5.75" x2="24" y2="57.868" gradientUnits="userSpaceOnUse" id="color-9"><stop offset="0" stop-color="#77dd77"></stop><stop offset="1" stop-color="#84b6f4"></stop></linearGradient><linearGradient x1="28" y1="5.75" x2="28" y2="57.868" gradientUnits="userSpaceOnUse" id="color-10"><stop offset="0" stop-color="#77dd77"></stop><stop offset="1" stop-color="#84b6f4"></stop></linearGradient><linearGradient x1="32" y1="5.75" x2="32" y2="57.868" gradientUnits="userSpaceOnUse" id="color-11"><stop offset="0" stop-color="#77dd77"></stop><stop offset="1" stop-color="#84b6f4"></stop></linearGradient><linearGradient x1="43" y1="5.75" x2="43" y2="57.868" gradientUnits="userSpaceOnUse" id="color-12"><stop offset="0" stop-color="#77dd77"></stop><stop offset="1" stop-color="#84b6f4"></stop></linearGradient><linearGradient x1="26" y1="5.75" x2="26" y2="57.868" gradientUnits="userSpaceOnUse" id="color-13"><stop offset="0" stop-color="#77dd77"></stop><stop offset="1" stop-color="#84b6f4"></stop></linearGradient></defs><g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal"><g transform="scale(4,4)"><path d="M38,36h6c0.552,0 1,-0.448 1,-1v-8c0,-0.552 -0.448,-1 -1,-1h-6c-0.552,0 -1,0.448 -1,1v8c0,0.552 0.448,1 1,1z" fill="url(#color-1)"></path><path d="M49,10h-2c0,-1.103 -0.897,-2 -2,-2h-8c0,-1.103 -0.897,-2 -2,-2h-6c-1.103,0 -2,0.897 -2,2h-8c-1.103,0 -2,0.897 -2,2h-2c-1.103,0 -2,0.897 -2,2v44c0,1.103 0.897,2 2,2h34c1.103,0 2,-0.897 2,-2v-44c0,-1.103 -0.897,-2 -2,-2zM29,8h6v5c0,1.654 -1.346,3 -3,3c-1.654,0 -3,-1.346 -3,-3zM15,12h12v1c0,2.757 2.243,5 5,5c2.757,0 5,-2.243 5,-5v-1h12v32h-10c-1.103,0 -2,0.897 -2,2v10h-22zM39,56v-10h10v10z" fill="url(#color-2)"></path><path d="M19,22h26v2h-26z" fill="url(#color-3)"></path><path d="M19,26h14v2h-14z" fill="url(#color-4)"></path><path d="M19,30h14v2h-14z" fill="url(#color-5)"></path><path d="M19,34h14v2h-14z" fill="url(#color-6)"></path><path d="M37,38h8v2h-8z" fill="url(#color-7)"></path><path d="M19,48h2v4h-2z" fill="url(#color-8)"></path><path d="M23,48h2v4h-2z" fill="url(#color-9)"></path><path d="M27,48h2v4h-2z" fill="url(#color-10)"></path><path d="M31,48h2v4h-2z" fill="url(#color-11)"></path><path d="M41,50v2h2v-2h2v-2h-2c-1.103,0 -2,0.897 -2,2z" fill="url(#color-12)"></path><path d="M19,38h14v2h-14z" fill="url(#color-13)"></path></g></g></svg>
                </a>
                <div class=" flex lg:p-4 justify-center lg:absolute lg:bottom-0 lg:w-full md:p-2">
                    <a href="#" class="py-2.5 px-5 mb-2 font-medium text-white focus:outline-none bg-greenp1 rounded-lg border border-gray-200 lg:text-sm md:text-3xl dark:bg-greenp1 dark:text-white">
                        Retención
                    </a>
                </div>
            </div>
            <div v-else class="lg:w-full lg:h-72  bg-white dark:bg-gray-900 relative">
                <div @click="showModal('modalRegistro')" class="cursor-pointer flex justify-center items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0,0,256,256" class="lg:w-56 lg:h-56 md:h-96 md:w-96"><defs><linearGradient x1="41" y1="25.5" x2="41" y2="36.571" gradientUnits="userSpaceOnUse" id="color-1"><stop offset="0" stop-color="#84b6f4"></stop><stop offset="1" stop-color="#b0f2c2"></stop></linearGradient><linearGradient x1="32" y1="5.75" x2="32" y2="57.868" gradientUnits="userSpaceOnUse" id="color-2"><stop offset="0" stop-color="#77dd77"></stop><stop offset="1" stop-color="#84b6f4"></stop></linearGradient><linearGradient x1="32" y1="5.75" x2="32" y2="57.868" gradientUnits="userSpaceOnUse" id="color-3"><stop offset="0" stop-color="#77dd77"></stop><stop offset="1" stop-color="#84b6f4"></stop></linearGradient><linearGradient x1="26" y1="5.75" x2="26" y2="57.868" gradientUnits="userSpaceOnUse" id="color-4"><stop offset="0" stop-color="#77dd77"></stop><stop offset="1" stop-color="#84b6f4"></stop></linearGradient><linearGradient x1="26" y1="5.75" x2="26" y2="57.868" gradientUnits="userSpaceOnUse" id="color-5"><stop offset="0" stop-color="#77dd77"></stop><stop offset="1" stop-color="#84b6f4"></stop></linearGradient><linearGradient x1="26" y1="5.75" x2="26" y2="57.868" gradientUnits="userSpaceOnUse" id="color-6"><stop offset="0" stop-color="#77dd77"></stop><stop offset="1" stop-color="#84b6f4"></stop></linearGradient><linearGradient x1="41" y1="5.75" x2="41" y2="57.868" gradientUnits="userSpaceOnUse" id="color-7"><stop offset="0" stop-color="#77dd77"></stop><stop offset="1" stop-color="#84b6f4"></stop></linearGradient><linearGradient x1="20" y1="5.75" x2="20" y2="57.868" gradientUnits="userSpaceOnUse" id="color-8"><stop offset="0" stop-color="#77dd77"></stop><stop offset="1" stop-color="#84b6f4"></stop></linearGradient><linearGradient x1="24" y1="5.75" x2="24" y2="57.868" gradientUnits="userSpaceOnUse" id="color-9"><stop offset="0" stop-color="#77dd77"></stop><stop offset="1" stop-color="#84b6f4"></stop></linearGradient><linearGradient x1="28" y1="5.75" x2="28" y2="57.868" gradientUnits="userSpaceOnUse" id="color-10"><stop offset="0" stop-color="#77dd77"></stop><stop offset="1" stop-color="#84b6f4"></stop></linearGradient><linearGradient x1="32" y1="5.75" x2="32" y2="57.868" gradientUnits="userSpaceOnUse" id="color-11"><stop offset="0" stop-color="#77dd77"></stop><stop offset="1" stop-color="#84b6f4"></stop></linearGradient><linearGradient x1="43" y1="5.75" x2="43" y2="57.868" gradientUnits="userSpaceOnUse" id="color-12"><stop offset="0" stop-color="#77dd77"></stop><stop offset="1" stop-color="#84b6f4"></stop></linearGradient><linearGradient x1="26" y1="5.75" x2="26" y2="57.868" gradientUnits="userSpaceOnUse" id="color-13"><stop offset="0" stop-color="#77dd77"></stop><stop offset="1" stop-color="#84b6f4"></stop></linearGradient></defs><g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal"><g transform="scale(4,4)"><path d="M38,36h6c0.552,0 1,-0.448 1,-1v-8c0,-0.552 -0.448,-1 -1,-1h-6c-0.552,0 -1,0.448 -1,1v8c0,0.552 0.448,1 1,1z" fill="url(#color-1)"></path><path d="M49,10h-2c0,-1.103 -0.897,-2 -2,-2h-8c0,-1.103 -0.897,-2 -2,-2h-6c-1.103,0 -2,0.897 -2,2h-8c-1.103,0 -2,0.897 -2,2h-2c-1.103,0 -2,0.897 -2,2v44c0,1.103 0.897,2 2,2h34c1.103,0 2,-0.897 2,-2v-44c0,-1.103 -0.897,-2 -2,-2zM29,8h6v5c0,1.654 -1.346,3 -3,3c-1.654,0 -3,-1.346 -3,-3zM15,12h12v1c0,2.757 2.243,5 5,5c2.757,0 5,-2.243 5,-5v-1h12v32h-10c-1.103,0 -2,0.897 -2,2v10h-22zM39,56v-10h10v10z" fill="url(#color-2)"></path><path d="M19,22h26v2h-26z" fill="url(#color-3)"></path><path d="M19,26h14v2h-14z" fill="url(#color-4)"></path><path d="M19,30h14v2h-14z" fill="url(#color-5)"></path><path d="M19,34h14v2h-14z" fill="url(#color-6)"></path><path d="M37,38h8v2h-8z" fill="url(#color-7)"></path><path d="M19,48h2v4h-2z" fill="url(#color-8)"></path><path d="M23,48h2v4h-2z" fill="url(#color-9)"></path><path d="M27,48h2v4h-2z" fill="url(#color-10)"></path><path d="M31,48h2v4h-2z" fill="url(#color-11)"></path><path d="M41,50v2h2v-2h2v-2h-2c-1.103,0 -2,0.897 -2,2z" fill="url(#color-12)"></path><path d="M19,38h14v2h-14z" fill="url(#color-13)"></path></g></g></svg>
                </div>
                <div class=" flex lg:p-4 justify-center lg:absolute lg:bottom-0 lg:w-full md:p-2">
                    <button type="button" @click="showModal('modalRegistro')" class="py-2.5 px-5 mb-2 font-medium text-white focus:outline-none bg-greenp1 rounded-lg border border-gray-200 lg:text-sm md:text-3xl dark:bg-greenp1 dark:text-white">
                        Retención
                    </button>
                </div>
            </div>
        </div>
        <section>
            <h2 class="lg:text-2xl md:text-4xl text-center font-medium text-gray-900 dark:text-white mb-8 mt-5">Te puede interesar</h2>
            <div class="grid lg:grid-cols-6 md:grid-cols-3 items-center">
                <div class="mb-3 max-w-sm bg-white dark:bg-gray-900">
                    <a href="#" class="flex justify-center items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="lg:w-14 lg:h-14 md:w-24 md:h-24" viewBox="0 0 640 512"><path opacity="1" fill="#84b6f4" d="M384 32H512c17.7 0 32 14.3 32 32s-14.3 32-32 32H398.4c-5.2 25.8-22.9 47.1-46.4 57.3V448H512c17.7 0 32 14.3 32 32s-14.3 32-32 32H320 128c-17.7 0-32-14.3-32-32s14.3-32 32-32H288V153.3c-23.5-10.3-41.2-31.6-46.4-57.3H128c-17.7 0-32-14.3-32-32s14.3-32 32-32H256c14.6-19.4 37.8-32 64-32s49.4 12.6 64 32zm55.6 288H584.4L512 195.8 439.6 320zM512 416c-62.9 0-115.2-34-126-78.9c-2.6-11 1-22.3 6.7-32.1l95.2-163.2c5-8.6 14.2-13.8 24.1-13.8s19.1 5.3 24.1 13.8l95.2 163.2c5.7 9.8 9.3 21.1 6.7 32.1C627.2 382 574.9 416 512 416zM126.8 195.8L54.4 320H199.3L126.8 195.8zM.9 337.1c-2.6-11 1-22.3 6.7-32.1l95.2-163.2c5-8.6 14.2-13.8 24.1-13.8s19.1 5.3 24.1 13.8l95.2 163.2c5.7 9.8 9.3 21.1 6.7 32.1C242 382 189.7 416 126.8 416S11.7 382 .9 337.1z"/></svg>
                    </a>
                    <div class="p-5 flex justify-center text-center">
                        <a href="#">
                            <h5 class="mb-2 lg:text-base md:text-2xl text-center font-semibold tracking-tight text-gray-900 dark:text-white">Normatividad</h5>
                        </a>
                    </div>
                </div>
                <div class="mb-3 max-w-sm bg-white dark:bg-gray-900">
                    <a href="#" class="flex justify-center items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="lg:w-14 lg:h-14 md:w-24 md:h-24" viewBox="0 0 512 512"><path opacity="1" fill="#84b6f4" d="M280 0C408.1 0 512 103.9 512 232c0 13.3-10.7 24-24 24s-24-10.7-24-24c0-101.6-82.4-184-184-184c-13.3 0-24-10.7-24-24s10.7-24 24-24zm8 192a32 32 0 1 1 0 64 32 32 0 1 1 0-64zm-32-72c0-13.3 10.7-24 24-24c75.1 0 136 60.9 136 136c0 13.3-10.7 24-24 24s-24-10.7-24-24c0-48.6-39.4-88-88-88c-13.3 0-24-10.7-24-24zM117.5 1.4c19.4-5.3 39.7 4.6 47.4 23.2l40 96c6.8 16.3 2.1 35.2-11.6 46.3L144 207.3c33.3 70.4 90.3 127.4 160.7 160.7L345 318.7c11.2-13.7 30-18.4 46.3-11.6l96 40c18.6 7.7 28.5 28 23.2 47.4l-24 88C481.8 499.9 466 512 448 512C200.6 512 0 311.4 0 64C0 46 12.1 30.2 29.5 25.4l88-24z"/></svg>
                    </a>
                    <div class="p-5 flex justify-center dark:p-2 dark:rounded">
                        <a href="#">
                            <h5 class="mb-2 lg:text-base md:text-2xl text-center font-semibold tracking-tight text-gray-900 dark:text-white">Contacto</h5>
                        </a>
                    </div>
                </div>
                <div class="mb-3 max-w-sm bg-white dark:bg-gray-900">
                    <a href="#" class="flex justify-center items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="lg:w-14 lg:h-14 md:w-24 md:h-24" viewBox="0 0 448 512"><path opacity="1" fill="#84b6f4" d="M224 64c-44.2 0-80 35.8-80 80v48H384c35.3 0 64 28.7 64 64V448c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V256c0-35.3 28.7-64 64-64H80V144C80 64.5 144.5 0 224 0c57.5 0 107 33.7 130.1 82.3c7.6 16 .8 35.1-15.2 42.6s-35.1 .8-42.6-15.2C283.4 82.6 255.9 64 224 64zm32 320c17.7 0 32-14.3 32-32s-14.3-32-32-32H192c-17.7 0-32 14.3-32 32s14.3 32 32 32h64z"/></svg>
                    </a>
                    <div class="p-5 flex justify-center dark:p-2 dark:rounded">
                        <a href="#">
                            <h5 class="mb-2 lg:text-base md:text-2xl text-center font-semibold tracking-tight text-gray-900 dark:text-white">Recuperar contraseña</h5>
                        </a>
                    </div>
                </div>
                <div class="mb-3 max-w-sm bg-white dark:bg-gray-900">
                    <a href="#" class="flex justify-center items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="lg:w-14 lg:h-14 md:w-24 md:h-24" viewBox="0 0 448 512"><path opacity="1" fill="#84b6f4" d="M96 0C43 0 0 43 0 96V416c0 53 43 96 96 96H384h32c17.7 0 32-14.3 32-32s-14.3-32-32-32V384c17.7 0 32-14.3 32-32V32c0-17.7-14.3-32-32-32H384 96zm0 384H352v64H96c-17.7 0-32-14.3-32-32s14.3-32 32-32zm32-240c0-8.8 7.2-16 16-16H336c8.8 0 16 7.2 16 16s-7.2 16-16 16H144c-8.8 0-16-7.2-16-16zm16 48H336c8.8 0 16 7.2 16 16s-7.2 16-16 16H144c-8.8 0-16-7.2-16-16s7.2-16 16-16z"/></svg>
                    </a>
                    <div class="p-5 flex justify-center">
                        <a href="#">
                            <h5 class="mb-2 lg:text-base md:text-2xl text-center font-semibold tracking-tight text-gray-900 dark:text-white">Manual</h5>
                        </a>
                    </div>
                </div>
                <div class="mb-3 max-w-sm bg-white dark:bg-gray-900">
                    <a href="#" class="flex justify-center items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="lg:w-14 lg:h-14 md:w-24 md:h-24" viewBox="0 0 576 512"><path opacity="1" fill="#84b6f4" d="M549.7 124.1c-6.3-23.7-24.8-42.3-48.3-48.6C458.8 64 288 64 288 64S117.2 64 74.6 75.5c-23.5 6.3-42 24.9-48.3 48.6-11.4 42.9-11.4 132.3-11.4 132.3s0 89.4 11.4 132.3c6.3 23.7 24.8 41.5 48.3 47.8C117.2 448 288 448 288 448s170.8 0 213.4-11.5c23.5-6.3 42-24.2 48.3-47.8 11.4-42.9 11.4-132.3 11.4-132.3s0-89.4-11.4-132.3zm-317.5 213.5V175.2l142.7 81.2-142.7 81.2z"/></svg>
                    </a>
                    <div class="p-5 flex justify-center">
                        <a href="#">
                            <h5 class="mb-2 lg:text-base md:text-2xl text-center font-semibold tracking-tight text-gray-900 dark:text-white">Videos tutoriales</h5>
                        </a>
                    </div>
                </div>
                <div v-if="!login" class="mb-3 max-w-sm bg-white dark:bg-gray-900">
                    <div @click="showModal('modalRegistro')" class="cursor-pointer">
                        <div  class="flex justify-center items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="lg:w-14 lg:h-14 md:w-24 md:h-24" viewBox="0 0 576 512"><path opacity="1" fill="#84b6f4" d="M64 0C28.7 0 0 28.7 0 64V448c0 35.3 28.7 64 64 64H320c35.3 0 64-28.7 64-64V428.7c-2.7 1.1-5.4 2-8.2 2.7l-60.1 15c-3 .7-6 1.2-9 1.4c-.9 .1-1.8 .2-2.7 .2H240c-6.1 0-11.6-3.4-14.3-8.8l-8.8-17.7c-1.7-3.4-5.1-5.5-8.8-5.5s-7.2 2.1-8.8 5.5l-8.8 17.7c-2.9 5.9-9.2 9.4-15.7 8.8s-12.1-5.1-13.9-11.3L144 381l-9.8 32.8c-6.1 20.3-24.8 34.2-46 34.2H80c-8.8 0-16-7.2-16-16s7.2-16 16-16h8.2c7.1 0 13.3-4.6 15.3-11.4l14.9-49.5c3.4-11.3 13.8-19.1 25.6-19.1s22.2 7.8 25.6 19.1l11.6 38.6c7.4-6.2 16.8-9.7 26.8-9.7c15.9 0 30.4 9 37.5 23.2l4.4 8.8h8.9c-3.1-8.8-3.7-18.4-1.4-27.8l15-60.1c2.8-11.3 8.6-21.5 16.8-29.7L384 203.6V160H256c-17.7 0-32-14.3-32-32V0H64zM256 0V128H384L256 0zM549.8 139.7c-15.6-15.6-40.9-15.6-56.6 0l-29.4 29.4 71 71 29.4-29.4c15.6-15.6 15.6-40.9 0-56.6l-14.4-14.4zM311.9 321c-4.1 4.1-7 9.2-8.4 14.9l-15 60.1c-1.4 5.5 .2 11.2 4.2 15.2s9.7 5.6 15.2 4.2l60.1-15c5.6-1.4 10.8-4.3 14.9-8.4L512.1 262.7l-71-71L311.9 321z"/></svg>
                        </div>
                        <div class="p-2 flex justify-center">
                            <div >
                                <h5 class="mb-2 lg:text-base md:text-2xl text-center font-semibold tracking-tight text-gray-900 dark:text-white">Inscripción de <br>industria y comercio</h5>
                            </div>
                        </div>
                    </div>
                </div>
                <div v-else class="mb-3 max-w-sm bg-white dark:bg-gray-900">
                    <a href="#"  class="mb-3 max-w-sm bg-white dark:bg-gray-800 dark:border-gray-700">
                        <svg xmlns="http://www.w3.org/2000/svg" class="lg:w-14 lg:h-14 md:w-24 md:h-24" viewBox="0 0 576 512"><path opacity="1" fill="#84b6f4" d="M64 0C28.7 0 0 28.7 0 64V448c0 35.3 28.7 64 64 64H320c35.3 0 64-28.7 64-64V428.7c-2.7 1.1-5.4 2-8.2 2.7l-60.1 15c-3 .7-6 1.2-9 1.4c-.9 .1-1.8 .2-2.7 .2H240c-6.1 0-11.6-3.4-14.3-8.8l-8.8-17.7c-1.7-3.4-5.1-5.5-8.8-5.5s-7.2 2.1-8.8 5.5l-8.8 17.7c-2.9 5.9-9.2 9.4-15.7 8.8s-12.1-5.1-13.9-11.3L144 381l-9.8 32.8c-6.1 20.3-24.8 34.2-46 34.2H80c-8.8 0-16-7.2-16-16s7.2-16 16-16h8.2c7.1 0 13.3-4.6 15.3-11.4l14.9-49.5c3.4-11.3 13.8-19.1 25.6-19.1s22.2 7.8 25.6 19.1l11.6 38.6c7.4-6.2 16.8-9.7 26.8-9.7c15.9 0 30.4 9 37.5 23.2l4.4 8.8h8.9c-3.1-8.8-3.7-18.4-1.4-27.8l15-60.1c2.8-11.3 8.6-21.5 16.8-29.7L384 203.6V160H256c-17.7 0-32-14.3-32-32V0H64zM256 0V128H384L256 0zM549.8 139.7c-15.6-15.6-40.9-15.6-56.6 0l-29.4 29.4 71 71 29.4-29.4c15.6-15.6 15.6-40.9 0-56.6l-14.4-14.4zM311.9 321c-4.1 4.1-7 9.2-8.4 14.9l-15 60.1c-1.4 5.5 .2 11.2 4.2 15.2s9.7 5.6 15.2 4.2l60.1-15c5.6-1.4 10.8-4.3 14.9-8.4L512.1 262.7l-71-71L311.9 321z"/></svg>
                    </a>
                    <div class="p-2 flex justify-center">
                        <div >
                            <h5 class="mb-2 lg:text-base md:text-2xl text-center font-semibold tracking-tight text-gray-900 dark:text-white">Inscripción de <br>industria y comercio</h5>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </Layout>
</template>

<script setup>
import Layout from './Layout.vue'
import banner from '~/img/public/banner.png'

defineProps({ tenant: Object })
defineEmits(['hideModal', 'showModal'])
</script>
