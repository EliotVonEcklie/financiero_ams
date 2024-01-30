<template>
    <Layout :tenant="tenant" v-slot="{ showModal, hideModal }">
        <div class="xl:mt-36 md:mt-48 mx-auto container">
            <h2 class="text-2xl md:text-5xl text-center font-medium text-gray-900 dark:text-white mb-8 mt-5">Normatividad</h2>
            <div class="mt-10 relative z-0 w-full mb-20 group ">
                <input type="text" class="block py-2.5 px-0 w-full lg:text-sm md:text-3xl text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                <label for="floating_email" class="peer-focus:font-medium absolute lg:text-sm md:text-3xl text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Buscar por publicacion o descripción</label>
            </div>
            <div class="grid lg:grid-cols-2 md:grid-cols-1 lg:gap-4 md:gap-10 ">
                <CardNormatividad/>
                <CardNormatividad/>
                <CardNormatividad/>
                <CardNormatividad/>
            </div>
        </div>
    </Layout>
</template>

<script lang="ts" setup>
    import Layout from './Layout.vue'
    import CardNormatividad from './Components/CardNormatividad.vue'
    import { ref,reactive } from 'vue'
    defineProps({ tenant: Object })
</script>

<style scoped>

</style>
