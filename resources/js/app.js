// resources/js/app.js

import { createApp } from 'vue';
import { createRouter, createWebHistory } from 'vue-router';
import App from './App.vue';
import '../css/app.css';
import '@fortawesome/fontawesome-free/css/all.css';
import '@fortawesome/fontawesome-free/js/all.js';

import Dashboard from './components/Dashboard.vue';
import SubmitIdeaForm from './components/SubmitIdeaForm.vue';
//import Ideen from './components/Ideen.vue';
import SubmitIdea from './components/SubmitIdea.vue';
//import IdeaDetails from './components/IdeaDetails.vue';
//import IdeaList from './components/IdeaList.vue';
//import Login from './components/Login.vue';

const routes = [
  {
    path: '/dashboard',
    component: Dashboard,
  },
  {
    path: '/',
    component: SubmitIdea,
  },
  //{
  //  path: '/Ideen',
  //  component: Ideen,
  //},
  //{
  //  path: '/SubmitIdea',
  //  component: SubmitIdea,
  //},
  //{
  //  path: '/IdeaDetails',
  //  component: IdeaDetails,
  //},
  //{
  //  path: '/IdeaList',
  //  component: IdeaList,
  //},
  //{
  //  path: '/Login',
  //  component: Login,
  //},
];


const router = createRouter({
  history: createWebHistory(),
  routes,
});


const app = createApp(App);
app.use(router);
app.mount('#app');
