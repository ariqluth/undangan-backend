describe("case positive", function () {
    beforeEach(function () {
        cy.fixture("scenario").then(function (data) {
            this.data = data;
        });
    });

    it("create  total pembiayaan", function () {
        cy.resetDb();
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("/data-table-management/total-pembiayaan");
        cy.get('[data-id="tambah-total-pembiayaan"]').click();
        cy.get('[data-id="select-perusahaan"]')
            .select("1", { force: true })
            .should("have.value", "1");
        cy.get('[data-id="select-kbli"]')
            .select("2", { force: true })
            .should("have.value", "2");
        cy.get('[data-id="mesin-peralatan"]').type("2");
        cy.get('[data-id="mesin-peralatan-impor"]').type("2");
        cy.get('[data-id="pembelian-pematangan-tanah"]').type("4");
        cy.get('[data-id="bangunan-gedung"]').type("6");
        cy.get('[data-id="modal-kerja"]').type("2000000");
        cy.get('[data-id="lain-lain"]').type("2");
        cy.get('[data-id="jumlah-investasi"]').type("2000000");
        cy.get('[data-id="tenaga-kerja"]').type("3");
        cy.get('[data-id="submit"]').click();
        cy.get(".alert").contains("Tambah Data Total Pembiayaan Sukses");
    });

    it("update total pembiayaan", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("/data-table-management/total-pembiayaan");
        cy.get('[data-id="edt-1"]').click();
        cy.get('[data-id="select-perusahaan"]')
            .select("3", { force: true })
            .should("have.value", "3");
        cy.wait(1000);
        cy.get('[data-id="select-kbli"]')
            .select("2", { force: true })
            .should("have.value", "2");
        cy.get('[data-id="mesin-peralatan"]').clear();
        cy.get('[data-id="mesin-peralatan"]').type("3");
        cy.get('[data-id="mesin-peralatan-impor"]').clear();
        cy.get('[data-id="mesin-peralatan-impor"]').type("3");
        cy.get('[data-id="pembelian-pematangan-tanah"]').clear();
        cy.get('[data-id="pembelian-pematangan-tanah"]').type("4");
        cy.get('[data-id="bangunan-gedung"]').clear();
        cy.get('[data-id="bangunan-gedung"]').type("6");
        cy.get('[data-id="modal-kerja"]').clear();
        cy.get('[data-id="modal-kerja"]').type("3500000");
        cy.get('[data-id="lain-lain"]').clear();
        cy.get('[data-id="lain-lain"]').type("2");
        cy.get('[data-id="jumlah-investasi"]').clear();
        cy.get('[data-id="jumlah-investasi"]').type("3500000");
        cy.get('[data-id="tenaga-kerja"]').clear();
        cy.get('[data-id="tenaga-kerja"]').type("4");
        cy.get('[data-id="submit"]').click();
        cy.get(".alert").contains("Edit Data Total Pembiayaan Sukses");
    });

    it("delete total pembiayaan", function () {
        cy.resetDb();
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("/data-table-management/total-pembiayaan");
        cy.get('[data-id="del-1"]').click();
        cy.contains("Yes").click();
        cy.get(".alert").contains("Hapus Data Total Pembiayaan Sukses");
    });

    it("pencarian total pembiayaan", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("/data-table-management/total-pembiayaan");
        cy.get('[data-id="search"]').click();
        cy.get('[data-id="search-perusahaan"]').type(
            "TAMAN KANAK KANAK PANGUDI LUHUR"
        );
        cy.get('[data-id="submit-search"]').click();
    });
});

describe("case negative", function () {
    beforeEach(function () {
        cy.fixture("scenario").then(function (data) {
            this.data = data;
        });
    });

    it("create total pembiayaan kosong semua", function () {
        cy.resetDb();
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("/data-table-management/total-pembiayaan")
        cy.get('[data-id="tambah-total-pembiayaan"]').click();
        cy.get('[data-id="select-perusahaan"]')
            .select("", { force: true })
            .should("have.value", "");
        cy.get('[data-id="select-kbli"]')
            .select("", { force: true })
            .should("have.value", "");
        cy.get('[data-id="submit"]').click();
        cy.get(".invalid-feedback");
    });

    it("create total pembiayaan nama perusahaan dan kbli  kosong", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("/data-table-management/total-pembiayaan");
        cy.get('[data-id="tambah-total-pembiayaan"]').click();
        cy.get('[data-id="select-perusahaan"]')
            .select("", { force: true })
            .should("have.value", "");

        cy.get('[data-id="mesin-peralatan"]').type("2");
        cy.get('[data-id="mesin-peralatan-impor"]').type("2");
        cy.get('[data-id="pembelian-pematangan-tanah"]').type("4");
        cy.get('[data-id="bangunan-gedung"]').type("6");
        cy.get('[data-id="modal-kerja"]').type("2000000");
        cy.get('[data-id="lain-lain"]').type("2");
        cy.get('[data-id="jumlah-investasi"]').type("2000000");
        cy.get('[data-id="tenaga-kerja"]').type("3");
        cy.get('[data-id="submit"]').click();
        cy.get(".invalid-feedback");
    });
    it("create total pembiayaan mesin peralatan  kosong", function () {
        cy.resetDb();
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("/data-table-management/total-pembiayaan");
        cy.get('[data-id="tambah-total-pembiayaan"]').click();
        cy.get('[data-id="select-perusahaan"]')
            .select("3", { force: true })
            .should("have.value", "3");
        cy.get('[data-id="select-kbli"]')
            .select("2", { force: true })
            .should("have.value", "2");
        cy.get('[data-id="mesin-peralatan-impor"]').type("2");
        cy.get('[data-id="pembelian-pematangan-tanah"]').type("4");
        cy.get('[data-id="bangunan-gedung"]').type("6");
        cy.get('[data-id="modal-kerja"]').type("2000000");
        cy.get('[data-id="lain-lain"]').type("2");
        cy.get('[data-id="jumlah-investasi"]').type("2000000");
        cy.get('[data-id="tenaga-kerja"]').type("3");
        cy.get('[data-id="submit"]').click();
        cy.get(".invalid-feedback");
    });
    it("create total pembiayaan mesin peralatan impor  kosong", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("/data-table-management/total-pembiayaan");
        cy.get('[data-id="tambah-total-pembiayaan"]').click();
        cy.get('[data-id="select-perusahaan"]')
            .select("3", { force: true })
            .should("have.value", "3");
        cy.get('[data-id="select-kbli"]')
            .select("2", { force: true })
            .should("have.value", "2");
        cy.get('[data-id="mesin-peralatan"]').type("2");
        cy.get('[data-id="pembelian-pematangan-tanah"]').type("4");
        cy.get('[data-id="bangunan-gedung"]').type("6");
        cy.get('[data-id="modal-kerja"]').type("2000000");
        cy.get('[data-id="lain-lain"]').type("2");
        cy.get('[data-id="jumlah-investasi"]').type("2000000");
        cy.get('[data-id="tenaga-kerja"]').type("3");
        cy.get('[data-id="submit"]').click();
        cy.get(".invalid-feedback");
    });
    it("create total pembiayaan pembelian pematangan tanah  kosong", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("/data-table-management/total-pembiayaan");
        cy.get('[data-id="tambah-total-pembiayaan"]').click();
        cy.get('[data-id="select-perusahaan"]')
            .select("3", { force: true })
            .should("have.value", "3");
        cy.get('[data-id="select-kbli"]')
            .select("2", { force: true })
            .should("have.value", "2");
        cy.get('[data-id="mesin-peralatan"]').type("2");
        cy.get('[data-id="mesin-peralatan-impor"]').type("2");
        cy.get('[data-id="bangunan-gedung"]').type("6");
        cy.get('[data-id="modal-kerja"]').type("2000000");
        cy.get('[data-id="lain-lain"]').type("2");
        cy.get('[data-id="jumlah-investasi"]').type("2000000");
        cy.get('[data-id="tenaga-kerja"]').type("3");
        cy.get('[data-id="submit"]').click();
        cy.get(".invalid-feedback");
    });
    it("create total pembiayaan bangunan gedung  kosong", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("/data-table-management/total-pembiayaan");
        cy.get('[data-id="tambah-total-pembiayaan"]').click();
        cy.get('[data-id="select-perusahaan"]')
            .select("3", { force: true })
            .should("have.value", "3");
        cy.get('[data-id="select-kbli"]')
            .select("2", { force: true })
            .should("have.value", "2");
        cy.get('[data-id="mesin-peralatan"]').type("2");
        cy.get('[data-id="mesin-peralatan-impor"]').type("2");
        cy.get('[data-id="pembelian-pematangan-tanah"]').type("4");
        cy.get('[data-id="modal-kerja"]').type("2000000");
        cy.get('[data-id="lain-lain"]').type("2");
        cy.get('[data-id="jumlah-investasi"]').type("2000000");
        cy.get('[data-id="tenaga-kerja"]').type("3");
        cy.get('[data-id="submit"]').click();
        cy.get(".invalid-feedback");
    });
    it("create total pembiayaan modal kerja kosong", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("/data-table-management/total-pembiayaan");
        cy.get('[data-id="tambah-total-pembiayaan"]').click();
        cy.get('[data-id="select-perusahaan"]')
            .select("3", { force: true })
            .should("have.value", "3");
        cy.get('[data-id="select-kbli"]')
            .select("2", { force: true })
            .should("have.value", "2");
        cy.get('[data-id="mesin-peralatan"]').type("2");
        cy.get('[data-id="mesin-peralatan-impor"]').type("2");
        cy.get('[data-id="pembelian-pematangan-tanah"]').type("4");
        cy.get('[data-id="lain-lain"]').type("2");
        cy.get('[data-id="jumlah-investasi"]').type("2000000");
        cy.get('[data-id="tenaga-kerja"]').type("3");
        cy.get('[data-id="submit"]').click();
        cy.get(".invalid-feedback");
    });
    it("create total pembiayaan lain-lain  kosong", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("/data-table-management/total-pembiayaan");
        cy.get('[data-id="tambah-total-pembiayaan"]').click();
        cy.get('[data-id="select-perusahaan"]')
            .select("3", { force: true })
            .should("have.value", "3");
        cy.get('[data-id="select-kbli"]')
            .select("2", { force: true })
            .should("have.value", "2");
        cy.get('[data-id="mesin-peralatan"]').type("2");
        cy.get('[data-id="mesin-peralatan-impor"]').type("2");
        cy.get('[data-id="pembelian-pematangan-tanah"]').type("4");
        cy.get('[data-id="bangunan-gedung"]').type("6");
        cy.get('[data-id="modal-kerja"]').type("2000000");
        cy.get('[data-id="jumlah-investasi"]').type("2000000");
        cy.get('[data-id="tenaga-kerja"]').type("3");
        cy.get('[data-id="submit"]').click();
        cy.get(".invalid-feedback");
    });
    it("create total pembiayaan jumlah investasi  kosong", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("/data-table-management/total-pembiayaan");
        cy.get('[data-id="tambah-total-pembiayaan"]').click();
        cy.get('[data-id="select-perusahaan"]')
            .select("3", { force: true })
            .should("have.value", "3");
        cy.get('[data-id="select-kbli"]')
            .select("2", { force: true })
            .should("have.value", "2");
        cy.get('[data-id="mesin-peralatan"]').type("2");
        cy.get('[data-id="mesin-peralatan-impor"]').type("2");
        cy.get('[data-id="pembelian-pematangan-tanah"]').type("4");
        cy.get('[data-id="bangunan-gedung"]').type("6");
        cy.get('[data-id="modal-kerja"]').type("2000000");
        cy.get('[data-id="lain-lain"]').type("2");
        cy.get('[data-id="tenaga-kerja"]').type("3");
        cy.get('[data-id="submit"]').click();
        cy.get(".invalid-feedback");
    });
    it("create total pembiayaan tenaga kerja  kosong", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("/data-table-management/total-pembiayaan");
        cy.get('[data-id="tambah-total-pembiayaan"]').click();
        cy.get('[data-id="select-perusahaan"]')
            .select("3", { force: true })
            .should("have.value", "3");
        cy.get('[data-id="select-kbli"]')
            .select("2", { force: true })
            .should("have.value", "2");
        cy.get('[data-id="mesin-peralatan"]').type("2");
        cy.get('[data-id="mesin-peralatan-impor"]').type("2");
        cy.get('[data-id="pembelian-pematangan-tanah"]').type("4");
        cy.get('[data-id="bangunan-gedung"]').type("6");
        cy.get('[data-id="modal-kerja"]').type("2000000");
        cy.get('[data-id="lain-lain"]').type("2");
        cy.get('[data-id="jumlah-investasi"]').type("2000000");
        cy.get('[data-id="submit"]').click();
        cy.get(".invalid-feedback");
    });

    it("update total pembiayaan tenaga kerja  kosong", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("/data-table-management/total-pembiayaan");
        cy.get('[data-id="edt-1"]').click();
        cy.get('[data-id="select-perusahaan"]')
            .select("3", { force: true })
            .should("have.value", "3");
        cy.wait(1000);
        cy.get('[data-id="select-kbli"]')
            .select("2", { force: true })
            .should("have.value", "2");
        cy.get('[data-id="mesin-peralatan"]').clear();
        cy.get('[data-id="mesin-peralatan"]').type("2");
        cy.get('[data-id="mesin-peralatan-impor"]').clear();
        cy.get('[data-id="mesin-peralatan-impor"]').type("2");
        cy.get('[data-id="pembelian-pematangan-tanah"]').clear();
        cy.get('[data-id="pembelian-pematangan-tanah"]').type("4");
        cy.get('[data-id="bangunan-gedung"]').clear();
        cy.get('[data-id="bangunan-gedung"]').type("6");
        cy.get('[data-id="modal-kerja"]').clear();
        cy.get('[data-id="modal-kerja"]').type("2000000");
        cy.get('[data-id="lain-lain"]').clear();
        cy.get('[data-id="lain-lain"]').type("2");
        cy.get('[data-id="tenaga-kerja"]').clear();
        cy.get('[data-id="jumlah-investasi"]').clear();
        cy.get('[data-id="jumlah-investasi"]').type("2000000");
        cy.get('[data-id="submit"]').click();
        cy.get(".invalid-feedback");
    });


    it("update total pembiayaan investasi  kosong", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("/data-table-management/total-pembiayaan");
        cy.get('[data-id="edt-1"]').click();
        cy.get('[data-id="select-perusahaan"]')
            .select("3", { force: true })
            .should("have.value", "3");
        cy.wait(1000);
        cy.get('[data-id="select-kbli"]')
            .select("2", { force: true })
            .should("have.value", "2");
        cy.get('[data-id="mesin-peralatan"]').clear();
        cy.get('[data-id="mesin-peralatan"]').type("2");
        cy.get('[data-id="mesin-peralatan-impor"]').clear();
        cy.get('[data-id="mesin-peralatan-impor"]').type("2");
        cy.get('[data-id="pembelian-pematangan-tanah"]').clear();
        cy.get('[data-id="pembelian-pematangan-tanah"]').type("4");
        cy.get('[data-id="bangunan-gedung"]').clear();
        cy.get('[data-id="bangunan-gedung"]').type("6");
        cy.get('[data-id="modal-kerja"]').clear();
        cy.get('[data-id="modal-kerja"]').type("2000000");
        cy.get('[data-id="lain-lain"]').clear();
        cy.get('[data-id="lain-lain"]').type("2");
        cy.get('[data-id="jumlah-investasi"]').clear();
        cy.get('[data-id="tenaga-kerja"]').clear();
        cy.get('[data-id="tenaga-kerja"]').type("3");
        cy.get('[data-id="submit"]').click();
        cy.get(".invalid-feedback");
    });

    it("update total pembiayaan lain-lain  kosong", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("/data-table-management/total-pembiayaan");
        cy.get('[data-id="edt-1"]').click();
        cy.get('[data-id="select-perusahaan"]')
            .select("3", { force: true })
            .should("have.value", "3");
        cy.wait(1000);
        cy.get('[data-id="select-kbli"]')
            .select("2", { force: true })
            .should("have.value", "2");
        cy.get('[data-id="mesin-peralatan"]').clear();
        cy.get('[data-id="mesin-peralatan"]').type("2");
        cy.get('[data-id="mesin-peralatan-impor"]').clear();
        cy.get('[data-id="mesin-peralatan-impor"]').type("2");
        cy.get('[data-id="pembelian-pematangan-tanah"]').clear();
        cy.get('[data-id="pembelian-pematangan-tanah"]').type("4");
        cy.get('[data-id="bangunan-gedung"]').clear();
        cy.get('[data-id="bangunan-gedung"]').type("6");
        cy.get('[data-id="modal-kerja"]').clear();
        cy.get('[data-id="modal-kerja"]').type("2000000");
        cy.get('[data-id="lain-lain"]').clear();
        cy.get('[data-id="jumlah-investasi"]').clear();
        cy.get('[data-id="jumlah-investasi"]').type("2");
        cy.get('[data-id="tenaga-kerja"]').clear();
        cy.get('[data-id="tenaga-kerja"]').type("3");
        cy.get('[data-id="submit"]').click();
        cy.get(".invalid-feedback");
    });

    it("update total pembiayaan modal-kerja  kosong", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("/data-table-management/total-pembiayaan");
        cy.get('[data-id="edt-1"]').click();
        cy.get('[data-id="select-perusahaan"]')
            .select("3", { force: true })
            .should("have.value", "3");
        cy.wait(1000);
        cy.get('[data-id="select-kbli"]')
            .select("2", { force: true })
            .should("have.value", "2");
        cy.get('[data-id="mesin-peralatan"]').clear();
        cy.get('[data-id="mesin-peralatan"]').type("2");
        cy.get('[data-id="mesin-peralatan-impor"]').clear();
        cy.get('[data-id="mesin-peralatan-impor"]').type("2");
        cy.get('[data-id="pembelian-pematangan-tanah"]').clear();
        cy.get('[data-id="pembelian-pematangan-tanah"]').type("4");
        cy.get('[data-id="bangunan-gedung"]').clear();
        cy.get('[data-id="bangunan-gedung"]').type("6");
        cy.get('[data-id="modal-kerja"]').clear();
        cy.get('[data-id="lain-lain"]').clear();
        cy.get('[data-id="jumlah-investasi"]').clear();
        cy.get('[data-id="jumlah-investasi"]').type("2");
        cy.get('[data-id="tenaga-kerja"]').clear();
        cy.get('[data-id="tenaga-kerja"]').type("3");
        cy.get('[data-id="submit"]').click();
        cy.get(".invalid-feedback");
    });

    it("update total pembiayaan modal-kerja  kosong", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("/data-table-management/total-pembiayaan");
        cy.get('[data-id="edt-1"]').click();
        cy.get('[data-id="select-perusahaan"]')
            .select("3", { force: true })
            .should("have.value", "3");
        cy.wait(1000);
        cy.get('[data-id="select-kbli"]')
            .select("2", { force: true })
            .should("have.value", "2");
        cy.get('[data-id="mesin-peralatan"]').clear();
        cy.get('[data-id="mesin-peralatan"]').type("2");
        cy.get('[data-id="mesin-peralatan-impor"]').clear();
        cy.get('[data-id="mesin-peralatan-impor"]').type("2");
        cy.get('[data-id="pembelian-pematangan-tanah"]').clear();
        cy.get('[data-id="pembelian-pematangan-tanah"]').type("4");
        cy.get('[data-id="bangunan-gedung"]').clear();
        cy.get('[data-id="bangunan-gedung"]').type("6");
        cy.get('[data-id="modal-kerja"]').clear();
        cy.get('[data-id="lain-lain"]').clear();
        cy.get('[data-id="lain-lain"]').type("1");
        cy.get('[data-id="jumlah-investasi"]').clear();
        cy.get('[data-id="jumlah-investasi"]').type("2");
        cy.get('[data-id="tenaga-kerja"]').clear();
        cy.get('[data-id="tenaga-kerja"]').type("3");
        cy.get('[data-id="submit"]').click();
        cy.get(".invalid-feedback");
    });


    it("update total pembiayaan bangunan-gedung kosong", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("/data-table-management/total-pembiayaan");
        cy.get('[data-id="edt-1"]').click();
        cy.get('[data-id="select-perusahaan"]')
            .select("3", { force: true })
            .should("have.value", "3");
        cy.wait(1000);
        cy.get('[data-id="select-kbli"]')
            .select("2", { force: true })
            .should("have.value", "2");
        cy.get('[data-id="mesin-peralatan"]').clear();
        cy.get('[data-id="mesin-peralatan"]').type("2");
        cy.get('[data-id="mesin-peralatan-impor"]').clear();
        cy.get('[data-id="mesin-peralatan-impor"]').type("2");
        cy.get('[data-id="pembelian-pematangan-tanah"]').clear();
        cy.get('[data-id="pembelian-pematangan-tanah"]').type("4");
        cy.get('[data-id="bangunan-gedung"]').clear();
        cy.get('[data-id="modal-kerja"]').clear();
        cy.get('[data-id="modal-kerja"]').type("1");
        cy.get('[data-id="lain-lain"]').clear();
        cy.get('[data-id="lain-lain"]').type("1");
        cy.get('[data-id="jumlah-investasi"]').clear();
        cy.get('[data-id="jumlah-investasi"]').type("2");
        cy.get('[data-id="tenaga-kerja"]').clear();
        cy.get('[data-id="tenaga-kerja"]').type("3");
        cy.get('[data-id="submit"]').click();
        cy.get(".invalid-feedback");
    });


    it("update total pembiayaan pembelian-pematangan-tanah kosong", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("/data-table-management/total-pembiayaan");
        cy.get('[data-id="edt-1"]').click();
        cy.get('[data-id="select-perusahaan"]')
            .select("3", { force: true })
            .should("have.value", "3");
        cy.wait(1000);
        cy.get('[data-id="select-kbli"]')
            .select("2", { force: true })
            .should("have.value", "2");
        cy.get('[data-id="mesin-peralatan"]').clear();
        cy.get('[data-id="mesin-peralatan"]').type("2");
        cy.get('[data-id="mesin-peralatan-impor"]').clear();
        cy.get('[data-id="mesin-peralatan-impor"]').type("2");
        cy.get('[data-id="pembelian-pematangan-tanah"]').clear();
        cy.get('[data-id="bangunan-gedung"]').clear();
        cy.get('[data-id="bangunan-gedung"]').type("1");
        cy.get('[data-id="modal-kerja"]').clear();
        cy.get('[data-id="modal-kerja"]').type("1");
        cy.get('[data-id="lain-lain"]').clear();
        cy.get('[data-id="lain-lain"]').type("1");
        cy.get('[data-id="jumlah-investasi"]').clear();
        cy.get('[data-id="jumlah-investasi"]').type("2");
        cy.get('[data-id="tenaga-kerja"]').clear();
        cy.get('[data-id="tenaga-kerja"]').type("3");
        cy.get('[data-id="submit"]').click();
        cy.get(".invalid-feedback");
    });


    it("update total pembiayaan mesin-peralatan-impor kosong", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("/data-table-management/total-pembiayaan");
        cy.get('[data-id="edt-1"]').click();
        cy.get('[data-id="select-perusahaan"]')
            .select("3", { force: true })
            .should("have.value", "3");
        cy.wait(1000);
        cy.get('[data-id="select-kbli"]')
            .select("2", { force: true })
            .should("have.value", "2");
        cy.get('[data-id="mesin-peralatan"]').clear();
        cy.get('[data-id="mesin-peralatan"]').type("2");
        cy.get('[data-id="mesin-peralatan-impor"]').clear();
        cy.get('[data-id="pembelian-pematangan-tanah"]').clear();
        cy.get('[data-id="pembelian-pematangan-tanah"]').type("2");
        cy.get('[data-id="bangunan-gedung"]').clear();
        cy.get('[data-id="bangunan-gedung"]').type("1");
        cy.get('[data-id="modal-kerja"]').clear();
        cy.get('[data-id="modal-kerja"]').type("1");
        cy.get('[data-id="lain-lain"]').clear();
        cy.get('[data-id="lain-lain"]').type("1");
        cy.get('[data-id="jumlah-investasi"]').clear();
        cy.get('[data-id="jumlah-investasi"]').type("2");
        cy.get('[data-id="tenaga-kerja"]').clear();
        cy.get('[data-id="tenaga-kerja"]').type("3");
        cy.get('[data-id="submit"]').click();
        cy.get(".invalid-feedback");
    });


    it("update total pembiayaan mesin-peralatan-impor kosong", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("/data-table-management/total-pembiayaan");
        cy.get('[data-id="edt-1"]').click();
        cy.get('[data-id="select-perusahaan"]')
            .select("3", { force: true })
            .should("have.value", "3");
        cy.wait(1000);
        cy.get('[data-id="select-kbli"]')
            .select("2", { force: true })
            .should("have.value", "2");
        cy.get('[data-id="mesin-peralatan"]').clear();
        cy.get('[data-id="mesin-peralatan"]').type("2");
        cy.get('[data-id="mesin-peralatan-impor"]').clear();
        cy.get('[data-id="mesin-peralatan-impor"]').type("2");
        cy.get('[data-id="pembelian-pematangan-tanah"]').clear();
        cy.get('[data-id="pembelian-pematangan-tanah"]').type("1");
        cy.get('[data-id="bangunan-gedung"]').clear();
        cy.get('[data-id="bangunan-gedung"]').type("1");
        cy.get('[data-id="modal-kerja"]').clear();
        cy.get('[data-id="modal-kerja"]').type("1");
        cy.get('[data-id="lain-lain"]').clear();
        cy.get('[data-id="lain-lain"]').type("1");
        cy.get('[data-id="jumlah-investasi"]').clear();
        cy.get('[data-id="jumlah-investasi"]').type("2");
        cy.get('[data-id="tenaga-kerja"]').clear();
        cy.get('[data-id="tenaga-kerja"]').type("3");
        cy.get('[data-id="submit"]').click();
        cy.get(".invalid-feedback");
    });


    it("update total pembiayaan mesin-peralatan kosong", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("/data-table-management/total-pembiayaan");
        cy.get('[data-id="edt-1"]').click();
        cy.get('[data-id="select-perusahaan"]')
            .select("3", { force: true })
            .should("have.value", "3");
        cy.wait(1000);
        cy.get('[data-id="select-kbli"]')
            .select("2", { force: true })
            .should("have.value", "2");
        cy.get('[data-id="mesin-peralatan"]').clear();
        cy.get('[data-id="mesin-peralatan-impor"]').clear();
        cy.get('[data-id="mesin-peralatan-impor"]').type("2");
        cy.get('[data-id="pembelian-pematangan-tanah"]').clear();
        cy.get('[data-id="pembelian-pematangan-tanah"]').type("1");
        cy.get('[data-id="bangunan-gedung"]').clear();
        cy.get('[data-id="bangunan-gedung"]').type("1");
        cy.get('[data-id="modal-kerja"]').clear();
        cy.get('[data-id="modal-kerja"]').type("1");
        cy.get('[data-id="lain-lain"]').clear();
        cy.get('[data-id="lain-lain"]').type("1");
        cy.get('[data-id="jumlah-investasi"]').clear();
        cy.get('[data-id="jumlah-investasi"]').type("2");
        cy.get('[data-id="tenaga-kerja"]').clear();
        cy.get('[data-id="tenaga-kerja"]').type("3");
        cy.get('[data-id="submit"]').click();
        cy.get(".invalid-feedback");
    });


    it("update total pembiayaan select kbli kosong dan select perusahaan kosong", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("/data-table-management/total-pembiayaan");
        cy.get('[data-id="edt-1"]').click();
        cy.wait(1000);
        cy.get('[data-id="select-perusahaan"]')
            .select("", { force: true })
            .should("have.value", "");
        cy.wait(1000);
        cy.get('[data-id="select-kbli"]')
            .select("Pilih kbli", { force: true })
            .should("have.value", "");
        cy.get('[data-id="mesin-peralatan"]').clear();
        cy.get('[data-id="mesin-peralatan"]').type("1");
        cy.get('[data-id="mesin-peralatan-impor"]').clear();
        cy.get('[data-id="mesin-peralatan-impor"]').type("2");
        cy.get('[data-id="pembelian-pematangan-tanah"]').clear();
        cy.get('[data-id="pembelian-pematangan-tanah"]').type("1");
        cy.get('[data-id="bangunan-gedung"]').clear();
        cy.get('[data-id="bangunan-gedung"]').type("1");
        cy.get('[data-id="modal-kerja"]').clear();
        cy.get('[data-id="modal-kerja"]').type("1");
        cy.get('[data-id="lain-lain"]').clear();
        cy.get('[data-id="lain-lain"]').type("1");
        cy.get('[data-id="jumlah-investasi"]').clear();
        cy.get('[data-id="jumlah-investasi"]').type("2000");
        cy.get('[data-id="tenaga-kerja"]').clear();
        cy.get('[data-id="tenaga-kerja"]').type("3");
        cy.get('[data-id="submit"]').click();
        cy.get(".invalid-feedback");
    });


    it("pencarian total pembiayaan tidak ada didatabase", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("/data-table-management/total-pembiayaan");
        cy.get('[data-id="search"]').click();
        cy.get('[data-id="search-perusahaan"]').type("DINACU");
        cy.get('[data-id="submit-search"]').click();
        cy.get(".table > tbody > tr > :nth-child(2)").should("be.visible");
    });

    it("pencarian total pembiayaan kosong", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.visit("/data-table-management/total-pembiayaan");
        cy.get('[data-id="search"]').click();
        cy.get('[data-id="submit-search"]').click();
        cy.get(".table > tbody > tr > :nth-child(2)").should("be.visible");
    });
});
