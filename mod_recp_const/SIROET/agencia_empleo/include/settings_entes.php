<?php
//version 1.0
//ESTE ARCHIVO CONTIENE LA CONFIGURACION PARA LOS WEBSERVICE DE LOS DOFERENTES ENTES
//ESTA VARIABLE CON LA IP ES LLAMADA EN clienteseniat_local.php en mod_rnet
//PARA QUE EL SERVIDOR PUEDA HACER EL INCLUDE DESDE OTRO SERVIDOR DEBE TENER EN ON EN EL PHP.ini LAS SIGUIENTES 
//CONDICIONES allow_url_include Y allow_url_fopen

//PARA SENIAT PRUEBAS
//$ip_seniat_archivo_remoto_="200.109.236.51";

//PARA SENIAT PRUDUCCION
$ip_seniat_archivo_remoto_="190.202.19.30";

//PARA INCES 
$url_webservice_inces_ = 'http://ws.inces.gob.ve/a/rif/';
//http://ws.inces.gob.ve/a/rif/J000703825/
//http://ws.inces.gob.ve/s/rif/J000703825/

//PARA IVSS
$url_webservice_ivss_ = 'http://solvencias.ivss.gob.ve:28080/WebServicesMT/wsPatronoSolventeService?wsdl';

//URL QUE SE LE ENVIA AL USUARIO PARA VERIFICAR EL CODIGO
//EN ESTE CASO DEBERIA SER EL DOMINIO DEL SERVIDOR DONDE ESTARA EL SISTEMA
$dominio_server_verif_cod="http://10.46.1.91";


//PARA SAIME CNTI PRUDUCCION
$ip_saime_cnti_archivo_remoto_="200.109.236.51";


$host_smtp_pear = "mail.mpppst.gob.ve";
$port_smtp_pear = "25";
$username_smtp_pear = "rnet";
$password_smtp_pear = "1magnusspecialis";

///DATOS PARA EL SMTP DE PEAR


?>