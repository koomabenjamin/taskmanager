import { ref } from 'vue';
import { getProjects } from '../services/api';

export function useProjects() {
  const projects = ref([]);

  /**
   * Fetch projects from API
   */
  const fetchProjects = async () => {
    projects.value = await getProjects();
  };

  return {
    projects,
    fetchProjects,
  };
}
