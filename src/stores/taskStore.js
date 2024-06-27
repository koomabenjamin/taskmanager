import { defineStore } from 'pinia';
import axiosInstance from '../plugins/axios';
import { reactive, toRefs } from 'vue'; // Import toRefs from Vue

export const useTaskStore = defineStore('taskStore', () => {
    const state = reactive({
      tasks: [],
    });

    const fetchTasks = async () => {
      try {
        const response = await axiosInstance.get('/api/v1/tasks/all');
        state.tasks = response.data.data; // Update to access data array from response
      } catch (error) {
        console.error('Error fetching tasks:', error);
        throw error;
      }
    };

    return {
      ...toRefs(state),
      fetchTasks,
    };
});
