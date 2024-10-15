<?php
$i =0;
?>	
<li>
				<a href=<? if ($i == 0){?> "../../index.php" <? }else{?> "#" <? }?> onclick=""><?=$valor_opcion?></a>
</li>
<?php



	//SI ES REPRESENTANTE LEGAL SE LE PERMITE MODIFICAR
	
	//if($_SESSION['tipo_usuario']==1 or $_SESSION['tipo_usuario']==2){
	
	//if($_SESSION['tipo_usuario']==1){
?>	
     <!-- <div id="smoothmenu1" class="ddsmoothmenu">
        <ul>
          <li><a href="../mod_agencia_empleo/1_1agen_trab_datos.php">INICIO</a></li>
          <li><a href="#" >CONFIGURACION</a>
            <ul>
              <li><a href="../mod_login/cambiar_clave.php">CAMBIAR CONTRASEÑA</a></li>
            </ul>
           </li> 
          </ul>  
            <ul>
              <li><a href="../mod_login/cerrar_sesion.php" >SALIR</a></li>
            </ul>
            
            
      <br style="clear: left" />
      </div>
	<?php 
	//}
	//if($_SESSION['tipo_usuario']==2){ ?>
    <div id="smoothmenu1" class="ddsmoothmenu">
      <ul>
      <li><a href="../mod_agencia_empleo/inicio.php">INICIO</a></li>
      <li><a href="#" >TRABAJADORES</a>
          <ul>
          	<li><a href="../mod_registro_interno/registro.php">REGISTRO TRABAJADOR</a></li>
            <li><a href="../mod_agencia_empleo/1_13agen_consulta_trabajador.php">CONSULTA TRABAJADOR</a></li>
          </ul>
        </li>
      <li><a href="#" >ENTIDADES DE TRABAJO</a>
          <ul>
            <li><a href="../mod_agencia_empleo/2_0agen_registro_empresa.php">REGISTRO ENTIDAD DE TRABAJO</a></li>
            <li><a href="../mod_agencia_empleo/2_5agen_consulta_empresa.php">CONSULTA DE ENTIDADES DE TRABAJO</a></li>
          </ul>
      </li>
       <li><a href="#" >OPORTUNIDADES DE EMPLEO</a>
          <ul>
            <li><a href="../mod_agencia_empleo/3_0agen_registro_oferta.php">REGISTRO OPORTUNIDADES DE EMPLEO</a></li>
            <li><a href="../mod_agencia_empleo/3_4agen_consulta_oferta_empleo.php">CONSULTA OPORTUNIDADES DE EMPLEO</a></li>
          </ul>
        </li>
        <li><a href="#" >OPORTUNIDADES DE CAPACITACION</a>
          <ul>
            <li><a href="../mod_agencia_empleo/4_0agen_registro_capacitacion.php">REGISTRO OPORTUNIDADES DE CAPACITACION</a></li>
            <li><a href="../mod_agencia_empleo/4_3agen_consulta_oferta_capacitacion.php">CONSULTA OPORTUNIDADES DE CAPACITACION</a></li>
          </ul>
        </li>
      </ul>
      
      <ul>
      	<li><a href="../mod_login/cerrar_sesion.php" >SALIR</a></li>
      </ul>
      
    <br style="clear: left" />
    </div>-->
    
<?php
// }
//} else { ?> 
<!--    <div id="smoothmenu1" class="ddsmoothmenu">
      <ul>
      	<li><a href="../mod_login/cerrar_sesion.php" >SALIR</a></li>
      </ul>
    <br style="clear: left" />
    </div>-->
<? // } ?>