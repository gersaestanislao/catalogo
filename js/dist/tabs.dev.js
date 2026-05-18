"use strict";

document.addEventListener('DOMContentLoaded', function () {
  var tabs = document.querySelectorAll('.course-tabs__btn');
  var contents = document.querySelectorAll('.course-tab');
  tabs.forEach(function (tab) {
    tab.addEventListener('click', function () {
      tabs.forEach(function (t) {
        return t.classList.remove('is-active');
      });
      contents.forEach(function (c) {
        return c.classList.remove('is-active');
      });
      tab.classList.add('is-active');
      var target = document.getElementById(tab.dataset.tab);
      target.classList.add('is-active');
    });
  });
});