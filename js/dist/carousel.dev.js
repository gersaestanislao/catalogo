"use strict";

jQuery(document).ready(function ($) {
  // Carrusel Hero 
  var $carousel_hero = $('.hero__carousel');
  $carousel_hero.owlCarousel({
    items: 1,
    loop: true,
    nav: false,
    dots: true,
    dotsContainer: '.hero__dots',
    autoplay: true,
    autoplayTimeout: 5000,
    smartSpeed: 600
  }); // Flechas

  $('.hero__arrow--next').click(function () {
    $carousel_hero.trigger('next.owl.carousel');
  });
  $('.hero__arrow--prev').click(function () {
    $carousel_hero.trigger('prev.owl.carousel');
  }); // Carrusel cursos

  var $carousel = $('.courses__carousel');
  $carousel.owlCarousel({
    loop: true,
    margin: 16,
    nav: false,
    dots: false,
    smartSpeed: 500,
    responsive: {
      0: {
        items: 1.2
      },
      576: {
        items: 2
      },
      768: {
        items: 3
      },
      1024: {
        items: 4
      }
    }
  }); // Flechas

  $('.courses__arrow--next-sm').click(function () {
    $carousel.trigger('next.owl.carousel');
  });
  $('.courses__arrow--prev-sm').click(function () {
    $carousel.trigger('prev.owl.carousel');
  });
});