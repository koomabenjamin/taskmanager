import { defineStore } from 'pinia';
import { ref, computed } from 'vue';
import { useTasks } from '../composables/useTasks';
import { useProjects } from '../composables/useProjects';
import { useMembers } from '../composables/useMembers';

export const useTaskStore = defineStore('taskStore', () => {
  const { tasks, fetchTasks, createTaskAction, updateTaskAction, deleteTaskAction, restoreTaskAction, restoreAllTasksAction } = useTasks();
  const { projects, fetchProjects } = useProjects();
  const { members, fetchMembers } = useMembers();

  /**
   * State
   */
  const state = {
    tasks,
    projects,
    members,
  };

  /**
   * Getters
   */
  const getTaskById = (taskId) => {
    return computed(() => tasks.value.find(task => task.id === taskId));
  };

  /**
   * Actions
   */
  const fetchAllData = async () => {
    await fetchTasks();
    await fetchProjects();
    await fetchMembers();
  };

  return {
    ...state,
    fetchTasks,
    fetchProjects,
    fetchMembers,
    createTaskAction,
    updateTaskAction,
    deleteTaskAction,
    restoreTaskAction,
    restoreAllTasksAction,
    fetchAllData,
    getTaskById,
  };
});
