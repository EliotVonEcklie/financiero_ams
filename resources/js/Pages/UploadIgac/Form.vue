<script setup>
import { useForm } from '@inertiajs/vue3'
import { Transition } from 'vue';

const form = useForm({
    igac_r1: null,
    enable_r2: false,
    igac_r2: null
})
const emit = defineEmits(['step'])

function submit() {
    form.post(route('upload_igac.store'), {
        preserveScroll: true,
        onSuccess: () => {
            emit('step')
        }
    })
}
</script>

<template>
    <form @submit.prevent="submit" class="max-w-lg mx-auto">
        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="igac_r1">Subir archivo R1</label>
        <input class="block mb-5 w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" id="igac_r1" @input="form.igac_r1 = $event.target.files[0]" type="file">

        <label class="relative w-full inline-flex items-center mb-5 cursor-pointer">
            <input type="checkbox" v-model="form.enable_r2" value="" class="sr-only peer">
            <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:w-5 after:h-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600"></div>
            <span class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300">Activar archivo R2</span>
        </label>

        <Transition name="slide-fade">
            <div v-if="form.enable_r2">
                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="igac_r2">Subir archivo R2</label>
                <input class="block mb-5 w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" id="igac_r2" @input="form.igac_r2 = $event.target.files[1]" type="file">
            </div>
        </Transition>

        <Transition name="slide-fade">
            <progress v-if="form.progress" :value="form.progress.percentage" max="100" class="">
                {{ form.progress.percentage }}%
            </progress>
        </Transition>

        <button type="submit" :disabled="form.processing" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 disabled:bg-gray-700 dark:focus:ring-blue-800">Subir</button>
    </form>
</template>
