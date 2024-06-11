describe("positive case", function () {
    beforeEach(function () {
        cy.fixture("scenario").then(function (data) {
            this.data = data;
        });
    });

    it("create kbli", function () {
        cy.resetDb();
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("/master-table-management/kbli");
        cy.get('[data-id="tambah"]').click();
        cy.get('[data-id="kbli"]').type("1213124");
        cy.get('[data-id="judul_kbli"]').type("industri minuman berat");
        cy.get('[data-id="sektor"]').type("daerah makanan");
        cy.get('[data-id="submit"]').click();
        cy.get(".alert").contains("Tambah Data Kbli Sukses");
    });

    it("edit kbli", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("/master-table-management/kbli");
        cy.get('[data-id="edt-1"]').click();
        cy.get('[data-id="kbli"]').clear("");
        cy.get('[data-id="kbli"]').type("12131111");
        cy.get('[data-id="judul_kbli"]').clear("");
        cy.get('[data-id="judul_kbli"]').type("industri minuman berat bersama");
        cy.get('[data-id="sektor"]').clear("");
        cy.get('[data-id="sektor"]').type("daerah makanan ringan");
        cy.get('[data-id="submit"]').click();
        cy.get(".alert").contains("Edit Data Kbli Sukses");
    });

    it("hapus Kbli yang tidak terikat  kolom lain", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("/master-table-management/kbli");
        cy.get(":nth-child(3) > .page-link").click();
        cy.get('[data-id="del-10"]').click();
        cy.get(
            "#fire-modal-5 > .modal-dialog > .modal-content > .modal-footer > .btn-danger"
        ).click();
        cy.get(".alert").contains("Hapus Data Kbli Sukses");
    });

    it("pencarian judul kbli", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("/master-table-management/kbli");
        cy.get('[data-id="search"]').click();
        cy.get('[data-id="search-kbli"]').type("industri minuman ringan");
        cy.get('[data-id="submit-search"]').click();
    });
});

describe("negative case", function () {
    beforeEach(function () {
        cy.fixture("scenario").then(function (data) {
            this.data = data;
        });
    });
    it("create kbli kurang dari 3 karakter", function () {
        cy.resetDb();
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("/master-table-management/kbli");
        cy.get('[data-id="tambah"]').click();
        cy.get('[data-id="kbli"]').type("12");
        cy.get('[data-id="judul_kbli"]').type("industri minuman berat");
        cy.get('[data-id="sektor"]').type("daerah makanan");
        cy.get('[data-id="submit"]').click();
        cy.get(".invalid-feedback");
    });

    it("create kbli wajib diisi", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("/master-table-management/kbli");
        cy.get('[data-id="tambah"]').click();
        cy.get('[data-id="judul_kbli"]').type("industri minuman berat");
        cy.get('[data-id="sektor"]').type("daerah makanan");
        cy.get('[data-id="submit"]').click();
        cy.get(".invalid-feedback");
    });

    it("create kbli sudah ada", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("/master-table-management/kbli");
        cy.get('[data-id="tambah"]').click();
        cy.get('[data-id="kbli"]').type("11040");
        cy.get('[data-id="judul_kbli"]').type("industri minuman berat");
        cy.get('[data-id="sektor"]').type("daerah makanan");
        cy.get('[data-id="submit"]').click();
        cy.get(".invalid-feedback");
    });

    it("create kbli lebih dari 10 karakter", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("/master-table-management/kbli");
        cy.get('[data-id="tambah"]').click();
        cy.get('[data-id="kbli"]').type("11040000000");
        cy.get('[data-id="judul_kbli"]').type("industri minuman berat");
        cy.get('[data-id="sektor"]').type("daerah makanan");
        cy.get('[data-id="submit"]').click();
        cy.get(".invalid-feedback");
    });

    it("create judul kbli lebih dari 50 karakter", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("/master-table-management/kbli");
        cy.get('[data-id="tambah"]').click();
        cy.get('[data-id="kbli"]').type("11050");
        cy.get('[data-id="judul_kbli"]').type(
            "industri yang sudah ada sejak dahulu kala pada masa terdahulu banget"
        );
        cy.get('[data-id="sektor"]').type("daerah makanan");
        cy.get('[data-id="submit"]').click();
        cy.get(".invalid-feedback");
    });

    it("create judul kbli kurang dari 3 karakter", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("/master-table-management/kbli");
        cy.get('[data-id="tambah"]').click();
        cy.get('[data-id="kbli"]').type("11050");
        cy.get('[data-id="judul_kbli"]').type("in");
        cy.get('[data-id="sektor"]').type("daerah makanan");
        cy.get('[data-id="submit"]').click();
        cy.get(".invalid-feedback");
    });

    it("create judul kbli sudah ada", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("/master-table-management/kbli");
        cy.get('[data-id="tambah"]').click();
        cy.get('[data-id="kbli"]').type("11050");
        cy.get('[data-id="judul_kbli"]').type("industri minuman ringan");
        cy.get('[data-id="sektor"]').type("daerah makanan");
        cy.get('[data-id="submit"]').click();
        cy.get(".invalid-feedback");
    });

    it("create judul kbli wajib ada", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("/master-table-management/kbli");
        cy.get('[data-id="tambah"]').click();
        cy.get('[data-id="kbli"]').type("11050");
        cy.get('[data-id="sektor"]').type("daerah makanan");
        cy.get('[data-id="submit"]').click();
        cy.get(".invalid-feedback");
    });

    it("create judul kbli tidak boleh karakter", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("/master-table-management/kbli");
        cy.get('[data-id="tambah"]').click();
        cy.get('[data-id="kbli"]').type("11050");
        cy.get('[data-id="judul_kbli"]').type("industri minuman @ringan");
        cy.get('[data-id="sektor"]').type("daerah makanan");
        cy.get('[data-id="submit"]').click();
        cy.get(".invalid-feedback");
    });

    it("create sektor tidak boleh karakter", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("/master-table-management/kbli");
        cy.get('[data-id="tambah"]').click();
        cy.get('[data-id="kbli"]').type("11050");
        cy.get('[data-id="judul_kbli"]').type("industri minuman ringan");
        cy.get('[data-id="sektor"]').type("daerah m@kanan");
        cy.get('[data-id="submit"]').click();
        cy.get(".invalid-feedback");
    });

    it("create sektor tidak boleh min 3 huruf", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("/master-table-management/kbli");
        cy.get('[data-id="tambah"]').click();
        cy.get('[data-id="kbli"]').type("11050");
        cy.get('[data-id="judul_kbli"]').type("industri minuman ringan");
        cy.get('[data-id="sektor"]').type("da");
        cy.get('[data-id="submit"]').click();
        cy.get(".invalid-feedback");
    });

    it("create sektor tidak boleh max 50 huruf", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("/master-table-management/kbli");
        cy.get('[data-id="tambah"]').click();
        cy.get('[data-id="kbli"]').type("11050");
        cy.get('[data-id="judul_kbli"]').type("industri minuman ringan");
        cy.get('[data-id="sektor"]').type(
            "makan padang adalah sebuah pusat incaran umat mahasiswa sangat amat enak apalagi pas dikatong "
        );
        cy.get('[data-id="submit"]').click();
        cy.get(".invalid-feedback");
    });

    it("create sektor wajib ada", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("/master-table-management/kbli");
        cy.get('[data-id="tambah"]').click();
        cy.get('[data-id="kbli"]').type("11050");
        cy.get('[data-id="judul_kbli"]').type("industri minuman ringan");
        cy.get('[data-id="submit"]').click();
        cy.get(".invalid-feedback");
    });

    it("create sektor sudah ada", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("/master-table-management/kbli");
        cy.get('[data-id="tambah"]').click();
        cy.get('[data-id="kbli"]').type("140002");
        cy.get('[data-id="judul_kbli"]').type("industri minuman berat");
        cy.get('[data-id="sektor"]').type("kementrian perindustrian");
        cy.get('[data-id="submit"]').click();
        cy.get(".invalid-feedback");
    });

    it("update kbli kurang dari 3 karakter", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("/master-table-management/kbli");
        cy.get('[data-id="edt-1"]').click();
        cy.get('[data-id="kbli"]').clear();
        cy.get('[data-id="kbli"]').type("12");
        cy.get('[data-id="judul_kbli"]').clear();
        cy.get('[data-id="judul_kbli"]').type("industri minuman berat");
        cy.get('[data-id="sektor"]').clear();
        cy.get('[data-id="sektor"]').type("daerah makanan");
        cy.get('[data-id="submit"]').click();
        cy.get(".invalid-feedback");
    });

    it("update kbli wajib diisi", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("/master-table-management/kbli");
        cy.get('[data-id="edt-1"]').click();
        cy.get('[data-id="kbli"]').clear();
        cy.get('[data-id="judul_kbli"]').clear();
        cy.get('[data-id="judul_kbli"]').type("industri minuman berat");
        cy.get('[data-id="sektor"]').clear();
        cy.get('[data-id="sektor"]').type("daerah makanan");
        cy.get('[data-id="submit"]').click();
        cy.get(".invalid-feedback");
    });

    it("update kbli sudah ada", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("/master-table-management/kbli");
        cy.get('[data-id="edt-2"]').click();
        cy.get('[data-id="kbli"]').clear();
        cy.get('[data-id="kbli"]').type("11040");
        cy.get('[data-id="judul_kbli"]').clear();
        cy.get('[data-id="judul_kbli"]').type("industri minuman berat");
        cy.get('[data-id="sektor"]').clear();
        cy.get('[data-id="sektor"]').type("daerah makanan");
        cy.get('[data-id="submit"]').click();
        cy.get(".invalid-feedback");
    });

    it("update kbli lebih dari 10 karakter", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("/master-table-management/kbli");
        cy.get('[data-id="edt-1"]').click();
        cy.get('[data-id="kbli"]').clear();
        cy.get('[data-id="kbli"]').type("11040000000");
        cy.get('[data-id="judul_kbli"]').clear();
        cy.get('[data-id="judul_kbli"]').type("industri minuman berat");
        cy.get('[data-id="sektor"]').clear();
        cy.get('[data-id="sektor"]').type("daerah makanan");
        cy.get('[data-id="submit"]').click();
        cy.get(".invalid-feedback");
    });

    it("update judul kbli lebih dari 50 karakter", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("/master-table-management/kbli");
        cy.get('[data-id="edt-1"]').click();
        cy.get('[data-id="kbli"]').clear();
        cy.get('[data-id="kbli"]').type("11050");
        cy.get('[data-id="judul_kbli"]').clear();
        cy.get('[data-id="judul_kbli"]').type(
            "industri yang sudah ada sejak dahulu kala pada masa terdahulu banget"
        );
        cy.get('[data-id="sektor"]').clear();
        cy.get('[data-id="sektor"]').type("daerah makanan");
        cy.get('[data-id="submit"]').click();
        cy.get(".invalid-feedback");
    });

    it("update judul kbli kurang dari 3 karakter", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("/master-table-management/kbli");
        cy.get('[data-id="edt-1"]').click();
        cy.get('[data-id="kbli"]').clear();
        cy.get('[data-id="kbli"]').type("11050");
        cy.get('[data-id="judul_kbli"]').clear();
        cy.get('[data-id="judul_kbli"]').type("in");
        cy.get('[data-id="sektor"]').clear();
        cy.get('[data-id="sektor"]').type("daerah makanan");
        cy.get('[data-id="submit"]').click();
        cy.get(".invalid-feedback");
    });

    it("update judul kbli sudah ada", function () {
        cy.resetDb();
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("/master-table-management/kbli");
        cy.get('[data-id="edt-2"]').click();
        cy.get('[data-id="kbli"]').clear();
        cy.get('[data-id="kbli"]').type("11050");
        cy.get('[data-id="judul_kbli"]').clear();
        cy.get('[data-id="judul_kbli"]').type("industri minuman ringan");
        cy.get('[data-id="sektor"]').clear();
        cy.get('[data-id="sektor"]').type("daerah makanan");
        cy.get('[data-id="submit"]').click();
        cy.get(".invalid-feedback");
    });

    it("update judul kbli wajib ada", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("/master-table-management/kbli");
        cy.get('[data-id="edt-1"]').click();
        cy.get('[data-id="kbli"]').clear();
        cy.get('[data-id="kbli"]').type("11050");
        cy.get('[data-id="judul_kbli"]').clear();
        cy.get('[data-id="sektor"]').clear();
        cy.get('[data-id="sektor"]').type("daerah makanan");
        cy.get('[data-id="submit"]').click();
        cy.get(".invalid-feedback");
    });

    it("update judul kbli tidak boleh karakter", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("/master-table-management/kbli");
        cy.get('[data-id="edt-1"]').click();
        cy.get('[data-id="kbli"]').clear();
        cy.get('[data-id="kbli"]').type("11050");
        cy.get('[data-id="judul_kbli"]').clear();
        cy.get('[data-id="judul_kbli"]').type("industri minuman @ringan");
        cy.get('[data-id="sektor"]').clear();
        cy.get('[data-id="sektor"]').type("daerah makanan");
        cy.get('[data-id="submit"]').click();
        cy.get(".invalid-feedback");
    });

    it("update sektor tidak boleh karakter", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("/master-table-management/kbli");
        cy.get('[data-id="edt-1"]').click();
        cy.get('[data-id="kbli"]').clear();
        cy.get('[data-id="kbli"]').type("11050");
        cy.get('[data-id="judul_kbli"]').clear();
        cy.get('[data-id="judul_kbli"]').type("industri minuman ringan");
        cy.get('[data-id="sektor"]').clear();
        cy.get('[data-id="sektor"]').type("daerah m@kanan");
        cy.get('[data-id="submit"]').click();
        cy.get(".invalid-feedback");
    });

    it("update sektor tidak boleh min 3 huruf", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("/master-table-management/kbli");
        cy.get('[data-id="edt-1"]').click();
        cy.get('[data-id="kbli"]').clear();
        cy.get('[data-id="kbli"]').type("11050");
        cy.get('[data-id="judul_kbli"]').clear();
        cy.get('[data-id="judul_kbli"]').type("industri minuman ringan");
        cy.get('[data-id="sektor"]').clear();
        cy.get('[data-id="sektor"]').type("da");
        cy.get('[data-id="submit"]').click();
        cy.get(".invalid-feedback");
    });

    it("update sektor tidak boleh max 50 huruf", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("/master-table-management/kbli");
        cy.get('[data-id="edt-1"]').click();
        cy.get('[data-id="kbli"]').clear();
        cy.get('[data-id="kbli"]').type("11050");
        cy.get('[data-id="judul_kbli"]').clear();
        cy.get('[data-id="judul_kbli"]').type("industri minuman ringan");
        cy.get('[data-id="sektor"]').clear();
        cy.get('[data-id="sektor"]').type(
            "makan padang adalah sebuah pusat incaran umat mahasiswa sangat amat enak apalagi pas dikatong "
        );
        cy.get('[data-id="submit"]').click();
        cy.get(".invalid-feedback");
    });

    it("update sektor wajib ada", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("/master-table-management/kbli");
        cy.get('[data-id="edt-1"]').click();
        cy.get('[data-id="kbli"]').clear();
        cy.get('[data-id="kbli"]').type("11050");
        cy.get('[data-id="judul_kbli"]').clear();
        cy.get('[data-id="judul_kbli"]').type("industri minuman ringan");
        cy.get('[data-id="sektor"]').clear();
        cy.get('[data-id="submit"]').click();
        cy.get(".invalid-feedback");
    });

    it("hapus Kbli yang terikat kolom lain", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("/master-table-management/kbli");
        cy.get('[data-id="del-1"]').click();
        cy.contains("Yes").click({ force: true });
        cy.get(".alert").contains(
            "Tidak Dapat Menghapus Kbli Yang Masih Digunakan Oleh Kolom Lain"
        );
    });

    it("pencarian judul kbli tidak ada", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("/master-table-management/kbli");
        cy.get('[data-id="search"]').click();
        cy.get('[data-id="search-kbli"]').type("industri minuman ringan berat");
        cy.get('[data-id="submit-search"]').click();
    });
});
