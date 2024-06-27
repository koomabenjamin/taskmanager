// src/apiService.js
import axios from 'axios';

const apiClient = axios.create({
  baseURL: '../db.json', // Replace with the path to your JSON file
  withCredentials: false,
  headers: {
    Accept: 'application/json',
    'Content-Type': 'application/json'
  }
});

export default {
  getTasks() {
    return apiClient.get('/tasks');
  }
};
