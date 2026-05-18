const mq = window.matchMedia("(min-width: 768px)");

function filtrosDesktop(e) {

  if (!e.matches) return;

  document.querySelectorAll('.filtros input').forEach(el => {

    el.addEventListener('change', () => {
      el.closest('form').submit()
    });

  });

  document.querySelectorAll('.filtros input').forEach(el => {
    el.addEventListener('change', () => {
  
      const loader = document.getElementById('loader-filtros');
  
      if(loader){
        loader.classList.add('is-active');
        loader.setAttribute('aria-hidden', 'false');
      }
  
      el.closest('form').submit();
    });
  });

}

filtrosDesktop(mq);
mq.addEventListener('change', filtrosDesktop);


  const trigger = document.getElementById('trigger-accordion')

  trigger.addEventListener('click', function() {  
      const accordion = this.nextElementSibling;
      const elemento = this;
  
      elemento.classList.toggle('filtros__head--active');
      accordion.classList.toggle('filtros__content--active');
  });



  document.addEventListener('DOMContentLoaded', function () {

    const loader = document.getElementById('loader-filtros');
    const form = document.querySelector('.catalogo__form');

    if (!loader) return;

    // ======================
    // Mostrar loader
    // ======================
    const showLoader = () => {
        loader.classList.add('is-active');
        loader.setAttribute('aria-hidden', 'false');
    };

    // ======================
    // Submit del form (filtros)
    // ======================
    if (form) {
        form.addEventListener('submit', function () {
            showLoader();
        });
    }

    // ======================
    // Paginación
    // ======================
    document.addEventListener('click', function (e) {

        const link = e.target.closest('.page-numbers');

        if (!link) return;

        // evitar loader en enlaces tipo current
        if (link.classList.contains('current')) return;

        showLoader();
    });

});