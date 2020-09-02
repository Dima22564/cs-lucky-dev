"use strict";

require("es6-promise/auto");

var _vuex = _interopRequireDefault(require("vuex"));

var _vueRouter = _interopRequireDefault(require("vue-router"));

var _vuebar = _interopRequireDefault(require("vuebar"));

var _faq = require("./store/faq");

var _common = require("./store/common");

var _notifications = require("./store/notifications");

var _user = require("./store/user");

var _game = require("./store/game");

var _vueNumberAnimation = _interopRequireDefault(require("vue-number-animation"));

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { "default": obj }; }

/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
require('./bootstrap');

window.Vue = require('vue');
Vue.use(_vuex["default"]);
Vue.use(_vueRouter["default"]);
Vue.use(_vuebar["default"]);
Vue.use(_vueNumberAnimation["default"]);
var store = new _vuex["default"].Store({
  modules: {
    faq: _faq.faq,
    common: _common.common,
    notifications: _notifications.notifications,
    user: _user.user,
    game: _game.game
  }
});
var routes = [{
  path: '/faq',
  component: require('./pages/faq.vue')["default"]
}, {
  path: '/',
  component: require('./pages/index.vue')["default"]
}];
var router = new _vueRouter["default"]({
  routes: routes
});
/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */
// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue')["default"]); // Vue.component('faq', require('./components/faq').default)

Vue.component('cs-lucky-menu', require('./components/Menu.vue')["default"]);
Vue.component('menu-top', require('./components/Mobile-menu-top.vue')["default"]);
Vue.component('menu-bottom', require('./components/Mobile-menu-bottom.vue')["default"]);
Vue.component('cs-lucky-footer', require('./components/Footer')["default"]); // Vue.component('chat' , require('./components/Chat').default)

Vue.component('slick', require('vue-slick')["default"]);
Vue.component('history', require('./components/History')["default"]);
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

var app = new Vue({
  el: '#app',
  store: store,
  router: router
});