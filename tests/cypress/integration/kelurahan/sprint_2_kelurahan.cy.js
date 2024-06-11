describe("positive case", function () {
    beforeEach(function () {
        cy.fixture("scenario").then(function (data) {
            this.data = data;
        });
    });

    it("create kelurahan", function () {
        cy.resetDb();
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("/master-table-management/kelurahan");
        cy.get('[data-id="tambah"]').click();
        cy.get('[data-id="select-kabupaten"]')
            .select("1", { force: true })
            .should("have.value", "1");
        cy.get('[data-id="select-kecamatan"]')
            .select("1", { force: true })
            .should("have.value", "1");
        cy.get('[data-id="nama-kelurahan"]').type("Kwagean");
        cy.get('[data-id="select-status"]')
            .select("desa", { force: true })
            .should("have.value", "desa");
        cy.get('[data-id="submit"]').click();
        cy.get(".alert").contains("Tambah Data Kelurahan Sukses");
    });

    it("edit kelurahan", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("/master-table-management/kelurahan");
        cy.get('[data-id="edt-1"]').click();
        cy.get('[data-id="select-kabupaten"]')
            .select("1", { force: true })
            .should("have.value", "1");
        cy.get('[data-id="select-kecamatan"]')
            .select("3", { force: true })
            .should("have.value", "3");
        cy.get('[data-id="nama-kelurahan"]').clear("");
        cy.get('[data-id="nama-kelurahan"]').type("GajahMada");
        cy.get('[data-id="select-status"]')
            .select("kelurahan", { force: true })
            .should("have.value", "kelurahan");
        cy.get('[data-id="submit"]').click();
        cy.get(".alert").contains("Edit Data Kelurahan Sukses");
    });

    it("hapus kelurahan yang tidak terikat kolom lain", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("/master-table-management/kelurahan");
        cy.get(":nth-child(14) > .page-link").click();
        cy.get('[data-id="del-172"]').click();
        cy.get(
            "#fire-modal-2 > .modal-dialog > .modal-content > .modal-footer > .btn-danger"
        ).click();
        cy.get(".alert").contains("Hapus Data Kelurahan Sukses");
    });

    it("pencarian kelurahan input kabupaten", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("/master-table-management/kelurahan");
        cy.get('[data-id="search"]').click();
        cy.get('[data-id="search-kabupaten"]').type("pacitan");
        cy.get('[data-id="submit-search"]').click();
    });

    it("pencarian kecamatan input kecamatan", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("/master-table-management/kelurahan");
        cy.get('[data-id="search"]').click();
        cy.get('[data-id="search-kecamatan"]').type("arjosari");
        cy.get('[data-id="submit-search"]').click();
    });

    it("pencarian kecamatan input kelurahan", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("/master-table-management/kelurahan");
        cy.get('[data-id="search"]').click();
        cy.get('[data-id="search-kelurahan"]').type("Gayuhan");
        cy.get('[data-id="submit-search"]').click();
    });

    it("pencarian kecamatan input kabupaten , kecamatan , kelurahan", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("/master-table-management/kelurahan");
        cy.get('[data-id="search"]').click();
        cy.get('[data-id="search-kabupaten"]').type("pacitan");
        cy.get('[data-id="search-kecamatan"]').type("arjosari");
        cy.get('[data-id="search-kelurahan"]').type("Gayuhan");
        cy.get('[data-id="submit-search"]').click();
    });
});

describe("negative case", function () {
    beforeEach(function () {
        cy.fixture("scenario").then(function (data) {
            this.data = data;
        });
    });
    it("create kelurahan input kelurahan mengunakan angka", function () {
        cy.resetDb();
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("/master-table-management/kelurahan");
        cy.get('[data-id="tambah"]').click();
        cy.get('[data-id="select-kabupaten"]')
            .select("1", { force: true })
            .should("have.value", "1");
        cy.get('[data-id="select-kecamatan"]')
            .select("3", { force: true })
            .should("have.value", "3");
        cy.get('[data-id="nama-kelurahan"]').type("Kwagean1234");
        cy.get('[data-id="select-status"]')
            .select("desa", { force: true })
            .should("have.value", "desa");
        cy.get('[data-id="submit"]').click();
        cy.get(".invalid-feedback");
    });

    it("create kelurahan input kelurahan kosong", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("/master-table-management/kelurahan");
        cy.get('[data-id="tambah"]').click();
        cy.get('[data-id="select-kabupaten"]')
            .select("1", { force: true })
            .should("have.value", "1");
        cy.get('[data-id="select-kecamatan"]')
            .select("3", { force: true })
            .should("have.value", "3");
        cy.get('[data-id="select-status"]')
            .select("desa", { force: true })
            .should("have.value", "desa");
        cy.get('[data-id="submit"]').click();
        cy.get(".invalid-feedback");
    });

    it("create kelurahan input kabupaten kosong", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("/master-table-management/kelurahan");
        cy.get('[data-id="tambah"]').click();
        cy.get('[data-id="select-kabupaten"]')
            .select("", { force: true })
            .should("have.value", "");
        cy.get('[data-id="nama-kelurahan"]').type("Kwagean");
        cy.get('[data-id="select-status"]')
            .select("desa", { force: true })
            .should("have.value", "desa");
        cy.get('[data-id="submit"]').click();
        cy.get(".invalid-feedback");
    });

    it("create kelurahan input kecamatan kosong", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("/master-table-management/kelurahan");
        cy.get('[data-id="tambah"]').click();
        cy.get('[data-id="select-kabupaten"]')
            .select("1", { force: true })
            .should("have.value", "1");
        cy.get('[data-id="select-kecamatan"]')
            .select("", { force: true })
            .should("have.value", "");
        cy.get('[data-id="nama-kelurahan"]').type("Kwagean");
        cy.get('[data-id="select-status"]')
            .select("desa", { force: true })
            .should("have.value", "desa");
        cy.get('[data-id="submit"]').click();
        cy.get(".invalid-feedback");
    });

    it("edit kelurahan input kelurahan menggunakan angka", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("/master-table-management/kelurahan");
        cy.get('[data-id="edt-1"]').click();
        cy.get('[data-id="select-kabupaten"]')
            .select("1", { force: true })
            .should("have.value", "1");
        cy.get('[data-id="select-kecamatan"]')
            .select("3", { force: true })
            .should("have.value", "3");
        cy.get('[data-id="nama-kelurahan"]').type("Lowokwaru123");
        cy.get('[data-id="select-status"]')
            .select("kelurahan", { force: true })
            .should("have.value", "kelurahan");
        cy.get('[data-id="submit"]').click();
        cy.get(".invalid-feedback");
    });

    it("edit kelurahan input kelurahan kosong", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("/master-table-management/kelurahan");
        cy.get('[data-id="edt-1"]').click();
        cy.get('[data-id="select-kabupaten"]')
            .select("1", { force: true })
            .should("have.value", "1");
        cy.get('[data-id="select-kecamatan"]')
            .select("3", { force: true })
            .should("have.value", "3");
        cy.get('[data-id="nama-kelurahan"]').clear("");
        cy.get('[data-id="select-status"]')
            .select("kelurahan", { force: true })
            .should("have.value", "kelurahan");
        cy.get('[data-id="submit"]').click();
        cy.get(".invalid-feedback");
    });

    it("edit kelurahan input kabupaten kosong", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("/master-table-management/kelurahan");
        cy.get('[data-id="edt-1"]').click();
        cy.get('[data-id="select-kabupaten"]')
            .select("", { force: true })
            .should("have.value", "");
        cy.get('[data-id="select-kecamatan"]')
            .select("", { force: true })
            .should("have.value", "");
        cy.get('[data-id="nama-kelurahan"]').type("kwagean");
        cy.get('[data-id="select-status"]')
            .select("kelurahan", { force: true })
            .should("have.value", "kelurahan");
        cy.get('[data-id="submit"]').click();
        cy.get(".invalid-feedback");
    });

    it("edit kelurahan input kecamatan kosong dan kabupaten kosong", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("/master-table-management/kelurahan");
        cy.get('[data-id="edt-1"]').click();
        cy.get('[data-id="select-kabupaten"]')
            .select("", { force: true })
            .should("have.value", "");
        cy.get('[data-id="select-kecamatan"]')
            .select("", { force: true })
            .should("have.value", "");
        cy.get('[data-id="nama-kelurahan"]').type("kwagean");
        cy.get('[data-id="select-status"]')
            .select("kelurahan", { force: true })
            .should("have.value", "kelurahan");
        cy.get('[data-id="submit"]').click();
        cy.get(".invalid-feedback");
    });

    it("hapus kelurahan yang terikat kolom lain", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("/master-table-management/kelurahan");
        cy.get('[data-id="del-1"]').click();
        cy.contains("Yes").click();
        cy.get(".alert").contains(
            "Tidak Dapat Menghapus Kelurahan Yang Masih Digunakan Oleh Kolom Lain"
        );
    });

    it("pencarian kelurahan input kabupaten tidak ada didatabase", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("/master-table-management/kelurahan");
        cy.get('[data-id="search"]').click();
        cy.get('[data-id="search-kabupaten"]').type("pacitan123");
        cy.get('[data-id="submit-search"]').click();
        cy.get(".table > tbody > :nth-child(2) > :nth-child(2)").should(
            "not.be.true"
        );
    });

    it("pencarian kelurahan input kabupaten tidak ada didatabase", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("/master-table-management/kelurahan");
        cy.get('[data-id="search"]').click();
        cy.get('[data-id="search-kabupaten"]').type("pacitan kab");
        cy.get('[data-id="submit-search"]').click();
        cy.get(".table > tbody > :nth-child(2) > :nth-child(2)").should(
            "not.be.true"
        );
    });

    it("pencarian kelurahan input kabupaten, kecamatan dan kelurahan kosong", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("/master-table-management/kelurahan");
        cy.get('[data-id="search"]').click();
        cy.get(".table > tbody > tr > :nth-child(2)").should("be.visible");
    });
});
