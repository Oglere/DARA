function openModal(modalId, docId) {
  var modal = document.getElementById(modalId);
  modal.style.display = "block";

  // Depending on the modal, fetch the content
  if (modalId === "reviewModal") {
    loadReviewContent(docId);
  } else if (modalId === "editModal") {
    loadEditContent(docId);
  } else if (modalId === "abandonModal") {
    setupAbandonAction(docId);
  }
}

function closeModal(modalId) {
  var modal = document.getElementById(modalId);
  modal.style.display = "none";
}

function loadReviewContent(docId) {
  // Assuming you have an API endpoint to get document details
  // Use AJAX (or fetch API) to get the content
  const reviewContent = document.getElementById("reviewContent");

  // Example of setting static content. Replace this with AJAX to get dynamic data.
  reviewContent.innerHTML = `<p>Loading content for document ID: ${docId}</p>`;

  // Example AJAX call (replace with your backend URL):
  fetch(`get_document.php?doc_id=${docId}`)
    .then((response) => response.text())
    .then((data) => {
      reviewContent.innerHTML = data;
    });
}

function loadEditContent(docId) {
  const editTitle = document.getElementById("editTitle");
  const editStatus = document.getElementById("editStatus");
  const editAuthors = document.getElementById("editAuthors");
  const editCitations = document.getElementById("editCitations");
  const editMetadata = document.getElementById("editMetadata");
  const docIdInput = document.getElementById("docId");

  // Fetch document data via AJAX
  fetch(`get_document.php?doc_id=${docId}`)
    .then((response) => response.json()) // Assuming the backend returns JSON data
    .then((data) => {
      // Populate the form fields with the fetched data
      editTitle.value = data.title;
      editStatus.value = data.status;
      editAuthors.value = JSON.parse(data.authors).join(", ");
      editCitations.value = JSON.parse(data.citations).join(", ");
      editMetadata.value = JSON.stringify(data.metadata, null, 2); // Prettify JSON for editing
      docIdInput.value = data.document_id;
    });
}

function setupAbandonAction(docId) {
  const abandonBtn = document.getElementById("confirmAbandon");
  abandonBtn.onclick = function () {
    // Add the logic to abandon the document
    fetch(`abandon_document.php?doc_id=${docId}`, { method: "POST" })
      .then((response) => response.text())
      .then((data) => {
        alert("Document abandoned successfully.");
        closeModal("abandonModal");
        location.reload(); // Reload to show updated document status
      });
  };
}

// Close modal when clicking outside of it
window.onclick = function (event) {
  const modals = document.querySelectorAll(".modal");
  modals.forEach((modal) => {
    if (event.target == modal) {
      modal.style.display = "none";
    }
  });
};

function submitEditForm() {
  const editForm = document.getElementById("editForm");
  const formData = new FormData(editForm);

  fetch("update_document.php", {
    method: "POST",
    body: formData,
  })
    .then((response) => response.text())
    .then((data) => {
      alert("Document updated successfully.");
      closeModal("editModal");
      location.reload(); // Reload the page to show updated document details
    })
    .catch((error) => {
      alert("An error occurred: " + error);
    });
}
