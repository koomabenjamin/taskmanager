<template>
<div v-for="item in props.items" :key="item" @click="openCloseSublists(item.label)" class="w-full h-auto flex-col flex -my-2">
    <div class="flex h-12 items-center hover:bg-yellow-100 justify-between p-1 hover:border hover:shadow-md rounded">
        <div class="flex items-center space-x-2 text-sm">
            <component class="h-6 w-6 stroke-2" :is="Icons[item.icon]"></component>
            <span class="font-semibold">{{ item.label }}</span>
        </div>
        <div>
            <component class="h-5 w-5 stroke-2" :is="Icons['ChevronDownIcon']" v-if="item.subList.length > 0 && !subListsOpen.includes(item.label)">
            </component>
            <component class="h-5 w-5 stroke-2" :is="Icons['ChevronUpIcon']" v-if="item.subList.length > 0 && subListsOpen.includes(item.label)">
            </component>
        </div>
    </div>
    <div v-if="item.subList.length > 0 && subListsOpen.includes(item.label)" class="pl-10 space-y-4">
        <div v-for="item in item.subList" :key="item">
            <div :class="{'bg-yellow-300': item.name === 'Statra Insurance'}" class="flex items-center space-x-2 cursor-pointer p-1 rounded">
                <!-- <span :class="`h-3 w-3 ${item.color} rounded-full`"></span> -->
                <span :style="{ backgroundColor: item.color }" :class="`h-3 w-3 rounded-full`"></span>
                <span class="text-sm">{{ item.name }}</span>
            </div>
        </div>
        <div class="flex items-center space-x-2 cursor-pointer text-sm" @click="showForm(item.name)">
            <component class="h-5 w-5 stroke-2" :is="Icons['PlusCircleIcon']" v-if="item.subList.length > 0 && subListsOpen.includes(item.label)">
            </component>
            <span>Add {{ upper(item.name) }}</span>
        </div>
    </div>
</div>


<Modal>
    <template v-slot:heading>Add {{ upper(selectedForm) }}</template>
    <template v-slot:form>
        <form class="grid grid-cols-2 gap-2 -space-y-0" v-if="selectedForm === 'task'">
            <Input placeholder="Title" class="col-span-2" />
            <Input placeholder="Start Date" type="date" />
            <Input placeholder="End Date" type="date" />
            <Input placeholder="Priority" class="col-span-2" />
            <TextArea rows="5" placeholder="Description" class="col-span-2" />
            <TextArea rows="5" placeholder="Members" class="col-span-2" />
        <Button label="Add new task" icon="PlusIcon" color="bg-lime-500 text-white col-span-2" size="xl" />
      </form>


      <form  @submit.prevent="submitTagForm" class="grid grid-cols-2 gap-2 -space-y-0" v-if="selectedForm === 'tag'">
        <Input placeholder="Tag Name" v-model="dataName" required class="col-span-2"/>
        <div>
        <h6 class="mt-3">Pick Tag Color</h6>
        <ColorPicker @color-changed="getUpdatedColor($event)"></ColorPicker>
        </div>
        <Button label="Add New Tag" type="submit" icon="PlusIcon" color="bg-lime-500 text-white col-span-2" size="xl" />
      </form>

      <form class="grid grid-cols-2 gap-2 -space-y-0" v-if="selectedForm === 'member'">
        <Input placeholder="Title" class="col-span-2"/>
        <Input placeholder="Start Date" type="date"/>
        <Input placeholder="End Date" type="date"/>
        <Input placeholder="Priority" class="col-span-2"/>
        <TextArea rows="5" placeholder="Description" class="col-span-2" />
        <TextArea rows="5" placeholder="Members" class="col-span-2" />
        <Button label="Add new task" icon="PlusIcon" color="bg-lime-500 text-white col-span-2" size="xl" />
      </form>
      <form class="grid grid-cols-2 gap-2 -space-y-0" v-if="selectedForm === 'status'">
        <Input placeholder="Title" class="col-span-2"/>
        <Input placeholder="Start Date" type="date"/>
        <Input placeholder="End Date" type="date"/>
        <Input placeholder="Priority" class="col-span-2"/>
        <TextArea rows="5" placeholder="Description" class="col-span-2" />
        <TextArea rows="5" placeholder="Members" class="col-span-2" />
        <Button label="Add new task" icon="PlusIcon" color="bg-lime-500 text-white col-span-2" size="xl" />
      </form>

         
      <form @submit.prevent="submitProjectForm" class="grid grid-cols-2 gap-2 -space-y-0" v-if="selectedForm === 'project'">

         <Input placeholder="Project Name" v-model="dataName" required class="col-span-2"/>
        <div>
        <h6 class="mt-3">Pick Project Color</h6>
        <ColorPicker @color-changed="getUpdatedColor($event)"></ColorPicker>
        </div>
        <Button  type="submit" label="Add new task" icon="PlusIcon" color="bg-lime-500 text-white col-span-2" size="xl" />
      </form>
      <form class="grid grid-cols-2 gap-2 -space-y-0" v-if="selectedForm === 'category'">
        <Input placeholder="Title" class="col-span-2"/>
        <Input placeholder="Start Date" type="date"/>
        <Input placeholder="End Date" type="date"/>
        <Input placeholder="Priority" class="col-span-2"/>
        <TextArea rows="5" placeholder="Description" class="col-span-2" />
        <TextArea rows="5" placeholder="Members" class="col-span-2" />
        <Button label="Add new task" icon="PlusIcon" color="bg-lime-500 text-white col-span-2" size="xl" />
      </form>
    </template>
  </Modal>
</template>

<script setup>
import {
    ref,
    provide
} from 'vue'
import * as Icons from '@heroicons/vue/24/outline'
import Modal from './ModalUpdate.vue'
import Input from './Input.vue'
import Button from './Button.vue'
import TextArea from './TextArea.vue'
import ColorPicker from './ColorPicker.vue'
import { useRouter } from 'vue-router'
import { fetchAllProjectsData,submitProjectData, allProjects } from '@/services/projectService';
import { fetchAllTagsData,submitTagData, allTags } from '@/services/tagService';

import { useNavItemsStore } from '@/stores/navItems';

import { API_URLS } from '@/apis';
import axiosInstance from '@/axios';
const router = useRouter()

const navItemsStore = useNavItemsStore();
const navItems = navItemsStore.navItems;

const updateProjectsInNavItems = () => {
  navItemsStore.updateProjectsInNavItems(allProjects.value);
};

const updateTagsInNavItems = () => {
  navItemsStore.updateTagsInNavItems(allTags.value);
};



const props = defineProps({
    name: [String, Number],
    label: [String, Number],
    icon: [String, Number],
    subList: [Array, Object],
    items: [Array, Object],
})

const subListsOpen = ref([]);
const dataName = ref('')
const colorName = ref('')


const isOpen = ref(false);

const selectedForm = ref('tag');

provide('isOpenSideModal', isOpen)

const openCloseSublists = (subList) => {
    if (!subListsOpen.value.includes(subList)) subListsOpen.value.push(subList);
    else {
        let indexOfList = subListsOpen.value.indexOf(subList);
        if (indexOfList !== -1) subListsOpen.value.splice(indexOfList, 1);
    }
}


const getUpdatedColor = (e) => {
  colorName.value = e;
}


const submitProjectForm = async () => {
  try {
    const response = await submitProjectData(dataName.value, colorName.value);
    // console.log("RESPONSE: ", response);
    await fetchAllProjectsData();
    updateProjectsInNavItems()

    dataName.value = '';
    colorName.value = '';
    isOpen.value = false;

    
  } catch (error) {
    let errorMessage = 'Error Occured. Please try again.';
    if (error.response && error.response.data && error.response.data.message) {
      errorMessage = error.response.data.message;
    }
    alert(errorMessage);
  }
};



const submitTagForm = async () => {
  try {
   const response =  await submitTagData(dataName.value, colorName.value);
    await fetchAllTagsData();
    updateTagsInNavItems()

    console.log("RESPONSE: ", response);
     dataName.value = '';
     colorName.value = '';
     isOpen.value = false;
     
  }catch (error) {
    let errorMessage = 'Error Occured. Please try again.';
    if (error.response && error.response.data && error.response.data.message) {
      errorMessage = error.response.data.message;
    }
    alert(errorMessage);
  }
};


const goToDashbaord = () => {
    router.push('/')
}

const upper = (str) => {
    str = str.toLowerCase().split(' ');

    let final = [];

    for (let word of str) {
        final.push(word.charAt(0).toUpperCase() + word.slice(1));
    }

    return final.join(' ')
}

const showForm = (form) => {
    isOpen.value = true;
    selectedForm.value = form;
    console.log(form, isOpen.value);
}
</script>

<style>

</style>
