describe("positive case", function () {
    beforeEach(function () {
        cy.fixture("scenario").then(function (data) {
            this.data = data;
        });
    });

    it("create kecamatan", function () {
        cy.resetDb();
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("/master-table-management/kecamatan/");
        cy.get('[data-id="tambah"]').click();
        cy.get('[data-id="select-kabupaten"]')
            .select("1", { force: true })
            .should("have.value", "1");
        cy.get('[data-id="nama-kecamatan"]').type("lowokwaru");
        cy.get('[data-id="submit"]').click();
        cy.get(".alert").contains("Tambah Data Kecamatan Sukses");
    });

    it("edit kecamatan", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("/master-table-management/kecamatan/");
        cy.get('[data-id="edt-1"]').click();
        cy.get('[data-id="select-kabupaten"]')
            .select("1", { force: true })
            .should("have.value", "1");
        cy.get('[data-id="nama-kecamatan"]').clear("arjosari");
        cy.get('[data-id="nama-kecamatan"]').type("GajahMada");
        cy.get('[data-id="submit"]').click();
        cy.get(".alert").contains("Edit Data Kecamatan Sukses");
    });

    it("hapus kacamatan yang tidak terikat kolom lain", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("/master-table-management/kecamatan/");
        cy.get(":nth-child(4) > .page-link").click();
        cy.get('[data-id="del-13"]').click();
        cy.get(
            "#fire-modal-3 > .modal-dialog > .modal-content > .modal-footer > .btn-danger"
        ).click();
        cy.get(".alert").contains("Hapus Data Kecamatan Sukses");
    });

    it("pencarian kecamatan input kabupaten", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("/master-table-management/kecamatan/");
        cy.get('[data-id="search"]').click();
        cy.get('[data-id="search-kabupaten"]').type("pacitan");
        cy.get('[data-id="submit-search"]').click();
    });

    it("pencarian kecamatan input kecamatan", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("/master-table-management/kecamatan/");
        cy.get('[data-id="search"]').click();
        cy.get('[data-id="search-kecamatan"]').type("arjosari");
        cy.get('[data-id="submit-search"]').click();
    });

    it("pencarian kecamatan input kabupaten dan kecamatan", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("/master-table-management/kecamatan/");
        cy.get('[data-id="search"]').click();
        cy.get('[data-id="search-kabupaten"]').type("pacitan");
        cy.get('[data-id="search-kecamatan"]').type("arjosari");
        cy.get('[data-id="submit-search"]').click();
    });
});

describe("negative case", function () {
    beforeEach(function () {
        cy.fixture("scenario").then(function (data) {
            this.data = data;
        });
    });
    it("create kecamatan input kecamatan mengunakan angka", function () {
        cy.resetDb();
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.get(".navbar-nav > :nth-child(1) > .nav-link > .fas").click();
        cy.get(":nth-child(5) > .has-dropdown > span").click();
        cy.get(".active > .dropdown-menu > :nth-child(2) > .nav-link").click();
        cy.get('[data-id="tambah"]').click();
        cy.get('[data-id="select-kabupaten"]')
            .select("1", { force: true })
            .should("have.value", "1");
        cy.get('[data-id="nama-kecamatan"]').type("lowokwaru123");
        cy.get('[data-id="submit"]').click();
        cy.get(".invalid-feedback");
    });

    it("create kecamatan input kecamatan mengunakan spasi", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("/master-table-management/kecamatan/");
        cy.get('[data-id="tambah"]').click();
        cy.get('[data-id="select-kabupaten"]')
            .select("1", { force: true })
            .should("have.value", "1");
        cy.get('[data-id="nama-kecamatan"]').type("lowokwaru raya");
        cy.get('[data-id="submit"]').click();
        cy.get(".invalid-feedback");
    });

    it("create kecamatan input kecamatan mengunakan sama table", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("/master-table-management/kecamatan/");
        cy.get('[data-id="tambah"]').click();
        cy.get('[data-id="select-kabupaten"]')
            .select("1", { force: true })
            .should("have.value", "1");
        cy.get('[data-id="nama-kecamatan"]').type("Donorojo");
        cy.get('[data-id="submit"]').click();
        cy.get(".invalid-feedback");
    });

    it("create kecamatan input kecamatan kosong", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("/master-table-management/kecamatan/");
        cy.get('[data-id="tambah"]').click();
        cy.get('[data-id="select-kabupaten"]')
            .select("1", { force: true })
            .should("have.value", "1");
        cy.get('[data-id="submit"]').click();
        cy.get(".invalid-feedback");
    });

    it("create kecamatan input kabupaten kosong", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("/master-table-management/kecamatan/");
        cy.get('[data-id="tambah"]').click();
        cy.get('[data-id="nama-kecamatan"]').type("lowokwaru");
        cy.get('[data-id="submit"]').click();
        cy.get(".invalid-feedback");
    });

    it("create kecamatan input kosong", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("/master-table-management/kecamatan/");
        cy.get('[data-id="tambah"]').click();
        cy.get('[data-id="submit"]').click();
        cy.get(".invalid-feedback");
    });

    it("edit kecamatan input kecamatan menggunakan angka", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("/master-table-management/kecamatan/");
        cy.get('[data-id="edt-1"]').click();
        cy.get('[data-id="select-kabupaten"]')
            .select("1", { force: true })
            .should("have.value", "1");
        cy.get('[data-id="nama-kecamatan"]').clear("arjosari");
        cy.get('[data-id="nama-kecamatan"]').type("lowokwaru123");
        cy.get('[data-id="submit"]').click();
        cy.get(".invalid-feedback");
    });

    it("edit kecamatan input kecamatan menggunakan spasi", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("/master-table-management/kecamatan/");
        cy.get('[data-id="edt-1"]').click();
        cy.get('[data-id="select-kabupaten"]')
            .select("1", { force: true })
            .should("have.value", "1");
        cy.get('[data-id="nama-kecamatan"]').clear("arjosari");
        cy.get('[data-id="nama-kecamatan"]').type("lowokwaru kota");
        cy.get('[data-id="submit"]').click();
        cy.get(".invalid-feedback");
    });

    it("edit kecamatan input kecamatan kosong", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("/master-table-management/kecamatan/");
        cy.get('[data-id="edt-1"]').click();
        cy.get('[data-id="select-kabupaten"]')
            .select("1", { force: true })
            .should("have.value", "1");
        cy.get('[data-id="nama-kecamatan"]').clear("arjosari");
        cy.get('[data-id="submit"]').click();
        cy.get(".invalid-feedback");
    });

    it("hapus kacamatan yang terikat kolom lain", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("/master-table-management/kecamatan/");
        cy.get('[data-id="del-1"]').click();
        cy.contains("Yes").click();
        cy.get(".alert").contains(
            "Tidak Dapat Menghapus Kecamatan Yang Masih Digunakan Oleh Kolom Lain"
        );
    });

    it("pencarian kecamatan input kabupaten tidak ada didatabase", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("/master-table-management/kecamatan/");
        cy.get('[data-id="search"]').click();
        cy.get('[data-id="search-kecamatan"]').type("pacitan123");
        cy.get('[data-id="submit-search"]').click();
        cy.get(".table > tbody > :nth-child(2) > :nth-child(2)").should(
            "not.be.true"
        );
    });

    it("pencarian kecamatan input kecamatan tidak ada didatabase", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("/master-table-management/kecamatan/");
        cy.get('[data-id="search"]').click();
        cy.get('[data-id="search-kecamatan"]').type("arjosari1234");
        cy.get('[data-id="submit-search"]').click();
        cy.get(".table > tbody > :nth-child(2) > :nth-child(2)").should(
            "not.be.true"
        );
    });

    it("pencarian kecamatan input kabupaten dan kecamatan kosong", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("/master-table-management/kecamatan/");
        cy.get('[data-id="search"]').click();
        cy.get(".table > tbody > tr > :nth-child(2)").should("be.visible");
    });
});
