describe("case positive", function () {
    beforeEach(function () {
        cy.fixture("scenario").then(function (data) {
            this.data = data;
        });
    });

    it("create uraian skala usaha", function () {
        cy.resetDb();
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("/master-table-management/uraian-skala-usaha");
        cy.get('[data-id="tambah"]').click();
        cy.get('[data-id="skala-usaha"]').click();
        cy.get('[data-id="skala-usaha"]').type("Usaha Sertifikat");
        cy.get('[data-id="submit"]').click();
        cy.get(".alert").contains("Tambah Data Uraian Skala Usaha Sukses");
    });

    it("update uraian skala usaha", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.get(".navbar-nav > :nth-child(1) > .nav-link > .fas").click();
        cy.visit("/master-table-management/uraian-skala-usaha");
        cy.get(":nth-child(3) > .page-link").click();
        cy.get('[data-id="edt-6"]').click();
        cy.get('[data-id="skala-usaha"]').clear();
        cy.get('[data-id="skala-usaha"]').type("Usaha UMKM");
        cy.get('[data-id="submit"]').click();
        cy.get(".alert").contains("Edit Data Uraian Skala Usaha Sukses");
    });

    it("delete uraian skala usaha yang tidak terikat kolom lain", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.get(".navbar-nav > :nth-child(1) > .nav-link > .fas").click();
        cy.visit("/master-table-management/uraian-skala-usaha");
        cy.get(":nth-child(3) > .page-link").click();
        cy.get('[data-id="del-6"]').click();
        cy.get(
            "#fire-modal-1 > .modal-dialog > .modal-content > .modal-footer > .btn-danger"
        ).click();
        cy.get(".alert").contains("Hapus Data Uraian Skala Usaha Sukses");
    });

    it("pencarian uraian skala usaha", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("/master-table-management/uraian-skala-usaha");
        cy.get('[data-id="search"]').click();
        cy.get('[data-id="search-skala-usaha"]').type("Usaha Menengah");
        cy.get('[data-id="submit-search"]').click();
    });
});

describe("case negative", function () {
    beforeEach(function () {
        cy.fixture("scenario").then(function (data) {
            this.data = data;
        });
    });

    it("create uraian skala usaha nama uraian skala usaha input kosong", function () {
        cy.resetDb();
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("/master-table-management/uraian-skala-usaha");
        cy.get('[data-id="tambah"]').click();
        cy.get('[data-id="skala-usaha"]').click();
        cy.get('[data-id="submit"]').click();
        cy.get(".invalid-feedback");
    });

    it("create uraian skala usaha nama uraian skala usaha input karakter", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("/master-table-management/uraian-skala-usaha");
        cy.get('[data-id="tambah"]').click();
        cy.get('[data-id="skala-usaha"]').click();
        cy.get('[data-id="skala-usaha"]').type("@@@@@");
        cy.get('[data-id="submit"]').click();
        cy.get(".invalid-feedback");
    });

    it("create uraian skala usaha nama uraian skala usaha input angka", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("/master-table-management/uraian-skala-usaha");
        cy.get('[data-id="tambah"]').click();
        cy.get('[data-id="skala-usaha"]').click();
        cy.get('[data-id="skala-usaha"]').type("Gali oke23");
        cy.get('[data-id="submit"]').click();
        cy.get(".invalid-feedback");
    });

    it("create uraian skala usaha nama uraian skala usaha input unique", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("/master-table-management/uraian-skala-usaha");
        cy.get('[data-id="tambah"]').click();
        cy.get('[data-id="skala-usaha"]').click();
        cy.get('[data-id="skala-usaha"]').type("Usaha Menengah");
        cy.get('[data-id="submit"]').click();
        cy.get(".invalid-feedback");
    });

    it("create uraian skala usaha nama uraian skala usaha input kosong", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("/master-table-management/uraian-skala-usaha");
        cy.get('[data-id="tambah"]').click();
        cy.get('[data-id="skala-usaha"]').click();
        cy.get('[data-id="submit"]').click();
        cy.get(".invalid-feedback");
    });

    it("update uraian skala usaha nama uraian skala usaha input karakter", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("/master-table-management/uraian-skala-usaha");
        cy.get('[data-id="edt-1"]').click();
        cy.get('[data-id="skala-usaha"]').click();
        cy.get('[data-id="skala-usaha"]').clear();
        cy.get('[data-id="skala-usaha"]').type("@@@@@");
        cy.get('[data-id="submit"]').click();
        cy.get(".invalid-feedback");
    });

    it("update uraian skala usaha nama uraian skala usaha input angka", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("/master-table-management/uraian-skala-usaha");
        cy.get('[data-id="edt-1"]').click();
        cy.get('[data-id="skala-usaha"]').click();
        cy.get('[data-id="skala-usaha"]').clear();
        cy.get('[data-id="skala-usaha"]').type("Gali oke23");
        cy.get('[data-id="submit"]').click();
        cy.get(".invalid-feedback");
    });

    it("update uraian skala usaha nama uraian skala usaha input unique", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("/master-table-management/uraian-skala-usaha");
        cy.get('[data-id="edt-1"]').click();
        cy.get('[data-id="skala-usaha"]').click();
        cy.get('[data-id="skala-usaha"]').clear();
        cy.get('[data-id="skala-usaha"]').type("Usaha Menengah");
        cy.get('[data-id="submit"]').click();
        cy.get(".invalid-feedback");
    });

    it("delete uraian skala usaha yang terikat kolom lain", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.get(".navbar-nav > :nth-child(1) > .nav-link > .fas").click();
        cy.visit("/master-table-management/uraian-skala-usaha");
        cy.get('[data-id="del-1"]').click();
        cy.contains("Yes").click();
        cy.get(".alert").contains(
            "Tidak Dapat Menghapus Uraian Skala Usaha Yang Masih Digunakan Oleh Kolom Lain"
        );
    });

    it("pencarian uraian skala usaha tidak ada didatabase", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("/master-table-management/uraian-skala-usaha");
        cy.get('[data-id="search"]').click();
        cy.get('[data-id="search-skala-usaha"]').type("DINACU");
        cy.get('[data-id="submit-search"]').click();
        cy.get(".table > tbody > :nth-child(2) > :nth-child(2)").should(
            "not.be.true"
        );
    });

    it("pencarian uraian skala usaha kosong", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("/master-table-management/uraian-skala-usaha");
        cy.get('[data-id="search"]').click();
        cy.get('[data-id="submit-search"]').click();
        cy.get(".table > tbody > tr > :nth-child(2)").should("be.visible");
    });
});
