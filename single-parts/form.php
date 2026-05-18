<div class="course-form  course-form--<?= $esta_abierto ? 'abierto' : 'cerrado'; ?>" id="form">




<h4 class="course-form__title">
<?= $esta_abierto ? 'Inscríbete ahora' : 'Sin inscripciones'; ?>

</h4>

<form>
<input type="text" placeholder="Ingresa tu matrícula" required>

<select id="estado" name="estado" required>
<option value="" selected>Selecciona una delegación</option>

<option value="aguascalientes">Aguascalientes</option>
<option value="baja-california">Baja California</option>
<option value="baja-california-sur">Baja California Sur</option>
<option value="campeche">Campeche</option>
<option value="chiapas">Chiapas</option>
<option value="chihuahua">Chihuahua</option>
<option value="ciudad-de-mexico">Ciudad de México</option>
<option value="coahuila">Coahuila</option>
<option value="colima">Colima</option>
<option value="durango">Durango</option>
<option value="estado-de-mexico">Estado de México</option>
<option value="guanajuato">Guanajuato</option>
<option value="guerrero">Guerrero</option>
<option value="hidalgo">Hidalgo</option>
<option value="jalisco">Jalisco</option>
<option value="michoacan">Michoacán</option>
<option value="morelos">Morelos</option>
<option value="nayarit">Nayarit</option>
<option value="nuevo-leon">Nuevo León</option>
<option value="oaxaca">Oaxaca</option>
<option value="puebla">Puebla</option>
<option value="queretaro">Querétaro</option>
<option value="quintana-roo">Quintana Roo</option>
<option value="san-luis-potosi">San Luis Potosí</option>
<option value="sinaloa">Sinaloa</option>
<option value="sonora">Sonora</option>
<option value="tabasco">Tabasco</option>
<option value="tamaulipas">Tamaulipas</option>
<option value="tlaxcala">Tlaxcala</option>
<option value="veracruz">Veracruz</option>
<option value="yucatan">Yucatán</option>
<option value="zacatecas">Zacatecas</option>
</select>
<button class="btn"type="submit">Enviar</button>
</form>
</div> <!--// Formulario -->
