"use strict";

jQuery(document).ready(function ($) {
  // Carrusel Hero 
  var $carousel_hero = $('.hero__carousel');
  $carousel_hero.owlCarousel({
    items: 1,
    loop: true,
    nav: false,
    dots: false,
    dotsContainer: '.hero__dots',
    autoplayTimeout: 500,
    smartSpeed: 600,
    margin: 16,
    responsive: {
      768: {
        items: 2,
        margin: 18,
        autoplayTimeout: 5000,
        autoplay: true
      }
    }
  }); // Flechas

  $('.hero__arrow--next').click(function () {
    $carousel_hero.trigger('next.owl.carousel');
  });
  $('.hero__arrow--prev').click(function () {
    $carousel_hero.trigger('prev.owl.carousel');
  }); // Carrusel cursos edimss

  var $carousel_edimss = $('.courses__carousel-edimss');
  $carousel_edimss.owlCarousel({
    loop: true,
    margin: 16,
    nav: false,
    dots: false,
    smartSpeed: 500,
    responsive: {
      0: {
        items: 1.4
      },
      576: {
        items: 2
      },
      768: {
        items: 3
      },
      1024: {
        items: 5
      }
    }
  }); // Flechas

  $('.courses__arrow--next-edimss').click(function () {
    $carousel_edimss.trigger('next.owl.carousel');
  });
  $('.courses__arrow--prev-edimss').click(function () {
    $carousel_edimss.trigger('prev.owl.carousel');
  }); // Carrusel cursos microlecciones

  var $carousel_micro = $('.courses__carousel-micro');
  $carousel_micro.owlCarousel({
    loop: true,
    margin: 16,
    nav: false,
    dots: false,
    smartSpeed: 500,
    responsive: {
      0: {
        items: 2
      },
      576: {
        items: 2
      },
      768: {
        items: 4
      },
      1024: {
        items: 5
      }
    }
  }); // Flechas

  $('.courses__arrow--next-micro').click(function () {
    $carousel_micro.trigger('next.owl.carousel');
  });
  $('.courses__arrow--prev-micro').click(function () {
    $carousel_micro.trigger('prev.owl.carousel');
  });
});