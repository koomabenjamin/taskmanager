import { createRouter, createWebHistory } from 'vue-router'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'app',
      component: () => import('../features/shared/components/MainLayout.vue')
    },
    {
      path: '/dashboard',
      name: 'dashboard',
      component: () => import('../features/dashboard/views/Dashboard.vue')
    },
    {
      path: '/kanban',
      name: 'kanban',
      component: () => import('../features/kanban/views/KanbanBoard.vue')
    },
    {
      path: '/priority',
      name: 'priority',
      component: () => import('../features/priority/views/PriorityChart.vue')
    },
    {
      path: '/backlog',
      name: 'backlog',
      component: () => import('../features/backlog/views/BacklogView.vue')
    },
    {
      path: '/time-tracking',
      name: 'timeTracking',
      component: () => import('../features/timeTracking/views/TimeTrackingView.vue')
    },
    {
      path: '/analytics',
      name: 'analytics',
      component: () => import('../features/analytics/views/AnalyticsDashboard.vue')
    },
    {
      path: '/team',
      name: 'team',
      component: () => import('../features/team/views/TeamManagement.vue')
    }
  ]
})

export default router
