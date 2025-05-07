import { ref } from "vue";
import axiosInstance from "@/axios";
import { API_URLS } from "@/apis";

export const allCurrentUserTaskStatuses = ref([]);

export const fetchAllCurrentUserTaskStatusData = async () => {
  try {
    const response = await axiosInstance.get(
      API_URLS.LIST_ALL_CURRENT_USER_TASK_STATUSES
    );
    allCurrentUserTaskStatuses.value = response.data.results;
  } catch (error) {
    if (error.response && error.response.data && error.response.data) {
      console.error("Submit data failed: ", error.response.data.message);
      throw new Error(error.response.data.message);
    } else {
      console.error("Submit data failed: ", error.message);
      throw new Error("An unknown error occurred during fetching data.");
    }
  }
};

export const handleError = (error, customMessage) => {
  let errorMessage = customMessage || "An error occurred.";
  if (
    error.response &&
    error.response.data &&
    error.response.data.results.message
  ) {
    errorMessage = error.response.data.results.message;
  } else {
    console.error("Error details:", error);
    errorMessage = error.response.data.results.message || "Network Error";
  }
  alert(errorMessage);
};
