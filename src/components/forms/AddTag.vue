<template v-slot:form>
  <form class="grid grid-cols-2 gap-2 -space-y-0" @submit.prevent="addTag">
    <Input v-model="tag.id" placeholder="ID" class="col-span-2" />
    <Input v-model="tag.name" placeholder="Name" class="col-span-2" />
    
    <Button type="submit" label="Add Tag" icon="PlusIcon" color="bg-lime-500 text-white col-span-2" size="xl" />
  </form>
</template>

<script setup>
import { ref } from 'vue';
import Input from '../shared/Input.vue';
import Button from '../shared/Button.vue';
import axios from 'axios';

const tag = ref({
  id: '',
  name: '',
});

const addTag = async () => {
  console.log('Tag data before sending:', tag.value);

  try {
    // Check if tag with the same ID already exists
    const existingTag = await axios.get(`http://localhost:3000/tags/${tag.value.id}`);
    
    if (existingTag.data) {
      console.error('Tag with the same ID already exists');
      alert('Tag with the same ID already exists');
      return;
    }
  } catch (error) {
    // If the error is not 404, rethrow it
    if (error.response && error.response.status !== 404) {
      console.error('Error checking for existing tag:', error);
      return;
    }
  }

  try {
    const response = await axios.post('http://localhost:3000/tags', tag.value);
    console.log('Response data:', response.data);

    if (response.data) {
      console.log('Tag added successfully:', response.data);
      tag.value = {
        id: '',
        name: '',
      };
    } else {
      console.error('Empty response data received');
    }
  } catch (error) {
    console.error('Error adding tag:', error);
  }
};
</script>

<style scoped></style>
