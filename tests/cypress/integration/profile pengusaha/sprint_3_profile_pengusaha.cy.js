describe("case positive", function () {
    beforeEach(function () {
        cy.fixture("scenario").then(function (data) {
            this.data = data;
        });
    });

    it("create profile pengusaha", function () {
        cy.resetDb();
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("data-table-management/profile-pengusaha");
        cy.get('[data-id="tambah"]').click();
        cy.get('[data-id="nomor-identitas-pengusaha"]').click();
        cy.get('[data-id="nomor-identitas-pengusaha"]').type(
            "3572010608020002"
        );
        cy.get('[data-id="nama-pengusaha"]').click();
        cy.get('[data-id="nama-pengusaha"]').type("Muhammad Ghani");
        cy.get('[data-id="nomor-telpon"]').click();
        cy.get('[data-id="nomor-telpon"]').type("082113009282");
        cy.get('[data-id="email"]').click();
        cy.get('[data-id="email"]').type("okeoke@gmail.com");
        cy.get('[data-id="submit"]').click();
        cy.get(".alert").contains("Tambah Data Pengusaha Sukses");
    });

    it("update profile pengusaha", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("data-table-management/profile-pengusaha");
        cy.get('[data-id="edt-1"]').click();
        cy.get('[data-id="nomor-identitas-pengusaha"]').clear();
        cy.get('[data-id="nomor-identitas-pengusaha"]').type(
            "3572010608020003"
        );
        cy.get('[data-id="nama-pengusaha"]').clear();
        cy.get('[data-id="nama-pengusaha"]').type("Muhammad Ghani Haq");
        cy.get('[data-id="nomor-telpon"]').clear();
        cy.get('[data-id="nomor-telpon"]').type("082113009283");
        cy.get('[data-id="email"]').clear();
        cy.get('[data-id="email"]').type("okeoketes@gmail.com");
        cy.get('[data-id="submit"]').click();
        cy.get(".alert").contains("Edit Data Pengusaha Sukses");
    });

    it("delete profile pengusaha yang tidak terikat kolom lain", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("data-table-management/profile-pengusaha");
        cy.get(":nth-child(4) > .page-link").click();
        cy.get('[data-id="del-11"]').click();
        cy.contains("Yes").click();
        cy.get(".alert").contains("Hapus Data Pengusaha Sukses");
    });

    it("pencarian profile pengusaha", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("data-table-management/profile-pengusaha");
        cy.get('[data-id="search"]').click();
        cy.get('[data-id="search-profile-pengusaha"]').type("Ghani");
        cy.get('[data-id="submit-search"]').click();
    });
});

describe("case negative", function () {
    beforeEach(function () {
        cy.fixture("scenario").then(function (data) {
            this.data = data;
        });
    });

    it("create profile pengusaha input kosong semua", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("data-table-management/profile-pengusaha");
        cy.get('[data-id="tambah"]').click();
        cy.get('[data-id="submit"]').click();
        cy.get(".invalid-feedback");
    });

    it("create profile pengusaha nomer identitas user input kosong", function () {
        cy.resetDb();
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("data-table-management/profile-pengusaha");
        cy.get('[data-id="tambah"]').click();
        cy.get('[data-id="nomor-identitas-pengusaha"]').click();
        cy.get('[data-id="submit"]').click();
        cy.get(".invalid-feedback");
    });

    it("create profile pengusaha nomer identitas user input huruf", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("data-table-management/profile-pengusaha");
        cy.get('[data-id="tambah"]').click();
        cy.get('[data-id="nomor-identitas-pengusaha"]').click();
        cy.get('[data-id="nomor-identitas-pengusaha"]').type("INI HURUF");
        cy.get('[data-id="submit"]').click();
        cy.get(".invalid-feedback");
    });

    it("create profile pengusaha nomer identitas user input karakter", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("data-table-management/profile-pengusaha");
        cy.get('[data-id="tambah"]').click();
        cy.get('[data-id="nomor-identitas-pengusaha"]').click();
        cy.get('[data-id="nomor-identitas-pengusaha"]').type("@@@@@");
        cy.get('[data-id="submit"]').click();
        cy.get(".invalid-feedback");
    });

    it("create profile pengusaha nama pengusaha input kosong", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("data-table-management/profile-pengusaha");
        cy.get('[data-id="tambah"]').click();
        cy.get('[data-id="nama-pengusaha"]').click();
        cy.get('[data-id="submit"]').click();
        cy.get(".invalid-feedback");
    });

    it("create profile pengusaha nama pengusaha input angka", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("data-table-management/profile-pengusaha");
        cy.get('[data-id="tambah"]').click();
        cy.get('[data-id="nama-pengusaha"]').click();
        cy.get('[data-id="nama-pengusaha"]').type("Muhammad Ghani1");
        cy.get('[data-id="submit"]').click();
        cy.get(".invalid-feedback");
    });

    it("create profile pengusaha nama pengusaha input karakter", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("data-table-management/profile-pengusaha");
        cy.get('[data-id="tambah"]').click();
        cy.get('[data-id="nama-pengusaha"]').click();
        cy.get('[data-id="nama-pengusaha"]').type("Muhammad Ghani@");
        cy.get('[data-id="submit"]').click();
        cy.get(".invalid-feedback");
    });

    it("create profile pengusaha nomor telpon input kosong", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("data-table-management/profile-pengusaha");
        cy.get('[data-id="tambah"]').click();
        cy.get('[data-id="nomor-telpon"]').click();
        cy.get('[data-id="submit"]').click();
        cy.get(".invalid-feedback");
    });

    it("create profile pengusaha nomor telpon input huruf", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("data-table-management/profile-pengusaha");
        cy.get('[data-id="tambah"]').click();
        cy.get('[data-id="nomor-telpon"]').click();
        cy.get('[data-id="nomor-telpon"]').type("08211300928q");
        cy.get('[data-id="submit"]').click();
        cy.get(".invalid-feedback");
    });

    it("create profile pengusaha email input kosong", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("data-table-management/profile-pengusaha");
        cy.get('[data-id="tambah"]').click();
        cy.get('[data-id="email"]').click();
        cy.get('[data-id="email"]').type("okeoke");
        cy.get('[data-id="submit"]').click();
        cy.get(".invalid-feedback");
    });

    it("create profile pengusaha email input tidak sesuai kententuan", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("data-table-management/profile-pengusaha");
        cy.get('[data-id="tambah"]').click();
        cy.get('[data-id="email"]').click();
        cy.get('[data-id="email"]').type("okeoke");
        cy.get('[data-id="submit"]').click();
        cy.get(".invalid-feedback");
    });

    it("update profile pengusaha semua kosong", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("data-table-management/profile-pengusaha");
        cy.get('[data-id="edt-1"]').click();
        cy.get('[data-id="nomor-identitas-pengusaha"]').clear();
        cy.get('[data-id="nama-pengusaha"]').clear();
        cy.get('[data-id="nomor-telpon"]').clear();
        cy.get('[data-id="email"]').clear();
        cy.get('[data-id="submit"]').click();
        cy.get(".invalid-feedback");
    });

    it("update profile pengusaha nomor identitas pengusaha kosong", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("data-table-management/profile-pengusaha");
        cy.get('[data-id="edt-1"]').click();
        cy.get('[data-id="nomor-identitas-pengusaha"]').clear();
        cy.get('[data-id="nama-pengusaha"]').clear();
        cy.get('[data-id="nama-pengusaha"]').type("Muhammad Ghani Haq");
        cy.get('[data-id="nomor-telpon"]').clear();
        cy.get('[data-id="nomor-telpon"]').type("082113009283");
        cy.get('[data-id="email"]').clear();
        cy.get('[data-id="email"]').type("okeoketes@gmail.com");
        cy.get('[data-id="submit"]').click();
        cy.get(".invalid-feedback");
    });
    it("update profile pengusaha nomor identitas pengusaha input huruf", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("data-table-management/profile-pengusaha");
        cy.get('[data-id="edt-1"]').click();
        cy.get('[data-id="nomor-identitas-pengusaha"]').clear();
        cy.get('[data-id="nomor-identitas-pengusaha"]').type(
            "3572010608020003q"
        );
        cy.get('[data-id="nama-pengusaha"]').clear();
        cy.get('[data-id="nama-pengusaha"]').type("Muhammad Ghani Haq");
        cy.get('[data-id="nomor-telpon"]').clear();
        cy.get('[data-id="nomor-telpon"]').type("082113009283");
        cy.get('[data-id="email"]').clear();
        cy.get('[data-id="email"]').type("okeoketes@gmail.com");
        cy.get('[data-id="submit"]').click();
        cy.get(".invalid-feedback");
    });
    it("update profile pengusaha nomor identitas pengusaha input karakter", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("data-table-management/profile-pengusaha");
        cy.get('[data-id="edt-1"]').click();
        cy.get('[data-id="nomor-identitas-pengusaha"]').clear();
        cy.get('[data-id="nomor-identitas-pengusaha"]').type(
            "357201060802000@"
        );
        cy.get('[data-id="nama-pengusaha"]').clear();
        cy.get('[data-id="nama-pengusaha"]').type("Muhammad Ghani Haq");
        cy.get('[data-id="nomor-telpon"]').clear();
        cy.get('[data-id="nomor-telpon"]').type("082113009283");
        cy.get('[data-id="email"]').clear();
        cy.get('[data-id="email"]').type("okeoketes@gmail.com");
        cy.get('[data-id="submit"]').click();
        cy.get(".invalid-feedback");
    });
    it("update profile pengusaha nama pengusaha kosong", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("data-table-management/profile-pengusaha");
        cy.get('[data-id="edt-1"]').click();
        cy.get('[data-id="nomor-identitas-pengusaha"]').clear();
        cy.get('[data-id="nomor-identitas-pengusaha"]').type(
            "3572010608020003"
        );
        cy.get('[data-id="nama-pengusaha"]').clear();
        cy.get('[data-id="nomor-telpon"]').clear();
        cy.get('[data-id="nomor-telpon"]').type("082113009283");
        cy.get('[data-id="email"]').clear();
        cy.get('[data-id="email"]').type("okeoketes@gmail.com");
        cy.get('[data-id="submit"]').click();
        cy.get(".invalid-feedback");
    });
    it("update profile pengusaha nama pengusaha input angka", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("data-table-management/profile-pengusaha");
        cy.get('[data-id="edt-1"]').click();
        cy.get('[data-id="nomor-identitas-pengusaha"]').clear();
        cy.get('[data-id="nomor-identitas-pengusaha"]').type(
            "3572010608020003"
        );
        cy.get('[data-id="nama-pengusaha"]').clear();
        cy.get('[data-id="nama-pengusaha"]').type("Muhammad Ghani Haq1");
        cy.get('[data-id="nomor-telpon"]').clear();
        cy.get('[data-id="nomor-telpon"]').type("082113009283");
        cy.get('[data-id="email"]').clear();
        cy.get('[data-id="email"]').type("okeoketes@gmail.com");
        cy.get('[data-id="submit"]').click();
        cy.get(".invalid-feedback");
    });
    it("update profile pengusaha nama pengusaha input karakter", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("data-table-management/profile-pengusaha");
        cy.get('[data-id="edt-1"]').click();
        cy.get('[data-id="nomor-identitas-pengusaha"]').clear();
        cy.get('[data-id="nomor-identitas-pengusaha"]').type(
            "3572010608020003"
        );
        cy.get('[data-id="nama-pengusaha"]').clear();
        cy.get('[data-id="nama-pengusaha"]').type("Muhammad Ghani Haq@");
        cy.get('[data-id="nomor-telpon"]').clear();
        cy.get('[data-id="nomor-telpon"]').type("082113009283");
        cy.get('[data-id="email"]').clear();
        cy.get('[data-id="email"]').type("okeoketes@gmail.com");
        cy.get('[data-id="submit"]').click();
        cy.get(".invalid-feedback");
    });

    it("update profile pengusaha nomor telpon input huruf", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("data-table-management/profile-pengusaha");
        cy.get('[data-id="edt-1"]').click();
        cy.get('[data-id="nomor-identitas-pengusaha"]').clear();
        cy.get('[data-id="nomor-identitas-pengusaha"]').type(
            "3572010608020003"
        );
        cy.get('[data-id="nama-pengusaha"]').clear();
        cy.get('[data-id="nama-pengusaha"]').type("Muhammad Ghani Haq");
        cy.get('[data-id="nomor-telpon"]').clear();
        cy.get('[data-id="nomor-telpon"]').type("082113009asd23");
        cy.get('[data-id="email"]').clear();
        cy.get('[data-id="email"]').type("okeoketes@gmail.com");
        cy.get('[data-id="submit"]').click();
        cy.get(".invalid-feedback");
    });

    it("update profile pengusaha email tidak sesuai ketentuan", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("data-table-management/profile-pengusaha");
        cy.get('[data-id="edt-1"]').click();
        cy.get('[data-id="nomor-identitas-pengusaha"]').clear();
        cy.get('[data-id="nomor-identitas-pengusaha"]').type(
            "3572010608020003"
        );
        cy.get('[data-id="nama-pengusaha"]').clear();
        cy.get('[data-id="nama-pengusaha"]').type("Muhammad Ghani Haq");
        cy.get('[data-id="nomor-telpon"]').clear();
        cy.get('[data-id="nomor-telpon"]').type("082113009283");
        cy.get('[data-id="email"]').clear();
        cy.get('[data-id="email"]').type("okeoketes");
        cy.get('[data-id="submit"]').click();
        cy.get(".invalid-feedback");
    });

    it.only("delete profile pengusaha yang terikat kolom lain", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("data-table-management/profile-pengusaha");
        cy.get('[data-id="del-1"]').click();
        cy.get(
            "#fire-modal-1 > .modal-dialog > .modal-content > .modal-footer > .btn-danger"
        ).click();
        cy.get(".alert").contains(
            "Tidak Dapat Menghapus Pengusaha Yang Masih Digunakan Oleh Kolom Lain"
        );
    });

    it("pencarian profile pengusaha tidak ada didatabase", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("data-table-management/profile-pengusaha");
        cy.get('[data-id="search"]').click();
        cy.get('[data-id="search-profile-pengusaha"]').type("DINACU");
        cy.get('[data-id="submit-search"]').click();
        cy.get(".table > tbody > tr > :nth-child(2)").should("be.visible");
    });

    it("pencarian profile pengusaha kosong", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("data-table-management/profile-pengusaha");
        cy.get('[data-id="search"]').click();
        cy.get('[data-id="submit-search"]').click();
        cy.get(".table > tbody > tr > :nth-child(2)").should("be.visible");
    });
});
