import { createRouter, createWebHistory } from 'vue-router';
import MainView from '../views/MainView.vue';
import ProfileView from '../views/ProfileView.vue';
import Register from '../views/Register.vue';
import Login from '../views/Login.vue';
import axios from 'axios';
import { useAuthStore } from '@/stores/authStore'; // Import your Pinia store

axios.defaults.baseURL = import.meta.env.VITE_API_URL;
axios.defaults.withCredentials = true;

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
    name: 'vue-dashboard',
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

router.beforeEach(async (to, from, next) => {
  const authStore = useAuthStore(); // Initialize Pinia store

  // Fetch CSRF token
  await axios.get(`${import.meta.env.VITE_API_URL}/api/v1/sanctum/csrf-cookie`);

  const isAuthenticated = authStore.isAuthenticated; // Assuming store has an isAuthenticated getter

  if (to.matched.some(record => record.meta.requiresAuth) && !isAuthenticated) {
    next({ name: 'login' });
  } else if (to.name === 'login' && isAuthenticated) {
    next({ name: 'vue-dashboard' });
  } else {
    next();
  }
});

export default router;
