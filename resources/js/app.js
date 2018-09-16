require('./bootstrap');

import Vue from 'vue'
import VueRouter from 'vue-router'
import BootstrapVue from 'bootstrap-vue'
import VueVideoPlayer from 'vue-video-player'
import Carousel3d from 'vue-carousel-3d';
//import VueCarousel from 'vue-carousel';

import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'
import 'video.js/dist/video-js.css'

Vue.use(BootstrapVue);
Vue.use(VueRouter);
Vue.use(VueVideoPlayer);
Vue.use(Carousel3d);
//Vue.use(VueCarousel);

Vue.component('navbar-area', require('./components/Layouts/Navbar.vue'));
Vue.component('footer-area', require('./components/Layouts/Footer.vue'));

Vue.prototype.$http = window.axios;
//Vue.prototype.$video = VideoJS;

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            component: require('./components/ExampleComponent.vue'),
            name: 'index'
        },
        {
            path: '/anime/:animeId/clip',
            component: require('./components/Anime/Watch/Clip.vue'),
            name: 'animeWatchClip'
        },
    ]
});

const app = new Vue({
    router,
    el: '#app'
});
