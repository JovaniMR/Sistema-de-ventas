/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('app-component', require('./components/App.vue').default);
Vue.component('navbar-component', require('./components/plantilla/Navbar.vue').default);
Vue.component('sidebar-component', require('./components/plantilla/sidebar.vue').default);
Vue.component('content-component', require('./components/plantilla/Content.vue').default);
Vue.component('footer-component', require('./components/plantilla/Footer.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

 /**
 * Configuration Vue-Router
 */


import VueRouter from 'vue-router'; //Rutas
import ElementUI from 'element-ui'; //Diseños de element
import 'element-ui/lib/theme-chalk/index.css';
import VuePaginate from 'vue-paginate'; //Paginar
import Swal from 'sweetalert2' //alertas

Vue.use(VueRouter);
window.Vue.use(ElementUI);
window.Vue.use(VuePaginate);
window.Swal = Swal;

const router = new VueRouter({
   routes:[
    //    {path:'/' ,component: require('./components/plantilla/Content.vue').default},
       {path:'/' ,component: require('./components/modulos/dashboard/index.vue').default},
       {path:'/clientes' ,component: require('./components/modulos/clientes/index.vue').default},
       {path:'/pedidos' ,component: require('./components/modulos/pedidos/index.vue').default},
       {path:'/productos' ,component: require('./components/modulos/productos/index.vue').default},
       {path:'/reportes' ,component: require('./components/modulos/reportes/index.vue').default},
       {path:'/usuarios' ,component: require('./components/modulos/usuarios/index.vue').default},
       {path:'/roles' ,component: require('./components/modulos/roles/index.vue').default},
       {path:'/permisos' ,component: require('./components/modulos/permisos/index.vue').default},

       //Usuarios
        {path:'/usuarios/crear',component: require('./components/modulos/usuarios/create.vue').default},
        {path:'/usuarios/editar/:id',
         name:'usuarios.editar',
         component: require('./components/modulos/usuarios/edit.vue').default,
         props: true},
        {path:'/usuarios/ver/:id',
         name:'usuarios.ver',
         component: require('./components/modulos/usuarios/view.vue').default,
         props: true},

      //Roles
        {path:'/roles/crear',component: require('./components/modulos/roles/create.vue').default}, 
        {path:'/roles/edit/:id',
        name:'roles.editar',
        component: require('./components/modulos/roles/edit.vue').default,
        props:true}
       
      //Permisos

   ],
   mode: 'history',
   linkActiveClass:'active'
});


const app = new Vue({
    el: '#app',
    router
});
