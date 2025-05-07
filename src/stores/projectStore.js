import { defineStore } from 'pinia';

export const useProjectStore = defineStore('projectStore', {
  state: () => ({
    projects: []
  }),
  actions: {
    addProject(project) {
      this.projects.push(project);
    },
    removeProject(projectId) {
      this.projects = this.projects.filter(project => project.id !== projectId);
    }
  },
  getters: {
    getProjects: (state) => state.projects
  }
});
