<?php 
include("../../header.php"); 

$settings['debug'] = false;
$conn= getConnDB($db2);
$conn->debug = $settings['debug'];

unset($_SESSION['aTabla']);
unset($GLOBALS['aTabla1']);
doAction($conn);
debug();
function doAction($conn){
	if (isset($_POST['action'])){
		$bValidateSuccess=false;
		switch($_POST['action']){
		case 'regresar':		
			 if($_SESSION['sistema']=='OFICINA ATENCION AL CIUDADANO'){
			?><script>			
				document.location='../mod_oac/datos_personales.php';
			</script><?
	
	} 
			
			
			break;
			case 'regresar1':	//HCM	
			 if($_SESSION['sistema']=='REGISTRO HCM'){
			?><script>			
				document.location='../mod_hcm/registro.php';
			</script><?
	
	} 
			
			
			break;
		}
	}
}
function LoadData($conn,$PostBack){
	
}

function ProcessForm($conn,$accion){
	
}
?>	
<div id="Contenido" align="center" style="overflow:auto">
	<br>
	
<script type="text/javascript" src="funciones_saime_guardar.js"></script>
<script>
function mayusculas(e) {
    e.value = e.value.toUpperCase();
}
function send(saction){
var form=document.form;
		form.action.value=saction;
		form.submit();	
}
</script>
<form action="" method="post" enctype="multipart/form-data" name="form" id="form">
<input name="action" type="hidden" value="">
 <p>

<table width="95%" border="0" align="center" class="formulario" cellpadding="0" cellspacing="0">
   <tr>
      <th colspan="4"  class="sub_titulo"><div align="left"> MANTENIMIENTO --> Registrar Ciudadano(SAIME)</div></th>
    </tr>
    
    <tr>
       <td colspan="4" align="right"><span class="requerido">Campos obligatorios (*)</span>&nbsp;</td>
    </tr>
   
<tr>
     <th width="50%" colspan="2" align="right"><div align="right">C&eacute;dula de Identidad &nbsp;</div></th>	
     <td width="50%" colspan="2" align="left"><input name="txt_cedula" type="text" id="txt_cedula"  onkeyup="mayusculas(this);" placeholder="Ej. V30012345"title="Cedula - Formato:V30012345 " value="<?= $_REQUEST['txt_cedula']?>"  maxlength="10" /><span>*</span>        <button type="button" name="buscar" id="buscar" class="button_personal btn_buscar"  onclick="" > &nbsp; Buscar</button></td>
</tr>

<tr>
    <th width="23%" class="separacion_20"></th>
  </tr>
  
   <tr>
        <th class="sub_titulo"><div align="center">Primer Nombre</div></th>		
        <th class="sub_titulo"><div align="center">Segundo Nombre</div></th>
        <th class="sub_titulo"><div align="center">Primer Apellido</div></th>
        <th class="sub_titulo"><div align="center">Segundo Apellido</div></th>
    </tr> 
     
  <tr>
    <td style="background-color:#F0F0F0;" align="center">
    	<input name="txt_primer_nombre" type="text" id="txt_primer_nombre"  onkeyup="mayusculas(this);" title="Primer Nombre " value="" size="25" maxlength="25" />      
    	<span>*</span>
    </td>
    
    <td style="background-color:#F0F0F0;" align="center">
    	<input name="txt_segundo_nombre" type="text" id="txt_segundo_nombre"  onkeyup="mayusculas(this);" title="Segundo Nombre " value="" size="25" maxlength="25" />    </td>
        
    <td style="background-color:#F0F0F0;" align="center">
    	<input name="txt_primer_apellido" type="text" id="txt_primer_apellido" onkeyup="mayusculas(this);"  title="Primer Apellido " value="" size="25" maxlength="25" />     	<span>*</span>
    </td>
    
    <td style="background-color:#F0F0F0;" align="center">
    	<input name="txt_segundo_apellido" type="text" id="txt_segundo_apellido"  onkeyup="mayusculas(this);" title="Segundo Apellido " value="" size="25" maxlength="25" />        
    </td>
</tr>
 
<tr>
    <th class="sub_titulo"><div align="center">Sexo</div></th>	
    <th class="sub_titulo"><div align="center">Fecha de Nacimiento</div></th>	
    <th class="sub_titulo"><div align="center">Nacionalidad</div></th>	
    <th class="sub_titulo"><div align="center">País de Origen</div></th>	
</tr>    
  
<tr>    
    <td style="background-color:#F0F0F0;" align="center">
    <select id="cbo_sexo" name="cbo_sexo" >
        <option value=""<?php if (!(strcmp('',$aDefaultForm['cbo_sexo']))) {echo " selected=\"selected\"";}?>>Seleccionar</option>
		    <option value="M"<?php if (!(strcmp('M ',$aDefaultForm['cbo_sexo']))) {echo " selected=\"selected\"";}?>>Masculino </option>
        <option value="F"<?php if (!(strcmp('F',$aDefaultForm['cbo_sexo']))) {echo " selected=\"selected\"";}?>>Femenino </option>
    </select>      
    	<span>*</span>
    </td>
 
    <td style="background-color:#F0F0F0;" align="center">  
      <input  name="fecha_nacimiento" id="fecha_nacimiento" type="text"  title="Fecha de Nacimiento." size="10"  value="<?= $aDefaultForm['fecha_nacimiento'];?>" readonly/>
        <a  id="f_btn1"><img src="../../imagenes/calendar_16.png" alt="" width="16" height="16" align="top"/></a>
        <script type="text/javascript">
                      Calendar.setup({
                      inputField : "fecha_nacimiento",
                      trigger    : "f_btn1",
                      onSelect   : function() { this.hide() },
                      showTime   : false,
                      dateFormat : "%d-%m-%Y"
                      });
                  </script>
        <span>*</span>
     </td>
     
     <td style="background-color:#F0F0F0;" align="center">
    <select id="cbo_nacionalidad" name="cbo_nacionalidad" >
        <option value=""<?php if (!(strcmp('',$aDefaultForm['cbo_pais_origen']))) {echo " selected=\"selected\"";}?>>Seleccionar</option>
		 <option value="ABW"<?php if (!(strcmp('ABW ',$aDefaultForm['cbo_pais_origen']))) {echo " selected=\"selected\"";}?>>ABW </option>
         <option value="AFG"<?php if (!(strcmp('AFG',$aDefaultForm['cbo_pais_origen']))) {echo " selected=\"selected\"";}?>>AFG </option>
         <option value="AGO"<?php if (!(strcmp('AGO',$aDefaultForm['cbo_pais_origen']))) {echo " selected=\"selected\"";}?>>AGO </option>
         <option value="ALB"<?php if (!(strcmp('ALB',$aDefaultForm['cbo_pais_origen']))) {echo " selected=\"selected\"";}?>>ALB </option>
         <option value="AND"<?php if (!(strcmp('AND',$aDefaultForm['cbo_pais_origen']))) {echo " selected=\"selected\"";}?>>AND </option>
         <option value="ANT"<?php if (!(strcmp('ANT',$aDefaultForm['cbo_pais_origen']))) {echo " selected=\"selected\"";}?>>ANT </option>
         <option value="ARE"<?php if (!(strcmp('ARE',$aDefaultForm['cbo_pais_origen']))) {echo " selected=\"selected\"";}?>>ARE </option>
         <option value="ARG"<?php if (!(strcmp('ARG',$aDefaultForm['cbo_pais_origen']))) {echo " selected=\"selected\"";}?>>ARG </option>
         <option value="ARM"<?php if (!(strcmp('ARM',$aDefaultForm['cbo_pais_origen']))) {echo " selected=\"selected\"";}?>>ARM </option>
         <option value="ATF"<?php if (!(strcmp('ATF',$aDefaultForm['cbo_pais_origen']))) {echo " selected=\"selected\"";}?>>ATF </option>
         <option value="ATG"<?php if (!(strcmp('ATG',$aDefaultForm['cbo_pais_origen']))) {echo " selected=\"selected\"";}?>>ATG </option>
         <option value="AUS"<?php if (!(strcmp('AUS',$aDefaultForm['cbo_pais_origen']))) {echo " selected=\"selected\"";}?>>AUS </option>
         <option value="AUT"<?php if (!(strcmp('AUT',$aDefaultForm['cbo_pais_origen']))) {echo " selected=\"selected\"";}?>>AUT </option>
         <option value="AZE"<?php if (!(strcmp('AZE',$aDefaultForm['cbo_pais_origen']))) {echo " selected=\"selected\"";}?>>AZE </option>
         <option value="BDI"<?php if (!(strcmp('BDI',$aDefaultForm['cbo_pais_origen']))) {echo " selected=\"selected\"";}?>>BDI </option>
         <option value="BEL"<?php if (!(strcmp('BEL',$aDefaultForm['cbo_pais_origen']))) {echo " selected=\"selected\"";}?>>BEL </option>
         <option value="BEN"<?php if (!(strcmp('BEN',$aDefaultForm['cbo_pais_origen']))) {echo " selected=\"selected\"";}?>>BEN </option>
         <option value="BFA"<?php if (!(strcmp('BFA',$aDefaultForm['cbo_pais_origen']))) {echo " selected=\"selected\"";}?>>BFA </option>
         <option value="BGD"<?php if (!(strcmp('BGD',$aDefaultForm['cbo_pais_origen']))) {echo " selected=\"selected\"";}?>>BGD </option>
         <option value="BGR"<?php if (!(strcmp('BGR',$aDefaultForm['cbo_pais_origen']))) {echo " selected=\"selected\"";}?>>BGR </option>
         <option value="BHR"<?php if (!(strcmp('BHR',$aDefaultForm['cbo_pais_origen']))) {echo " selected=\"selected\"";}?>>BHR </option>
         <option value="BHS"<?php if (!(strcmp('BHS',$aDefaultForm['cbo_pais_origen']))) {echo " selected=\"selected\"";}?>>BHS </option>
         <option value="BIH"<?php if (!(strcmp('BIH',$aDefaultForm['cbo_pais_origen']))) {echo " selected=\"selected\"";}?>>BIH </option>
         <option value="BLR"<?php if (!(strcmp('BLR',$aDefaultForm['cbo_pais_origen']))) {echo " selected=\"selected\"";}?>>BLR </option>
         <option value="BLZ"<?php if (!(strcmp('BLZ',$aDefaultForm['cbo_pais_origen']))) {echo " selected=\"selected\"";}?>>BLZ </option>
         <option value="BOL"<?php if (!(strcmp('BOL',$aDefaultForm['cbo_pais_origen']))) {echo " selected=\"selected\"";}?>>BOL </option>
         <option value="BRA"<?php if (!(strcmp('BRA',$aDefaultForm['cbo_pais_origen']))) {echo " selected=\"selected\"";}?>>BRA </option>
         <option value="BRB"<?php if (!(strcmp('BRB',$aDefaultForm['cbo_pais_origen']))) {echo " selected=\"selected\"";}?>>BRB </option>
         <option value="BRN"<?php if (!(strcmp('BRN',$aDefaultForm['cbo_pais_origen']))) {echo " selected=\"selected\"";}?>>BRN </option>
         <option value="BWA"<?php if (!(strcmp('BWA',$aDefaultForm['cbo_pais_origen']))) {echo " selected=\"selected\"";}?>>BWA </option>
         <option value="CAF"<?php if (!(strcmp('CAF',$aDefaultForm['cbo_pais_origen']))) {echo " selected=\"selected\"";}?>>CAF </option>
         <option value="CAN"<?php if (!(strcmp('CAN',$aDefaultForm['cbo_pais_origen']))) {echo " selected=\"selected\"";}?>>CAN </option>
         <option value="CHE"<?php if (!(strcmp('CHE',$aDefaultForm['cbo_pais_origen']))) {echo " selected=\"selected\"";}?>>CHE </option>
         <option value="CHL"<?php if (!(strcmp('CHL',$aDefaultForm['cbo_pais_origen']))) {echo " selected=\"selected\"";}?>>CHL </option>
         <option value="CHN"<?php if (!(strcmp('CHN',$aDefaultForm['cbo_pais_origen']))) {echo " selected=\"selected\"";}?>>CHN </option>
         <option value="CIV"<?php if (!(strcmp('CIV',$aDefaultForm['cbo_pais_origen']))) {echo " selected=\"selected\"";}?>>CIV </option>
         <option value="CMR"<?php if (!(strcmp('CMR',$aDefaultForm['cbo_pais_origen']))) {echo " selected=\"selected\"";}?>>CMR </option>
         <option value="COD"<?php if (!(strcmp('COD',$aDefaultForm['cbo_pais_origen']))) {echo " selected=\"selected\"";}?>>COD </option>
         <option value="COG"<?php if (!(strcmp('COG',$aDefaultForm['cbo_pais_origen']))) {echo " selected=\"selected\"";}?>>COG </option>
         <option value="COL"<?php if (!(strcmp('COL',$aDefaultForm['cbo_pais_origen']))) {echo " selected=\"selected\"";}?>>COL </option>
         <option value="COM"<?php if (!(strcmp('COM',$aDefaultForm['cbo_pais_origen']))) {echo " selected=\"selected\"";}?>>COM </option>
         <option value="CPV"<?php if (!(strcmp('CPV',$aDefaultForm['cbo_pais_origen']))) {echo " selected=\"selected\"";}?>>CPV </option>
         <option value="CRI"<?php if (!(strcmp('CRI',$aDefaultForm['cbo_pais_origen']))) {echo " selected=\"selected\"";}?>>CRI </option>
         <option value="CUB"<?php if (!(strcmp('CUB',$aDefaultForm['cbo_pais_origen']))) {echo " selected=\"selected\"";}?>>CUB </option>
         <option value="CYM"<?php if (!(strcmp('CYM',$aDefaultForm['cbo_pais_origen']))) {echo " selected=\"selected\"";}?>>CYM </option>
         <option value="CYP"<?php if (!(strcmp('CYP',$aDefaultForm['cbo_pais_origen']))) {echo " selected=\"selected\"";}?>>CYP </option>
         <option value="CZE"<?php if (!(strcmp('CZE',$aDefaultForm['cbo_pais_origen']))) {echo " selected=\"selected\"";}?>>CZE </option>
         <option value="DEU"<?php if (!(strcmp('DEU',$aDefaultForm['cbo_pais_origen']))) {echo " selected=\"selected\"";}?>>DEU </option>
         <option value="DJI"<?php if (!(strcmp('DJI',$aDefaultForm['cbo_pais_origen']))) {echo " selected=\"selected\"";}?>>DJI </option>
         <option value="DMA"<?php if (!(strcmp('DMA',$aDefaultForm['cbo_pais_origen']))) {echo " selected=\"selected\"";}?>>DMA </option>
         <option value="DNK"<?php if (!(strcmp('DNK',$aDefaultForm['cbo_pais_origen']))) {echo " selected=\"selected\"";}?>>DNK </option>
         <option value="DOM"<?php if (!(strcmp('DOM',$aDefaultForm['cbo_pais_origen']))) {echo " selected=\"selected\"";}?>>DOM </option>
         <option value="DZA"<?php if (!(strcmp('DZA',$aDefaultForm['cbo_pais_origen']))) {echo " selected=\"selected\"";}?>>DZA </option>
         <option value="ECU"<?php if (!(strcmp('ECU',$aDefaultForm['cbo_pais_origen']))) {echo " selected=\"selected\"";}?>>ECU </option>
         <option value="EGY"<?php if (!(strcmp('EGY',$aDefaultForm['cbo_pais_origen']))) {echo " selected=\"selected\"";}?>>EGY </option>
         <option value="ERI"<?php if (!(strcmp('ERI',$aDefaultForm['cbo_pais_origen']))) {echo " selected=\"selected\"";}?>>ERI </option>
         <option value="ESH"<?php if (!(strcmp('ESH',$aDefaultForm['cbo_pais_origen']))) {echo " selected=\"selected\"";}?>>ESH </option>
         <option value="ESP"<?php if (!(strcmp('ESP',$aDefaultForm['cbo_pais_origen']))) {echo " selected=\"selected\"";}?>>ESP </option>
         <option value="EST"<?php if (!(strcmp('EST',$aDefaultForm['cbo_pais_origen']))) {echo " selected=\"selected\"";}?>>EST </option>
         <option value="ETH"<?php if (!(strcmp('ETH',$aDefaultForm['cbo_pais_origen']))) {echo " selected=\"selected\"";}?>>ETH </option>
         <option value="FIN"<?php if (!(strcmp('FIN',$aDefaultForm['cbo_pais_origen']))) {echo " selected=\"selected\"";}?>>FIN </option>
         <option value="FJI"<?php if (!(strcmp('FJI',$aDefaultForm['cbo_pais_origen']))) {echo " selected=\"selected\"";}?>>FJI </option>
         <option value="FRA"<?php if (!(strcmp('FRA',$aDefaultForm['cbo_pais_origen']))) {echo " selected=\"selected\"";}?>>FRA </option>
         <option value="FXX"<?php if (!(strcmp('FXX',$aDefaultForm['cbo_pais_origen']))) {echo " selected=\"selected\"";}?>>FXX </option>
         <option value="GAB"<?php if (!(strcmp('GAB',$aDefaultForm['cbo_pais_origen']))) {echo " selected=\"selected\"";}?>>GAB </option>
         <option value="GBR"<?php if (!(strcmp('GBR',$aDefaultForm['cbo_pais_origen']))) {echo " selected=\"selected\"";}?>>GBR </option>
         <option value="GEO"<?php if (!(strcmp('GEO',$aDefaultForm['cbo_pais_origen']))) {echo " selected=\"selected\"";}?>>GEO </option>
         <option value="GHA"<?php if (!(strcmp('GHA',$aDefaultForm['cbo_pais_origen']))) {echo " selected=\"selected\"";}?>>GHA </option>
         <option value="GIB"<?php if (!(strcmp('GIB',$aDefaultForm['cbo_pais_origen']))) {echo " selected=\"selected\"";}?>>GIB </option>
         <option value="GIN"<?php if (!(strcmp('GIN',$aDefaultForm['cbo_pais_origen']))) {echo " selected=\"selected\"";}?>>GIN </option>
         <option value="GLP"<?php if (!(strcmp('GLP',$aDefaultForm['cbo_pais_origen']))) {echo " selected=\"selected\"";}?>>GLP </option>
         <option value="GMB"<?php if (!(strcmp('GMB',$aDefaultForm['cbo_pais_origen']))) {echo " selected=\"selected\"";}?>>GMB </option>
         <option value="GNB"<?php if (!(strcmp('GNB',$aDefaultForm['cbo_pais_origen']))) {echo " selected=\"selected\"";}?>>GNB </option>
         <option value="GNQ"<?php if (!(strcmp('GNQ',$aDefaultForm['cbo_pais_origen']))) {echo " selected=\"selected\"";}?>>GNQ </option>
         <option value="GRC"<?php if (!(strcmp('GRC',$aDefaultForm['cbo_pais_origen']))) {echo " selected=\"selected\"";}?>>GRC </option>
         <option value="GRD"<?php if (!(strcmp('GRD',$aDefaultForm['cbo_pais_origen']))) {echo " selected=\"selected\"";}?>>GRD </option>
         <option value="GTM"<?php if (!(strcmp('GTM',$aDefaultForm['cbo_pais_origen']))) {echo " selected=\"selected\"";}?>>GTM </option>
         <option value="GUF"<?php if (!(strcmp('GUF',$aDefaultForm['cbo_pais_origen']))) {echo " selected=\"selected\"";}?>>GUF </option>
         <option value="GUM"<?php if (!(strcmp('GUM',$aDefaultForm['cbo_pais_origen']))) {echo " selected=\"selected\"";}?>>GUM </option>
         <option value="GUY"<?php if (!(strcmp('GUY',$aDefaultForm['cbo_pais_origen']))) {echo " selected=\"selected\"";}?>>GUY </option>
         <option value="HKG"<?php if (!(strcmp('HKG',$aDefaultForm['cbo_pais_origen']))) {echo " selected=\"selected\"";}?>>HKG </option>
         <option value="HND"<?php if (!(strcmp('HND',$aDefaultForm['cbo_pais_origen']))) {echo " selected=\"selected\"";}?>>HND </option>
         <option value="HRV"<?php if (!(strcmp('HRV',$aDefaultForm['cbo_pais_origen']))) {echo " selected=\"selected\"";}?>>HRV </option>
         <option value="HTI"<?php if (!(strcmp('HTI',$aDefaultForm['cbo_pais_origen']))) {echo " selected=\"selected\"";}?>>HTI </option>
         <option value="HUN"<?php if (!(strcmp('HUN',$aDefaultForm['cbo_pais_origen']))) {echo " selected=\"selected\"";}?>>HUN </option>
         <option value="IDN"<?php if (!(strcmp('IDN',$aDefaultForm['cbo_pais_origen']))) {echo " selected=\"selected\"";}?>>IDN </option>
         <option value="IND"<?php if (!(strcmp('IND',$aDefaultForm['cbo_pais_origen']))) {echo " selected=\"selected\"";}?>>IND </option>
         <option value="IOT"<?php if (!(strcmp('IOT',$aDefaultForm['cbo_pais_origen']))) {echo " selected=\"selected\"";}?>>IOT </option>
         <option value="IRL"<?php if (!(strcmp('IRL',$aDefaultForm['cbo_pais_origen']))) {echo " selected=\"selected\"";}?>>IRL </option>
         <option value="IRN"<?php if (!(strcmp('IRN',$aDefaultForm['cbo_pais_origen']))) {echo " selected=\"selected\"";}?>>IRN </option>
         <option value="IRQ"<?php if (!(strcmp('IRQ',$aDefaultForm['cbo_pais_origen']))) {echo " selected=\"selected\"";}?>>IRQ </option>
         <option value="ISL"<?php if (!(strcmp('ISL',$aDefaultForm['cbo_pais_origen']))) {echo " selected=\"selected\"";}?>>ISL </option>
         <option value="ISR"<?php if (!(strcmp('ISR',$aDefaultForm['cbo_pais_origen']))) {echo " selected=\"selected\"";}?>>ISR </option>
         <option value="ITA"<?php if (!(strcmp('ITA',$aDefaultForm['cbo_pais_origen']))) {echo " selected=\"selected\"";}?>>ITA </option>
         <option value="JAM"<?php if (!(strcmp('JAM',$aDefaultForm['cbo_pais_origen']))) {echo " selected=\"selected\"";}?>>JAM </option>
         <option value="JAP"<?php if (!(strcmp('JAP',$aDefaultForm['cbo_pais_origen']))) {echo " selected=\"selected\"";}?>>JAP </option>
         <option value="JOR"<?php if (!(strcmp('JOR',$aDefaultForm['cbo_pais_origen']))) {echo " selected=\"selected\"";}?>>JOR </option>
         <option value="JPN"<?php if (!(strcmp('JPN',$aDefaultForm['cbo_pais_origen']))) {echo " selected=\"selected\"";}?>>JPN </option>
         <option value="KAZ"<?php if (!(strcmp('KAZ',$aDefaultForm['cbo_pais_origen']))) {echo " selected=\"selected\"";}?>>KAZ </option>
         <option value="KEN"<?php if (!(strcmp('KEN',$aDefaultForm['cbo_pais_origen']))) {echo " selected=\"selected\"";}?>>KEN </option>
         <option value="KGZ"<?php if (!(strcmp('KGZ',$aDefaultForm['cbo_pais_origen']))) {echo " selected=\"selected\"";}?>>KGZ </option>
         <option value="KHM"<?php if (!(strcmp('KHM',$aDefaultForm['cbo_pais_origen']))) {echo " selected=\"selected\"";}?>>KHM </option>
         <option value="KNA"<?php if (!(strcmp('KNA',$aDefaultForm['cbo_pais_origen']))) {echo " selected=\"selected\"";}?>>KNA </option>
         <option value="KOR"<?php if (!(strcmp('KOR',$aDefaultForm['cbo_pais_origen']))) {echo " selected=\"selected\"";}?>>KOR </option>
         <option value="KWT"<?php if (!(strcmp('KWT',$aDefaultForm['cbo_pais_origen']))) {echo " selected=\"selected\"";}?>>KWT </option>
         <option value="LAO"<?php if (!(strcmp('LAO',$aDefaultForm['cbo_pais_origen']))) {echo " selected=\"selected\"";}?>>LAO </option>
         <option value="LBN"<?php if (!(strcmp('LBN',$aDefaultForm['cbo_pais_origen']))) {echo " selected=\"selected\"";}?>>LBN </option>
         <option value="LBR"<?php if (!(strcmp('LBR',$aDefaultForm['cbo_pais_origen']))) {echo " selected=\"selected\"";}?>>LBR </option>
         <option value="LBY"<?php if (!(strcmp('LBY',$aDefaultForm['cbo_pais_origen']))) {echo " selected=\"selected\"";}?>>LBY </option>
         <option value="LCA"<?php if (!(strcmp('LCA',$aDefaultForm['cbo_pais_origen']))) {echo " selected=\"selected\"";}?>>LCA </option>
         <option value="LIE"<?php if (!(strcmp('LIE',$aDefaultForm['cbo_pais_origen']))) {echo " selected=\"selected\"";}?>>LIE </option>
         <option value="LKA"<?php if (!(strcmp('LKA',$aDefaultForm['cbo_pais_origen']))) {echo " selected=\"selected\"";}?>>LKA </option>
         <option value="LTU"<?php if (!(strcmp('LTU',$aDefaultForm['cbo_pais_origen']))) {echo " selected=\"selected\"";}?>>LTU </option>
         <option value="LUX"<?php if (!(strcmp('LUX',$aDefaultForm['cbo_pais_origen']))) {echo " selected=\"selected\"";}?>>LUX </option>
         <option value="LVA"<?php if (!(strcmp('LVA',$aDefaultForm['cbo_pais_origen']))) {echo " selected=\"selected\"";}?>>LVA </option>
         <option value="MAC"<?php if (!(strcmp('MAC',$aDefaultForm['cbo_pais_origen']))) {echo " selected=\"selected\"";}?>>MAC </option>
         <option value="MAR"<?php if (!(strcmp('MAR',$aDefaultForm['cbo_pais_origen']))) {echo " selected=\"selected\"";}?>>MAR </option>
         <option value="MCO"<?php if (!(strcmp('MCO',$aDefaultForm['cbo_pais_origen']))) {echo " selected=\"selected\"";}?>>MCO </option>
         <option value="MDA"<?php if (!(strcmp('MDA',$aDefaultForm['cbo_pais_origen']))) {echo " selected=\"selected\"";}?>>MDA </option>
         <option value="MDG"<?php if (!(strcmp('MDG',$aDefaultForm['cbo_pais_origen']))) {echo " selected=\"selected\"";}?>>MDG </option>
         <option value="MEX"<?php if (!(strcmp('MEX',$aDefaultForm['cbo_pais_origen']))) {echo " selected=\"selected\"";}?>>MEX </option>
         <option value="MHL"<?php if (!(strcmp('MHL',$aDefaultForm['cbo_pais_origen']))) {echo " selected=\"selected\"";}?>>MHL </option>
         <option value="MKD"<?php if (!(strcmp('MKD',$aDefaultForm['cbo_pais_origen']))) {echo " selected=\"selected\"";}?>>MKD </option>
         <option value="MLI"<?php if (!(strcmp('MLI',$aDefaultForm['cbo_pais_origen']))) {echo " selected=\"selected\"";}?>>MLI </option>
         <option value="MLT"<?php if (!(strcmp('MLT',$aDefaultForm['cbo_pais_origen']))) {echo " selected=\"selected\"";}?>>MLT </option>
         <option value="MNG"<?php if (!(strcmp('MNG',$aDefaultForm['cbo_pais_origen']))) {echo " selected=\"selected\"";}?>>MNG </option>
         <option value="MOZ"<?php if (!(strcmp('MOZ',$aDefaultForm['cbo_pais_origen']))) {echo " selected=\"selected\"";}?>>MOZ </option>
         <option value="MRT"<?php if (!(strcmp('MRT',$aDefaultForm['cbo_pais_origen']))) {echo " selected=\"selected\"";}?>>MRT </option>
         <option value="MTQ"<?php if (!(strcmp('MTQ',$aDefaultForm['cbo_pais_origen']))) {echo " selected=\"selected\"";}?>>MTQ </option>
         <option value="MYS"<?php if (!(strcmp('MYS',$aDefaultForm['cbo_pais_origen']))) {echo " selected=\"selected\"";}?>>MYS </option>
         <option value="NAM"<?php if (!(strcmp('NAM',$aDefaultForm['cbo_pais_origen']))) {echo " selected=\"selected\"";}?>>NAM </option>
         <option value="NCL"<?php if (!(strcmp('NCL',$aDefaultForm['cbo_pais_origen']))) {echo " selected=\"selected\"";}?>>NCL </option>
         <option value="NER"<?php if (!(strcmp('NER',$aDefaultForm['cbo_pais_origen']))) {echo " selected=\"selected\"";}?>>NER </option>
         <option value="NGA"<?php if (!(strcmp('NGA',$aDefaultForm['cbo_pais_origen']))) {echo " selected=\"selected\"";}?>>NGA </option>
         <option value="NIC"<?php if (!(strcmp('NIC',$aDefaultForm['cbo_pais_origen']))) {echo " selected=\"selected\"";}?>>NIC </option>
         <option value="NLD"<?php if (!(strcmp('NLD',$aDefaultForm['cbo_pais_origen']))) {echo " selected=\"selected\"";}?>>NLD </option>
         <option value="NOR"<?php if (!(strcmp('NOR',$aDefaultForm['cbo_pais_origen']))) {echo " selected=\"selected\"";}?>>NOR </option>
         <option value="NPL"<?php if (!(strcmp('NPL',$aDefaultForm['cbo_pais_origen']))) {echo " selected=\"selected\"";}?>>NPL </option>
         <option value="NRU"<?php if (!(strcmp('NRU',$aDefaultForm['cbo_pais_origen']))) {echo " selected=\"selected\"";}?>>NRU </option>
         <option value="NTZ"<?php if (!(strcmp('NTZ',$aDefaultForm['cbo_pais_origen']))) {echo " selected=\"selected\"";}?>>NTZ </option>
         <option value="NZL"<?php if (!(strcmp('NZL',$aDefaultForm['cbo_pais_origen']))) {echo " selected=\"selected\"";}?>>NZL </option>
         <option value="OMN"<?php if (!(strcmp('OMN',$aDefaultForm['cbo_pais_origen']))) {echo " selected=\"selected\"";}?>>OMN </option>
         <option value="PAK"<?php if (!(strcmp('PAK',$aDefaultForm['cbo_pais_origen']))) {echo " selected=\"selected\"";}?>>PAK </option>
         <option value="PAN"<?php if (!(strcmp('PAN',$aDefaultForm['cbo_pais_origen']))) {echo " selected=\"selected\"";}?>>PAN </option>
         <option value="PER"<?php if (!(strcmp('PER',$aDefaultForm['cbo_pais_origen']))) {echo " selected=\"selected\"";}?>>PER </option>
         <option value="PHL"<?php if (!(strcmp('PHL',$aDefaultForm['cbo_pais_origen']))) {echo " selected=\"selected\"";}?>>PHL </option>
         <option value="POL"<?php if (!(strcmp('POL',$aDefaultForm['cbo_pais_origen']))) {echo " selected=\"selected\"";}?>>POL </option>
         <option value="PRI"<?php if (!(strcmp('PRI',$aDefaultForm['cbo_pais_origen']))) {echo " selected=\"selected\"";}?>>PRI </option>
         <option value="PRK"<?php if (!(strcmp('PRK',$aDefaultForm['cbo_pais_origen']))) {echo " selected=\"selected\"";}?>>PRK </option>
         <option value="PRT"<?php if (!(strcmp('PRT',$aDefaultForm['cbo_pais_origen']))) {echo " selected=\"selected\"";}?>>PRT </option>
         <option value="PRY"<?php if (!(strcmp('PRY',$aDefaultForm['cbo_pais_origen']))) {echo " selected=\"selected\"";}?>>PRY </option>
         <option value="PSE"<?php if (!(strcmp('PSE',$aDefaultForm['cbo_pais_origen']))) {echo " selected=\"selected\"";}?>>PSE </option>
         <option value="QAT"<?php if (!(strcmp('QAT',$aDefaultForm['cbo_pais_origen']))) {echo " selected=\"selected\"";}?>>QAT </option>
         <option value="REU"<?php if (!(strcmp('REU',$aDefaultForm['cbo_pais_origen']))) {echo " selected=\"selected\"";}?>>REU </option>
         <option value="ROU"<?php if (!(strcmp('ROU',$aDefaultForm['cbo_pais_origen']))) {echo " selected=\"selected\"";}?>>ROU </option>
         <option value="RUS"<?php if (!(strcmp('RUS',$aDefaultForm['cbo_pais_origen']))) {echo " selected=\"selected\"";}?>>RUS </option>
         <option value="RWA"<?php if (!(strcmp('RWA',$aDefaultForm['cbo_pais_origen']))) {echo " selected=\"selected\"";}?>>RWA </option>
         <option value="SAU"<?php if (!(strcmp('SAU',$aDefaultForm['cbo_pais_origen']))) {echo " selected=\"selected\"";}?>>SAU </option>
         <option value="SCG"<?php if (!(strcmp('SCG',$aDefaultForm['cbo_pais_origen']))) {echo " selected=\"selected\"";}?>>SCG </option>
         <option value="SDN"<?php if (!(strcmp('SDN',$aDefaultForm['cbo_pais_origen']))) {echo " selected=\"selected\"";}?>>SDN </option>
         <option value="SEN"<?php if (!(strcmp('SEN',$aDefaultForm['cbo_pais_origen']))) {echo " selected=\"selected\"";}?>>SEN </option>
         <option value="SGP"<?php if (!(strcmp('SGP',$aDefaultForm['cbo_pais_origen']))) {echo " selected=\"selected\"";}?>>SGP </option>
         <option value="SLE"<?php if (!(strcmp('SLE',$aDefaultForm['cbo_pais_origen']))) {echo " selected=\"selected\"";}?>>SLE </option>
         <option value="SLV"<?php if (!(strcmp('SLV',$aDefaultForm['cbo_pais_origen']))) {echo " selected=\"selected\"";}?>>SLV </option>
         <option value="SMR"<?php if (!(strcmp('SMR',$aDefaultForm['cbo_pais_origen']))) {echo " selected=\"selected\"";}?>>SMR </option>
         <option value="SOM"<?php if (!(strcmp('SOM',$aDefaultForm['cbo_pais_origen']))) {echo " selected=\"selected\"";}?>>SOM </option>
         <option value="STP"<?php if (!(strcmp('STP',$aDefaultForm['cbo_pais_origen']))) {echo " selected=\"selected\"";}?>>STP </option>
         <option value="SUI"<?php if (!(strcmp('SUI',$aDefaultForm['cbo_pais_origen']))) {echo " selected=\"selected\"";}?>>SUI </option>
         <option value="SUR"<?php if (!(strcmp('SUR',$aDefaultForm['cbo_pais_origen']))) {echo " selected=\"selected\"";}?>>SUR </option>
         <option value="SVK"<?php if (!(strcmp('SVK',$aDefaultForm['cbo_pais_origen']))) {echo " selected=\"selected\"";}?>>SVK </option>
         <option value="SVN"<?php if (!(strcmp('SVN',$aDefaultForm['cbo_pais_origen']))) {echo " selected=\"selected\"";}?>>SVN </option>
         <option value="SWE"<?php if (!(strcmp('SWE',$aDefaultForm['cbo_pais_origen']))) {echo " selected=\"selected\"";}?>>SWE </option>
         <option value="SWZ"<?php if (!(strcmp('SWZ',$aDefaultForm['cbo_pais_origen']))) {echo " selected=\"selected\"";}?>>SWZ </option>
         <option value="SYC"<?php if (!(strcmp('SYC',$aDefaultForm['cbo_pais_origen']))) {echo " selected=\"selected\"";}?>>SYC </option>
         <option value="SYR"<?php if (!(strcmp('SYR',$aDefaultForm['cbo_pais_origen']))) {echo " selected=\"selected\"";}?>>SYR </option>
         <option value="TCD"<?php if (!(strcmp('TCD',$aDefaultForm['cbo_pais_origen']))) {echo " selected=\"selected\"";}?>>TCD </option>
         <option value="TGO"<?php if (!(strcmp('TGO',$aDefaultForm['cbo_pais_origen']))) {echo " selected=\"selected\"";}?>>TGO </option>
         <option value="THA"<?php if (!(strcmp('THA',$aDefaultForm['cbo_pais_origen']))) {echo " selected=\"selected\"";}?>>THA </option>
         <option value="TJK"<?php if (!(strcmp('TJK',$aDefaultForm['cbo_pais_origen']))) {echo " selected=\"selected\"";}?>>TJK </option>
         <option value="TLS"<?php if (!(strcmp('TLS',$aDefaultForm['cbo_pais_origen']))) {echo " selected=\"selected\"";}?>>TLS </option>
         <option value="TTO"<?php if (!(strcmp('TTO',$aDefaultForm['cbo_pais_origen']))) {echo " selected=\"selected\"";}?>>TTO </option>
         <option value="TUN"<?php if (!(strcmp('TUN',$aDefaultForm['cbo_pais_origen']))) {echo " selected=\"selected\"";}?>>TUN </option>
         <option value="TUR"<?php if (!(strcmp('TUR',$aDefaultForm['cbo_pais_origen']))) {echo " selected=\"selected\"";}?>>TUR </option>
         <option value="TWN"<?php if (!(strcmp('TWN',$aDefaultForm['cbo_pais_origen']))) {echo " selected=\"selected\"";}?>>TWN </option>
         <option value="TZA"<?php if (!(strcmp('TZA',$aDefaultForm['cbo_pais_origen']))) {echo " selected=\"selected\"";}?>>TZA </option>
         <option value="UGA"<?php if (!(strcmp('UGA',$aDefaultForm['cbo_pais_origen']))) {echo " selected=\"selected\"";}?>>UGA </option>
         <option value="UKR"<?php if (!(strcmp('UKR',$aDefaultForm['cbo_pais_origen']))) {echo " selected=\"selected\"";}?>>UKR </option>
         <option value="URS"<?php if (!(strcmp('URS',$aDefaultForm['cbo_pais_origen']))) {echo " selected=\"selected\"";}?>>URS </option>
         <option value="URY"<?php if (!(strcmp('URY',$aDefaultForm['cbo_pais_origen']))) {echo " selected=\"selected\"";}?>>URY </option>
         <option value="USA"<?php if (!(strcmp('USA',$aDefaultForm['cbo_pais_origen']))) {echo " selected=\"selected\"";}?>>USA </option>
         <option value="UZB"<?php if (!(strcmp('UZB',$aDefaultForm['cbo_pais_origen']))) {echo " selected=\"selected\"";}?>>UZB </option>
         <option value="VAT"<?php if (!(strcmp('VAT',$aDefaultForm['cbo_pais_origen']))) {echo " selected=\"selected\"";}?>>VAT </option>
         <option value="VCT"<?php if (!(strcmp('VCT',$aDefaultForm['cbo_pais_origen']))) {echo " selected=\"selected\"";}?>>VCT </option>
         <option value="VEN"<?php if (!(strcmp('VEN',$aDefaultForm['cbo_pais_origen']))) {echo " selected=\"selected\"";}?>>VEN </option>
         <option value="VGB"<?php if (!(strcmp('VGB',$aDefaultForm['cbo_pais_origen']))) {echo " selected=\"selected\"";}?>>VGB </option>
         <option value="VIR"<?php if (!(strcmp('VIR',$aDefaultForm['cbo_pais_origen']))) {echo " selected=\"selected\"";}?>>VIR </option>
         <option value="VNM"<?php if (!(strcmp('VNM',$aDefaultForm['cbo_pais_origen']))) {echo " selected=\"selected\"";}?>>VNM </option>
         <option value="VUT"<?php if (!(strcmp('VUT',$aDefaultForm['cbo_pais_origen']))) {echo " selected=\"selected\"";}?>>VUT </option>
         <option value="WLF"<?php if (!(strcmp('WLF',$aDefaultForm['cbo_pais_origen']))) {echo " selected=\"selected\"";}?>>WLF </option>
         <option value="WSM"<?php if (!(strcmp('WSM',$aDefaultForm['cbo_pais_origen']))) {echo " selected=\"selected\"";}?>>WSM </option>
         <option value="XXX"<?php if (!(strcmp('XXX',$aDefaultForm['cbo_pais_origen']))) {echo " selected=\"selected\"";}?>>XXX </option>
         <option value="YEM"<?php if (!(strcmp('YEM',$aDefaultForm['cbo_pais_origen']))) {echo " selected=\"selected\"";}?>>YEM </option>
         <option value="YUG"<?php if (!(strcmp('YUG',$aDefaultForm['cbo_pais_origen']))) {echo " selected=\"selected\"";}?>>YUG </option>
         <option value="ZAF"<?php if (!(strcmp('ZAF',$aDefaultForm['cbo_pais_origen']))) {echo " selected=\"selected\"";}?>>ZAF </option>
         <option value="ZMB"<?php if (!(strcmp('ZMB',$aDefaultForm['cbo_pais_origen']))) {echo " selected=\"selected\"";}?>>ZMB </option>
         <option value="ZWE"<?php if (!(strcmp('ZWE',$aDefaultForm['cbo_pais_origen']))) {echo " selected=\"selected\"";}?>>ZWE </option>
    </select>      
    	<span>*</span>
    </td>

    <td style="background-color:#F0F0F0;" align="center">
    <select id="cbo_pais_origen" name="cbo_pais_origen" >
        <option value=""<?php if (!(strcmp('',$aDefaultForm['cbo_nacionalidad']))) {echo " selected=\"selected\"";}?>>Seleccionar</option>
		 <option value="ABW"<?php if (!(strcmp('ABW ',$aDefaultForm['cbo_nacionalidad']))) {echo " selected=\"selected\"";}?>>ABW </option>
         <option value="AFG"<?php if (!(strcmp('AFG',$aDefaultForm['cbo_nacionalidad']))) {echo " selected=\"selected\"";}?>>AFG </option>
         <option value="AGO"<?php if (!(strcmp('AGO',$aDefaultForm['cbo_nacionalidad']))) {echo " selected=\"selected\"";}?>>AGO </option>
         <option value="ALB"<?php if (!(strcmp('ALB',$aDefaultForm['cbo_nacionalidad']))) {echo " selected=\"selected\"";}?>>ALB </option>
         <option value="AND"<?php if (!(strcmp('AND',$aDefaultForm['cbo_nacionalidad']))) {echo " selected=\"selected\"";}?>>AND </option>
         <option value="ANT"<?php if (!(strcmp('ANT',$aDefaultForm['cbo_nacionalidad']))) {echo " selected=\"selected\"";}?>>ANT </option>
         <option value="ARE"<?php if (!(strcmp('ARE',$aDefaultForm['cbo_nacionalidad']))) {echo " selected=\"selected\"";}?>>ARE </option>
         <option value="ARG"<?php if (!(strcmp('ARG',$aDefaultForm['cbo_nacionalidad']))) {echo " selected=\"selected\"";}?>>ARG </option>
         <option value="ARM"<?php if (!(strcmp('ARM',$aDefaultForm['cbo_nacionalidad']))) {echo " selected=\"selected\"";}?>>ARM </option>
         <option value="ATF"<?php if (!(strcmp('ATF',$aDefaultForm['cbo_nacionalidad']))) {echo " selected=\"selected\"";}?>>ATF </option>
         <option value="ATG"<?php if (!(strcmp('ATG',$aDefaultForm['cbo_nacionalidad']))) {echo " selected=\"selected\"";}?>>ATG </option>
         <option value="AUS"<?php if (!(strcmp('AUS',$aDefaultForm['cbo_nacionalidad']))) {echo " selected=\"selected\"";}?>>AUS </option>
         <option value="AUT"<?php if (!(strcmp('AUT',$aDefaultForm['cbo_nacionalidad']))) {echo " selected=\"selected\"";}?>>AUT </option>
         <option value="AZE"<?php if (!(strcmp('AZE',$aDefaultForm['cbo_nacionalidad']))) {echo " selected=\"selected\"";}?>>AZE </option>
         <option value="BDI"<?php if (!(strcmp('BDI',$aDefaultForm['cbo_nacionalidad']))) {echo " selected=\"selected\"";}?>>BDI </option>
         <option value="BEL"<?php if (!(strcmp('BEL',$aDefaultForm['cbo_nacionalidad']))) {echo " selected=\"selected\"";}?>>BEL </option>
         <option value="BEN"<?php if (!(strcmp('BEN',$aDefaultForm['cbo_nacionalidad']))) {echo " selected=\"selected\"";}?>>BEN </option>
         <option value="BFA"<?php if (!(strcmp('BFA',$aDefaultForm['cbo_nacionalidad']))) {echo " selected=\"selected\"";}?>>BFA </option>
         <option value="BGD"<?php if (!(strcmp('BGD',$aDefaultForm['cbo_nacionalidad']))) {echo " selected=\"selected\"";}?>>BGD </option>
         <option value="BGR"<?php if (!(strcmp('BGR',$aDefaultForm['cbo_nacionalidad']))) {echo " selected=\"selected\"";}?>>BGR </option>
         <option value="BHR"<?php if (!(strcmp('BHR',$aDefaultForm['cbo_nacionalidad']))) {echo " selected=\"selected\"";}?>>BHR </option>
         <option value="BHS"<?php if (!(strcmp('BHS',$aDefaultForm['cbo_nacionalidad']))) {echo " selected=\"selected\"";}?>>BHS </option>
         <option value="BIH"<?php if (!(strcmp('BIH',$aDefaultForm['cbo_nacionalidad']))) {echo " selected=\"selected\"";}?>>BIH </option>
         <option value="BLR"<?php if (!(strcmp('BLR',$aDefaultForm['cbo_nacionalidad']))) {echo " selected=\"selected\"";}?>>BLR </option>
         <option value="BLZ"<?php if (!(strcmp('BLZ',$aDefaultForm['cbo_nacionalidad']))) {echo " selected=\"selected\"";}?>>BLZ </option>
         <option value="BOL"<?php if (!(strcmp('BOL',$aDefaultForm['cbo_nacionalidad']))) {echo " selected=\"selected\"";}?>>BOL </option>
         <option value="BRA"<?php if (!(strcmp('BRA',$aDefaultForm['cbo_nacionalidad']))) {echo " selected=\"selected\"";}?>>BRA </option>
         <option value="BRB"<?php if (!(strcmp('BRB',$aDefaultForm['cbo_nacionalidad']))) {echo " selected=\"selected\"";}?>>BRB </option>
         <option value="BRN"<?php if (!(strcmp('BRN',$aDefaultForm['cbo_nacionalidad']))) {echo " selected=\"selected\"";}?>>BRN </option>
         <option value="BWA"<?php if (!(strcmp('BWA',$aDefaultForm['cbo_nacionalidad']))) {echo " selected=\"selected\"";}?>>BWA </option>
         <option value="CAF"<?php if (!(strcmp('CAF',$aDefaultForm['cbo_nacionalidad']))) {echo " selected=\"selected\"";}?>>CAF </option>
         <option value="CAN"<?php if (!(strcmp('CAN',$aDefaultForm['cbo_nacionalidad']))) {echo " selected=\"selected\"";}?>>CAN </option>
         <option value="CHE"<?php if (!(strcmp('CHE',$aDefaultForm['cbo_nacionalidad']))) {echo " selected=\"selected\"";}?>>CHE </option>
         <option value="CHL"<?php if (!(strcmp('CHL',$aDefaultForm['cbo_nacionalidad']))) {echo " selected=\"selected\"";}?>>CHL </option>
         <option value="CHN"<?php if (!(strcmp('CHN',$aDefaultForm['cbo_nacionalidad']))) {echo " selected=\"selected\"";}?>>CHN </option>
         <option value="CIV"<?php if (!(strcmp('CIV',$aDefaultForm['cbo_nacionalidad']))) {echo " selected=\"selected\"";}?>>CIV </option>
         <option value="CMR"<?php if (!(strcmp('CMR',$aDefaultForm['cbo_nacionalidad']))) {echo " selected=\"selected\"";}?>>CMR </option>
         <option value="COD"<?php if (!(strcmp('COD',$aDefaultForm['cbo_nacionalidad']))) {echo " selected=\"selected\"";}?>>COD </option>
         <option value="COG"<?php if (!(strcmp('COG',$aDefaultForm['cbo_nacionalidad']))) {echo " selected=\"selected\"";}?>>COG </option>
         <option value="COL"<?php if (!(strcmp('COL',$aDefaultForm['cbo_nacionalidad']))) {echo " selected=\"selected\"";}?>>COL </option>
         <option value="COM"<?php if (!(strcmp('COM',$aDefaultForm['cbo_nacionalidad']))) {echo " selected=\"selected\"";}?>>COM </option>
         <option value="CPV"<?php if (!(strcmp('CPV',$aDefaultForm['cbo_nacionalidad']))) {echo " selected=\"selected\"";}?>>CPV </option>
         <option value="CRI"<?php if (!(strcmp('CRI',$aDefaultForm['cbo_nacionalidad']))) {echo " selected=\"selected\"";}?>>CRI </option>
         <option value="CUB"<?php if (!(strcmp('CUB',$aDefaultForm['cbo_nacionalidad']))) {echo " selected=\"selected\"";}?>>CUB </option>
         <option value="CYM"<?php if (!(strcmp('CYM',$aDefaultForm['cbo_nacionalidad']))) {echo " selected=\"selected\"";}?>>CYM </option>
         <option value="CYP"<?php if (!(strcmp('CYP',$aDefaultForm['cbo_nacionalidad']))) {echo " selected=\"selected\"";}?>>CYP </option>
         <option value="CZE"<?php if (!(strcmp('CZE',$aDefaultForm['cbo_nacionalidad']))) {echo " selected=\"selected\"";}?>>CZE </option>
         <option value="DEU"<?php if (!(strcmp('DEU',$aDefaultForm['cbo_nacionalidad']))) {echo " selected=\"selected\"";}?>>DEU </option>
         <option value="DJI"<?php if (!(strcmp('DJI',$aDefaultForm['cbo_nacionalidad']))) {echo " selected=\"selected\"";}?>>DJI </option>
         <option value="DMA"<?php if (!(strcmp('DMA',$aDefaultForm['cbo_nacionalidad']))) {echo " selected=\"selected\"";}?>>DMA </option>
         <option value="DNK"<?php if (!(strcmp('DNK',$aDefaultForm['cbo_nacionalidad']))) {echo " selected=\"selected\"";}?>>DNK </option>
         <option value="DOM"<?php if (!(strcmp('DOM',$aDefaultForm['cbo_nacionalidad']))) {echo " selected=\"selected\"";}?>>DOM </option>
         <option value="DZA"<?php if (!(strcmp('DZA',$aDefaultForm['cbo_nacionalidad']))) {echo " selected=\"selected\"";}?>>DZA </option>
         <option value="ECU"<?php if (!(strcmp('ECU',$aDefaultForm['cbo_nacionalidad']))) {echo " selected=\"selected\"";}?>>ECU </option>
         <option value="EGY"<?php if (!(strcmp('EGY',$aDefaultForm['cbo_nacionalidad']))) {echo " selected=\"selected\"";}?>>EGY </option>
         <option value="ERI"<?php if (!(strcmp('ERI',$aDefaultForm['cbo_nacionalidad']))) {echo " selected=\"selected\"";}?>>ERI </option>
         <option value="ESH"<?php if (!(strcmp('ESH',$aDefaultForm['cbo_nacionalidad']))) {echo " selected=\"selected\"";}?>>ESH </option>
         <option value="ESP"<?php if (!(strcmp('ESP',$aDefaultForm['cbo_nacionalidad']))) {echo " selected=\"selected\"";}?>>ESP </option>
         <option value="EST"<?php if (!(strcmp('EST',$aDefaultForm['cbo_nacionalidad']))) {echo " selected=\"selected\"";}?>>EST </option>
         <option value="ETH"<?php if (!(strcmp('ETH',$aDefaultForm['cbo_nacionalidad']))) {echo " selected=\"selected\"";}?>>ETH </option>
         <option value="FIN"<?php if (!(strcmp('FIN',$aDefaultForm['cbo_nacionalidad']))) {echo " selected=\"selected\"";}?>>FIN </option>
         <option value="FJI"<?php if (!(strcmp('FJI',$aDefaultForm['cbo_nacionalidad']))) {echo " selected=\"selected\"";}?>>FJI </option>
         <option value="FRA"<?php if (!(strcmp('FRA',$aDefaultForm['cbo_nacionalidad']))) {echo " selected=\"selected\"";}?>>FRA </option>
         <option value="FXX"<?php if (!(strcmp('FXX',$aDefaultForm['cbo_nacionalidad']))) {echo " selected=\"selected\"";}?>>FXX </option>
         <option value="GAB"<?php if (!(strcmp('GAB',$aDefaultForm['cbo_nacionalidad']))) {echo " selected=\"selected\"";}?>>GAB </option>
         <option value="GBR"<?php if (!(strcmp('GBR',$aDefaultForm['cbo_nacionalidad']))) {echo " selected=\"selected\"";}?>>GBR </option>
         <option value="GEO"<?php if (!(strcmp('GEO',$aDefaultForm['cbo_nacionalidad']))) {echo " selected=\"selected\"";}?>>GEO </option>
         <option value="GHA"<?php if (!(strcmp('GHA',$aDefaultForm['cbo_nacionalidad']))) {echo " selected=\"selected\"";}?>>GHA </option>
         <option value="GIB"<?php if (!(strcmp('GIB',$aDefaultForm['cbo_nacionalidad']))) {echo " selected=\"selected\"";}?>>GIB </option>
         <option value="GIN"<?php if (!(strcmp('GIN',$aDefaultForm['cbo_nacionalidad']))) {echo " selected=\"selected\"";}?>>GIN </option>
         <option value="GLP"<?php if (!(strcmp('GLP',$aDefaultForm['cbo_nacionalidad']))) {echo " selected=\"selected\"";}?>>GLP </option>
         <option value="GMB"<?php if (!(strcmp('GMB',$aDefaultForm['cbo_nacionalidad']))) {echo " selected=\"selected\"";}?>>GMB </option>
         <option value="GNB"<?php if (!(strcmp('GNB',$aDefaultForm['cbo_nacionalidad']))) {echo " selected=\"selected\"";}?>>GNB </option>
         <option value="GNQ"<?php if (!(strcmp('GNQ',$aDefaultForm['cbo_nacionalidad']))) {echo " selected=\"selected\"";}?>>GNQ </option>
         <option value="GRC"<?php if (!(strcmp('GRC',$aDefaultForm['cbo_nacionalidad']))) {echo " selected=\"selected\"";}?>>GRC </option>
         <option value="GRD"<?php if (!(strcmp('GRD',$aDefaultForm['cbo_nacionalidad']))) {echo " selected=\"selected\"";}?>>GRD </option>
         <option value="GTM"<?php if (!(strcmp('GTM',$aDefaultForm['cbo_nacionalidad']))) {echo " selected=\"selected\"";}?>>GTM </option>
         <option value="GUF"<?php if (!(strcmp('GUF',$aDefaultForm['cbo_nacionalidad']))) {echo " selected=\"selected\"";}?>>GUF </option>
         <option value="GUM"<?php if (!(strcmp('GUM',$aDefaultForm['cbo_nacionalidad']))) {echo " selected=\"selected\"";}?>>GUM </option>
         <option value="GUY"<?php if (!(strcmp('GUY',$aDefaultForm['cbo_nacionalidad']))) {echo " selected=\"selected\"";}?>>GUY </option>
         <option value="HKG"<?php if (!(strcmp('HKG',$aDefaultForm['cbo_nacionalidad']))) {echo " selected=\"selected\"";}?>>HKG </option>
         <option value="HND"<?php if (!(strcmp('HND',$aDefaultForm['cbo_nacionalidad']))) {echo " selected=\"selected\"";}?>>HND </option>
         <option value="HRV"<?php if (!(strcmp('HRV',$aDefaultForm['cbo_nacionalidad']))) {echo " selected=\"selected\"";}?>>HRV </option>
         <option value="HTI"<?php if (!(strcmp('HTI',$aDefaultForm['cbo_nacionalidad']))) {echo " selected=\"selected\"";}?>>HTI </option>
         <option value="HUN"<?php if (!(strcmp('HUN',$aDefaultForm['cbo_nacionalidad']))) {echo " selected=\"selected\"";}?>>HUN </option>
         <option value="IDN"<?php if (!(strcmp('IDN',$aDefaultForm['cbo_nacionalidad']))) {echo " selected=\"selected\"";}?>>IDN </option>
         <option value="IND"<?php if (!(strcmp('IND',$aDefaultForm['cbo_nacionalidad']))) {echo " selected=\"selected\"";}?>>IND </option>
         <option value="IOT"<?php if (!(strcmp('IOT',$aDefaultForm['cbo_nacionalidad']))) {echo " selected=\"selected\"";}?>>IOT </option>
         <option value="IRL"<?php if (!(strcmp('IRL',$aDefaultForm['cbo_nacionalidad']))) {echo " selected=\"selected\"";}?>>IRL </option>
         <option value="IRN"<?php if (!(strcmp('IRN',$aDefaultForm['cbo_nacionalidad']))) {echo " selected=\"selected\"";}?>>IRN </option>
         <option value="IRQ"<?php if (!(strcmp('IRQ',$aDefaultForm['cbo_nacionalidad']))) {echo " selected=\"selected\"";}?>>IRQ </option>
         <option value="ISL"<?php if (!(strcmp('ISL',$aDefaultForm['cbo_nacionalidad']))) {echo " selected=\"selected\"";}?>>ISL </option>
         <option value="ISR"<?php if (!(strcmp('ISR',$aDefaultForm['cbo_nacionalidad']))) {echo " selected=\"selected\"";}?>>ISR </option>
         <option value="ITA"<?php if (!(strcmp('ITA',$aDefaultForm['cbo_nacionalidad']))) {echo " selected=\"selected\"";}?>>ITA </option>
         <option value="JAM"<?php if (!(strcmp('JAM',$aDefaultForm['cbo_nacionalidad']))) {echo " selected=\"selected\"";}?>>JAM </option>
         <option value="JAP"<?php if (!(strcmp('JAP',$aDefaultForm['cbo_nacionalidad']))) {echo " selected=\"selected\"";}?>>JAP </option>
         <option value="JOR"<?php if (!(strcmp('JOR',$aDefaultForm['cbo_nacionalidad']))) {echo " selected=\"selected\"";}?>>JOR </option>
         <option value="JPN"<?php if (!(strcmp('JPN',$aDefaultForm['cbo_nacionalidad']))) {echo " selected=\"selected\"";}?>>JPN </option>
         <option value="KAZ"<?php if (!(strcmp('KAZ',$aDefaultForm['cbo_nacionalidad']))) {echo " selected=\"selected\"";}?>>KAZ </option>
         <option value="KEN"<?php if (!(strcmp('KEN',$aDefaultForm['cbo_nacionalidad']))) {echo " selected=\"selected\"";}?>>KEN </option>
         <option value="KGZ"<?php if (!(strcmp('KGZ',$aDefaultForm['cbo_nacionalidad']))) {echo " selected=\"selected\"";}?>>KGZ </option>
         <option value="KHM"<?php if (!(strcmp('KHM',$aDefaultForm['cbo_nacionalidad']))) {echo " selected=\"selected\"";}?>>KHM </option>
         <option value="KNA"<?php if (!(strcmp('KNA',$aDefaultForm['cbo_nacionalidad']))) {echo " selected=\"selected\"";}?>>KNA </option>
         <option value="KOR"<?php if (!(strcmp('KOR',$aDefaultForm['cbo_nacionalidad']))) {echo " selected=\"selected\"";}?>>KOR </option>
         <option value="KWT"<?php if (!(strcmp('KWT',$aDefaultForm['cbo_nacionalidad']))) {echo " selected=\"selected\"";}?>>KWT </option>
         <option value="LAO"<?php if (!(strcmp('LAO',$aDefaultForm['cbo_nacionalidad']))) {echo " selected=\"selected\"";}?>>LAO </option>
         <option value="LBN"<?php if (!(strcmp('LBN',$aDefaultForm['cbo_nacionalidad']))) {echo " selected=\"selected\"";}?>>LBN </option>
         <option value="LBR"<?php if (!(strcmp('LBR',$aDefaultForm['cbo_nacionalidad']))) {echo " selected=\"selected\"";}?>>LBR </option>
         <option value="LBY"<?php if (!(strcmp('LBY',$aDefaultForm['cbo_nacionalidad']))) {echo " selected=\"selected\"";}?>>LBY </option>
         <option value="LCA"<?php if (!(strcmp('LCA',$aDefaultForm['cbo_nacionalidad']))) {echo " selected=\"selected\"";}?>>LCA </option>
         <option value="LIE"<?php if (!(strcmp('LIE',$aDefaultForm['cbo_nacionalidad']))) {echo " selected=\"selected\"";}?>>LIE </option>
         <option value="LKA"<?php if (!(strcmp('LKA',$aDefaultForm['cbo_nacionalidad']))) {echo " selected=\"selected\"";}?>>LKA </option>
         <option value="LTU"<?php if (!(strcmp('LTU',$aDefaultForm['cbo_nacionalidad']))) {echo " selected=\"selected\"";}?>>LTU </option>
         <option value="LUX"<?php if (!(strcmp('LUX',$aDefaultForm['cbo_nacionalidad']))) {echo " selected=\"selected\"";}?>>LUX </option>
         <option value="LVA"<?php if (!(strcmp('LVA',$aDefaultForm['cbo_nacionalidad']))) {echo " selected=\"selected\"";}?>>LVA </option>
         <option value="MAC"<?php if (!(strcmp('MAC',$aDefaultForm['cbo_nacionalidad']))) {echo " selected=\"selected\"";}?>>MAC </option>
         <option value="MAR"<?php if (!(strcmp('MAR',$aDefaultForm['cbo_nacionalidad']))) {echo " selected=\"selected\"";}?>>MAR </option>
         <option value="MCO"<?php if (!(strcmp('MCO',$aDefaultForm['cbo_nacionalidad']))) {echo " selected=\"selected\"";}?>>MCO </option>
         <option value="MDA"<?php if (!(strcmp('MDA',$aDefaultForm['cbo_nacionalidad']))) {echo " selected=\"selected\"";}?>>MDA </option>
         <option value="MDG"<?php if (!(strcmp('MDG',$aDefaultForm['cbo_nacionalidad']))) {echo " selected=\"selected\"";}?>>MDG </option>
         <option value="MEX"<?php if (!(strcmp('MEX',$aDefaultForm['cbo_nacionalidad']))) {echo " selected=\"selected\"";}?>>MEX </option>
         <option value="MHL"<?php if (!(strcmp('MHL',$aDefaultForm['cbo_nacionalidad']))) {echo " selected=\"selected\"";}?>>MHL </option>
         <option value="MKD"<?php if (!(strcmp('MKD',$aDefaultForm['cbo_nacionalidad']))) {echo " selected=\"selected\"";}?>>MKD </option>
         <option value="MLI"<?php if (!(strcmp('MLI',$aDefaultForm['cbo_nacionalidad']))) {echo " selected=\"selected\"";}?>>MLI </option>
         <option value="MLT"<?php if (!(strcmp('MLT',$aDefaultForm['cbo_nacionalidad']))) {echo " selected=\"selected\"";}?>>MLT </option>
         <option value="MNG"<?php if (!(strcmp('MNG',$aDefaultForm['cbo_nacionalidad']))) {echo " selected=\"selected\"";}?>>MNG </option>
         <option value="MOZ"<?php if (!(strcmp('MOZ',$aDefaultForm['cbo_nacionalidad']))) {echo " selected=\"selected\"";}?>>MOZ </option>
         <option value="MRT"<?php if (!(strcmp('MRT',$aDefaultForm['cbo_nacionalidad']))) {echo " selected=\"selected\"";}?>>MRT </option>
         <option value="MTQ"<?php if (!(strcmp('MTQ',$aDefaultForm['cbo_nacionalidad']))) {echo " selected=\"selected\"";}?>>MTQ </option>
         <option value="MYS"<?php if (!(strcmp('MYS',$aDefaultForm['cbo_nacionalidad']))) {echo " selected=\"selected\"";}?>>MYS </option>
         <option value="NAM"<?php if (!(strcmp('NAM',$aDefaultForm['cbo_nacionalidad']))) {echo " selected=\"selected\"";}?>>NAM </option>
         <option value="NCL"<?php if (!(strcmp('NCL',$aDefaultForm['cbo_nacionalidad']))) {echo " selected=\"selected\"";}?>>NCL </option>
         <option value="NER"<?php if (!(strcmp('NER',$aDefaultForm['cbo_nacionalidad']))) {echo " selected=\"selected\"";}?>>NER </option>
         <option value="NGA"<?php if (!(strcmp('NGA',$aDefaultForm['cbo_nacionalidad']))) {echo " selected=\"selected\"";}?>>NGA </option>
         <option value="NIC"<?php if (!(strcmp('NIC',$aDefaultForm['cbo_nacionalidad']))) {echo " selected=\"selected\"";}?>>NIC </option>
         <option value="NLD"<?php if (!(strcmp('NLD',$aDefaultForm['cbo_nacionalidad']))) {echo " selected=\"selected\"";}?>>NLD </option>
         <option value="NOR"<?php if (!(strcmp('NOR',$aDefaultForm['cbo_nacionalidad']))) {echo " selected=\"selected\"";}?>>NOR </option>
         <option value="NPL"<?php if (!(strcmp('NPL',$aDefaultForm['cbo_nacionalidad']))) {echo " selected=\"selected\"";}?>>NPL </option>
         <option value="NRU"<?php if (!(strcmp('NRU',$aDefaultForm['cbo_nacionalidad']))) {echo " selected=\"selected\"";}?>>NRU </option>
         <option value="NTZ"<?php if (!(strcmp('NTZ',$aDefaultForm['cbo_nacionalidad']))) {echo " selected=\"selected\"";}?>>NTZ </option>
         <option value="NZL"<?php if (!(strcmp('NZL',$aDefaultForm['cbo_nacionalidad']))) {echo " selected=\"selected\"";}?>>NZL </option>
         <option value="OMN"<?php if (!(strcmp('OMN',$aDefaultForm['cbo_nacionalidad']))) {echo " selected=\"selected\"";}?>>OMN </option>
         <option value="PAK"<?php if (!(strcmp('PAK',$aDefaultForm['cbo_nacionalidad']))) {echo " selected=\"selected\"";}?>>PAK </option>
         <option value="PAN"<?php if (!(strcmp('PAN',$aDefaultForm['cbo_nacionalidad']))) {echo " selected=\"selected\"";}?>>PAN </option>
         <option value="PER"<?php if (!(strcmp('PER',$aDefaultForm['cbo_nacionalidad']))) {echo " selected=\"selected\"";}?>>PER </option>
         <option value="PHL"<?php if (!(strcmp('PHL',$aDefaultForm['cbo_nacionalidad']))) {echo " selected=\"selected\"";}?>>PHL </option>
         <option value="POL"<?php if (!(strcmp('POL',$aDefaultForm['cbo_nacionalidad']))) {echo " selected=\"selected\"";}?>>POL </option>
         <option value="PRI"<?php if (!(strcmp('PRI',$aDefaultForm['cbo_nacionalidad']))) {echo " selected=\"selected\"";}?>>PRI </option>
         <option value="PRK"<?php if (!(strcmp('PRK',$aDefaultForm['cbo_nacionalidad']))) {echo " selected=\"selected\"";}?>>PRK </option>
         <option value="PRT"<?php if (!(strcmp('PRT',$aDefaultForm['cbo_nacionalidad']))) {echo " selected=\"selected\"";}?>>PRT </option>
         <option value="PRY"<?php if (!(strcmp('PRY',$aDefaultForm['cbo_nacionalidad']))) {echo " selected=\"selected\"";}?>>PRY </option>
         <option value="PSE"<?php if (!(strcmp('PSE',$aDefaultForm['cbo_nacionalidad']))) {echo " selected=\"selected\"";}?>>PSE </option>
         <option value="QAT"<?php if (!(strcmp('QAT',$aDefaultForm['cbo_nacionalidad']))) {echo " selected=\"selected\"";}?>>QAT </option>
         <option value="REU"<?php if (!(strcmp('REU',$aDefaultForm['cbo_nacionalidad']))) {echo " selected=\"selected\"";}?>>REU </option>
         <option value="ROU"<?php if (!(strcmp('ROU',$aDefaultForm['cbo_nacionalidad']))) {echo " selected=\"selected\"";}?>>ROU </option>
         <option value="RUS"<?php if (!(strcmp('RUS',$aDefaultForm['cbo_nacionalidad']))) {echo " selected=\"selected\"";}?>>RUS </option>
         <option value="RWA"<?php if (!(strcmp('RWA',$aDefaultForm['cbo_nacionalidad']))) {echo " selected=\"selected\"";}?>>RWA </option>
         <option value="SAU"<?php if (!(strcmp('SAU',$aDefaultForm['cbo_nacionalidad']))) {echo " selected=\"selected\"";}?>>SAU </option>
         <option value="SCG"<?php if (!(strcmp('SCG',$aDefaultForm['cbo_nacionalidad']))) {echo " selected=\"selected\"";}?>>SCG </option>
         <option value="SDN"<?php if (!(strcmp('SDN',$aDefaultForm['cbo_nacionalidad']))) {echo " selected=\"selected\"";}?>>SDN </option>
         <option value="SEN"<?php if (!(strcmp('SEN',$aDefaultForm['cbo_nacionalidad']))) {echo " selected=\"selected\"";}?>>SEN </option>
         <option value="SGP"<?php if (!(strcmp('SGP',$aDefaultForm['cbo_nacionalidad']))) {echo " selected=\"selected\"";}?>>SGP </option>
         <option value="SLE"<?php if (!(strcmp('SLE',$aDefaultForm['cbo_nacionalidad']))) {echo " selected=\"selected\"";}?>>SLE </option>
         <option value="SLV"<?php if (!(strcmp('SLV',$aDefaultForm['cbo_nacionalidad']))) {echo " selected=\"selected\"";}?>>SLV </option>
         <option value="SMR"<?php if (!(strcmp('SMR',$aDefaultForm['cbo_nacionalidad']))) {echo " selected=\"selected\"";}?>>SMR </option>
         <option value="SOM"<?php if (!(strcmp('SOM',$aDefaultForm['cbo_nacionalidad']))) {echo " selected=\"selected\"";}?>>SOM </option>
         <option value="STP"<?php if (!(strcmp('STP',$aDefaultForm['cbo_nacionalidad']))) {echo " selected=\"selected\"";}?>>STP </option>
         <option value="SUI"<?php if (!(strcmp('SUI',$aDefaultForm['cbo_nacionalidad']))) {echo " selected=\"selected\"";}?>>SUI </option>
         <option value="SUR"<?php if (!(strcmp('SUR',$aDefaultForm['cbo_nacionalidad']))) {echo " selected=\"selected\"";}?>>SUR </option>
         <option value="SVK"<?php if (!(strcmp('SVK',$aDefaultForm['cbo_nacionalidad']))) {echo " selected=\"selected\"";}?>>SVK </option>
         <option value="SVN"<?php if (!(strcmp('SVN',$aDefaultForm['cbo_nacionalidad']))) {echo " selected=\"selected\"";}?>>SVN </option>
         <option value="SWE"<?php if (!(strcmp('SWE',$aDefaultForm['cbo_nacionalidad']))) {echo " selected=\"selected\"";}?>>SWE </option>
         <option value="SWZ"<?php if (!(strcmp('SWZ',$aDefaultForm['cbo_nacionalidad']))) {echo " selected=\"selected\"";}?>>SWZ </option>
         <option value="SYC"<?php if (!(strcmp('SYC',$aDefaultForm['cbo_nacionalidad']))) {echo " selected=\"selected\"";}?>>SYC </option>
         <option value="SYR"<?php if (!(strcmp('SYR',$aDefaultForm['cbo_nacionalidad']))) {echo " selected=\"selected\"";}?>>SYR </option>
         <option value="TCD"<?php if (!(strcmp('TCD',$aDefaultForm['cbo_nacionalidad']))) {echo " selected=\"selected\"";}?>>TCD </option>
         <option value="TGO"<?php if (!(strcmp('TGO',$aDefaultForm['cbo_nacionalidad']))) {echo " selected=\"selected\"";}?>>TGO </option>
         <option value="THA"<?php if (!(strcmp('THA',$aDefaultForm['cbo_nacionalidad']))) {echo " selected=\"selected\"";}?>>THA </option>
         <option value="TJK"<?php if (!(strcmp('TJK',$aDefaultForm['cbo_nacionalidad']))) {echo " selected=\"selected\"";}?>>TJK </option>
         <option value="TLS"<?php if (!(strcmp('TLS',$aDefaultForm['cbo_nacionalidad']))) {echo " selected=\"selected\"";}?>>TLS </option>
         <option value="TTO"<?php if (!(strcmp('TTO',$aDefaultForm['cbo_nacionalidad']))) {echo " selected=\"selected\"";}?>>TTO </option>
         <option value="TUN"<?php if (!(strcmp('TUN',$aDefaultForm['cbo_nacionalidad']))) {echo " selected=\"selected\"";}?>>TUN </option>
         <option value="TUR"<?php if (!(strcmp('TUR',$aDefaultForm['cbo_nacionalidad']))) {echo " selected=\"selected\"";}?>>TUR </option>
         <option value="TWN"<?php if (!(strcmp('TWN',$aDefaultForm['cbo_nacionalidad']))) {echo " selected=\"selected\"";}?>>TWN </option>
         <option value="TZA"<?php if (!(strcmp('TZA',$aDefaultForm['cbo_nacionalidad']))) {echo " selected=\"selected\"";}?>>TZA </option>
         <option value="UGA"<?php if (!(strcmp('UGA',$aDefaultForm['cbo_nacionalidad']))) {echo " selected=\"selected\"";}?>>UGA </option>
         <option value="UKR"<?php if (!(strcmp('UKR',$aDefaultForm['cbo_nacionalidad']))) {echo " selected=\"selected\"";}?>>UKR </option>
         <option value="URS"<?php if (!(strcmp('URS',$aDefaultForm['cbo_nacionalidad']))) {echo " selected=\"selected\"";}?>>URS </option>
         <option value="URY"<?php if (!(strcmp('URY',$aDefaultForm['cbo_nacionalidad']))) {echo " selected=\"selected\"";}?>>URY </option>
         <option value="USA"<?php if (!(strcmp('USA',$aDefaultForm['cbo_nacionalidad']))) {echo " selected=\"selected\"";}?>>USA </option>
         <option value="UZB"<?php if (!(strcmp('UZB',$aDefaultForm['cbo_nacionalidad']))) {echo " selected=\"selected\"";}?>>UZB </option>
         <option value="VAT"<?php if (!(strcmp('VAT',$aDefaultForm['cbo_nacionalidad']))) {echo " selected=\"selected\"";}?>>VAT </option>
         <option value="VCT"<?php if (!(strcmp('VCT',$aDefaultForm['cbo_nacionalidad']))) {echo " selected=\"selected\"";}?>>VCT </option>
         <option value="VEN"<?php if (!(strcmp('VEN',$aDefaultForm['cbo_nacionalidad']))) {echo " selected=\"selected\"";}?>>VEN </option>
         <option value="VGB"<?php if (!(strcmp('VGB',$aDefaultForm['cbo_nacionalidad']))) {echo " selected=\"selected\"";}?>>VGB </option>
         <option value="VIR"<?php if (!(strcmp('VIR',$aDefaultForm['cbo_nacionalidad']))) {echo " selected=\"selected\"";}?>>VIR </option>
         <option value="VNM"<?php if (!(strcmp('VNM',$aDefaultForm['cbo_nacionalidad']))) {echo " selected=\"selected\"";}?>>VNM </option>
         <option value="VUT"<?php if (!(strcmp('VUT',$aDefaultForm['cbo_nacionalidad']))) {echo " selected=\"selected\"";}?>>VUT </option>
         <option value="WLF"<?php if (!(strcmp('WLF',$aDefaultForm['cbo_nacionalidad']))) {echo " selected=\"selected\"";}?>>WLF </option>
         <option value="WSM"<?php if (!(strcmp('WSM',$aDefaultForm['cbo_nacionalidad']))) {echo " selected=\"selected\"";}?>>WSM </option>
         <option value="XXX"<?php if (!(strcmp('XXX',$aDefaultForm['cbo_nacionalidad']))) {echo " selected=\"selected\"";}?>>XXX </option>
         <option value="YEM"<?php if (!(strcmp('YEM',$aDefaultForm['cbo_nacionalidad']))) {echo " selected=\"selected\"";}?>>YEM </option>
         <option value="YUG"<?php if (!(strcmp('YUG',$aDefaultForm['cbo_nacionalidad']))) {echo " selected=\"selected\"";}?>>YUG </option>
         <option value="ZAF"<?php if (!(strcmp('ZAF',$aDefaultForm['cbo_nacionalidad']))) {echo " selected=\"selected\"";}?>>ZAF </option>
         <option value="ZMB"<?php if (!(strcmp('ZMB',$aDefaultForm['cbo_nacionalidad']))) {echo " selected=\"selected\"";}?>>ZMB </option>
         <option value="ZWE"<?php if (!(strcmp('ZWE',$aDefaultForm['cbo_nacionalidad']))) {echo " selected=\"selected\"";}?>>ZWE </option>
    </select>      
    	<span>*</span>
    </td>
  </tr>
<tr>
    <th width="23%" class="separacion_20"></th>
  </tr>
  <tr>
    <th colspan="4" height="40" >
    <div align="center">
    <button type="button" name="guardar"  id="guardar"class="button_personal btn_guardar" title="Guardar Registro -  Haga Click para Guardar">Guardar
    </button>         
   <?  if($_SESSION['sistema']=='OFICINA ATENCION AL CIUDADANO'){?>
     <button type="button" id="enviar2" name="enviar2" class="button_personal btn_regresar" title="Regresar -  Haga Click para Regresar" onClick="send('regresar')"  >Regresar</button>
     <? } ?>
    </div>
    </th>
  </tr>
 </form>    		

	</tbody>
</table>
	
<?php include("../footer.php"); ?>