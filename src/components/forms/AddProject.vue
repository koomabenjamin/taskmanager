<template v-slot:form>
  <form class="grid grid-cols-2 gap-2 -space-y-0" @submit.prevent="AddProject">
    <Input v-model="project.id" placeholder="ID" class="col-span-2" />
    <Input v-model="project.name" placeholder="Name" class="col-span-2" />
    
    <Button type="submit" label="Add Project" icon="PlusIcon" color="bg-lime-500 text-white col-span-2" size="xl" />
  </form>
</template>

<script setup>
import { ref } from 'vue';
import Input from '../shared/Input.vue';
import Button from '../shared/Button.vue';
import axios from 'axios';

const project = ref({
  id: '',
  name: '',
});

const AddProject = async () => {
  console.log('Project data before sending:', project.value);

  try {
    // Check if project with the same ID already exists
    const existingProject = await axios.get(`http://localhost:3000/projects/${project.value.id}`);
    
    if (existingProject.data) {
      console.error('Project with the same ID already exists');
      alert('Project with the same ID already exists');
      return;
    }
  } catch (error) {
    // If the error is not 404, rethrow it
    if (error.response && error.response.status !== 404) {
      console.error('Error checking for existing project:', error);
      return;
    }
  }

  try {
    const response = await axios.post('http://localhost:3000/projects', project.value);
    console.log('Response data:', response.data);

    if (response.data) {
      console.log('Project added successfully:', response.data);
      project.value = {
        id: '',
        name: '',
      };
    } else {
      console.error('Empty response data received');
    }
  } catch (error) {
    console.error('Error adding project:', error);
  }
};
</script>

<style scoped></style>
