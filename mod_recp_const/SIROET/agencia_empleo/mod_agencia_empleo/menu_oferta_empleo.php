<table width="100%" border="0" align="center" class="formulario" cellpadding="0" cellspacing="0">
    <tr>
    <th class="titulo"></th>
    </tr>
    <tr>
    <th class="titulo">REGISTRO DE OPORTUNIDAD LABORAL</th>
    </tr>
</table>

<table width="90%" border="1"  bordercolor="#000033" align="center" >
<tr>
<th colspan="2" align="left" class="subtititulos">Entidad de trabajo: <? echo $_SESSION['nombre_empresa'].' Rif:'.$_SESSION['rif']?>
<th colspan="1" align="right" class="subtititulos">Oportunidad de empleo Nro.: <?=$_SESSION['id_oferta']?></th>
</tr>
<tr>
<td class="subtititulos"><a class="links-menu-izq" href="?menu=31" title="Datos principales de la oportunidad laboral">
<div align="center">Datos Principales</div></a></td>

<td class="subtititulos"><a class="links-menu-izq" href="?menu=32" title="Condiciones del Perfil">
<div align="center">Condiciones del Perfil </div></a></td>


<!--<td class="subtititulos"><a class="links-menu-izq" href="3_3agen_otrosdatos_oferta.php" title="Otros datos importantes de la oportunidad de empleo.">
<div align="center">Otros Datos</div></a></td>-->
</tr>
</table>
