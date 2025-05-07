<template v-slot:form>
  <form class="grid grid-cols-2 gap-2 -space-y-0" @submit.prevent="addMember">
    <Input v-model="member.id" placeholder="ID" class="col-span-2" />
    <Input v-model="member.name" placeholder="Name" class="col-span-2" />
    <Input v-model="member.image" placeholder="Image URL" class="col-span-2" />
    <Button type="submit" label="Add Member" icon="PlusIcon" color="bg-lime-500 text-white col-span-2" size="xl" />
  </form>
</template>

<script setup>
import { ref } from 'vue';
import Input from '../shared/Input.vue';
import Button from '../shared/Button.vue';
import axios from 'axios';

const member = ref({
  id: '',
  name: '',
  image: ''
});

const addMember = async () => {
  console.log('Member data before sending:', member.value);

  try {
    // Check if member with the same ID already exists
    const existingMember = await axios.get(`http://localhost:3000/members/${member.value.id}`);

    if (existingMember.data) {
      console.error('Member with the same ID already exists');
      alert('Member with the same ID already exists');
      return;
    }
  } catch (error) {
    // If the error is not 404, rethrow it
    if (error.response && error.response.status !== 404) {
      console.error('Error checking for existing member:', error);
      return;
    }
  }

  try {
    const response = await axios.post('http://localhost:3000/members', member.value);

    console.log('Response data:', response.data);

    if (response.data) {
      console.log('Member added successfully:', response.data);
      member.value = {
        id: '',
        name: '',
        image: ''
      };
    } else {
      console.error('Empty response data received');
    }
  } catch (error) {
    console.error('Error adding member:', error);
  }
};
</script>

<style scoped></style>
