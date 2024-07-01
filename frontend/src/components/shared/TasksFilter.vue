<template>
    <div class="w-full h-20 border-b flex items-center justify-between px-4">
        <div class="flex w-full space-x-4 items-center mx-5 my-2 relative">
            <Icons.ArrowPathIcon
                @click="store.tasksFetch()"
                class="w-8 cursor-pointer stroke-2" />
            <Icons.MagnifyingGlassIcon class="w-5 h-5" />
            <!-- <input placeholder="Search for something" class="h-full bg-lime-50 h-12" @keyup="searchCard($event)"> -->
            <input
                v-model="taskFilter.search"
                @keyup="store.tasksFetch"
                class="w-full h-10 border-2 p-2 rounded text-sm"
                placeholder="Search for something" />

            <div class="relative">
                <input
                    v-model="taskFilter.start_date"
                    @change="store.tasksFetch"
                    id="stat-date"
                    name="stat-date"
                    type="date"
                    class="border-2 h-10 rounded block px-2.5 pb-2.5 pt-4 w-full text-sm appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                    placeholder="" />
                <label
                    for="start-date"
                    class="absolute rounded-lg text-sm text-gray-500 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-gray-50 px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto start-1">
                    Start date
                </label>
            </div>

            <div class="relative">
                <input
                    v-model="taskFilter.end_date"
                    @change="store.tasksFetch"
                    id="stat-date"
                    name="stat-date"
                    type="date"
                    class="border-2 h-10 rounded block px-2.5 pb-2.5 pt-4 w-full text-sm appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                    placeholder="" />
                <label
                    for="start-date"
                    class="absolute rounded-lg text-sm text-gray-500 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-gray-50 px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto start-1">
                    End date
                </label>
            </div>

            <div class="flex items-center space-x-2 relative text-sm">
                <span
                    class="flex items-center space-x-2 cursor-pointer"
                    @click=";(taskFilter.expired = !taskFilter.expired), store.tasksFetch()">
                    <span><Icons.ClockIcon class="w-4" /></span>
                    <span>Expired</span>
                </span>
                <Switch
                    v-model="taskFilter.expired"
                    @update:modelValue="store.tasksFetch"
                    :class="taskFilter.expired ? 'bg-lime-400' : 'bg-black'"
                    class="relative inline-flex h-[20px] w-[35px] shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none focus-visible:ring-2 focus-visible:ring-white focus-visible:ring-opacity-75">
                    <span class="sr-only">Use setting</span>
                    <span
                        aria-hidden="true"
                        :class="taskFilter.expired ? 'translate-x-[15px]' : 'translate-x-0'"
                        class="pointer-events-none inline-block h-[16px] w-[16px] transform rounded-full bg-white shadow-lg ring-0 transition duration-200 ease-in-out" />
                </Switch>
            </div>

            <div class="flex items-center space-x-2 relative text-sm">
                <span
                    class="flex items-center space-x-2 cursor-pointer"
                    @click=";(taskFilter.trashed = !taskFilter.trashed), store.tasksFetch()">
                    <span><Icons.TrashIcon class="w-4" /></span>
                    <span>Trashed</span>
                </span>
                <Switch
                    v-model="taskFilter.trashed"
                    @update:modelValue="store.tasksFetch"
                    :class="taskFilter.trashed ? 'bg-lime-400' : 'bg-black'"
                    class="relative inline-flex h-[20px] w-[35px] shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none focus-visible:ring-2 focus-visible:ring-white focus-visible:ring-opacity-75">
                    <span class="sr-only">Use setting</span>
                    <span
                        aria-hidden="true"
                        :class="taskFilter.trashed ? 'translate-x-[15px]' : 'translate-x-0'"
                        class="pointer-events-none inline-block h-[16px] w-[16px] transform rounded-full bg-white shadow-lg ring-0 transition duration-200 ease-in-out" />
                </Switch>
            </div>
        </div>
    </div>
</template>
<script setup>
import { watch } from "vue"
import { Switch } from "@headlessui/vue"
import { storeToRefs } from "pinia"
import * as Icons from "@heroicons/vue/24/outline"

import { useTaskManagerStore } from "@/stores/app"
import * as TaskServices from "../../services/TaskServices"

const store = useTaskManagerStore()
const {
    tasks, //
    taskRecord,
    taskMembers,
    apiResponse,
    taskFilter
} = storeToRefs(store)

TaskServices.Fetch().then((response) => {
    if (response.status == "success") {
        tasks.value = response.data
    }
})

watch(taskFilter, async (newFilter, oldFilter) => {
    // console.log("===============")
    // console.log(taskFilter.trashed)
    store.tasksFetch()
})

// onMounted(() => console.log(statusRefs.value))
</script>

<style scoped></style>
