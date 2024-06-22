<template>
    <div class="w-1/4 border-r h-full px-7 pt-7 pb-44 flex flex-col space-y-5 overflow-auto">
        <!-- 
      <Fab label="Add new task" icon="PlusIcon" />
      <Tag label="Add new task" icon="PlusIcon" />
      <Card/> -->
        <div class="font-bold text-lg">Task Master</div>
        <Button label="Add new task" icon="PlusIcon" color="bg-lime-300" size="xl" />

        <div class="space-y-4">
            <NavList :items="navItems" />
        </div>

        <div class="fixed bottom-0 w-1/4 h-auto left-0 p-7 bg-lime-50 border-t border-r">
            <div class="flex items-center space-x-2 font-bold">
                <WalletIcon class="h-6 stroke-2" />
                <span class="text-sm">Free plan</span>
                 <!-- {{allProjects}} -->
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

                       <!-- <ul>
      <li v-for="project in allProjects" :key="project.id">
        <h2>{{ project.project_name }}</h2>
        <p>Color: <span :style="{color: project.project_color}">{{ project.project_color }}</span></p>
        <p>Created at: {{ project.created_at }}</p>
        <p>Updated at: {{ project.updated_at }}</p>
      </li>
    </ul> -->
    </div>
</template>

<script setup>
import { ref, reactive,onMounted } from 'vue'
import {
    WalletIcon,
} from '@heroicons/vue/24/outline'
import Button from './Button.vue'
import Fab from './Fab.vue'
import Tag from './Tag.vue'
import Card from './Card.vue'
import NavList from './NavItems.vue'
import { useGenericApi } from '@/stores/useGenericApi'; 
import { API_URLS } from '@/apis';
import axiosInstance from '@/axios';

const allProjects = ref(); 
const allTags = ref();
// const allProjects = reactive({ value: [] })

const navItems = [
    { label: 'Plan', icon: 'CalendarIcon', subList: [] },
    {
        label: 'Task List', name: 'task', icon: 'ClipboardDocumentListIcon', subList: [
            { name: 'Meridian', color: '#f9a8d4' },
            { name: 'Risen', color: '#60FB24' },
            { name: 'SkillBox', color: '#d1d5db' },
            { name: 'Statra Insurance', color: '#f5f3ff' },
        ]
    },
    {
        label: 'Projects', name: 'project', icon: 'FolderIcon', subList: [
            { name: 'Meridian', color: 'bg-rose-600' },
            { name: 'Risen', color: 'bg-blue-600' },
            { name: 'SkillBox', color: 'bg-yellow-400' },
            { name: 'Statra Insurance', color: '#f9a8d4' },
        ]
    },
    {
        label: 'Tags', name: 'tag', icon: 'TagIcon', subList: [
            { name: 'Prototype', color: '#86198f' },
            { name: 'Research', color: '#5b21b6' },
            { name: 'Testing', color: '#e9d5ff' },
        ]
    },
    {
        label: 'Members', name: 'member', icon: 'UserGroupIcon', subList: [
            { name: 'Prototype', color: '#e9d5ff' },
            { name: 'Research', color: '#86198f' },
            { name: 'Testing', color: '#5b21b6' },
        ]
    },
];


const fetchAllProjectsData = async () => {
  try {
    const response = await axiosInstance.get(API_URLS.LIST_ALL_PROJECTS);
    const res =  response.data.results[0]; 
     allProjects.value = res;
     updateProjectsInNavItems();
    // console.log('Data:', allProjects.value);
  } catch (error) {
    console.error('Error fetching data:', error);
  }
};


const fetchAllTagsData = async () => {
  try {
    const response = await axiosInstance.get(API_URLS.LIST_ALL_TAGS);
    const res =  response.data.results[0]; 
     allTags.value = res;
     updateTagsInNavItems();
    // console.log('Data:', allProjects.value);
  } catch (error) {
    console.error('Error fetching data:', error);
  }
};

const updateProjectsInNavItems = () => {
  const projectsNavItem = navItems.find(item => item.label === 'Projects');
  if (projectsNavItem) {
    projectsNavItem.subList = allProjects.value.map(project => ({
      name: project.project_name,
      color: project.project_color
    }));
  }
};


const updateTagsInNavItems = () => {
  const tagsNavItem = navItems.find(item => item.label === 'Tags');
  if (tagsNavItem) {
    tagsNavItem.subList = allTags.value.map(tag => ({
      name: tag.tag_name,
      color: tag.tag_color
    }));
  }
};

onMounted(() => {
  fetchAllProjectsData();
  fetchAllTagsData();
});
</script>

<style scoped></style>