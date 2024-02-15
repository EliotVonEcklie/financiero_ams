<script setup>
import Layout from '~Layouts/Private.vue'
import SearchPredio from '~Components/SearchPredio.vue'

const title = 'Consultar Predio - Factura Predial'

defineProps({ predios: Array })
</script>

<template>
    <Layout :title="title">
        <main class="p-4 pt-20 text-gray-900 dark:text-white">
            <h1 class="text-3xl text-left">{{ title }}</h1>

            <section class="border-t-2 mt-2 pt-6">
                <SearchPredio :href="route('factura_predials.create')" :predios="predios" />
            </section>
        </main>
    </Layout>
</template>
