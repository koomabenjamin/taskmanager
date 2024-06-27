<template>
  <div class="flex flex-col min-h-screen overflow-hidden">
    <!-- Header Section - Search and Filter -->
    <div class="w-full flex space-x-10 px-4 font-bold flex-shrink-0 border-b">
      <div class="w-full h-20 flex items-center justify-between px-4">
        <div class="flex space-x-4 items-center">
          <MagnifyingGlassIcon class="w-5 h-5" />
          <Input
            placeholder="Search for something"
            class="border-none"
            v-model="searchQuery"
          />
        </div>
        <div class="flex items-center space-x-2">
          <div class="flex items-center space-x-2 relative text-sm">
            <Switch
              v-model="enabled"
              :class="enabled ? 'bg-lime-400' : 'bg-black'"
              class="relative inline-flex h-[30px] w-[55px] shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none focus-visible:ring-2 focus-visible:ring-white focus-visible:ring-opacity-75"
            >
              <span class="sr-only">Use setting</span>
              <span
                aria-hidden="true"
                :class="enabled ? 'translate-x-[25px]' : 'translate-x-0'"
                class="pointer-events-none inline-block h-[26px] w-[26px] transform rounded-full bg-white shadow-lg ring-0 transition duration-200 ease-in-out"
              />
            </Switch>
            <span>Select Timeframe</span>
            <ChevronUpIcon class="w-4" />
            <Calendar v-if="enabled" @change="filterByDateRange" />
          </div>
          <Button label="Share" icon="ArrowUpOnSquareIcon" textColor="text-black" size="md" />
        </div>
      </div>
    </div>

    <!-- Main Content Section - Kanban Columns -->
    <div class="flex-grow w-full h-full flex overflow-x-auto space-x-4 px-4 py-2">
      <div
        class="w-1/3 text-lg overflow-y-auto"
        v-for="column in columns"
        :key="column.name"
      >
        <div class="flex justify-between items-center mx-4 my-2">
          <span class="text-lg text-gray-600 font-semibold" style="font-size: 85%;">
            {{ column.label }}
          </span>
          <EllipsisVerticalIcon class="w-4 h-4 cursor-pointer" />
        </div>
        <div v-if="filteredTasks(column.name).length === 0" class="text-gray-500 mx-4">No tasks here</div>
        <div
          class="m-2 p-5 bg-white rounded-lg h-auto shadow"
          draggable="true"
          v-for="task in filteredTasks(column.name)"
          :key="task.id"
          style="margin-bottom: 16px;"
        >
          <div class="flex items-center justify-between">
            <div class="flex -space-x-4">
              <div
                v-for="member in task.members"
                :key="member.id"
                class="h-10 w-10 rounded-full border-2 border-slate-500 bg-black"
              ></div>
            </div>
            <div
              class="text-lg text-rose-600 font-semibold w-auto px-2 bg-rose-100 py-1 rounded-full capitalize"
              style="font-size: 85%;"
            >
              {{ task.priority }}
            </div>
          </div>
          <div class="font-bold text-sm my-3">{{ task.name }}</div>
          <div class="flex items-center space-x-1 my-1 text-[10px]">
            <div
              v-for="tag in task.tags"
              :key="tag.id"
              :class="tagClass(tag.name)"
            >
              {{ tag.name }}
            </div>
          </div>
          <div
            class="text-lg text-slate-600 font-semibold flex items-center space-x-2 mt-4 text-[10px]"
            style="font-size: 75%;"
          >
            <CalendarIcon class="h-5 stroke-2" />
            <span>{{ formatDate(task.created_at) }} - {{ formatDate(task.implementation_date) }}</span>

          </div>
        </div>
        <div class="flex items-center mx-4 my-2 cursor-pointer" @click="openModal(column.name)">
          <div class="h-6 w-6 rounded-full bg-[#bef264] flex items-center justify-center">
            <PlusIcon class="w-4 h-4 text-black" />
          </div>
          <span
            class="ml-2 text-lg text-gray-600 font-semibold"
            style="font-size: 85%;"
          >
            Add New Task
          </span>
        </div>
      </div>
    </div>

    <!-- Modal -->
    <TransitionRoot appear :show="isModalOpen" as="template">
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
          <div class="fixed inset-0 bg-black bg-opacity-25" />
        </TransitionChild>

        <div class="fixed inset-0 overflow-y-auto">
          <div class="flex min-h-full items-center justify-center p-4 text-center">
            <TransitionChild
              as="template"
              enter="transform transition ease-in-out duration-500"
              enter-from="-translate-x-full"
              enter-to="translate-x-0"
              leave="transform transition ease-in-out duration-500"
              leave-from="translate-x-full"
              leave-to="-translate-x-full"
            >
              <DialogPanel class="w-full max-w-md transform overflow-hidden absolute left-0 inset-y-0 bg-white p-6 text-left align-middle shadow-xl transition-all">
                <DialogTitle
                  as="div"
                  class="text-lg font-medium leading-6 text-gray-900 flex items-center justify-between"
                >
                  <span>Create New Task</span>
                  <button
                    type="button"
                    class="inline-flex justify-center rounded-md border shadow-md bg-lime-100 px-2 py-2 text-sm font-medium text-lime-900 hover:bg-lime-200 focus:outline-none focus-visible:ring-2 focus-visible:ring-lime-500 focus-visible:ring-offset-2"
                    @click="closeModal"
                  >
                    <XMarkIcon class="h-6"/>
                  </button>
                </DialogTitle>
                <div class="mt-2">
                  <form @submit.prevent="submitForm" class="space-y-6 bg-white p-6 rounded-lg shadow-lg">
                    <div>
                      <label for="name" class="block text-sm font-medium text-gray-700">Task Name</label>
                      <input 
                        v-model="form.name"
                        id="name"
                        name="name"
                        type="text"
                        placeholder="Enter task name"
                        required
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                      />
                    </div>
                
                    <div>
                      <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                      <input 
                        v-model="form.description"
                        id="description"
                        name="description"
                        type="text"
                        placeholder="Enter task description"
                        maxlength="25"
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                      />
                    </div>
                
                    <div>
                      <label for="project_id" class="block text-sm font-medium text-gray-700">Project</label>
                      <select 
                        v-model="form.project_id"
                        id="project_id"
                        name="project_id"
                        required
                        class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                      >
                        <option v-for="project in projectStore.projects" :key="project.id" :value="project.id">{{ project.name }}</option>
                      </select>
                    </div>
                
                    <div>
                      <label for="member_id" class="block text-sm font-medium text-gray-700">Assign Member</label>
                      
                      <select 
                        v-model="form.member_id"
                        id="member_id"
                        name="member_id"
                        required
                        class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                      >
                        <option v-for="member in memberStore.members" :key="member.id" :value="member.id">{{ member.name }}</option>
                      </select>
                    </div>
                
                    <div>
                      <label for="implementation_date" class="block text-sm font-medium text-gray-700">Implementation Date</label>
                      <input 
                        v-model="form.implementation_date"
                        id="implementation_date"
                        name="implementation_date"
                        type="date"
                        required
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                      />
                    </div>
                
                    <div>
                      <label class="block text-sm font-medium text-gray-700">Priority</label>
                      <div class="mt-1 flex space-x-4">
                        <label class="inline-flex items-center">
                          <input 
                            v-model="form.priority"
                            type="radio"
                            value="High"
                            required
                            class="form-radio h-4 w-4 text-indigo-600 transition duration-150 ease-in-out"
                          />
                          <span class="ml-2">High</span>
                        </label>
                        <label class="inline-flex items-center">
                          <input 
                            v-model="form.priority"
                            type="radio"
                            value="Low"
                            required
                            class="form-radio h-4 w-4 text-indigo-600 transition duration-150 ease-in-out"
                          />
                          <span class="ml-2">Low</span>
                        </label>
                      </div>
                    </div>
                
                    <div>
                      <label for="tag" class="block text-sm font-medium text-gray-700">Tag</label>
                      <select 
                        v-model="form.tag"
                        id="tag"
                        name="tag"
                        required
                        class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                      >
                        <option value="Research">Research</option>
                        <option value="Prototype">Prototype</option>
                        <option value="Design">Design</option>
                        <option value="Design system">Design system</option>
                      </select>
                    </div>
                
                    <div class="mt-4">
                      <button 
                        type="submit" 
                        class="w-full py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-lime-500 hover:bg-lime-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-lime-500"
                      >
                        Add new task
                      </button>
                    </div>
                  </form>
                </div>
              </DialogPanel>
            </TransitionChild>
          </div>
        </div>
      </Dialog>
    </TransitionRoot>
  </div>


</template>

<script>
import { ref, computed, onMounted } from 'vue';
import {
  MagnifyingGlassIcon,
  CalendarIcon,
  ChevronUpIcon,
  ArrowUpOnSquareIcon,
  EllipsisVerticalIcon,
  PlusIcon,
  XMarkIcon,
} from '@heroicons/vue/24/solid';
import {
  Dialog,
  TransitionRoot,
  TransitionChild,
  DialogPanel,
  DialogTitle,
} from '@headlessui/vue';
import Button from '../shared/Button.vue';
import Input from '../shared/Input.vue';
import Calendar from '../shared/Calendar.vue';
import { useTaskStore } from '../../stores/taskStore';
import { useMemberStore } from '../../stores/memberStore';
import { useProjectStore } from '../../stores/projectStore';

export default {
  components: {
    MagnifyingGlassIcon,
    CalendarIcon,
    ChevronUpIcon,
    ArrowUpOnSquareIcon,
    EllipsisVerticalIcon,
    PlusIcon,
    XMarkIcon,
    Dialog,
    TransitionRoot,
    TransitionChild,
    DialogPanel,
    DialogTitle,
    Button,
    Input,
    Calendar,
  },
  setup() {
    const { members, fetchMembers } = useMemberStore();
    // const { projects, fetchProjects } = useProjectStore();


    const projectStore = useProjectStore();
    const memberStore = useMemberStore();

    const taskStore = useTaskStore();
    const searchQuery = ref('');
    const enabled = ref(false);
    const isModalOpen = ref(false);
    const columns = [
      { name: 'todo', label: 'To Do' },
      { name: 'in_progress', label: 'In Progress' },
      { name: 'done', label: 'Done' },
    ];

    const form = ref({
      name: '',
      description: '',
      project_id: '',
      member_id: '',
      implementation_date: '',
      priority: '',
      tag: '',
      status: '',
    });

    onMounted(() => {
      taskStore.fetchTasks();
      projectStore.fetchProjects();  // Fetch projects
      memberStore.fetchMembers();   // Fetch members
    });

    const openModal = (columnName) => {
      form.value.status = columnName; // This is the correct usage for status
      isModalOpen.value = true;
    };

    const closeModal = () => {
      isModalOpen.value = false;
      form.value = {
        name: '',
        description: '',
        priority: '',
        project_id: '',
        member_id: '',
        implementation_date: '',
        tag: '',
        status: '',
      };
    };

    const submitForm = async () => {
      await taskStore.createTask(form.value);
      closeModal();
    };

    const filterByDateRange = (start, end) => {
      // Implement date range filtering logic here if needed
    };

    const filteredTasks = computed(() => (columnName) => {
      if (!Array.isArray(taskStore.tasks)) {
        return [];
      }
      return taskStore.tasks.filter(task =>
        task.status === columnName &&
        task.name.toLowerCase().includes(searchQuery.value.toLowerCase())
      );
    });

    const formatDate = (dateString) => {
      const options = { year: 'numeric', month: 'short', day: 'numeric' };
      const date = new Date(dateString);
      return date.toLocaleDateString('en-GB', options);
    };

    const tagClass = (tagName) => {
      const tagColors = {
        'Research': 'bg-purple-200 text-purple-600',
        'Prototype': 'bg-green-200 text-green-600',
        'Design': 'bg-blue-200 text-blue-600',
        'Design system': 'bg-yellow-200 text-yellow-600',
      };
      return tagColors[tagName] || '';
    };

    return {
      enabled,
      searchQuery,
      isModalOpen,
      openModal,
      closeModal,
      submitForm,
      form,
      filterByDateRange,
      filteredTasks,
      columns,
      members,
      projectStore,
      memberStore,
      formatDate,
      tagClass,
    };
  },

};
</script>

<style scoped>
/* Add any scoped styles if necessary */
</style>
