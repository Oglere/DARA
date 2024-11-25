document.addEventListener("DOMContentLoaded", () => {
  const checkboxes = document.querySelectorAll("input[type='checkbox']");
  const form = document.getElementById("edit-account-form");
  const cancelButton = document.getElementById("closeModal");

  // Enable/disable corresponding input fields based on checkbox
  checkboxes.forEach((checkbox) => {
    checkbox.addEventListener("change", () => {
      const inputField = checkbox.parentElement.querySelector(
        "input:not([type='checkbox'])"
      );
      inputField.disabled = !checkbox.checked;
    });
  });

  // Cancel button reloads the page
  cancelButton.addEventListener("click", () => {
    window.location.reload();
  });

  // Form submission logic
  form.addEventListener("submit", (e) => {
    e.preventDefault();

    const formData = new FormData();

    checkboxes.forEach((checkbox) => {
      if (checkbox.checked) {
        const inputField = checkbox.parentElement.querySelector(
          "input:not([type='checkbox'])"
        );
        if (inputField && inputField.value.trim() !== "") {
          formData.append(checkbox.value, inputField.value.trim());
        }
      }
    });

    // Check if there are any updates
    if (formData.keys().next().done) {
      alert("No fields have been updated. Please make changes to update.");
      return;
    }

    fetch(form.action, {
      method: "POST",
      body: formData,
    })
      .then((response) => response.json())
      .then((data) => {
        if (data.success) {
          alert("Account updated successfully!");
          window.location.reload();
        } else {
          alert(data.message || "An error occurred. Please try again.");
        }
      })
      .catch((error) => {
        console.error("Error:", error);
        alert("An unexpected error occurred. Please try again.");
      });
  });
});
