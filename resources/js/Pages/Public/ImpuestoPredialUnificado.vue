<script setup>
import Layout from './Layout.vue'
import TableInfo from './Components/tableInfo.vue'

const props = defineProps({ predios: Object });
</script>

<template>
    <Layout>
        <TableInfo :predios="predios" />
    </Layout>
</template>
