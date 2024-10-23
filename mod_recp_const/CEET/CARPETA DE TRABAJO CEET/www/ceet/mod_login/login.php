<?php 
$login = 1;
include("../header_login.php");
//include_once('login_Controlador.php');
//var_dump($_SESSION);
?>

<script>

</script>

 	<div class="container">
        <div class="card card-container">
		<img style="margin: 0 auto 10px; display: block" src="../imagenes/encabezado.png" class="img-responsive" />
            <img id="profile-img" class="profile-img-card" src="../imagenes/avatar.png" />
            <!--<p id="profile-name" class="profile-name-card"></p>-->
				<form id="comprobacion" name="comprobacion" method="POST" action="<?=$_SERVER['PHP_SELF'];?>" role="login" >
				<script type="text/javascript" src="validar_login.js"></script>
                <script type="text/javascript" src="funciones.js"></script>
				<script type="text/javascript" src="base64.js"></script>
				<input name="action" type="hidden" value=""/>
                
    <table width="100%" border="0" class="formulario">
        <tr>
            <td>
                <div align="center"><span id="mensaje_usuario"></span></div>
            </td>
        </tr>
                <tr>
       		<td>
       		<div align="center"><font color="#0066CC" size="5">Bienvenidos!</font></div></td>
            </tr>
        
        <tr>
       		<td>
       		<div align="center"><font color="#0066CC" size="4">Centros de Encuentro para la </font></div></td>
            </tr>
            <tr>
       		<td>
       		<div align="center"><font color="#0066CC" size="4">Educación y el Trabajo</font></div></td>
              </tr>
            <tr>
            <td>
       		<div align="center"><font color="#0066CC" size="4">(CEET)</font></div></td>
        </tr>
       <tr>
         <td>&nbsp;</td>		
      </tr>
             <tr>
         <td>&nbsp;</td>		
      </tr>
 
<!--        <tr>
       		<td bgcolor="F0F0F0"><div align="center">Iniciar sesi&oacute;n</div></td>
        </tr>-->
	</table>
	<div class="form-group">
    <table width="100%" border="0">
        <tr>
            <td width="15%">
                <select class="form-control" id="nnacionalidad" name="nnacionalidad">
                    <option value="1">V-.</option>
                    <option value="2">E-.</option>
                </select>
            </td>
            <td width="85%">
                <input type="text" class="form-control" id="txt_usuario" name="txt_usuario" maxlength="10" size="28" onkeypress="return permite(event, 'num')" placeholder="C&eacute;dula de Identidad" required>
            </td>
        </tr>
     </table>
	</div>
    
    <div class="form-group">
      <input type="password" class="form-control" id="txt_clave" name="txt_clave" size="33" placeholder="Contrase&ntilde;a" required>
    </div>
					
    <div class="form-group">
        <table width="100%" border="0">
            <tr>
                <td align="center">
                    <div align="center" ><img src="captcha/captcha.php"/></div>
                </td>
            </tr>
        </table>
    </div>
						
    <div class="form-group">
        <table width="100%" border="0">
            <tr>
                <td align="center">
                    <input type="text" class="input_captcha" id="txt_captcha" name="txt_captcha" value=""  maxlength="7" size="13"  placeholder="C&oacute;d. Verificaci&oacute;n" required/>
                </td>
            </tr> 
        </table>
    </div>

        <div class="form-group">
            <button type="button" class="button_personal btn_entrar" onclick="javascript:send(1);" title="Haga Click para Ingresar">Ingresar</button>
            <button type="button" class="button_personal btn_limpiar" onclick="javascript:limpiar();" title="">Limpiar</button> 
        </div>


<hr  color="#0033CC" size="10" width="100%"/>
        
       <div class="form-group">
           <a href="../mod_registro/registro.php">Registrarse</a> &nbsp;<a href="registro_olvido_contrasena.php">&iquest;Olvido su Contrase&ntilde;a?</a>     
        </div>       
				
<hr  color="#0033CC" size="10" width="100%"/>                
		</form>
    <div class="form-group">
        <table width="100%" border="0">
       <tr>
       		<td> <p align="center"><font color="#0066CC">Para hacer uso del sistema, debe utilizar e</font><font color="#0066CC" size="3">l navegador</font></div></td>
        </tr> 
                <tr>
       		<td> <p align="center"><font color="#0066CC">Mozilla Firefox.<img src="../imagenes/firefox.png" width="22" height="22"  alt=""/></font></div></td>
        </tr> 
            <!--    <tr>
       	<td><font color="#0066CC" size="2"><div align="center"><a href="../mod_recp_const/Instructivo_SIGLA.pdf">Manual de Usuario</a> <img src="../imagenes/libro.png" width="20" height="20"  alt=""/></div></font></td>
        </tr>-->
        </table>
    </div>
            
        </div>	

<?php include("../footer_login.php"); ?>