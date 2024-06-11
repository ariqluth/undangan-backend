describe("case positive", function () {
    beforeEach(function () {
    });
    it("Export Excel jenis usaha", function () {
        cy.resetDb();
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type("superadmin@gmail.com");
        cy.get('[data-id="inputPassword"]').type("password");
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("/master-table-management/jenis-usaha");
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
