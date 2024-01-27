<template>
    <Layout :tenant="tenant" v-slot="{ login, showModal, hideModal }">

        <!--<h2 class="text-2xl md:text-4xl text-center font-medium text-gray-900 dark:text-white mb-8 mt-5">Selección de impuestos</h2>
        <div class="flex justify-center space-x-6">
            <div class="flex justify-center">
                <div class="max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                    <a :href="route('public.impuesto_predial_unificado')" class="flex justify-center items-center">
                        <svg class="lg:w-24 lg:h-24 fill-blue-600" xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 24 24"  fill="none"><path d="M0 0h24v24H0z" fill="none"/><path d="M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8z"/></svg>
                    </a>
                    <div class="flex justify-center">
                        <button type="button" @click="showModal('modalRegistro')" class="lg:text-sm md:text-2xl text-blue-700 hover:text-white border border-blue-700 hover:bg-blue-600 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg px-5 py-2.5 text-center  dark:border-blue-500 dark:text-blue-500 dark:hover:text-white dark:hover:bg-blue-500 dark:focus:ring-blue-800">Impuesto predial unificado</button>
                    </div>
                </div>
            </div>
            <div class="flex justify-center">
                <div class="max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                    <a :href="route('public.impuesto_predial_unificado')" class="flex justify-center items-center">
                        <svg class="lg:w-24 lg:h-24 fill-blue-600" xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24"  viewBox="0 0 24 24"  fill="none"><g><rect fill="none" height="24" width="24"/></g><g><path d="M22,10v12H2V10l7-3v2l5-2l0,0l0,3H22z M17.2,8.5L18,2h3l0.8,6.5H17.2z M11,18h2v-4h-2V18z M7,18h2v-4H7V18z M17,14h-2v4h2 V14z"/></g></svg>
                    </a>
                    <div class="flex justify-center">
                        <button type="button" @click="showModal('modalRegistro')" class="lg:text-sm md:text-2xl text-blue-700 hover:text-white border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg px-5 py-2.5 text-center  dark:border-blue-500 dark:text-blue-500 dark:hover:text-white dark:hover:bg-blue-500 dark:focus:ring-blue-800">Impuesto predial unificado</button>
                    </div>
                </div>
            </div>
            <div class="flex justify-center">
                <div class="max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                    <a :href="route('public.impuesto_predial_unificado')" class="flex justify-center items-center">
                        <svg class="lg:w-24 lg:h-24 fill-blue-600" xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 24 24" fill="none"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M8 16h8v2H8zm0-4h8v2H8zm6-10H6c-1.1 0-2 .9-2 2v16c0 1.1.89 2 1.99 2H18c1.1 0 2-.9 2-2V8l-6-6zm4 18H6V4h7v5h5v11z"/></svg>
                    </a>
                    <div class="flex justify-center">
                        <button type="button" @click="showModal('modalRegistro')" class="lg:text-sm md:text-2xl text-blue-700 hover:text-white border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg px-5 py-2.5 text-center  dark:border-blue-500 dark:text-blue-500 dark:hover:text-white dark:hover:bg-blue-500 dark:focus:ring-blue-800">Impuesto predial unificado</button>
                    </div>
                </div>
            </div>
        </div>-->
        <!--
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
        </div>-->
        <section class="mb-20">
            <div class="flex justify-center lg:flex-row md:flex-col lg:space-x-6 md:space-x-0 lg:space-y-0 md:space-y-6 mt-20">
                <div class="flex justify-center">
                    <div class="flex items-center flex-col text-center max-w-sm p-6 dark:bg-gray-800 dark:border-gray-700">
                        <svg class="lg:w-14 lg:h-14 md:w-24 md:h-24 fill-blue-600" xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" height="24px" viewBox="0 0 24 24" width="24px" fill="none"><g><rect fill="none" height="24" width="24"/></g><g><path d="M12,2C6.48,2,2,6.48,2,12s4.48,10,10,10s10-4.48,10-10S17.52,2,12,2z M12,20c-4.41,0-8-3.59-8-8c0-4.41,3.59-8,8-8 s8,3.59,8,8C20,16.41,16.41,20,12,20z M12.89,11.1c-1.78-0.59-2.64-0.96-2.64-1.9c0-1.02,1.11-1.39,1.81-1.39 c1.31,0,1.79,0.99,1.9,1.34l1.58-0.67c-0.15-0.44-0.82-1.91-2.66-2.23V5h-1.75v1.26c-2.6,0.56-2.62,2.85-2.62,2.96 c0,2.27,2.25,2.91,3.35,3.31c1.58,0.56,2.28,1.07,2.28,2.03c0,1.13-1.05,1.61-1.98,1.61c-1.82,0-2.34-1.87-2.4-2.09L8.1,14.75 c0.63,2.19,2.28,2.78,3.02,2.96V19h1.75v-1.24c0.52-0.09,3.02-0.59,3.02-3.22C15.9,13.15,15.29,11.93,12.89,11.1z"/></g></svg>
                        <h5 class="mb-4 lg:text-xl md:text-2xl font-bold dark:text-white">Pagos rápidos</h5>
                        <p class="lg:text-base md:text-2xl dark:text-white">Realiza tus pagos en minutos, sin complicaciones ni demoras</p>
                    </div>
                </div>
                <div class="flex justify-center">
                    <div class="flex items-center flex-col text-center max-w-sm p-6 dark:bg-gray-800 dark:border-gray-700">
                        <svg class="lg:w-14 lg:h-14 md:w-24 md:h-24 fill-blue-600" xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="none"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M6.5 10h-2v7h2v-7zm6 0h-2v7h2v-7zm8.5 9H2v2h19v-2zm-2.5-9h-2v7h2v-7zm-7-6.74L16.71 6H6.29l5.21-2.74m0-2.26L2 6v2h19V6l-9.5-5z"/></svg>
                        <h5 class="mb-4 lg:text-xl md:text-2xl font-bold dark:text-white">Todo en un Solo Lugar</h5>
                        <p class="lg:text-base md:text-2xl dark:text-white">Centraliza tus obligaciones: impuestos prediales, industria y comercio, y retenciones, en una plataforma fácil de usar</p>
                    </div>
                </div>
                <div class="flex justify-center">
                    <div class="flex items-center flex-col text-center max-w-sm p-6 dark:bg-gray-800 dark:border-gray-700">
                        <svg class="lg:w-14 lg:h-14 md:w-24 md:h-24 fill-blue-600" xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="none"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M12 1L3 5v6c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V5l-9-4zm0 10.99h7c-.53 4.12-3.28 7.79-7 8.94V12H5V6.3l7-3.11v8.8z"/></svg>
                        <h5 class="mb-4 lg:text-xl md:text-2xl font-bold dark:text-white">Seguridad garantizada</h5>
                        <p class="lg:text-base md:text-2xl dark:text-white">Protegemos tu información con las últimas medidas de seguridad. Paga con confianza.</p>
                    </div>
                </div>
            </div>
        </section>
        <section class="mb-20">
            <FormContacto :tenant="tenant"/>
        </section>
        <!--
        <section>
            <h2 class="lg:text-2xl md:text-4xl text-center font-medium text-gray-900 dark:text-white mb-8 mt-5">Te puede interesar</h2>
            <div class="grid lg:grid-cols-5 md:grid-cols-3 items-center">
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
        </section>-->
    </Layout>
</template>

<script setup>
import Layout from './Layout.vue'
import FormContacto from './Components/FormContacto.vue';

defineProps({ tenant: Object })
defineEmits(['hideModal', 'showModal'])
</script>
