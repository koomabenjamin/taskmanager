import { createRouter, createWebHistory } from 'vue-router';
import { useAuthStore } from '../stores/authStore'; // Import after defining setup function

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/register',
      name: 'register',
      component: () => import('../views/RegisterView.vue'),
    },
    {
      path: '/login',
      name: 'login',
      component: () => import('../views/LoginView.vue'),
    },
    {
      path: '/',
      name: 'app',
      component: () => import('../views/MainView.vue'),
    },
    {
      path: '/vue-dashboard',
      name: 'vue-dashboard',
      component: () => import('../views/MainView.vue'),
      beforeEnter: (to, from, next) => {
        const authStore = useAuthStore(); // Access the store within the guard
        if (authStore.isAuthenticated()) {
          next(); // Allow navigation if authenticated
        } else {
          next({ name: "login" }); // Redirect to login if not authenticated
        }
      },
    },
    {
      path: '/profile',
      name: 'profile',
      component: () => import('../views/ProfileView.vue'),
    },
  ],
});

export default router;
