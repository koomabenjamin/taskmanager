<template>
  <div class="h-screen w-screen bg-lime-50 flex">
    <SideBar />
    <div class="flex flex-col flex-1 overflow-hidden">
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
          <Button class="font-bold" label="Apps" icon="Squares2X2Icon" color="bg-white" size="lg" drop-down />
          <Button label="Add new task" icon="PlusIcon" color="bg-black" text-color="text-white" size="lg" />
          <Button label="Account" icon="UserIcon" color="bg-white" size="lg" drop-down>
            <template #dropdown>
              <li @click="goToProfile">My Profile</li>
              <li @click="logout">Logout</li>
            </template>
          </Button>

          <div class="relative inline-block text-left">
            <div>
              <button @click="toggleDropdown" type="button" class="inline-flex justify-center w-full rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                <slot name="icon"></slot>
                <span>{{ label }}</span>
              </button>
            </div>
            <div v-if="isOpen" class="origin-top-right absolute right-0 mt-2 w-56 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none">
              <slot name="dropdown"></slot>
            </div>
          </div>

        </div>
      </div>
      <div class="w-full flex space-x-10 px-4 font-bold flex-shrink-0 border-b">
        <div
          @click="changeTab('backlog')"
          :class="{'border-b-4 border-lime-300 duration-300': activeTab === 'backlog' }"
          class="pb-4 flex space-x-2 items-center cursor-pointer"
        >
          <Square3Stack3DIcon class="w-5 h-5 flex" />
          <span>Backlog</span>
        </div>
        <div
          @click="changeTab('priority-chart')" 
          :class="{'border-b-4 border-lime-300 duration-300': activeTab === 'priority-chart' }"
          class="pb-4 flex space-x-2 items-center cursor-pointer"
        >
          <ArrowsPointingInIcon class="w-5 h-5" />
          <span>Priority Chart</span>
        </div>
        <div
          @click="changeTab('related-task')" 
          :class="{'border-b-4 border-lime-300 duration-300': activeTab === 'related-task' }"
          class="pb-4 flex space-x-2 items-center cursor-pointer"
        >
          <BriefcaseIcon class="w-5 h-5" />
          <span>Related Tasks</span>
        </div>
        <div
          @click="changeTab('kanban-workflow')" 
          :class="{'border-b-4 border-lime-300 duration-300': activeTab === 'kanban-workflow' }"
          class="pb-4 flex space-x-2 items-center cursor-pointer"
        >
          <ChartBarIcon class="w-5 h-5" />
          <span>Kanban Workflow</span>
        </div>
      </div>
      <div class="flex-1 overflow-auto px-4">
        <KanbanWorkFlow v-if="activeTab === 'kanban-workflow'" />
        <RelatedTask v-if="activeTab === 'related-task'" />
        <PriorityChart v-if="activeTab === 'priority-chart'" />
        <BackLog v-if="activeTab === 'backlog'" />
      </div>
    </div>
  </div>
</template>

<script>
import {
  ArrowsPointingInIcon,
  BriefcaseIcon,
  ChartBarIcon,
  Square3Stack3DIcon,
} from '@heroicons/vue/24/outline';
import { ref } from 'vue';
import { useRouter } from 'vue-router';
import SideBar from '../components/shared/SideBar.vue';
import KanbanWorkFlow from '../components/sections/KanbanWorkFlow.vue';
import RelatedTask from '../components/sections/RelatedTask.vue';
import PriorityChart from '../components/sections/PriorityChart.vue';
import BackLog from '../components/sections/BackLog.vue';
import Button from '../components/shared/Button.vue';
import axios from 'axios';

export default {
  name: 'MainView',
  components: {
    SideBar,
    KanbanWorkFlow,
    RelatedTask,
    PriorityChart,
    BackLog,
    Button,
    ArrowsPointingInIcon,
    BriefcaseIcon,
    ChartBarIcon,
    Square3Stack3DIcon,
  },
  setup() {
    const router = useRouter();
    const activeTab = ref('kanban-workflow');

    const changeTab = (tab) => {
      activeTab.value = tab;
    };

    const goToProfile = () => {
      router.push({ name: 'profile' });
    };

    const logout = async () => {
      try {
        await axios.post(`${import.meta.env.VITE_API_URL}/api/v1/logout`, {}, {
          withCredentials: true // Ensure cookies are sent with the request
        });
        localStorage.removeItem('authToken');
        router.push('/login'); // redirect to /login
      } catch (error) {
        console.error('Error logging out:', error);
      }
    };


    return {
      activeTab,
      changeTab,
      goToProfile,
      logout,
    };
  },
};
</script>

<style scoped>
/* Add any additional styles you need for the component */
</style>
