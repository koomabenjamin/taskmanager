import { createRouter, createWebHistory } from 'vue-router';
import MainView from '../views/MainView.vue';
import ProfileView from '../views/ProfileView.vue';
import Register from '../views/Register.vue';
import Login from '../views/Login.vue';
import axios from 'axios';

const routes = [
  {
    path: '/',
    name: 'login',
    component: Login,
  },
  {
    path: '/register',
    name: 'register',
    component: Register,
  },
  {
    path: '/vue-dashboard',
    name: 'VueDashboard',
    component: MainView,
    meta: {
      requiresAuth: true,
    },
  },
  {
    path: '/profile',
    name: 'profile',
    component: ProfileView,
    meta: {
      requiresAuth: true,
    },
  },
];

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes,
});

router.beforeEach((to, from, next) => {
  const isAuthenticated = !!localStorage.getItem('authToken');  // true or false

  if (to.name !== 'login' && !isAuthenticated) next({ name: 'login' });
  else if (to.name === 'login' && isAuthenticated) next({ name: 'vue-dashboard' });
  else next();
});


export default router;
