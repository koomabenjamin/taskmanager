<template>
  <textarea :placeholder="props.placeholder" :rows="props.rows" class="w-full border p-2 rounded text-xs"></textarea>
</template>

<script setup>

const props = defineProps({
  id: [String, Number],
  name: [String, Number],
  cols: [String, Number],
  rows: [String, Number],
  modelValue: [String, Number],
  placeholder: [String, Number],
   required: {
    type: Boolean,
    default: false
  }
})
</script>

<style>

</style>