import { defineStore } from 'pinia';
import { fetchTasks, fetchMembers, fetchProjects } from '@/services/api';

export const useTaskStore = defineStore('taskStore', {
  // State definition
  state: () => ({
    tasks: [],
    members: [],
    projects: [],
  }),

  // Actions definition
  actions: {
    /**
     * Fetch tasks from API and update state.
     * @returns {Promise<void>}
     */
    async fetchTasks() {
      try {
        this.tasks = await fetchTasks();
      } catch (error) {
        console.error('Error fetching tasks:', error);
      }
    },

    /**
     * Fetch members from API and update state.
     * @returns {Promise<void>}
     */
    async fetchMembers() {
      try {
        this.members = await fetchMembers();
      } catch (error) {
        console.error('Error fetching members:', error);
      }
    },

    /**
     * Fetch projects from API and update state.
     * @returns {Promise<void>}
     */
    async fetchProjects() {
      try {
        this.projects = await fetchProjects();
      } catch (error) {
        console.error('Error fetching projects:', error);
      }
    },

    /**
     * Fetch all data (tasks, members, projects) concurrently.
     * @returns {Promise<void>}
     */
    async fetchAllData() {
      try {
        await Promise.all([this.fetchTasks(), this.fetchMembers(), this.fetchProjects()]);
      } catch (error) {
        console.error('Error fetching all data:', error);
      }
    },
  },

  // Getters definition
  getters: {
    /**
     * Get task by ID.
     * @param {number} taskId - ID of the task.
     * @returns {object|undefined} - Task object if found, otherwise undefined.
     */
    getTaskById: (state) => (taskId) => {
      return state.tasks.find(task => task.id === taskId);
    },
  },
});
