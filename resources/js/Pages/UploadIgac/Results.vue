<script setup>
import TimeElapsed from '~Components/TimeElapsed.vue'
import { ref } from 'vue'

const start = ref(new Date(Date.now()))
const eta = ref(0)
const progress = ref(0)
const done = ref(false)
</script>

<template>
    <div v-if="done">

    </div>
    <div v-else class="relative overflow-x-auto">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Tiempo Transcurrido
                    </th>
                    <th v-if="false" scope="col" class="px-6 py-3">
                        Tiempo Estimado
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Cantidad de Registros Procesados
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        <TimeElapsed :date="start" />
                    </th>
                    <td v-if="false" class="px-6 py-4">
                        undefined
                    </td>
                    <td class="px-6 py-4">
                        {{ progress }}
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>
