import VueHotkey from 'v-hotkey'
import VueRouter from 'vue-router'

require('./bootstrap');

window.Vue = require('vue');
window.Event = new Vue();

Vue.use(VueHotkey)


// All about vue router
Vue.use(VueRouter)



const router = new VueRouter({
    routes: [
        {
            path: '/',
            name: 'Home',
            component: require('./components/Home.vue').default,
        },
        {
            path: '/view/:id',
            name: 'Display',
            component: require('./components/display/DisplayComponent.vue').default,
            props: true
        }
    ]
})

Vue.component('main-component', require('./components/MainComponent.vue').default);
Vue.component('welcome-component', require('./components/Welcome.vue').default);
Vue.component('dropdown-component', require('./components/widgets/Dropdown.vue').default);
Vue.component('login-comp', require('./components/auth/Login.vue').default);
Vue.component('reg-comp', require('./components/auth/Register.vue').default);
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    router
});
