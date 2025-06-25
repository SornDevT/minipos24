import './bootstrap';

import { createApp } from 'vue';
import App from './App.vue';
import router from './Router';
import Menu from './Components/Menu.vue';

const app = createApp(App);
app.component('Menu', Menu);
app.use(router);
app.mount('#app');
