import { ref, computed } from 'vue'

export function useFilterCards(initialCards) {
  const searchQuery = ref('')
  const selectedCategory = ref('')
  const selectedMember = ref('') // Ensure it's initialized as a string
  const selectedDate = ref('')

  const filteredCards = computed(() => {
    return initialCards.value.filter(card => {
      const selectedMemberInt = parseInt(selectedMember.value)
      return (
        (searchQuery.value === '' || card.name.toLowerCase().includes(searchQuery.value.toLowerCase())) &&
        (selectedCategory.value === '' || card.priority === selectedCategory.value) &&
        (selectedMember.value === '' || card.members.includes(selectedMemberInt)) &&
        (selectedDate.value === '' || card.date === selectedDate.value)
      )
    })
  })

  const filterCards = () => {
    filteredCards.value = initialCards.value.filter(card => {
      const selectedMemberInt = parseInt(selectedMember.value)
      return (
        (searchQuery.value === '' || card.name.toLowerCase().includes(searchQuery.value.toLowerCase())) &&
        (selectedCategory.value === '' || card.priority === selectedCategory.value) &&
        (selectedMember.value === '' || card.members.includes(selectedMemberInt)) &&
        (selectedDate.value === '' || card.date === selectedDate.value)
      )
    })
  }

  return {
    searchQuery,
    selectedCategory,
    selectedMember,
    selectedDate,
    filteredCards,
    filterCards,
  }
}
