function dropDownIconChange() {
  $(".dropdown-toggle i").toggleClass("fa-bars fa-caret-down");
}

function openPopUp() {
  document.body.classList.add("showPopUp");
}

function closePopUp() {
  document.body.classList.remove("showPopUp");
}

function openAdminSignUpForm() {
  document.body.classList.add("showPopUp-admin-sign-up");
}

function closeAdminSignUpForm() {
  document.body.classList.remove("showPopUp-admin-sign-up");
}


