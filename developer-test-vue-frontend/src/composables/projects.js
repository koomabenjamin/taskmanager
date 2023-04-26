import { ref } from "vue";
import axios from "axios";
import { useRouter } from "vue-router";

axios.defaults.baseURL = "http://127.0.0.1:8000/api/v1/";

export default function useProjects(){
    const projects = ref([]);
    const project = ref([]);
    const errors = ref([]);
    const router = useRouter();

    //Get All Projects
    const getProjects = async () => {
        const response = await axios.get("projects");
        projects.value = response.data.data;
    }

    //Get One Project By ID
    const getProject = async (id) => {
        const response = await axios.get("projects/" + id);
        projects.value = response.data.data;
    }

    //Store Project 
    const storeProject = async (data) => {
        try {
          await axios.post("/projects", data);
          await router.push({name: "projectindex"});
        } catch(error){
            if(error.response.status === 422){
                errors.value = error.response.data.errors;
            }
        }
    }

    //Update Project 
    const updateProject = async (id) => {
        try {
          await axios.put("projects/"+id, project.value);
          await router.push({name: "projectindex"});
        } catch(error){
            if(error.response.status === 422){
                errors.value = error.response.data.errors;
            }
        }
        const response = await axios.get("projects"+id);
        projects.value = response.data.data;
    }

    //Delete Project By ID
    const deleteProject = async (id) => {
        if(!window.confirm("Are you Sure you want to Delete this Project ?")){
            return;
        }
        await axios.delete("projects/" + id);
        await getProjects();
    }

    return {
        project,
        projects,
        getProject,
        getProjects,
        storeProject,
        updateProject,
        deleteProject,
        errors
    };
}