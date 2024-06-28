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
            const response = await axiosInstance.put(`/api/v1/tasks/${taskId}/update`, task);
            const updatedTask = response.data.data;
            const updatedTaskIndex = state.tasks.findIndex(t => t.id === taskId);
            if (updatedTaskIndex !== -1) {
                state.tasks.splice(updatedTaskIndex, 1, updatedTask);
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
            await axiosInstance.patch(`/api/v1/tasks/${taskId}/restore`);
            const updatedTasks = state.tasks.map(task => {
                if (task.id === taskId) {
                    task.deleted_at = null; // Assuming `deleted_at` is set to null on restore
                }
                return task;
            });
            state.tasks = updatedTasks;
        } catch (error) {
            console.error('Error restoring task:', error);
            throw error;
        }
    };


    const fetchDeletedUsers = async () => {
        try {
            const response = await axiosInstance.get('/api/v1/tasks/trashed/temp');
            state.deletedUsers = response.data.data;
        } catch (error) {
            console.error('Error fetching deleted users:', error);
            throw error;
        }
    };

    const fetchTasksPastDate = async () => {
        try {
            const response = await axiosInstance.get('/api/v1/tasks/past-implementation');
            state.tasksPastDate = response.data.data;
        } catch (error) {
            console.error('Error fetching tasks past implementation date:', error);
            throw error;
        }
    };

    const fetchTasksByCategory = async () => {
        try {
            // Assuming you have an endpoint to fetch tasks by category
            const response = await axiosInstance.get('/api/v1/tasks-by-category');
            state.tasksByCategory = response.data.data;
        } catch (error) {
            console.error('Error fetching tasks by category:', error);
            throw error;
        }
    };

    return {
        ...toRefs(state),
        fetchTasks,
        updateTask,
        deleteTask,
        restoreTask,
        fetchDeletedUsers,
        fetchTasksPastDate,
        fetchTasksByCategory,
    };
});
