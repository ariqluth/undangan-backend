import "cypress-mailhog"
import "cypress-iframe"
import scenarioRegister from '../../fixture/scenarioregister.json'


describe('case positive register', () => {
    beforeEach( function () {
        cy.resetDb();
        cy.fixture('scenarioRegister').then(function (data) {
            this.data = data;
          })
    });
    it("register", function ()  {
        cy.visit("/register");
        cy.get('[data-id="nama-full"]').type(this.data.fullname);
        cy.get('[data-id="email"]').type(this.data.email);
        cy.get('[data-id="password"]').type(this.data.password);
        cy.get('[data-id="password-konfirmasi"]').type(this.data.passwordkonfirmasi);
        cy.get('[data-id="submit"]').click();
        cy.contains("Please Verify Your Email");
        cy.visit("http://localhost:8025");
        cy.contains("bilioke@gmail.com").click();
        cy.frameLoaded("#preview-html");
        cy.wait(500);
        cy.iframe()
            .find(".button")
            .should("have.text", "Verify Email Address")
            .invoke("removeAttr", "target")
            .click();
        cy.visit("http://localhost:8000/dashboard");
        cy.get('[data-id="nav-atas"]').click();
    });
})

describe('case negative register', () => {
    beforeEach(function()  {
        cy.resetDb();
        cy.fixture('scenarioRegister').then(function (data) {
            this.data = data;
          })
    });

    it("register input nama full kosong", function ()  {
        cy.visit("/register");
        cy.get('[data-id="email"]').type(this.data.email);
        cy.get('[data-id="password"]').type(this.data.password);
        cy.get('[data-id="password-konfirmasi"]').type(this.data.passwordkonfirmasi);
        cy.get('[data-id="submit"]').click();
        cy.get('.invalid-feedback')
    });

    it ("register input email kosong", function ()  {
        cy.visit("/register");
        cy.get('[data-id="nama-full"]').type(this.data.fullname);
        cy.get('[data-id="password"]').type(this.data.password);
        cy.get('[data-id="password-konfirmasi"]').type(this.data.passwordkonfirmasi);
        cy.get('[data-id="submit"]').click();
        cy.get('.invalid-feedback').invoke('prop', 'validationMessage');
    });

    it("register input email tidak memakai @ ", function ()  {
        cy.visit("/register");
        cy.get('[data-id="nama-full"]').type(this.data.fullname);
        cy.get('[data-id="email"]').type("biliokemaniagmail.com");
        cy.get('[data-id="password"]').type(this.data.password);
        cy.get('[data-id="password-konfirmasi"]').type(this.data.passwordkonfirmasi);
        cy.get('[data-id="submit"]').click();
        cy.get('input:invalid').invoke('prop', 'validationMessage');
    });

    it("register input password kosong", function ()  {
        cy.visit("/register");
        cy.get('[data-id="nama-full"]').type(this.data.fullname);
        cy.get('[data-id="email"]').type(this.data.email);
        cy.get('[data-id="password-konfirmasi"]').type(this.data.passwordkonfirmasi);
        cy.get('[data-id="submit"]').click();
        cy.get('.invalid-feedback')
    });

    it("register input password konfirmasi kosong", function ()  {
        cy.visit("/register");
        cy.get('[data-id="nama-full"]').type(this.data.fullname);
        cy.get('[data-id="email"]').type(this.data.email);
        cy.get('[data-id="password"]').type(this.data.passwordkonfirmasi);
        cy.get('[data-id="submit"]').click();
        cy.get('.invalid-feedback')
    });

    it("register input kosong", function ()  {
        cy.visit("/register");
        cy.get('[data-id="submit"]').click();
        cy.get('.invalid-feedback')
    });
})
