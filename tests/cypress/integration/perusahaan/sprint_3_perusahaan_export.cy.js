describe("case positive", function () {
    beforeEach(function () {
        cy.fixture("scenario").then(function (data) {
            this.data = data;
        });
    });
    it("Export Excel Perusahaan", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("data-table-management/perusahaan");
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