// composables/useDragAndDrop.js
import { ref } from 'vue'

export function useDragAndDrop(cards) {
  const draggedItem = ref(null)

const onDragStart = (event, id) => {
  draggedItem.value = id
}

const onDrop = (event, column) => {
  const card = cards.value.find(card => card.id === draggedItem.value)
  if (card) {
    card.status = column
  }
}

  return {
    onDragStart,
    onDrop,
  }
}
