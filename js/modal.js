document.addEventListener('DOMContentLoaded', () => {
	const openButtons = document.querySelectorAll('[data-modal-open]');
	const closeButtons = document.querySelectorAll('[data-modal-close]');
  
	let activeModal = null;
	let lastFocusedElement = null;
  
	function openModal(modalId) {
	  const modal = document.getElementById(modalId);
  
	  if (!modal) return;
  
	  lastFocusedElement = document.activeElement;
	  activeModal = modal;
  
	  modal.hidden = false;
	  document.body.style.overflow = 'hidden';
  
	  const focusable = modal.querySelector(
		'button, [href], input, select, textarea, [tabindex]:not([tabindex="-1"])'
	  );
  
	  if (focusable) {
		focusable.focus();
	  }
	}
  
	function closeModal() {
	  if (!activeModal) return;
  
	  activeModal.hidden = true;
	  document.body.style.overflow = '';
  
	  if (lastFocusedElement) {
		lastFocusedElement.focus();
	  }
  
	  activeModal = null;
	}
  
	openButtons.forEach((button) => {
	  button.addEventListener('click', () => {
		openModal(button.dataset.modalOpen);
	  });
	});
  
	closeButtons.forEach((button) => {
	  button.addEventListener('click', closeModal);
	});
  
	document.addEventListener('keydown', (event) => {
	  if (event.key === 'Escape') {
		closeModal();
	  }
	});
  });