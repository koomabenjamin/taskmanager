import { defineStore } from "pinia";
import axios from "axios";
import { API_URLS } from "../apis";

export const useAuthStore = defineStore("auth", {
  state: () => ({
    user: null,
    token: null,
    tokenExpiry: null,
    returnUrl: null,
  }),
  getters: {
    isAuthenticated: (state) =>
      !!state.user &&
      new Date().getTime() < new Date(state.tokenExpiry).getTime(),
  },
  actions: {
    //=====Login Action=====
    async login(email, password) {
      try {
        const response = await axios.post(API_URLS.LOGIN, { email, password });
        this.user = response.data.results.user;
        this.token = response.data.results.token;
        this.tokenExpiry = response.data.results.expires_at;

        localStorage.setItem("authUser", JSON.stringify(this.user));
        localStorage.setItem("authToken", this.token);
        localStorage.setItem("tokenExpiry", this.tokenExpiry);
      } catch (error) {
        if (
          error.response &&
          error.response.data &&
          error.response.data.results
        ) {
          throw new Error(error.response.data.results.message);
        } else {
          console.error("Login failed: ", error.message);
          throw new Error("An unknown error occurred during login.");
        }
      }
    },

    //=====Register Action=====
    async register(name, email, password) {
      try {
        const API_URL = import.meta.env.VITE_API_URL;
        // console.log("BASE URL: ", API_URL);
        const response = await axios.post(API_URLS.REGISTER, {
          name,
          email,
          password,
        });
        return response.data;
      } catch (error) {
        if (
          error.response &&
          error.response.data &&
          error.response.data.results
        ) {
          throw new Error(error.response.data.results.message);
        } else {
          console.error("Registration failed: ", error.message);
          throw new Error("An unknown error occurred during registration.");
        }
      }
    },

    //=====Logout Action=====
    logout() {
      this.user = null;
      this.token = null;
      this.tokenExpiry = null;

      localStorage.removeItem("authUser");
      localStorage.removeItem("authToken");
      localStorage.removeItem("tokenExpiry");
    },

    //=====Load Data From Local Storage Action=====
    loadUserFromStorage() {
      const user = localStorage.getItem("authUser");
      const token = localStorage.getItem("authToken");
      const tokenExpiry = localStorage.getItem("tokenExpiry");

      if (
        user &&
        token &&
        tokenExpiry &&
        new Date().getTime() < new Date(tokenExpiry).getTime()
      ) {
        this.user = JSON.parse(user);
        this.token = token;
        this.tokenExpiry = tokenExpiry;
      } else {
        this.logout();
      }
    },
  },
});
