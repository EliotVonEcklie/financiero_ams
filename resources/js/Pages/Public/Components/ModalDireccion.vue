<template>
    <!-- Main modal -->
    <div id="modalDireccion" data-modal-backdrop="static" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-7xl max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                        Digite la dirección
                    </h3>
                    <button type="button" class="text-gray-400 bg-transparent rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" @click="hideModal('modalDireccion')">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <div class="p-4 md:p-5 space-y-4">
                    <div>
                        <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Dirección generada</label>
                        <input type="text" aria-label="disabled input" class="mb-6 bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 cursor-not-allowed dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500" :value="txtDireccion" disabled>
                    </div>
                    <div class="grid md:grid-cols-3 md:gap-2">
                        <div class="max-w-sm p-4 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                            <h5 class="mb-5 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Via</h5>
                            <div class="grid md:grid-cols-2 md:gap-4">
                                <div class="relative z-0 w-full mb-5 group">
                                    <label for="countries" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tipo de via</label>
                                    <select @change="updateAddress" v-model="txtSelectVia" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                        <option selected>Seleccione</option>
                                        <option value="Carrera">Carrera</option>
                                        <option value="Calle">Calle</option>
                                        <option value="Vereda">Vereda</option>
                                        <option value="Via">Via</option>
                                    </select>
                                </div>
                                <div class="relative z-0 w-full mb-5 group">
                                    <label for="countries" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Via</label>
                                    <input @input="updateAddress" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" v-model="txtVia" required>
                                </div>
                            </div>
                        </div>
                        <div class="max-w-sm p-4 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                            <h5 class="mb-5 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Número</h5>
                            <div class="grid md:grid-cols-2 md:gap-4">
                                <div class="relative z-0 w-full mb-5 group">
                                    <label for="countries" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">#</label>
                                    <input @input="updateAddress" v-model="txtNumero" type="number" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                                </div>
                                <div class="relative z-0 w-full mb-5 group">
                                    <label for="countries" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"> #</label>
                                    <input @input="updateAddress" v-model="txtNumero2" type="number" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                                </div>
                            </div>
                        </div>
                        <div class="max-w-sm p-4 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                            <h5 class="mb-5 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Complemento</h5>
                            <div class="grid md:grid-cols-3 md:gap-2">
                                <div class="relative z-0 w-full mb-5 group">
                                    <label for="countries" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tipo</label>
                                    <select @change="updateAddress" v-model="txtSelectComplemento" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                        <option selected>Seleccione</option>
                                        <option value="Apartamento">Apartamento</option>
                                        <option value="Casa">Casa</option>
                                        <option value="Oficina">Oficina</option>
                                    </select>
                                </div>
                                <div class="relative z-0 w-full mb-5 group">
                                    <label for="countries" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Complemento</label>
                                    <div class="relative z-0 w-full mb-5 group">
                                        <label for="countries" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"></label>
                                        <input @input="updateAddress" type="text" v-model="txtComplemento" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                                    </div>
                                </div>
                                <div class="relative z-0 w-full mb-5 group">
                                    <label for="countries" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Barrio</label>
                                    <div class="relative z-0 w-full mb-5 group">
                                        <label for="countries" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"></label>
                                        <input @input="updateAddress" type="text" v-model="txtBarrio" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Modal footer -->
                <div class="flex items-center justify-end p-4 space-x-2 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                    <button @click="$emits('getAddress', txtDireccion) && hideModal('modalDireccion')" type="button" class="text-white bg-greenp1 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Confirmar</button>
                    <button @click="hideModal('modalDireccion')" type="button" class="text-white bg-red-500 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Cancelar</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref } from 'vue'

const txtDireccion = ref('')
const txtSelectVia = ref('')
const txtVia = ref('')
const txtNumero = ref('')
const txtNumero2 = ref('')
const txtSelectComplemento = ref('')
const txtComplemento = ref('')
const txtBarrio = ref('')

defineProps({ hideModal: Function })
defineEmits(['getAddress'])

function updateAddress() {
    txtDireccion.value =
        txtSelectVia.value + ' ' +
        txtVia.value + ' N ' +
        txtNumero.value + ' - ' +
        txtNumero2.value + ' ' +
        txtSelectComplemento.value + ' ' +
        txtComplemento.value + ' ' +
        txtBarrio.value
}
</script>
