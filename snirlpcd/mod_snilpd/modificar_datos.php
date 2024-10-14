<?php
    session_start();
    include("../include/BD.php");
	$conn = Conexion::ConexionBD();

    
    /*$op = "<option value= -1>Seleccionar</option>";
    foreach($parroquias as $parroquia){
        $op .= "<option value=".$parroquia['id'].">".$parroquia['nombre']."</option>";
    }*/

    //echo $op;
    /*$data = $_POST['id'];
    var_dump($data);die($data);*/
    if (isset($_REQUEST['action'])){
        $Cod = "";
        $Msj = "";
        $Valores ="";
        switch($_REQUEST["action"]){
            
            case'continuar':
                
                $id = $_SESSION['cedula'];

                $sql = "SELECT * FROM public.personas WHERE cedula = '".$id."';";
                $row = pg_query($conn,$sql);
                $datos = pg_fetch_all($row);
    
                if (isset($datos)){
                    
                    //$Valores.=trim($rs1->fields['primer_nombre'])."|";
                    //$Valores.=trim($rs1->fields['sexo'])."|";
                    $Valores = $datos;
                    
                    $Cod = "1";
                    $Msj = "Datos guardados Exitosamente";
                    //Se debe indicar ya que trajo informacion pero su login no esta creado
        
    
                        /*if ($rs2->RecordCount()>0){
    
                            $Cod = "2"; //NEGATIVO y No TRAE RESULTADOS
                            $Msj = "Usuario ya registrado en el sistema";
                            //$Valores = "";
                            
                        }else{
                            $Cod = "1"; //NEGATIVO y No TRAE RESULTADOS
                            $Msj = "Debe culminar de llenar los datos para el Registro";
                        } */
                }else{
                
                    $Cod = "0"; //NEGATIVO y No TRAE RESULTADOS
                    $Msj = "Debe terminar de llenar los datos para culminar el registro";
                    $Valores = $datos;
                    //$valores = "EL NUMERO DE CEDULA NO ESTA REGISTRADO EN EL SAIME POR FAVOR INGRESE UNA CEDULA VALIDA. |";
                    //$valores .= "MAYOR INFORMACION COMUNIQUESE AL 0800TRABAJO (872-22-56).";
                                
                    
                }
                //echo $Cod."|".$Msj."|".$Valores;           
    
        }
    }
?> 