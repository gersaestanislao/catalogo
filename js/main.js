document.addEventListener('DOMContentLoaded', function () {
  const mq = window.matchMedia('(min-width: 768px)');
  const form = document.querySelector('.catalogo__form');
  const loader = document.getElementById('loader-filtros');

  const showLoader = () => {
    if (!loader) return;

    loader.classList.add('is-active');
    loader.setAttribute('aria-hidden', 'false');
    document.body.classList.add('is-loading');
  };

  const hideLoader = () => {
    if (!loader) return;

    loader.classList.remove('is-active');
    loader.setAttribute('aria-hidden', 'true');
    document.body.classList.remove('is-loading');
  };

  const submitWithReplace = () => {
    if (!form) return;

    showLoader();

    const formData = new FormData(form);
    const params = new URLSearchParams();

    formData.forEach((value, key) => {
      if (value !== '') {
        params.append(key, value);
      }
    });

    const action = form.getAttribute('action') || window.location.pathname;
    const query = params.toString();
    const url = query ? `${action}?${query}` : action;

    window.location.replace(url);
  };

  // Filtros desktop: autosubmit sin agregar historial
  document.querySelectorAll('.filtros input').forEach((input) => {
    input.addEventListener('change', function () {
      if (!mq.matches) return;
      submitWithReplace();
    });
  });

  // Submit normal del formulario también sin agregar historial
  if (form) {
    form.addEventListener('submit', function (e) {
      e.preventDefault();
      submitWithReplace();
    });
  }

  // Restaurar loader al volver con navegador
  window.addEventListener('pageshow', function () {
    hideLoader();
  });
}); 


// formulario 

document.addEventListener('DOMContentLoaded', function () {
  const form = document.getElementById('preregistro_a');

  if (!form) return;

  const button = form.querySelector('.course-form__submit');

  const resetSubmitButton = () => {
    if (!button) return;

    button.disabled = false;
    button.classList.remove('is-loading');

    button.innerHTML = `
      <span class="course-form__submit-text">Enviar</span>
    `;
  };

  form.addEventListener('submit', function () {
    if (!button) return;

    button.disabled = true;
    button.classList.add('is-loading');

    button.innerHTML = `
      <span class="course-form__spinner" aria-hidden="true"></span>
      <span>${button.dataset.loadingText || 'Enviando...'}</span>
    `;
  });

  window.addEventListener('pageshow', function () {
    resetSubmitButton();
  });
});