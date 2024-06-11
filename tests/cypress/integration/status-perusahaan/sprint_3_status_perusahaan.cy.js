describe("case positive", function () {
    beforeEach(function () {
        cy.fixture("scenario").then(function (data) {
            this.data = data;
        });
    });

    it("create  status perusahaan", function () {
        cy.resetDb();
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.get(".navbar-nav > :nth-child(1) > .nav-link > .fas").click();
        cy.get(":nth-child(6) > .has-dropdown > span").click();
        cy.get(".active > .dropdown-menu > :nth-child(3) > .nav-link").click();
        cy.get('[data-id="tambah"]').click();
        cy.get('[data-id="select-perusahaan"]')
        .select("1", { force: true })
        .should("have.value", "1");
        cy.get('[data-id="select-pmdn"]')
        .select("pmda", { force: true })
        .should("have.value", "pmda");
        cy.get('[data-id="select-kbli"]')
        .select("7", { force: true })
        .should("have.value", "7");
        cy.get('[data-id="select-jenis-perusahaan"]')
        .select("5", { force: true })
        .should("have.value", "5");
        cy.get('[data-id="select-resiko-proyek"]')
        .select("4", { force: true })
        .should("have.value", "4");
        cy.get('[data-id="select-skala-usaha"]')
        .select("4", { force: true })
        .should("have.value", "4");
        cy.get('[data-id="submit"]').click();
        cy.get(".alert").contains("Tambah Data Status Perusahaan Sukses");
    });

    it("update status perusahaan", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.get(".navbar-nav > :nth-child(1) > .nav-link > .fas").click();
        cy.get(":nth-child(6) > .has-dropdown > span").click();
        cy.get(".active > .dropdown-menu > :nth-child(3) > .nav-link").click();
        cy.get(":nth-child(3) > .page-link").click();
        cy.get('[data-id="edt-6"]').click();
        cy.get('[data-id="select-perusahaan"]')
        .select("3", { force: true })
        .should("have.value", "3");
        cy.get('[data-id="select-pmdn"]')
        .select("pmda", { force: true })
        .should("have.value", "pmda");
        cy.get('[data-id="select-kbli"]')
        .select("6", { force: true })
        .should("have.value", "6");
        cy.get('[data-id="select-jenis-perusahaan"]')
        .select("2", { force: true })
        .should("have.value", "2");
        cy.get('[data-id="select-resiko-proyek"]')
        .select("2", { force: true })
        .should("have.value", "2");
        cy.get('[data-id="select-skala-usaha"]')
        .select("2", { force: true })
        .should("have.value", "2");
        cy.get('[data-id="submit"]').click();
        cy.get(".alert").contains("Edit Data Status Perusahaan Sukses");
    });

    it("delete status perusahaan", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.get(".navbar-nav > :nth-child(1) > .nav-link > .fas").click();
        cy.get(":nth-child(6) > .has-dropdown > span").click();
      cy.get(".active > .dropdown-menu > :nth-child(3) > .nav-link").click();
        cy.get(":nth-child(3) > .page-link").click();
        cy.get('[data-id="del-6"]').click();
        cy.contains("Yes").click();
        cy.get(".alert").contains("Hapus Data Status Perusahaan Sukses");
    });

    it("pencarian status perusahaan", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.get(".navbar-nav > :nth-child(1) > .nav-link > .fas").click();
        cy.get(":nth-child(6) > .has-dropdown > span").click();
      cy.get(".active > .dropdown-menu > :nth-child(3) > .nav-link").click();
        cy.get('[data-id="search"]').click();
        cy.get('[data-id="search-perusahaan"]').type("SUPRIANTO");
        cy.get('[data-id="submit-search"]').click();
    });
});

describe("case negative", function () {
    beforeEach(function () {
        cy.fixture("scenario").then(function (data) {
            this.data = data;
        });
    });

    it("create status perusahaan kosong semua", function () {
        cy.resetDb();
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.get(".navbar-nav > :nth-child(1) > .nav-link > .fas").click();
        cy.get(":nth-child(6) > .has-dropdown > span").click();
      cy.get(".active > .dropdown-menu > :nth-child(3) > .nav-link").click();
        cy.get('[data-id="tambah"]').click();
        cy.get('[data-id="submit"]').click();
        cy.get(".invalid-feedback");
    });
    it("create status perusahaan nama perusahaan  kosong", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.get(".navbar-nav > :nth-child(1) > .nav-link > .fas").click();
        cy.get(":nth-child(6) > .has-dropdown > span").click();
      cy.get(".active > .dropdown-menu > :nth-child(3) > .nav-link").click();
        cy.get('[data-id="tambah"]').click();
        // cy.get('[data-id="select-perusahaan"]')
        // .select("1", { force: true })
        // .should("have.value", "1");
        cy.get('[data-id="select-pmdn"]')
        .select("pmda", { force: true })
        .should("have.value", "pmda");
        cy.get('[data-id="select-kbli"]')
        .select("7", { force: true })
        .should("have.value", "7");
        cy.get('[data-id="select-jenis-perusahaan"]')
        .select("5", { force: true })
        .should("have.value", "5");
        cy.get('[data-id="select-resiko-proyek"]')
        .select("4", { force: true })
        .should("have.value", "4");
        cy.get('[data-id="select-skala-usaha"]')
        .select("4", { force: true })
        .should("have.value", "4");
        cy.get('[data-id="submit"]').click();
        cy.get(".invalid-feedback");
    });
    it("create status perusahaan pmdn  kosong", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.get(".navbar-nav > :nth-child(1) > .nav-link > .fas").click();
        cy.get(":nth-child(6) > .has-dropdown > span").click();
      cy.get(".active > .dropdown-menu > :nth-child(3) > .nav-link").click();
        cy.get('[data-id="tambah"]').click();
       cy.get('[data-id="select-perusahaan"]')
        .select("1", { force: true })
        .should("have.value", "1");
        // cy.get('[data-id="select-pmdn"]')
        // .select("pmda", { force: true })
        // .should("have.value", "pmda");
        cy.get('[data-id="select-kbli"]')
        .select("7", { force: true })
        .should("have.value", "7");
        cy.get('[data-id="select-jenis-perusahaan"]')
        .select("5", { force: true })
        .should("have.value", "5");
        cy.get('[data-id="select-resiko-proyek"]')
        .select("4", { force: true })
        .should("have.value", "4");
        cy.get('[data-id="select-skala-usaha"]')
        .select("4", { force: true })
        .should("have.value", "4");
        cy.get('[data-id="submit"]').click();
        cy.get(".invalid-feedback");
    });
    it("create status perusahaan kbli  kosong", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.get(".navbar-nav > :nth-child(1) > .nav-link > .fas").click();
        cy.get(":nth-child(6) > .has-dropdown > span").click();
      cy.get(".active > .dropdown-menu > :nth-child(3) > .nav-link").click();
        cy.get('[data-id="tambah"]').click();
        cy.get('[data-id="select-perusahaan"]')
        .select("1", { force: true })
        .should("have.value", "1");
        cy.get('[data-id="select-pmdn"]')
        .select("pmda", { force: true })
        .should("have.value", "pmda");
        // cy.get('[data-id="select-kbli"]')
        // .select("7", { force: true })
        // .should("have.value", "7");
        cy.get('[data-id="select-jenis-perusahaan"]')
        .select("5", { force: true })
        .should("have.value", "5");
        cy.get('[data-id="select-resiko-proyek"]')
        .select("4", { force: true })
        .should("have.value", "4");
        cy.get('[data-id="select-skala-usaha"]')
        .select("4", { force: true })
        .should("have.value", "4");
        cy.get('[data-id="submit"]').click();
        cy.get(".invalid-feedback");
    });
    it("create status perusahaan jenis perusahaan  kosong", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.get(".navbar-nav > :nth-child(1) > .nav-link > .fas").click();
        cy.get(":nth-child(6) > .has-dropdown > span").click();
      cy.get(".active > .dropdown-menu > :nth-child(3) > .nav-link").click();
        cy.get('[data-id="tambah"]').click();
        cy.get('[data-id="select-perusahaan"]')
        .select("1", { force: true })
        .should("have.value", "1");
        cy.get('[data-id="select-pmdn"]')
        .select("pmda", { force: true })
        .should("have.value", "pmda");
        cy.get('[data-id="select-kbli"]')
        .select("7", { force: true })
        .should("have.value", "7");
        // cy.get('[data-id="select-jenis-perusahaan"]')
        // .select("5", { force: true })
        // .should("have.value", "5");
        cy.get('[data-id="select-resiko-proyek"]')
        .select("4", { force: true })
        .should("have.value", "4");
        cy.get('[data-id="select-skala-usaha"]')
        .select("4", { force: true })
        .should("have.value", "4");
        cy.get('[data-id="submit"]').click();
        cy.get(".invalid-feedback");
    });
    it("create status perusahaan resiko proyek  kosong", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.get(".navbar-nav > :nth-child(1) > .nav-link > .fas").click();
        cy.get(":nth-child(6) > .has-dropdown > span").click();
      cy.get(".active > .dropdown-menu > :nth-child(3) > .nav-link").click();
        cy.get('[data-id="tambah"]').click();
       cy.get('[data-id="select-perusahaan"]')
        .select("1", { force: true })
        .should("have.value", "1");
        cy.get('[data-id="select-pmdn"]')
        .select("pmda", { force: true })
        .should("have.value", "pmda");
        cy.get('[data-id="select-kbli"]')
        .select("7", { force: true })
        .should("have.value", "7");
        cy.get('[data-id="select-jenis-perusahaan"]')
        .select("5", { force: true })
        .should("have.value", "5");
        // cy.get('[data-id="select-resiko-proyek"]')
        // .select("4", { force: true })
        // .should("have.value", "4");
        cy.get('[data-id="select-skala-usaha"]')
        .select("4", { force: true })
        .should("have.value", "4");
        cy.get('[data-id="submit"]').click();
        cy.get(".invalid-feedback");
    });
    it("create status perusahaan skala usaha kosong", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.get(".navbar-nav > :nth-child(1) > .nav-link > .fas").click();
        cy.get(":nth-child(6) > .has-dropdown > span").click();
      cy.get(".active > .dropdown-menu > :nth-child(3) > .nav-link").click();
        cy.get('[data-id="tambah"]').click();
        cy.get('[data-id="select-perusahaan"]')
        .select("1", { force: true })
        .should("have.value", "1");
        cy.get('[data-id="select-pmdn"]')
        .select("pmda", { force: true })
        .should("have.value", "pmda");
        cy.get('[data-id="select-kbli"]')
        .select("7", { force: true })
        .should("have.value", "7");
        cy.get('[data-id="select-jenis-perusahaan"]')
        .select("5", { force: true })
        .should("have.value", "5");
        cy.get('[data-id="select-resiko-proyek"]')
        .select("4", { force: true })
        .should("have.value", "4");
        // cy.get('[data-id="select-skala-usaha"]')
        // .select("4", { force: true })
        // .should("have.value", "4");
        cy.get('[data-id="submit"]').click();
        cy.get(".invalid-feedback");
    });


    it("pencarian status perusahaan tidak ada didatabase", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.get(".navbar-nav > :nth-child(1) > .nav-link > .fas").click();
        cy.get(":nth-child(6) > .has-dropdown > span").click();
      cy.get(".active > .dropdown-menu > :nth-child(3) > .nav-link").click();
        cy.get('[data-id="search"]').click();
        cy.get('[data-id="search-perusahaan"]').type("DINACU");
        cy.get('[data-id="submit-search"]').click();
        cy.get(".table > tbody > tr > :nth-child(2)").should("be.visible");
    });

    it("pencarian status perusahaan kosong", function () {
        cy.visit("/");
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type(this.data.password);
        cy.get('[data-id="buttonLogin"]').click();
        cy.get(".navbar-nav > :nth-child(1) > .nav-link > .fas").click();
        cy.get(":nth-child(6) > .has-dropdown > span").click();
      cy.get(".active > .dropdown-menu > :nth-child(3) > .nav-link").click();
        cy.get('[data-id="search"]').click();
        cy.get('[data-id="submit-search"]').click();
        cy.get(".table > tbody > tr > :nth-child(2)").should("be.visible");
    });
});
