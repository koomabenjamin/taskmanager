<template>
    <div>
      <!-- Tabs -->
      <div class="tabs">
        <button class="tab" :class="{ 'active': currentTab === 'deletedUsers' }" @click="currentTab = 'deletedUsers'">Deleted Users</button>
        <button class="tab" :class="{ 'active': currentTab === 'tasksPastImplementationDate' }" @click="currentTab = 'tasksPastImplementationDate'">Tasks Past Implementation Date</button>
        <button class="tab" :class="{ 'active': currentTab === 'tasksByCategory' }" @click="currentTab = 'tasksByCategory'">Tasks by Category</button>
      </div>
  
      <!-- Tab content -->
      <div v-if="currentTab === 'deletedUsers'">
        <h2 v-if="deletedUsers.length === 0">No Tasks here</h2>
        <table v-else>
          <thead>
            <tr>
              <th>Name</th>
              <th>Email</th>
              <th>Deleted At</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="user in deletedUsers" :key="user.id">
              <td>{{ user.name }}</td>
              <td>{{ user.email }}</td>
              <td>{{ user.deleted_at }}</td>
            </tr>
          </tbody>
        </table>
      </div>
  
      <div v-else-if="currentTab === 'tasksPastImplementationDate'">
        <h2 v-if="tasksPastDate.length === 0">No Tasks here</h2>
        <table v-else>
          <thead>
            <tr>
              <th>Name</th>
              <th>Implementation Date</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="task in tasksPastDate" :key="task.id">
              <td>{{ task.name }}</td>
              <td>{{ task.implementation_date }}</td>
              <td>{{ task.status }}</td>
            </tr>
          </tbody>
        </table>
      </div>
  
      <div v-else-if="currentTab === 'tasksByCategory'">
        <h2 v-if="tasksByCategory.length === 0">No Tasks here</h2>
        <table v-else>
          <thead>
            <tr>
              <th>Name</th>
              <th>Category</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="task in tasksByCategory" :key="task.id">
              <td>{{ task.name }}</td>
              <td>{{ task.category }}</td>
              <td>{{ task.status }}</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </template>
  
  <script setup>
  import { useTaskStore } from '../../stores/taskStore';
  
  const { deletedUsers, tasksPastDate, tasksByCategory, fetchDeletedUsers, fetchTasksPastDate, fetchTasksByCategory } = useTaskStore();
  const currentTab = ref('deletedUsers');
  

  
  // Fetch data on component mount
  onMounted(() => {
    fetchDeletedUsers();
    fetchTasksPastDate();
    fetchTasksByCategory();
  });
  </script>
  
  <style scoped>
.tabs {
  display: flex;
  justify-content: space-around;
  margin-bottom: 20px;
}

.tab {
  padding: 10px 20px;
  cursor: pointer;
  background-color: #f0f0f0;
  border: 1px solid #ccc;
  border-radius: 5px 5px 0 0;
}

.tab.active {
  background-color: #ccc;
}

table {
  width: 100%;
  border-collapse: collapse;
  margin-top: 10px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  border-radius: 5px;
  overflow: hidden;
}

table th, table td {
  border: 1px solid #ccc;
  padding: 12px;
  text-align: left;
}

table th {
  background-color: #f0f0f0;
  font-weight: bold;
  text-transform: uppercase;
  font-size: 14px;
  color: #333;
}

table td {
  font-size: 14px;
}

table tbody tr:nth-child(even) {
  background-color: #f9f9f9;
}

table tbody tr:hover {
  background-color: #e0e0e0;
}

.no-tasks {
  margin-top: 20px;
  text-align: center;
  font-style: italic;
  color: #777;
}
</style>
