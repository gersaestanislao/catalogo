document.addEventListener('DOMContentLoaded', () => {
  const tabs = document.querySelectorAll('.course-tabs__btn');
  const contents = document.querySelectorAll('.course-tab');

  tabs.forEach(tab => {
    tab.addEventListener('click', () => {

      tabs.forEach(t => t.classList.remove('is-active'));
      contents.forEach(c => c.classList.remove('is-active'));

      tab.classList.add('is-active');

      const target = document.getElementById(tab.dataset.tab);
      target.classList.add('is-active');
    });
  });
});