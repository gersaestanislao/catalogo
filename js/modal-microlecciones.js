  document.addEventListener('DOMContentLoaded', () => {

    const params = new URLSearchParams(window.location.search);
    const hasRefreshApi = params.has('refresh_api');
  
    if (hasRefreshApi) {
      window.history.replaceState(
        {},
        document.title,
        window.location.pathname
      );
  
      return;
    }
  
    const modal = document.getElementById('microModal');
  
    if (!modal) return;
  
    const closeButtons = modal.querySelectorAll(
      '.micro-modal__close, .micro-modal__button'
    );
  
    const openModal = () => {
      modal.classList.add('is-active');
      modal.setAttribute('aria-hidden', 'false');
      document.body.classList.add('modal-open');
    };
  
    const closeModal = () => {
      modal.classList.remove('is-active');
      modal.setAttribute('aria-hidden', 'true');
      document.body.classList.remove('modal-open');
    };
  
    // Mostrar siempre
    openModal();
  
    closeButtons.forEach(btn => {
      btn.addEventListener('click', closeModal);
    });
  
    modal.addEventListener('click', (e) => {
      if (
        e.target === modal ||
        e.target.classList.contains('micro-modal__overlay')
      ) {
        closeModal();
      }
    });
  
    document.addEventListener('keydown', (e) => {
      if (e.key === 'Escape') {
        closeModal();
      }
    });
  
  });