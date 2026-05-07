<template>
  <div class="space-y-2">
    <button
      @click="isOpen = !isOpen"
      class="w-full flex items-center justify-between px-3 py-2 rounded-lg hover:bg-gray-200 transition-all duration-200 text-sm font-semibold text-gray-700"
    >
      {{ title }}
      <ChevronDownIcon :class="['w-4 h-4 transition-transform', isOpen ? 'rotate-180' : '']" />
    </button>

    <transition-expand v-if="isOpen">
      <div class="pl-4 space-y-2">
        <button
          v-for="item in items"
          :key="item.id"
          class="w-full text-left px-3 py-2 rounded-lg text-xs hover:bg-gray-200 transition-all duration-200 flex items-center space-x-2"
        >
          <div v-if="item.color" :class="['w-3 h-3 rounded-full', item.color]"></div>
          <span>{{ item.name }}</span>
        </button>
      </div>
    </transition-expand>
  </div>
</template>

<script setup>
import { ref } from 'vue'
import { ChevronDownIcon } from '@heroicons/vue/24/outline'

defineProps({
  title: String,
  items: Array
})

const isOpen = ref(false)
</script>

<style scoped>
.transition-expand-enter-active,
.transition-expand-leave-active {
  transition: all 0.3s ease;
  overflow: hidden;
}

.transition-expand-enter-from,
.transition-expand-leave-to {
  opacity: 0;
  max-height: 0;
}

.transition-expand-enter-to,
.transition-expand-leave-from {
  opacity: 1;
  max-height: 500px;
}
</style>
