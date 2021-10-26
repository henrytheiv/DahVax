function dropDownIconChange() {
  $(".dropdown-toggle i").toggleClass("fa-bars fa-caret-down");
}

//the pop up for patient sign up (OPEN)
function openPatientSignUpForm() {
  document.body.classList.add("showPopUp-patient-sign-up");
}

//the pop up for patient sign up  (CLOSE)
function closePatientSignUpForm() {
  document.body.classList.remove("showPopUp-patient-sign-up");
}

//the pop up for administrator sign up  (OPEN)
function openAdminSignUpForm() {
  document.body.classList.add("showPopUp-admin-sign-up");
}

//close the pop up for administrator sign up (CLOSE)
function closeAdminSignUpForm() {
  document.body.classList.remove("showPopUp-admin-sign-up");
}

//the pop up for administrator to record new vaccine (OPEN)

//the pop up for administrator to record new vaccine (CLOSE)
function closePopUp() {
  document.body.classList.remove("showPopUp");
}

//requestvaccineappointment.html
//the pop up for request vaccine (show centre name) (OPEN)
function openPopUpRequestVaccination() {
  document.body.classList.add("showPopUp-requestvaccination-centre");
}

//requestvaccineappointment.html
//the pop up for request vaccine (show centre name) (CLOSE)
function closePopUpRequestVaccination() {
  document.body.classList.remove("showPopUp-requestvaccination-centre");
}

//requestvaccineappointment.html
//hiding and showing the Batch No table
function showBatchTable() {
  var x = document.getElementById("BatchNo-table");
  if (x.style.display === "block") {
    x.style.display = "none";
  } else {
    x.style.display = "block";
  }
}

//requestvaccineappointment.html
//hiding and showing the calender for appointment date
function showCalender() {
  var x = document.getElementById("AppointmentDate");
  if (x.style.display === "block") {
    x.style.display = "none";
  } else {
    x.style.display = "block";
  }
}

//open the centre name and show name and address in sign up
function openCentreName() {
  document.body.classList.add("showPopUp-centre-name");
}

function closeCentreName() {
  document.body.classList.close("showPopUp-centre-name");
}

// Login validation

function loginValidation() {
  var loginForm = document.getElementById("form");
  var username = document.getElementById("username");
  var password = document.getElementById("password");

  loginForm.addEventListener("submit", (e) => {
    e.preventDefault();
    checkLoginDetails();
  });
}

function checkLoginDetails() {
  usernameValue = username.value.trim();
  passwordValue = password.value.trim();

  if (usernameValue === "abc" && passwordValue === "123") {
    setSuccessFor(username);
    setSuccessFor(password);
    location.href = "AdminMenu.html";
  } else if (usernameValue === "def" && passwordValue === "456") {
    setSuccessFor(username);
    setSuccessFor(password);
    location.href = "PatientMenu.html";
  } else {
    setErrorFor(username, "Invalid username");
    setErrorFor(password, "Invalid password");
  }

  if (usernameValue === "") {
    setErrorFor(username, "Username cannot be blank");
  }

  if (passwordValue === "") {
    setErrorFor(password, "Password cannot be blank");
  }
}

// function setErrorFor(input, message) {
//   const formControl = input.parentElement;
//   const small = formControl.querySelector("small");
//   formControl.className = "form-control error";
//   small.innerText = message;
// }

// function setSuccessFor(input) {
//   const formControl = input.parentElement;
//   formControl.className = "form-control success";
// }

function patientSignUpValidation() {
  var patientSignUpForm = document.getElementById("patient-sign-up-form");
  var patientUsername = document.getElementById("patientUsername");
  var patientPassword = document.getElementById("patientPassword");
  var patientFullname = document.getElementById("patientFullname");
  var patientEmail = document.getElementById("patientEmail");
  var patientIcpassport = document.getElementById("patientIcpassport");

  patientSignUpForm.addEventListener("submit", (e) => {
    e.preventDefault();
    checkPatientSignUpDetails();
  });
}

function checkPatientSignUpDetails() {
  patientUsernameValue = patientUsername.value.trim();
  patientPasswordValue = patientPassword.value.trim();
  patientFullnameValue = patientFullname.value.trim();
  patientEmailValue = patientEmail.value.trim();
  patientIcpassportValue = patientIcpassport.value.trim();

  //username
  if (patientUsernameValue === "") {
    setErrorFor(patientUsername, "Username cannot be empty");
  } else {
    setSuccessFor(patientUsername);
  }

  if (patientPasswordValue === "") {
    setErrorFor(patientPassword, "Password cannot be empty");
  } else {
    setSuccessFor(patientPassword);
  }

  if (patientFullnameValue === "") {
    setErrorFor(patientFullname, "Full name cannot be empty");
  } else {
    setSuccessFor(patientFullname);
  }

  if (patientEmailValue === "") {
    setErrorFor(patientEmail, "Email cannot be empty");
  } else {
    setSuccessFor(patientEmail);
  }

  if (patientIcpassportValue === "") {
    setErrorFor(patientIcpassport, "Passport No. cannot be empty");
  } else {
    setSuccessFor(patientIcpassport);
  }
}

//sign up validation for admin
function adminSignUpValidation() {
  var adminForm = document.getElementById("admin-sign-up-form");
  var adminUsername = document.getElementById("adminUsername");
  var adminPassword = document.getElementById("adminPassword");
  var adminFullname = document.getElementById("adminFullname");
  var adminEmail = document.getElementById("adminEmail");
  var adminStaffID = document.getElementById("adminStaffID");

  adminForm.addEventListener("submit", (e) => {
    e.preventDefault();

    adminUsernameValue = adminUsername.value.trim();
    adminPasswordValue = adminPassword.value.trim();
    adminFullnameValue = adminFullname.value.trim();
    adminEmailValue = adminEmail.value.trim();
    adminStaffIDValue = adminStaffID.value.trim();

    if (adminUsernameValue === "") {
      setErrorFor(adminUsername, "Username cannot be empty");
    } else {
      setSuccessFor(adminUsername);
    }

    if (adminPasswordValue === "") {
      setErrorFor(adminPassword, "Password cannot be empty");
    } else {
      setSuccessFor(adminPassword);
    }

    if (adminFullnameValue === "") {
      setErrorFor(adminFullname, "Full name cannot be empty");
    } else {
      setSuccessFor(adminFullname);
    }

    if (adminEmailValue === "") {
      setErrorFor(adminEmail, "Email cannot be empty");
    } else {
      setSuccessFor(adminEmail);
    }

    if (adminStaffIDValue === "") {
      setErrorFor(adminStaffID, "Staff ID cannot be empty");
    } else {
      setSuccessFor(adminStaffID);
    }
  });
}

//add new centre validation
function addCentreValidation() {
  var centreForm = document.getElementById("new-centre-form");
  var centreName = document.getElementById("centreName");
  var address = document.getElementById("address");

  centreForm.addEventListener("submit", (e) => {
    e.preventDefault();

    centreNameValue = centreName.value.trim();
    addressValue = address.value.trim();

    if (centreNameValue === "") {
      setErrorFor(centreName, "enter a centre name");
    } else {
      setSuccessFor(centreName);
    }

    if (addressValue === "") {
      setErrorFor(address, "enter an address for centre");
    } else {
      setSuccessFor(address);
    }
  });
}

//SignUp.html
//hiding and showing the details of centre
function centreDetails() {
  var x = document.getElementById("centreDetails");
  if (x.style.display === "block") {
    x.style.display = "none";
  } else {
    x.style.display = "block";
  }
}

// SignUp.html
//the pop up for add new centre  (OPEN)
function openNewCentre() {
  document.body.classList.add("showPopUp-add-new-centre");
}

// SignUp.html
//the pop up for add new centre (CLOSE)
function closeNewCentre() {
  document.body.classList.remove("showPopUp-add-new-centre");
}

// SignUp.html
//the pop up for administrator sign up  (OPEN)
function openAdminSignUpForm() {
  document.body.classList.add("showPopUp-admin-sign-up");
}

// SignUp.html
//close the pop up for administrator sign up (CLOSE)
function closeAdminSignUpForm() {
  document.body.classList.remove("showPopUp-admin-sign-up");
}

function newBatchValidation() {
  var form = document.getElementById("form");
  var batchNo = document.getElementById("batchNo");
  var expiryDate = document.getElementById("expiryDate");
  var quantity = document.getElementById("quantity");

  form.addEventListener("add", (e) => {
    e.preventDefault();
    checkBatchInfo();
    alert("Recorded successfully!");
  });
}

function checkBatchInfo() {
  batchNoValue = batchNo.value.trim();
  expiryDateValue = expiryDate.value;
  quantityValue = quantity.value.trim();
  var correctBatch = true;

  var todayDate = new Date();

  if (new Date(expiryDateValue).getTime() <= todayDate.getTime()) {
    setErrorFor(expiryDate, "Invalid expiry date");
    correctBatch = false;
  } else {
    setSuccessFor(expiryDate);
  }

  if (quantityValue < 10) {
    setErrorFor(quantity, "Invalid quantity");
    correctBatch = false;
  } else {
    setSuccessFor(quantity);
  }

  if (batchNoValue === "") {
    setErrorFor(batchNo, "Batch No. cannot be blank");
    correctBatch = false;
  } else {
    setSuccessFor(batchNo);
  }

  if (expiryDateValue === "") {
    setErrorFor(expiryDate, "Expiry date cannot be blank");
    correctBatch = false;
  }

  if (quantityValue === "") {
    setErrorFor(quantity, "Quantity cannot be blank");
    correctBatch = false;
  }

  return correctBatch;
}

function clearBatchInputs() {
  document.getElementById("batchNo").value = "";
  document.getElementById("expiryDate").value = "";
  document.getElementById("quantity").value = "";
}

function requestVaccinationAppointment() {
  alert("Requested successfully!");
  location.href = "PatientMenu.html";
}

// function saveVaccineForNewBatch(elem) {
//   var id = $(elem).find(".vaccineID").text();

//   alert(id);
// }



// $(".menu-btn").click(function (event) {
//   event.stopPropagation();
//   $(".menu-window").toggle(function () {
//     // get the last value saved and inverts the value
//     var isOpen = sessionStorage.getItem("opened");
//     if (isOpen && isOpen === "no") {
//       sessionStorage.setItem("opened", "yes");
//     } else {
//       sessionStorage.setItem("opened", "no");
//     }
//   });
// });

function openPopUp() {
  document.body.classList.add("showPopUp");
  
}


