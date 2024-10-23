<table width="100%" border="0" align="center" class="formulario" cellpadding="0" cellspacing="0">
    <tr>
    <th class="titulo"></th>
    </tr>
    <tr>
    <th class="titulo">REGISTRO DE OPORTUNIDAD DE CAPACITACI&Oacute;N</th>
    </tr>
</table>

<table width="90%" border="0.1"  bordercolor="#000033"align="center" >
<tr>
<th align="left" class="subtititulos">Entidad de trabajo: <? echo $_SESSION['nombre_empresa'].' Rif:'.$_SESSION['rif']?>
<th align="right" class="subtititulos">Oportunidad de capacitaci&oacute;n Nro.: <?=$_SESSION['id_oferta']?></th>
</tr>
<tr>
<td class="subtititulos"><a class="links-menu-izq" href="?menu=40" title="Datos principales de la oportunidad de formativas">
<div align="center">Datos Principales</div></a></td>

<td class="subtititulos"><a class="links-menu-izq" href="4_2agen_otrosdatos_capacitacion.php" title="Otros datos importantes de la oportunidad de formativas.">
<div align="center">Otros Datos</div></a></td>
</tr>
</table>