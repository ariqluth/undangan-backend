describe('case positive', function () {
    beforeEach(function () {
    cy.fixture('scenario').then(function (data) {
        this.data = data;
      })
    })
    it('Export Excel Kegiatan Usaha', function () {
        cy.resetDb();
        cy.visit('/')
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit('/master-table-management/kegiatan-usaha');
        cy.window().document().then(function (doc) {
            doc.addEventListener('click', function () {
              setTimeout(function () { doc.location.reload() }, 500)
            })
            cy.get('[data-id="export"]').click();
        })
    });
})
