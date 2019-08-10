import Vue from 'vue';
import VueRouter from 'vue-router';
import routes from './routes'
import Vuex from 'vuex';

Vue.use(Vuex);
Vue.use(VueRouter);
import store from './stores/index'

const app = new Vue({
    el: '#app',
    store,
    router: new VueRouter(routes)
});
