describe("case positive", function () {
    beforeEach(function () {
        cy.fixture("scenario").then(function (data) {
            this.data = data;
        });
    });

    it("create kegiatan usaha", function () {
        cy.resetDb();
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("/master-table-management/kegiatan-usaha");
        cy.get('[data-id="tambah"]').click();
        cy.get('[data-id="nama-kegiatan-usaha"]').clear("CVO");
        cy.get('[data-id="nama-kegiatan-usaha"]').type("CVO");
        cy.get('[data-id="submit"]').click();
        cy.get(".alert").contains("Tambah Data Kegiatan Usaha Sukses");
    });

    it("update kegiatan usaha", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("/master-table-management/kegiatan-usaha");
        cy.get('[data-id="edt-4"]').click();
        cy.get('[data-id="nama-kegiatan-usaha"]').clear("Ketela Pisang ");
        cy.get('[data-id="nama-kegiatan-usaha"]').type("Ketela Pisang Goreng");
        cy.get('[data-id="submit"]').click();
        cy.get(".alert").contains("Edit Data Kegiatan Usaha Sukses");
    });

    it("delete kegiatan usaha", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("/master-table-management/kegiatan-usaha");
        cy.get('[data-id="del-1"]').click();
        cy.contains("Yes").click();
        cy.get(".alert").contains("Hapus Data Kegiatan Usaha Sukses");
    });

    it("pencarian kegiatan usaha", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("/master-table-management/kegiatan-usaha");
        cy.get('[data-id="search"]').click();
        cy.get('[data-id="search-kegiatan-usaha"]').type("IUM");
        cy.get('[data-id="submit-search"]').click();
    });
});

describe("case negative", function () {
    beforeEach(function () {
        cy.fixture("scenario").then(function (data) {
            this.data = data;
        });
    });
    it("create kegiatan usaha input angka", function () {
        cy.resetDb();
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("/master-table-management/kegiatan-usaha");
        cy.get('[data-id="tambah"]').click();
        cy.get('[data-id="nama-kegiatan-usaha"]').type("Ketela Pisang123");
        cy.get('[data-id="submit"]').click();
        cy.get(".invalid-feedback");
    });

    it("create kegiatan usaha input karakter", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("/master-table-management/kegiatan-usaha");
        cy.get('[data-id="tambah"]').click();
        cy.get('[data-id="nama-kegiatan-usaha"]').type("Ketela Pisang@!");
        cy.get('[data-id="submit"]').click();
        cy.get(".invalid-feedback");
    });

    it("create kegiatan usaha input min 3 huruf", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("/master-table-management/kegiatan-usaha");
        cy.get('[data-id="tambah"]').click();
        cy.get('[data-id="nama-kegiatan-usaha"]').type("Ke");
        cy.get('[data-id="submit"]').click();
        cy.get(".invalid-feedback");
    });

    it("create kegiatan usaha input kosong", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("/master-table-management/kegiatan-usaha");
        cy.get('[data-id="tambah"]').click();
        cy.get('[data-id="submit"]').click();
        cy.get(".invalid-feedback");
    });

    it("update kegiatan usaha input menggunakan angka", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("/master-table-management/kegiatan-usaha");
        cy.get('[data-id="edt-1"]').click();
        cy.get('[data-id="nama-kegiatan-usaha"]').clear("Ketela Pisang ");
        cy.get('[data-id="nama-kegiatan-usaha"]').type(
            "Ketela Pisang Goreng123"
        );
        cy.get('[data-id="submit"]').click();
        cy.get(".invalid-feedback");
    });

    it("update kegiatan usaha input menggunakan karakter", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("/master-table-management/kegiatan-usaha");
        cy.get('[data-id="edt-1"]').click();
        cy.get('[data-id="nama-kegiatan-usaha"]').clear("Ketela Pisang ");
        cy.get('[data-id="nama-kegiatan-usaha"]').type(
            "Ketela Pisang Goreng!@"
        );
        cy.get('[data-id="submit"]').click();
        cy.get(".invalid-feedback");
    });

    it("update kegiatan usaha input kosong", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("/master-table-management/kegiatan-usaha");
        cy.get('[data-id="edt-1"]').click();
        cy.get('[data-id="nama-kegiatan-usaha"]').clear("Ketela Pisang ");
        cy.get('[data-id="submit"]').click();
        cy.get(".invalid-feedback");
    });

    it("update kegiatan usaha input min 3 huruf", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("/master-table-management/kegiatan-usaha");
        cy.get('[data-id="edt-1"]').click();
        cy.get('[data-id="nama-kegiatan-usaha"]').clear("Ketela Pisang ");
        cy.get('[data-id="nama-kegiatan-usaha"]').type("Ke");
        cy.get('[data-id="submit"]').click();
        cy.get(".invalid-feedback");
    });

    it("pencarian kegiatan usaha tidak ada didatabase", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("/master-table-management/kegiatan-usaha");
        cy.get('[data-id="search"]').click();
        cy.get('[data-id="search-kegiatan-usaha"]').type("IUM/0");
        cy.get('[data-id="submit-search"]').click();
        cy.get(".table > tbody > tr > :nth-child(2)").should("be.visible");
    });

    it("pencarian kegiatan usaha kosong", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("/master-table-management/kegiatan-usaha");
        cy.get('[data-id="search"]').click();
        cy.get(".table > tbody > tr > :nth-child(2)").should("be.visible");
    });
});
