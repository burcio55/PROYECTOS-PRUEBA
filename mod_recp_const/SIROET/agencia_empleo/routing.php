<?php 
	/**
	* Archivo que redirecciona al contenido que se va incrustar dentro de la header y el footer
	* Autor: Elivar Largo
	* Sitio Web: wwww.ecodeup.com
	**/
	//var_dump($_GET);
	if ($_GET['menu']==1) {		//index inicio pagina principal
		require_once('index.php');
	}
	if ($_GET['menu']==10) {	//pagina en construccion	
		require_once('mod_agencia_empleo/mantenimiento.php');
	}
	
	///Perfil del trabajador
	if ($_GET['menu']==11) {		//datos personales
		require_once('mod_agencia_empleo/1_1agen_trab_datos.php');
		//require_once('mod_agencia_empleo/prueba.php');
	}
   	if ($_GET['menu']==12) {	//datos de interes	
		require_once('mod_agencia_empleo/1_16agen_trab_datos_interes.php');
	}
	if ($_GET['menu']==13) {	//discapacidad
		require_once('mod_agencia_empleo/1_3agen_trab_discapacidad.php');	
	}

	if ($_GET['menu']==14) {		//situacion ocupacional
		require_once('mod_agencia_empleo/1_4agen_trab_ocupacion.php');
	}
	if ($_GET['menu']==15) {	//educacion	
		require_once('mod_agencia_empleo/1_5agen_trab_educacion.php');
	}
	if ($_GET['menu']==16) {		//capacitacion recibida
		require_once('mod_agencia_empleo/1_6agen_trab_capacitacion.php');
	}
	
    if ($_GET['menu']==17) {		//Otros conocumientos
		require_once('mod_agencia_empleo/1_7agen_trab_conocimientos.php');
	}  
	 if ($_GET['menu']==18) {		//Experiencia laboral
		require_once('mod_agencia_empleo/1_8agen_trab_experiencia.php');
	} 
	 if ($_GET['menu']==19) {		//FOTOS
		require_once('mod_agencia_empleo/1_12agen_trab_foto.php');
	} 
	if ($_GET['menu']==20) {		//enlanza curriculum vitae
		require_once('mod_agencia_empleo/1_14agen_trab_formatos.php');
	} 
	if ($_GET['formato']==1) {		//muestracurriculum vitae
		require_once('mod_agencia_empleo/1agen_formato_curriculum.php');
	}
	if ($_GET['formato']==2) {		//curriculum vitae
		require_once('mod_agencia_empleo/pdf_curriculum.php');
	}
	
	
	
////Perfil de Entidad de trabajo 
// Datos Principales de la Entidad de Trabajo
	if ($_GET['menu']=='21') {
		require_once('mod_agencia_empleo/2_1agen_empresa.php');		
	} 
//Ubicación de la Entidad de Trabajo	
	if ($_GET['menu']=='22') {
		require_once('mod_agencia_empleo/2_2agen_ubicacion_empresa.php');
	} 
//Otros Datos de la Entidad de Trabajo.	
	if ($_GET['menu']=='23') {
		require_once('mod_agencia_empleo/2_3agen_otrosdatos_empresa.php');
	} 
//Pagina llamado Formato(Constancia de Afiliación	
	if ($_GET['menu']=='24') {
		require_once('mod_agencia_empleo/2_6agen_formato_empresa.php');
	} 
//Formato(Constancia de Afiliación HTML
	if ($_GET['formato']=='3') {
		require_once('mod_agencia_empleo/2_4agen_constancia_emp.php');
	} 
//Formato(Constancia de Afiliación PDF
	if ($_GET['formato']=='4') {
		require_once('mod_agencia_empleo/pdf_constancia_empresa.php');
	} 

//oportunidades Laborales
//	Datos Principales de la Oportunidad Laboral	
	if ($_GET['menu']=='30') {
		require_once('mod_agencia_empleo/3_0agen_registro_oferta.php');
	} 
		//Registro de la oportuniadad Laboral
	if ($_GET['menu']=='31') {
		require_once('mod_agencia_empleo/3_1agen_oferta.php');
	} 
		//Condiciones del Perfil Laboral
	if ($_GET['menu']=='32') {
		require_once('mod_agencia_empleo/3_2agen_condicion_oferta.php');
	} 
		//constancia de oportinidad Laboral
	if ($_GET['formato']=='5') {
		require_once('mod_agencia_empleo/3agen_formato_oferta.php');
	}

//oportunidades Formativas

//	Datos Principales de la Oportunidad Formativa	
	
	if ($_GET['menu']=='40') {
		require_once('mod_agencia_empleo/4_0agen_registro_capacitacion.php');
	} 
	//Registro de la oportuniadad Formativa
	if ($_GET['menu']=='41') {
		require_once('mod_agencia_empleo/4_1agen_capacitacion.php');
	}
	//b.	Otros Datos de de la Oportunidad Formativa
	if ($_GET['menu']=='42') {
		require_once('mod_agencia_empleo/4_2agen_otrosdatos_capacitacion.php');
	}
	//constancia de oportinidad Formativa
	if ($_GET['formato']=='6') {
		require_once('mod_agencia_empleo/4agen_formato_capacitacion.php');
	}
	
	//Indicadores
	
	//Menu principal de reportes 
	if ($_GET['menu_reporte']=='11') {
		require_once('mod_agencia_empleo/menu.php');
	}
	//Reporte por Estado de trabajadores
	if ($_GET['menu_reporte']=='1') {
		require_once('mod_agencia_empleo/reporte_trabajador_por_estado.php');
	}
		//Reporte por municipio de trabajadores
	if ($_GET['menu_reporte']=='2') {
		require_once('mod_agencia_empleo/reporte_trabajador_por_municipio.php');
	}
		//Reporte por parroquia de trabajadores
	if ($_GET['menu_reporte']=='3') {
		require_once('mod_agencia_empleo/reporte_trabajador_por_parroquia.php');
	}
	
	//reportes de entidades de trabajo por estado
	if ($_GET['menu_reporte']=='4') {
		require_once('mod_agencia_empleo/reporte_entidades_de_trabajo_por_estado.php');
	}
	//reportes de entidades de trabajo por municipio
	if ($_GET['menu_reporte']=='5') {
		require_once('mod_agencia_empleo/reporte_entidades_de_trabajo_por_municipio.php');
	}
	//reportes de entidades de trabajo por parroquia
	if ($_GET['menu_reporte']=='6') {
		require_once('mod_agencia_empleo/reporte_entidades_de_trabajo_por_parroquia.php');
	}
	
 ?>