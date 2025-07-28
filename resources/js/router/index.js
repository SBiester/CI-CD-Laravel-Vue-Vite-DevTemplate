import { createRouter, createWebHistory } from 'vue-router';

import Dashboard from '../components/dashboard.vue';

const routes = [
    {
        path: '/dashboard',
        name: 'dashboard',
        component: Dashboard,
     },
     //
];

const router = createRouter({
    history: createWebHistory(),
    routes,

});

export default router;
