describe("case positive", function () {
    beforeEach(function () {
        cy.fixture("scenario").then(function (data) {
            this.data = data;
        });
    });
    it.only("Export Excel Status Perusahaan", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.get(".navbar-nav > :nth-child(1) > .nav-link > .fas").click();
        cy.get(":nth-child(6) > .has-dropdown > span").click();
        cy.get(".active > .dropdown-menu > :nth-child(3) > .nav-link").click();
        cy.window()
            .document()
            .then(function (doc) {
                doc.addEventListener("click", function () {
                    setTimeout(function () {
                        doc.location.reload();
                    }, 500);
                });
                cy.get('[data-id="export"]').click();
            });
    });
});
