<script setup>
import Layout from '~Layouts/Private.vue'

const title = 'Bienvenido'
</script>

<template>
    <Layout :title="title">
        <main class="p-4 pt-20 text-gray-900 dark:text-white">
            <h1 class="text-3xl text-left">{{ title }}</h1>
        </main>
    </Layout>
</template>
