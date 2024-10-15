<?php
if((isset($_SESSION['nusuario']))){
?>
<div  id="smoothmenu1" class="ddsmoothmenu">
	<ul>
		<li><a href="../mod_registro/inicio.php">INICIO</a></li>
      <li><a href="#" >CPT</a>
      <ul>
 <? if($_SESSION['ntipo']==3 or $_SESSION['ntipo']==4 or $_SESSION['ntipo']==5 or $_SESSION['ntipo']==6){?>        
            <li><a href="../mod_registro/registro_empresa.php">Registro Entidad de Trabajo</a></li>
            <li><a href="../mod_registro/consulta_region.php">Consulta</a>
          <ul>  
            <li><a href="../mod_registro/consulta_empresa.php">Consulta Entidad de Trabajo</a></li>
            
        <? }if($_SESSION['ntipo']==2 or $_SESSION['ntipo']==5 or $_SESSION['ntipo']==6){?>
        <li><a href="../mod_registro/consulta_region.php">Consulta por Region</a></li>
        <? }if($_SESSION['ntipo']==1 or $_SESSION['ntipo']==4 or $_SESSION['ntipo']==6){?>
        <li><a href="../mod_registro/consulta_global.php">Consulta Global</a></li>
</ul>
        <? }?>
        </ul>
        </li>
        </li>
				<li><a href="#" >REPORTE</a>
          <ul>
           <? if($_SESSION['ntipo']==1 or $_SESSION['ntipo']==3 or $_SESSION['ntipo']==4 or $_SESSION['ntipo']==5  or $_SESSION['ntipo']==6 ){?>
            <li><a href="../mod_registro/reporte_empresa_estado.php">Empresa por Estado</a></li>
           <? } if($_SESSION['ntipo']==1 or $_SESSION['ntipo']==4 or $_SESSION['ntipo']==6 ){?>
  
            <li><a href="../mod_registro/reporte_estadistico.php">Estadistica Preliminares</a></li>
           	<? }if($_SESSION['ntipo']==1 or $_SESSION['ntipo']==3 or $_SESSION['ntipo']==4 or $_SESSION['ntipo']==5  or $_SESSION['ntipo']==6 ){?>
            <li><a href="../mod_registro/reporte_miembros.php">Miembros Del Nucleo de Trabajadores por Empresa</a></li>
            <? }?> 
            <li><a href="../mod_registro/consulta_excel.php">Archivo en Excel</a></li>
          </ul>
        </li>	
        <? if($_SESSION['ntipo']==4){?>
<li><a href="#" >ADMINISTRADOR</a>
          <ul>
            <li><a href="../mod_registro/adminsitrar_rif.php">Registro de Rif</a></li>
            <li><a href="../mod_registro/adminsitrar_usuario.php">Registro de Usuario</a></li>
            <li><a href="../mod_registro/consulta_region.php">Cat&agrave;logos</a>
              <ul>
                <li><a href="../mod_registro/registro_productividad.php?valor=1">Medida</a></li>
                <li><a href="../mod_registro/registro_productividad.php?valor=2">Motor</a></li>
                <li><a href="../mod_registro/registro_productividad.php?valor=3">Productos</a></li>
                <li><a href="../mod_registro/registro_productividad.php?valor=4">Sector</a></li>
              </ul>
            </li>
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
