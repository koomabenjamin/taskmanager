import { defineStore } from 'pinia';
import axiosInstance from '../plugins/axios';
import { reactive, toRefs } from 'vue';

export const useTaskStore = defineStore('taskStore', () => {
    const state = reactive({
        tasks: [],
    });

    const fetchTasks = async () => {
        try {
            const response = await axiosInstance.get('/api/v1/tasks/all');
            state.tasks = response.data.data;
        } catch (error) {
            console.error('Error fetching tasks:', error);
            throw error;
        }
    };

    const updateTask = async (task) => {
        try {
            const taskId = task.id;
            const response = await axiosInstance.patch(`/api/v1/tasks/${taskId}/update`, task);
            const updatedTaskIndex = state.tasks.findIndex(t => t.id === taskId);
            if (updatedTaskIndex !== -1) {
                state.tasks.splice(updatedTaskIndex, 1, response.data.data);
            }
        } catch (error) {
            console.error('Error updating task:', error);
            throw error;
        }
    };

    const deleteTask = async (taskId) => {
        try {
            await axiosInstance.delete(`/api/v1/tasks/${taskId}/delete`);
            state.tasks = state.tasks.filter(task => task.id !== taskId);
        } catch (error) {
            console.error('Error deleting task:', error);
            throw error;
        }
    };

    const restoreTask = async (taskId) => {
        try {
            const response = await axiosInstance.patch(`/api/v1/tasks/${taskId}/restore`);
            const restoredTask = response.data.data;
            const taskIndex = state.tasks.findIndex(t => t.id === restoredTask.id);
            if (taskIndex !== -1) {
                state.tasks.splice(taskIndex, 1, restoredTask);
            } else {
                state.tasks.push(restoredTask); // Add to tasks if not found (edge case)
            }
        } catch (error) {
            console.error('Error restoring task:', error);
            throw error;
        }
    };

    return {
        ...toRefs(state),
        fetchTasks,
        updateTask,
        deleteTask,
        restoreTask,
    };
});
