<div 
  class="course-form course-form--abierto" 
  id="course-form"
>

  <h4 class="course-form__title">
    <?= $esta_abierto ? 'Inscríbete ahora' : 'Sin inscripciones'; ?>
  </h4>

  <?php if ($esta_abierto && !empty($imp['id'])) : ?>

    <form 
      class="course-form__form"
      name="preregistro_a" 
      id="preregistro_a" 
      action="/var/www/html/2025/migra/sied/app/preRegistroP/preregistroUsuario.php"  
      method="post"
    >

      <input 
        type="hidden" 
        name="idcurso" 
        value="<?= esc_attr($imp['id']); ?>"
      >

      <div class="course-form__field">
        <label  type="hidden"  class="course-form__label" for="matricula">
          Matrícula
        </label>

        <input 
          class="course-form__input" 
          id="matricula" 
          type="text"
          name="matricula" 
          placeholder="Ingresa tu matrícula" 
          required
        >
      </div>

      <div class="course-form__field">
        <label class="course-form__label" for="delegacion">
          Delegación
        </label>

        <select 
          name="delegacion" 
          id="delegacion" 
          class="course-form__input" 
          required
        >
          <option value="">--Elige tu delegación--</option>
          <option value="01">AGUASCALIENTES</option>
          <option value="02">BAJA CALIFORNIA</option>
          <option value="03">BAJA CALIFORNIA SUR</option>
          <option value="04">CAMPECHE</option>
          <option value="07">CHIAPAS</option>
          <option value="08">CHIHUAHUA</option>
          <option value="05">COAHUILA</option>
          <option value="06">COLIMA</option>
          <option value="35">D F 1 NORTE</option>
          <option value="36">D F 2 NORTE</option>
          <option value="37">D F 3 SUR</option>
          <option value="38">D F 4 SUR</option>
          <option value="10">DURANGO</option>
          <option value="15">EDO MEX OTE</option>
          <option value="16">EDO MEX PTE</option>
          <option value="11">GUANAJUATO</option>
          <option value="12">GUERRERO</option>
          <option value="13">HIDALGO</option>
          <option value="14">JALISCO</option>
          <option value="39">MANDO</option>
          <option value="17">MICHOACAN</option>
          <option value="18">MORELOS</option>
          <option value="19">NAYARIT</option>
          <option value="20">NUEVO LEON</option>
          <option value="21">OAXACA</option>
          <option value="09">OFICINAS CENTRALES</option>
          <option value="22">PUEBLA</option>
          <option value="23">QUERETARO</option>
          <option value="24">QUINTANA ROO</option>
          <option value="25">SAN LUIS POTOSI</option>
          <option value="26">SINALOA</option>
          <option value="27">SONORA</option>
          <option value="28">TABASCO</option>
          <option value="29">TAMAULIPAS</option>
          <option value="30">TLAXCALA</option>
          <option value="31">VERACRUZ NORTE</option>
          <option value="32">VERACRUZ SUR</option>
          <option value="33">YUCATAN</option>
          <option value="34">ZACATECAS</option>
        </select>
      </div>

      <button class="course-form__submit btn" type="submit">
        Enviar
      </button>

    </form>

  <?php else : ?>

    <p class="course-form__message text-center">
      Este curso no cuenta con inscripciones abiertas por el momento.
    </p>



  <?php endif; ?>

  <?php
// Buscar próxima implementación futura
$proxima = null;
$hoy = date('Y-m-d');

if (!empty($futuras)) {
    usort($futuras, function($a, $b) {
        return strtotime($a['iniciopreregistro']) - strtotime($b['iniciopreregistro']);
    });

    $proxima = $futuras[0];
}

if (!$esta_abierto && !empty($proxima)) :

    $fecha_inicio = date('Ymd', strtotime($proxima['iniciopreregistro']));
    $fecha_fin    = date('Ymd', strtotime($proxima['iniciopreregistro'] . ' +1 day'));

    $titulo = 'Apertura de inscripción: ' . get_the_title();

    $detalle = 'El curso abrirá inscripciones el ' . edmiss_formatear_fecha($proxima['iniciopreregistro']) . '.';
    $url_curso = get_permalink();

    $google_url = add_query_arg([
        'action'  => 'TEMPLATE',
        'text'    => $titulo,
        'dates'   => $fecha_inicio . '/' . $fecha_fin,
        'details' => $detalle . ' ' . $url_curso,
        'ctz'     => 'America/Mexico_City',
    ], 'https://www.google.com/calendar/render');

    $outlook_url = add_query_arg([
        'path'    => '/calendar/action/compose',
        'rrv'     => 'addevent',
        'subject' => $titulo,
        'body'    => $detalle . ' ' . $url_curso,
        'startdt' => date('Y-m-d\T09:00:00', strtotime($proxima['iniciopreregistro'])),
        'enddt'   => date('Y-m-d\T10:00:00', strtotime($proxima['iniciopreregistro'])),
    ], 'https://outlook.office.com/owa/');
?>

<div class="calendar-dropdown">

    <!-- Trigger -->
    <button 
        class="calendar-dropdown__trigger"
        type="button"
        aria-expanded="false"
        aria-controls="calendar-dropdown-list"
    >

        <span class="calendar-dropdown__icon">
            <i class="fa-regular fa-calendar-plus"></i>
        </span>

        <span class="calendar-dropdown__text">
            Añadir al calendario
        </span>

        <span class="calendar-dropdown__arrow">
            <i class="fa-solid fa-chevron-down"></i>
        </span>

    </button>

    <!-- Dropdown -->
    <ul 
        class="calendar-dropdown__menu"
        id="calendar-dropdown-list"
    >

        <li class="calendar-dropdown__item">
            <a 
                class="calendar-dropdown__link"
                href="<?php echo esc_url($google_url); ?>" 
                target="_blank" 
                rel="noopener noreferrer"
            >
                <i class="fa-brands fa-google"></i>
                Google Calendar
            </a>
        </li>

        <li class="calendar-dropdown__item">
            <a 
                class="calendar-dropdown__link"
                href="<?php echo esc_url($outlook_url); ?>" 
                target="_blank" 
                rel="noopener noreferrer"
            >
                <i class="fa-brands fa-microsoft"></i>
                Outlook 365
            </a>
        </li>

        <li class="calendar-dropdown__item">
            <a 
                class="calendar-dropdown__link"
                href="<?php echo esc_url(str_replace('outlook.office.com', 'outlook.live.com', $outlook_url)); ?>" 
                target="_blank" 
                rel="noopener noreferrer"
            >
                <i class="fa-regular fa-envelope"></i>
                Outlook Live
            </a>
        </li>

    </ul>

</div>

<?php endif; ?>

</div>