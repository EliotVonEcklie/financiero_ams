<template>
    <Layout :tenant="tenant">
        <FormContacto :tenant="tenant"/>
    </Layout>
</template>

<script lang="ts" setup>
    import Layout from './Layout.vue';
    import FormContacto from './Components/FormContacto.vue';
    defineProps({ tenant: Object });
</script>

<style scoped>

</style>
