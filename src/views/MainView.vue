<template>
  <div class="h-screen w-screen bg-lime-50 flex">
    <div class="w-1/4 border-r h-full p-7 flex flex-col space-y-5">
      <!-- 
      <Fab label="Add new task" icon="PlusIcon" />
      <Tag label="Add new task" icon="PlusIcon" />
      <Card/> -->
      <div class="font-bold text-lg">Task Master</div>
      <Button label="Add new task" icon="PlusIcon" color="bg-lime-300" size="xl" />

      <div class="space-y-4">
        <NavItem v-for="item in navItems" :key="item.name" :label="item.label" :icon="item.icon"
          :sub-list="item.subList" />
      </div>

      <div class="fixed bottom-0 w-1/4 h-auto left-0 p-7">
        <div class="flex items-center space-x-2 font-bold">
          <WalletIcon class="h-6 stroke-2"/>
          <span class="text-sm">Free plan</span>
        </div>
        <div class="flex items-center justify-between space-x-2 text-xs mt-4">
          <span class="font-bold">Projects</span>
          <span class="text-slate-500">4/10</span>
        </div>
        <div class="w-full bg-gray-200 rounded-full h-1.5 mb-4 my-2">
          <div class="bg-lime-500 h-1.5 rounded-full" style="width: 80%"></div>
        </div>
        <div class="flex items-center justify-between space-x-2 text-xs mt-2">
          <span class="font-bold">Tasks</span>
          <span class="text-slate-500">Unlimited</span>
        </div>
      </div>
    </div>
    <div class="w-3/4 flex flex-col">
      <div class="w-full h-auto border-b">

        <div class="w-full h-24 flex items-center justify-between px-4">
          <div class="text-2xl font-bold">Statra Insurance</div>
          <div class="flex space-x-2 items-center">
            <div class="flex -space-x-4">
              <div class="h-10 w-10 rounded-full border-2 border-slate-500 bg-black"></div>
              <div class="h-10 w-10 rounded-full border-2 border-slate-500 bg-black"></div>
              <div class="h-10 w-10 rounded-full border-2 border-slate-500 bg-black"></div>
              <div class="h-10 w-10 rounded-full border-2 border-slate-500 bg-black text-white center font-bold">
                +8
              </div>
            </div>
            <Button label="Apps" icon="Squares2X2Icon" color="bg-white" size="lg" drop-down="true" />
            <Button label="Add new task" icon="PlusIcon" color="bg-black" text-color="text-white" size="lg" />
          </div>
        </div>

        <div class="w-full flex space-x-10 px-4 font-bold">
          <div class="pb-4 flex space-x-2 items-center">
            <Square3Stack3DIcon class="w-5 h-5 flex" />
            <span>Backlog</span>
          </div>
          <div class="pb-4 flex space-x-2 items-center">
            <ArrowsPointingInIcon class="w-5 h-5" />
            <span>Priority Chart</span>
          </div>
          <div class="border-b-4 border-lime-300 pb-4 flex space-x-2 items-center">
            <ChartBarIcon class="w-5 h-5" />
            <span>Kanban Workflow</span>
          </div>
        </div>
      </div>

      <div class="w-full h-20 border-b flex items-center justify-between px-4">
        <div class="flex space-x-4 items-center">
          <MagnifyingGlassIcon class="w-5 h-5" />
          <input placeholder="Search for something" class="h-full bg-lime-50">
        </div>
        <div class="flex items-center space-x-2">
          <!-- switch -->
          <div class="flex items-center space-x-2 relative text-sm">
            <Switch v-model="enabled" :class="enabled ? 'bg-lime-400' : 'bg-black'"
              class="relative inline-flex h-[30px] w-[55px] shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none focus-visible:ring-2 focus-visible:ring-white focus-visible:ring-opacity-75">
              <span class="sr-only">Use setting</span>
              <span aria-hidden="true" :class="enabled ? 'translate-x-[25px]' : 'translate-x-0'"
                class="pointer-events-none inline-block h-[26px] w-[26px] transform rounded-full bg-white shadow-lg ring-0 transition duration-200 ease-in-out" />
            </Switch>
            <span>Select Timeframe</span>
            <ChevronUpIcon class="w-4"/>
            <!-- Calendar -->
            <Calendar v-if="enabled"/>
          </div>

          <Button label="Apps" icon="ShareIcon" color="bg-transparent" size="md" drop-down="true" />
        </div>
      </div>

      <div class="w-full h-full flex overflow-auto">
        <div class="w-1/4 border-r flex-shrink-0 text-xs" v-for="column in [1, 2, 3, 4, 5]" :key="column">
          <Card draggable="true" @dragstart="hide(`card-${column}`)" :id="`card-${column}`" />
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue'
import { Switch } from '@headlessui/vue'
import {
  ArrowsPointingInIcon,
  ChartBarIcon,
  Square3Stack3DIcon,
  MagnifyingGlassIcon,
  ChevronDownIcon,
  ChevronUpIcon,
  ChevronLeftIcon,
  ChevronRightIcon,
  WalletIcon,
} from '@heroicons/vue/24/outline'
import Button from '../components/shared/Button.vue'
import Fab from '../components/shared/Fab.vue'
import Tag from '../components/shared/Tag.vue'
import Card from '../components/shared/Card.vue'
import NavItem from '../components/shared/NavItem.vue'
import Calendar from '../components/shared/Calendar.vue'

const hide = (id) => {
  document.getElementById(id).style.visibility = 'hidden';
}

const enabled = ref(false)

const navItems = [
  { label: 'Plan', icon: 'CalendarIcon', subList: [] },
  {
    label: 'Task List', icon: 'ClipboardDocumentListIcon', subList: [
      { name: 'Meridian', color: 'bg-rose-600' },
      { name: 'Risen', color: 'bg-blue-600' },
      { name: 'SkillBox', color: 'bg-yellow-400' },
      { name: 'Statra Insurance', color: 'bg-green-600' },
    ]
  },
  { label: 'Projects', icon: 'FolderIcon', subList: [] },
  { label: 'Tags', icon: 'TagIcon', subList: [] },
];
</script>

<style scoped>

progress[value]::-webkit-progress-value {
  background-image:
	   -webkit-linear-gradient(-45deg, 
	                           transparent 33%, rgba(0, 0, 0, .1) 33%, 
	                           rgba(0,0, 0, .1) 66%, transparent 66%),
	   -webkit-linear-gradient(top, 
	                           rgba(255, 255, 255, .25), 
	                           rgba(0, 0, 0, .25)),
	   -webkit-linear-gradient(left, #09c, #f44);

    border-radius: 2px; 
    background-size: 35px 20px, 100% 100%, 100% 100%;
}

</style>