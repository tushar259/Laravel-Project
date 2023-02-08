import {createWebHistory, createRouter} from 'vue-router';
import notFound from './components/NotFound.vue';
import login from './components/Login.vue';
import registration from './components/Registration.vue';
import dashboard from './components/Dashboard.vue';


const routes =[
    {
        path : '/:pathMatch(.*)*',
        component : notFound
    },
    {
        path : '/',
        component : dashboard
    },
    {
        path : '/login',
        component : login
    },
    {
        path : '/registration',
        component : registration
    },
];


const router = createRouter({
    history: createWebHistory(),
    routes
});

export default router;


