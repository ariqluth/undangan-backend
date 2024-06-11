describe("positive case", function () {
    beforeEach(function () {
        cy.fixture("scenario").then(function (data) {
            this.data = data;
        });
    });

    it("create kbli perusahaan", function () {
        cy.resetDb();
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("/data-table-management/kbli-perusahaan");
        cy.get('[data-id="tambah"]').click();
        // page-1
        cy.get('[data-id="select-nama-perusahaan"]')
            .select("1", { force: true })
            .should("have.value", "1");
        cy.get('[data-id="select-kbli"]')
            .select("3", { force: true })
            .should("have.value", "3");
        cy.get('[data-id="kode-proyek"]').type("R-202301012338152771917");
        cy.get('[data-id="npwp"]').type("773298419647000");
        cy.get('[data-id="next1"]').click();
        // page 2
        cy.get('[data-id="select-kecamatan"]')
            .select("1", { force: true })
            .should("have.value", "1");
        cy.get('[data-id="select-kelurahan"]')
            .select("3", { force: true })
            .should("have.value", "3");
        cy.get('[data-id="lg-longtitude"]').type("111.15015341971007");
        cy.get('[data-id="la-latitude"]').type("-8.12482089690483");
        cy.get('[data-id="alamat"]').type(" JI-136");
        cy.get('[data-id="next-2"]').click();
        // page 3
        cy.get('[data-id="select-profile-pengusaha"]')
            .select("4", { force: true })
            .should("have.value", "4");
        cy.get('[data-id="select-uraian-resiko-proyek"]')
            .select("1", { force: true })
            .should("have.value", "1");
        cy.get('[data-id="select-uraian-skala-usaha"]')
            .select("1", { force: true })
            .should("have.value", "1");
        cy.get('[data-id="next-3"]').click();
        // page 4
        cy.get('[data-id="mesin-peralatan"]').type("0");
        cy.get('[data-id="mesin-peralatan-impor"]').type("0");
        cy.get('[data-id="pembelian-pematangan-tanah"]').type("0");
        cy.get('[data-id="bangunan-gedung"]').type("0");
        cy.get('[data-id="lain-lain"]').type("0");
        cy.get('[data-id="modal-kerja"]').type("0");
        cy.get('[data-id="jumlah-investasi"]').type("100000");
        cy.get('[data-id="tenaga-kerja"]').type("100");
        cy.get('[data-id="submit"]').click();
        cy.get(".alert").contains("Tambah Data Kbli Perusahaan");
    });

    it("edit kbli", function () {
        cy.resetDb();
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("/data-table-management/kbli-perusahaan");
        cy.get('[data-id="edt-1"]').click();
        // page-1
        cy.get('[data-id="select-nama-perusahaan"]')
            .select("1", { force: true })
            .should("have.value", "1");
        cy.get('[data-id="select-kbli"]')
            .select("3", { force: true })
            .should("have.value", "3");
        cy.get('[data-id="kode-proyek"]').clear();
        cy.get('[data-id="kode-proyek"]').type("R-202301012338152771917");
        cy.get('[data-id="npwp"]').clear();
        cy.get('[data-id="npwp"]').type("773298419647000");
        cy.get('[data-id="next1"]').click();
        // page 2
        cy.get('[data-id="select-kecamatan"]')
            .select("1", { force: true })
            .should("have.value", "1");
        cy.get('[data-id="select-kelurahan"]')
            .select("3", { force: true })
            .should("have.value", "3");
        cy.get('[data-id="lg-longtitude"]').clear();
        cy.get('[data-id="lg-longtitude"]').type("111.15015341971007");
        cy.get('[data-id="la-latitude"]').clear();
        cy.get('[data-id="la-latitude"]').type("-8.12482089690483");
        cy.get('[data-id="alamat"]').clear();
        cy.get('[data-id="alamat"]').type(" JI-136");
        cy.get('[data-id="next-2"]').click();
        // page 3
        cy.get('[data-id="select-profile-pengusaha"]')
            .select("4", { force: true })
            .should("have.value", "4");
        cy.get('[data-id="select-uraian-resiko-proyek"]')
            .select("1", { force: true })
            .should("have.value", "1");
        cy.get('[data-id="select-uraian-skala-usaha"]')
            .select("1", { force: true })
            .should("have.value", "1");
        cy.get('[data-id="next-3"]').click();
        // page 4
        cy.get('[data-id="mesin-peralatan"]').clear();
        cy.get('[data-id="mesin-peralatan"]').type("0");
        cy.get('[data-id="mesin-peralatan-impor"]').clear();
        cy.get('[data-id="mesin-peralatan-impor"]').type("0");
        cy.get('[data-id="pembelian-pematangan-tanah"]').clear();
        cy.get('[data-id="pembelian-pematangan-tanah"]').type("0");
        cy.get('[data-id="bangunan-gedung"]').clear();
        cy.get('[data-id="bangunan-gedung"]').type("0");
        cy.get('[data-id="lain-lain"]').clear();
        cy.get('[data-id="lain-lain"]').type("0");
        cy.get('[data-id="modal-kerja"]').clear();
        cy.get('[data-id="modal-kerja"]').type("0");
        cy.get('[data-id="jumlah-investasi"]').clear();
        cy.get('[data-id="jumlah-investasi"]').type("100000");
        cy.get('[data-id="tenaga-kerja"]').clear();
        cy.get('[data-id="tenaga-kerja"]').type("100");
        cy.get('[data-id="submit"]').click();
        cy.get(".alert").contains("Edit Data Kbli Perusahaan Sukses");
    });

    it("hapus Kbli perusahaan", function () {
        cy.resetDb();
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("/data-table-management/kbli-perusahaan");
        cy.get('[data-id="del-1"]').click();
        cy.contains("Yes").click({ force: true });
        cy.get(".alert").contains("Hapus Data Kbli Perusahaan Sukses");
    });

    it("pencarian nama perusahaan", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("/data-table-management/kbli-perusahaan");
        cy.get('[data-id="search"]').click();
        cy.get('[data-id="search-perusahaan"]').type("SUPARNI");
        cy.get('[data-id="submit-search"]').click();
    });


    it("pencarian nama pengusaha", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("/data-table-management/kbli-perusahaan");
        cy.get('[data-id="search"]').click();
        cy.get('[data-id="search-pengusaha"]').type("Suharmawan");
        cy.get('[data-id="submit-search"]').click();
    });

    it("pencarian alamat", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("/data-table-management/kbli-perusahaan");
        cy.get('[data-id="search"]').click();
        cy.get('[data-id="search-search"]').type("Dusun Krajan 001/004");
        cy.get('[data-id="submit-search"]').click();
    });


    it("pencarian kbli ", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("/data-table-management/kbli-perusahaan");
        cy.get('[data-id="search"]').click();
        cy.get('[data-id="select-kbli"]').select(["1","3"], { force: true });
        cy.get('[data-id="submit-search"]').click();
    });

    it("pencarian kecamatan ", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("/data-table-management/kbli-perusahaan");
        cy.get('[data-id="search"]').click();
        cy.get('[data-id="select-Kecamatan"]').select(["1","3"], { force: true });
        cy.get('[data-id="submit-search"]').click();
    });


    it("pencarian kelurahan ", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("/data-table-management/kbli-perusahaan");
        cy.get('[data-id="search"]').click();
        cy.get('[data-id="select-kelurahan"]').select(["1","3"], { force: true });
        cy.get('[data-id="submit-search"]').click();
    });
});

describe("negative case", function () {
    beforeEach(function () {
        cy.fixture("scenario").then(function (data) {
            this.data = data;
        });
    });

    it("create kbli input page 1 npwp menggunakan huruf", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("/data-table-management/kbli-perusahaan");
        cy.get('[data-id="tambah"]').click();
        // page-1
        cy.get('[data-id="select-nama-perusahaan"]')
            .select("1", { force: true })
            .should("have.value", "1");
        cy.get('[data-id="select-kbli"]')
            .select("3", { force: true })
            .should("have.value", "3");
        cy.get('[data-id="kode-proyek"]').type("R-202301012338152771917");
        cy.get('[data-id="npwp"]').type("halo ser");
        cy.get('[data-id="next1"]').click();
        cy.get(".invalid-feedback");
    });

    it("create kbli input page 1 npwp min 3 huruf", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("/data-table-management/kbli-perusahaan");
        cy.get('[data-id="tambah"]').click();
        // page-1
        cy.get('[data-id="select-nama-perusahaan"]')
            .select("1", { force: true })
            .should("have.value", "1");
        cy.get('[data-id="select-kbli"]')
            .select("3", { force: true })
            .should("have.value", "3");
        cy.get('[data-id="kode-proyek"]').type("R-202301012338152771917");
        cy.get('[data-id="npwp"]').type("7");
        cy.get('[data-id="next1"]').click();
        // page 2
        cy.get(".invalid-feedback");
    });


    it("create kbli input page 1 npwp max 60 huruf", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("/data-table-management/kbli-perusahaan");
        cy.get('[data-id="tambah"]').click();
        // page-1
        cy.get('[data-id="select-nama-perusahaan"]')
            .select("1", { force: true })
            .should("have.value", "1");
        cy.get('[data-id="select-kbli"]')
            .select("3", { force: true })
            .should("have.value", "3");
        cy.get('[data-id="kode-proyek"]').type("R-202301012338152771917");
        cy.get('[data-id="npwp"]').type("723132313213231231321312321421401220312");
        cy.get('[data-id="next1"]').click();
        // page 2
        cy.get(".invalid-feedback");
    });

    it("create kbli input page 2 kosong", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("/data-table-management/kbli-perusahaan");
        cy.get('[data-id="tambah"]').click();
        // page-1
        cy.get('[data-id="select-nama-perusahaan"]')
            .select("1", { force: true })
            .should("have.value", "1");
        cy.get('[data-id="select-kbli"]')
            .select("3", { force: true })
            .should("have.value", "3");
        cy.get('[data-id="kode-proyek"]').type("R-202301012338152771917");
        cy.get('[data-id="npwp"]').type("773298419647000");
        cy.get('[data-id="next1"]').click();
        // page 2
        cy.get('[data-id="select-kecamatan"]')
            .select("", { force: true })
            .should("have.value", "");
        cy.get('[data-id="select-kelurahan"]')
            .select("", { force: true })
            .should("have.value", "");
        cy.get('[data-id="next-2"]').click();
        cy.get(".invalid-feedback");
    });

    it("create kbli input page 3 kosong", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("/data-table-management/kbli-perusahaan");
        cy.get('[data-id="tambah"]').click();
        // page-1
        cy.get('[data-id="select-nama-perusahaan"]')
            .select("1", { force: true })
            .should("have.value", "1");
        cy.get('[data-id="select-kbli"]')
            .select("3", { force: true })
            .should("have.value", "3");
        cy.get('[data-id="kode-proyek"]').type("R-202301012338152771917");
        cy.get('[data-id="npwp"]').type("773298419647000");
        cy.get('[data-id="next1"]').click();
        // page 2
        cy.get('[data-id="select-kecamatan"]')
            .select("1", { force: true })
            .should("have.value", "1");
        cy.get('[data-id="select-kelurahan"]')
            .select("3", { force: true })
            .should("have.value", "3");
        cy.get('[data-id="lg-longtitude"]').type("111.15015341971007");
        cy.get('[data-id="la-latitude"]').type("-8.12482089690483");
        cy.get('[data-id="alamat"]').type(" JI-136");
        cy.get('[data-id="next-2"]').click();
        // page 3
        cy.get('[data-id="select-profile-pengusaha"]')
            .select("", { force: true })
            .should("have.value", "");
        cy.get('[data-id="select-uraian-resiko-proyek"]')
            .select("", { force: true })
            .should("have.value", "");
        cy.get('[data-id="select-uraian-skala-usaha"]')
            .select("", { force: true })
            .should("have.value", "");
        cy.get('[data-id="next-3"]').click();
        // page 4
        cy.get(".invalid-feedback");
    });


    it("create kbli input page 3 longtitude dan latitude min 3 huruf", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("/data-table-management/kbli-perusahaan");
        cy.get('[data-id="tambah"]').click();
        // page-1
        cy.get('[data-id="select-nama-perusahaan"]')
            .select("1", { force: true })
            .should("have.value", "1");
        cy.get('[data-id="select-kbli"]')
            .select("3", { force: true })
            .should("have.value", "3");
        cy.get('[data-id="kode-proyek"]').type("R-202301012338152771917");
        cy.get('[data-id="npwp"]').type("773298419647000");
        cy.get('[data-id="next1"]').click();
        // page 2
        cy.get('[data-id="select-kecamatan"]')
            .select("1", { force: true })
            .should("have.value", "1");
        cy.get('[data-id="select-kelurahan"]')
            .select("3", { force: true })
            .should("have.value", "3");
        cy.get('[data-id="lg-longtitude"]').type("11");
        cy.get('[data-id="la-latitude"]').type("-8");
        cy.get('[data-id="alamat"]').type(" JI-136");
        cy.get('[data-id="next-2"]').click();
        // page 3
        cy.get('[data-id="select-profile-pengusaha"]')
            .select("", { force: true })
            .should("have.value", "");
        cy.get('[data-id="select-uraian-resiko-proyek"]')
            .select("", { force: true })
            .should("have.value", "");
        cy.get('[data-id="select-uraian-skala-usaha"]')
            .select("", { force: true })
            .should("have.value", "");
        cy.get('[data-id="next-3"]').click();
        // page 4
        cy.get(".invalid-feedback");
    });


    it("create kbli input page 3 max 60 huruf longtituedd dan latitude", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("/data-table-management/kbli-perusahaan");
        cy.get('[data-id="tambah"]').click();
        // page-1
        cy.get('[data-id="select-nama-perusahaan"]')
            .select("1", { force: true })
            .should("have.value", "1");
        cy.get('[data-id="select-kbli"]')
            .select("3", { force: true })
            .should("have.value", "3");
        cy.get('[data-id="kode-proyek"]').type("R-202301012338152771917");
        cy.get('[data-id="npwp"]').type("773298419647000");
        cy.get('[data-id="next1"]').click();
        // page 2
        cy.get('[data-id="select-kecamatan"]')
            .select("1", { force: true })
            .should("have.value", "1");
        cy.get('[data-id="select-kelurahan"]')
            .select("3", { force: true })
            .should("have.value", "3");
        cy.get('[data-id="lg-longtitude"]').type("110000000000000000000000");
        cy.get('[data-id="la-latitude"]').type("-8000000000000000000000000000000");
        cy.get('[data-id="alamat"]').type(" JI-136");
        cy.get('[data-id="next-2"]').click();
        // page 3
        cy.get('[data-id="select-profile-pengusaha"]')
            .select("", { force: true })
            .should("have.value", "");
        cy.get('[data-id="select-uraian-resiko-proyek"]')
            .select("", { force: true })
            .should("have.value", "");
        cy.get('[data-id="select-uraian-skala-usaha"]')
            .select("", { force: true })
            .should("have.value", "");
        cy.get('[data-id="next-3"]').click();
        // page 4
        cy.get(".invalid-feedback");
    });

    it("create kbli input page 4 kosong", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("/data-table-management/kbli-perusahaan");
        cy.get('[data-id="tambah"]').click();
        // page-1
        cy.get('[data-id="select-nama-perusahaan"]')
            .select("1", { force: true })
            .should("have.value", "1");
        cy.get('[data-id="select-kbli"]')
            .select("3", { force: true })
            .should("have.value", "3");
        cy.get('[data-id="kode-proyek"]').type("R-202301012338152771917");
        cy.get('[data-id="npwp"]').type("773298419647000");
        cy.get('[data-id="next1"]').click();
        // page 2
        cy.get('[data-id="select-kecamatan"]')
            .select("1", { force: true })
            .should("have.value", "1");
        cy.get('[data-id="select-kelurahan"]')
            .select("3", { force: true })
            .should("have.value", "3");
        cy.get('[data-id="lg-longtitude"]').type("111.15015341971007");
        cy.get('[data-id="la-latitude"]').type("-8.12482089690483");
        cy.get('[data-id="alamat"]').type(" JI-136");
        cy.get('[data-id="next-2"]').click();
        // page 3
        cy.get('[data-id="select-profile-pengusaha"]')
            .select("4", { force: true })
            .should("have.value", "4");
        cy.get('[data-id="select-uraian-resiko-proyek"]')
            .select("1", { force: true })
            .should("have.value", "1");
        cy.get('[data-id="select-uraian-skala-usaha"]')
            .select("1", { force: true })
            .should("have.value", "1");
        cy.get('[data-id="next-3"]').click();
        // page 4
        cy.get('[data-id="submit"]').click();
        cy.get(".invalid-feedback");
    });

    it("create kbli input page 4 menggunakan huruf ", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("/data-table-management/kbli-perusahaan");
        cy.get('[data-id="tambah"]').click();
        // page-1
        cy.get('[data-id="select-nama-perusahaan"]')
            .select("1", { force: true })
            .should("have.value", "1");
        cy.get('[data-id="select-kbli"]')
            .select("3", { force: true })
            .should("have.value", "3");
        cy.get('[data-id="kode-proyek"]').type("R-202301012338152771917");
        cy.get('[data-id="npwp"]').type("773298419647000");
        cy.get('[data-id="next1"]').click();
        // page 2
        cy.get('[data-id="select-kecamatan"]')
            .select("1", { force: true })
            .should("have.value", "1");
        cy.get('[data-id="select-kelurahan"]')
            .select("3", { force: true })
            .should("have.value", "3");
        cy.get('[data-id="lg-longtitude"]').type("111.15015341971007");
        cy.get('[data-id="la-latitude"]').type("-8.12482089690483");
        cy.get('[data-id="alamat"]').type(" JI-136");
        cy.get('[data-id="next-2"]').click();
        // page 3
        cy.get('[data-id="select-profile-pengusaha"]')
            .select("4", { force: true })
            .should("have.value", "4");
        cy.get('[data-id="select-uraian-resiko-proyek"]')
            .select("1", { force: true })
            .should("have.value", "1");
        cy.get('[data-id="select-uraian-skala-usaha"]')
            .select("1", { force: true })
            .should("have.value", "1");
        cy.get('[data-id="next-3"]').click();
        // page 4
        cy.get('[data-id="mesin-peralatan"]').type("halo");
        cy.get('[data-id="mesin-peralatan-impor"]').type("halo");
        cy.get('[data-id="pembelian-pematangan-tanah"]').type("halo");
        cy.get('[data-id="bangunan-gedung"]').type("halo");
        cy.get('[data-id="lain-lain"]').type("halo");
        cy.get('[data-id="modal-kerja"]').type("halo");
        cy.get('[data-id="jumlah-investasi"]').type("halo");
        cy.get('[data-id="tenaga-kerja"]').type("halo");

        cy.get('[data-id="submit"]').click();
        cy.get(".invalid-feedback");
    });

    it("edit kbli input page 1 kosong semua", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("/data-table-management/kbli-perusahaan");
        cy.get('[data-id="edt-1"]').click();
        // page-1
        cy.get('[data-id="select-nama-perusahaan"]')
            .select("", { force: true })
            .should("have.value", "");
        cy.get('[data-id="select-kbli"]')
            .select("", { force: true })
            .should("have.value", "");

        cy.get('[data-id="next1"]').click();
        cy.get(".invalid-feedback");
    });

    it("edit kbli input page 1 npwp menggunakan huruf", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("/data-table-management/kbli-perusahaan");
        cy.get('[data-id="tambah"]').click();
        // page-1
        cy.get('[data-id="select-nama-perusahaan"]')
            .select("1", { force: true })
            .should("have.value", "1");
        cy.get('[data-id="select-kbli"]')
            .select("3", { force: true })
            .should("have.value", "3");
        cy.get('[data-id="kode-proyek"]').type("R-202301012338152771917");
        cy.get('[data-id="npwp"]').type("halo ser");
        cy.get('[data-id="next1"]').click();
        cy.get(".invalid-feedback");
    });

    it("edit kbli input page 2 kosong", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("/data-table-management/kbli-perusahaan");
        cy.get('[data-id="edt-1"]').click();
        // page-1
        cy.get('[data-id="select-nama-perusahaan"]')
            .select("1", { force: true })
            .should("have.value", "1");
        cy.get('[data-id="select-kbli"]')
            .select("3", { force: true })
            .should("have.value", "3");
        cy.get('[data-id="kode-proyek"]').type("R-202301012338152771917");
        cy.get('[data-id="npwp"]').type("773298419647000");
        cy.get('[data-id="next1"]').click();
        // page 2
        cy.get('[data-id="select-kecamatan"]')
            .select("", { force: true })
            .should("have.value", "");
        cy.get('[data-id="select-kelurahan"]')
            .select("", { force: true })
            .should("have.value", "");
        cy.get('[data-id="next-2"]').click();
        cy.get(".invalid-feedback");
    });
    it("edit kbli input page 1 npwp min 3 huruf", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("/data-table-management/kbli-perusahaan");
        cy.get('[data-id="tambah"]').click();
        // page-1
        cy.get('[data-id="select-nama-perusahaan"]')
            .select("1", { force: true })
            .should("have.value", "1");
        cy.get('[data-id="select-kbli"]')
            .select("3", { force: true })
            .should("have.value", "3");
        cy.get('[data-id="kode-proyek"]').type("R-202301012338152771917");
        cy.get('[data-id="npwp"]').clear();
        cy.get('[data-id="npwp"]').type("7");
        cy.get('[data-id="next1"]').click();
        // page 2
        cy.get(".invalid-feedback");
    });


    it("edit kbli input page 1 npwp max 60 huruf", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("/data-table-management/kbli-perusahaan");
        cy.get('[data-id="tambah"]').click();
        // page-1
        cy.get('[data-id="select-nama-perusahaan"]')
            .select("1", { force: true })
            .should("have.value", "1");
        cy.get('[data-id="select-kbli"]')
            .select("3", { force: true })
            .should("have.value", "3");
        cy.get('[data-id="kode-proyek"]').type("R-202301012338152771917");
        cy.get('[data-id="npwp"]').type("723132313213231231321312321421401220312");
        cy.get('[data-id="next1"]').click();
        // page 2
        cy.get(".invalid-feedback");
    });
    it("edit kbli input page 3 kosong", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("/data-table-management/kbli-perusahaan");
        cy.get('[data-id="edt-1"]').click();
        // page-1
        cy.get('[data-id="select-nama-perusahaan"]')
            .select("1", { force: true })
            .should("have.value", "1");
        cy.get('[data-id="select-kbli"]')
            .select("3", { force: true })
            .should("have.value", "3");
        cy.get('[data-id="kode-proyek"]').type("R-202301012338152771917");
        cy.get('[data-id="npwp"]').type("773298419647000");
        cy.get('[data-id="next1"]').click();
        // page 2
        cy.get('[data-id="select-kecamatan"]')
            .select("1", { force: true })
            .should("have.value", "1");
        cy.get('[data-id="select-kelurahan"]')
            .select("3", { force: true })
            .should("have.value", "3");
        cy.get('[data-id="lg-longtitude"]').type("111.15015341971007");
        cy.get('[data-id="la-latitude"]').type("-8.12482089690483");
        cy.get('[data-id="alamat"]').type(" JI-136");
        cy.get('[data-id="next-2"]').click();
        // page 3
        cy.get('[data-id="select-profile-pengusaha"]')
            .select("", { force: true })
            .should("have.value", "");
        cy.get('[data-id="select-uraian-resiko-proyek"]')
            .select("", { force: true })
            .should("have.value", "");
        cy.get('[data-id="select-uraian-skala-usaha"]')
            .select("", { force: true })
            .should("have.value", "");
        cy.get('[data-id="next-3"]').click();
        // page 4
        cy.get(".invalid-feedback");
    });

    it("edit kbli input page 3 longtitude dan latitude min 3 huruf", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("/data-table-management/kbli-perusahaan");
        cy.get('[data-id="edt-1"]').click();
        // page-1
        cy.get('[data-id="select-nama-perusahaan"]')
            .select("1", { force: true })
            .should("have.value", "1");
        cy.get('[data-id="select-kbli"]')
            .select("3", { force: true })
            .should("have.value", "3");
        cy.get('[data-id="kode-proyek"]').type("R-202301012338152771917");
        cy.get('[data-id="npwp"]').type("773298419647000");
        cy.get('[data-id="next1"]').click();
        // page 2
        cy.get('[data-id="select-kecamatan"]')
            .select("1", { force: true })
            .should("have.value", "1");
        cy.get('[data-id="select-kelurahan"]')
            .select("3", { force: true })
            .should("have.value", "3");
        cy.get('[data-id="lg-longtitude"]').clear();
        cy.get('[data-id="la-latitude"]').clear();
        cy.get('[data-id="lg-longtitude"]').type("11");
        cy.get('[data-id="la-latitude"]').type("-8");
        cy.get('[data-id="alamat"]').type(" JI-136");
        cy.get('[data-id="next-2"]').click();
        // page 3
        cy.get('[data-id="select-profile-pengusaha"]')
            .select("", { force: true })
            .should("have.value", "");
        cy.get('[data-id="select-uraian-resiko-proyek"]')
            .select("", { force: true })
            .should("have.value", "");
        cy.get('[data-id="select-uraian-skala-usaha"]')
            .select("", { force: true })
            .should("have.value", "");
        cy.get('[data-id="next-3"]').click();
        // page 4
        cy.get(".invalid-feedback");
    });


    it("edit kbli input page 3 max 60 huruf longtituedd dan latitude", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("/data-table-management/kbli-perusahaan");
        cy.get('[data-id=edt-1"]').click();
        // page-1
        cy.get('[data-id="select-nama-perusahaan"]')
            .select("1", { force: true })
            .should("have.value", "1");
        cy.get('[data-id="select-kbli"]')
            .select("3", { force: true })
            .should("have.value", "3");
        cy.get('[data-id="kode-proyek"]').type("R-202301012338152771917");
        cy.get('[data-id="npwp"]').type("773298419647000");
        cy.get('[data-id="next1"]').click();
        // page 2
        cy.get('[data-id="select-kecamatan"]')
            .select("1", { force: true })
            .should("have.value", "1");
        cy.get('[data-id="select-kelurahan"]')
            .select("3", { force: true })
            .should("have.value", "3");
        cy.get('[data-id="lg-longtitude"]').type("110000000000000000000000");
        cy.get('[data-id="la-latitude"]').type("-8000000000000000000000000000000");
        cy.get('[data-id="alamat"]').type(" JI-136");
        cy.get('[data-id="next-2"]').click();
        // page 3
        cy.get('[data-id="select-profile-pengusaha"]')
            .select("", { force: true })
            .should("have.value", "");
        cy.get('[data-id="select-uraian-resiko-proyek"]')
            .select("", { force: true })
            .should("have.value", "");
        cy.get('[data-id="select-uraian-skala-usaha"]')
            .select("", { force: true })
            .should("have.value", "");
        cy.get('[data-id="next-3"]').click();
        // page 4
        cy.get(".invalid-feedback");
    });


    it("edit kbli input page 4 kosong", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("/data-table-management/kbli-perusahaan");
        cy.get('[data-id="edt-1"]').click();
        // page-1
        cy.get('[data-id="select-nama-perusahaan"]')
            .select("1", { force: true })
            .should("have.value", "1");
        cy.get('[data-id="select-kbli"]')
            .select("3", { force: true })
            .should("have.value", "3");
        cy.get('[data-id="kode-proyek"]').type("R-202301012338152771917");
        cy.get('[data-id="npwp"]').type("773298419647000");
        cy.get('[data-id="next1"]').click();
        // page 2
        cy.get('[data-id="select-kecamatan"]')
            .select("1", { force: true })
            .should("have.value", "1");
        cy.get('[data-id="select-kelurahan"]')
            .select("3", { force: true })
            .should("have.value", "3");
        cy.get('[data-id="lg-longtitude"]').type("111.15015341971007");
        cy.get('[data-id="la-latitude"]').type("-8.12482089690483");
        cy.get('[data-id="alamat"]').type(" JI-136");
        cy.get('[data-id="next-2"]').click();
        // page 3
        cy.get('[data-id="select-profile-pengusaha"]')
            .select("4", { force: true })
            .should("have.value", "4");
        cy.get('[data-id="select-uraian-resiko-proyek"]')
            .select("1", { force: true })
            .should("have.value", "1");
        cy.get('[data-id="select-uraian-skala-usaha"]')
            .select("1", { force: true })
            .should("have.value", "1");
        cy.get('[data-id="next-3"]').click();
        // page 4
        cy.get('[data-id="submit"]').click();
        cy.get(".invalid-feedback");
    });

    it("edit kbli input page 4 menggunakan huruf ", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("/data-table-management/kbli-perusahaan");
        cy.get('[data-id="edt-1"]').click();
        // page-1
        cy.get('[data-id="select-nama-perusahaan"]')
            .select("1", { force: true })
            .should("have.value", "1");
        cy.get('[data-id="select-kbli"]')
            .select("3", { force: true })
            .should("have.value", "3");
        cy.get('[data-id="kode-proyek"]').type("R-202301012338152771917");
        cy.get('[data-id="npwp"]').type("773298419647000");
        cy.get('[data-id="next1"]').click();
        // page 2
        cy.get('[data-id="select-kecamatan"]')
            .select("1", { force: true })
            .should("have.value", "1");
        cy.get('[data-id="select-kelurahan"]')
            .select("3", { force: true })
            .should("have.value", "3");
        cy.get('[data-id="lg-longtitude"]').clear();
        cy.get('[data-id="la-latitude"]').clear();
        cy.get('[data-id="alamat"]').clear();
        cy.get('[data-id="lg-longtitude"]').type("111.15015341971007");
        cy.get('[data-id="la-latitude"]').type("-8.12482089690483");
        cy.get('[data-id="alamat"]').type(" JI-136");
        cy.get('[data-id="next-2"]').click();
        // page 3
        cy.get('[data-id="select-profile-pengusaha"]')
            .select("4", { force: true })
            .should("have.value", "4");
        cy.get('[data-id="select-uraian-resiko-proyek"]')
            .select("1", { force: true })
            .should("have.value", "1");
        cy.get('[data-id="select-uraian-skala-usaha"]')
            .select("1", { force: true })
            .should("have.value", "1");
        cy.get('[data-id="next-3"]').click();
        // page 4
        cy.get('[data-id="mesin-peralatan"]').clear();
        cy.get('[data-id="mesin-peralatan"]').type("halo");
        cy.get('[data-id="mesin-peralatan-impor"]').clear();
        cy.get('[data-id="mesin-peralatan-impor"]').type("halo");
        cy.get('[data-id="pembelian-pematangan-tanah"]').clear();
        cy.get('[data-id="pembelian-pematangan-tanah"]').type("halo");
        cy.get('[data-id="bangunan-gedung"]').clear();
        cy.get('[data-id="bangunan-gedung"]').type("halo");
        cy.get('[data-id="lain-lain"]').type();
        cy.get('[data-id="lain-lain"]').type("halo");
        cy.get('[data-id="modal-kerja"]').clear();
        cy.get('[data-id="modal-kerja"]').type("halo");
        cy.get('[data-id="jumlah-investasi"]').clear();
        cy.get('[data-id="jumlah-investasi"]').type("halo");
        cy.get('[data-id="tenaga-kerja"]').clear();
        cy.get('[data-id="tenaga-kerja"]').type("halo");
        cy.get('[data-id="submit"]').click();
        cy.get(".invalid-feedback");
    });

    it("pencarian nama perusahaan tidak ada", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("/data-table-management/kbli-perusahaan");
        cy.get('[data-id="search"]').click();
        cy.get('[data-id="search-perusahaan"]').type(
            "industri minuman ringan berat"
        );
        cy.get('[data-id="submit-search"]').click();
    });
});
