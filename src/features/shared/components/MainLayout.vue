<template>
  <div :class="['h-screen w-screen flex overflow-hidden', 'bg-gray-50']">
    <SideBar 
      ref="sidebarRef"
      @add-task="showAddTaskModal = true" 
      @toggle-sidebar="onToggleSidebar"
    />

    <div class="flex-1 flex flex-col overflow-hidden">
      <TopBar @toggle-sidebar="toggleSidebar" />

      <div class="flex-1 overflow-auto">
        <div class="p-6">
          <!-- Router View for displaying child routes -->
          <RouterView />
        </div>
      </div>
    </div>

    <!-- Add Task Modal -->
    <div v-if="showAddTaskModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
      <Card class="p-8 max-w-md w-full">
        <h2 class="text-2xl font-bold mb-4">Add New Task</h2>
        <p class="text-gray-600 mb-6">Task creation form will be implemented here</p>
        <Button label="Close" variant="secondary" @click="showAddTaskModal = false" />
      </Card>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import { useThemeStore } from '@/stores/themes/themeStore'
import SideBar from '@/features/shared/components/SideBar.vue'
import TopBar from '@/features/shared/components/TopBar.vue'
import Card from '@/features/shared/components/Card.vue'
import Button from '@/features/shared/components/Button.vue'
import { RouterView } from 'vue-router'

const themeStore = useThemeStore()

const sidebarRef = ref(null)
const showAddTaskModal = ref(false)

// Initialize theme on component mount
onMounted(() => {
  themeStore.initializeTheme()
})

const toggleSidebar = () => {
  if (sidebarRef.value) {
    sidebarRef.value.toggleSidebar()
  }
}

const onToggleSidebar = (isCollapsed) => {
  // Handle any additional logic needed when sidebar is toggled
}
</script>

<style scoped></style>


