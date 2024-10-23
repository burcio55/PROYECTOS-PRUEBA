<? 
// al descomentar el diplay_errors se visualizan los errores de php
ini_set("display_errors",0);
error_reporting(E_ALL | E_STRICT);

session_start();
require_once('shuffle.php');
$array1 = array(
'<tr>
  <tr>
  <td align="lefth" class=""><font color="#585858"><b>- INDIQUE SI SU NUMERO TELEFONICO '.$condicion1.'ES EL SIGUIENTE: </b>			</font>
</td>
</tr>
        <tr>
  	<td align="lefth" class=""><font color="#585858">NUMERO TELEFONICO REGISTRADO:  '.$query_1.'</font>
</td>
</tr
<tr>
<td align="lefth"  id="td_respuesta1" width="30%"><b> 

      &nbsp;&nbsp;
      SI
      <input type="radio" name="respuesta1" id="valor1"  value="1"/>
      &nbsp;&nbsp;
      NO
	   <input type="radio" name="respuesta1" id="valor2"  value="2"/>
      &nbsp;&nbsp;     
      <span>*</span></b>
	  </td>
</tr>
', 

'<tr>
  <td align="lefth" class=""><font color="#585858"><b>- INDIQUE SI SU FECHA DE NACIMIENTO  '.$condicion3.'ES LA SIGUIENTE: </b></font>
</td>
</tr>

<tr>
  <td align="justify" class=""><font color="#585858">"'.$query_3.'"</font>
</td>
</tr>
<tr>
<td align="lefth" id="td_respuesta2" width="30%"> <b>
      &nbsp;&nbsp;
      SI
       <input type="radio" name="respuesta2" id="valor1"  value="1"/>
      &nbsp;&nbsp;
      NO
	   <input type="radio" name="respuesta2" id="valor2" value="2"/>
      &nbsp;&nbsp;     
      <span>*</span></b></td>
</tr>'); 
shuffle($array1); //Para Efectos de Desordenar el Array
?>