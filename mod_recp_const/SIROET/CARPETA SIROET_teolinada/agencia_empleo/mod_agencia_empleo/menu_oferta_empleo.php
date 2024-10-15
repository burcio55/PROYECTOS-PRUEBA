<table width="100%" border="0" align="center" class="formulario" cellpadding="0" cellspacing="0">
    <tr>
    <th class="titulo"></th>
    </tr>
    <tr>
    <th class="titulo">REGISTRO DE OPORTUNIDAD DE EMPLEO</th>
    </tr>
</table>

<table width="90%" border="0" align="center" >
<tr>
<th colspan="2" align="left" class="subtititulos">Entidad de trabajo: <? echo $_SESSION['nombre_empresa'].' Rif:'.$_SESSION['rif']?>
<th colspan="1" align="right" class="subtititulos">Oportunidad de empleo Nro.: <?=$_SESSION['id_oferta']?></th>
</tr>
<tr>
<td class="subtititulos"><a class="links-menu-izq" href="3_1agen_oferta.php" title="Datos principales de la oportunidad de empleo">
<div align="center">Datos Principales</div></a></td>

<td class="subtititulos"><a class="links-menu-izq" href="3_2agen_condicion_oferta.php" title="Condiciones del Perfil">
<div align="center">Condiciones del Perfil </div></a></td>


<!--<td class="subtititulos"><a class="links-menu-izq" href="3_3agen_otrosdatos_oferta.php" title="Otros datos importantes de la oportunidad de empleo.">
<div align="center">Otros Datos</div></a></td>-->
</tr>
</table>
