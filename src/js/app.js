document.addEventListener("DOMContentLoaded", function () {
  eventListeners();
  darkMode();
});
function darkMode() {
  const prefersDarkMode = window.matchMedia("(prefers-color-scheme: dark)");

  const applyTheme = (mode) => {
    if (mode === "dark") document.body.classList.add("dark-mode");
    else document.body.classList.remove("dark-mode");
  };

  // Preferencia guardada por el usuario (localStorage)
  const stored = localStorage.getItem("theme");
  if (stored) {
    applyTheme(stored);
  } else {
    applyTheme(prefersDarkMode.matches ? "dark" : "light");
  }

  // Si el sistema cambia y el usuario no ha elegido explícitamente, actualizar
  prefersDarkMode.addEventListener("change", () => {
    if (!localStorage.getItem("theme")) {
      applyTheme(prefersDarkMode.matches ? "dark" : "light");
    }
  });

  const darkModebtn = document.querySelector(".dark-mode-boton");
  if (!darkModebtn) return;

  darkModebtn.addEventListener("click", function () {
    const isDark = document.body.classList.toggle("dark-mode");
    localStorage.setItem("theme", isDark ? "dark" : "light");
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
