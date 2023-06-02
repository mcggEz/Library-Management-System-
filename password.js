// Function to check password requirements
function checkPassword() {
  var passwordInput = document.getElementById("password");
  var password = passwordInput.value;
  var count = document.getElementById("count");
  var check0 = document.getElementById("check0");
  var check1 = document.getElementById("check1");
  var check2 = document.getElementById("check2");
  var check3 = document.getElementById("check3");
  var check4 = document.getElementById("check4");
  var check5 = document.getElementById("check5");

  // count.textContent = "Length: " + password.length;

  // Check length
  if (password.length >= 8) {
    check0.classList.remove("invalid");
    check0.classList.add("valid");
    check0.style.color = "green"; // Update color to green for valid requirement
  } else {
    check0.classList.remove("valid");
    check0.classList.add("invalid");
    check0.style.color = ""; // Reset color for invalid requirement
  }

  // Check uppercase letter
  if (/[A-Z]/.test(password)) {
    check1.classList.remove("invalid");
    check1.classList.add("valid");
    check1.style.color = "green"; // Update color to green for valid requirement
  } else {
    check1.classList.remove("valid");
    check1.classList.add("invalid");
    check1.style.color = ""; // Reset color for invalid requirement
  }

  // Check lowercase letter
  if (/[a-z]/.test(password)) {
    check2.classList.remove("invalid");
    check2.classList.add("valid");
    check2.style.color = "green"; // Update color to green for valid requirement
  } else {
    check2.classList.remove("valid");
    check2.classList.add("invalid");
    check2.style.color = ""; // Reset color for invalid requirement
  }

  // Check number
  if (/[0-9]/.test(password)) {
    check3.classList.remove("invalid");
    check3.classList.add("valid");
    check3.style.color = "green"; // Update color to green for valid requirement
  } else {
    check3.classList.remove("valid");
    check3.classList.add("invalid");
    check3.style.color = ""; // Reset color for invalid requirement
  }

  // Check special character
  if (/[_\-\+=!@%*&":/]/.test(password)) {
    check4.classList.remove("invalid");
    check4.classList.add("valid");
    check4.style.color = "green"; // Update color to green for valid requirement
  } else {
    check4.classList.remove("valid");
    check4.classList.add("invalid");
    check4.style.color = ""; // Reset color for invalid requirement
  }

  // Check exceptions
  if (/[\s\\~<]/.test(password)) {
    check5.classList.remove("valid");
    check5.classList.add("invalid");
    check5.style.color = ""; // Reset color for invalid requirement
  } else {
    check5.classList.remove("invalid");
    check5.classList.add("valid");
    check5.style.color = "green"; // Update color to green for valid requirement
  }
}

function checkPasswords() {
  var password = document.getElementById("password").value;
  var confirmPassword = document.getElementById("confirm_password").value;
  var messageElement = document.getElementById("confirm_password_message");

  if (password !== confirmPassword) {
    // Passwords don't match
    messageElement.textContent = "Passwords don't match";
    // Perform necessary actions (e.g., show error message, disable submit button)
    console.log("Passwords don't match");
  } else {
    // Passwords match
    messageElement.textContent = "Password match";
    // Perform necessary actions (e.g., hide error message, enable submit button)
    console.log("Passwords match");
  }
}

document.getElementById("password").addEventListener("input", checkPasswords);
document
  .getElementById("confirm_password")
  .addEventListener("input", checkPasswords);

function togglePasswordVisibility(fieldId, checkboxId) {
  var field = document.getElementById(fieldId);
  var checkbox = document.getElementById(checkboxId);

  if (checkbox.checked) {
    field.type = "text";
  } else {
    field.type = "password";
  }
}
