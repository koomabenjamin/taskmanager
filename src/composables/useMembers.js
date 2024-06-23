import { ref } from 'vue';
import { getMembers } from '../services/api';

export function useMembers() {
  const members = ref([]);

  /**
   * Fetch members from API
   */
  const fetchMembers = async () => {
    members.value = await getMembers();
  };

  return {
    members,
    fetchMembers,
  };
}
