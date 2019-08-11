import Vue from 'vue';
import VueRouter from 'vue-router';
import routes from './routes'
import Vuex from 'vuex';
import { library } from '@fortawesome/fontawesome-svg-core'
import { faUserSecret, faHeart as faHearSolid, faCircle } from '@fortawesome/free-solid-svg-icons'
import {  faHeart } from '@fortawesome/free-regular-svg-icons'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'

// Font Awesome
library.add(faUserSecret);
library.add(faHeart);
library.add(faCircle);
library.add(faHearSolid);

Vue.component('font-awesome-icon', FontAwesomeIcon);

Vue.use(Vuex);
Vue.use(VueRouter);
import store from './stores/index'

// Component File
import App from './views/App';

const app = new Vue({
    el: '#app',
    store,
    router: new VueRouter(routes),
    render: h=>h(App)
});
