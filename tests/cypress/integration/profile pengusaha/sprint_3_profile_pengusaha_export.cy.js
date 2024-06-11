describe("case positive", function () {
    beforeEach(function () {
        cy.fixture("scenario").then(function (data) {
            this.data = data;
        });
    });
    it("Export Excel profile pengusaha", function () {
        cy.resetDb();
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("data-table-management/profile-pengusaha");
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
