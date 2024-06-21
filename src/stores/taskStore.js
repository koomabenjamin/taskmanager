import { defineStore } from 'pinia'
import axios from 'axios'

export const useTaskStore = defineStore('taskStore', {
  state: () => ({
    tasks: [],
    projects: [],
    members: [],
    priorities: [],
    categories: [],
  }),
  
  actions: {
    async fetchTasks() {
      this.tasks = (await axios.get('/api/v1/tasks')).data
    },
    async fetchProjects() {
      this.projects = (await axios.get('/api/v1/projects')).data
    },
    async fetchMembers() {
      this.members = (await axios.get('/api/members')).data
    },
  }
})
