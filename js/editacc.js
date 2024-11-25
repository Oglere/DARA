const verifyForm = document.getElementById("verify-form");
verifyForm.addEventListener("submit", async (e) => {
  e.preventDefault();
  const formData = new FormData(verifyForm);

  try {
    const response = await fetch("../../controls/verify.php", {
      method: "POST",
      body: formData,
    });

    const text = await response.text();
    console.log("Raw response:", text); // Debugging line

    const result = JSON.parse(text);

    if (result.status === "success") {
      alert("Verification successful.");
      // Proceed to show the account editing form
      document.getElementById("verify-user").style.display = "none";
      document.getElementById("edit-account-container").innerHTML = `
        <h2>Edit Your Account</h2>
        <form id="edit-account-form">
          <label for="first_name">First Name:</label>
          <input type="text" id="first_name" name="first_name" required>
          <label for="last_name">Last Name:</label>
          <input type="text" id="last_name" name="last_name" required>
          <label for="email">Email:</label>
          <input type="email" id="email" name="email" required>
          <label for="pass">Password:</label>
          <input type="password" id="pass" name="pass" required>
          <button type="submit">Update Account</button>
        </form>
      `;
    } else {
      alert(result.message || "Verification failed.");
    }
  } catch (error) {
    console.error("Error:", error);
    alert("A server error occurred. Please try again.");
  }
});
