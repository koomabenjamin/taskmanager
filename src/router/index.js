// import { createRouter, createWebHistory } from 'vue-router'
// import { useAuthStore } from '@/stores/auth'

//  import Login from '@/views/LoginView.vue'
//  import Regsiter from '@/views/RegisterView.vue'
// // // import Dashboard from '@/views/MainView.vue'
// // import Dashboard from '@/../views/MainView.vue'
// import  Dashboard  from '@/views/MainView.vue'; 

// const routes = [
//   { 
//     path: '/login',
//     name: 'Login', 
//     component: Login 
//     },

//     { 
//       path: '/register',
//       name: 'Regsiter', 
//       component: Regsiter 
//       },
    

//   {
//     path: '/',
//     name: 'Dashboard',
//     component: Dashboard,
//   },
// ]


// // const router = createRouter({
// //   history: createWebHistory(import.meta.env.BASE_URL),
// //   routes,
// // })

// // router.beforeEach(async (to, from, next) => {
// //   const publicPages = ['/login'];
// //   const authRequired = !publicPages.includes(to.path);
// //   const auth = useAuthStore();

// //   if (authRequired && !auth.isAuthenticated) {
// //     auth.returnUrl = to.fullPath;
// //     return next('/login');
// //   }else {
// //     return next('/');
// //   }

  
// // });

// const router = createRouter({
//   history: createWebHistory(import.meta.env.BASE_URL),
//   routes,
// })

// router.beforeEach(async (to, from, next) => {
//   const publicPages = ['/login'];
//   const authRequired = !publicPages.includes(to.path);
//   const auth = useAuthStore();


//   console.log("AUTH: ", authRequired )
//   console.log("AUTH 2: ", !auth.isAuthenticated )




//   if (authRequired && !auth.isAuthenticated) {
//     auth.returnUrl = to.fullPath;
//     return next('/login');
//   }

//   if (to.path === '/login' && auth.isAuthenticated) {
//     return next('/');
//   }

//   next();
//   // // redirect to login page if not logged in and trying to access a restricted page
//   // const publicPages = ['/login'];
//   // const authRequired = !publicPages.includes(to.path);
//   // const auth = useAuthStore();

//   // if (authRequired && !auth.isAuthenticated) {
//   //   auth.returnUrl = to.fullPath;
//   //   return '/login';
//   // }
// });

// export default router





// // import { createRouter, createWebHistory } from 'vue-router'
// // import { useAuthStore } from '@/stores/auth'

// //  import Login from '@/views/LoginView.vue'
// // // // import Dashboard from '@/views/MainView.vue'
// // // import Dashboard from '@/../views/MainView.vue'
// // import  Dashboard  from '@/views/MainView.vue'; 


// // const router = createRouter({
// //   history: createWebHistory(import.meta.env.BASE_URL),
// //   routes: [
// //     /*{
// //       path: '/',
// //       name: 'home',
// //       component: HomeView
// //     },
// //     {
// //       path: '/about',
// //       name: 'about',
// //       // route level code-splitting
// //       // this generates a separate chunk (About.[hash].js) for this route
// //       // which is lazy-loaded when the route is visited.
// //       component: () => import('../views/AboutView.vue')
// //     },*/

  
// //     {

// //       path: '/',
// //     name: 'Dashboard',
// //     component: Dashboard,

// //       // path: '/',
// //       // name: 'app',
// //       // component: () => import('../views/MainView.vue')
// //     }
// //   ]
// // })

// // export default router


import { createRouter, createWebHistory } from 'vue-router'
import { useAuthStore } from '@/stores/auth'

import Login from '@/views/LoginView.vue'
import Register from '@/views/RegisterView.vue'
import Dashboard from '@/views/MainView.vue'

const routes = [
  {
    path: '/login',
    name: 'Login',
    component: Login
  },
  {
    path: '/register',
    name: 'Register',
    component: Register
  },
  {
    path: '/',
    name: 'Dashboard',
    component: Dashboard,
    meta: { requiresAuth: true },
  },
]

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes,
})

router.beforeEach((to, from, next) => {
  const authStore = useAuthStore()
  const publicPages = ['/login', '/register']
  const authRequired = !publicPages.includes(to.path)

  if (authRequired && !authStore.isAuthenticated) {
    authStore.returnUrl = to.fullPath
    return next('/login')
  }

  if ((to.path === '/login' || to.path === '/register') && authStore.isAuthenticated) {
    return next('/')
  }

  next()
})

export default router
