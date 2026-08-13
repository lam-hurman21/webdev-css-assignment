/* Pixel & Dice Cafe — JavaScript Lab */

document.addEventListener("DOMContentLoaded", function () {
  showWelcomeMessage();
  setupFormValidation();
  setupShowHideInfo();
  setupThemeToggle();
});

/* 1. Welcome message on the Home page */
function showWelcomeMessage() {
  var welcomeEl = document.getElementById("welcome-message");
  if (!welcomeEl) {
    return;
  }

  var name = prompt("What is your name?");

  if (name && name.trim() !== "") {
    welcomeEl.textContent = "Welcome, " + name.trim() + "! Glad you stopped by.";
  } else {
    welcomeEl.textContent = "Welcome to Pixel and Dice Cafe!";
  }
}

/* 2. Form validation */
function setupFormValidation() {
  var forms = document.querySelectorAll("form[data-validate]");

  forms.forEach(function (form) {
    form.addEventListener("submit", function (event) {
      var errorBox = form.querySelector(".form-error");
      var requiredFields = form.querySelectorAll("[data-required]");
      var emptyFields = [];

      requiredFields.forEach(function (field) {
        if (field.value.trim() === "") {
          emptyFields.push(field);
          field.classList.add("input-error");
        } else {
          field.classList.remove("input-error");
        }
      });

      if (emptyFields.length > 0) {
        event.preventDefault();
        if (errorBox) {
          errorBox.textContent = "Please fill in all required fields before submitting.";
          errorBox.style.display = "block";
        }
        emptyFields[0].focus();
        return;
      }

      if (errorBox) {
        errorBox.style.display = "none";
        errorBox.textContent = "";
      }

      // Valid form: allow normal submit (POST to PHP when action is set)
    });
  });
}

/* 3a. Show / hide extra information */
function setupShowHideInfo() {
  var toggleBtn = document.getElementById("toggle-info-btn");
  var extraInfo = document.getElementById("extra-info");

  if (!toggleBtn || !extraInfo) {
    return;
  }

  toggleBtn.addEventListener("click", function () {
    if (extraInfo.style.display === "none" || extraInfo.style.display === "") {
      extraInfo.style.display = "block";
      toggleBtn.textContent = "Hide extra info";
    } else {
      extraInfo.style.display = "none";
      toggleBtn.textContent = "Show extra info";
    }
  });
}

/* 3b. Change text colour + confirmation message */
function setupThemeToggle() {
  var colourBtn = document.getElementById("change-colour-btn");
  var confirmMsg = document.getElementById("confirm-message");
  var target = document.getElementById("games-heading");

  if (!colourBtn || !target) {
    return;
  }

  var changed = false;

  colourBtn.addEventListener("click", function () {
    if (!changed) {
      target.style.color = "#c47b2b";
      colourBtn.textContent = "Reset heading colour";
      if (confirmMsg) {
        confirmMsg.textContent = "Heading colour changed!";
      }
      changed = true;
    } else {
      target.style.color = "";
      colourBtn.textContent = "Change heading colour";
      if (confirmMsg) {
        confirmMsg.textContent = "Heading colour reset.";
      }
      changed = false;
    }
  });
}
