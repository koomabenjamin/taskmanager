<template>
    <div>
      <form @submit.prevent="submitForm">
        <label for="name">Task Name</label>
        <input type="text" id="name" v-model="name" required>
  
        <label for="project">Project</label>
        <select id="project" v-model="project">
          <option v-for="proj in projects" :key="proj.id" :value="proj.id">{{ proj.name }}</option>
        </select>
  
        <label for="members">Members</label>
        <select id="members" v-model="members" multiple>
          <option v-for="member in membersList" :key="member.id" :value="member.id">{{ member.name }}</option>
        </select>
  
        <label for="priority">Priority</label>
        <select id="priority" v-model="priority">
          <option v-for="prio in priorities" :key="prio.id" :value="prio.id">{{ prio.level }}</option>
        </select>
  
        <label for="category">Category</label>
        <select id="category" v-model="category">
          <option v-for="cat in categories" :key="cat.id" :value="cat.id">{{ cat.name }}</option>
        </select>
  
        <button type="submit">Add Task</button>
      </form>
    </div>
  </template>
  
  <script setup>
  import { ref, onMounted } from 'vue'
  import axios from 'axios'
  
  const name = ref('')
  const project = ref('')
  const members = ref([])
  const priority = ref('')
  const category = ref('')
  
  const projects = ref([])
  const membersList = ref([])
  const priorities = ref([])
  const categories = ref([])
  
  onMounted(async () => {
    projects.value = (await axios.get('/api/projects')).data
    membersList.value = (await axios.get('/api/members')).data
    priorities.value = (await axios.get('/api/priorities')).data
    categories.value = (await axios.get('/api/categories')).data
  })
  
  const submitForm = async () => {
    await axios.post('/api/tasks', {
      name: name.value,
      project: project.value,
      members: members.value,
      priority: priority.value,
      category: category.value,
    })
    name.value = ''
    project.value = ''
    members.value = []
    priority.value = ''
    category.value = ''
  }
  </script>
  