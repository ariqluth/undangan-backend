
import scenario from '../../fixture/scenario.json'
describe('case positive melakukan login', function ()  {
    beforeEach( function () {
        cy.resetDb();
        cy.fixture('scenario').then(function (data) {
            this.data = data;
          })
    });



    it('test masuk login', function ()  {
        cy.visit('/')
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.get('[data-id="nav-atas"]').click();
        cy.get('[data-id="profileLogout"]').click();
      })

    });


describe('case negative melakukan login', () => {
    beforeEach(function ()  {
        cy.resetDb();
        cy.fixture('scenario').then(function (data) {
            this.data = data;
          })
    });

  it('test validate password', function() {
    cy.visit('/')
    cy.get('[data-id="inputPassword"]').type(this.data.password);
    cy.get('[data-id="buttonLogin"]').click();
    cy.get('.invalid-feedback');
  })

  it('test validate database tidak ada', function() {
    cy.visit('/')
    cy.get('[data-id="inputEmail"]').type('user@yahoo.com');
    cy.get('[data-id="inputPassword"]').type('password');
    cy.get('[data-id="buttonLogin"]').click();
    cy.get('.invalid-feedback');
  })

  it('test validate email', function() {
    cy.visit('/')
    cy.get('[data-id="inputEmail"]').type(this.data.email);
    cy.get('[data-id="buttonLogin"]').click();
    cy.get('.invalid-feedback');

  })
  it('test input kosong', function() {
    cy.visit('/')
    cy.get('[data-id="buttonLogin"]').click();
    cy.get('.invalid-feedback');
  })


});
