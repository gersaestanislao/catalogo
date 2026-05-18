
<?php 
// =======================
// FEATURE
// =======================
get_template_part('components/help-widget'); 
?>

<footer class="footer-deps">

<div class="container">

  <div class="footer-deps__top">

    <!-- Columna 1 -->
    <div class="footer-deps__col ">
      <h5 class="footer-deps__title mb-5">División de Educación Permanente en Salud de la Coordinación de Educación en Salud</h5>

      <ul class="footer-deps__contact">
        <li class="footer-deps__item footer-deps__item--location">
        <i class="fa-solid fa-location-dot"></i>
          Cuauhtémoc 330, Doctores 06720, Ciudad de México (55) 5627 6900 Ext. 21175
        </li>

        <li class="footer-deps__item footer-deps__item--phone">
        <i class="fa-solid fa-phone"></i>
          División de Formación de Recursos Humanos para la Salud | Ext. 21178
        </li>

        <li class="footer-deps__item footer-deps__item--phone">
        <i class="fa-solid fa-phone"></i>
          División de Desarrollo del Proceso Educativo en Salud | Ext. 21243
        </li>

        <li class="footer-deps__item footer-deps__item--phone">
        <i class="fa-solid fa-phone"></i>
          División de Educación Permanente en Salud | Ext. 21254
        </li>
      </ul>
    </div>

    <!-- Columna 2 -->
    <div class="footer-deps__col">
      <h5 class="footer-deps__title mb-5">Eduacación a Distancia</h5>
      <ul class="footer-deps__links">
        <li><a href="<?php echo esc_url(home_url('/catalogo/')); ?>">Catálogo de Cursos EDIMSS</a></li>
        <li><a href="<?php echo esc_url(home_url('/microlecciones/')); ?>">Catálogo de Cursos Microlecciones</a></li>
      </ul>
    </div>

    <!-- Columna 3 -->
    <div class="footer-deps__col">
    <h5 class="footer-deps__title mb-5">Eduacación a Presencial</h5>
      <ul class="footer-deps__links">
        <li><a target="_blank" href="https://edumed.imss.gob.mx/bCurso/">Catálogo de Cursos</a></li>
        <li><a target="_blank" href="https://edumed.imss.gob.mx/Cursos/">SIPEC</a></li>
      </ul>
    </div>



  </div>


  <!-- Divider -->
  <div class="footer-deps__divider container"></div>


  <!-- Bottom -->
  <div class="footer-deps__bottom container">

    <!-- <nav class="footer-deps__nav">
      <a href="">Inicio</a>
      <a href="#">DEPS</a>
      <a href="#">Educación a Distancia</a>
      <a href="#">Educación Presencial</a>
      <a href="">CSECQ</a>
      <a href="#">Normatividad</a>
      <a href="#">Aviso de privacidad</a>
      <a href="#">Mapa de sitio</a>
    </nav> -->

    <p class="footer-deps__copy">Todos los derechos IMSS 2025</p>

    <div class="footer-deps__social">
      <a target="_blank" href="https://www.facebook.com/SaberIMSS/" aria-label="Facebook"><i class="fa-brands fa-facebook-f"></i></a>
      <a target="_blank" href="https://x.com/Saber_IMSS/" aria-label="Twitter"><i class="fa-brands fa-x-twitter"></i></a>
      <a target="_blank" href="https://www.tiktok.com/@saberimss" aria-label="TikTok"><i class="fa-brands fa-tiktok"></i></a>
      <a target="_blank" href="https://www.youtube.com/@SaberIMSS" aria-label="YouTube"><i class="fa-brands fa-youtube"></i></a>
      <a target="_blank" href="https://www.instagram.com/saber_imss_mx/" aria-label="Instagram"><i class="fa-brands fa-instagram"></i></a>
    </div>

  </div>
  </div>
</footer>

  
  
  
  
  
  
  
  
  
  <!-- JS principal -->
  <script src="https://framework-gb.cdn.gob.mx/gm/v3/assets/js/gobmx.js"></script>
  <script src="<?php bloginfo('template_url') ?>/js/jquery.js"></script>
  <script src="<?php bloginfo('template_url') ?>/js/owl.carousel.js"></script>
  <script src="<?php bloginfo('template_url') ?>/js/main.js"></script>
  <script src="<?php bloginfo('template_url') ?>/js/carrusel.js"></script>
  <script src="<?php bloginfo('template_url') ?>/js/tabs.js"></script>
 



<?php wp_footer(); ?>
</body>
</html>