<?php
if((isset($_SESSION['nusuario']))){
?>
<!--   
El elemento li representa a un ítem en una lista, ya sea ordenada (elemento ol ) o no ordenada (elemento ul ). En la especificación de HTML 5, el atributo value de este elemento está permitido únicamente en listas ordenadas ( ol ). Su uso en listas no ordenadas ( ul ) es inválido.

<ul>
	<li>Elemento de lista</li>
	<li>Elemento de lista</li>
	<li> … </li>
</ul>

<p>Lista con sublistas anidadas</p>
<ul>
    <li>Primero</li>
    <li>Segundo
        <ul>
            <li>Segundo Uno</li>
            <li>Segundo Dos</li>
        </ul>
    </li>
    <li>Tercero</li>
</ul>

ntipo 3 responsable estadal  
       ntipo 4 responsable administrador del sistema
       ntipo 5 responsable regional
       ntipo 6 responsable nacional
       -->
       
<div  id="smoothmenu1" class="ddsmoothmenu">
<ul>
    <li><a href="../mod_registro/inicio.php"><span  style="font-weight:bold; color:#47586d;" >INICIO</span></a></li>
    <li><a href="#" ><span  style="font-weight:bold; color:#47586d;" >CPT</span></a>
    <ul>

  <? if($_SESSION['ntipo']==3 or $_SESSION['ntipo']==4 or $_SESSION['ntipo']==6){?>   
        <li><a href="../mod_registro/registro_empresa.php"><span  style="font-weight:bold; color:#0b4691;" >Registro Entidad de Trabajo</span></a></li>
        <li><a href="../mod_registro/consulta_region.php"><span  style="font-weight:bold; color:#0b4691;" >Consulta</span></a>
               
        <ul>  
           <li><a href="../mod_registro/consulta_empresa.php"><span  style="font-weight:bold; color:#0b4691;" >Consulta Entidades de Trabajo</span></a></li>
          <? }if($_SESSION['ntipo']==2 or $_SESSION['ntipo']==5 or $_SESSION['ntipo']==4){?>
          <li><a href="../mod_registro/consulta_region.php"><span  style="font-weight:bold; color:#0b4691;" >Consulta por Regi&oacute;n</span></a></li>
          <? }if($_SESSION['ntipo']==1 or $_SESSION['ntipo']==4 or $_SESSION['ntipo']==6){?>
          <li><a href="../mod_registro/consulta_global.php"><span  style="font-weight:bold; color:#0b4691;" >Consulta Global de Entidades de Trabajo</span></a></li> 
           <? }?>
        </ul>
        
    </ul>
       </li>     
  </li>
	
    
      <li><a href="#" ><span  style="font-weight:bold; color:#47586d;" >REPORTE</span></a>
       <ul>   
           
        <? if($_SESSION['ntipo']==1 or $_SESSION['ntipo']==3 or $_SESSION['ntipo']==4 or $_SESSION['ntipo']==5 or $_SESSION['ntipo']==6 ){?>      
            <li><a href="../mod_registro/reporte_empresa_estado.php"><span  style="font-weight:bold; color:#0b4691;" >Entidades de Trabajo por Estado</span></a></li>
       
       <? } if($_SESSION['ntipo']==1 or $_SESSION['ntipo']==4 or $_SESSION['ntipo']==6 ){?>  
          <li><a href="../mod_registro/reporte_estadistico.php"><span  style="font-weight:bold; color:#0b4691;" >Estadistica Preliminares</span></a></li>
            
       <? }if($_SESSION['ntipo']==1 or $_SESSION['ntipo']==3 or $_SESSION['ntipo']==4 or $_SESSION['ntipo']==5  or $_SESSION['ntipo']==6 ){?>
            <li><a href="../mod_registro/reporte_miembros.php"><span  style="font-weight:bold; color:#0b4691;" >Integrantes del CPT</span></a></li>
            
       <? }?> 
            <li><a href="../mod_registro/consulta_excel.php"><span  style="font-weight:bold; color:#0b4691;" >Archivo en Excel</span></a></li>
       </ul>
      </li>	
        
        <? if($_SESSION['ntipo']==4){?>
      <li><a href="#" ><span  style="font-weight:bold; color:#47586d;" >ADMINISTRADOR</span></a>
          <ul>
            <li><a href="../mod_registro/adminsitrar_rif.php"><span  style="font-weight:bold; color:#0b4691;" >Registro de Rif</span></a></li>
            <li><a href="../mod_registro/adminsitrar_usuario.php"><span  style="font-weight:bold; color:#0b4691;" >Registro de Usuario</span></a></li>
            <li><a href="#" ><span  style="font-weight:bold; color:#0b4691;" >Cat&agrave;logos</span></a>
              <ul>          
                <li><a href="../mod_registro/registro_productividad.php?valor=1"><span  style="font-weight:bold; color:#0b4691;" >Motor</span></a></li>
                <li><a href="../mod_registro/registro_productividad.php?valor=2"><span  style="font-weight:bold; color:#0b4691;" >Productos</span></a></li>
                <li><a href="../mod_registro/registro_productividad.php?valor=3"><span  style="font-weight:bold; color:#0b4691;" >Sector</span></a></li>
                <li><a href="../mod_registro/registro_productividad.php?valor=4"><span  style="font-weight:bold; color:#0b4691;" >Unidad de Medida</span></a></li>
              </ul>
            </li>
          </ul>
      </li>	 	 
        <? }?> 
        
        
        
    <li><a href="#" ><span  style="font-weight:bold; color:#47586d;" >CONFIGURACION</span></a>
       <ul>
            <li><a href="../mod_login/cambiar_clave.php"><span  style="font-weight:bold; color:#0b4691;" >Cambiar Clave</span></a></li>
       </ul>
   </li>
     
     <li><a href="#" ><span  style="font-weight:bold; color:#47586d;" >AYUDA</span></a>
        <ul>
		    <li><a href="../manual_adm.pdf"><span  style="font-weight:bold; color:#0b4691;" >Manual de Usuario</span></a></li>
		</ul>
     </li>
     
     
	   <li><a href="../mod_login/cerrar_sesion.php" ><span  style="font-weight:bold; color:#47586d;" >CERRAR SESION</span></a></li>
</ul>
<br style="clear: left" />

</div>
<?php
}else{
?>
<div id="smoothmenu1" class="ddsmoothmenu">
	<ul>
		<li><a href="../mod_login/cerrar_sesion.php" ><span  style="font-weight:bold; color:#0b4691;" >SALIR</span></a></li>
	</ul>
<br style="clear: left" />
</div>
<?php
}
?>
