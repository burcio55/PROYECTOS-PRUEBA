<?php
ini_set("display_errors",0);
error_reporting(E_ALL | E_STRICT);
include('../header.php'); 
session_start();
//var_dump($_SESSION);
?>


<form name="form1" id="form1" method="" action="<?=$_SERVER['PHP_SELF'] ?>" >

<table class="formulario" width="90%" border="0" align="center">
<tr>
<td height="400" align="center"><font size="2" color="#006699">  
 <? if($_SESSION['FINAL']==1){?>
	
   <font size="2" color="#006699"><h1><strong>Usted ha finalizado exitosamente su registro.</strong></h1></font>	
   <?  $_SESSION['FINAL']=0; 
	  }else{
		   if($_SESSION['FINAL']==2){ ?>
     <font size="4" color="#006699"> <strong> Usted se ha inscrito de manera exitosa en el</font> </br>
    <font  color="#006699"> <h1> <?  echo ucwords(strtolower(htmlentities($_SESSION['nombre_plan'],ENT_COMPAT)));?>. </strong></h1></font>
          <? //unset($_SESSION['FINAL']);
//			  unset($_SESSION['nombre_plan']);?>
        <? }else{
			  unset($_SESSION['FINAL']);
			  unset($_SESSION['nombre_plan']);?>
      		 <div align="center"><!-- <video src="contenido/1611847246398.mp4" autoplay loop></video>--></div>   
        <? }
	}
		?>
 </td>

</tr>
</table>
</form>


<?php
 include('../footer.php'); 
 ?>