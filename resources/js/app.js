require('./bootstrap');

import Vue from 'vue/dist/vue'

//Pagination laravel-vue-pagination
Vue.component('pagination', require('laravel-vue-pagination'));

import Swal from 'sweetalert2'
window.Swal = require('sweetalert2')

const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true
});

window.Toast = Toast;

let Fire = new Vue()
window.Fire = Fire;

Vue.component('users', require('./components/users.vue').default);

const app = new Vue({
    el: '#app',
});

