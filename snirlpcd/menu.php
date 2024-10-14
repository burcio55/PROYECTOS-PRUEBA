
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
<?
//var_dump($_SESSION);
if(!isset($_SESSION['nusuario']) or $_SESSION['vista'] == 1){
	
?>
<title>SILPD</title>
	
     <div id="smoothmenu1" class="ddsmoothmenu">
        <!--<ul>
          <li><a href="../mod_ceet/inicio.php"><span  style="font-weight:bold; color:#FFFFFF;" >INICIO</span></a></li> 
        </ul>-->

       <ul>
          <li><a href="../mod_login/cerrar_sesion.php" ><span  style="font-weight:bold; color:#FFFFFF;" >SALIR</span></a></li>
       </ul>
            
            
      <br style="clear: left" />
      </div>
	<?php 
	} else{
		if( $_SESSION['vista'] == 2){
	?>      
<div id="smoothmenu1" class="ddsmoothmenu" >
<ul>

    <li ><a href="../mod_registro/inicio.php"><span  style="font-weight:bold; color:#47586d;" >INICIO</span></a></li>  
       <li><a href="#" ><span  style="font-weight:bold; color:#47586d;" >SILPD</span></a>
    <ul>
	
    
        <li><a href="../mod_silpd/1_1agen_trab_datos.php"><span  style="font-weight:bold; color:#0b4691;" >Datos Personales</span></a></li>   
		<li><a href="../mod_silpd/1_3agen_trab_discapacidad.php"><span  style="font-weight:bold; color:#0b4691;" >Discapacidad</span></a></li>   
		<li><a href="../mod_silpd/1_5agen_trab_educacion.php"><span  style="font-weight:bold; color:#0b4691;" >Educaci&oacute;n</span></a></li> 
		<li><a href="../mod_silpd/1_4agen_trab_ocupacion.php"><span  style="font-weight:bold; color:#0b4691;" >Situaci&oacute;n Ocupacional</span></a></li>
		<li><a href="../mod_silpd/1_8agen_trab_experiencia.php"><span  style="font-weight:bold; color:#0b4691;" >Experiencia Laboral</span></a></li>  
		<li><a href="../mod_silpd/1_12agen_trab_foto.php"><span  style="font-weight:bold; color:#0b4691;" >Foto</span></a></li>  
		<li><a href="../mod_silpd/1_14agen_trab_formatos.php"><span  style="font-weight:bold; color:#0b4691;" >Formatos</span></a></li> 
	</ul>	
		</li> 
			
        <li><a href="#"><span  style="font-weight:bold; color:#47586d;" >OPORTUNIDAD DE TRABAJO</span></a></li>     
        <li><a href="#"><span  style="font-weight:bold; color:#47586d;" >CONFIGURACI&Oacute;N</span></a>       
		<ul>
            <li><a href="../mod_login/cambiar_clave.php"><span  style="font-weight:bold; color:#0b4691;" >Cambiar Clave</span></a></li>
       </ul>
   </li>
        <li><a href="#"><span  style="font-weight:bold; color:#47586d;" >AYUDA</span></a></li> 

	  <li><a href="../mod_login/cerrar_sesion.php" ><span  style="font-weight:bold; color:#47586d;" >CERRAR SESION </span></a></li>
 <li><a href="#"><span  style="font-weight:bold; color:#000;"  > &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  &nbsp;&nbsp;&nbsp;&nbsp;</span></a></li> 
    
</ul>

<br style="clear: left" />

</div>

<? }
}?>
