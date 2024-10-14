<?php
ini_set("display_errors",0);
error_reporting(E_ALL | E_STRICT);

//-------------------------------------------------------------
include('../include/header.php');
/*include("general_LoadCombo.php"); 
include("../LoadCombos.php");
include('1_Validador.php');*/
$conn= getConnDB($db1);
$conn->debug = false;

//-------------------------------------------------------------
$aDefaultForm = array();
$aPageErrors = array();
$ids_elementos_validar= array();

include("../evita_injection.php");
include("verificar_correo.php");
doAction($conn);
showHeader();
showForm($conn, $aDefaultForm);
function doAction($conn)
{
    if (isset($_POST['action']))
	{
        echo('Esta seteado action');
    }
	else
	{
		LoadData($conn,false);
	}//Fin del isset();
}//Fin de la Función
function LoadData($conn,$bPostBack)
{
	if (count($GLOBALS['aDefaultForm']) == 0)
	{
		$aDefaultForm = &$GLOBALS['aDefaultForm'];
		//datos personales Chequear con el Formulario de Roberto//
		$aDefaultForm['ced_afiliado']='';

		//$aDefaultForm['nacionalidad_afiliado']='';
		$aDefaultForm['nombre_afiliado1']='';
		$aDefaultForm['nombre_afiliado2']='';
		$aDefaultForm['apellido_afiliado1']='';
		$aDefaultForm['apellido_afiliado2']='';
		$aDefaultForm['cbCed_afiliado']='';
		$aDefaultForm['cbSexo_afiliado']='-1';
		$aDefaultForm['fnacimiento_afiliado']='';

		//$aDefaultForm['codigo1']='';

		$aDefaultForm['telefono_afiliado']='';

		//$aDefaultForm['codigo2']='';
		//$aDefaultForm['telefono2']='';

		$aDefaultForm['email_afiliado1']='';
		$aDefaultForm['email_afiliado2']='';

		if (!$bPostBack)
		{
			/*AQUI SI TRAE DE BASE DE DATOS*/
		}
		else
		{
            /*
			$aDefaultForm['ced_afiliad']=$_POST['ced_afiliad'];
			$aDefaultForm['nacionalidad_afiliado']=$_POST['nacionalidad_afiliado'];
			$aDefaultForm['nombre_afiliado1']=$_POST['nombre_afiliado1'];
			$aDefaultForm['nombre_afiliado2']=$_POST['nombre_afiliado2'];
			$aDefaultForm['apellido_afiliado1']=$_POST['apellido_afiliado1'];
			$aDefaultForm['apellido_afiliado2']=$_POST['apellido_afiliado2'];
			$aDefaultForm['cbCed_afiliado']=$_POST['cbCed_afiliado'];
			$aDefaultForm['ced_afiliado']=$_POST['ced_afiliado'];
			$aDefaultForm['cbSexo_afiliado']=$_POST['cbSexo_afiliado'];
			$aDefaultForm['fnacimiento_afiliado']=$_POST['fnacimiento_afiliado']; 
			$aDefaultForm['codigo1']=$_POST['codigo1'];
			$aDefaultForm['telefono1']=$_POST['telefono1'];
			$aDefaultForm['codigo2']=$_POST['codigo2'];
			$aDefaultForm['telefono2']=$_POST['telefono2'];
			$aDefaultForm['email_afiliado1']=$_POST['telefono_afiliado1'];
			$aDefaultForm['email_afiliado']=$_POST['telefono_afiliado'];
			$aDefaultForm['email_afiliado2']=$_POST['telefono_afiliado2'];
			$aDefaultForm['email_afiliado21']=$_POST['telefono_afiliado21'];
            */
		}
	}
}
//funcion que dibuja el encabezado de la pagina 
function showHeader()
{
	include('../header.php'); 
} 
function showForm($conn,$aDefaultForm)
{
?>
<!-- Aqui va el Formulario de Registro de Roberto -->
<body>
    <main>
        <div class="contenedor_todo">
            <div class="caja_trasera">
                <div class="caja_trasera-login">
                    <h3>¿Ya tienes una cuenta?</h3>
                    <p>Inicia sesión para entrar en la página</p>
                    <button id="btn_iniciar-sesion">Iniciar Sesión</button>
                    <a href="../mod_login/olvido_clave.php"><button >Olvido su contraseña</button></a>
                </div>
                <div class="caja_trasera-register">
                    <h3>¿Aún no tienes una cuenta?</h3>
                    <p>Regístrate para que puedas iniciar sesión</p>
                    <!--button id="btn_registrarse">Regístrarse</button-->
                    <button id="btn_autenticarse">Autenticarse</button>                    
                </div>
                <div class="contenedor_login-register">
                <form action="" method="POST" class="form_trabajador">
                    <h2>Registrarse</h2>
                    <center>
                        <label> Datos Personales Obligatorios (*) </label><br>
                        <select style="width: 20%;"  name="cbCed_afiliado"  id="cbCed_afiliado">
                            <!-- <option value=""></option> -->
                            <option value="V">V</option>
                            <option value="E">E</option>
                        </select>	
                        <input type="text" style="width: 79%;" placeholder="Cédula de Identidad" id="ced_afiliado"  name="ced_afiliado" onBlur="consultar_saime(cbCed_afiliado.value+'|'+ced_afiliado.value);"  min="3000000" max="50000000">
                        <input type="hidden" id="ced_afiliado2" name="ced_afiliado2">

                        <input style="width:49%;margin-bottom:-10px;" type="text" placeholder="Primer Nombre*" name="nombre_afiliado1" id="nombre_afiliado1">
                        <input style="width:49%;margin-bottom:-10px;" type="text" placeholder="Segundo Nombre" name="nombre_afiliado2" id="nombre_afiliado2">
                    </center>
                </form>
                </div>                
            </div>
        </div>
    </main>
    <!-- Script's -->
    <script src="../js/main_register.js"></script>

    <script type="text/javascript" src="../js/jquery.js"></script>
<!--     <script type="text/javascript" src="../js/validacion_general.js"></script>	
    <script type="text/javascript" src="validar_login.js"></script>	
    <script type="text/javascript" src="funciones.js"></script>	
    <script type="text/javascript" src="base64.js"></script>     -->

    <script type="text/javascript" src="../mod_registro/funciones_registro.js"></script>
    <script type="text/javascript" src="../mod_registro/validar_trabajador_registro.js"></script>
    
    <script>
        function send(saction)
        {
            if(saction=='Guardar')
            {
                if(validar_frm_trabajador()==true)
                {
                    alert('todo ok');
                    //var form = document.frm_trabajador;
                    //form.action.value=saction;
                    //form.submit();	
                }
                else
                {
                    location.assign('10.46.1.91/silpd/mod_registro/register.php');
                }
            }
            else
            {
                var form = document.frm_trabajador;
                form.action.value=saction;
                form.submit();
            }
        }
    </script>
</body>
</html>
<?php
}
?>