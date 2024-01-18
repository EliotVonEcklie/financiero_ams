<script setup>

</script>
<template>
    <div id="modalPse" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-5xl max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div class="bg-bluep flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-xl font-semibold text-white dark:text-white">
                        Información de pago
                    </h3>
                    <button type="button" class="text-white bg-transparent rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="modalPse">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <div class="p-4 md:p-5 space-y-4">
                    <div class="flex justify-center items-center space-x-4 text-1xl">
                        <h4 class="text-">Estimado usuario, le informamos que ahora puede pagar en línea por PSE</h4>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 188.25 187.833" height="40" width="40" xmlns:v="https://vecta.io/nano"><radialGradient id="B" cx="96.011" cy="357.583" r="93.155" fx="45.827" fy="353.899" gradientTransform="matrix(1 0 0 1 0 -264)" gradientUnits="userSpaceOnUse"><stop offset=".316" stop-color="#2d5ca8"/><stop offset=".531" stop-color="#285496"/><stop offset=".729" stop-color="#1f4272"/><stop offset="1" stop-color="#0d2d4d"/></radialGradient><ellipse cx="94.345" cy="93.917" rx="93.157" ry="93.153" fill="url(#A)"/><path d="M119.47 71H97.417c-.099 0-.198-.014-.295.006-3.509.761-10.122 4.348-10.088 12.182C86.852 86.202 88.172 91 94.475 93h15.72c.696 0 4.989.982 4.704 8.47-.288 7.549-6.724 8.53-7.65 9.53H82.891c-.768 0-1.391.732-1.391 1.5s.623 1.5 1.391 1.5h24.492c.079 0 .157-.366.235-.38 3.344-.572 9.749-4.002 10.062-12.207.404-10.611-7.273-11.281-7.351-11.286.011-.003-15.516-.045-15.516-.045-5.301-.97-5.015-6.598-4.999-6.843.002-.034.003.054.003.02C89.76 76.152 96.514 74 97.581 74h21.89c.768 0 1.391-.732 1.391-1.5s-.624-1.5-1.392-1.5zm33.577-.157c-.127-.036-.259.157-.391.157h-16.478c-7.459 0-10.828 8.637-10.967 9.014-.023.061-.04.016-.055.08-.171.773-4.187 18.937-4.052 24.934.129 5.642 5.875 7.693 8.895 8.016.05.006.1-.043.151-.043h22.908c.778 0 1.41-.722 1.41-1.5s-.631-1.5-1.41-1.5h-22.822c-.717 0-6.212-.838-6.311-5.205-.053-2.344.614-6.83 1.418-11.362l31.881-.238c.68-.005 1.26-.482 1.377-1.153.062-.35 1.494-8.503 1.494-13.392-.001-5.817-6.76-7.724-7.048-7.808zm2.967 19.571l-30.154.252c.926-4.913 1.868-8.94 2.027-9.663.322-.805 3.088-7.004 8.291-7.004h16.255c.88 0 4.842 1.556 4.842 4.853 0 3.605-.866 9.106-1.261 11.562zM82.84 79.444C83.667 73.817 76.56 71 75.23 71l-15.344.166c-.121-.013-.246.067-.372.086-3.554.566-8.38 5.143-9.93 9.377l.024.029c-.155.472-.291 1.2-.498 2.294l-1.021 5.485-3.039 16.613-4.384 24.158a1.37 1.37 0 0 0 1.105 1.594c.082.015.164.023.245.023a1.37 1.37 0 0 0 1.347-1.128l3.957-21.805c3.579 4.515 8.031 4.989 8.254 5.01.055.006.11.01.167.005l14.091-.403c.121-.003.239-.022.354-.057 6.685-2.005 8.695-8.903 8.778-9.196a1.48 1.48 0 0 0 .033-.15l3.825-23.429c.01-.05.011-.178.018-.228zm-2.736-.053l-3.797 23.176c-.198.621-1.944 5.659-6.739 7.201l-13.8.394c-.636-.089-4.942-.881-7.732-6.195l4.139-22.397c1.279-3.436 5.416-7.128 7.737-7.525.526.032 1.245.033 2.24.035l5.333-.003 7.429-.02c1.628-.012 5.586 2.751 5.19 5.334z" fill="#fff"/><g fill="#fdb718"><ellipse cx="19.366" cy="66.019" rx="3.923" ry="4.185"/><path d="M15.405 52.808c0-1.839-1.119-3.384-2.665-3.945l-3.614 7.272c.658.531 1.468.858 2.356.858 2.167 0 3.923-1.874 3.923-4.185zM7.484 66.019c0-1.135-.427-2.162-1.115-2.916l-2.151 7.03c1.852-.335 3.266-2.043 3.266-4.114z"/><ellipse cx="19.913" cy="117.005" rx="3.923" ry="4.185"/><path d="M6.055 117.005c0-1.745-1.215-3.174-2.79-3.412l1.538 6.124c.757-.634 1.252-1.607 1.252-2.712zm9.332 13.647c0-2.311-1.756-4.185-3.923-4.185-1.547 0-2.871.963-3.51 2.35l2.635 5.906c.282.069.573.113.875.113 2.166.001 3.923-1.873 3.923-4.184zM22.046 104h-7.867c-.51-1-1.971-2.721-3.715-2.721-2.167 0-3.923 1.964-3.923 4.275s1.756 4.266 3.923 4.266c1.744 0 3.205-.821 3.715-2.821h6.44 2.217.188l8.251-15H44v-2H23.14l-8.575-15h-.598-2.207-8.684l-.561 3h10.803l7.018 12H1.25l-.062 2H28.87L22.046 104z"/></g><path d="M54.233 58.499h4.206a1.55 1.55 0 0 0 1.015 1.813l-.798 5.584h-4.424s-1.958-.725-.943-2.828c0 0 .925-1.124 1.741-1.124l4.052.136m7.915-3.581H62.79s-1.45.725-1.813 2.611c0 0-.979 2.756.181 4.786l.49.109H65.6m3.826-10.897L67.45 66.077m1.111-6.167s.503-.995 1.373-1.412c0 0 3.173-.308 3.735.49 0 0 .635.308.598 1.215l-.979 5.693" fill="none" stroke="#fff" stroke-miterlimit="10"/></svg>
                    </div>
                    <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400">
                        El Pago Electrónico de su Factura por los medios hebilitados, puede tardar unos minutos para ser reflejado en su estado de cuenta, el cual es aplicado automaticamente. Si el Pago a realizar corresponde a la totalidad de la deuda, usted podrá descargar el certificado de Paz y Salvo a través de este portal.
                    </p>
                    <div class="grid md:grid-cols-2 md:gap-6">
                        <div class="relative z-0 w-full mb-5 group">
                            <label for="underline_select" class="sr-only">Tipo de identificación</label>
                            <select id="underline_select" class="block py-2.5 px-0 w-full text-sm text-gray-500 bg-transparent border-0 border-b-2 border-gray-200 appearance-none dark:text-gray-400 dark:border-gray-700 focus:outline-none focus:ring-0 focus:border-gray-200 peer">
                                <option selected>Seleccione</option>
                                <option value="1">Cédula de ciudadania</option>
                                <option value="2">Cédula extranjera</option>
                                <option value="3">NIT</option>
                                <option value="4">Pasaporte</option>
                                <option value="5">Tarjeta de identidad</option>

                            </select>
                        </div>
                        <div class="relative z-0 w-full mb-5 group">
                            <input type="text"  class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                            <label for="floating_last_name" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Número de identificación</label>
                        </div>
                    </div>
                    <div class="grid md:grid-cols-2 md:gap-6">
                        <div class="relative z-0 w-full mb-5 group">
                            <input type="text"  class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                            <label for="floating_first_name" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Nombre</label>
                        </div>
                        <div class="relative z-0 w-full mb-5 group">
                            <input type="text"  class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                            <label for="floating_last_name" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Apellido</label>
                        </div>
                    </div>
                    <div class="grid md:grid-cols-2 md:gap-6">
                        <div class="relative z-0 w-full mb-5 group">
                            <input type="text"  class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                            <label for="floating_last_name" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Dirección</label>
                        </div>
                        <div class="relative z-0 w-full mb-5 group">
                            <input type="tel" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}"  class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                            <label for="floating_phone" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Teléfono</label>
                        </div>
                    </div>
                    <div class="relative z-0 w-full mb-5 group">
                        <input type="email"  class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                        <label for="floating_last_name" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Correo electrónico</label>
                    </div>
                </div>
                <!-- Modal footer -->
                <div class="flex justify-end items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                    <button data-modal-hide="modalPse" type="button" class="text-white bg-greenp1 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Pagar</button>
                    <button data-modal-hide="modalPse" type="button" class="ms-3 text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Cancelar</button>
                </div>
            </div>
        </div>
    </div>
</template>
