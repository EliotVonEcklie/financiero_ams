<template>
    <Layout :tenant="tenant" v-slot="{ showModal, hideModal }">
    </Layout>
</template>

<script lang="ts" setup>
    import Layout from './Layout.vue'
    import { ref,reactive } from 'vue'
    defineProps({ tenant: Object });
</script>

<style scoped>

</style>
