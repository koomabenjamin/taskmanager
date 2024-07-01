<template>
<Modal>
        <template v-slot:heading>Update Task</template>
        <template v-slot:form>
            <form class="grid grid-cols-2 gap-2 -space-y-0">
                <!-- Project filed -->
                <select
                    v-model="taskRecord.project_id"
                    placeholder="Select project"
                    class="col-span-2 w-full h-12 border p-2 rounded text-xs minimal"
                    :class="'col-span-2 w-full h-12 border p-2 rounded text-xs minimal ' + [taskRecord.project_id == '' ? 'text-gray-400' : '']">
                    <option
                        value=""
                        disabled>
                        Please select Project
                    </option>
                    <option
                        v-for="project in projects"
                        :value="project.id">
                        {{ project.name }}
                    </option>
                </select>

                <!-- Project field error -->
                <div
                    v-if="apiResponse.data && apiResponse.status == 'error' && apiResponse.data.project_id"
                    class="col-span-2 text-xs text-red-500">
                    <div v-for="error in apiResponse.data.project_id">{{ error }}</div>
                </div>

                <!-- Name field -->
                <Input
                    v-model="taskRecord.name"
                    placeholder="Title"
                    class="col-span-2" />

                <!-- Name field error-->
                <div
                    v-if="apiResponse.data && apiResponse.status == 'error' && apiResponse.data.name"
                    class="col-span-2 text-xs text-red-500">
                    <div v-for="error in apiResponse.data.name">{{ error }}</div>
                </div>

                <span class="inline-block align-baseline text-gray-400 font-bold text-xs mb-0 pl-1">Start date</span>
                <span class="inline-block align-baseline text-gray-400 font-bold text-xs mb-0 pl-1">End date</span>
                <Input
                    v-model="taskRecord.start_date"
                    placeholder="Start Date"
                    class="mt-0"
                    type="date" />
                <Input
                    v-model="taskRecord.end_date"
                    placeholder="End Date"
                    type="date" />

                <!-- Name field error-->
                <div
                    v-if="apiResponse.data && apiResponse.status == 'error' && apiResponse.data.start_date"
                    class="col-span-1 text-xs text-red-500">
                    <div v-for="error in apiResponse.data.start_date">{{ error }}</div>
                </div>
                <div
                    v-if="apiResponse.data && apiResponse.status == 'error' && apiResponse.data.end_date"
                    class="col-span-1 text-xs text-red-500">
                    <div v-for="error in apiResponse.data.end_date">{{ error }}</div>
                </div>

                <!-- start: category -->
                <select
                    v-model="taskRecord.category_id"
                    :class="'col-span-2 w-full h-12 border p-2 rounded text-xs minimal ' + [taskRecord.category_id == '' ? 'text-gray-400' : '']">
                    <option
                        value=""
                        disabled>
                        Please select category
                    </option>
                    <option
                        v-for="category in categories"
                        :value="category.id">
                        {{ category.name }}
                    </option>
                </select>

                <div
                    v-if="apiResponse.data && apiResponse.status == 'error' && apiResponse.data.category_id"
                    class="col-span-2 text-xs text-red-500">
                    <div v-for="error in apiResponse.data.category_id">{{ error }}</div>
                </div>
                <!-- end: category field -->

                <!-- start: priorities -->
                <select
                    v-model="taskRecord.priority_id"
                    :class="'col-span-2 w-full h-12 border p-2 rounded text-xs minimal ' + [taskRecord.priority_id == '' ? 'text-gray-400' : '']">
                    <option
                        value=""
                        disabled>
                        Please select priority
                    </option>
                    <option
                        v-for="priority in priorities"
                        :value="priority.id">
                        {{ priority.name }}
                    </option>
                </select>

                <div
                    v-if="apiResponse.data && apiResponse.status == 'error' && apiResponse.data.priority_id"
                    class="col-span-2 text-xs text-red-500">
                    <div v-for="error in apiResponse.data.priority_id">{{ error }}</div>
                </div>
                <!-- end: priorities field -->

                <!-- start: status -->
                <select
                    v-model="taskRecord.status_id"
                    :class="'col-span-2 w-full h-12 border p-2 rounded text-xs minimal ' + [taskRecord.status_id == '' ? 'text-gray-400' : '']">
                    <option
                        value=""
                        disabled>
                        Please select status
                    </option>
                    <option
                        v-for="status in statuses"
                        :value="status.id">
                        {{ status.name }}
                    </option>
                </select>

                <div
                    v-if="apiResponse.data && apiResponse.status == 'error' && apiResponse.data.status_id"
                    class="col-span-2 text-xs text-red-500">
                    <div v-for="error in apiResponse.data.status_id">{{ error }}</div>
                </div>
                <!-- end: status field -->

                <!-- start: taskMembers -->
                <div class="col-span-2 w-full">
                    <div class="font-bold text-sm my-2 ms-2 text-gray-500">Attached to: {{ taskMembers.length }}</div>
                    <ul class="list-decimal list-inside">
                        <li
                            class="text-sm mb-2 bg-gray-100 py-2 px-3 relative"
                            v-for="(member, key) in taskMembers"
                            :key="member.id">
                            {{ member.name }}

                            <button
                                @click.prevent="removeMember(member.id)"
                                type="button"
                                class="h-full px-1 text-sm font-bold border-s-2 border-red-500 text-red-500 absolute top-0 right-0">
                                <Icons.XMarkIcon class="h-5 stroke-2 cursor-pointer" />
                            </button>
                        </li>
                    </ul>
                </div>

                <div class="col-span-2 w-full align-top flex">
                    <select
                        v-model="user"
                        placeholder="Select a color"
                        :class="'grow border h-full p-2 w-auto rounded text-xs border-2 border-gray-500 minimal-small ' + [Object.keys(user).length == 0 ? 'text-gray-400' : '']">
                        <option
                            :value="{}"
                            disabled>
                            Choose member to attach
                        </option>
                        <template
                            v-for="user in users"
                            :key="user.id">
                            <option
                                v-if="!taskRecord.member_user_ids.includes(user.id)"
                                :value="user">
                                {{ user.name }}
                            </option>
                        </template>
                    </select>
                    <button
                        @click.prevent="attachMember()"
                        type="button"
                        class="flex-none px-2 h-full ml-1 rounded text-sm font-bold border-2 border-gray-500"
                        value="Assign">
                        <Icons.PlusIcon class="h-5 stroke-2 cursor-pointer" />
                    </button>
                </div>

                <div
                    v-if="apiResponse.data && apiResponse.status == 'error' && apiResponse.data.member_user_ids"
                    class="col-span-2 text-xs text-red-500">
                    <div v-for="error in apiResponse.data.member_user_ids">{{ error }}</div>
                </div>
                <!-- end: taskMembers field -->

                <!-- Description field -->
                <TextArea
                    v-model="taskRecord.description"
                    rows="5"
                    placeholder="Description"
                    class="col-span-2" />

                <!-- Description field Error -->
                <div
                    v-if="apiResponse.data && apiResponse.status == 'error' && apiResponse.data.description"
                    class="col-span-2 text-xs text-red-500">
                    <div v-for="error in apiResponse.data.description">{{ error }}</div>
                </div>

                <Button
                    @click.prevent="taskUpdate"
                    label="Edit / Update task"
                    icon="PlusIcon"
                    color="bg-lime-500 text-white col-span-2"
                    size="xl" />

                <div
                    v-if="apiResponse.data && apiResponse.status == 'error' && apiResponse.data.id"
                    class="col-span-2 text-xs text-red-500">
                    <div v-for="error in apiResponse.data.id">{{ error }}</div>
                </div>

                <!-- Task creation success message -->
                <div
                    v-if="apiResponse.data && apiResponse.status == 'success'"
                    class="col-span-2 text-s text-green-600 py-5">
                    Task updated successfully
                </div>
            </form>
        </template>
    </Modal>
</template>
<script setup>

import { ref, provide } from "vue"
import { storeToRefs } from "pinia"
import * as Icons from "@heroicons/vue/24/outline"

import { useTaskManagerStore } from "@/stores/app"
import Modal from "../shared/Modal.vue"

import Button from "../shared/Button.vue"
import Input from "../shared/Input.vue"
import TextArea from "../shared/TextArea.vue"
import * as StatusServices from "../../services/StatusServices"
import * as TaskServices from "../../services/TaskServices"

const props =  defineProps({
  open: Boolean,
})

let store = useTaskManagerStore()
const { tasks, projects, categories, priorities, statuses, users, user, taskRecord, taskMembers, apiResponse } = storeToRefs(store)

StatusServices.Fetch().then((response) => {
    if (response.status == "success") {
        statuses.value = response.data
    }
})

TaskServices.Fetch().then((response) => {
    if (response.status == "success") {
        tasks.value = response.data
    }
})


//Edit task
provide("isOpenSideModal", props.open)

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

</script>

<style scoped>

</style>