import './bootstrap';

import './Pages/assets/assets/libs/flot/css/float-chart.css'
import './Pages/assets/dist/css/style.min.css'

import $ from 'jquery';
$.noConflict();
window.jQuery = $;

import { createApp, h } from 'vue'
import { createInertiaApp } from '@inertiajs/vue3'

import AccueilNavigation from './Pages/navigation/AccueilNavigation.vue';

createInertiaApp({
  resolve: name => {
    const pages = import.meta.glob('./Pages/**/*.vue', { eager: true })
    let page = pages[`./Pages/${name}.vue`]
    page.default.layout = page.default.layout || AccueilNavigation
    return page
  },
  setup({ el, App, props, plugin }) {
    createApp({ render: () => h(App, props) })
      .use(plugin)
      .mount(el)
  },
})
