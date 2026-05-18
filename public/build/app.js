document.addEventListener("DOMContentLoaded", function () {
  eventListeners();
  darkMode();
});
function darkMode() {
  const prefersDarkMode = window.matchMedia("(prefers-color-scheme: dark)");

  //console.log(prefersDarkMode.matches);

  if (prefersDarkMode) {
    document.body.classList.add("dark-mode");
  } else {
    document.body.classList.remove("dark-mode");
  }

  prefersDarkMode.addEventListener("change", function () {
    if (prefersDarkMode) {
      document.body.classList.add("dark-mode");
    } else {
      document.body.classList.remove("dark-mode");
    }
  });

  const darkModebtn = document.querySelector(".dark-mode-boton");

  darkModebtn.addEventListener("click", function () {
    document.body.classList.toggle("dark-mode");
  });
}
function eventListeners() {
  const mobileMenu = document.querySelector(".mobile-menu");
  mobileMenu.addEventListener("click", navegacionResponsive);
}
function navegacionResponsive() {
  const navegacion = document.querySelector(".navegacion");
  navegacion.classList.toggle("mostrar");
}
