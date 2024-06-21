import { createRouter, createWebHistory } from 'vue-router';
import MainView from '../views/MainView.vue';

const routes = [
  {
    path: '/',
    name: 'app',
    component: MainView,
  },
  {
    path: '/vue-dashboard',
    name: 'VueDashboard',
    component: MainView,
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
  const isAuthenticated = !!localStorage.getItem('authToken');

  if (to.matched.some(record => record.meta.requiresAuth) && !isAuthenticated) {
    next({ name: 'app' }); // Redirect to login or main page if not authenticated
  } else {
    next(); // Allow navigation if authenticated or route does not require auth
  }
});

export default router;
