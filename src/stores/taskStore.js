import { ref, computed } from 'vue'
import { defineStore } from 'pinia'

export const useTaskStore = defineStore('tasks', () => {
  const tasks = ref([
    { id: 1, title: 'A/B Testing - Round 3', status: 'todo', priority: 'high', assignees: ['John Doe'], tags: ['Testing', 'Research'], dueDate: '2026-05-10', description: 'Complete A/B test round 3', projectId: 1 },
    { id: 2, title: 'Design System Documentation', status: 'doing', priority: 'medium', assignees: ['Jane Smith'], tags: ['Documentation'], dueDate: '2026-05-15', description: 'Document design system components', projectId: 1 },
    { id: 3, title: 'User Research Analysis', status: 'doing', priority: 'high', assignees: ['Mike Johnson'], tags: ['Research'], dueDate: '2026-05-12', description: 'Analyze user research data', projectId: 2 },
    { id: 4, title: 'API Integration', status: 'todo', priority: 'medium', assignees: ['John Doe', 'Sarah Williams'], tags: ['Backend'], dueDate: '2026-05-18', description: 'Integrate new API endpoints', projectId: 2 },
    { id: 5, title: 'Performance Optimization', status: 'done', priority: 'low', assignees: ['Sarah Williams'], tags: ['Optimization'], dueDate: '2026-05-20', description: 'Optimize database queries', projectId: 1 },
    { id: 6, title: 'Bug Fixes', status: 'doing', priority: 'high', assignees: ['Mike Johnson'], tags: ['Bug'], dueDate: '2026-05-08', description: 'Fix critical production bugs', projectId: 3 },
    { id: 7, title: 'Feature Testing', status: 'todo', priority: 'medium', assignees: ['Jane Smith', 'John Doe'], tags: ['Testing'], dueDate: '2026-05-14', description: 'Test new features', projectId: 3 },
    { id: 8, title: 'Database Migration', status: 'backlog', priority: 'high', assignees: ['Sarah Williams'], tags: ['Database'], dueDate: '2026-05-25', description: 'Migrate to new database schema', projectId: 1 }
  ])

  const categories = ref([
    { id: 'todo', name: 'To Do', color: 'bg-blue-100', textColor: 'text-blue-700', order: 1 },
    { id: 'doing', name: 'In Progress', color: 'bg-yellow-100', textColor: 'text-yellow-700', order: 2 },
    { id: 'done', name: 'Done', color: 'bg-green-100', textColor: 'text-green-700', order: 3 }
  ])

  const taskHistory = ref([])

  const getTasksByStatus = (status) => {
    return tasks.value.filter(task => task.status === status)
  }

  const updateTaskStatus = (taskId, newStatus) => {
    const task = tasks.value.find(t => t.id === taskId)
    if (task) {
      const oldStatus = task.status
      task.status = newStatus
      
      // Record history
      taskHistory.value.push({
        id: Math.random(),
        taskId,
        taskTitle: task.title,
        from: oldStatus,
        to: newStatus,
        timestamp: new Date(),
        changedBy: 'Current User'
      })
    }
  }

  const addTask = (newTask) => {
    const id = Math.max(...tasks.value.map(t => t.id), 0) + 1
    tasks.value.push({
      id,
      ...newTask,
      status: newTask.status || 'todo'
    })
  }

  const updateTask = (taskId, updates) => {
    const task = tasks.value.find(t => t.id === taskId)
    if (task) {
      Object.assign(task, updates)
    }
  }

  const deleteTask = (taskId) => {
    const index = tasks.value.findIndex(t => t.id === taskId)
    if (index > -1) {
      tasks.value.splice(index, 1)
    }
  }

  const addCategory = (newCategory) => {
    const id = `category-${Math.random().toString(36).substr(2, 9)}`
    const order = Math.max(...categories.value.map(c => c.order), 0) + 1
    categories.value.push({
      id,
      ...newCategory,
      order
    })
  }

  const deleteCategory = (categoryId) => {
    const index = categories.value.findIndex(c => c.id === categoryId)
    if (index > -1) {
      categories.value.splice(index, 1)
    }
  }

  const reorderCategories = (newOrder) => {
    categories.value = newOrder
  }

  const sortedCategories = computed(() => {
    return [...categories.value].sort((a, b) => a.order - b.order)
  })

  const getTaskHistory = () => {
    return taskHistory.value.sort((a, b) => b.timestamp - a.timestamp)
  }

  const getTaskHistoryForTask = (taskId) => {
    return taskHistory.value.filter(h => h.taskId === taskId)
  }

  return {
    tasks,
    categories,
    taskHistory,
    getTasksByStatus,
    updateTaskStatus,
    addTask,
    updateTask,
    deleteTask,
    addCategory,
    deleteCategory,
    reorderCategories,
    sortedCategories,
    getTaskHistory,
    getTaskHistoryForTask
  }
})
