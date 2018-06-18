require('./bootstrap');

window.Vue = require('vue');
import VueRouter from 'vue-router'
import Books from './components/Books';
import Authors from './components/Authors';
import Author from './components/Author';
import Book from './components/Book';

Vue.use(VueRouter);

Vue.component('books', require('./components/Books.vue'));

const routes = [
    {path: '/', component: Books},
    {path: '/authors', component: Authors},
    {path: '/author/:id', component: Author, name: 'author'},
    {path: '/book/:id', component: Book, name: 'book'}
];

const router = new VueRouter({
    routes,
    mode: 'history'
});

const app = new Vue({
    el: '#app',
    router
});