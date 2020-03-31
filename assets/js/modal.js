const modal = document.querySelector(".modal");
window.addEventListener("click", clearModal);

function clearModal(e) {
  if (e.target === modal) {
    modal.style.display = "none";
  }
}
