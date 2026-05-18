"use strict";

var mq = window.matchMedia("(min-width: 768px)");

function filtrosDesktop(e) {
  if (!e.matches) return;
  document.querySelectorAll('.filtros input').forEach(function (el) {
    el.addEventListener('change', function () {
      el.closest('form').submit();
    });
  });
  document.querySelectorAll('.filtros input').forEach(function (el) {
    el.addEventListener('change', function () {
      var loader = document.getElementById('loader-filtros');

      if (loader) {
        loader.classList.add('is-active');
        loader.setAttribute('aria-hidden', 'false');
      }

      el.closest('form').submit();
    });
  });
}

filtrosDesktop(mq);
mq.addEventListener('change', filtrosDesktop);
var trigger = document.getElementById('trigger-accordion');
trigger.addEventListener('click', function () {
  var accordion = this.nextElementSibling;
  var elemento = this;
  elemento.classList.toggle('filtros__head--active');
  accordion.classList.toggle('filtros__content--active');
});
document.addEventListener('DOMContentLoaded', function () {
  var loader = document.getElementById('loader-filtros');
  var form = document.querySelector('.catalogo__form');
  if (!loader) return; // ======================
  // Mostrar loader
  // ======================

  var showLoader = function showLoader() {
    loader.classList.add('is-active');
    loader.setAttribute('aria-hidden', 'false');
  }; // ======================
  // Submit del form (filtros)
  // ======================


  if (form) {
    form.addEventListener('submit', function () {
      showLoader();
    });
  } // ======================
  // Paginación
  // ======================


  document.addEventListener('click', function (e) {
    var link = e.target.closest('.page-numbers');
    if (!link) return; // evitar loader en enlaces tipo current

    if (link.classList.contains('current')) return;
    showLoader();
  });
});