import { defineStore } from 'pinia';
import axiosInstance from '../plugins/axios'; 
import { ref } from 'vue';
import router from '../router';
// import pinia from "@/main.js";

export const useAuthStore = defineStore({
  id: 'authStore', // Unique identifier for the store
  state: () => ({
    user: null,
    token: localStorage.getItem('token') || '',
  }),
  actions: {
    async login(credentials) {
      try {
        const response = await axiosInstance.post('http://localhost:8000/api/v1/login', credentials);
        const { user, token } = response.data;

        // Update state
        this.user = user;
        this.token = token;

        // Store token in localStorage
        localStorage.setItem('token', token);

        // Navigate to appropriate route after successful login
        router.push({ name: 'vue-dashboard' });
      } catch (error) {
        console.error('Error logging in:', error);
        throw error; // Propagate the error to handle it in the component
      }
    },

    async logout() {
      try {
        await axiosInstance.post('http://localhost:8000/api/v1/logout');
        
        // Clear local state
        this.user = null;
        this.token = '';

        // Clear token from localStorage
        localStorage.removeItem('token');

        // Navigate to login page after logout
        router.push({ name: 'login' });
      } catch (error) {
        console.error('Error logging out:', error);
        throw error; // Propagate the error to handle it in the component
      }
    },

    async goToProfile() {
      console.log('Navigating to profile...');
      router.push({ name: 'profile' });
    },

    isAuthenticated() {
      return !!this.token; // Check if token exists
    },
  },
});
