import "cypress-mailhog";
import "cypress-iframe";
const getIframeDocument = function () {
    return cy.iframe();
};

describe("case positive", function () {
    beforeEach(function () {
        cy.resetDb();
        cy.fixture("scenario").then(function (data) {
            this.data = data;
        });
    });
    it(" Sukses Reset Password", function () {
        cy.visit("/");
        cy.get(".text-small").click();
        cy.get('[data-id="inputEmailForgotPassword"]').clear(this.data.email);
        cy.get('[data-id="inputEmailForgotPassword"]').type(this.data.email);
        cy.get('[data-id="submit"]').click();
        cy.contains("Forgot Password");
        cy.openEmail();
        cy.contains("superadmin@gmail.com").click();
        cy.frameLoaded("#preview-html");
        cy.wait(500);
        getIframeDocument()
            .find(".button")
            .contains("Reset Password")
            .invoke("attr", "target", "_blank")
            .then(function ($e1) {
                const url = $e1.prop("href");
                cy.visit(url);
                cy.get('[data-id="inputPasswordResetPassword"]')
                    .click()
                    .type("test1234");
                cy.get('[data-id="inputPasswordConfirmResetPassword"]')
                    .click()
                    .type("test1234");
                cy.get('[data-id="buttonConfirmResetPassword"]').click();
                cy.visit("/");
            });
        cy.get('[data-id="inputEmail"]').type(this.data.email);
        cy.get('[data-id="inputPassword"]').type("test1234");
        cy.get('[data-id="buttonLogin"]').click();
    });
});

describe("case negative", function () {
    beforeEach(function () {
        cy.resetDb();
        cy.fixture("scenario").then(function (data) {
            this.data = data;
        });
    });
    it("testing forgot password input Semua Kosong", function () {
        cy.visit("/");
        cy.get(".text-small").click();
        cy.get('[data-id="inputEmailForgotPassword"]').clear(this.data.email);
        cy.get('[data-id="inputEmailForgotPassword"]').type(this.data.email);
        cy.get('[data-id="submit"]').click();
        cy.contains("Forgot Password");
        cy.openEmail();
        cy.contains("superadmin@gmail.com").click();
        cy.frameLoaded("#preview-html");
        cy.wait(500);
        getIframeDocument()
            .find(".button")
            .contains("Reset Password")
            .invoke("attr", "target", "_blank")
            .then(function ($e1) {
                const url = $e1.prop("href");
                cy.visit(url);
                cy.get('[data-id="buttonConfirmResetPassword"]').click();
                cy.get("input:invalid").invoke("prop", "validationMessage");
            });
    });

    it("testing forgot password input Email diisi dengan format salah", function () {
        cy.visit("/");
        cy.get(".text-small").click();
        cy.get('[data-id="inputEmailForgotPassword"]').clear(this.data.email);
        cy.get('[data-id="inputEmailForgotPassword"]').type(this.data.email);
        cy.get('[data-id="submit"]').click();
        cy.contains("Forgot Password");
        cy.openEmail();
        cy.contains("superadmin@gmail.com").click();
        cy.frameLoaded("#preview-html");
        cy.wait(500);
        getIframeDocument()
            .find(".button")
            .contains("Reset Password")
            .invoke("attr", "target", "_blank")
            .then(function ($e1) {
                const url = $e1.prop("href");
                cy.visit(url);
                cy.get('[data-id="inputEmailResetPassword"]').clear();
                cy.get('[data-id="inputEmailResetPassword"]').type("okeoke123");
                cy.get('[data-id="buttonConfirmResetPassword"]').click();
                cy.get("input:invalid").invoke("prop", "validationMessage");
            });
    });

    it("testing forgot password input Email tidak diisi, password dan password confirm diisi", function () {
        cy.visit("/");
        cy.get(".text-small").click();
        cy.get('[data-id="inputEmailForgotPassword"]').clear(this.data.email);
        cy.get('[data-id="inputEmailForgotPassword"]').type(this.data.email);
        cy.get('[data-id="submit"]').click();
        cy.contains("Forgot Password");
        cy.openEmail();
        cy.contains("superadmin@gmail.com").click();
        cy.frameLoaded("#preview-html");
        cy.wait(500);
        getIframeDocument()
            .find(".button")
            .contains("Reset Password")
            .invoke("attr", "target", "_blank")
            .then(function ($e1) {
                const url = $e1.prop("href");
                cy.visit(url);
                cy.get('[data-id="inputEmailResetPassword"]').clear();
                cy.get('[data-id="inputPasswordResetPassword"]')
                    .click()
                    .type("test1234");
                cy.get('[data-id="inputPasswordConfirmResetPassword"]')
                    .click()
                    .type("test1234");
                cy.get('[data-id="buttonConfirmResetPassword"]').click();
                cy.get("input:invalid").invoke("prop", "validationMessage");
            });
    });

    it("testing input password input Email disii, password dan password confirm tidak diisi", function () {
        cy.visit("/");
        cy.get(".text-small").click();
        cy.get('[data-id="inputEmailForgotPassword"]').clear(this.data.email);
        cy.get('[data-id="inputEmailForgotPassword"]').type(this.data.email);
        cy.get('[data-id="submit"]').click();
        cy.contains("Forgot Password");
        cy.openEmail();
        cy.contains("superadmin@gmail.com").click();
        cy.frameLoaded("#preview-html");
        cy.wait(500);
        getIframeDocument()
            .find(".button")
            .contains("Reset Password")
            .invoke("attr", "target", "_blank")
            .then(function ($e1) {
                const url = $e1.prop("href");
                cy.visit(url);
                cy.get('[data-id="buttonConfirmResetPassword"]').click();
                cy.get("input:invalid").invoke("prop", "validationMessage");
            });
    });
    it("testing input password input Email dan password disii, password confirm tidak diisi", function () {
        cy.visit("/");
        cy.get(".text-small").click();
        cy.get('[data-id="inputEmailForgotPassword"]').clear(this.data.email);
        cy.get('[data-id="inputEmailForgotPassword"]').type(this.data.email);
        cy.get('[data-id="submit"]').click();
        cy.contains("Forgot Password");
        cy.openEmail();
        cy.contains("superadmin@gmail.com").click();
        cy.frameLoaded("#preview-html");
        cy.wait(500);
        getIframeDocument()
            .find(".button")
            .contains("Reset Password")
            .invoke("attr", "target", "_blank")
            .then(function ($e1) {
                const url = $e1.prop("href");
                cy.visit(url);
                cy.get('[data-id="buttonConfirmResetPassword"]').click();
                cy.get('[data-id="inputPasswordResetPassword"]')
                    .click()
                    .type("test1234");
                cy.get("input:invalid").invoke("prop", "validationMessage");
            });
    });

    it("testing input password input Email dan password disii, password confirm beda", function () {
        cy.visit("/");
        cy.get(".text-small").click();
        cy.get('[data-id="inputEmailForgotPassword"]').clear(this.data.email);
        cy.get('[data-id="inputEmailForgotPassword"]').type(this.data.email);
        cy.get('[data-id="submit"]').click();
        cy.contains("Forgot Password");
        cy.openEmail();
        cy.contains("superadmin@gmail.com").click();
        cy.frameLoaded("#preview-html");
        cy.wait(500);
        getIframeDocument()
            .find(".button")
            .contains("Reset Password")
            .invoke("attr", "target", "_blank")
            .then(function ($e1) {
                const url = $e1.prop("href");
                cy.visit(url);
                cy.get('[data-id="inputPasswordResetPassword"]')
                    .click()
                    .type("test1234");
                cy.get('[data-id="inputPasswordConfirmResetPassword"]')
                    .click()
                    .type("test123456");
                cy.get('[data-id="buttonConfirmResetPassword"]').click();
                cy.get("input:invalid").invoke("prop", "validationMessage");
            });
    });
});
