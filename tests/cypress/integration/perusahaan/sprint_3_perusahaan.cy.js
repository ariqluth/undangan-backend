describe("case positive", function () {
    beforeEach(function () {
        cy.fixture("scenario").then(function (data) {
            this.data = data;
        });
    });
    it("create perusahaan", function () {
        cy.resetDb();
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("data-table-management/perusahaan");
        cy.get('[data-id="tambah-perusahaan"]').click();
        cy.get('[data-id="nama-perusahaan"]').type("Maju Jaya");
        cy.get('[data-id="nib"]').type("20202020");
        cy.get('[data-id="select-pmdn"]')
            .select("1", { force: true })
            .should("have.value", "1");
        cy.get('[data-id="select-uraian-jenis-perusahaan"]')
            .select("2", { force: true })
            .should("have.value", "2");
        cy.get('[data-id="select-kabupaten"]')
            .select("1", { force: true })
            .should("have.value", "1");
        cy.get('[data-id="alamat-usaha"]').type("Jl.Suhat gunung Pucuk");
        cy.get('[data-id="email"]').type("MajuJaya@gmail.com");
        cy.get('[data-id="no_telp"]').type("083213123123");
        cy.get('[data-id="submit-perusahaan"]').click();
        cy.get(".alert").contains("Tambah Data Perusahaan Sukses");
    });

    it("edit perusahaan", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("data-table-management/perusahaan");
        cy.get('[data-id="edt-1"]').click();
        cy.get('[data-id="nama-perusahaan"]').clear();
        cy.get('[data-id="nama-perusahaan"]').type("Maju Jaya Bersama");
        cy.get('[data-id="select-kabupaten"]')
            .select("1", { force: true })
            .should("have.value", "1");
        cy.get('[data-id="nib"]').clear();
        cy.get('[data-id="nib"]').type("20202021");
        cy.get('[data-id="email"]').clear();
        cy.get('[data-id="email"]').type("MajuJaya@gmail.com");
        cy.get('[data-id="alamat-usaha"]').clear();
        cy.get('[data-id="alamat-usaha"]').type("Jalan Pacitan Nganjuk");
        cy.get('[data-id="no_telp"]').clear();
        cy.get('[data-id="no_telp"]').type("083213123123");
        cy.get('[data-id="submit-perusahaan"]').click();
        cy.get(".alert").contains("Edit Data Perusahaan Sukses");
    });

    it("hapus perusahaan", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("data-table-management/perusahaan");
        cy.get(":nth-child(4) > .page-link").click();
        cy.get('[data-id="del-11"]').click();
        cy.contains("Yes").click();
        cy.get(".alert").contains("Hapus Data Perusahaan Sukses");
    });

    it("pencarian perusahaan", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("data-table-management/perusahaan");
        cy.get('[data-id="search"]').click();
        cy.get('[data-id="search-perusahaan"]').clear();
        cy.get('[data-id="search-perusahaan"]').type("DINA");
        cy.get('[data-id="submit-search"]').click();
    });
});

describe("case negative", function () {
    beforeEach(function () {
        cy.fixture("scenario").then(function (data) {
            this.data = data;
        });
    });

    it("create perusahaan input kosong semua", function () {
        cy.resetDb();
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("data-table-management/perusahaan");
        cy.get('[data-id="tambah-perusahaan"]').click();
        cy.get('[data-id="submit-perusahaan"]').click();
        cy.get(".invalid-feedback");
    });

    it("create perusahaan input nama perusahaan kosong", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("data-table-management/perusahaan");
        cy.get('[data-id="tambah-perusahaan"]').click();
        cy.get('[data-id="nib"]').type("20202020");
        cy.get('[data-id="select-pmdn"]')
            .select("1", { force: true })
            .should("have.value", "1");
        cy.get('[data-id="select-uraian-jenis-perusahaan"]')
            .select("2", { force: true })
            .should("have.value", "2");
        cy.get('[data-id="select-kabupaten"]')
            .select("1", { force: true })
            .should("have.value", "1");
        cy.get('[data-id="alamat-usaha"]').type("Jl.Suhat gunung Pucuk");
        cy.get('[data-id="email"]').type("MajuJaya@gmail.com");
        cy.get('[data-id="no_telp"]').type("083213123123");
        cy.get('[data-id="submit-perusahaan"]').click();
        cy.get(".invalid-feedback");
    });

    it("create perusahaan input nama perusahaan karakter", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("data-table-management/perusahaan");
        cy.get('[data-id="tambah-perusahaan"]').click();
        cy.get('[data-id="nama-perusahaan"]').type("@Maju Jaya");
        cy.get('[data-id="nib"]').type("20202020");
        cy.get('[data-id="select-pmdn"]')
            .select("1", { force: true })
            .should("have.value", "1");
        cy.get('[data-id="select-uraian-jenis-perusahaan"]')
            .select("2", { force: true })
            .should("have.value", "2");
        cy.get('[data-id="select-kabupaten"]')
            .select("1", { force: true })
            .should("have.value", "1");
        cy.get('[data-id="alamat-usaha"]').type("Jl.Suhat gunung Pucuk");
        cy.get('[data-id="email"]').type("MajuJaya@gmail.com");
        cy.get('[data-id="no_telp"]').type("083213123123");
        cy.get('[data-id="submit-perusahaan"]').click();
        cy.get(".invalid-feedback");
    });

    it("create perusahaan input nama perusahaan sama ", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("data-table-management/perusahaan");
        cy.get('[data-id="tambah-perusahaan"]').click();
        cy.get('[data-id="nama-perusahaan"]').type("Suharmawan");
        cy.get('[data-id="nib"]').type("20202020");
        cy.get('[data-id="select-pmdn"]')
            .select("1", { force: true })
            .should("have.value", "1");
        cy.get('[data-id="select-uraian-jenis-perusahaan"]')
            .select("2", { force: true })
            .should("have.value", "2");
        cy.get('[data-id="select-kabupaten"]')
            .select("1", { force: true })
            .should("have.value", "1");
        cy.get('[data-id="alamat-usaha"]').type("Jl.Suhat gunung Pucuk");
        cy.get('[data-id="email"]').type("MajuJaya@gmail.com");
        cy.get('[data-id="no_telp"]').type("083213123123");
        cy.get('[data-id="submit-perusahaan"]').click();
        cy.get(".invalid-feedback");
    });

    it("create perusahaan input nib kosong", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("data-table-management/perusahaan");
        cy.get('[data-id="tambah-perusahaan"]').click();
        cy.get('[data-id="nama-perusahaan"]').type("Maju Jaya");
        cy.get('[data-id="select-pmdn"]')
            .select("1", { force: true })
            .should("have.value", "1");
        cy.get('[data-id="select-uraian-jenis-perusahaan"]')
            .select("2", { force: true })
            .should("have.value", "2");
        cy.get('[data-id="select-kabupaten"]')
            .select("1", { force: true })
            .should("have.value", "1");
        cy.get('[data-id="alamat-usaha"]').type("Jl.Suhat gunung Pucuk");
        cy.get('[data-id="email"]').type("MajuJaya@gmail.com");
        cy.get('[data-id="no_telp"]').type("083213123123");
        cy.get('[data-id="submit-perusahaan"]').click();
        cy.get(".invalid-feedback");
    });
    it("create perusahaan input nib huruf", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("data-table-management/perusahaan");
        cy.get('[data-id="tambah-perusahaan"]').click();
        cy.get('[data-id="nama-perusahaan"]').type("Maju Jaya");
        cy.get('[data-id="nib"]').type("hahahah");
        cy.get('[data-id="select-pmdn"]')
            .select("1", { force: true })
            .should("have.value", "1");
        cy.get('[data-id="select-uraian-jenis-perusahaan"]')
            .select("2", { force: true })
            .should("have.value", "2");
        cy.get('[data-id="select-kabupaten"]')
            .select("1", { force: true })
            .should("have.value", "1");
        cy.get('[data-id="alamat-usaha"]').type("Jl.Suhat gunung Pucuk");
        cy.get('[data-id="email"]').type("MajuJaya@gmail.com");
        cy.get('[data-id="no_telp"]').type("083213123123");
        cy.get('[data-id="submit-perusahaan"]').click();
        cy.get(".invalid-feedback");
    });
    it("create perusahaan input nib sama", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("data-table-management/perusahaan");
        cy.get('[data-id="tambah-perusahaan"]').click();
        cy.get('[data-id="nama-perusahaan"]').type("Maju Jaya");
        cy.get('[data-id="nib"]').type("0101230010181");
        cy.get('[data-id="select-pmdn"]')
            .select("1", { force: true })
            .should("have.value", "1");
        cy.get('[data-id="select-uraian-jenis-perusahaan"]')
            .select("2", { force: true })
            .should("have.value", "2");
        cy.get('[data-id="select-kabupaten"]')
            .select("1", { force: true })
            .should("have.value", "1");
        cy.get('[data-id="alamat-usaha"]').type("Jl.Suhat gunung Pucuk");
        cy.get('[data-id="email"]').type("MajuJaya@gmail.com");
        cy.get('[data-id="no_telp"]').type("083213123123");
        cy.get('[data-id="submit-perusahaan"]').click();
        cy.get(".invalid-feedback");
    });

    it("create perusahaan input Penanaman Modal kosong", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("data-table-management/perusahaan");
        cy.get('[data-id="tambah-perusahaan"]').click();
        cy.get('[data-id="nama-perusahaan"]').type("Maju Jaya");
        cy.get('[data-id="nib"]').type("20202020");
        cy.get('[data-id="select-pmdn"]')
            .select("", { force: true })
            .should("have.value", "");
        cy.get('[data-id="select-uraian-jenis-perusahaan"]')
            .select("2", { force: true })
            .should("have.value", "2");
        cy.get('[data-id="select-kabupaten"]')
            .select("1", { force: true })
            .should("have.value", "1");
        cy.get('[data-id="alamat-usaha"]').type("Jl.Suhat gunung Pucuk");
        cy.get('[data-id="email"]').type("MajuJaya@gmail.com");
        cy.get('[data-id="no_telp"]').type("083213123123");
        cy.get('[data-id="submit-perusahaan"]').click();
        cy.get(".invalid-feedback");
    });

    it("create perusahaan input Penanaman Modal kosong", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("data-table-management/perusahaan");
        cy.get('[data-id="tambah-perusahaan"]').click();
        cy.get('[data-id="nama-perusahaan"]').type("Maju Jaya");
        cy.get('[data-id="nib"]').type("20202020");
        cy.get('[data-id="select-pmdn"]')
            .select("", { force: true })
            .should("have.value", "");
        cy.get('[data-id="select-uraian-jenis-perusahaan"]')
            .select("2", { force: true })
            .should("have.value", "2");
        cy.get('[data-id="select-kabupaten"]')
            .select("1", { force: true })
            .should("have.value", "1");
        cy.get('[data-id="alamat-usaha"]').type("Jl.Suhat gunung Pucuk");
        cy.get('[data-id="email"]').type("MajuJaya@gmail.com");
        cy.get('[data-id="no_telp"]').type("083213123123");
        cy.get('[data-id="submit-perusahaan"]').click();
        cy.get(".invalid-feedback");
    });
    it("create perusahaan input kabupaten kosong", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("data-table-management/perusahaan");
        cy.get('[data-id="tambah-perusahaan"]').click();
        cy.get('[data-id="nama-perusahaan"]').type("Maju Jaya");
        cy.get('[data-id="nib"]').type("20202020");
        cy.get('[data-id="select-pmdn"]')
            .select("1", { force: true })
            .should("have.value", "1");
        cy.get('[data-id="select-uraian-jenis-perusahaan"]')
            .select("2", { force: true })
            .should("have.value", "2");
        cy.get('[data-id="select-kabupaten"]')
            .select("", { force: true })
            .should("have.value", "");
        cy.get('[data-id="alamat-usaha"]').type("Jl.Suhat gunung Pucuk");
        cy.get('[data-id="email"]').type("MajuJaya@gmail.com");
        cy.get('[data-id="no_telp"]').type("083213123123");

        cy.get('[data-id="submit-perusahaan"]').click();
        cy.get(".invalid-feedback");
    });
    it("create perusahaan input Uraian Jenis Perusahaan kosong", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("data-table-management/perusahaan");
        cy.get('[data-id="tambah-perusahaan"]').click();
        cy.get('[data-id="nama-perusahaan"]').type("Maju Jaya");
        cy.get('[data-id="nib"]').type("20202020");
        cy.get('[data-id="select-pmdn"]')
            .select("1", { force: true })
            .should("have.value", "1");
        cy.get('[data-id="select-uraian-jenis-perusahaan"]')
            .select("", { force: true })
            .should("have.value", "");
        cy.get('[data-id="select-kabupaten"]')
            .select("1", { force: true })
            .should("have.value", "1");
        cy.get('[data-id="alamat-usaha"]').type("Jl.Suhat gunung Pucuk");
        cy.get('[data-id="email"]').type("MajuJaya@gmail.com");
        cy.get('[data-id="no_telp"]').type("083213123123");
        cy.get('[data-id="submit-perusahaan"]').click();
        cy.get(".invalid-feedback");
    });
    it("create perusahaan input alamat kosong", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("data-table-management/perusahaan");
        cy.get('[data-id="tambah-perusahaan"]').click();
        cy.get('[data-id="nama-perusahaan"]').type("Maju Jaya");
        cy.get('[data-id="nib"]').type("20202020");
        cy.get('[data-id="select-pmdn"]')
            .select("1", { force: true })
            .should("have.value", "1");
        cy.get('[data-id="select-uraian-jenis-perusahaan"]')
            .select("2", { force: true })
            .should("have.value", "2");
        cy.get('[data-id="select-kabupaten"]')
            .select("1", { force: true })
            .should("have.value", "1");
        cy.get('[data-id="email"]').type("MajuJaya@gmail.com");
        cy.get('[data-id="no_telp"]').type("083213123123");
        cy.get('[data-id="submit-perusahaan"]').click();
        cy.get(".invalid-feedback");
    });
    it("create perusahaan input alamat max 250 huruf", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("data-table-management/perusahaan");
        cy.get('[data-id="tambah-perusahaan"]').click();
        cy.get('[data-id="nama-perusahaan"]').type("Maju Jaya");
        cy.get('[data-id="nib"]').type("20202020");
        cy.get('[data-id="select-pmdn"]')
            .select("1", { force: true })
            .should("have.value", "1");
        cy.get('[data-id="select-uraian-jenis-perusahaan"]')
            .select("2", { force: true })
            .should("have.value", "2");
        cy.get('[data-id="select-kabupaten"]')
            .select("1", { force: true })
            .should("have.value", "1");
        cy.get('[data-id="alamat-usaha"]').type(
            "Jalan Raya Bogor, Kompleks Perumahan Taman Royal 2 Blok G Nomor 25 RT 001 RW 009 Kelurahan Baranangsiang Kecamatan Bogor Timur Kota Bogor Provinsi Jawa Barat Indonesia 16143, di sisi kiri jalan sebelum jembatan layang, dekat dengan pom bensin, seberangnya toko baju bernama Selaras."
        );
        cy.get('[data-id="email"]').type("MajuJaya@gmail.com");
        cy.get('[data-id="no_telp"]').type("083213123123");
        cy.get('[data-id="submit-perusahaan"]').click();
        cy.get(".invalid-feedback");
    });
    it("create perusahaan input email usaha kosong", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("data-table-management/perusahaan");
        cy.get('[data-id="tambah-perusahaan"]').click();
        cy.get('[data-id="nama-perusahaan"]').type("Maju Jaya");
        cy.get('[data-id="nib"]').type("20202020");
        cy.get('[data-id="select-pmdn"]')
            .select("1", { force: true })
            .should("have.value", "1");
        cy.get('[data-id="select-uraian-jenis-perusahaan"]')
            .select("2", { force: true })
            .should("have.value", "2");
        cy.get('[data-id="select-kabupaten"]')
            .select("1", { force: true })
            .should("have.value", "1");
        cy.get('[data-id="alamat-usaha"]').type("Jl.Suhat gunung Pucuk");
        cy.get('[data-id="no_telp"]').type("083213123123");
        cy.get('[data-id="submit-perusahaan"]').click();
        cy.get(".invalid-feedback");
    });

    it("create perusahaan input email usaha bukan email", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("data-table-management/perusahaan");
        cy.get('[data-id="tambah-perusahaan"]').click();
        cy.get('[data-id="nama-perusahaan"]').type("Maju Jaya");
        cy.get('[data-id="nib"]').type("20202020");
        cy.get('[data-id="select-pmdn"]')
            .select("1", { force: true })
            .should("have.value", "1");
        cy.get('[data-id="select-uraian-jenis-perusahaan"]')
            .select("2", { force: true })
            .should("have.value", "2");
        cy.get('[data-id="select-kabupaten"]')
            .select("1", { force: true })
            .should("have.value", "1");
        cy.get('[data-id="email"]').type("MajuJayagmail.com");
        cy.get('[data-id="alamat-usaha"]').type("Jl.Suhat gunung Pucuk");
        cy.get('[data-id="no_telp"]').type("083213123123");
        cy.get('[data-id="submit-perusahaan"]').click();
        cy.get(".invalid-feedback");
    });

    it("create perusahaan input No Telepon usaha kosong", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("data-table-management/perusahaan");
        cy.get('[data-id="tambah-perusahaan"]').click();
        cy.get('[data-id="nama-perusahaan"]').type("Maju Jaya");
        cy.get('[data-id="nib"]').type("20202020");
        cy.get('[data-id="select-pmdn"]')
            .select("1", { force: true })
            .should("have.value", "1");
        cy.get('[data-id="select-uraian-jenis-perusahaan"]')
            .select("2", { force: true })
            .should("have.value", "2");
        cy.get('[data-id="select-kabupaten"]')
            .select("1", { force: true })
            .should("have.value", "1");
        cy.get('[data-id="alamat-usaha"]').type("Jl.Suhat gunung Pucuk");
        cy.get('[data-id="email"]').type("MajuJaya@gmail.com");
        cy.get('[data-id="submit-perusahaan"]').click();
        cy.get(".invalid-feedback");
    });

    it("create perusahaan input nama perusahaan ada karakter", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("data-table-management/perusahaan");
        cy.get('[data-id="tambah-perusahaan"]').click();
        cy.get('[data-id="nama-perusahaan"]').type("Suhar@mawan");
        cy.get('[data-id="nib"]').type("20202020");
        cy.get('[data-id="select-pmdn"]')
            .select("1", { force: true })
            .should("have.value", "1");
        cy.get('[data-id="select-uraian-jenis-perusahaan"]')
            .select("2", { force: true })
            .should("have.value", "2");
        cy.get('[data-id="select-kabupaten"]')
            .select("1", { force: true })
            .should("have.value", "1");
        cy.get('[data-id="alamat-usaha"]').type("Jl.Suhat gunung Pucuk");
        cy.get('[data-id="email"]').type("MajuJaya@gmail.com");
        cy.get('[data-id="no_telp"]').type("083213123123");
        cy.get('[data-id="submit-perusahaan"]').click();
        cy.get(".invalid-feedback");
    });

    it("create perusahaan input nama perusahaan ada angka", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("data-table-management/perusahaan");
        cy.get('[data-id="tambah-perusahaan"]').click();
        cy.get('[data-id="nama-perusahaan"]').type("Suharm1awan");
        cy.get('[data-id="nib"]').type("20202020");
        cy.get('[data-id="select-pmdn"]')
            .select("1", { force: true })
            .should("have.value", "1");
        cy.get('[data-id="select-uraian-jenis-perusahaan"]')
            .select("2", { force: true })
            .should("have.value", "2");
        cy.get('[data-id="select-kabupaten"]')
            .select("1", { force: true })
            .should("have.value", "1");
        cy.get('[data-id="alamat-usaha"]').type("Jl.Suhat gunung Pucuk");
        cy.get('[data-id="email"]').type("MajuJaya@gmail.com");
        cy.get('[data-id="no_telp"]').type("083213123123");
        cy.get('[data-id="submit-perusahaan"]').click();
        cy.get(".invalid-feedback");
    });

    it("create perusahaan input nama perusahaan sama dengan database", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("data-table-management/perusahaan");
        cy.get('[data-id="tambah-perusahaan"]').click();
        cy.get('[data-id="nama-perusahaan"]').type("Suharmawan");
        cy.get('[data-id="nib"]').type("20202020");
        cy.get('[data-id="select-pmdn"]')
            .select("1", { force: true })
            .should("have.value", "1");
        cy.get('[data-id="select-uraian-jenis-perusahaan"]')
            .select("2", { force: true })
            .should("have.value", "2");
        cy.get('[data-id="select-kabupaten"]')
            .select("1", { force: true })
            .should("have.value", "1");
        cy.get('[data-id="alamat-usaha"]').type("Jl.Suhat gunung Pucuk");
        cy.get('[data-id="email"]').type("MajuJaya@gmail.com");
        cy.get('[data-id="no_telp"]').type("083213123123");
        cy.get('[data-id="submit-perusahaan"]').click();
        cy.get(".invalid-feedback");
    });

    it("create perusahaan input nib ada huruf", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("data-table-management/perusahaan");
        cy.get('[data-id="tambah-perusahaan"]').click();
        cy.get('[data-id="nama-perusahaan"]').type("Suharmawan");
        cy.get('[data-id="nib"]').type("2020a2020");
        cy.get('[data-id="select-pmdn"]')
            .select("1", { force: true })
            .should("have.value", "1");
        cy.get('[data-id="select-uraian-jenis-perusahaan"]')
            .select("2", { force: true })
            .should("have.value", "2");
        cy.get('[data-id="select-kabupaten"]')
            .select("1", { force: true })
            .should("have.value", "1");
        cy.get('[data-id="alamat-usaha"]').type("Jl.Suhat gunung Pucuk");
        cy.get('[data-id="email"]').type("MajuJaya@gmail.com");
        cy.get('[data-id="no_telp"]').type("083213123123");
        cy.get('[data-id="submit-perusahaan"]').click();
        cy.get(".invalid-feedback");
    });

    it("create perusahaan input nib sama dengan database", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("data-table-management/perusahaan");
        cy.get('[data-id="tambah-perusahaan"]').click();
        cy.get('[data-id="nama-perusahaan"]').type("Suharmawan");
        cy.get('[data-id="nib"]').type("0101230010181");
        cy.get('[data-id="select-pmdn"]')
            .select("1", { force: true })
            .should("have.value", "1");
        cy.get('[data-id="select-uraian-jenis-perusahaan"]')
            .select("2", { force: true })
            .should("have.value", "2");
        cy.get('[data-id="select-kabupaten"]')
            .select("1", { force: true })
            .should("have.value", "1");
        cy.get('[data-id="alamat-usaha"]').type("Jl.Suhat gunung Pucuk");
        cy.get('[data-id="email"]').type("MajuJaya@gmail.com");
        cy.get('[data-id="no_telp"]').type("083213123123");
        cy.get('[data-id="submit-perusahaan"]').click();
        cy.get(".invalid-feedback");
    });

    it("edit perusahaan input semua kosong", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("data-table-management/perusahaan");
        cy.get('[data-id="edt-1"]').click();
        cy.get('[data-id="nama-perusahaan"]').clear();
        cy.get('[data-id="select-kabupaten"]')
            .select("1", { force: true })
            .should("have.value", "1");
        cy.get('[data-id="nib"]').clear();
        cy.get('[data-id="email"]').clear();
        cy.get('[data-id="alamat-usaha"]').clear();
        cy.get('[data-id="no_telp"]').clear();
        cy.get('[data-id="submit-perusahaan"]').click();
        cy.get(".alert").contains("Edit Data Perusahaan Sukses");
    });
    it("edit perusahaan input nama perusahaan kosong", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("data-table-management/perusahaan");
        cy.get('[data-id="edt-1"]').click();
        cy.get('[data-id="nama-perusahaan"]').clear();
        cy.get('[data-id="select-kabupaten"]')
            .select("1", { force: true })
            .should("have.value", "1");
        cy.get('[data-id="nib"]').clear();
        cy.get('[data-id="nib"]').type("20202021");
        cy.get('[data-id="email"]').clear();
        cy.get('[data-id="email"]').type("MajuJaya@gmail.com");
        cy.get('[data-id="alamat-usaha"]').clear();
        cy.get('[data-id="alamat-usaha"]').type("Jalan Pacitan Nganjuk");
        cy.get('[data-id="no_telp"]').clear();
        cy.get('[data-id="no_telp"]').type("083213123123");
        cy.get('[data-id="submit-perusahaan"]').click();
        cy.get(".alert").contains("Edit Data Perusahaan Sukses");
    });
    it("edit perusahaan input nib kosong", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("data-table-management/perusahaan");
        cy.get('[data-id="edt-1"]').click();
        cy.get('[data-id="nama-perusahaan"]').clear();
        cy.get('[data-id="nama-perusahaan"]').type("Maju Jaya Bersama");
        cy.get('[data-id="select-kabupaten"]')
            .select("1", { force: true })
            .should("have.value", "1");
        cy.get('[data-id="nib"]').clear();
        cy.get('[data-id="email"]').clear();
        cy.get('[data-id="email"]').type("MajuJaya@gmail.com");
        cy.get('[data-id="alamat-usaha"]').clear();
        cy.get('[data-id="alamat-usaha"]').type("Jalan Pacitan Nganjuk");
        cy.get('[data-id="no_telp"]').clear();
        cy.get('[data-id="no_telp"]').type("083213123123");
        cy.get('[data-id="submit-perusahaan"]').click();
        cy.get(".alert").contains("Edit Data Perusahaan Sukses");
    });

    it("edit perusahaan input alamat usaha kosong", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("data-table-management/perusahaan");
        cy.get('[data-id="edt-1"]').click();
        cy.get('[data-id="nama-perusahaan"]').clear();
        cy.get('[data-id="nama-perusahaan"]').type("Maju Jaya Bersama");
        cy.get('[data-id="select-kabupaten"]')
            .select("1", { force: true })
            .should("have.value", "1");
        cy.get('[data-id="nib"]').clear();
        cy.get('[data-id="nib"]').type("20202021");
        cy.get('[data-id="email"]').clear();
        cy.get('[data-id="email"]').type("MajuJaya@gmail.com");
        cy.get('[data-id="alamat-usaha"]').clear();
        cy.get('[data-id="no_telp"]').clear();
        cy.get('[data-id="no_telp"]').type("083213123123");
        cy.get('[data-id="submit-perusahaan"]').click();
        cy.get(".alert").contains("Edit Data Perusahaan Sukses");
    });
    it("edit perusahaan input nama perusahan ada karakter", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("data-table-management/perusahaan");
        cy.get('[data-id="edt-1"]').click();
        cy.get('[data-id="nama-perusahaan"]').clear();
        cy.get('[data-id="nama-perusahaan"]').type("Maju Jaya Bersam@a");
        cy.get('[data-id="select-kabupaten"]')
            .select("1", { force: true })
            .should("have.value", "1");
        cy.get('[data-id="nib"]').clear();
        cy.get('[data-id="nib"]').type("20202021");
        cy.get('[data-id="email"]').clear();
        cy.get('[data-id="email"]').type("MajuJaya@gmail.com");
        cy.get('[data-id="alamat-usaha"]').clear();
        cy.get('[data-id="alamat-usaha"]').type("Jalan Pacitan Nganjuk");
        cy.get('[data-id="no_telp"]').clear();
        cy.get('[data-id="no_telp"]').type("083213123123");
        cy.get('[data-id="submit-perusahaan"]').click();
        cy.get(".alert").contains("Edit Data Perusahaan Sukses");
    });
    it("edit perusahaan input nama perusahaan ada angka", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("data-table-management/perusahaan");
        cy.get('[data-id="edt-1"]').click();
        cy.get('[data-id="nama-perusahaan"]').clear();
        cy.get('[data-id="nama-perusahaan"]').type("Maju Jaya B1ersama");
        cy.get('[data-id="select-kabupaten"]')
            .select("1", { force: true })
            .should("have.value", "1");
        cy.get('[data-id="nib"]').clear();
        cy.get('[data-id="nib"]').type("20202021");
        cy.get('[data-id="email"]').clear();
        cy.get('[data-id="email"]').type("MajuJaya@gmail.com");
        cy.get('[data-id="alamat-usaha"]').clear();
        cy.get('[data-id="alamat-usaha"]').type("Jalan Pacitan Nganjuk");
        cy.get('[data-id="no_telp"]').clear();
        cy.get('[data-id="no_telp"]').type("083213123123");
        cy.get('[data-id="submit-perusahaan"]').click();
        cy.get(".alert").contains("Edit Data Perusahaan Sukses");
    });
    it("edit perusahaan input nama perusahaan sudah ada perusahaan", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("data-table-management/perusahaan");
        cy.get('[data-id="edt-1"]').click();
        cy.get('[data-id="nama-perusahaan"]').clear();
        cy.get('[data-id="nama-perusahaan"]').type("Suharmawan");
        cy.get('[data-id="select-kabupaten"]')
            .select("1", { force: true })
            .should("have.value", "1");
        cy.get('[data-id="nib"]').clear();
        cy.get('[data-id="nib"]').type("20202021");
        cy.get('[data-id="email"]').clear();
        cy.get('[data-id="email"]').type("MajuJaya@gmail.com");
        cy.get('[data-id="alamat-usaha"]').clear();
        cy.get('[data-id="alamat-usaha"]').type("Jalan Pacitan Nganjuk");
        cy.get('[data-id="no_telp"]').clear();
        cy.get('[data-id="no_telp"]').type("083213123123");
        cy.get('[data-id="submit-perusahaan"]').click();
        cy.get(".alert").contains("Edit Data Perusahaan Sukses");
    });
    it("edit perusahaan input nib ada karakter", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("data-table-management/perusahaan");
        cy.get('[data-id="edt-1"]').click();
        cy.get('[data-id="nama-perusahaan"]').clear();
        cy.get('[data-id="nama-perusahaan"]').type("Maju Jaya Bersama");
        cy.get('[data-id="select-kabupaten"]')
            .select("1", { force: true })
            .should("have.value", "1");
        cy.get('[data-id="nib"]').clear();
        cy.get('[data-id="nib"]').type("2020@2021");
        cy.get('[data-id="email"]').clear();
        cy.get('[data-id="email"]').type("MajuJaya@gmail.com");
        cy.get('[data-id="alamat-usaha"]').clear();
        cy.get('[data-id="alamat-usaha"]').type("Jalan Pacitan Nganjuk");
        cy.get('[data-id="no_telp"]').clear();
        cy.get('[data-id="no_telp"]').type("083213123123");
        cy.get('[data-id="submit-perusahaan"]').click();
        cy.get(".alert").contains("Edit Data Perusahaan Sukses");
    });
    it("edit perusahaan input nib ada huruf", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("data-table-management/perusahaan");
        cy.get('[data-id="edt-1"]').click();
        cy.get('[data-id="nama-perusahaan"]').clear();
        cy.get('[data-id="nama-perusahaan"]').type("Maju Jaya Bersama");
        cy.get('[data-id="select-kabupaten"]')
            .select("1", { force: true })
            .should("have.value", "1");
        cy.get('[data-id="nib"]').clear();
        cy.get('[data-id="nib"]').type("20202021");
        cy.get('[data-id="email"]').clear();
        cy.get('[data-id="email"]').type("MajuJaya@gmail.com");
        cy.get('[data-id="alamat-usaha"]').clear();
        cy.get('[data-id="alamat-usaha"]').type("Jalan Pacitan Nganjuk");
        cy.get('[data-id="no_telp"]').clear();
        cy.get('[data-id="no_telp"]').type("083213123123");
        cy.get('[data-id="submit-perusahaan"]').click();
        cy.get(".alert").contains("Edit Data Perusahaan Sukses");
    });
    it("edit perusahaan input nib sudah ada didatabase", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("data-table-management/perusahaan");
        cy.get('[data-id="edt-1"]').click();
        cy.get('[data-id="nama-perusahaan"]').clear();
        cy.get('[data-id="nama-perusahaan"]').type("Maju Jaya Bersama");
        cy.get('[data-id="select-kabupaten"]')
            .select("1", { force: true })
            .should("have.value", "1");
        cy.get('[data-id="nib"]').clear();
        cy.get('[data-id="nib"]').type("0101230010181");
        cy.get('[data-id="email"]').clear();
        cy.get('[data-id="email"]').type("MajuJaya@gmail.com");
        cy.get('[data-id="alamat-usaha"]').clear();
        cy.get('[data-id="alamat-usaha"]').type("Jalan Pacitan Nganjuk");
        cy.get('[data-id="no_telp"]').clear();
        cy.get('[data-id="no_telp"]').type("083213123123");
        cy.get('[data-id="submit-perusahaan"]').click();
        cy.get(".alert").contains("Edit Data Perusahaan Sukses");
    });

    it("edit perusahaan input alamat usaha maximal 250 huruf", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("data-table-management/perusahaan");
        cy.get('[data-id="edt-1"]').click();
        cy.get('[data-id="nama-perusahaan"]').clear();
        cy.get('[data-id="nama-perusahaan"]').type("Maju Jaya Bersama");
        cy.get('[data-id="select-kabupaten"]')
            .select("1", { force: true })
            .should("have.value", "1");
        cy.get('[data-id="nib"]').clear();
        cy.get('[data-id="nib"]').type("20202021");
        cy.get('[data-id="email"]').clear();
        cy.get('[data-id="email"]').type("MajuJaya@gmail.com");
        cy.get('[data-id="alamat-usaha"]').clear();
        cy.get('[data-id="alamat-usaha"]').type(
            "Jalan PacitanJalan PacitanJalan PacitanJalan PacitanJalan PacitanJalan PacitanJalan PacitanJalan PacitanJalan PacitanJalan PacitanJalan PacitanJalan PacitanJalan PacitanJalan PacitanJalan PacitanJalan PacitanJalan PacitanJalan PacitanJalan PacitanJalan PacitanJalan PacitanJalan PacitanJalan PacitanJalan PacitanJalan PacitanJalan PacitanJalan PacitanJalan PacitanJalan PacitanJalan PacitanJalan PacitanJalan PacitanJalan PacitanJalan PacitanJalan PacitanJalan Pacitan"
        );
        cy.get('[data-id="no_telp"]').clear();
        cy.get('[data-id="no_telp"]').type("083213123123");
        cy.get('[data-id="submit-perusahaan"]').click();
        cy.get(".alert").contains("Edit Data Perusahaan Sukses");
    });

    it("pencarian perusahaan tidak ada didatabase", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("data-table-management/perusahaan");
        cy.get('[data-id="search"]').click();
        cy.get('[data-id="search-perusahaan"]').clear();
        cy.get('[data-id="search-perusahaan"]').type("LOPE LOPE");
        cy.get('[data-id="submit-search"]').click();
        cy.get(".table > tbody > tr > :nth-child(2)").should("be.visible");
    });
    it("pencarian perusahaan input kosong", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("data-table-management/perusahaan");
        cy.get('[data-id="search"]').click();
        cy.get('[data-id="search-perusahaan"]').clear();
        cy.get('[data-id="submit-search"]').click();
        cy.get(".table > tbody > tr > :nth-child(2)").should("be.visible");
    });
});
