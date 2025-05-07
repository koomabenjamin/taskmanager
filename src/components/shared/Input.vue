<!-- Input.vue -->
<template>
  <input
    :placeholder="placeholder"
    :id="id"
    :name="name"
    :type="type"
    class="w-full h-12 border p-2 rounded text-xs"
    :value="modelValue"
    @input="$emit('update:modelValue', $event.target.value)"
  />
</template>

<script setup>
const props = defineProps({
  id: [String, Number],
  name: [String, Number],
  type: [String, Number],
  modelValue: [String, Number],
  placeholder: [String, Number],
});
</script>

<style>
/* Add any styles here if needed */
</style>
