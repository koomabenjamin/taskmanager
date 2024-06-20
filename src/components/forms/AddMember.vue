<template>
    <div>
      <form @submit.prevent="submitForm">
        <label for="name">Member Name</label>
        <input type="text" id="name" v-model="name" required>
        <button type="submit">Add Member</button>
      </form>
    </div>
  </template>
  
  <script setup>
  import { ref } from 'vue'
  import axios from 'axios'
  
  const name = ref('')
  
  const submitForm = async () => {
    await axios.post('/api/members', { name: name.value })
    name.value = ''
  }
  </script>
  