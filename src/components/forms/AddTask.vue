<template v-slot:form>
  <form class="grid grid-cols-2 gap-2 -space-y-0" @submit.prevent="addTask">
    <Input v-model="task.id" placeholder="ID" class="col-span-2" />
    <Input v-model="task.name" placeholder="Name" class="col-span-2" />
    
    <label class="col-span-2">Status</label>
    <select v-model="task.status" class="col-span-2">
      <option value="done">Done</option>
      <option value="to-do">To-Do</option>
      <option value="in-progress">In-Progress</option>
    </select>
    
    <label class="col-span-2">Priority</label>
    <select v-model="task.priority" class="col-span-2">
      <option value="high">High</option>
      <option value="medium">Medium</option>
      <option value="low">Low</option>
    </select>
    
    <Input v-model="task.date" type="date" placeholder="Date" class="col-span-2" />
    
    <label class="col-span-2">Members</label>
    <div v-for="(member, index) in availableMembers" :key="index" class="col-span-2">
      <input type="checkbox" :id="member.id" :value="member.id" v-model="task.members">
      <label :for="member.id">{{ member.name }}</label>
    </div>
    
    <label class="col-span-2">Tags</label>
    <select v-model="task.tag" class="col-span-2">
      <option v-for="tag in availableTags" :key="tag.id" :value="tag.name">{{ tag.name }}</option>
    </select>
    
    <Button type="submit" label="Add Task" icon="PlusIcon" color="bg-lime-500 text-white col-span-2" size="xl" />
  </form>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import Input from '../shared/Input.vue';
import Button from '../shared/Button.vue';
import axios from 'axios';

const task = ref({
  id: '',
  name: '',
  status: '',
  priority: '',
  date: '',
  members: [],
  tag: ''
});

const availableMembers = ref([]);
const availableTags = ref([]);

const fetchMembers = async () => {
  try {
    const response = await axios.get('http://localhost:3000/members');
    availableMembers.value = response.data;
  } catch (error) {
    console.error('Error fetching members:', error);
  }
};

const fetchTags = async () => {
  try {
    const response = await axios.get('http://localhost:3000/tags');
    availableTags.value = response.data;
  } catch (error) {
    console.error('Error fetching tags:', error);
  }
};

onMounted(() => {
  fetchMembers();
  fetchTags();
});

const addTask = async () => {
  // Validate form inputs here if needed
  console.log('Task data before sending:', task.value);

  // Prepare the members array with full member details
  const selectedMembers = availableMembers.value.filter(member =>
    task.value.members.includes(member.id)
  );

  const newTask = {
    ...task.value,
    members: selectedMembers
  };

  try {
    const response = await axios.post('http://localhost:3000/tasks', newTask);
    console.log('Response data:', response.data);

    if (response.data) {
      console.log('Task added successfully:', response.data);
      task.value = {
        id: '',
        name: '',
        status: '',
        priority: '',
        date: '',
        members: [],
        tag: ''
      };
    } else {
      console.error('Empty response data received');
    }
  } catch (error) {
    console.error('Error adding task:', error);
  }
};
</script>

<!-- Add any scoped styles here if needed -->
<style scoped></style>
