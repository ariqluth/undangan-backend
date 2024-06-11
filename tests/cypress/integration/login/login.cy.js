describe("Testing Login Page", () => {
    //positive test case
    it("superadmin can login succesfully", () => {
        cy.visit("/");
        cy.get('[data-id="email"]').type("superadmin@gmail.com");
        cy.get('[data-id="password"]').type("password");
        cy.get('[data-id="login"]').click();
        cy.get(".nav-link > .d-sm-none")
            .invoke("text")
            .should("have.text", "Hi,SuperAdmin\n");
    });
    it("admin can login succesfully", () => {});
    it("standard user can login succesfully", () => {});

    //negative test case
    it("cannot login when email is empty", () => {});
    it("cannot login when password is empty", () => {});
    it("cannot login when email is not in the system", () => {});
    it("cannot login when password is incorrect", () => {});
    it("cannot login when email is invalid", () => {});
    it("cannot login when password is to short", () => {});
});
