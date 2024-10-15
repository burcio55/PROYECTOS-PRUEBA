
<?  if($_SESSION['tipo_usuario']==1){ ?>

<table width="90%"  align="center" >
<tr>
<td width="16%" class="subtititulos"><a class="links-menu-izq" href="1_1agen_trab_datos.php" title="El registro de trabajadores(as)  le permitirÃ¡ postularse a todas las bÃºsquedas de oportunidades de trabajo y capacitaciÃ³n disponibles en el sistema y, las entidades de trabajo que accedan a nuestra base de datos en busca de candidatos y candidatas podrÃ¡n consultarlo.">
<div align="center">Datos Personales </div></a></td>

<td width="18%" class="subtititulos"><a class="links-menu-izq" href="1_4agen_trab_ocupacion.php" title="Detalla la Situación Ocupacional actual del(de la) Trabajador(a); además las preferencias laborales o el área donde le gustaría trabajar, puede seleccionar 2 opciones.">
<div align="center">Situaci&oacute;n Ocupacional </div></a></td>

<td width="17%" class="subtititulos"><a class="links-menu-izq" href="1_5agen_trab_educacion.php" title="Detalla los estudios realizados por el(la) trabajador(a) seleccionando el Nivel Académico, considera que los items destacados con * son obligatorios.">
<div align="center">Educaci&oacute;n</div></a></td>

<td width="22%" class="subtititulos"><a class="links-menu-izq" href="1_6agen_trab_capacitacion.php" title="Si el(la) trabajador(a) lo desea, puede detallar las Actividades de capacitación que posea, si no posee seleccione No y luego presiones el botón agregar.">
<div align="center">Capacitaci&oacute;n</div></a></td>

<td width="27%" height="16" class="subtititulos"><a class="links-menu-izq" href="1_7agen_trab_conocimientos.php" title="Ingresa los conocimientos de informática, Idiomas y Habilidades y destrezas que tenga el(la) Trabajador(a), detallando el nombre del mismo y su nivel.  Si no posee conocimientos de informática seleccione No maneja ninguna y luego presiones el botón agregar.">
<div align="center">Otros Conocimientos </div></a></td>
</tr>

<tr>
<td class="subtititulos"><a class="links-menu-izq" href="1_8agen_trab_experiencia.php" title="Ingresa la experiencia laboral que ha tenido el(la) Trabajador(a), si no posee seleccione No y luego presiones el botón agregar.">
<div align="center">Experiencia Laboral </div></a></td>


<td class="subtititulos"><a class="links-menu-izq" href="1_12agen_trab_foto.php">
<div align="center">Foto</div></a></td>

<td class="subtititulos"><a class="links-menu-izq" href="1_14agen_trab_formatos.php" title="Para imprimir el formato de Curriculum Vitae debe considerar que este cargada la información en los siguientes módulos: Datos Personales,
Situación Ocupacional, Educación, Capacitación, Otros conocimientos, Experiencia Laboral y opcionalmente el módulo de Foto.">
<div align="center">Formatos</div></a></td>

<td class="subtititulos"></td>
</tr>
</table>
<? }
if($_SESSION['tipo_usuario']==2){
?>
<table width="90%" border="1"  bordercolor="#003366" align="center" >

	  <? 
	   if (!isset($_SESSION['disc_bloq'])) { 
					$class_name1='links-menu-izq" href="1_3agen_trab_discapacidad.php" title="Detalla los datos de  la situaci&oacute;n de Discapacidad del(de la) Trabajador(a)';
		  	 }
	  else{
			 	$class_name1='links-menu-izq" title="M&oacute;dulo deshabilitado';
				}	
				
	   ?>
<tr>
<tH colspan="7" align="right" class="subtititulos">Perfil del Usuario: <? echo $_SESSION['afiliado'];?></tH>
</tr>

<tr>
<td width="15%" class="subtititulos"><a class="links-menu-izq" href="../mod_agencia_empleo/1_1agen_trab_datos.php#" title="El registro de trabajadores(as)  le permitirÃ¡ postularse a todas las bÃºsquedas de oportunidades de trabajo y capacitaciÃ³n disponibles en el sistema y, las entidades de trabajo que accedan a nuestra base de datos en busca de candidatos y candidatas podrÃ¡n consultarlo.">
<div align="center">Datos Personales </div></a></td>


<td width="17%" class="subtititulos"><a class="<?=$class_name1?>"><div align="center">Discapacidad </div></a></td>

<td width="17%" class="subtititulos"><a class="links-menu-izq" href="1_4agen_trab_ocupacion.php" title="Detalla la situación ocupacional actual del(de la) Trabajador(a); además las preferencias laborales o el área donde le gustaría trabajar, puede seleccionar 2 opciones.">
<div align="center">Situaci&oacute;n Ocupacional </div></a></td>

<td width="16%" class="subtititulos"><a class="links-menu-izq" href="1_5agen_trab_educacion.php" title="Detalla los estudios realizados por el(la) trabajador(a) seleccionando el Nivel Académico, considera que los items destacados con * son obligatorios.">
<div align="center">Educaci&oacute;n</div></a></td>

<td colspan="2" class="subtititulos"><a class="links-menu-izq" href="1_6agen_trab_capacitacion.php" title="Si el(la) trabajador(a) lo desea, puede detallar las Actividades de capacitación que posea, si no posee seleccione No y luego presiones el botón agregar.">
<div align="center">Capacitaci&oacute;n</div></a></td>
</tr>


<tr>
<td height="16" class="subtititulos"><a class="links-menu-izq" href="1_7agen_trab_conocimientos.php" title="Ingresa los conocimientos de informática, Idiomas y Habilidades y destrezas que tenga el(la) Trabajador(a), detallando el nombre del mismo y su nivel.  Si no posee conocimientos de informática seleccione No maneja ninguna y luego presiones el botón agregar.">
<div align="center">Otros Conocimientos </div></a></td>

<td class="subtititulos"><a class="links-menu-izq" href="1_8agen_trab_experiencia.php" title="Ingresa la experiencia laboral que ha tenido el(la) Trabajador(a), si no posee seleccione No y luego presiones el botón agregar.">
<div align="center">Experiencia Laboral </div></a></td>



<td width="8%" class="subtititulos"><a class="links-menu-izq" href="1_12agen_trab_foto.php">
<div align="center">Foto</div></a></td>

<td width="10%" class="subtititulos"><a class="links-menu-izq" href="1_14agen_trab_formatos.php" title="Para imprimir el formato de Curriculum Vitae debe considerar que este cargada la información en los siguientes módulos: Datos Personales,
Situación Ocupacional, Educación, Capacitación, Otros conocimientos, Experiencia Laboral y opcionalmente el módulo de Foto.">
<div align="center">Formatos</div></a></td>
</tr>

</table>
  <? } ?>