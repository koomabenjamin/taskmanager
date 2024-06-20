import { defineStore } from 'pinia'
import axios from 'axios'

export const useAuthStore = defineStore('auth', {
  state: () => ({
    user: null,
    token: null,
    returnUrl: null,
  }),
  getters: {
    isAuthenticated: state => !!state.user,
  },
  actions: {
    async login(email, password) {
      try {
        const API_URL = import.meta.env.VITE_API_URL;

        console.log("BASE URL: ", API_URL)
        
        const response = await axios.post(`${API_URL}/api/auth/login`, { email, password });

        console.log("RESPONSE: ", response);

        this.user = response.data.results.user;
        this.token = response.data.results.token;
        localStorage.setItem('authUser', JSON.stringify(this.user));
        localStorage.setItem('authToken', this.token);
        axios.defaults.headers.common['Authorization'] = `Bearer ${this.token}`;
      } catch (error) {
        console.error("Login failed: ", error);
        throw new Error('Login failed');
      }
    },
    logout() {
      this.user = null;
      this.token = null;
      localStorage.removeItem('authUser');
      localStorage.removeItem('authToken');
      delete axios.defaults.headers.common['Authorization'];
    },
    loadUserFromStorage() {
      const user = localStorage.getItem('authUser');
      const token = localStorage.getItem('authToken');
      if (user && token) {
        this.user = JSON.parse(user);
        this.token = token;
        axios.defaults.headers.common['Authorization'] = `Bearer ${this.token}`;
      }
    },
  },
});
