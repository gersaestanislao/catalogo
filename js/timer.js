document.addEventListener('DOMContentLoaded', function () {
	const form = document.querySelector('#preregistro_a');
	const modal = document.querySelector('#sessionExpiredModal');
	const refreshButton = document.querySelector('#sessionExpiredRefresh');
  
	if (!form || !modal || !refreshButton) return;
  
	const SESSION_LIMIT = 45 * 1000; // 1 minuto
	let expired = false;
  
	setTimeout(function () {
	  expired = true;
  
	  modal.classList.add('is-active');
	  modal.setAttribute('aria-hidden', 'false');
	  document.body.classList.add('modal-open');
  
	  form.querySelectorAll('input, select, button').forEach((field) => {
		field.disabled = true;
	  });
	}, SESSION_LIMIT);
  
	form.addEventListener('submit', function (e) {
	  if (!expired) return;
  
	  e.preventDefault();
  
	  modal.classList.add('is-active');
	  modal.setAttribute('aria-hidden', 'false');
	  document.body.classList.add('modal-open');
	});
  
    refreshButton.addEventListener('click', function () {

        document.body.classList.add('is-refreshing');
      
        refreshButton.disabled = true;
      
        refreshButton.innerHTML = `
          <span class="session-modal__spinner"></span>
          Actualizando disponibilidad...
        `;
      
        const url = new URL(window.location.href);
      
        url.searchParams.set('refresh_api', Date.now());
      
        setTimeout(() => {
          window.location.href = url.toString();
        }, 300);
      
      });
  });


