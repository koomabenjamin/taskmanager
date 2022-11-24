<template>
   <div class="h-screen w-screen bg-lime-50 flex">
    <div class="w-1/4 border-r h-full">
      <Button label="Add new task" icon="PlusIcon" />
      <Fab label="Add new task" icon="PlusIcon" />
      <Tag label="Add new task" icon="PlusIcon" />
      <Card/>
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

const hide = (id) => {
  document.getElementById(id).style.visibility = 'hidden';
}
</script>

<style>

</style>