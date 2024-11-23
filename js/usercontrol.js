document.getElementById("add-user-btn").addEventListener("click", () => {
  document.getElementById("add-user-form").classList.remove("hidden");
  document.getElementById("user-list").classList.add("hidden");
});

document.getElementById("cancel-add").addEventListener("click", () => {
  document.getElementById("add-user-form").classList.add("hidden");
  document.getElementById("user-list").classList.remove("hidden");
});

document.querySelectorAll(".delete-btn").forEach((button) => {
  button.addEventListener("click", () => {
    if (confirm("Are you sure you want to delete this user?")) {
      const userId = button.getAttribute("data-id");
    }
  });
});

document.querySelectorAll(".filter-btn").forEach((button) => {
  button.addEventListener("click", () => {
    const role = button.getAttribute("data-role");
    filterUsers(role);

    // Update button styling
    document
      .querySelectorAll(".filter-btn")
      .forEach((btn) => btn.classList.replace("btn-primary", "btn-secondary"));
    button.classList.replace("btn-secondary", "btn-primary");
  });
});

function filterUsers(role = "all") {
  const searchQuery = document.getElementById("search-bar").value.toLowerCase();
  const rows = document.querySelectorAll("tbody tr");

  rows.forEach((row) => {
    const name =
      row.children[1].textContent.toLowerCase() +
      " " +
      row.children[2].textContent.toLowerCase();
    const email = row.children[3].textContent.toLowerCase();
    const userRole = row.children[4].textContent;

    const matchesSearch =
      name.includes(searchQuery) || email.includes(searchQuery);
    const matchesRole = role === "all" || userRole === role;

    row.style.display = matchesSearch && matchesRole ? "" : "none";
  });
}

document.getElementById("add-user-btn").addEventListener("click", () => {
  document.getElementById("add-user-form").classList.remove("hidden");
  document.querySelector(".overlay").classList.remove("hidden");
});

document.getElementById("cancel-add").addEventListener("click", () => {
  document.getElementById("add-user-form").classList.add("hidden");
  document.querySelector(".overlay").classList.add("hidden");
});

document.querySelectorAll(".filter-btn").forEach((button) => {
  button.addEventListener("click", () => {
    const role = button.getAttribute("data-role");
    filterUsers(role);

    document
      .querySelectorAll(".filter-btn")
      .forEach((btn) => btn.classList.replace("btn-primary", "btn-secondary"));
    button.classList.replace("btn-secondary", "btn-primary");
  });
});

function filterUsers(role = "all") {
  const searchQuery = document.getElementById("search-bar").value.toLowerCase();
  const rows = document.querySelectorAll("tbody tr");

  rows.forEach((row) => {
    const name =
      row.children[1].textContent.toLowerCase() +
      " " +
      row.children[2].textContent.toLowerCase();
    const email = row.children[3].textContent.toLowerCase();
    const userRole = row.children[4].textContent;

    const matchesSearch =
      name.includes(searchQuery) || email.includes(searchQuery);
    const matchesRole = role === "all" || userRole === role;

    row.style.display = matchesSearch && matchesRole ? "" : "none";
  });
}
