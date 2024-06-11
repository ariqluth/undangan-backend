import "cypress-mailhog";
import "cypress-iframe";
describe('case positive', () => {
    beforeEach(() => {
        cy.exec("php artisan migrate:fresh --seed");
    });

    it('melakukan akses edit profil', () => {
     cy.visit('http://localhost:8000/')
     cy.get('[data-id="inputEmail"]').type('superadmin@gmail.com');
     cy.get('[data-id="inputPassword"]').type('password');
     cy.get('[data-id="buttonLogin"]').click();
      cy.get('.nav-link > .d-sm-none').click();
      cy.get('[href="http://localhost:8000/profile"]').click();
      cy.get('h1').contains('Edit Profile');
      cy.get('.col-lg-7 > .card > .needs-validation > .card-header > h4').contains('Edit Profile');
      cy.get(':nth-child(2) > .needs-validation > .card-header > h4').contains('Edit Password')
    })

    it('melakukan edit profil dengan username', () => {
        cy.visit('http://localhost:8000/')
        cy.get('[data-id="inputEmail"]').type('superadmin@gmail.com');
        cy.get('[data-id="inputPassword"]').type('password');
        cy.get('[data-id="buttonLogin"]').click();
      cy.get('.nav-link > .d-sm-none').click();
      cy.get('[href="http://localhost:8000/profile"]').click();
      cy.get('.col-lg-7 > .card > .needs-validation > .card-body > .row > :nth-child(1) > .form-control').clear('superTester1');
      cy.get('.col-lg-7 > .card > .needs-validation > .card-body > .row > :nth-child(1) > .form-control').type('superTester1');
      cy.get('.col-lg-7 > .card > .needs-validation > .card-footer > .btn').click();
      cy.get('.navbar-right > :nth-child(2) > .nav-link').click();
      cy.get('.text-danger').click();
    })


    it('melakukan edit profil dengan email', () => {
      cy.visit('http://localhost:8000/')
      cy.visit('http://localhost:8000/')
      cy.get('[data-id="inputEmail"]').type('superadmin@gmail.com');
      cy.get('[data-id="inputPassword"]').type('password');
      cy.get('[data-id="buttonLogin"]').click();
      cy.get('.nav-link > .d-sm-none').click();
      cy.get('[href="http://localhost:8000/profile"]').click();
      cy.get('.col-lg-7 > .card > .needs-validation > .card-body > .row > :nth-child(2) > .form-control').clear('superadmin2@gmail.com');
      cy.get('.col-lg-7 > .card > .needs-validation > .card-body > .row > :nth-child(2) > .form-control').type('superadmin2@gmail.com');
      cy.get('.col-lg-7 > .card > .needs-validation > .card-footer > .btn').click();
      cy.visit('http://localhost:8025/#')
      cy.contains("superadmin2@gmail.com").click();
      cy.frameLoaded("#preview-html");
      cy.wait(500);
      cy.iframe()
              .find(".button")
              .should("have.text", "Verify Email Address")
              .invoke("removeAttr", "target")
              .click();
      cy.visit("http://localhost:8000/profile");
    })
  })
  describe('case negative', () => {
    beforeEach(() => {
        cy.exec("php artisan migrate:fresh --seed");
    });

    it('melakukan edit semua kosong', ()=> {
      cy.visit('http://localhost:8000/')
      cy.get('[data-id="inputEmail"]').type('superadmin@gmail.com');
      cy.get('[data-id="inputPassword"]').type('password');
      cy.get('[data-id="buttonLogin"]').click();
    cy.get('.nav-link > .d-sm-none').click();
    cy.get('[href="http://localhost:8000/profile"]').click();
    cy.get('.col-lg-7 > .card > .needs-validation > .card-body > .row > :nth-child(1) > .form-control').clear();
    cy.get('.col-lg-7 > .card > .needs-validation > .card-body > .row > :nth-child(2) > .form-control').clear();
    cy.get('.col-lg-7 > .card > .needs-validation > .card-footer > .btn').click();
    cy.get('.invalid-feedback').contains('The name field is required');
    cy.get('.invalid-feedback').contains('The email field is required');
  })

    it('melakukan edit profil jika username kosong', ()=> {
        cy.visit('http://localhost:8000/')
        cy.get('[data-id="inputEmail"]').type('superadmin@gmail.com');
        cy.get('[data-id="inputPassword"]').type('password');
        cy.get('[data-id="buttonLogin"]').click();
      cy.get('.nav-link > .d-sm-none').click();
      cy.get('[href="http://localhost:8000/profile"]').click();
      cy.get('.col-lg-7 > .card > .needs-validation > .card-body > .row > :nth-child(1) > .form-control').clear();
      cy.get('.col-lg-7 > .card > .needs-validation > .card-footer > .btn').click();
      cy.get('.invalid-feedback').contains('The name field is required');
    })

    it('melakukan edit profil jika email kosong', ()=> {
        cy.visit('http://localhost:8000/')
        cy.get('[data-id="inputEmail"]').type('superadmin@gmail.com');
        cy.get('[data-id="inputPassword"]').type('password');
        cy.get('[data-id="buttonLogin"]').click();
      cy.get('.nav-link > .d-sm-none').click();
      cy.get('[href="http://localhost:8000/profile"]').click();
      cy.get('.col-lg-7 > .card > .needs-validation > .card-body > .row > :nth-child(2) > .form-control').clear();
      cy.get('.col-lg-7 > .card > .needs-validation > .card-footer > .btn').click();
      cy.get('.invalid-feedback').contains('The email field is required');
    })
})
