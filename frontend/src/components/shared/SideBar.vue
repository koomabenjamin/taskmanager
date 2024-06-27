<template>
    <button
        data-drawer-target="default-sidebar"
        data-drawer-toggle="default-sidebar"
        aria-controls="default-sidebar"
        type="button"
        class="fixed top-0 left-0 items-center p-2 mt-2 ms-3 text-sm text-gray-500 rounded-lg lg:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200">
        <span class="sr-only">Open sidebar</span>
        <svg
            class="w-6 h-6"
            aria-hidden="true"
            fill="currentColor"
            viewBox="0 0 20 20"
            xmlns="http://www.w3.org/2000/svg">
            <path
                clip-rule="evenodd"
                fill-rule="evenodd"
                d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"></path>
        </svg>
    </button>

    <aside
        id="default-sidebar"
        class="fixed top-0 left-0 z-40 w-[380px] h-screen transition-transform -translate-x-full lg:translate-x-0"
        aria-label="Sidebar">
        <div class="h-full px-3 py-4 overflow-y-auto">
            <div class="w-full border-r h-full px-7 pt-7 pb-44 flex flex-col space-y-5 overflow-auto">
                <!-- 
      <Fab label="Add new task" icon="PlusIcon" />
      <Tag label="Add new task" icon="PlusIcon" />
      <Card/> -->
                <div class="font-bold text-lg">Task Master</div>

                <!-- <NavItems :items="navItems" /> this is to be deleted -->
                <NavItems />

                <div class="fixed bottom-0 w-full h-auto left-0 p-7 bg-lime-50 border-t border-r">
                    <div class="flex items-center space-x-2 font-bold">
                        <WalletIcon class="h-6 stroke-2" />
                        <span class="text-sm">Free plan</span>
                    </div>
                    <div class="flex items-center justify-between space-x-2 text-xs mt-4">
                        <span class="font-bold">Projects</span>
                        <span class="text-slate-500">{{ projects.length }}/10</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-1.5 mb-4 my-2">
                        <div
                            class="bg-lime-500 h-1.5 rounded-full"
                            style="width: 80%"></div>
                    </div>
                    <div class="flex items-center justify-between space-x-2 text-xs mt-2">
                        <span class="font-bold">Tasks</span>
                        <span class="text-slate-500">Unlimited</span>
                    </div>
                </div>
            </div>
        </div>
    </aside>
</template>

<script setup>
import { ref, reactive } from "vue"
import { storeToRefs } from "pinia"
import { WalletIcon } from "@heroicons/vue/24/outline"
import Button from "./Button.vue"
import Fab from "./Fab.vue"
import Tag from "./Tag.vue"
import Card from "./Card.vue"
import NavItems from "./NavItems.vue"
import { useTaskManagerStore } from "@/stores/app"

let store = useTaskManagerStore()

const { tasks, projects } = storeToRefs(store)

/*
//this commented code is to be deleted
const navItems = [
    { label: "Plan", icon: "CalendarIcon", subList: [] },
    {
        label: "Task List",
        name: "task",
        icon: "ClipboardDocumentListIcon",
        subList: [
            { name: "Meridian", color: "bg-rose-600" },
            { name: "Risen", color: "bg-blue-600" },
            { name: "SkillBox", color: "bg-yellow-400" },
            { name: "Statra Insurance", color: "bg-green-600" }
        ]
    },
    {
        label: "Projects",
        name: "project",
        icon: "FolderIcon",
        subList: [
            { name: "Meridian", color: "bg-rose-600" },
            { name: "Risen", color: "bg-blue-600" },
            { name: "SkillBox", color: "bg-yellow-400" },
            { name: "Statra Insurance", color: "bg-green-600" }
        ]
    },
    {
        label: "Tags",
        name: "tag",
        icon: "TagIcon",
        subList: [
            { name: "Prototype", color: "bg-purple-600" },
            { name: "Research", color: "bg-green-600" },
            { name: "Testing", color: "bg-yellow-400" }
        ]
    },
    {
        label: "Members",
        name: "member",
        icon: "UserGroupIcon",
        subList: [
            { name: "Prototype", color: "bg-purple-600" },
            { name: "Research", color: "bg-green-600" },
            { name: "Testing", color: "bg-yellow-400" }
        ]
    }
]
*/
</script>

<style scoped></style>
