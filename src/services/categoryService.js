import { ref } from "vue";
import axiosInstance from "@/axios";
import { API_URLS } from "@/apis";

export const allCategories = ref([]);

export const fetchAllCategoriesData = async () => {
  try {
    const response = await axiosInstance.get(API_URLS.LIST_ALL_CATEGORIES);
    allCategories.value = response.data.results;
  } catch (error) {
    console.error("Error fetching data:", error);
  }
};

export const submitCategoryData = async (dataName, colorName) => {
  try {
    const response = await axiosInstance.post(
      API_URLS.SAVE_OR_UPDATE_CATEGORY,
      {
        category_name: dataName,
        category_color: colorName,
      }
    );
    return response.data;
  } catch (error) {
    console.error("Error submitting category data:", error);
    throw error;
  }
};
