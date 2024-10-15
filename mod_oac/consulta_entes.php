<?php

//include('../header.php');


$conn1 = &ADONewConnection($target);
$conn1->PConnect($hostname,$username,$password,$db_settings[1]);//entes
$conn1->debug = false;

function consultando_saime($cedula,$letra) {	
   global $conn1;
   
    if($letra==1) $letra='V';
    if($letra==2) $letra='E';

    ///----------------CONSULTA SAIME ENTES INTERNO---------------------------------------
		if($cedula!=''){
    $sSQL="select * from public.saime where numcedula='".$cedula."' and letra='".$letra."'";
    $rs= $conn1->Execute($sSQL);
		if($rs){
    if ($rs->RecordCount()>0){
        $dataSaime['nombre1']=trim($rs->fields['primer_nombre']);
        $dataSaime['nombre2']=trim($rs->fields['segundo_nombre']);
        $dataSaime['apellido1']=trim($rs->fields['primer_apellido']);
        $dataSaime['apellido2']=trim($rs->fields['segundo_apellido']);	

        if(trim($rs->fields['sexo'])=='F') $dataSaime['sexo']='2';
        if(trim($rs->fields['sexo'])=='M') $dataSaime['sexo']='1';

        $var = trim($rs->fields['fechanac']);
        if($var!=''){
            //$date = DateTime::createFromFormat('d/m/Y', $var);
            //$dataSaime['fecha_nac']=$date->format('Y-m-d');
            $date =  strtotime($var); //si es una fecha valida la puedo ver como un integer y manipular a mi antojo con strtotime y date
            $dataSaime['fecha_nac']=date('Y-m-d',$date);
        }else{
            $dataSaime['fecha_nac']=NULL;
        }
        //si la cedula existe actualiza en saime local con la data del saime para corregir errores anteriores de usuarios mal cargados o con data imcompleta
        //$dataSaime = consultando_saime_remoto($cedula,$letra,'update');
    }
    else{
        //si no existe inserta en saime local
        $dataSaime = consultando_saime_remoto($cedula,$letra,'insert');
    }
		}
    return $dataSaime;
		}
}    

function consultando_saime_remoto($cedula,$letra,$accion) {
        global $conn1;
        global $ip_saime_cnti_archivo_remoto_;
         //echo 'entrando web'.'  '.$ip_saime_cnti_archivo_remoto_.' sgdgdg  '.$letra.$cedula;
        ///----------------CONSULTA SAIME WEB SERVICE--------------------------------------------
        //$_REQUEST['cedula']='V-20028022';
        //$json = file_get_contents('http://200.109.236.51/cliente_cnti_saime_remoto.php?cedula='.$letra.'-'.$cedula);
        $json = file_get_contents('http://'.$ip_saime_cnti_archivo_remoto_.'/cliente_cnti_saime_remoto_nuevo.php?cedula='.$letra.$cedula);
        //QUITO LOS CARACTERES LOCOS QUE VIENEN
        $json=substr($json,3);
        $json = str_replace('\"','',$json);
        $data = json_decode($json, true);
        //var_dump($data);
        /*ESTATUS_WEBSERVER=1    TRAE BIEN LOS DATOS
        ESTATUS_WEBSERVER=-2   NO EXISTE
        ESTATUS_WEBSERVER=-1   PAGINA CAIDA
        ESTATUS_WEBSERVER=-4   CEDULA VACIA*/
			
        if($data['ESTATUS_WEBSERVER']=='1'){
					
            $dataSaime['nombre1']=trim($data['PRIMERNOMBRE']);
            $dataSaime['nombre2']=trim($data['SEGUNDONOMBRE']);
            $dataSaime['apellido1']=trim($data['PRIMERAPELLIDO']);
            $dataSaime['apellido2']=trim($data['SEGUNDOAPELLIDO']);	

            if(trim($data['SEXO'])=='F') $dataSaime['sexo']='2';
            if(trim($data['SEXO'])=='M') $dataSaime['sexo']='1';

            $var = trim($data['FECHANAC']);
            /*if($var!=''){
                    $date = DateTime::createFromFormat('d/m/Y', $var);
                    $dataSaime['fecha_nac']=$date->format('Y-m-d');
            }*/
            if($var!=''){
                $dataSaime['fecha_nac']=$var;
            } 
            else{
                $dataSaime['fecha_nac']=NULL;
            }
            switch ($accion){
                case 'insert':
                    insertarSaimeLocal($data,$letra);
                break;    
                case 'update':
                    actualizarSaimeLocal($data,$letra);
                break;
            }
        }
			 
        if($data['ESTATUS_WEBSERVER']=='-2' && !$GLOBALS['aPageErrors']){
            $GLOBALS['aPageErrors'][] = "- El numero de cedula no esta registrado en el SAIME, por favor ingrese una cedula valida. Para mayor informacion comuniquese al 0800-TRABAJO 872-22-56. ";
        }

        if($data['ESTATUS_WEBSERVER']=='-1' && !$GLOBALS['aPageErrors']){
            $GLOBALS['aPageErrors'][] = "- En estos momentos no existe conexion con SAIME, por favor intente luego";            
        }

        if($data['ESTATUS_WEBSERVER']=='-4' && !$GLOBALS['aPageErrors']){	
            $GLOBALS['aPageErrors'][] = "- Por favor ingrese una cedula valida.";
        }

    return $dataSaime;
}

function insertarSaimeLocal($data,$letra){
    global $conn1;
    $sql = "
    INSERT INTO entes.public.saime(
    numcedula, letra, sexo, fechanac, primer_apellido, segundo_apellido, 
    primer_nombre, segundo_nombre, pais_origen, nacionalidad, cod_estadocivil, 
    naturalizado, cod_objecion)
    VALUES (
    '".$data['NUMCEDULA']."',
    '".$letra."', 
    '".$data['SEXO']."',
    '".$data['FECHANAC']."',
    $$".$data['PRIMERAPELLIDO']."$$, 
    $$".$data['SEGUNDOAPELLIDO']."$$, 
    $$".$data['PRIMERNOMBRE']."$$,
    $$".$data['SEGUNDONOMBRE']."$$,
    '".$data['PAISORIGEN']."',
    '".$data['NACIONALIDAD']."',
    '".$data['CODESTADOCIVL']."', 
    '".$data['NATURALIZADO']."',
    '".$data['CODOBJECION']."'
    )
    ";

    $insSuccess = $conn1->Execute($sql);
}

function actualizarSaimeLocal($data,$letra){
    global $conn1;
    $sql = "
    UPDATE entes.public.saime
    SET sexo= '".$data['SEXO']."',
    fechanac= '".$data['FECHANAC']."',
    primer_apellido= $$".$data['PRIMERAPELLIDO']."$$, 
    segundo_apellido= $$".$data['SEGUNDOAPELLIDO']."$$, 
    primer_nombre= $$".$data['PRIMERNOMBRE']."$$,
    segundo_nombre= $$".$data['SEGUNDONOMBRE']."$$,
    pais_origen= '".$data['PAISORIGEN']."',
    nacionalidad= '".$data['NACIONALIDAD']."',
    cod_estadocivil= '".$data['CODESTADOCIVL']."', 
    naturalizado= '".$data['NATURALIZADO']."',
    cod_objecion= '".$data['CODOBJECION']."'
    WHERE numcedula= '".$data['NUMCEDULA']."' and letra= '".$letra."'
    ";

    $updSuccess = $conn1->Execute($sql);
}

?>