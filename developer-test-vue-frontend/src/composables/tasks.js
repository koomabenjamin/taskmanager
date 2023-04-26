import { ref } from "vue";
import axios from "axios";
import { useRouter } from "vue-router";


axios.defaults.baseURL = "http://127.0.0.1:8000/api/v1/";

export default function useTasks(){
    const tasks = ref([]);
    const task = ref([]);
    const errors = ref([]);
    const router = useRouter();

    //Get All Tasks
    const getTasks = async () => {
        const response = await axios.get("tasks/pending");
        tasks.value = response.data.data;
    }

    //Get One Task By ID
    const getTask = async (id) => {
        const response = await axios.get("tasks" + id);
        tasks.value = response.data.data;
    }

    //Store Task 
    const storeTask = async (data) => {
        try {
          await axios.post("tasks", data);
          await router.push({name: "taskindex"});
        } catch(error){
            if(error.response.status === 422){
                errors.value = error.response.data.errors;
            }
        }
        const response = await axios.get("tasks"+id);
        tasks.value = response.data.data;
    }

    //Update Task 
    const updateTask = async (id) => {
        try {
          await axios.put("tasks/" + id, task.value);
          await router.push({name: "taskindex"});
        } catch(error){
            if(error.response.status === 422){
                errors.value = error.response.data.errors;
            }
        }
        const response = await axios.get("tasks"+id);
        tasks.value = response.data.data;
    }

    //Delete Project By ID
    const deleteTask = async (id) => {
        if(!window.confirm("Are you Sure you want to Delete this Task ?")){
            return;
        }
        await axios.delete("tasks/" + id);
        await getTasks();
    }

    return {
        task,
        tasks,
        getTask,
        getTasks,
        storeTask,
        updateTask,
        deleteTask,
        errors
    };
}