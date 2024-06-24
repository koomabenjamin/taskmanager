import { ref } from 'vue';
import axiosInstance from '@/axios';
import { API_URLS } from '@/apis';

export const allCurrentUserTaskStatuses = ref([]);

export const fetchAllCurrentUserTaskStatusData = async () => {
  try {
    const response = await axiosInstance.get(API_URLS.LIST_ALL_CURRENT_USER_TASK_STATUSES);
    console.log("ALL CURRENT USER TASKS STATUS RESPONSE: ", response.data.results);
    allCurrentUserTaskStatuses.value = response.data.results;
  } catch (error) {
    console.error('Error fetching data:', error);
  }
};



