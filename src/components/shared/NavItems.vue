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


  <TransitionRoot appear :show="isOpen" as="template">
    <Dialog as="div" @close="closeModal" class="relative z-10">
      <TransitionChild
        as="template"
        enter="duration-300 ease-out"
        enter-from="opacity-0"
        enter-to="opacity-100"
        leave="duration-200 ease-in"
        leave-from="opacity-100"
        leave-to="opacity-0"
      >
        <div class="fixed inset-0 bg-black/25" />
      </TransitionChild>

      <div class="fixed inset-0 overflow-y-auto">
        <div
          class="flex min-h-full items-center justify-center p-4 text-center"
        >
          <TransitionChild
            as="template"
            enter="duration-300 ease-out"
            enter-from="opacity-0 scale-95"
            enter-to="opacity-100 scale-100"
            leave="duration-200 ease-in"
            leave-from="opacity-100 scale-100"
            leave-to="opacity-0 scale-95"
          >
            <DialogPanel
              class="w-full max-w-md transform overflow-hidden rounded-2xl bg-white p-6 text-left align-middle shadow-xl transition-all"
            >
              <DialogTitle
                as="h3"
                class="text-lg font-medium leading-6 text-gray-900"
              >
                Payment successful
              </DialogTitle>
              <div class="mt-2">
                <p class="text-sm text-gray-500">
                  Your payment has been successfully submitted. We’ve sent you
                  an email with all of the details of your order.
                </p>
              </div>

              <div class="mt-4">
                <button
                  type="button"
                  class="inline-flex justify-center rounded-md border border-transparent bg-blue-100 px-4 py-2 text-sm font-medium text-blue-900 hover:bg-blue-200 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 focus-visible:ring-offset-2"
                  @click="closeModal"
                >
                  Got it, thanks!
                </button>
              </div>
            </DialogPanel>
          </TransitionChild>
        </div>
      </div>
    </Dialog>
  </TransitionRoot>

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

      <form class="grid grid-cols-2 gap-2 -space-y-0" v-if="selectedForm === 'tag'">
        <Input placeholder="Tag Name" required="true" class="col-span-2"/>
        <div>
        <h6 class="mt-3">Pick Tag Color</h6>
        <ColorPicker @color-changed="console.log($event)"></ColorPicker>
        </div>
        <Button label="Add New Tag" icon="PlusIcon" color="bg-lime-500 text-white col-span-2" size="xl" />
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
      <form class="grid grid-cols-2 gap-2 -space-y-0" v-if="selectedForm === 'project'">
        <Input placeholder="Title" class="col-span-2"/>
        <Input placeholder="Start Date" type="date"/>
        <Input placeholder="End Date" type="date"/>
        <Input placeholder="Priority" class="col-span-2"/>
        <TextArea rows="5" placeholder="Description" class="col-span-2" />
        <TextArea rows="5" placeholder="Members" class="col-span-2" />
        <Button label="Add new task" icon="PlusIcon" color="bg-lime-500 text-white col-span-2" size="xl" />
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

const props = defineProps({
    name: [String, Number],
    label: [String, Number],
    icon: [String, Number],
    subList: [Array, Object],
    items: [Array, Object],
})

const subListsOpen = ref([]);

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
