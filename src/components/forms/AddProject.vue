<template>
    <div>
      <form @submit.prevent="submitForm">
        <label for="name">Project Name</label>
        <input type="text" id="name" v-model="name" required>
        <button type="submit">Add Project</button>
      </form>
    </div>
  </template>
  
  <script setup>
  import { ref } from 'vue'
  import axios from 'axios'
  
  const name = ref('')
  
  const submitForm = async () => {
    await axios.post('/api/projects', { name: name.value })
    name.value = ''
  }
  </script>
  