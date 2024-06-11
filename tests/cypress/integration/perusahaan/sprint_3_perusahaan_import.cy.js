import "cypress-file-upload";
const fileName = "Perusahaan.xlsx";
const filePath = "1.jpg";

describe("case positive", function () {
    beforeEach(function () {
        cy.resetDb();
        cy.fixture("scenario").then(function (data) {
            this.data = data;
        });
    });

    it("import data perusahaan", function () {
        cy.intercept({ method: "POST" });
        cy.intercept({
            method: "POST",
            url: "perusahaan.import",
        }).as("#file-upload");

        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("data-table-management/perusahaan");
        cy.get('[data-id="import"]').click();
        cy.wait(500);
        cy.fixture(fileName, "binary")
            .then(Cypress.Blob.binaryStringToBlob)
            .then((fileContent) => {
                cy.get('[data-id="send-import"]').attachFile({
                    fileContent,
                    fileName,
                    mimeType:
                        "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet",
                    encoding: "utf8",
                    lastModified: new Date().getTime(),
                });
            });
        cy.get(".footer > .btn").click();
    });
});

describe("case negative", function () {
    beforeEach(function () {
        cy.fixture("scenario").then(function (data) {
            this.data = data;
        });
    });
    it("import data perusahaan file salah", function () {
        cy.intercept({ method: "POST" });
        cy.intercept({
            method: "POST",
            url: "perusahaan.import",
        }).as("#file-upload");
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("data-table-management/perusahaan");
        cy.get('[data-id="import"]').click();
        cy.wait(500);
        cy.fixture(fileName, "binary")
            .then(Cypress.Blob.binaryStringToBlob)
            .then((fileContent) => {
                cy.get('[data-id="send-import"]').attachFile({
                    fileContent,
                    fileName,
                    mimeType:
                        "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet",
                    encoding: "utf8",
                    lastModified: new Date().getTime(),
                });
            });
        cy.get('[data-id="submit-import"]').click();
    });

    it("import data perusahaan tidak masukan input", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("data-table-management/perusahaan");
        cy.get('[data-id="import"]').click();
        cy.wait(500);
        cy.get('[data-id="send-import"]').click();
        cy.wait(500);
        cy.get('[data-id="submit-import"]').click();
        cy.get('[data-id="import"]').click();
        cy.get(".invalid-feedback");
    });
});
