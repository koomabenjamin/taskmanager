import { ref } from 'vue';
import axiosInstance from '@/axios';
import { API_URLS } from '@/apis';

export const allTasks = ref([]);

export const fetchAllTasksData = async () => {
  try {
    const response = await axiosInstance.get(API_URLS.LIST_ALL_TASKS);
    console.log("ALL TASKS RESPONSE: ", response.data.results);
    allTasks.value = response.data.results;
  } catch (error) {
    console.error('Error fetching data:', error);
  }
};




// project_id: data.project_id,
// status_id: data.status_id,
// task_name: data.task_name,
// start_date: data.start_date,
// end_date: data.end_date,
// description: data.description,
// // members: data.members,
// // tags: data.tags,
// task_priority: data.task_priority,

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
      // project_id: project_id,
      // status_id: status_id,
      // task_name: task_name,
      // start_date: start_date,
      // end_date: end_date,
      // description: description,
      // members: members,
      // tags: tags,
      // task_priority: task_priority,
    });
    return response.data;
  } catch (error) {
    console.error('Error submitting project data:', error);
    throw error;
  }
};


// export const submitTaskData = async (data) => {
//     console.log("RECIVED DATA: ", data)
//     console.log("RECIVED DATA MEM: ", data.members)
//     console.log("RECIVED DATA TAG: ", data.tags)
//     console.log("RECIVED DATA project_id: ", data.project_id)
//     const taskData = {
//         // id: data.task_id ?? null,
//         project_id: data.project_id,
//         status_id: data.status_id,
//         task_name: data.task_name,
//         start_date: data.start_date,
//         end_date: data.end_date,
//         description: data.description,
//         // members: data.members,
//         // tags: data.tags,
//         task_priority: data.task_priority,
//     };

//     try {
//       const response = await axiosInstance.post(API_URLS.SAVE_OR_UPDATE_TASK, taskData

//         // // "project_id": 3,
//         // // "status_id": 1,
//         // // "task_name": "User Auth",
//         // // "start_date": "2024-07-01",
//         // // "end_date": "2024-09-01",
//         // // "description": null,
//         // // "members": "[\"[{id: 1}, {id:2}]\"]",
//         // // "tags": "[\"[{id: 1}, {id:2}]\"]",
//         // // "task_priority": "medium",
//         // id: data.task_id ?? null,
//         // project_id: data.project_id,
//         // status_id: data.status_id,
//         // task_name: data.task_name,
//         // start_date: data.start_date,
//         // end_date: data.end_date,
//         // description: data.description,
//         // members: data.members,
//         // tags: data.tags,
//         // task_priority: data.task_priority,
//       );
//       return response.data;
//     } catch (error) {
//       console.error('Error submitting project data:', error);
//       throw error; 
//     }
//   };




