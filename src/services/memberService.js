import { ref } from 'vue';
import axiosInstance from '@/axios';
import { API_URLS } from '@/apis';

export const allMembers = ref([]);

export const fetchAllMembersData = async () => {
  try {
    const response = await axiosInstance.get(API_URLS.LIST_ALL_MEMBERS);
    allMembers.value = response.data.results;
    // console.log("ALL MEMBERS:", allMembers.value)
  } catch (error) {
    console.error('Error fetching data:', error);
  }
};



export const submitMemberData = async (name, email) => {
    try {
      const response = await axiosInstance.post(API_URLS.SAVE_OR_UPDATE_MEMBER, {
        name: name,
        email: email
      });
      return response.data;
    } catch (error) {
      console.error('Error submitting Member data:', error);
      throw error; 
    }
  };




