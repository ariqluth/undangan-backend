describe("case positive", function () {
    beforeEach(function () {
        cy.fixture("scenario").then(function (data) {
            this.data = data;
        });
    });

    it("create uraian jenis perusahaan", function () {
        cy.resetDb();
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("/master-table-management/uraian-jenis-perusahaan");
        cy.get('[data-id="tambah"]').click();
        cy.get('[data-id="jenis-perusahaan"]').click();
        cy.get('[data-id="jenis-perusahaan"]').type("Kelompok");
        cy.get('[data-id="submit"]').click();
        cy.get(".alert").contains("Tambah Data Uraian Jenis Perusahaan Sukses");
    });

    it("update uraian jenis perusahaan", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("/master-table-management/uraian-jenis-perusahaan");
        cy.get(":nth-child(3) > .page-link").click();
        cy.get('[data-id="edt-7"]').click();
        cy.get('[data-id="jenis-perusahaan"]').clear();
        cy.get('[data-id="jenis-perusahaan"]').type("Bersama");
        cy.get('[data-id="submit"]').click();
        cy.get(".alert").contains("Edit Data Uraian Jenis Perusahaan Sukses");
    });

    it("delete uraian jenis perusahaan yang tidak terikat kolom lain", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("/master-table-management/uraian-jenis-perusahaan");
        cy.get(":nth-child(3) > .page-link").click();
        cy.get('[data-id="del-6"]').click();
        cy.get(
            "#fire-modal-1 > .modal-dialog > .modal-content > .modal-footer > .btn-danger"
        ).click();
        cy.get(".alert").contains("Hapus Data Uraian Jenis Perusahaan Sukses");
    });

    it("pencarian uraian jenis perusahaan", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("/master-table-management/uraian-jenis-perusahaan");
        cy.get('[data-id="search"]').click();
        cy.get('[data-id="search-jenis-perusahaan"]').type("Koperasi");
        cy.get('[data-id="submit-search"]').click();
    });
});

describe("case negative", function () {
    beforeEach(function () {
        cy.fixture("scenario").then(function (data) {
            this.data = data;
        });
    });

    it("create uraian jenis perusahaan nama uraian jenis perusahaan input kosong", function () {
        cy.resetDb();
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("/master-table-management/uraian-jenis-perusahaan");
        cy.get('[data-id="tambah"]').click();
        cy.get('[data-id="jenis-perusahaan"]').click();
        cy.get('[data-id="submit"]').click();
        cy.get(".invalid-feedback");
    });

    it("create uraian jenis perusahaan nama uraian jenis perusahaan input karakter", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("/master-table-management/uraian-jenis-perusahaan");
        cy.get('[data-id="tambah"]').click();
        cy.get('[data-id="jenis-perusahaan"]').click();
        cy.get('[data-id="jenis-perusahaan"]').type("@@@@@");
        cy.get('[data-id="submit"]').click();
        cy.get(".invalid-feedback");
    });

    it("create uraian jenis perusahaan nama uraian jenis perusahaan input angka", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("/master-table-management/uraian-jenis-perusahaan");
        cy.get('[data-id="tambah"]').click();
        cy.get('[data-id="jenis-perusahaan"]').click();
        cy.get('[data-id="jenis-perusahaan"]').type("Gali oke23");
        cy.get('[data-id="submit"]').click();
        cy.get(".invalid-feedback");
    });

    it("create uraian jenis perusahaan nama uraian jenis perusahaan input unique", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("/master-table-management/uraian-jenis-perusahaan");
        cy.get('[data-id="tambah"]').click();
        cy.get('[data-id="jenis-perusahaan"]').click();
        cy.get('[data-id="jenis-perusahaan"]').type("Perorangan");
        cy.get('[data-id="submit"]').click();
        cy.get(".invalid-feedback");
    });

    it("update uraian jenis perusahaan kosong", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("/master-table-management/uraian-jenis-perusahaan");
        cy.get('[data-id="edt-1"]').click();
        cy.get('[data-id="jenis-perusahaan"]').clear();
        cy.get('[data-id="submit"]').click();
        cy.get(".invalid-feedback");
    });

    it("update uraian jenis perusahaan dengan karakter", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("/master-table-management/uraian-jenis-perusahaan");
        cy.get('[data-id="edt-1"]').click();
        cy.get('[data-id="jenis-perusahaan"]').clear();
        cy.get('[data-id="jenis-perusahaan"]').type("Bersama@");
        cy.get('[data-id="submit"]').click();
        cy.get(".invalid-feedback");
    });

    it("update uraian jenis perusahaan dengan angka", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("/master-table-management/uraian-jenis-perusahaan");
        cy.get('[data-id="edt-1"]').click();
        cy.get('[data-id="jenis-perusahaan"]').clear();
        cy.get('[data-id="jenis-perusahaan"]').type("Bersama1");
        cy.get('[data-id="submit"]').click();
        cy.get(".invalid-feedback");
    });

    it("update uraian jenis perusahaan dengan unique", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("/master-table-management/uraian-jenis-perusahaan");
        cy.get('[data-id="edt-1"]').click();
        cy.get('[data-id="jenis-perusahaan"]').clear();
        cy.get('[data-id="jenis-perusahaan"]').type("Badan Hukum Lainnya");
        cy.get('[data-id="submit"]').click();
        cy.get(".invalid-feedback");
    });

    it("delete uraian jenis perusahaan yang terikat kolom lain", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("/master-table-management/uraian-jenis-perusahaan");
        cy.get('[data-id="del-1"]').click();
        cy.contains("Yes").click();
        cy.get(".alert").contains(
            "Tidak Dapat Menghapus Uraian Jenis Perusahaan Yang Masih Digunakan Oleh Kolom Lain"
        );
    });

    it("pencarian uraian jenis perusahaan tidak ada didatabase", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("/master-table-management/uraian-jenis-perusahaan");
        cy.get('[data-id="search"]').click();
        cy.get('[data-id="search-jenis-perusahaan"]').type("DINACU");
        cy.get('[data-id="submit-search"]').click();
        cy.get(".table > tbody > :nth-child(2) > :nth-child(2)").should(
            "not.be.true"
        );
    });

    it("pencarian uraian jenis perusahaan kosong", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("/master-table-management/uraian-jenis-perusahaan");
        cy.get('[data-id="search"]').click();
        cy.get('[data-id="submit-search"]').click();
        cy.get(".table > tbody > tr > :nth-child(2)").should("be.visible");
    });
});
