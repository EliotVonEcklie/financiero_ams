import { createApp, h } from 'vue'
import { createInertiaApp, router } from '@inertiajs/vue3'
import { ZiggyVue } from '~ziggy-vue'
import { initFlowbite } from 'flowbite'

router.on('finish', (e) => {
    if (e.detail.visit.completed) {
        initFlowbite()
    }
})

createInertiaApp({
    progress: {
        includeCSS: true
    },
    resolve: name => {
        const pages = import.meta.glob('./Pages/**/*.vue', { eager: true })
        return pages[`./Pages/${name}.vue`]
    },
    setup({ el, App, props, plugin }) {
        createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue)
            .mount(el)
    },
})
