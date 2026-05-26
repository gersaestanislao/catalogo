document.addEventListener('DOMContentLoaded', () => {

  const dropdowns = document.querySelectorAll('.calendar-dropdown');

  dropdowns.forEach((dropdown) => {

      const trigger = dropdown.querySelector('.calendar-dropdown__trigger');
      const menu = dropdown.querySelector('.calendar-dropdown__menu');

      if (!trigger || !menu) return;

      trigger.addEventListener('click', () => {

          const isActive = dropdown.classList.contains('is-active');

          // cerrar otros
          document.querySelectorAll('.calendar-dropdown').forEach((item) => {
              item.classList.remove('is-active');

              const btn = item.querySelector('.calendar-dropdown__trigger');

              if (btn) {
                  btn.setAttribute('aria-expanded', 'false');
              }
          });

          // abrir actual
          if (!isActive) {
              dropdown.classList.add('is-active');
              trigger.setAttribute('aria-expanded', 'true');
          }
      });

  });

  // click fuera
  document.addEventListener('click', (e) => {

      if (!e.target.closest('.calendar-dropdown')) {

          document.querySelectorAll('.calendar-dropdown').forEach((item) => {

              item.classList.remove('is-active');

              const btn = item.querySelector('.calendar-dropdown__trigger');

              if (btn) {
                  btn.setAttribute('aria-expanded', 'false');
              }
          });
      }
  });

});