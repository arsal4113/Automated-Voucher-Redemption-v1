require('./bootstrap');

window.Vue = require('vue');

import VueRouter from 'vue-router'

Vue.use(VueRouter)


const home=Vue.component('home',require('./components/home').default);

const routes = [
    {
        path: 'home',
        component: home

    }
]

const router = new VueRouter({
    routes,
    mode: 'history'
})
const app = new Vue({
    router
}).$mount('#app')
