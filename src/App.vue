<template>
  <RouterView />
</template>

<script>
import { RouterView } from 'vue-router';

export default {
  name: 'App',
  components: {
    RouterView,
  },
  created() {
    window.indexedDB.open('task-master');
  },
};
</script>

<style scoped>
:root {
  @apply font-serif;
}
</style>
