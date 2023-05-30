import './bootstrap';
import '../css/style.less';

import { createApp, h } from 'vue';
import { createVfm } from 'vue-final-modal'
import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy/dist/vue.m';

// изначально в title прилетает APP_NAME из .env
// todo заголовок
const appName = window.document.getElementsByTagName('title')[0]?.innerText || 'overlordSX';
const vfm = createVfm();


createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({ el, App, props, plugin }) {
        return createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue, Ziggy)
            .use(vfm)
            .mount(el);
    },
    progress: {
        color: '#4B5563',
    },
});
