<?php 
	require_once('conexion.php');
	require_once('usuario.php');
	//require_once()
$conn= getConnDB($db1,$db2);
$conn->debug = false; 

	 class CrudUsuario extends Usuario{

		public function __construct(){}

		//inserta los datos del usuario
		/*public function insertar($usuario){
			

		}*/

		//obtiene el usuario para el login
		public function obtenerUsuario($nac,$doc,$clave){
			
			
   
        /*  $_REQUEST['nac']=base64_decode($_REQUEST['nac']);
             $_REQUEST['doc']=base64_decode($_REQUEST['doc']);
             $_REQUEST['clave']=base64_decode($_REQUEST['clave']);
             //$_REQUEST['rif']=base64_decode($_REQUEST['rif']);
        



       if(isset($_REQUEST['nac'])){
               $nac=str_replace("'","",$_REQUEST['nac']);
               $nac=str_replace(",","",$nac);
               $nac=str_replace("INSERT","",$nac);
               $nac=str_replace("UNION","",$nac);
               $nac=str_replace("SELECT","",$nac);
               $nac=str_replace("UPDATE","",$nac);
               $nac=str_replace("AND","",$nac);
               $nac=str_replace("IF","",$nac);
               $nac=str_replace(";","",$nac);
               $nac=htmlentities(strtoupper(trim($nac)));
        }

        if(isset($_REQUEST['doc'])){
          $doc=str_replace("'","",$_REQUEST['doc']);
          $doc=str_replace(",","",$doc);
          $doc=str_replace("INSERT","",$doc);
          $doc=str_replace("UNION","",$doc);
          $doc=str_replace("SELECT","",$doc);
          $doc=str_replace("UPDATE","",$doc);
          $doc=str_replace("AND","",$doc);
          $doc=str_replace("IF","",$doc);
          $doc=str_replace(";","",$doc);
          $doc=htmlentities(strtoupper(trim($doc)));
   }

       if(isset($_REQUEST['clave'])){
          $clave=str_replace("'","",$_REQUEST['clave']);
          $clave=str_replace(",","",$clave);
          $clave=str_replace("-","",$clave);
          $clave=htmlentities((trim($clave)));
    }*/
      
     echo"$SQL=  "SELECT 
             id,cedula,nombres,apellidos,nacionalidad,tipo_usuario
            FROM personas
            WHERE cedula='".$nac.$doc."'
            AND clave='".md5($clave)."' 
            AND status='A'
            LIMIT 1 ";";
	  global  $conn;
       $rs=$conn->Execute($SQL);
	
			
			
   //   echo "Estoy dentro de la conexion: ".$rs;
       $registro=$rs->RecordCount();
		//	echo $registro;
       if($registro>0){	
       /* $usuario=new Usuario();
	      $usuario->setId($rs->fields['id']);
	      $usuario->setDoc($rs->fields['doc']);
	       $usuario->setNombre($rs->fields['nombres']);
	       $usuario->setApellido($rs->fields['apellidos']);
	       $usuario->setTipoUsuario($rs->fields['tipo_usuario']);
       */
		$valores_usuario=array();
		$valores_usuario=$rs->fields;
		//var_dump($valores_usuario);
		   //var_dump($rs->fields['id']);
	      //return $usuario;
		 return $valores_usuario;
	  // $_SESSION['sUsuario']=$usuario;
	   // echo  $usuario;
     }else{
	   $retorno="ERROR";	
    }
		
//echo $retorno;


		//busca el nombre del usuario si existe
		/*public function buscarUsuario($nombre){
			$db=Db::conectar();
			$select=$db->prepare('SELECT * FROM USUARIOS WHERE nombre=:nombre');
			$select->bindValue('nombre',$nombre);
			$select->execute();
			$registro=$select->fetch();
			if($registro['Id']!=NULL){
				$usado=False;
			}else{
				$usado=True;
			}	
			return $usado;
		}*/
	}
 }
 
?>