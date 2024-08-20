document.addEventListener("DOMContentLoaded", function () {
  const hamburger = document.querySelector(".hamburger");
  const hamburgermodal = document.querySelector(".hamburgermodal");
  const filter = document.querySelector(".filter");

  function toggleModal() {
    hamburgermodal.classList.toggle("active");
    filter.classList.toggle("active");
  }

  hamburger.addEventListener("click", function (event) {
    event.stopPropagation();
    toggleModal();
  });

  document.addEventListener("click", function (event) {
    if (
      hamburgermodal.classList.contains("active") &&
      !hamburgermodal.contains(event.target) &&
      !hamburger.contains(event.target)
    ) {
      hamburgermodal.classList.remove("active");
      filter.classList.remove("active");
    }
  });
});
