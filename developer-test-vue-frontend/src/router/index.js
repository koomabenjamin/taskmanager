import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'home',
      component: HomeView
    },
    //Projects
    {
      path: '/projects',
      name: 'projectindex',
      component: () => import('../views/projects/index.vue')
    },
    {
      path: '/projects/create',
      name: 'projectcreate',
      component: () => import('../views/projects/create.vue')
    },
    {
      path: '/projects/:id/edit',
      name: 'projectedit',
      component: () => import('../views/projects/edit.vue'),
      props: true
    },

    //Tasks
    {
      path: '/tasks',
      name: 'taskindex',
      component: () => import('../views/tasks/index.vue')
    },
    {
      path: '/tasks/create',
      name: 'taskcreate',
      component: () => import('../views/tasks/create.vue')
    },
    {
      path: '/tasks/:id/edit',
      name: 'taskedit',
      component: () => import('../views/tasks/edit.vue')
    }
  ]
})

export default router
