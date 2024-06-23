import { ref } from 'vue';
import {
  getTasks,
  createTask,
  updateTask,
  deleteTask,
  restoreTask,
  restoreAllTasks
} from '../services/api';

export function useTasks() {
  const tasks = ref([]);

  /**
   * Fetch tasks from API
   */
  const fetchTasks = async () => {
    tasks.value = await getTasks();
  };

  /**
   * Create a new task
   * @param {Object} taskData
   */
  const createTaskAction = async (taskData) => {
    await createTask(taskData);
    await fetchTasks();
  };

  /**
   * Update an existing task
   * @param {Number} taskId
   * @param {Object} taskData
   */
  const updateTaskAction = async (taskId, taskData) => {
    await updateTask(taskId, taskData);
    await fetchTasks();
  };

  /**
   * Delete a task
   * @param {Number} taskId
   */
  const deleteTaskAction = async (taskId) => {
    await deleteTask(taskId);
    await fetchTasks();
  };

  /**
   * Restore a deleted task
   * @param {Number} taskId
   */
  const restoreTaskAction = async (taskId) => {
    await restoreTask(taskId);
    await fetchTasks();
  };

  /**
   * Restore all deleted tasks
   */
  const restoreAllTasksAction = async () => {
    await restoreAllTasks();
    await fetchTasks();
  };

  return {
    tasks,
    fetchTasks,
    createTaskAction,
    updateTaskAction,
    deleteTaskAction,
    restoreTaskAction,
    restoreAllTasksAction,
  };
}
