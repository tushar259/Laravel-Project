import './bootstrap';
import '../sass/app.scss'
import { createApp } from 'vue';



// const app = createApp({});

// import ExampleComponent from './components/ExampleComponent.vue';
import router from './router.js';
import Navbar from '../js/Navbar.vue';

// app.component('example-component', ExampleComponent);
// app.component('app', App);
const app = createApp(Navbar);
app.use(router);
app.mount('#app');
