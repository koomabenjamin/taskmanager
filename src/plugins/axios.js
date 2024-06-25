import axios from 'axios';
import { useAuthStore } from '@/stores/authStore';  // Import Pinia store

axios.defaults.baseURL = import.meta.env.VITE_API_URL;

axios.interceptors.request.use(async config => {
  const authStore = useAuthStore();  // Initialize Pinia store

  // Fetch CSRF token
  await axios.get(`${import.meta.env.VITE_API_URL}/api/v1sanctum/csrf-cookie`);

  // Add Authorization token if available
  const token = authStore.authToken;  // Assuming store has a getter for authToken
  if (token) {
    config.headers['Authorization'] = `Bearer ${token}`;
  }

  return config;
});

export default axios;
