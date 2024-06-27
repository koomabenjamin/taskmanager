import axios from 'axios';

describe('Member Form', () => {
  beforeEach(() => {
    // Assuming your Vue app is served and accessible at this URL
    cy.visit('http://localhost:8080'); // Replace with your actual Vue app URL
  });

  it('should add a new member', () => {
    // Mock response for existing member check
    cy.intercept('GET', 'http://localhost:3000/members/*', { fixture: 'existingMember.json' }).as('getMember');

    // Mock response for successful member addition
    cy.intercept('POST', 'http://localhost:3000/members', { fixture: 'addedMember.json' }).as('addMember');

    // Fill out the form inputs
    cy.get('input[placeholder="ID"]').type('123');
    cy.get('input[placeholder="Name"]').type('John Doe');
    cy.get('input[placeholder="Image URL"]').type('https://example.com/image.jpg');

    // Submit the form
    cy.get('button[type="submit"]').click();

    // Verify requests were made
    cy.wait('@getMember').its('response.statusCode').should('eq', 200);
    cy.wait('@addMember').its('response.statusCode').should('eq', 200);

    // Verify success message or behavior after member addition
    cy.contains('Member added successfully');
  });

  it('should handle existing member ID', () => {
    // Mock response for existing member check
    cy.intercept('GET', 'http://localhost:3000/members/*', { statusCode: 200, body: { id: '123', name: 'Existing Member', image: 'https://example.com/existing.jpg' } }).as('getMember');

    // Fill out the form inputs
    cy.get('input[placeholder="ID"]').type('123');
    cy.get('input[placeholder="Name"]').type('John Doe');
    cy.get('input[placeholder="Image URL"]').type('https://example.com/image.jpg');

    // Submit the form
    cy.get('button[type="submit"]').click();

    // Verify error message or behavior when member ID already exists
    cy.contains('Member with the same ID already exists');
  });
});
