describe("case positive", function () {
    beforeEach(function () {
        cy.fixture("scenario").then(function (data) {
            this.data = data;
        });
    });

    it("create uraian resiko proyek", function () {
        cy.resetDb();
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("/master-table-management/uraian-resiko-proyek");
        cy.get('[data-id="tambah"]').click();
        cy.get('[data-id="resiko-proyek"]').click();
        cy.get('[data-id="resiko-proyek"]').type("Sangat Tinggi");
        cy.get('[data-id="submit"]').click();
        cy.get(".alert").contains("Tambah Data Uraian Resiko Proyek Sukses");
    });

    it("update uraian resiko proyek", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("/master-table-management/uraian-resiko-proyek");
        cy.get(":nth-child(3) > .page-link").click();
        cy.get('[data-id="edt-6"]').click();
        cy.get('[data-id="resiko-proyek"]').clear();
        cy.get('[data-id="resiko-proyek"]').type("Sangat Rendah");
        cy.get('[data-id="submit"]').click();
        cy.get(".alert").contains("Edit Data Uraian Resiko Proyek Sukses");
    });

    it("delete uraian resiko proyek yang tidak terikat kolom lain", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("/master-table-management/uraian-resiko-proyek");
        cy.get(":nth-child(3) > .page-link").click();
        cy.get('[data-id="del-6"]').click();
        cy.get(
            "#fire-modal-1 > .modal-dialog > .modal-content > .modal-footer > .btn-danger"
        ).click();
        cy.get(".alert").contains("Hapus Data Uraian Resiko Proyek Sukses");
    });

    it("pencarian uraian resiko proyek", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("/master-table-management/uraian-resiko-proyek");
        cy.get('[data-id="search"]').click();
        cy.get('[data-id="search-resiko-proyek"]').type("Koperasi");
        cy.get('[data-id="submit-search"]').click();
    });
});

describe("case negative", function () {
    beforeEach(function () {
        cy.fixture("scenario").then(function (data) {
            this.data = data;
        });
    });

    it("create uraian resiko proyek nama uraian resiko proyek input kosong", function () {
        cy.resetDb();
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("/master-table-management/uraian-resiko-proyek");
        cy.get('[data-id="tambah"]').click();
        cy.get('[data-id="resiko-proyek"]').click();
        cy.get('[data-id="submit"]').click();
        cy.get(".invalid-feedback");
    });

    it("create uraian resiko proyek nama uraian resiko proyek input karakter", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("/master-table-management/uraian-resiko-proyek");
        cy.get('[data-id="tambah"]').click();
        cy.get('[data-id="resiko-proyek"]').click();
        cy.get('[data-id="resiko-proyek"]').clear();
        cy.get('[data-id="resiko-proyek"]').type("@@@@@");
        cy.get('[data-id="submit"]').click();
        cy.get(".invalid-feedback");
    });

    it("create uraian resiko proyek nama uraian resiko proyek input angka", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("/master-table-management/uraian-resiko-proyek");
        cy.get('[data-id="tambah"]').click();
        cy.get('[data-id="resiko-proyek"]').click();
        cy.get('[data-id="resiko-proyek"]').clear();
        cy.get('[data-id="resiko-proyek"]').type("Gali oke23");
        cy.get('[data-id="submit"]').click();
        cy.get(".invalid-feedback");
    });

    it("create uraian resiko proyek nama uraian resiko proyek input unique", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("/master-table-management/uraian-resiko-proyek");
        cy.get('[data-id="tambah"]').click();
        cy.get('[data-id="resiko-proyek"]').click();
        cy.get('[data-id="resiko-proyek"]').clear();
        cy.get('[data-id="resiko-proyek"]').type("Rendah");
        cy.get('[data-id="submit"]').click();
        cy.get(".invalid-feedback");
    });

    it("update uraian resiko proyek nama uraian resiko proyek input kosong", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("/master-table-management/uraian-resiko-proyek");
        cy.get('[data-id="edt-1"]').click();
        cy.get('[data-id="resiko-proyek"]').click();
        cy.get('[data-id="resiko-proyek"]').clear();
        cy.get('[data-id="submit"]').click();
        cy.get(".invalid-feedback");
    });

    it("update uraian resiko proyek nama uraian resiko proyek input karakter", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("/master-table-management/uraian-resiko-proyek");
        cy.get('[data-id="edt-1"]').click();
        cy.get('[data-id="resiko-proyek"]').click();
        cy.get('[data-id="resiko-proyek"]').clear();
        cy.get('[data-id="resiko-proyek"]').type("@@@@@");
        cy.get('[data-id="submit"]').click();
        cy.get(".invalid-feedback");
    });

    it("update uraian resiko proyek nama uraian resiko proyek input angka", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("/master-table-management/uraian-resiko-proyek");
        cy.get('[data-id="edt-1"]').click();
        cy.get('[data-id="resiko-proyek"]').click();
        cy.get('[data-id="resiko-proyek"]').clear();
        cy.get('[data-id="resiko-proyek"]').type("Gali oke23");
        cy.get('[data-id="submit"]').click();
        cy.get(".invalid-feedback");
    });

    it("update uraian resiko proyek nama uraian resiko proyek input unique", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("/master-table-management/uraian-resiko-proyek");
        cy.get('[data-id="edt-2"]').click();
        cy.get('[data-id="resiko-proyek"]').click();
        cy.get('[data-id="resiko-proyek"]').clear();
        cy.get('[data-id="resiko-proyek"]').type("Rendah");
        cy.get('[data-id="submit"]').click();
        cy.get(".invalid-feedback");
    });

    it("delete uraian resiko proyek yang terikat kolom lain", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("/master-table-management/uraian-resiko-proyek");
        cy.get('[data-id="del-1"]').click();
        cy.contains("Yes").click();
        cy.get(".alert").contains(
            "Tidak Dapat Menghapus Uraian Resiko Proyek Yang Masih Digunakan Oleh Kolom Lain"
        );
    });

    it("pencarian uraian resiko proyek tidak ada didatabase", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("/master-table-management/uraian-resiko-proyek");
        cy.get('[data-id="search"]').click();
        cy.get('[data-id="search-resiko-proyek"]').type("DINACU");
        cy.get('[data-id="submit-search"]').click();
        cy.get(".table > tbody > :nth-child(2) > :nth-child(2)").should(
            "not.be.true"
        );
    });

    it("pencarian uraian resiko proyek kosong", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("/master-table-management/uraian-resiko-proyek");
        cy.get('[data-id="search"]').click();
        cy.get('[data-id="submit-search"]').click();
        cy.get(".table > tbody > tr > :nth-child(2)").should("be.visible");
    });
});
