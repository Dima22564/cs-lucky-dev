/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
import 'es6-promise/auto'
import Vuex from 'vuex'
import VueRouter from 'vue-router'
import Vuebar from 'vuebar'

import { faq } from './store/faq'
import { common } from './store/common'
import { notifications } from './store/notifications'
import { user } from './store/user'
import { game } from './store/game'
import VueNumber from 'vue-number-animation'

Vue.use(Vuex)
Vue.use(VueRouter)
Vue.use(Vuebar)
Vue.use(VueNumber)

const store = new Vuex.Store({
  modules: {
    faq,
    common,
    notifications,
    user,
    game
  }
})

const routes = [
  { path: '/faq', component: require('./pages/faq.vue').default },
  { path: '/', component: require('./pages/index.vue').default }
]
const router = new VueRouter({
  routes
})

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
// Vue.component('faq', require('./components/faq').default)

Vue.component('cs-lucky-menu', require('./components/Menu.vue').default)
Vue.component('menu-top', require('./components/Mobile-menu-top.vue').default)
Vue.component('menu-bottom', require('./components/Mobile-menu-bottom.vue').default)
Vue.component('cs-lucky-footer' , require('./components/Footer').default)
// Vue.component('chat' , require('./components/Chat').default)
Vue.component('slick', require('vue-slick').default)
Vue.component('history', require('./components/History').default)



/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
  el: '#app',
  store,
  router,
});
