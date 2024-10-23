<?  if($_SESSION['tipo_usuario']==1){ ?>
<!--
<table width="100%" border="1" bordercolor="#000033" align="center" >
<tr>
<td width="16%" class="subtititulos"><a class="links-menu-izq" href="?menu=11" title="El registro de trabajadores(as)  le permitirÃ¡ postularse a todas las bÃºsquedas de oportunidades de trabajo y capacitaciÃ³n disponibles en el sistema y, las entidades de trabajo que accedan a nuestra base de datos en busca de candidatos y candidatas podrÃ¡n consultarlo.">
<div align="center">Datos Personales </div></a></td>

<td width="18%" class="subtititulos"><a class="links-menu-izq" href="?menu=14" title="Detalla la Situación Ocupacional actual del(de la) Trabajador(a); además las preferencias laborales o el área donde le gustaría trabajar, puede seleccionar 2 opciones.">
<div align="center">Situaci&oacute;n Ocupacional </div></a></td>

<td width="17%" class="subtititulos"><a class="links-menu-izq" href="?menu=15" title="Detalla los estudios realizados por el(la) trabajador(a) seleccionando el Nivel Académico, considera que los items destacados con * son obligatorios.">
<div align="center">Educaci&oacute;n</div></a></td>

<td width="22%" class="subtititulos"><a class="links-menu-izq" href="?menu=16" title="Si el(la) trabajador(a) lo desea, puede detallar las Actividades de capacitación que posea, si no posee seleccione No y luego presiones el botón agregar.">
<div align="center">Capacitaci&oacute;n</div></a></td>

<td width="27%" height="16" class="subtititulos"><a class="links-menu-izq" href="?menu=17" title="Ingresa los conocimientos de informática, Idiomas y Habilidades y destrezas que tenga el(la) Trabajador(a), detallando el nombre del mismo y su nivel.  Si no posee conocimientos de informática seleccione No maneja ninguna y luego presiones el botón agregar.">
<div align="center">Otros Conocimientos </div></a></td>
</tr>

<tr>
<td class="subtititulos"><a class="links-menu-izq" href="?menu=18" title="Ingresa la experiencia laboral que ha tenido el(la) Trabajador(a), si no posee seleccione No y luego presiones el botón agregar.">
<div align="center">Experiencia Laboral </div></a></td>
<!--
<td class="subtititulos"><a class="links-menu-izq" href="1_10agen_trab_participacion.php" title="Detalla si el(la) Trabajador(a) ha participado en Consejos comunales, Comunas o alguna otra actividad Comunitaria,">
<div align="center">Participaci&oacute;n Social </div></a></td>-->
<!--
<td class="subtititulos"><a class="links-menu-izq" href="?menu=19">
<div align="center">Foto</div></a></td>

<td class="subtititulos"><a class="links-menu-izq" href="?menu=20" title="Para imprimir el formato de Curriculum Vitae debe considerar que este cargada la información en los siguientes módulos: Datos Personales,
Situación Ocupacional, Educación, Capacitación, Otros conocimientos, Experiencia Laboral y opcionalmente el módulo de Foto.">
<div align="center">Formatos</div></a></td>

<td class="subtititulos"></td>
</tr>
</table>-->
<? }
if($_SESSION['tipo_usuario']==2){
?>
<!--<table width="90%" border="1" bordercolor="#000033" >
-->
	  <? 
	
/*
	   if (!isset($_SESSION['disc_bloq'])) { 
					$class_name1='links-menu-izq" href="?menu=13" title="Detalla los datos de  la situaci&oacute;n de Discapacidad del(de la) Trabajador(a)';
		  	 }
	  else{
			 	$class_name1='links-menu-izq" title="M&oacute;dulo deshabilitado. Regisrtro no poseer discapacidad en Datos Personales';
				}	*/
				
	   ?>
<!--
<tr>
<tH colspan="7" align="right" class="subtititulos">Trabajador: <? echo $_SESSION['afiliado'];?></tH>
</tr>

<tr>
<td width="15%" class="subtititulos"><a class="links-menu-izq" href="?menu=11" title="El registro de trabajadores(as)  le permitirÃ¡ postularse a todas las bÃºsquedas de oportunidades de trabajo y capacitaciÃ³n disponibles en el sistema y, las entidades de trabajo que accedan a nuestra base de datos en busca de candidatos y candidatas podrÃ¡n consultarlo.">
<div align="center">Datos Personales </div></a></td>

<td width="15%" class="subtititulos"><a class="links-menu-izq" href="?menu=10" title="El registro de trabajadores(as)  le permitirÃ¡ registrar Datos de Inter&eacute;s personal.">
<div align="center">Datos de Inter&eacute;s </div></a></td>

<td width="13%" class="subtititulos"><a class="<?=$class_name1?>"><div align="center">Discapacidad </div></a></td>



<td width="17%" class="subtititulos"><a class="links-menu-izq" href="?menu=14" title="Detalla la situación ocupacional actual del(de la) Trabajador(a); además las preferencias laborales o el área donde le gustaría trabajar, puede seleccionar 2 opciones.">
<div align="center">Situaci&oacute;n Ocupacional </div></a></td>

<td width="12%" class="subtititulos"><a class="links-menu-izq" href="?menu=15" title="Detalla los estudios realizados por el(la) trabajador(a) seleccionando el Nivel Académico, considera que los items destacados con * son obligatorios.">
<div align="center">Educaci&oacute;n</div></a></td>

<td colspan="2" class="subtititulos"><a class="links-menu-izq" href="?menu=16" title="Si el(la) trabajador(a) lo desea, puede detallar las Actividades de capacitación que posea, si no posee seleccione No y luego presiones el botón agregar.">
<div align="center">Capacitaci&oacute;n</div></a></td>
</tr>


<tr>
<td height="16" class="subtititulos"><a class="links-menu-izq" href="?menu=17" title="Ingresa los conocimientos de informática, Idiomas y Habilidades y destrezas que tenga el(la) Trabajador(a), detallando el nombre del mismo y su nivel.  Si no posee conocimientos de informática seleccione No maneja ninguna y luego presiones el botón agregar.">
<div align="center">Otros Conocimientos </div></a></td>

<td class="subtititulos"><a class="links-menu-izq" href="?menu=18" title="Ingresa la experiencia laboral que ha tenido el(la) Trabajador(a), si no posee seleccione No y luego presiones el botón agregar.">
<div align="center">Experiencia Laboral </div></a></td>

<!--<td class="subtititulos"><a class="links-menu-izq" href="1_10agen_trab_participacion.php" title="Detalla si el(la) Trabajador(a) ha participado en Consejos comunales, Comunas o alguna otra actividad Comunitaria.">
<div align="center">Participaci&oacute;n Social </div></a></td>-->

<!--<td class="subtititulos"><a class="links-menu-izq" href="1_11agen_trab_pdpie.php" title="Detalla si el(la) Trabajador(a) solicita Presataci&oacute;n por pérdida involuntaria de empleo">
<div align="center">PPIE </div></a></td>-->

<!--<td class="subtititulos"><a class="links-menu-izq" href="1_15agen_trab_prevision_social.php">
<div align="center">Previsi&oacute;n Social </div></a></td>-->
<!--
<td width="8%" class="subtititulos"><a class="links-menu-izq" href="?menu=19">
<div align="center">Foto</div></a></td>

<td width="8%" class="subtititulos"><a class="links-menu-izq" href="?menu=20" title="Para imprimir el formato de Curriculum Vitae debe considerar que este cargada la información en los siguientes módulos: Datos Personales,
Situación Ocupacional, Educación, Capacitación, Otros conocimientos, Experiencia Laboral y opcionalmente el módulo de Foto.">
<div align="center">Formato</div></a></td>
</tr>

</table>-->
  <? } ?>