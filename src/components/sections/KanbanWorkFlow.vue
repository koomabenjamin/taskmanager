<template>
  <div class="flex flex-col min-h-screen overflow-hidden">
    <!-- Header Section -->
      <div class="w-full flex space-x-10 px-4 font-bold flex-shrink-0 border-b">
          <div class="w-full h-20 flex items-center justify-between px-4">
            <div class="flex space-x-4 items-center">
              <MagnifyingGlassIcon class="w-5 h-5" />
              <Input placeholder="Search for something" class="border-none" />
            </div>
            <div class="flex items-center space-x-2">
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
              <Button label="Share" icon="ArrowUpOnSquareIcon" textColor="text-black" size="md" />
            </div>
          </div>
      </div>

    <!-- Main Content Section -->
    <div class="flex-grow w-full h-full flex overflow-x-auto space-x-4 px-4 py-2">
      <div class="w-1/3 text-lg overflow-y-auto" v-for="column in columns" :key="column.name">
        <div class="flex justify-between items-center mx-4 my-2">
          <span class="text-lg text-gray-600 font-semibold" style="font-size: 85%;">{{ column.label }}</span>
          <EllipsisVerticalIcon class="w-4 h-4 cursor-pointer" />
        </div>
        <div class="m-2 p-5 bg-white rounded-lg h-auto shadow" draggable="true" @dragstart="changeStatus(card.id)"
          :id="card.id" v-for="card in filteredCards(column.name)" :key="card.id" style="margin-bottom: 16px;">
          <div class="flex items-center justify-between">
            <div class="flex -space-x-4">
              <div class="h-10 w-10 rounded-full border-2 border-slate-500 bg-black" v-for="member in card.members"
                :key="member"></div>
            </div>
            <div class="text-lg text-rose-600 font-semibold w-auto px-2 bg-rose-100 py-1 rounded-full capitalize" style="font-size: 85%;">{{ card.priority }}
            </div>
          </div>
          <div class="font-bold text-sm my-3">{{ card.title }}</div>
          <div class="flex items-center space-x-1 my-1 text-[10px]">
            <div class="w-auto px-2 bg-blue-200 text-blue-600 py-0.5 rounded-full font-bold capitalize">Prototype</div>
            <div class="w-auto px-2 bg-green-200 text-green-600 py-0.5 rounded-full font-bold capitalize">Research</div>
            <div class="w-auto px-2 bg-yellow-200 text-yellow-600 py-0.5 rounded-full font-bold capitalize">Testing</div>
          </div>
          <div  class="text-lg text-slate-600 font-semibold,, flex items-center space-x-2 mt-4 text-[10px]"  style="font-size: 75%;">
            <CalendarIcon class="h-5 stroke-2" />
            <span>{{ card.date }}</span>
          </div>
        </div>
        <div class="flex items-center mx-4 my-2 cursor-pointer">
          <div class="h-6 w-6 rounded-full bg-[#bef264] flex items-center justify-center">
            <PlusIcon class="w-4 h-4 text-black" />
          </div>
          <span class="ml-2 text-lg text-gray-600 font-semibold" style="font-size: 85%;">Add New Task</span>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue';
import { Switch } from '@headlessui/vue';
import {
  ArrowUpOnSquareIcon,
  MagnifyingGlassIcon,
  ChevronUpIcon,
  CalendarIcon,
  PlusIcon,
  EllipsisVerticalIcon
} from '@heroicons/vue/24/outline';
import Button from '../shared/Button.vue';
import Input from '../shared/Input.vue';
import Calendar from '../shared/Calendar.vue';

const enabled = ref(false);

const cards = ref([
  { id: 1, status: 'in-progress', priority: 'high', title: 'A/B Testing - Round 3', date: '5 Sept 2022 - 5 Oct 2022', members: [1, 2] },
  { id: 2, status: 'done', priority: 'high', title: 'Create Prototype for payments flow', date: '24 Aug 2022 - 30 Sept 2022', members: [1] },
  { id: 3, status: 'to-do', priority: 'medium', title: 'Create microinteraction flow', date: '2 Sept 2022 - 16 Sept 2022', members: [1, 2, 3] },
  { id: 4, status: 'in-progress', priority: 'low', title: 'Update icons for checkout', date: '14 Sept 2022 - 16 Sept 2022', members: [1, 4, 5] },
  { id: 5, status: 'done', priority: 'low', title: 'Copywriting for flow payments', date: '7 Sept 2022 - 20 Sept 2022', members: [1, 3, 4, 5] },
  { id: 6, status: 'to-do', priority: 'low', title: 'Update Support Documentations', date: '10 Sept 2022 - 16 Sept 2022', members: [1, 3, 4, 5] },
  { id: 7, status: 'to-do', priority: 'low', title: 'Design system for checkout', date: '15 Sept 2022 - 25 Sept 2022', members: [1, 4, 5] },
  { id: 8, status: 'in-progress', priority: 'high', title: 'Prototype design for mobile', date: '18 Sept 2022 - 30 Sept 2022', members: [1, 2, 3, 4, 5] },
]);

const columns = ref([
  { name: 'to-do', label: 'To Do' },
  { name: 'in-progress', label: 'In Progress' },
  { name: 'done', label: 'Done' }
]);

const changeStatus = (id) => {
  setTimeout(() => {
    document.getElementById(id).style.display = 'none';
  }, 0);
};

const filteredCards = (status) => {
  return cards.value.filter(card => card.status === status);
};
</script>

<style scoped>
  button {
    color: white;
    padding: 8px 16px;
    border-radius: 4px;
    font-size: 14px;
  }
</style>
