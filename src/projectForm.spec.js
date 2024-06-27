import axios from 'axios';

describe('Project Form', () => {
  beforeEach(() => {
    // Assuming your Vue app is served and accessible at this URL
    cy.visit('http://localhost:8080'); // Replace with your actual Vue app URL
  });

  it('should add a new project', () => {
    // Mock response for existing project check
    cy.intercept('GET', 'http://localhost:3000/projects/*', { fixture: 'existingProject.json' }).as('getProject');

    // Mock response for successful project addition
    cy.intercept('POST', 'http://localhost:3000/projects', { fixture: 'addedProject.json' }).as('addProject');

    // Fill out the form inputs
    cy.get('input[placeholder="ID"]').type('456');
    cy.get('input[placeholder="Name"]').type('New Project');

    // Submit the form
    cy.get('button[type="submit"]').click();

    // Verify requests were made
    cy.wait('@getProject').its('response.statusCode').should('eq', 200);
    cy.wait('@addProject').its('response.statusCode').should('eq', 200);

    // Verify success message or behavior after project addition
    cy.contains('Project added successfully');
  });

  it('should handle existing project ID', () => {
    // Mock response for existing project check
    cy.intercept('GET', 'http://localhost:3000/projects/*', { statusCode: 200, body: { id: '456', name: 'Existing Project' } }).as('getProject');

    // Fill out the form inputs
    cy.get('input[placeholder="ID"]').type('456');
    cy.get('input[placeholder="Name"]').type('New Project');

    // Submit the form
    cy.get('button[type="submit"]').click();

    // Verify error message or behavior when project ID already exists
    cy.contains('Project with the same ID already exists');
  });
});
