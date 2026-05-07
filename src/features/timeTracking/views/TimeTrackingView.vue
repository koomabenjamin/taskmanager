<template>
  <div class="space-y-6">
    <!-- Header -->
    <div>
      <h1 class="text-3xl font-bold text-emerald-900">Time Tracking</h1>
      <p class="text-gray-600 mt-2">Track and monitor time spent on tasks</p>
    </div>

    <!-- Time Tracking Stats -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
      <StatCard title="Today" :hours="8" unit="hrs" />
      <StatCard title="This Week" :hours="32" unit="hrs" />
      <StatCard title="Billable Hours" :hours="25" unit="hrs" />
      <StatCard title="Estimated vs Actual" :hours="2" unit="hrs over" />
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
      <!-- Active Timer -->
      <div class="bg-white rounded-lg p-6 shadow-sm border border-emerald-100">
        <h3 class="text-lg font-bold text-emerald-900 mb-4">Current Task</h3>
        <div class="space-y-4">
          <div>
            <p class="text-2xl font-bold text-emerald-700">2:45:30</p>
            <p class="text-sm text-gray-600">Elapsed Time</p>
          </div>
          <p class="font-semibold text-gray-800">A/B Testing - Round 3</p>
          <div class="flex space-x-2">
            <Button label="Pause" variant="secondary" size="lg" style="flex: 1" />
            <Button label="Stop" variant="primary" size="lg" style="flex: 1" />
          </div>
        </div>
      </div>

      <!-- Time Entries -->
      <div class="lg:col-span-2 bg-white rounded-lg p-6 shadow-sm border border-emerald-100">
        <h3 class="text-lg font-bold text-emerald-900 mb-4">Today's Entries</h3>
        <div class="space-y-3">
          <TimeEntry
            v-for="entry in timeEntries"
            :key="entry.id"
            :entry="entry"
          />
        </div>
      </div>
    </div>

    <!-- Weekly Summary -->
    <div class="bg-white rounded-lg p-6 shadow-sm border border-emerald-100">
      <h3 class="text-lg font-bold text-emerald-900 mb-4">Weekly Summary</h3>
      <div class="grid grid-cols-7 gap-2">
        <WeeklyBar
          v-for="day in weeklyData"
          :key="day.day"
          :day="day.day"
          :hours="day.hours"
        />
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue'
import Button from '@/features/shared/components/Button.vue'
import StatCard from '../components/StatCard.vue'
import TimeEntry from '../components/TimeEntry.vue'
import WeeklyBar from '../components/WeeklyBar.vue'

const timeEntries = ref([
  { id: 1, task: 'A/B Testing', duration: '2:45', project: 'Statra Insurance' },
  { id: 2, task: 'Design Review', duration: '1:30', project: 'Meridian' },
  { id: 3, task: 'Meeting - Sprint Planning', duration: '1:00', project: 'Risen' }
])

const weeklyData = ref([
  { day: 'Mon', hours: 8 },
  { day: 'Tue', hours: 7.5 },
  { day: 'Wed', hours: 8 },
  { day: 'Thu', hours: 6.5 },
  { day: 'Fri', hours: 2 },
  { day: 'Sat', hours: 0 },
  { day: 'Sun', hours: 0 }
])
</script>

<style scoped></style>
