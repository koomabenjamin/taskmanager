import { defineStore } from 'pinia';
import axios from 'axios';

export const useAuthStore = defineStore('authStore', {
  state: () => ({
    authToken: localStorage.getItem('authToken') || '',
    user: null,
    isAuthenticated: !!localStorage.getItem('authToken'),
  }),
  actions: {
    async login(email, password) {
      try {
        await axios.get(`${import.meta.env.VITE_API_URL}/api/v1/sanctum/csrf-cookie`);
        const response = await axios.post(`${import.meta.env.VITE_API_URL}/api/v1/login`, { email, password });
        
        this.authToken = response.data.token;
        localStorage.setItem('authToken', response.data.token);
        this.isAuthenticated = true;

        return response;
      } catch (error) {
        console.error('Error logging in:', error);
        throw error;
      }
    },
    logout() {
      this.authToken = '';
      this.user = null;
      this.isAuthenticated = false;
      localStorage.removeItem('authToken');
    },
  },
});
