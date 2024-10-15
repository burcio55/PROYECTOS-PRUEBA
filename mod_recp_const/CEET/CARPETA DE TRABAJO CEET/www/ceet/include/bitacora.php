<?  
session_start();     
function bitacora($tabla,$query,$conn,$esquema){

	$ipv4= $_SERVER['REMOTE_ADDR'];
	$url= $_SERVER["PHP_SELF"];
	$log_query=str_replace("'","",$query);
	
	$insert_bitacora="INSERT INTO ".$esquema.".bitacora (ipv4, url, fecha, hora, usuario, tabla, query) VALUES ('$ipv4', '$url', now(), CURRENT_TIME, ".$_SESSION['id_usuario'].", '$tabla', '$log_query');";
								 
	$success_bitacora = $conn->Execute($insert_bitacora);
}

/*
-----------CODIGO SQL BITACORA QUERY-----------

CREATE TABLE ESQUEMA.bitacora
(
  id_bitacora bigserial NOT NULL,
  ipv4 character varying,
  url character varying,
  fecha date DEFAULT now(),
  hora time without time zone DEFAULT ('now'::text)::time with time zone,
  usuario character varying,
  tabla character varying,
  query character varying,
  CONSTRAINT id_bitacora PRIMARY KEY (id_bitacora)
)
WITH (
  OIDS=FALSE
);
ALTER TABLE ESQUEMA.bitacora
  OWNER TO areadesarrollo;

*/

?>
