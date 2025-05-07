<template>
  <!-- Top bar container -->
  <div class="w-full h-20 border-b flex items-center justify-between px-4">
    <!-- Search bar and icon container -->
    <div class="flex space-x-4 items-center">
      <MagnifyingGlassIcon class="w-5 h-5" />
      <Input placeholder="Search for something" v-model="searchQuery" @input="filterCards" />
    </div>
    <!-- Filter controls -->
    <div class="flex space-x-4 items-center">
      <div>
        <label for="category">Category:</label>
        <select id="category" v-model="selectedCategory" @change="filterCards">
          <option value="">All</option>
          <option value="high">High</option>
          <option value="medium">Medium</option>
          <option value="low">Low</option>
        </select>
      </div>
      <div>
        <label for="member">Member:</label>
        <select id="member" v-model="selectedMember" @change="filterCards">
          <option value="">All</option>
          <option v-for="member in members" :key="member.id" :value="member.id">{{ member.name }}</option>
        </select>
      </div>
      <div>
        <label for="date">Date:</label>
        <input type="date" id="date" v-model="selectedDate" @change="filterCards">
      </div>
    </div>
    <!-- Switch and button container -->
    <div class="flex items-center space-x-2">
      <!-- Switch with label and optional Calendar -->
      <div class="flex items-center space-x-2 relative text-sm">
        <Switch v-model="enabled" :class="enabled ? 'bg-lime-400' : 'bg-black'"
          class="relative inline-flex h-[30px] w-[55px] shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none focus-visible:ring-2 focus-visible:ring-white focus-visible:ring-opacity-75">
          <span class="sr-only">Use setting</span>
          <span aria-hidden="true" :class="enabled ? 'translate-x-[25px]' : 'translate-x-0'"
            class="pointer-events-none inline-block h-[26px] w-[26px] transform rounded-full bg-white shadow-lg ring-0 transition duration-200 ease-in-out" />
        </Switch>
        <span>Select Timeframe</span>
        <ChevronUpIcon class="w-4" />
        <Calendar v-if="enabled" />
      </div>
      <!-- Share button -->
      <Button label="Share" icon="ShareIcon" color="bg-transparent" size="md" drop-down />
    </div>
  </div>

  <!-- Main content container -->
  <div class="w-full h-full flex overflow-auto">
    <!-- Column container, loop through each column -->
    <div class="w-1/3 border-r flex-shrink-0 text-xs overflow-auto" v-for="column in columns" :key="column" @drop.prevent="onDrop($event, column)" @dragover.prevent>
      <h2 class="font-bold text-lg p-2">{{ column }}</h2>
      <!-- Card container, loop through each card in the column -->
      <div class="m-2 p-5 bg-white rounded-lg h-auto border shadow" draggable="true" @dragstart="onDragStart($event, card.id)"
        :id="card.id" v-for="card in filteredCards.filter((el) => el.status === column)" :key="card.id">
        <div class="flex items-center justify-between">
          <div class="flex -space-x-4">
            <img class="h-10 w-10 rounded-full border-2 border-slate-500 bg-black" :src="getMemberImage(member)" v-for="member in card.members"
              :key="member.id" :alt="member.name" />
          </div>
          <div class="w-auto px-2 bg-rose-200 text-rose-600 py-1 rounded-full font-bold captalise">{{ card.priority }}
          </div>
        </div>
        <div class="font-bold text-sm my-3">{{ card.name }}</div>
        <div class="flex items-center space-x-1 my-1 text-[10px]">
          <div class="w-auto px-2 py-0.5 rounded-full font-bold captalise" :style="{ backgroundColor: getTagColor(card.tag), color: getTagTextColor(card.tag) }"> {{ card.tag }}
</div>

          <!-- <div class="w-auto px-2 bg-green-200 text-green-600 py-0.5 rounded-full font-bold captalise">Research</div>
          <div class="w-auto px-2 bg-yellow-200 text-yellow-600 py-0.5 rounded-full font-bold captalise">Testing</div> -->
        </div>
        <div class="flex items-center space-x-2 text-slate-500 font-semibold mt-4 text-[10px]">
          <CalendarIcon class="h-5 stroke-2" />
          <span>{{ card.date }}</span>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue'
import { useFilterCards } from '../../composables/useFilterCards'
import { useDragAndDrop } from '../../composables/useDragAndDrop'
import { Switch } from '@headlessui/vue'
import { MagnifyingGlassIcon, ChevronUpIcon, CalendarIcon } from '@heroicons/vue/24/outline'
import Button from '../shared/Button.vue'
import Input from '../shared/Input.vue'
import Calendar from '../shared/Calendar.vue'

import axios from 'axios';
import { onMounted } from 'vue';


const cards = ref([]);
const members = ref([]);
const projects = ref([]);
const tags = ref([]);

const {
  searchQuery,
  selectedCategory,
  selectedMember,
  selectedDate,
  filteredCards,
  filterCards,
} = useFilterCards(cards);

const { onDragStart, onDrop } = useDragAndDrop(cards);
console.log(selectedMember)
const columns = ref(['to-do', 'in-progress', 'done']);

const getMemberImage = (member) => {
  const foundMember = members.value.find(m => m.id === member.id);
  return foundMember ? foundMember.imageUrl : '';
};

onMounted(async () => {
  try {
    const response = await axios.get('/db.json'); // Replace with your actual path
    const data = response.data;
    console.log(data.members)
    if (data && data.tasks) {
      cards.value = data.tasks;
    }
    if (data && data.members) {
      members.value = data.members;
      
    }
    if (data && data.projects) {
      projects.value = data.projects;
    }
    if (data && data.tags) {
      tags.value = data.tags;
    }
  } catch (error) {
    console.error('Error fetching data:', error);
  }
});

const getTagColor = (tag) => {
  switch (tag) {
    case 'Feasibility checking':
      return 'blue';
    case 'Development':
      return 'yellow';
    case 'Testing':
      return 'green';
      case 'Documentation':
      return 'purple';
      
    default:
      return 'gray';
  }
}

const getTagTextColor = (tag) => {
  switch (tag) {
    case 'Feasibility checking':
      return 'text-blue-600';
    case 'Development':
      return 'text-yellow-600';
    case 'Testing':
      return 'text-green-600';
      case 'Documentation':
      return 'text-purple-600';
    default:
      return 'text-gray-600';
  }
}
</script>

<style scoped>
/* Add any scoped styles here */
</style>
