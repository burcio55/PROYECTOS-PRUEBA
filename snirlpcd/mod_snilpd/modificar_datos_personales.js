function agregar_datos_personas(snacionalidad, ssexo, fecha_nac, cbpais_nac_afiliado1, cbEstado_nac_afiliado, cbEstado_Civil_afiliado, telefono_afiliado, otro_telefono_afiliado, redes_sociales, facebook, email_afiliado, twitter, telegram, instagram, tik_tok, otro, otro_user, cbPais_afiliado, cbEstado_afiliado, cbMunicipio_afiliado, cbParroquia_afiliado, sector_afiliado, direccion_afiliado, referencia, cbJefe_familia, cbHijos, hijos_menores, hijos_mayores, cbVehiculo_afiliado, carnet_patria, codigo, serial, observaciones_generales) {
    $.ajax({
        url: 'validar_dpersonales.php?snacionalidad='+snacionalidad+'&ssexo='+ssexo+'&fecha_nac='+fecha_nac+'&cbpais_nac_afiliado1='+cbpais_nac_afiliado1+'&cbEstado_nac_afiliado='+cbEstado_nac_afiliado+'&cbEstado_Civil_afiliado='+cbEstado_Civil_afiliado+'&telefono_afiliado='+telefono_afiliado+'&otro_telefono_afiliado='+otro_telefono_afiliado+'&redes_sociales='+redes_sociales+'&facebook='+facebook+'&email_afiliado='+email_afiliado+'&twitter='+twitter+'&telegram='+telegram+'&instagram='+instagram+'&tik_tok='+tik_tok+'&otro='+otro+'&otro_user='+otro_user+'&cbPais_afiliado='+cbPais_afiliado+'&cbEstado_afiliado='+cbEstado_afiliado+'&cbMunicipio_afiliado='+cbMunicipio_afiliado+'&cbParroquia_afiliado='+cbParroquia_afiliado+'&sector_afiliado='+sector_afiliado+'&direccion_afiliado='+direccion_afiliado+'&referencia='+referencia+'&cbJefe_familia='+cbJefe_familia+'&cbHijos='+cbHijos+'&hijos_menores='+hijos_menores+'&hijos_mayores='+hijos_mayores+'&cbVehiculo_afiliado='+cbVehiculo_afiliado+'&carnet_patria='+carnet_patria+'&codigo='+codigo+'&serial='+serial+'&observaciones_generales='+observaciones_generales,
        type: 'GET',
        data: snacionalidad,
        data: ssexo,
        data: fecha_nac,
        data: cbpais_nac_afiliado1,
        data: cbEstado_nac_afiliado,
        data: cbEstado_Civil_afiliado,
        data: telefono_afiliado,
        data: otro_telefono_afiliado,
        data: redes_sociales,
        data: facebook,
        data: email_afiliado,
        data: twitter,
        data: telegram,
        data: instagram,
        data: tik_tok,
        data: otro,
        data: otro_user,
        data: cbPais_afiliado,
        data: cbEstado_afiliado,
        data: cbMunicipio_afiliado,
        data: cbParroquia_afiliado,
        data: sector_afiliado,
        data: direccion_afiliado,
        data: referencia,
        data: cbJefe_familia,
        data: cbHijos,
        data: hijos_menores,
        data: hijos_mayores,
        data: cbVehiculo_afiliado,
        data: carnet_patria,
        data: codigo,
        data: serial,
        data: observaciones_generales,
        success: function(resp) {
            let resultado = JSON.parse(resp);
            alert(resultado);
        }
        /* success: function(resp) {
            let resultado = JSON.parse(resp);
            //alert("ARRAYRESULTADO="+resultado.primer_nombre);
            //1  Funciona
            // console.log(resp);
            //var resultado=resp.split("|");
            //console.log(resultado[0]+"="+resultado[1]);
            $( "#nombre" ).val(resultado.nombres.toUpperCase());
            $('#apellido').val(resultado.apellidos.toUpperCase());
            $('#sexo').val(resultado_sexo); 
            //setTimeout( function() { window.location.href = "/Imp_Teletrabajo/"; }, 5000 );
        } */
    });
}