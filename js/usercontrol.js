// Toggle visibility of elements
function toggleVisibility(elementId, show) {
  const element = document.getElementById(elementId);
  element.classList.toggle("hidden", !show);
}

// Show the Add User form
document.getElementById("add-user-btn").addEventListener("click", () => {
  toggleVisibility("add-user-form", true);
  document.querySelector(".overlay").classList.remove("hidden");
});

// Cancel adding a user
document.getElementById("cancel-add").addEventListener("click", () => {
  toggleVisibility("add-user-form", false);
  toggleVisibility("user-list", true);
  document.querySelector(".overlay").classList.add("hidden");
});

// Filter users by role or search query
document.querySelectorAll(".filter-btn").forEach((button) => {
  button.addEventListener("click", () => {
    const role = button.getAttribute("data-role");
    filterUsers(role);

    // Update button styles
    document.querySelectorAll(".filter-btn").forEach((btn) => {
      btn.classList.replace("btn-primary", "btn-secondary");
    });
    button.classList.replace("btn-secondary", "btn-primary");
  });
});

function filterUsers(role = "all") {
  const searchQuery = document.getElementById("search-bar").value.toLowerCase();
  const rows = document.querySelectorAll("tbody tr");

  rows.forEach((row) => {
    const name = `${row.children[1].textContent.toLowerCase()} ${row.children[2].textContent.toLowerCase()}`;
    const email = row.children[3].textContent.toLowerCase();
    const userRole = row.children[4].textContent;

    const matchesSearch =
      name.includes(searchQuery) || email.includes(searchQuery);
    const matchesRole = role === "all" || userRole === role;

    row.style.display = matchesSearch && matchesRole ? "" : "none";
  });
}

// Handle edit and delete buttons
document.querySelector("tbody").addEventListener("click", (event) => {
  if (event.target.classList.contains("delete-btn")) {
    handleDelete(event);
  } else if (event.target.classList.contains("edit-btn")) {
    handleEdit(event);
  }
});

// Handle deleting a user
function handleDelete(event) {
  document.querySelector(".overlay").classList.remove("hidden");
  const userId = event.target.getAttribute("data-id");
  toggleVisibility("delete-modal", true);

  // Confirm deletion
  document.getElementById("confirm-delete").onclick = () => {
    const formData = new FormData();
    formData.append("action", "delete");
    formData.append("user_id", userId);

    fetch("../../controls/admin/edit_user.php", {
      method: "POST",
      body: formData,
    })
      .then((response) => response.json())
      .then((data) => {
        if (data.status === "success") {
          alert(data.message);
          location.reload();
        } else {
          alert(data.message);
        }
      })
      .catch((error) => console.error("Error:", error));
  };

  // Cancel deletion
  document.getElementById("cancel-delete").onclick = () => {
    toggleVisibility("delete-modal", false);
    document.querySelector(".overlay").classList.add("hidden");
  };
}

// Handle editing a user
function handleEdit(event) {
  document.querySelector(".overlay").classList.remove("hidden");
  toggleVisibility("edit-modal", true);

  const userId = event.target.getAttribute("data-id");
  const row = document.querySelector(`tr[data-id="${userId}"]`);

  if (!row) {
    console.error(`No row found for user ID ${userId}`);
    return;
  }

  // Populate the edit form
  document.getElementById("edit-fname").value =
    row.children[1].textContent.trim();
  document.getElementById("edit-lname").value =
    row.children[2].textContent.trim();
  document.getElementById("edit-email").value =
    row.children[3].textContent.trim();
  document.getElementById("edit-role").value =
    row.children[4].textContent.trim();
  document.getElementById("edit-status").value =
    row.children[5].textContent.trim();

  // Update form data-user-id attribute
  document
    .getElementById("edit-user-form")
    .setAttribute("data-user-id", userId);

  // Cancel edit
  document.getElementById("cancel-edit").onclick = () => {
    toggleVisibility("edit-modal", false);
    document.querySelector(".overlay").classList.add("hidden");
  };
}

// Submit the edit form
document
  .getElementById("edit-user-form")
  .addEventListener("submit", function (event) {
    event.preventDefault();

    const userId = this.getAttribute("data-user-id");
    const formData = new FormData(this);
    formData.append("action", "edit");
    formData.append("user_id", userId);

    fetch("../../controls/admin/edit_user.php", {
      method: "POST",
      body: formData,
    })
      .then((response) => response.json())
      .then((data) => {
        if (data.status === "success") {
          alert(data.message);
          location.reload();
        } else {
          alert(data.message);
        }
      })
      .catch((error) => console.error("Error:", error));
  });
