describe("case positive", function () {
    beforeEach(function () {
        cy.fixture("scenario").then(function (data) {
            this.data = data;
        });
    });

    it("create kabupaten", function () {
        cy.resetDb();
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("master-table-management/kabupaten");
        cy.get('[data-id="tambah"]').click();
        cy.get('[data-id="nama-kabupaten"]').type("Malang");
        cy.get('[data-id="submit"]').click();
        cy.get(".alert").contains("Tambah Data Kabupaten Sukses");
    });

    it("edit kabupaten", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("master-table-management/kabupaten");
        cy.get('[data-id="edt-1"]').click();
        cy.get('[data-id="nama-kabupaten"]').clear("Pacitan");
        cy.get('[data-id="nama-kabupaten"]').type("Nganjuk");
        cy.get('[data-id="submit"]').click();
        cy.get(".alert").contains("Edit Data Kabupaten Sukses");
    });

    it("hapus kabupaten yang tidak terikat kolom lain", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("master-table-management/kabupaten");
        cy.get('[data-id="del-2"]').click();
        cy.get(
            "#fire-modal-2 > .modal-dialog > .modal-content > .modal-footer > .btn-danger"
        ).click();
        cy.get(".alert").contains("Hapus Data Kabupaten Sukses");
    });

    it("pencarian kabupaten", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("master-table-management/kabupaten");
        cy.get('[data-id="search"]').click();
        cy.get('[data-id="search-kabupaten"]').clear("Nganjuk");
        cy.get('[data-id="search-kabupaten"]').type("Nganjuk");
        cy.get('[data-id="submit-search"]').click();
    });
});

describe("case negative", function () {
    beforeEach(function () {
        cy.fixture("scenario").then(function (data) {
            this.data = data;
        });
    });
    it("create kabupaten mengunakan angka", function () {
        cy.resetDb();
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("master-table-management/kabupaten");
        cy.get('[data-id="tambah"]').click();
        cy.get('[data-id="nama-kabupaten"]').type("Malang123");
        cy.get('[data-id="submit"]').click();
        cy.get(".invalid-feedback");
    });

    it("create kabupaten mengunakan spasi", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("master-table-management/kabupaten");
        cy.get('[data-id="tambah"]').click();
        cy.get('[data-id="nama-kabupaten"]').type("Malang Raya");
        cy.get('[data-id="submit"]').click();
        cy.get(".invalid-feedback");
    });

    it("create kabupaten input kosong", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("master-table-management/kabupaten");
        cy.get('[data-id="tambah"]').click();
        cy.get('[data-id="submit"]').click();
        cy.get(".invalid-feedback");
    });

    it("create kabupaten input minimal 3", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("master-table-management/kabupaten");
        cy.get('[data-id="tambah"]').click();
        cy.get('[data-id="nama-kabupaten"]').type("Mg");
        cy.get('[data-id="submit"]').click();
        cy.get(".invalid-feedback");
    });

    it("create kabupaten input karakter", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("master-table-management/kabupaten");
        cy.get('[data-id="tambah"]').click();
        cy.get('[data-id="nama-kabupaten"]').type("Mlg!@!");
        cy.get('[data-id="submit"]').click();
        cy.get(".invalid-feedback");
    });

    it("create kabupaten input maksimal 50", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("master-table-management/kabupaten");
        cy.get('[data-id="tambah"]').click();
        cy.get('[data-id="nama-kabupaten"]').type(
            "qwertyuiopasdfghjklzxcvbbnmadasdwqeretyydfsfdsfeewrwerwertwqwdsfs"
        );
        cy.get('[data-id="submit"]').click();
        cy.get(".invalid-feedback");
    });

    it("edit kabupaten mengunakan angka", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("master-table-management/kabupaten");
        cy.get('[data-id="edt-1"]').click();
        cy.get('[data-id="nama-kabupaten"]').clear("Pacitan");
        cy.get('[data-id="nama-kabupaten"]').type("Nganjuk123");
        cy.get('[data-id="submit"]').click();
        cy.get(".invalid-feedback");
    });

    it("edit kabupaten mengunakan spasi", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("master-table-management/kabupaten");
        cy.get('[data-id="edt-1"]').click();
        cy.get('[data-id="nama-kabupaten"]').clear("Pacitan");
        cy.get('[data-id="nama-kabupaten"]').type("Nganjuk Angin");
        cy.get('[data-id="submit"]').click();
        cy.get(".invalid-feedback");
    });

    it("edit kabupaten input kosong", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("master-table-management/kabupaten");
        cy.get('[data-id="edt-1"]').click();
        cy.get('[data-id="nama-kabupaten"]').clear("Malang");
        cy.get('[data-id="submit"]').click();
        cy.get(".invalid-feedback");
    });

    it("edit kabupaten input minmal 3", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("master-table-management/kabupaten");
        cy.get('[data-id="edt-1"]').click();
        cy.get('[data-id="nama-kabupaten"]').clear("Pacitan");
        cy.get('[data-id="nama-kabupaten"]').type("Ng");
        cy.get('[data-id="submit"]').click();
        cy.get(".invalid-feedback");
    });

    it("edit kabupaten input karakter", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("master-table-management/kabupaten");
        cy.get('[data-id="edt-1"]').click();
        cy.get('[data-id="nama-kabupaten"]').clear("Pacitan");
        cy.get('[data-id="nama-kabupaten"]').type("Ngjk!@");
        cy.get('[data-id="submit"]').click();
        cy.get(".invalid-feedback");
    });

    it("edit kabupaten input maksimal 50", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("master-table-management/kabupaten");
        cy.get('[data-id="edt-1"]').click();
        cy.get('[data-id="nama-kabupaten"]').clear("Malang");
        cy.get('[data-id="nama-kabupaten"]').type(
            "qwertyuiopasdfghjklzxcvbbnmadasdwqeretyydfsfdsfeewrwerwertwqwdsfs"
        );
        cy.get('[data-id="submit"]').click();
        cy.get(".invalid-feedback");
    });

    it("hapus kabupaten yang terikat kolom lain", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("master-table-management/kabupaten");
        cy.get('[data-id="del-1"]').click();
        cy.contains("Yes").click();
        cy.get(".alert").contains(
            "Tidak Dapat Menghapus Kabupaten Yang Masih Digunakan Oleh Kolom Lain"
        );
    });

    it("pencarian kabupaten tidak ada didatabase", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("master-table-management/kabupaten");
        cy.get('[data-id="search"]').click();
        cy.get('[data-id="search-kabupaten"]').type("Nganjuk123");
        cy.get('[data-id="submit-search"]').click();
        cy.get(".table > tbody > :nth-child(2) > :nth-child(2)").should(
            "not.be.true"
        );
    });

    it("pencarian kabupaten input kosong", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("master-table-management/kabupaten");
        cy.get('[data-id="search"]').click();
        cy.get('[data-id="submit-search"]').click();
        cy.get(".table > tbody > tr > :nth-child(2)").should("be.visible");
    });
});
