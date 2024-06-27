<template>
    <TasksFilter />

    <div class="w-full h-full overflow-auto">
        <div class="relative">
            <table class="w-full text-sm text-left text-gray-900">
                <thead class="text-xs text-gray-700 uppercase bg-lime-300">
                    <tr>
                        <th
                            scope="col"
                            class="px-6 py-3">
                            <div class="z-10">
                                <Menu
                                    as="div"
                                    class="relative text-left">
                                    <div>
                                        <MenuButton class="uppercase">
                                            <Icons.ChevronDoubleDownIcon class="w-4 inline cursor-pointer stroke-2" />
                                            Members
                                            <Icons.ChevronDownIcon
                                                class="-mr-1 ml-2 h-5 w-5 text-violet-200 hover:text-violet-100"
                                                aria-hidden="true" />
                                        </MenuButton>
                                    </div>

                                    <transition
                                        enter-active-class="transition duration-100 ease-out"
                                        enter-from-class="transform scale-95 opacity-0"
                                        enter-to-class="transform scale-100 opacity-100"
                                        leave-active-class="transition duration-75 ease-in"
                                        leave-from-class="transform scale-100 opacity-100"
                                        leave-to-class="transform scale-95 opacity-0">
                                        <MenuItems class="absolute font-normal left-0 mt-2 w-56 origin-top-right divide-y divide-gray-100 rounded-md bg-white shadow-lg ring-1 ring-black/5 focus:outline-none">
                                            <div class="px-1 py-1">
                                                <MenuItem v-slot="{ active }">
                                                    <button
                                                        @click=";(taskFilter.member = 0), store.tasksFetch()"
                                                        :class="[active ? 'bg-violet-500 text-white' : 'text-gray-900', 'group flex w-full items-center  px-2 py-2 text-sm']">
                                                        All
                                                    </button>
                                                </MenuItem>
                                            </div>
                                            <div
                                                v-for="user in users"
                                                class="px-1 py-1">
                                                <MenuItem v-slot="{ active }">
                                                    <button
                                                        @click=";(taskFilter.member = user.id), store.tasksFetch()"
                                                        :class="[active ? 'bg-violet-500 text-white' : 'text-gray-900', 'group flex w-full items-center  px-2 py-2 text-sm']">
                                                        {{ user.name }}
                                                    </button>
                                                </MenuItem>
                                            </div>
                                        </MenuItems>
                                    </transition>
                                </Menu>
                            </div>
                        </th>
                        <th
                            scope="col"
                            class="px-6 py-3 align-top">
                            Name
                        </th>
                        <th
                            scope="col"
                            class="px-6 py-3">
                            <Menu
                                as="div"
                                class="relative text-left">
                                <div>
                                    <MenuButton class="uppercase">
                                        <Icons.ChevronDoubleDownIcon class="w-4 inline cursor-pointer stroke-2" />
                                        Priority
                                        <Icons.ChevronDownIcon
                                            class="-mr-1 ml-2 h-5 w-5 text-violet-200 hover:text-violet-100"
                                            aria-hidden="true" />
                                    </MenuButton>
                                </div>

                                <transition
                                    enter-active-class="transition duration-100 ease-out"
                                    enter-from-class="transform scale-95 opacity-0"
                                    enter-to-class="transform scale-100 opacity-100"
                                    leave-active-class="transition duration-75 ease-in"
                                    leave-from-class="transform scale-100 opacity-100"
                                    leave-to-class="transform scale-95 opacity-0">
                                    <MenuItems class="absolute font-normal left-0 mt-2 w-56 origin-top-right divide-y divide-gray-100 rounded-md bg-white shadow-lg ring-1 ring-black/5 focus:outline-none">
                                        <div class="px-1 py-1">
                                            <MenuItem v-slot="{ active }">
                                                <button
                                                    @click=";(taskFilter.priority = 0), store.tasksFetch()"
                                                    :class="[active ? 'bg-violet-500 text-white' : 'text-gray-900', 'group flex w-full items-center  px-2 py-2 text-sm']">
                                                    All
                                                </button>
                                            </MenuItem>
                                        </div>
                                        <div
                                            v-for="priority in priorities"
                                            class="px-1 py-1">
                                            <MenuItem v-slot="{ active }">
                                                <button
                                                    @click=";(taskFilter.priority = priority.id), store.tasksFetch()"
                                                    :class="[active ? 'bg-violet-500 text-white' : 'text-gray-900', 'group flex w-full items-center  px-2 py-2 text-sm']">
                                                    {{ priority.name }}
                                                </button>
                                            </MenuItem>
                                        </div>
                                    </MenuItems>
                                </transition>
                            </Menu>
                        </th>
                        <th
                            scope="col"
                            class="px-6 py-3">
                            <Menu
                                as="div"
                                class="relative text-left">
                                <div>
                                    <MenuButton class="uppercase">
                                        <Icons.ChevronDoubleDownIcon class="w-4 inline cursor-pointer stroke-2" />
                                        Category
                                        <Icons.ChevronDownIcon
                                            class="-mr-1 ml-2 h-5 w-5 text-violet-200 hover:text-violet-100"
                                            aria-hidden="true" />
                                    </MenuButton>
                                </div>

                                <transition
                                    enter-active-class="transition duration-100 ease-out"
                                    enter-from-class="transform scale-95 opacity-0"
                                    enter-to-class="transform scale-100 opacity-100"
                                    leave-active-class="transition duration-75 ease-in"
                                    leave-from-class="transform scale-100 opacity-100"
                                    leave-to-class="transform scale-95 opacity-0">
                                    <MenuItems class="absolute font-normal left-0 mt-2 w-56 origin-top-right divide-y divide-gray-100 rounded-md bg-white shadow-lg ring-1 ring-black/5 focus:outline-none">
                                        <div class="px-1 py-1">
                                            <MenuItem v-slot="{ active }">
                                                <button
                                                    @click=";(taskFilter.category = 0), store.tasksFetch()"
                                                    :class="[active ? 'bg-violet-500 text-white' : 'text-gray-900', 'group flex w-full items-center  px-2 py-2 text-sm']">
                                                    All
                                                </button>
                                            </MenuItem>
                                        </div>
                                        <div
                                            v-for="category in categories"
                                            class="px-1 py-1">
                                            <MenuItem v-slot="{ active }">
                                                <button
                                                    @click=";(taskFilter.category = category.id), store.tasksFetch()"
                                                    :class="[active ? 'bg-violet-500 text-white' : 'text-gray-900', 'group flex w-full items-center  px-2 py-2 text-sm']">
                                                    {{ category.name }}
                                                </button>
                                            </MenuItem>
                                        </div>
                                    </MenuItems>
                                </transition>
                            </Menu>
                        </th>
                        <th
                            scope="col"
                            class="px-6 py-3 align-top">
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr
                        class="border-b-2"
                        v-for="(task, key) in tasks">
                        <th
                            scope="row"
                            class="px-6 py-4 whitespace-nowrap">
                            <div class="flex -space-x-4">
                                <div
                                    class="h-10 w-10 rounded-full border-2 border-slate-500 text-center inline-block align-middle"
                                    :style="`background-image: url('https://picsum.photos/200/300?random=` + member.id + `')`"
                                    v-for="member in task.members"
                                    :key="member.id"></div>
                            </div>
                        </th>
                        <td class="px-2 py-4 font-medium text-gray-900">
                            {{ task.name }}
                        </td>
                        <td class="px-6 py-4">
                            <!-- <div class="w-auto px-2 bg-rose-200 text-rose-600 py-1 rounded-full font-bold capitalize">{{ task.priority.name }}</div> -->
                            {{ task.priority.name }}
                        </td>
                        <td class="px-6 py-4">
                            <!-- <div class="w-auto px-2 bg-rose-200 text-rose-600 py-1 rounded-full font-bold capitalize">{{ task.category.name }}</div> -->
                            {{ task.category.name }}
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center space-x-2 text-slate-500 font-semibold text-[10px]">
                                <Icons.TrashIcon
                                    v-if="task.deleted_at == null"
                                    class="h-5 stroke-2 cursor-pointer"
                                    @click="taskDelete(task)" />

                                <Icons.ArrowPathIcon
                                    v-if="task.deleted_at != null"
                                    class="h-5 stroke-2 cursor-pointer"
                                    @click="store.tasksRestore(task)" />
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <UpdateTask :open="isOpen" />
</template>
<script setup>
import { ref, reactive, onMounted, provide, watch } from "vue"
import { Switch, Menu, MenuButton, MenuItems, MenuItem } from "@headlessui/vue"
import { storeToRefs } from "pinia"
import * as Icons from "@heroicons/vue/24/outline"

import { useTaskManagerStore } from "@/stores/app"
import Modal from "../shared/Modal.vue"
import TasksFilter from "../shared/TasksFilter.vue"
import UpdateTask from "../shared/UpdateTask.vue"
import Button from "../shared/Button.vue"
import Input from "../shared/Input.vue"
import TextArea from "../shared/TextArea.vue"
import Fab from "../shared/Fab.vue"
import Tag from "../shared/Tag.vue"
import Card from "../shared/Card.vue"
import Calendar from "../shared/Calendar.vue"
import * as StatusServices from "../../services/StatusServices"
import * as TaskServices from "../../services/TaskServices"

const store = useTaskManagerStore()
const showMembers = ref(false)
const {
    tasks, //
    tags,
    projects,
    categories,
    priorities,
    statuses,
    users,
    user,
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

//Edit task
const isOpen = ref(false)
function taskEdit(task) {
    store.taskRecord = task
    store.taskMembers = task.members
    isOpen.value = true
    console.log("called")
}

function attachMember() {
    taskMembers.value.push(user.value)
    taskRecord.value.member_user_ids = taskMembers.value.map((m) => m.id)
    user.value = {}
}

function removeMember(id) {
    taskMembers.value = taskMembers.value.filter((m) => m.id !== id)
    taskRecord.value.member_user_ids = taskMembers.value.map((m) => m.id)
    // delete taskMembers.value[key]
}

async function taskUpdate() {
    const response = await TaskServices.Update(taskRecord.value.id, taskRecord.value)
    apiResponse.value = response
}

async function taskDelete(task) {
    const index = tasks.value.indexOf(task)
    if (index > -1) {
        tasks.value.splice(index, 1)
        await store.tasksDelete(task)
    }
}

watch(taskFilter, async (newFilter, oldFilter) => {
    console.log("===============")
    console.log(taskFilter.trashed)
    store.tasksFetch()
})

// onMounted(() => console.log(statusRefs.value))
</script>

<style scoped>
.task-enter-active,
.task-leave-active {
    transition: all 0.5s ease;
}
.task-enter-from,
.task-leave-to {
    opacity: 0;
    transform: translateY(-30px);
}
</style>
