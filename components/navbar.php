<nav class="navbar navbar-expand-lg sub-navbar navbar-fixed-top" role="navigation" aria-label="Menú principal">
  
  <div class="container">

    <!-- Logo / Branding -->
    <a class="navbar-brand d-flex align-items-center gap-2" href="<?php echo esc_url( home_url('/') ); ?>">
      <img 
        class="main__logo" 
        src="<?php echo esc_url( get_template_directory_uri() . '/img/logo-imss--blanco.png' ); ?>" 
        alt="Logotipo del IMSS">
      <span class="visually-hidden">Inicio</span>
      <span aria-hidden="true">DEPS-IMSS</span>
    </a>

    <!-- Botón móvil -->
    <button 
      class="navbar-toggler" 
      type="button" 
      data-bs-toggle="collapse" 
      data-bs-target="#navbarScroll" 
      aria-controls="navbarScroll" 
      aria-expanded="false" 
      aria-label="Abrir menú de navegación">
      <i class="fa-solid fa-bars" aria-hidden="true"></i>
    </button>

    <!-- Navegación -->
    <div class="collapse navbar-collapse my-2 my-lg-0 " id="navbarScroll">
      <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll gap-lg-3">

        <li class="nav-item">
          <a class="nav-link" href="<?php echo esc_url( home_url('/') ); ?>">Inicio</a>
        </li>

        <!-- Dropdown: Educación a distancia -->
        <li class="nav-item dropdown">
          <button 
            class="nav-link dropdown-toggle" 
            id="dropdown-distancia" 
            data-bs-toggle="dropdown" 
            aria-expanded="false">
            Educación a distancia
          </button>

          <ul class="dropdown-menu" aria-labelledby="dropdown-distancia">
            <li>
              <a 
                class="dropdown-item" 
                href="<?php echo esc_url( home_url('/catalogo/') ); ?>" 
                rel="noopener noreferrer">
                 Cursos en línea
              </a>
            </li>
            <li>
              <a 
                class="dropdown-item" 
                href="<?php echo esc_url( home_url('/microlecciones/') ); ?>" 
                rel="noopener noreferrer">
                Microlecciones
              </a>
            </li>
          </ul>
        </li>

        <!-- Dropdown: Educación presencial -->
        <li class="nav-item dropdown">
          <button 
            class="nav-link dropdown-toggle" 
            id="dropdown-presencial" 
            data-bs-toggle="dropdown" 
            aria-expanded="false">
            Educación presencial
          </button>

          <ul class="dropdown-menu" aria-labelledby="dropdown-presencial">
            <li>
              <a 
                class="dropdown-item" 
                href="<?php echo esc_url('https://edumed.imss.gob.mx/bCurso/'); ?>" 
                target="_blank" 
                rel="noopener noreferrer">
                Catálogo de cursos
              </a>
            </li>
            <li>
              <a 
                class="dropdown-item" 
                href="<?php echo esc_url('https://edumed.imss.gob.mx/Cursos/'); ?>" 
                target="_blank" 
                rel="noopener noreferrer">
                SIPEC
              </a>
            </li>
          </ul>
        </li>


        <!-- Quiénes somos -->
        <li class="nav-item">
          <a 
            class="nav-link" 
            href="<?php echo esc_url( home_url('/quienes-somos/') ); ?>" 
            target="_blank" 
            rel="noopener noreferrer">
            Quiénes somos
          </a>
        </li>

        <!-- Mesa de ayuda -->
        <li class="nav-item">
          <a 
            class="nav-link" 
            href="<?php echo esc_url('https://innovacioneducativa.imss.gob.mx/mesa/'); ?>" 
            target="_blank" 
            rel="noopener noreferrer">
            Mesa de Ayuda
          </a>
        </li>

      </ul>
    </div>
  </div>
</nav>


<!--   Automatización de menu
  wp_nav_menu([
    'theme_location' => 'main-menu',
    'container'      => false,
    'menu_class'     => 'navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll',
    'fallback_cb'    => false,
    'walker'         => new Bootstrap_Navwalker(),
  ]);
?> -->