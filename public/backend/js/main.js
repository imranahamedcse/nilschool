$(document).ready(function () {

  // fullscreen start
  $('#fullScreen').on('click', function () {
    if (
      document.fullscreenElement ||
      document.webkitFullscreenElement ||
      document.mozFullscreenElement ||
      document.msFullscreenElement
    ) {
      $('#fullScreen').html('<i class="fa-solid fa-expand"></i>');
      document.exitFullscreen();
    } else {
      $('#fullScreen').html('<i class="fa-solid fa-compress"></i>');
      document.documentElement.requestFullscreen().catch();
    }
  });
  // fullscreen end


  // theme change start
  function updateTheme() {
    const theme = localStorage.getItem("theme");
    document.querySelector("html").setAttribute("data-bs-theme", theme ?? 'light');
    $('#theme').html((theme == 'light' || theme == null) ? '<i class="fa-solid fa-sun"></i>' : '<i class="fa-solid fa-moon"></i>');
  }

  $('#theme').on('click', function () {
    const theme = localStorage.getItem("theme");
    const colorMode = (theme == 'light' || theme == null) ? "dark" : "light";
    localStorage.setItem("theme", colorMode);
    updateTheme();
  })

  updateTheme();
  // theme change end

  // tooltip start
  const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
  const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
  // tooltip end
});