<template>
  <div class="space-y-6">
    <!-- Header -->
    <div>
      <h1 class="text-3xl font-bold text-emerald-900">Dashboard</h1>
      <p class="text-gray-600 mt-2">Welcome back! Here's your task overview for today.</p>
    </div>

    <!-- Key Metrics -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
      <MetricCard
        title="Active Tasks"
        :value="metrics.activeTasks"
        icon="CheckCircleIcon"
        color="bg-emerald-100"
        textColor="text-emerald-700"
      />
      <MetricCard
        title="Overdue Tasks"
        :value="metrics.overdueTasks"
        icon="ExclamationIcon"
        color="bg-red-100"
        textColor="text-red-700"
      />
      <MetricCard
        title="Completed Today"
        :value="metrics.completedToday"
        icon="CheckIcon"
        color="bg-green-100"
        textColor="text-green-700"
      />
      <MetricCard
        title="Team Members"
        :value="metrics.teamMembers"
        icon="UserGroupIcon"
        color="bg-blue-100"
        textColor="text-blue-700"
      />
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
      <!-- My Tasks -->
      <div class="lg:col-span-2 bg-white rounded p-6 shadow border border-gray-200">
        <div class="flex items-center justify-between mb-4">
          <h2 class="text-xl font-bold text-emerald-900">My Tasks</h2>
          <Button label="View All" variant="ghost" size="sm" />
        </div>
        <div class="space-y-3">
          <TaskItem
            v-for="task in myTasks.slice(0, 5)"
            :key="task.id"
            :task="task"
          />
        </div>
      </div>

      <!-- Upcoming Deadlines -->
      <div class="bg-white rounded p-6 shadow border border-gray-200">
        <h2 class="text-xl font-bold text-emerald-900 mb-4">Upcoming Deadlines</h2>
        <div class="space-y-3">
          <DeadlineItem
            v-for="deadline in upcomingDeadlines"
            :key="deadline.id"
            :deadline="deadline"
          />
        </div>
      </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
      <!-- Project Progress -->
      <div class="bg-white rounded p-6 shadow border border-gray-200">
        <h2 class="text-xl font-bold text-emerald-900 mb-4">Project Progress</h2>
        <div class="space-y-4">
          <ProjectProgressBar
            v-for="project in projects"
            :key="project.id"
            :project="project"
          />
        </div>
      </div>

      <!-- Team Activity -->
      <div class="bg-white rounded p-6 shadow border border-gray-200">
        <h2 class="text-xl font-bold text-emerald-900 mb-4">Team Activity</h2>
        <div class="space-y-3 text-sm">
          <ActivityLog
            v-for="activity in teamActivity"
            :key="activity.id"
            :activity="activity"
          />
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, computed } from 'vue'
import Button from '@/features/shared/components/Button.vue'
import MetricCard from '../components/MetricCard.vue'
import TaskItem from '../components/TaskItem.vue'
import DeadlineItem from '../components/DeadlineItem.vue'
import ProjectProgressBar from '../components/ProjectProgressBar.vue'
import ActivityLog from '../components/ActivityLog.vue'

const metrics = ref({
  activeTasks: 12,
  overdueTasks: 2,
  completedToday: 5,
  teamMembers: 4
})

const myTasks = ref([
  { id: 1, title: 'A/B Testing - Round 3', priority: 'high', dueDate: '2026-05-08', status: 'in-progress' },
  { id: 2, title: 'Design System Documentation', priority: 'medium', dueDate: '2026-05-10', status: 'pending' },
  { id: 3, title: 'User Research Analysis', priority: 'high', dueDate: '2026-05-07', status: 'in-progress' },
  { id: 4, title: 'API Integration', priority: 'medium', dueDate: '2026-05-12', status: 'pending' },
  { id: 5, title: 'Performance Optimization', priority: 'low', dueDate: '2026-05-15', status: 'pending' }
])

const upcomingDeadlines = ref([
  { id: 1, title: 'Q2 Planning', daysLeft: 1, project: 'Statra Insurance' },
  { id: 2, title: 'Sprint Review', daysLeft: 3, project: 'Meridian' },
  { id: 3, title: 'Beta Release', daysLeft: 7, project: 'Risen' }
])

const projects = ref([
  { id: 1, name: 'Statra Insurance', completion: 75, color: 'bg-emerald-500' },
  { id: 2, name: 'Meridian', completion: 45, color: 'bg-rose-500' },
  { id: 3, name: 'Risen', completion: 60, color: 'bg-blue-500' },
  { id: 4, name: 'SkillBox', completion: 30, color: 'bg-yellow-500' }
])

const teamActivity = ref([
  { id: 1, user: 'John Doe', action: 'completed', target: 'User Authentication', time: '2 hours ago' },
  { id: 2, user: 'Jane Smith', action: 'commented on', target: 'Design System', time: '4 hours ago' },
  { id: 3, user: 'Mike Johnson', action: 'started', target: 'API Testing', time: '1 day ago' },
  { id: 4, user: 'Sarah Williams', action: 'reviewed', target: 'Code Changes', time: '1 day ago' }
])
</script>

<style scoped></style>


