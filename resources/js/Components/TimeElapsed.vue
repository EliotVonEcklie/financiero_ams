<script setup>
import { onMounted, onUnmounted, ref } from 'vue'

const interval = ref(null)
const days = ref(0)
const hours = ref(0)
const minutes = ref(0)
const seconds = ref(0)
const intervals = {
    second: 1000,
    minute: 1000 * 60,
    hour: 1000 * 60 * 60,
    day: 1000 * 60 * 60 * 24
}
const props = defineProps({
    date: Date
})

onMounted(() => {
    props.interval = setInterval(updateDiffs, 1000)
    updateDiffs()
})

onUnmounted(() => {
    clearInterval(interval)
})

function updateDiffs() {
    //lets figure out our diffs
    let diff = Math.abs(Date.now() - props.date.getTime());

    days.value = Math.floor(diff / intervals.day);
    diff -= days.value * intervals.day;
    hours.value = Math.floor(diff / intervals.hour);
    diff -= hours.value * intervals.hour;
    minutes.value = Math.floor(diff / intervals.minute);
    diff -= minutes.value * intervals.minute;
    seconds.value = Math.floor(diff / intervals.second);
}
</script>

<template>
    <span v-if="days > 0">{{ days }} día(s), </span>
    <span v-if="hours > 0">{{ hours }} hora(s), </span>
    <span v-if="minutes > 0">{{ minutes }} minuto(s), </span>
    <span>{{ seconds }} segundo(s).</span>
</template>
