

const BASE_URL = import.meta.env.VITE_API_URL;
console.log("BASE URL: ", BASE_URL);

export const API_URLS = {

  //Auth
  REGISTER: `${BASE_URL}/api/auth/register`,
  LOGIN: `${BASE_URL}/api/auth/login`,

  //Tag
  SAVE_OR_UPDATE_TAG: `${BASE_URL}/api/tag/create-or-update-tag`,
  DELETE_TAG: `${BASE_URL}/api/tag/delete-tag`,

  //Project
  SAVE_OR_UPDATE_PROJECT: `${BASE_URL}/api/project/create-or-update-project`,
  DELETE_PROJECT: `${BASE_URL}/api/project/delete-project`,

  //Tasks
  SAVE_OR_UPDATE_TASk: `${BASE_URL}/api/task/create-or-update-task`,
  DELETE_TASK: `${BASE_URL}/api/task/delete-task`,


};



