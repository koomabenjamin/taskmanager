<template>
  <!-- Main content container -->
  <div class="w-full h-full flex overflow-auto">
    <!-- Column container, loop through each column -->
    <div class="w-1/3 border-r flex-shrink-0 text-xs overflow-auto">
      <h2 class="font-bold text-lg p-2"></h2>
      <!-- Filter controls -->
      <div class="flex space-x-4 items-center p-2">
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
      <!-- Card container, loop through each card in the filtered list -->
      <div class="m-2 p-5 bg-white rounded-lg h-auto border shadow" v-for="card in filteredCards" :key="card.id">
        <div class="flex items-center justify-between">
          <div class="flex -space-x-4">
            <img class="h-10 w-10 rounded-full border-2 border-slate-500 bg-black" :src="getMemberImage(card.members[0])" v-for="memberId in card.members" :key="memberId" />
          </div>
          <div class="w-auto px-2 bg-rose-200 text-rose-600 py-1 rounded-full font-bold capitalize">{{ card.priority }}</div>
        </div>
        <div class="font-bold text-sm my-3">{{ card.title }}</div>
        <div class="flex items-center space-x-1 my-1 text-[10px]">
          <div class="w-auto px-2" :class="getTagColorClass(card.tag)">{{ card.tag }}</div>
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
import { ref, computed } from 'vue'
import { CalendarIcon } from '@heroicons/vue/24/outline'
import axios from 'axios'

const searchQuery = ref("")
const selectedCategory = ref("")
const selectedMember = ref("")
const selectedDate = ref("")

const cards = ref([])
const members = ref([])

const filteredCards = computed(() => {
  return cards.value.filter(card => {
    return (
      (searchQuery.value === '' || card.title.toLowerCase().includes(searchQuery.value.toLowerCase())) &&
      (selectedCategory.value === '' || card.priority === selectedCategory.value) &&
      (selectedMember.value === '' || card.members.includes(parseInt(selectedMember.value))) &&
      (selectedDate.value === '' || card.date === selectedDate.value)
    )
  })
})

const fetchData = async () => {
  try {
    const response = await axios.get('/db.json') // Adjust the path as per your setup
    const data = response.data
    if (data && data.tasks) {
      cards.value = data.tasks
    }
    if (data && data.members) {
      members.value = data.members
    }
  } catch (error) {
    console.error('Error fetching data:', error)
  }
}

fetchData()

const getMemberImage = (memberId) => {
  const member = members.value.find(m => m.id === memberId)
  return member ? member.imageUrl : ''
}

const getTagColorClass = (tag) => {
  switch (tag) {
    case 'Prototype':
      return 'bg-blue-200 text-blue-600 py-0.5 rounded-full font-bold capitalize'
    case 'Research':
      return 'bg-green-200 text-green-600 py-0.5 rounded-full font-bold capitalize'
    case 'Testing':
      return 'bg-yellow-200 text-yellow-600 py-0.5 rounded-full font-bold capitalize'
    default:
      return 'bg-gray-200 text-gray-600 py-0.5 rounded-full font-bold capitalize'
  }
}
</script>

<style scoped>
/* Add your scoped styles here */
</style>
