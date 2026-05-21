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
      action="http://educacionensalud.imss.gob.mx/microaprendizajes/sied/app/preRegistroWbr/preregistroUsuario.php"  
      method="post"
    >

      <input 
        type="hidden" 
        name="idcur" 
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

</div>