<script setup>
import HeaderComponent from './Components/Header.vue'
import FooterComponent from './Components/Footer.vue'
import View from './Pages/View.vue'
import { initFlowbite } from 'flowbite'
import { onMounted } from 'vue'

onMounted(() => {
    initFlowbite()
});
</script>

<template>
    <HeaderComponent />
    <View/>
    <FooterComponent />
</template>


