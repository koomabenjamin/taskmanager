<template>
    <div>
      <form @submit.prevent="submitForm">
        <label for="name">Tag Name</label>
        <input type="text" id="name" v-model="name" required>
        <button type="submit">Add Tag</button>
      </form>
    </div>
  </template>
  
  <script setup>
  import { ref } from 'vue'
  import axios from 'axios'
  
  const name = ref('')
  
  const submitForm = async () => {
    await axios.post('/api/tags', { name: name.value })
    name.value = ''
  }
  </script>
  