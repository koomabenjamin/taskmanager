import { ref } from 'vue';

describe('useFilterCards Composable', () => {
  beforeEach(() => {
    // Assuming your Vue app is served and accessible at this URL
    cy.visit('http://localhost:8080'); // Replace with your actual Vue app URL
  });

  it('should filter cards based on search query, category, member, and date', () => {
    // Mock initial cards data
    const initialCards = ref([
      { id: 1, name: 'Task 1', priority: 'high', members: [1, 2], date: '2022-06-20' },
      { id: 2, name: 'Task 2', priority: 'medium', members: [1], date: '2022-06-15' },
      { id: 3, name: 'Task 3', priority: 'low', members: [2, 3], date: '2022-06-18' },
    ]);

    // Stub initial cards in your Vue app if needed
    cy.window().its('app.$data.initialCards').invoke('push', ...initialCards);

    // Simulate interaction: set search query
    const searchQuery = 'Task 1';
    cy.get('input[placeholder="Search for something"]').type(searchQuery);

    // Simulate interaction: select category
    const selectedCategory = 'high';
    cy.get('#category').select(selectedCategory);

    // Simulate interaction: select member
    const selectedMember = '2'; // Assuming '2' is a valid member ID
    cy.get('#member').select(selectedMember);

    // Simulate interaction: select date
    const selectedDate = '2022-06-20';
    cy.get('#date').type(selectedDate);

    // Verify filtered cards
    cy.get('.card').should('have.length', 1); // Adjust selector as per your Vue component structure
    cy.get('.card').contains('Task 1'); // Verify specific card is present after filtering
  });
});
