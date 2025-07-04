import './bootstrap';

import { createApp } from 'vue';
import App from './App.vue';
import router from './Router';
import Menu from './Components/Menu.vue';
import { createPinia } from 'pinia'

import VueSweetalert2 from 'vue-sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';


const pinia = createPinia()

const app = createApp(App);
app.use(VueSweetalert2);
app.component('Menu', Menu);
app.use(router);
app.use(pinia);
app.mount('#app');
