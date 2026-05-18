document.addEventListener("DOMContentLoaded", function () {
  eventListeners();
  darkMode();
});
function darkMode() {
  const prefersDarkMode = window.matchMedia("(prefers-color-scheme: dark)");

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

  // Muestra campos condicionales
  const metodoContacto = document.querySelectorAll(
    'input[name="contacto[contacto]"]'
  );
  metodoContacto.forEach((input) =>
    input.addEventListener("click", mostrarMetodosContato)
  );
}
function navegacionResponsive() {
  const navegacion = document.querySelector(".navegacion");
  navegacion.classList.toggle("mostrar");
}

function mostrarMetodosContato(e) {
  const contactoDiv = document.querySelector("#contacto");

  if (e.target.value === "telefono") {
    contactoDiv.innerHTML = `
    <label for="telefono">Número de teléfono</label>
    <input type="tel" placeholder="Tú teléfono" id="telefono" name="contacto[telefono]">

    <p>Elija la fecha y hora para la llamada</p>

        <label for="fecha">Fecha:</label>
        <input type="date" id="fecha" name="contacto[fecha]">

        <label for="hora">Hora:</label>
        <input type="time" id="hora" min="8:00" max="19:00" name="contacto[hora]">
    `;
  } else {
    contactoDiv.innerHTML = `
      <label for="email">E-mail</label>
      <input type="email" placeholder="Tú E-mail" id="email" name="contacto[email]">
    `;
  }
}
