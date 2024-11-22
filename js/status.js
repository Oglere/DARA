function openModal(modalId, docId) {
  var modal = document.getElementById(modalId);
  modal.style.display = "block";

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
  const reviewContent = document.getElementById("reviewContent");

  reviewContent.innerHTML = `<p>Loading content for document ID: ${docId}</p>`;

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

  fetch(`get_document.php?doc_id=${docId}`)
    .then((response) => response.json())
    .then((data) => {
      // Populate the form fields with the fetched data
      editTitle.value = data.title;
      editStatus.value = data.status;
      editAuthors.value = JSON.parse(data.authors).join(", ");
      editCitations.value = JSON.parse(data.citations).join(", ");
      editMetadata.value = JSON.stringify(data.metadata, null, 2);
      docIdInput.value = data.document_id;
    });
}

function setupAbandonAction(docId) {
  const abandonBtn = document.getElementById("confirmAbandon");
  abandonBtn.onclick = function () {
    fetch(`abandon_document.php?doc_id=${docId}`, { method: "POST" })
      .then((response) => response.text())
      .then((data) => {
        alert("Document abandoned successfully.");
        closeModal("abandonModal");
        location.reload();
      });
  };
}

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
      location.reload();
    })
    .catch((error) => {
      alert("An error occurred: " + error);
    });
}
