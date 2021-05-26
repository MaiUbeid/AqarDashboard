import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

import App from './views/App'
import Hello from './views/Hello'
import Home from './views/Home'
import Users from './views/UsersIndex';
import image_store from './views/ImageStore';
import fillter from './views/ImageFillter';


const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/panel/admin/',
            name: 'home',
            component: Home
        },
        {
            path: '/panel/admin/hello',
            name: 'hello',
            component: Hello,
        },
        {
            path: '/panel/admin/users',
            name: 'users.index',
            component: Users,
        },
        {
            path: '/panel/admin/image_store_with_vue/store',
            name: 'images.store.index',
            component: image_store,
        },
        {
            path: '/panel/admin/image/image_fillter',
            name: 'images.store.fillter',
            component: fillter,
        },
    ],
});

const app = new Vue({
    el: '#app',
    components: {App,Users,fillter,image_store },
    router,
});