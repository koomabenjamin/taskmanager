<template>
  <button :class="buttonClasses">
    <component :is="Icons[props.icon]" class="h-5 w-5 stroke-2" :class="iconClasses"></component>
    <span :class="labelClasses">{{ props.label }}</span>
    <component v-if="props.dropDown" :is="Icons['ChevronDownIcon']" class="h-4 w-4 stroke-2" :class="iconClasses"></component>
  </button>
</template>

<script setup>
import { defineProps } from 'vue';
import * as Icons from '@heroicons/vue/24/outline';

const props = defineProps({
  label: String,
  icon: String,
  size: {
    type: String,
    default: 'md',
  },
  color: String,
  textColor: {
    type: String,
    default: 'text-black',
  },
  dropDown: Boolean,
});

const sizes = {
  sm: 'px-1 py-2 text-xs',
  md: 'px-3 py-2 text-sm',
  lg: 'px-5 py-3 text-sm',
  xl: 'px-10 py-4 text-base',
};

const buttonClasses = `${props.color} ${sizes[props.size]} rounded font-semibold flex items-center space-x-2 shadow`;
const iconClasses = `stroke-2 ${props.textColor}`;
const labelClasses = `text-black`;
</script>

<style scoped>
/* Add any scoped styles needed for the button */
button {
  /* Example button styles */
  padding: 8px 16px;
  border-radius: 4px;
  background-color: #f0f0f0;
  border: 1px solid #ccc;
}

.text-black {
  color: black; /* Ensures text color is black */
}
</style>
