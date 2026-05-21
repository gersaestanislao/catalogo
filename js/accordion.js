document.addEventListener('DOMContentLoaded', () => {
  const accordions = document.querySelectorAll('.faq-accordion');

  accordions.forEach((accordion) => {
    const triggers = accordion.querySelectorAll('.faq-accordion__trigger');

    triggers.forEach((trigger) => {
      trigger.addEventListener('click', () => {
        const item = trigger.closest('.faq-accordion__item');
        const panelId = trigger.getAttribute('aria-controls');
        const panel = document.getElementById(panelId);
        const icon = trigger.querySelector('i');
        const isExpanded = trigger.getAttribute('aria-expanded') === 'true';

        if (!item || !panel) return;

        trigger.setAttribute('aria-expanded', String(!isExpanded));
        panel.hidden = isExpanded;
        item.classList.toggle('is-active', !isExpanded);

        if (icon) {
          icon.classList.toggle('fa-chevron-up', !isExpanded);
          icon.classList.toggle('fa-chevron-down', isExpanded);
        }
      });
    });
  });
});