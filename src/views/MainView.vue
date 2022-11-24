<template>
   <div class="h-screen w-screen bg-lime-50 flex">
    <div class="w-1/4 border-r h-full p-10 flex flex-col space-y-5">
      <!-- 
      <Fab label="Add new task" icon="PlusIcon" />
      <Tag label="Add new task" icon="PlusIcon" />
      <Card/> -->
      <div class="font-bold text-lg">Task Master</div>
      <Button label="Add new task" icon="PlusIcon"/>
      
      <NavItem v-for="item in navItems" :key="item.name" :label="item.label" :icon="item.icon" :sub-list="item.subList"/>
      
      <div class="fixed bottom-0 w-1/4 bg-lime-300 h-28 left-0"></div>
    </div>
    <div class="w-3/4 flex flex-col">
      <div class="w-full h-24 border-b">Header</div>
      <div class="w-full h-20 border-b">Sub-Header</div>
      <div class="w-full h-full flex overflow-auto">
        <div class="w-1/4 border-r flex-shrink-0 text-xs" v-for="column in [1,2,3,4,5]" :key="column">
            <Card draggable="true" @dragstart="hide(`card-${column}`)" :id="`card-${column}`"/>
        </div>
      </div>
    </div>
   </div>
</template>

<script setup>
import Button from '../components/shared/Button.vue'
import Fab from '../components/shared/Fab.vue'
import Tag from '../components/shared/Tag.vue'
import Card from '../components/shared/Card.vue'
import NavItem from '../components/shared/NavItem.vue'

const hide = (id) => {
  document.getElementById(id).style.visibility = 'hidden';
}

const navItems = [
  { label:'Plan', icon:'CalendarIcon', subList:[] },
  {
    label: 'Task List', icon: 'ClipboardDocumentListIcon', subList: [
      { name: 'Meridian', color:'bg-rose-600'},
      { name: 'Risen', color:'bg-blue-600'},
      { name: 'SkillBox', color:'bg-yellow-400'},
      { name: 'Statra Insurance', color:'bg-green-600'},
    ]},
  { label:'Projects', icon:'FolderIcon', subList:[]},
  { label:'Tags', icon:'TagIcon', subList:[]},
];
</script>

<style>

</style>