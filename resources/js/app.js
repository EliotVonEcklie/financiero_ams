import { createApp, h } from 'vue'
import { createInertiaApp, router } from '@inertiajs/vue3'
import { ZiggyVue } from '~ziggy-vue'
import VueEcho from 'vue-echo-laravel'
import { initFlowbite } from 'flowbite'
import numbers from './numbers'
import LoadScript from 'vue-plugin-load-script'
import Vue3Signature from "vue3-signature"

router.on('navigate', () => {
    initFlowbite()
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
        let app = createApp({ render: () => h(App, props) })

        app.config.globalProperties.$numbers = numbers
        app.config.globalProperties.$month = month => new Date(new Date().getFullYear(), month - 1, 1).toLocaleString('es-CO', { month: 'long' })
        app.config.globalProperties.$date = date => new Date(date).toLocaleString('es-CO', { month: 'long', day: 'numeric', year: 'numeric' })
        app.config.globalProperties.$goBack = () => window.history.back()
        app.config.globalProperties.$goForward = () => window.history.forward()

        app.use(plugin)
            .use(ZiggyVue)
            .use(LoadScript)
            .use(Vue3Signature)
            /*.use(VueEcho, {
                broadcaster: 'pusher',
                key: import.meta.env.VITE_PUSHER_APP_KEY,
                wsHost: import.meta.env.VITE_PUSHER_HOST,
                wsPort: import.meta.VITE_PUSHER_PORT,
                wssPort: import.meta.VITE_PUSHER_PORT,
                forceTLS: false,
                encrypted: true,
                disableStats: true,
                enabledTransports: ['ws', 'wss']
            })
            */
            .mount(el)
    },
})
