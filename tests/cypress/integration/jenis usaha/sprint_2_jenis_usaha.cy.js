describe("case positive", function () {
    beforeEach(function () {

        cy.fixture("scenario").then(function (data) {
            this.data = data;
        });
    });

    it("create jenis usaha", function () {
        cy.resetDb();
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("/master-table-management/jenis-usaha");
        cy.get('[data-id="tambah"]').click();
        cy.get('[data-id="nama-jenis-usaha"]').type("Ketela Pisang");
        cy.get('[data-id="submit"]').click();
        cy.get(".alert").contains("Tambah Data Jenis Usaha Sukses");
    });

    it("update jenis usaha", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("/master-table-management/jenis-usaha");
        cy.get('[data-id="edt-1"]').click();
        cy.get('[data-id="nama-jenis-usaha"]').clear("Ketela Pisang ");
        cy.get('[data-id="nama-jenis-usaha"]').type("Ketela Pisang Goreng");
        cy.get('[data-id="submit"]').click();
        cy.get(".alert").contains("Edit Data Jenis Usaha Sukses");
    });

    it("delete jenis usaha", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("/master-table-management/jenis-usaha");
        cy.get('[data-id="del-1"]').click();
        cy.contains("Yes").click();
        cy.get(".alert").contains("Hapus Data Jenis Usaha Sukses");
    });

    it("pencarian jenis usaha", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("/master-table-management/jenis-usaha");
        cy.get('[data-id="search"]').click();
        cy.get('[data-id="search-jenis-usaha"]').type("Abon");
        cy.get('[data-id="submit-search"]').click();
    });
});

describe("case negative", function () {
    beforeEach(function () {
        cy.fixture("scenario").then(function (data) {
            this.data = data;
        });
    });
    it("create jenis usaha input angka", function () {
        cy.resetDb();
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("/master-table-management/jenis-usaha");
        cy.get('[data-id="tambah"]').click();
        cy.get('[data-id="nama-jenis-usaha"]').type("Ketela Pisang123");
        cy.get('[data-id="submit"]').click();
        cy.get(".invalid-feedback");
    });

    it("create jenis usaha input karakter", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("/master-table-management/jenis-usaha");
        cy.get('[data-id="tambah"]').click();
        cy.get('[data-id="nama-jenis-usaha"]').type("Ketela Pisang@!");
        cy.get('[data-id="submit"]').click();
        cy.get(".invalid-feedback");
    });

    it("create jenis usaha input kosong", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("/master-table-management/jenis-usaha");
        cy.get('[data-id="tambah"]').click();
        cy.get('[data-id="submit"]').click();
        cy.get(".invalid-feedback");
    });

    it("update jenis usaha input menggunakan angka", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("/master-table-management/jenis-usaha");
        cy.get('[data-id="edt-1"]').click();
        cy.get('[data-id="nama-jenis-usaha"]').clear("Ketela Pisang ");
        cy.get('[data-id="nama-jenis-usaha"]').type("Ketela Pisang Goreng123");
        cy.get('[data-id="submit"]').click();
        cy.get(".invalid-feedback");
    });

    it("update jenis usaha input menggunakan karakter", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("/master-table-management/jenis-usaha");
        cy.get('[data-id="edt-1"]').click();
        cy.get('[data-id="nama-jenis-usaha"]').clear("Ketela Pisang ");
        cy.get('[data-id="nama-jenis-usaha"]').type("Ketela Pisang Goreng!@");
        cy.get('[data-id="submit"]').click();
        cy.get(".invalid-feedback");
    });

    it("update jenis usaha input kosong", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("/master-table-management/jenis-usaha");
        cy.get('[data-id="edt-1"]').click();
        cy.get('[data-id="nama-jenis-usaha"]').clear("Ketela Pisang ");
        cy.get('[data-id="submit"]').click();
        cy.get(".invalid-feedback");
    });

    it("pencarian jenis usaha tidak ada didatabase", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("/master-table-management/jenis-usaha");
        cy.get('[data-id="search"]').click();
        cy.get('[data-id="search-jenis-usaha"]').type("Abon123");
        cy.get('[data-id="submit-search"]').click();
        cy.get(".table > tbody > tr > :nth-child(2)").should("be.visible");
    });

    it("pencarian jenis usaha kosong", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("/master-table-management/jenis-usaha");
        cy.get('[data-id="search"]').click();
        cy.get(".table > tbody > tr > :nth-child(2)").should("be.visible");
    });
});
