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
          <Button label="Apps" icon="Squares2X2Icon" color="bg-white" size="lg" drop-down />
          <Button label="Add new task" icon="PlusIcon" color="bg-black" text-color="text-white" size="lg" />
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
import SideBar from '../components/shared/SideBar.vue';
import KanbanWorkFlow from '../components/sections/KanbanWorkFlow.vue';
import RelatedTask from '../components/sections/RelatedTask.vue';
import PriorityChart from '../components/sections/PriorityChart.vue';
import BackLog from '../components/sections/BackLog.vue';
import Button from '../components/shared/Button.vue';

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
  data() {
    return {
      activeTab: 'kanban-workflow',
    };
  },
  methods: {
    changeTab(tab) {
      this.activeTab = tab;
    },
  },
};
</script>

<style scoped>
/* Add any additional styles you need for the component */
</style>
