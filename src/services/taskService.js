import { ref } from 'vue';
import axiosInstance from '@/axios';
import { API_URLS } from '@/apis';

export const allTasks = ref([]);
export const cards = ref([]);



export const fetchAllTasksData = async () => {
  try {
    const response = await axiosInstance.get(API_URLS.LIST_ALL_TASKS);
    console.log("ALL TASKS RESPONSE: ", response.data.results);
    allTasks.value = response.data.results;
    await updateCards(allTasks.value);

  } catch (error) {
    console.error('Error fetching data:', error);
  }
};



export const updateCards = async(updatedTasks) => {
  cards.value = updatedTasks.map(updatedTask => ({
    id: updatedTask.id,
    status: updatedTask.status.slug,
    priority: updatedTask.task_priority,
    task_name: updatedTask.task_name,
    date: formatDate(updatedTask.start_date, updatedTask.end_date),
    members: updatedTask.members.map(member => member.id),
    tags: updatedTask.tags,
  }));
};



export const formatDate = (startDate, endDate) => {
  const start = new Date(startDate);
  const end = new Date(endDate);
  
  const startDay = start.getDate();
  const startMonth = start.toLocaleString('default', { month: 'long' });
  const startYear = start.getFullYear();
  
  const endDay = end.getDate();
  const endMonth = end.toLocaleString('default', { month: 'long' });
  const endYear = end.getFullYear();
  
  function getOrdinal(day) {
    if (day > 3 && day < 21) return `${day}th`;
    switch (day % 10) {
      case 1: return `${day}st`;
      case 2: return `${day}nd`;
      case 3: return `${day}rd`;
      default: return `${day}th`;
    }
  }
  const formattedStartDate = `${getOrdinal(startDay)} ${startMonth} ${startYear}`;
  const formattedEndDate = `${getOrdinal(endDay)} ${endMonth} ${endYear}`;
  
  return `${formattedStartDate} - ${formattedEndDate}`;
};



export const submitTaskData = async (data) => {
  try {
    const response = await axiosInstance.post(API_URLS.SAVE_OR_UPDATE_TASk, {

      id: data.task_id ? data.task_id : null,
      project_id: data.project_id,
      status_id: data.status_id,
      task_name: data.task_name,
      start_date: data.start_date,
      end_date: data.end_date,
      description: data.description,
      members: data.members,
      tags: data.tags,
      task_priority: data.task_priority,
    });
    return response.data;
  } catch (error) {
    console.error('Error submitting project data:', error);
    throw error;
  }
};


export const deleteTaskData = async (task_id) => {
  try {
    const response = await axiosInstance.post(API_URLS.DELETE_TASK, {
      task_id: task_id
    });
    return response.data;
  } catch (error) {
    console.error('Error Deleting task.....', error);
    throw error;
  }
};





