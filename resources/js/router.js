import Vue from 'vue';
import VueRouter from 'vue-router';
Vue.use(VueRouter);

import Home from './pages/frontend/home';// //backe
import Websites from './pages/frontend/websites';// //backe
import Posts from './pages/frontend/posts';// //backe
import Subscribers from './pages/frontend/subscribers';// //backe


let routes = [
    //guest
    {
        path: '/',
        name: 'Home',
        component: Home,
        meta: {
            requiresAuth: false,
        }
    },
    {
        path: '/websites',
        name: 'Websites',
        component: Websites,
        meta: {
            requiresAuth: false,
        }
    },
    {
        path: '/posts',
        name: 'posts',
        component: Posts,
        meta: {
            requiresAuth: false,
        }
    },
    {
        path: '/subscribers',
        name: 'subscribers',
        component: Subscribers,
        meta: {
            requiresAuth: false,
        }
    },

];

export default new VueRouter({
    mode: 'history',
    routes
});
