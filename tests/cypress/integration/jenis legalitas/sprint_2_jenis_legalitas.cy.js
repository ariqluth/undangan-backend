import scenario from "../../fixture/scenario.json";
describe("case positive", function () {
    beforeEach(function () {
        cy.fixture("scenario").then(function (data) {
            this.data = data;
        });
    });
    it("create jenis legalitas", function () {
        cy.resetDb();
        cy.visit("/");
        cy.get(' [data-id="inputEmail"]').type(this.data.email);
        cy.get(' [data-id="inputPassword"] ').type(this.data.password);
        cy.get(' [data-id="buttonLogin"]').click();
        cy.visit("/master-table-management/jenis-legalitas");
        cy.get(' [data-id="tambah"]').click();
        cy.get(' [data-id="nama-jenis-legalitas"]').type("CVO");
        cy.get(' [data-id="submit"]').click();
        cy.get(".alert").contains("Tambah Data Jenis Legalitas Sukses");
    });

    it("update jenis legalitas", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("/master-table-management/jenis-legalitas");
        cy.get('[data-id="edt-2"]').click();
        cy.get('[data-id="nama-jenis-legalitas"]').clear("IUM");
        cy.get('[data-id="nama-jenis-legalitas"]').type("IUMS");
        cy.get('[data-id="submit"]').click();
        cy.get(".alert").contains("Edit Data Jenis Legalitas Sukses");
    });

    it("delete jenis legalitas", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("/master-table-management/jenis-legalitas");
        cy.get('[data-id="del-1"]').click();
        cy.contains("Yes").click();
        cy.get(".alert").contains("Hapus Data Jenis Legalitas Sukses");
    });

    it("pencarian jenis legalitas", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("/master-table-management/jenis-legalitas");
        cy.get('[data-id="search"]').click();
        cy.get('[data-id="search_jenis_legalitas"]').type("IUM");
        cy.get('[data-id="submit-search"]').click();
    });
});

describe("case negative", function () {
    beforeEach(function () {
        cy.fixture("scenario").then(function (data) {
            this.data = data;
        });
    });
    it("create jenis legalitas input kosong", function () {
        cy.resetDb();
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("/master-table-management/jenis-legalitas");
        cy.get('[data-id="tambah"]').click();
        cy.get('[data-id="submit"]').click();
        cy.get(".invalid-feedback");
    });

    it("update jenis legalitas input kosong", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("/master-table-management/jenis-legalitas");
        cy.get('[data-id="edt-1"]').click();
        cy.get('[data-id="nama-jenis-legalitas"]').clear("IUM");
        cy.get('[data-id="submit"]').click();
        cy.get(".invalid-feedback");
    });

    it("pencarian jenis legalitas tidak ada didatabase", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("/master-table-management/jenis-legalitas");
        cy.get('[data-id="search"]').click();
        cy.get('[data-id="search_jenis_legalitas"]').type("IUM/0");
        cy.get('[data-id="submit-search"]').click();
        cy.get(".table > tbody > tr > :nth-child(2)").should("be.visible");
    });

    it("pencarian jenis legalitas kosong", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("/master-table-management/jenis-legalitas");
        cy.get('[data-id="search"]').click();
        cy.get(".table > tbody > tr > :nth-child(2)").should("be.visible");
    });
});
