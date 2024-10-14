<?php
						$respuesta[0]	=	'-1';
						$respuesta[1]	=	'ERROR EN LA DATA, COMUNIQUESE CON EL ADMINISTRADOR!';

					echo json_encode(array('cod'=>$respuesta[0],'msj'=>$respuesta[1]));
?>