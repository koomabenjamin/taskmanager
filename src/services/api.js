import axiosInstance from '@/plugins/axios';
import { useTaskStore } from '@/stores/taskStore'; // Import Pinia store

export const fetchTasks = async () => {
  const taskStore = useTaskStore(); // Initialize Pinia store

  try {
    // Fetch CSRF token if necessary
    await axiosInstance.get('/api/v1/sanctum/csrf-cookie');

    // ysing an authorization token
    const authToken = taskStore.authToken;
    const headers = {};
    if (authToken) {
      headers.Authorization = `Bearer ${authToken}`;
    }

    const response = await axiosInstance.get('/api/v1/tasks/all', { headers });
    return response.data;
  } catch (error) {
    throw new Error(`Error fetching tasks: ${error.message}`);
  }
};

export const fetchMembers = async () => {
  const taskStore = useTaskStore(); // Initialize Pinia store

  try {
    // Fetch CSRF token if necessary
    await axiosInstance.get('/api/v1/sanctum/csrf-cookie');

    const authToken = taskStore.authToken;
    const headers = {};
    if (authToken) {
      headers.Authorization = `Bearer ${authToken}`;
    }

    const response = await axiosInstance.get('/api/v1/profiles/', { headers });
    return response.data;
  } catch (error) {
    throw new Error(`Error fetching members: ${error.message}`);
  }
};

export const fetchProjects = async () => {
  const taskStore = useTaskStore(); // Initialize Pinia store

  try {
    // Fetch CSRF token if necessary
    await axiosInstance.get('/sanctum/csrf-cookie');

    const authToken = taskStore.authToken;
    const headers = {};
    if (authToken) {
      headers.Authorization = `Bearer ${authToken}`;
    }

    const response = await axiosInstance.get('/api/v1/projects/all', { headers });
    return response.data;
  } catch (error) {
    throw new Error(`Error fetching projects: ${error.message}`);
  }
};
