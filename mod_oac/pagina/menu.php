<?php
if((isset($_SESSION['nusuario']))){
	//echo $_SERVER['SCRIPT_FILENAME'];
?>
<div id="smoothmenu1" class="ddsmoothmenu">
	<ul>
		<li><a href="../mod_rnet/inicio.php">INICIO</a></li>
      <li><a href="#" >RNET</a>
      <ul>
        <li><a href="#" >CONSULTA</a>
          <ul>
            <li><a href="../mod_rnet/consulta_empresa.php">Consulta Registro Entidad de Trabajo con Nill</a></li>
            <li><a href="../mod_rnet/consulta_representante.php">Consulta Representante Legal</a></li>
          </ul>
        </li>
        <li><a href="#" >ACTUALIZACION</a>
          <ul>
            <li><a href="../mod_rnet/actualizacion_empresa.php">Actualizacion Registro Entidad de Trabajo</a></li>
            <li><a href="../mod_rnet/actualizacion_seniat.php">Actualizacion Datos Seniat</a></li>
          </ul>
        </li>
        <li><a href="#" >REPORTE</a>
          <ul>
<!--          <li><a href="../mod_rnet/reporte_global_nill.php">Reporte de Registro Entidad de Trabajo</a></li>
-->          <li><a href="../mod_rnet/consulta_cambios_reporte.php">Reporte de Actualizacion de la Entidad de Trabajo</a></li>  
          </ul>
        </li>
        </ul>
     </li>
    <li><a href="#" >SOLVENCIA</a>
   	 <ul>
        <li><a href="#" >REPORTE SOLVENCIA</a>
        <ul>
      	<li><a href="../mod_reporte_solvencia/consulta_total.php">Consulta Global</a></li>
				<li><a href="../mod_reporte_solvencia/consulta_certificados_revocados.php">Consulta Revocados</a></li>
        <li><a href="../mod_reporte_solvencia/consulta_certificados_solventes.php">Consulta Solventes</a></li>
         <li><a href="../mod_reporte_solvencia/verificar_formato_solvencia.php">Historicos de Formatos</a></li>
        </ul>
        </li>
     </ul>
   </li>
    <? if($_SESSION['nusuario']=="18142415" or $_SESSION['nusuario']=='11899943' or $_SESSION['nusuario']=='12275494'){?>
		<li><a href="#" >DESPACHO</a>
			<ul>
				<li><a href="../mod_despacho/consulta_despacho.php">Consulta de Entidades de Trabajo y Surcursales</a></li>
			</ul>
		</li>
    <? }?>
		<li><a href="#" >CONFIGURACION</a>
    	<ul>
				<li><a href="../mod_login/cambiar_clave.php">Cambiar Clave</a></li>
			</ul>
    </li>
		<li><a href="../mod_login/cerrar_sesion.php" >CERRAR SESION</a></li>
	</ul>
<br style="clear: left" />
</div>
<?php
}else{
?>
<div id="smoothmenu1" class="ddsmoothmenu">
	<ul>
		<li><a href="../mod_login/cerrar_sesion.php" >SALIR</a></li>
	</ul>
<br style="clear: left" />
</div>
<?php
}
?>
