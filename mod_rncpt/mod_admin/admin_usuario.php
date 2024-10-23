<?php 
include("../../header.php"); 
//sinclude("general_LoadCombo.php");

$settings['debug'] = false;
$conn= getConnDB($db1);
$conn->debug = $settings['debug'];
debug();
function LoadSistema($conn){  
	$sHtml_Var = "sHtml_cb_Sistemas";
	if (!isset($GLOBALS[$sHtml_Var])){
		$GLOBALS[$sHtml_Var] = '';
	}	
	if ($GLOBALS[$sHtml_Var] == ''){
		$sSQL="SELECT id, sdescripcion FROM modulo WHERE senabled = 1 AND id NOT IN(9) ORDER BY sdescripcion;";		
		$rs = &$conn->Execute($sSQL); 
		while ( !$rs->EOF ){
			$GLOBALS[$sHtml_Var] .= "<option value='".$rs->fields['0']."'";
			if ($rs->fields['0'] == $GLOBALS['aDefaultForm']['cbo_sistema']) {
				$GLOBALS[$sHtml_Var].= " selected='selected'";
			}
			$GLOBALS[$sHtml_Var] .= ">".$rs->fields['1']." </option>\n";
			$rs->MoveNext();
		}		
	}
}
function LoadEstado_($conn){  
	$sHtml_Var = "sHtml_cb_Estado";
	if (!isset($GLOBALS[$sHtml_Var])){
		$GLOBALS[$sHtml_Var] = '';
	}	
	if ($GLOBALS[$sHtml_Var] == ''){
		$sSQL="SELECT nentidad, sdescripcion FROM public.entidad where nenabled=1 ORDER BY sdescripcion";
		echo $sSQL;		
		$rs = &$conn->Execute($sSQL); 
		while ( !$rs->EOF ){
			$GLOBALS[$sHtml_Var] .= "<option value='".$rs->fields['0']."'";
			if ($rs->fields['0'] == $GLOBALS['aDefaultForm']['cbo_estado']) {
				$GLOBALS[$sHtml_Var].= " selected='selected'";
			}
			$GLOBALS[$sHtml_Var] .= ">".$rs->fields['1']." </option>\n";
			$rs->MoveNext();
		}		
	}
}
function LoadRoles($conn){  
	$sHtml_Var = "sHtml_cb_roles";
	if (!isset($GLOBALS[$sHtml_Var])){
		$GLOBALS[$sHtml_Var] = '';
	}	
	if ($GLOBALS[$sHtml_Var] == ''){
		$sSQL="SELECT id, sdescripcion FROM rol WHERE nenabled = 1 AND modulo_id = '".$_SESSION['moduloid']."' AND nadministrador != 1 ORDER BY sdescripcion;";		
		$rs = &$conn->Execute($sSQL); 
		while ( !$rs->EOF ){
			$GLOBALS[$sHtml_Var] .= "<option value='".$rs->fields['0']."'";
			if ($rs->fields['0'] == $GLOBALS['aDefaultForm']['cbo_menu']) {
				$GLOBALS[$sHtml_Var].= " selected='selected'";
			}
			$GLOBALS[$sHtml_Var] .= ">".$rs->fields['1']." </option>\n";
			$rs->MoveNext();
		}		
	}
}
?>

	<div id="Contenido" align="center" style="overflow:auto">
	<br>
	<table class="tabla" width="95%" height="95%">
	<tbody>
	<tr valign="top">
	<td>
<style type="text/css">

	.loaders {
		position: fixed;
		left: 0px;
		top: 0px;
		width: 100%;
		height: 100%;
		z-index: 9999;	
		background: url('../imagenes/page-loader.gif') 50% 50% no-repeat rgb(255,255,255);
		opacity: 0.6;
    	filter: alpha(opacity=60);
	}
	
	</style>

		<form name="usuarios" id="usuarios" method="post">
		<script type="text/javascript" src="funciones_admin_usuario.js"></script>
		<script src="/minpptrassi/datatables/funcion_paginador.js"></script>
			<table width="90%" border="0" align="center" class="formulario">
			
		
				<tr>
					<th width="100%" colspan="2" class="separacion_10"></th>
				</tr> 
                <tr>
             <th colspan="4"  class="sub_titulo"><div align="left">MANTENIMIENTO --> Usuarios</div></th>
        </tr>
				
				<tr>
					<th width="100%" colspan="2" class="titulo">ADMINISTRAR ROL DE USUARIOS</th>
				</tr>
				
				<tr>
					<th width="100%" colspan="2" class="separacion_10"></th>
				</tr>
				
				<tr>
					<th width="100%" colspan="2" class="sub_titulo" align="left"> 1.- M&oacute;dulos y Roles </th>
				</tr>
										
				<tr>
					<th width="100%" colspan="2" class="separacion_10"></th>
				</tr>
				<?php // if($_SESSION['moduloid'] == 3){ ?>
				<tr>
						<td width="20%"><div align="right">Módulos: </div></td>
					<td width="80%">
						<select id="cbo_sistema" name="cbo_sistema">
						<option value="<?=$_SESSION['moduloid']?>"><?= $_SESSION['modulodescriocion']?></option>
						</select>			
						
                        				
							
					</td>
				</tr>
				
				<tr>
				<td width="20%"><div align="right">Roles: </div></td>
					<td width="80%">
						<select id="cbo_roles" name="cbo_roles" >
						<option value="">Seleccione</option>
						<?  LoadRoles ($conn) ; print $GLOBALS['sHtml_cb_roles']; ?>
					  </select>			
									
					</td>
				</tr>
                
              <tr>
				<td width="20%"><div align="right">Estado: </div></td>
					<td width="80%">
						<select id="cbo_estado" name="cbo_estado" onChange="load();" >
						<option value="">Seleccione</option>
                       	<?  LoadEstado_ ($conn) ; print $GLOBALS['sHtml_cb_Estado']; ?>
                        
					  </select>			
						<!--<span>*</span>-->				
					</td>
				</tr>
                
                
				<?php // }else{ ?>
					<!--<tr>
				<td width="20%"><div align="right">Módulos: </div></td>
					<td width="80%">
						<select id="cbo_sistema" name="cbo_sistema">
						<option value="<?=$_SESSION['moduloid']?>"><?= $_SESSION['modulodescriocion']?></option>
						</select>			
						
                        				
					</td>
				</tr>
				
				<tr>
				<td width="20%"><div align="right">Roles: </div></td>
					<td width="80%">
						<select id="cbo_roles" name="cbo_roles" onChange="load();">
						<option value="">Seleccione</option>
						<?  LoadRoles ($conn) ; print $GLOBALS['sHtml_cb_roles']; ?>
					  </select>			
									
					</td>
				</tr>-->		
				<?php //} ?>
						
				<tr>
					<th width="100%" colspan="2" class="separacion_10"></th>
				</tr>
				
				<tr>
					<th width="100%" colspan="2">
						<div id="botones" align="right">Marcar Todos: 
							<button type="button" class="btn btn-default btn-sm" onclick="javascript:checkedtodo()">
         						<span class="glyphicon glyphicon-check"></span> SI
       						</button>
							<button type="button" class="btn btn-default btn-sm" onclick="javascript:nocheckedtodo()">
         						<span class="glyphicon glyphicon-unchecked"></span> NO 
       						</button>
						</div>
					</th>
				</tr>		
				
				<tr>
					<td colspan="2">
			
						<div class='outer_div'></div>
			
					</td>
				</tr>
			</table>
            <div id="loader" class="loaders" style="display: none;"></div>
		</form>
    		
	</td>
	</tr>
	</tbody>
	</table>
	
<?php include("../../footer.php"); ?>