describe('useDragAndDrop Composable', () => {
    beforeEach(() => {
      // Assuming your Vue app is served and accessible at this URL
      cy.visit('http://localhost:8080'); // Replace with your actual Vue app URL
    });
  
    it('should allow dragging and dropping cards between columns', () => {
      // Mock data
      const cards = [
        { id: 1, title: 'Card 1', status: 'todo' },
        { id: 2, title: 'Card 2', status: 'in-progress' },
        { id: 3, title: 'Card 3', status: 'done' }
      ];
  
      // Stub cards in your Vue app if needed
      cy.window().its('app.$data.cards').invoke('push', ...cards);
  
      // Select a card to drag
      cy.get(`[data-testid="card-${cards[0].id}"]`)
        .trigger('dragstart', { dataTransfer: { setData: () => {} } })
        .as('draggedCard');
  
      // Drop the card into a new column
      cy.get(`[data-testid="column-in-progress"]`)
        .trigger('drop', { dataTransfer: { getData: () => cards[0].id } });
  
      // Assert the card's status is updated
      cy.get('@draggedCard').then(($card) => {
        const cardId = $card.attr('data-id');
        cy.get(`[data-testid="card-${cardId}"]`).should('have.attr', 'data-status', 'in-progress');
      });
    });
  });
  