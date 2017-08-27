/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
//require('./bootstrap');

//window.Vue = require('vue');
import Vue from 'vue';
import router from './router';
import App from './components/App.vue';
import VueScroller from 'vue-scroller';
import axios from 'axios';
import jQuery from 'jquery';
import '../../aui/css/aui.css';
import '../../aui/css/aui-flex.css';
import Mint from 'mint-ui';
import 'mint-ui/lib/style.css';
Vue.use(Mint);
Vue.use(VueScroller);
Vue.prototype.wjcao = axios;

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */


const app = new Vue({
  router,
  el: '#app',
  template: '<App/>',
  components: {
    App
  }
})

/*const app = new Vue({
    el: '#app'
});*/