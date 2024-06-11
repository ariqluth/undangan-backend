Cypress.Commands.add("resetDb", () => {
    if (Cypress.env("server") == "sail") {
        cy.exec("./vendor/bin/sail artisan migrate:fresh --seed");
    }
    if (Cypress.env("server") == "php") {
        cy.exec("php artisan migrate:fresh --seed");
    }
});

Cypress.Commands.add("openEmail", () => {
    cy.visit("http://localhost:" + Cypress.env("emailPort") + "/");
});
