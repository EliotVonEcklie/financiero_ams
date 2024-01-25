<script setup>
import Layout from '~Layouts/Private.vue'
import { ref, watch } from 'vue'
import { Link, router } from '@inertiajs/vue3'
import Table from '~Components/Table.vue'
import SearchPredio from '~Components/SearchPredio.vue'

const title = 'Consultar Predio'
defineProps({ predios: Array })
const searchQuery = ref('')
</script>

<template>
    <Layout :title="title">
        <main class="p-4 mt-[69px] text-gray-900 dark:text-white">
            <h1 class="text-3xl text-left">{{ title }}</h1>

            <section class="border-t-2 mt-2 pt-6">
                <SearchPredio v-model:searchQuery="searchQuery" :predios="predios" />
            </section>
        </main>
    </Layout>
</template>
