import axios from 'axios';

export const getTasks = async () => {
  const response = await axios.get('/api/v1/tasks/all');
  return response.data;
};

export const getProjects = async () => {
  const response = await axios.get('/api/v1/projects/all');
  return response.data;
};

export const getMembers = async () => {
  const response = await axios.get('/api/v1/members');
  return response.data;
};

export const createTask = async (taskData) => {
  await axios.post('/api/v1/tasks/create', taskData);
};

export const updateTask = async (taskId, taskData) => {
  await axios.put(`/api/v1/tasks/${taskId}/update`, taskData);
};

export const deleteTask = async (taskId) => {
  await axios.delete(`/api/v1/tasks/${taskId}/delete`);
};

export const restoreTask = async (taskId) => {
  await axios.post(`/api/v1/tasks/trashed/temp/${taskId}/restore`);
};

export const restoreAllTasks = async () => {
  await axios.post('/api/v1/tasks/trashed/temp/restore-all');
};
