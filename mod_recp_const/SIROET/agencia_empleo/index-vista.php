﻿<?php 
    session_start();
    unset($_SESSION['usuario']);
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <title>SIROET - Sistema de Información y Registro de Oportunidades de Educación y Trabajo| MPPPST</title>
    <meta content="Responsive admin theme build on top of Bootstrap 4" name="description" />
    <meta content="Themesdesign" name="author" />
    <!--link rel="shortcut icon" href="assets/images/favicon.ico"-->

    <!--Morris Chart CSS -->
    <link rel="stylesheet" href="../plugins/morris/morris.css">

    <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="assets/css/metismenu.min.css" rel="stylesheet" type="text/css">
    <link href="assets/css/icons.css" rel="stylesheet" type="text/css">
    <link href="assets/css/style.css" rel="stylesheet" type="text/css">
 <!--Validaciones general--> 
   <script type="text/javascript" src="js/validacion_general.js"></script>  
    <script src="mod_agencia_empleo/validar_trabajador.js"></script>
    <script src="mod_agencia_empleo/funciones_trabajador.js"></script>
    <script type="text/javascript" src="mod_agencia_empleo/validar_empresa.js"></script>
    <!--FIN Validaciones general--> 
     
    <!--LIBRERIA JQUERY Y UI JQUERY (BUSCADOR COMBO)-->
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/jquery-ui.js"></script>
    <link href="css/jquery-ui.css" rel="stylesheet" type="text/css" />
    
    
 	<!--FIN LIBRERIA JQUERY Y UI JQUERY (BUSCADOR COMBO)-->
	    
    <!--CALENDARIO-->
    <script src="js/src/js/jscal2.js"></script>
    <script src="js/src/js/lang/es.js"></script>
    <link rel="stylesheet" type="text/css" href="js/src/css/jscal2.css" />
    <link rel="stylesheet" type="text/css" href="js/src/css/border-radius.css" />
    <link rel="stylesheet" type="text/css" href="js/src/css/win2k/win2k.css" />
    <link type="text/css" rel="stylesheet" href="js/src/css/reduce-spacing.css" />    
    <!--FIN CALENDARIO-->
        
        
    <!--LIBRERIA PARA FORMATO DE NUMEROS 100.00,00-->
    <script type="text/javascript" src="js/jquery-number-master/jquery.number.js"></script>    
    <!---FIN LIBRERIA PARA FORMATO DE NUMEROS 100.00,00-->
    
    
    <!--LIBRERIA TOOLTIP-->
    <script src="js/jquery.tooltip.js" type="text/javascript"></script>
    <script type="text/javascript">
    $(function() {
    // modify global settings
		$.extend($.fn.Tooltip.defaults, {
		track: true,
		delay: 0,
		showURL: false,
		showBody: " - "
    });
    $('a, input, img , button,textarea,select').Tooltip();
    });
    </script>
    <!--FIN LIBRERIA TOOLTIP-->
	
    <!--FIN LIBRERIA MOSTRAR TABLAS-->
	<script src="js/jquery.dataTables.js" type="text/javascript"></script>
    <link type="text/css" rel="stylesheet" href="js/demo_table.css" />
    <!--FIN LIBRERIA MOSTRAR TABLAS-->
<!--::::::::::::::::::::::::::::::LIBRERIAS DE HIGHCHARTS::::::::::::::::::::::::::::::::::: -->
<link rel="stylesheet" type="text/css" href="css/highcharts.css" />
<script type="text/javascript" src="js/highcharts.js"></script>
<script type="text/javascript" src="js/modules/data.js"></script>
<script type="text/javascript" src="js/modules/drilldown.js"></script>
<script type="text/javascript" src="js/modules/exporting.js"></script>
<script type="text/javascript" src="js/modules/export-data.js"></script>
<script type="text/javascript" src="js/modules/accessibility.js"></script>
<!--:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::: -->

</head>

<body>

    <!-- Begin page -->
    <div id="wrapper">

        <!-- Top Bar Start -->
        <div class="topbar">

            <!-- LOGO -->
            <div class="topbar-left">
                <a href="index.html" class="logo">
                    <span class="logo-light">
                        <!--SE DEBE HABILITAR UNA VEZ LA IMAGEN DEL LOGO ESTE MODIFICADA-->
                            <img src="assets/images/logo_siroet-03.png" style="float: left; margin: 0px 200px 150px 20px;" width="200" height="150">
                              
                    </span>
                    <!--span class="logo-sm">
                            <i class="mdi mdi-alpha-s-circle"></i>
                    </span-->
                </a>
            </div>
            <!-- BARRA SUPERIOR-->
            <nav class="navbar-custom">
                <ul class="navbar-right list-inline float-right mb-0">

        <!-- ESTA SESION SE COMENTO Y SIRVE PARA AGREGAR UN BOTON PARA CAMBIO DE IDIOMA-->
                    <!-- language-->
                    <!--li class="dropdown notification-list list-inline-item d-none d-md-inline-block">
                        <a class="nav-link dropdown-toggle arrow-none waves-effect" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                            <img src="assets/images/flags/us_flag.jpg" class="mr-2" height="12" alt="" /> English <span class="mdi mdi-chevron-down"></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-animated language-switch">
                            <a class="dropdown-item" href="#"><img src="assets/images/flags/french_flag.jpg" alt="" height="16" /><span> French </span></a>
                            <a class="dropdown-item" href="#"><img src="assets/images/flags/spain_flag.jpg" alt="" height="16" /><span> Spanish </span></a>
                            <a class="dropdown-item" href="#"><img src="assets/images/flags/russia_flag.jpg" alt="" height="16" /><span> Russian </span></a>
                            <a class="dropdown-item" href="#"><img src="assets/images/flags/germany_flag.jpg" alt="" height="16" /><span> German </span></a>
                            <a class="dropdown-item" href="#"><img src="assets/images/flags/italy_flag.jpg" alt="" height="16" /><span> Italian </span></a>
                        </div>
                    </li-->

                    <!-- full screen --> <!-- ESTA SESION  SE ENCUENTRA EL ICONO PARA TENER LA PANTALLA FULL SCRREEN-->
                    <li class="dropdown notification-list list-inline-item d-none d-md-inline-block">
                        <a class="nav-link waves-effect" href="#" id="btn-fullscreen">
                            <i class="mdi mdi-arrow-expand-all noti-icon"></i>
                        </a>
                    </li>
                    <!-- ESTA SESION SE COMENTO Y SIRVE PARA AGREGAR UN BOTON DE NOTIFICACIONES EN LA BARRA SUPERIOR-->
                    <!-- notification --> 
                    <!--li class="dropdown notification-list list-inline-item">
                        <a class="nav-link dropdown-toggle arrow-none waves-effect" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                            <i class="mdi mdi-bell-outline noti-icon"></i>
                            <span class="badge badge-pill badge-danger noti-icon-badge">3</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-animated dropdown-menu-lg px-1">
                            <item>
                            <h6 class="dropdown-item-text">
                                    Notifications
                                </h6>
                            <div class="slimscroll notification-item-list">
                                < item>
                                <a href="javascript:void(0);" class="dropdown-item notify-item active">
                                    <div class="notify-icon bg-success"><i class="mdi mdi-cart-outline"></i></div>
                                    <p class="notify-details"><b>Your order is placed</b><span class="text-muted">Dummy text of the printing and typesetting industry.</span></p>
                                </a>

                                <item>
                                <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <div class="notify-icon bg-danger"><i class="mdi mdi-message-text-outline"></i></div>
                                    <p class="notify-details"><b>New Message received</b><span class="text-muted">You have 87 unread messages</span></p>
                                </a>

                                < item>
                                <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <div class="notify-icon bg-info"><i class="mdi mdi-filter-outline"></i></div>
                                    <p class="notify-details"><b>Your item is shipped</b><span class="text-muted">It is a long established fact that a reader will</span></p>
                                </a>

                                < item>
                                <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <div class="notify-icon bg-success"><i class="mdi mdi-message-text-outline"></i></div>
                                    <p class="notify-details"><b>New Message received</b><span class="text-muted">You have 87 unread messages</span></p>
                                </a>

                                < item>
                                <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <div class="notify-icon bg-warning"><i class="mdi mdi-cart-outline"></i></div>
                                    <p class="notify-details"><b>Your order is placed</b><span class="text-muted">Dummy text of the printing and typesetting industry.</span></p>
                                </a>

                            </div>
                            < All>
                            <a href="javascript:void(0);" class="dropdown-item text-center notify-all text-primary">
                                    View all <i class="fi-arrow-right"></i>
                                </a>
                        </div>
                    </li-->
                    <!-- ESTA SESION ES EL AREA DEL BOTON DE USUARIO EN LA BARRA SUPERIOR-->
                    <li class="dropdown notification-list list-inline-item">
                        <div class="dropdown notification-list nav-pro-img">
                            <a class="dropdown-toggle nav-link arrow-none nav-user" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                <img src="assets/images/users/user-4.jpg" alt="user" class="rounded-circle">
                            </a>
                            <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                                <!-- item-->
                               <!-- <a class="dropdown-item" href="#"><i class="mdi mdi-account-circle"></i> Perfil</a>
                                <!--<a class="dropdown-item d-block" href="#"><i class="mdi mdi-settings"></i> Configuraciones</a>-->
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item text-danger" href="salir.php"><i class="mdi mdi-power text-danger"></i> Salir</a>
                            </div>
                        </div>
                    </li>

                </ul>
                
                <ul class="list-inline menu-left mb-0">
                     <!-- ESTA SESIÓN ES PARA TENER EN EL BOTON PARA EXPANDIR Y CONTRAER EL MENU IZQUIERDO-->
                    <li class="float-left">
                        <button class="button-menu-mobile open-left waves-effect">
                            <i class="mdi mdi-menu"></i>
                        </button>
                    </li>
                    <!-- ESTA SESIÓN ES PARA TENER EN LA BARRA SUPERIOR UN BOTON DE BUSQUEDA-->
                    <!--li class="d-none d-md-inline-block">
                        <form role="search" class="app-search">
                            <div class="form-group mb-0">
                                <input type="text" class="form-control" placeholder="Search..">
                                <button type="submit"><i class="fa fa-search"></i></button>
                            </div>
                        </form>
                    </li-->
                </ul>

            </nav>

        </div>
        <!-- Top Bar End -->

        <!-- ========== Left Sidebar Start ========== -->
        <div class="left side-menu">
            <div class="slimscroll-menu" id="remove-scroll">

                <!--- Sidemenu -->
                <div id="sidebar-menu">
                    <!-- Left Menu Start -->
                    <ul class="metismenu" id="side-menu" style="float: left; margin: 60px 0px 20px 50px;" >
                        <li class="menu-title" >Información General</li>
                        <li>
                            <a href="index-vista.php" class="waves-effect">
                                <i class="icon-accelerator"></i><span class="badge badge-success badge-pill float-right"></span> <span> Principal </span>
                            </a>
                        </li>

                        <li>
                            <a href="javascript:void(0);" class="waves-effect" ><i class="mdi mdi-account-card-details"></i><span> Personal <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span></a>
                            <ul class="submenu">
                             <li><a href="../index.php?menu=11">PERFIL DEL TRABAJADOR O TRABAJADORA</a></li>
                            </ul>
                        </li>

                        <li>
                            <a href="javascript:void(0);" class="waves-effect"><i class="fas fa-suitcase"></i><span> Laboral <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span></a>
                            <ul class="submenu">
                                 <li><a href="../index.php?menu=18">DATOS LABORALES</a></li>
                                
                            </ul>
                        </li>
                        <li>
                            <a href="javascript:void(0);" class="waves-effect"><i class="fas fa-book"></i><span> Educativo<span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span></a>
                            <ul class="submenu">
                                <li><a href="../index.php?menu=15">DATOS EDUCATIVOS</a></li>
                            </ul>
                        </li>

                        <li class="menu-title">Oportunidades</li>

                        <li>
                            <a href="javascript:void(0);" class="waves-effect"><i class="fas fa-handshake"></i><span> Laborales<span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span></a>
                            <ul class="submenu">
                                <li><a href="../index.php?menu=21">PERFIL DE LA ENTIDAD DE TRABAJO</a></li>
                                <li><a href="../index.php?menu=30">OPORTUNIDADES EMPLEO</a></li>
                            </ul>
                        </li>

                        <li>
                            <a href="javascript:void(0);" class="waves-effect"><i class="fas fa-book-open"></i><span> Formativas<span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span></a>
                            <ul class="submenu">
                                  <li><a href="../index.php?menu=40">OPORTUNIDADES FORMATIVAS</a></li>
                            </ul>
                        </li>
                       <li>
                            <a href="javascript:void(0);" class="waves-effect"><i class="fas fa-book-open"></i><span> Reportes<span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span></a>
                            <ul class="submenu">
                               <li><a href="../index.php?menu_reporte=11">INDICADORES</a></li>
                            </ul>
                        </li>
                    </ul>

                </div>
                <!-- Sidebar -->
                <div class="clearfix"></div>

            </div>
            <!-- Sidebar -left -->

        </div>
        <!-- Left Sidebar End -->

        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="content-page">
                <!-- Start content -->
                <div class="content">
                    <div class="container-fluid">
                        <div class="page-title-box">
                            <div class="row align-items-center">
                               <div class="col-sm-6">
                                   <h3 class="page-title" style="text-align:justify;position:relative;left:80px;top:-10px;width:600px;">Información de Interes</h3>
                                </div>
                                <div class="col-sm-6">
                                    <ol class="breadcrumb float-right">
                                        <li class="breadcrumb-item"><a href="javascript:void(0);">SIROET</a></li>
                                        <li class="breadcrumb-item active">Página Principal</li>
                                    </ol>
                                </div>
                            </div> <!-- end row -->


                            <!-- Es aqui donde va el cambio -->
                       <div class="embed-responsive embed-responsive-16by9" >
  <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/zpOULjyy-n8?rel=0" width="500" height="300" ></iframe>
</div>
                              <!-- Titulo del carrousel-->
                               <div class="col-sm-6">
                                    <h3 class="page-title" style="text-align:justify;position:relative;left:80px;top:20px;width:600px;">Post Actuales</h3>
                                </div>
                              
<!-- Aqui llamo al carrousel--> 

<hr>	
<div class="col-sm-12">
		<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel" style="text-align:justify">
<div class="carousel-inner" role="listbox" >
	<div class="carousel-item active">
		<div class="row" style="text-align:justify-all">
			<div class="col-sm-3" >
				<img class="d-block img-fluid" src="assets/images/enlace-1.png" title="enlace-1"target="_blank" href="http://encthc.mpppst.gob.ve/videoconferencia-entre-los-viceministros-diva-guzman-y-domiciano-graterol-junto-a-representantes-de-ministerios-enlaces-educativos-y-de-la-clase-obrera-organizada/" alt="First slide">
				<div >
					<h7 class="card-title" >_"El objetivo primordial es qué al acceder a las distintas oportunidades de estudio, que deben tener pertinencia con las demandas de la institución, el trabajador y la trabajadora accedan a formarse y certificarse acercando así la Universidad al centro de trabajo, de esa manera, garantizarle el derecho a la educación, fortalecer el concepto de salario social, además la educación viene a representar el desarrollo de las fuerzas productivas."_.</h7>
				</div>
			</div>
  			
  			<div class="col-sm-3">
  				<img class="d-block img-fluid" src="assets/images/enlace-2.jpg" title="enlace-2"target="_blank" href="http://encthc.mpppst.gob.ve/videoconferencia-entre-los-viceministros-diva-guzman-y-domiciano-graterol-junto-a-representantes-de-ministerios-enlaces-educativos-y-de-la-clase-obrera-organizada/" alt="First slide">
			    <div >
  				
  					<h7 class="card-title">-"Jovenes ya está disponible el curso Juventudes Nuestra Américanas dirigido hacia la formación de las nuevas generaciones trabajadoras que germinan la semilla de los saberes y haceres para el ejercicio de una praxis que determinen una nueva cultura de trabajo para la construcción del Socialismo Bolivariano del siglo XXI
                    Inscríbete y participa jóvenes vamos a darle la mirada a un futuro._"</h7>
  				</div>
  			</div>
  			<div class="col-sm-3">
  				<img class="d-block img-fluid" src="assets/images/enlace-3.png" title="enlace-3" target="_blank" href="http://encthc.mpppst.gob.ve/courses/gestion-alternativa-de-medios/"alt="First slide">
  				<div >
  					<h7 class="card-title"  href="http://encthc.mpppst.gob.ve/courses/gestion-alternativa-de-medios/">-"Ya está disponible! el curso de Gestión Alternativa de Medios como parte del Plan de Formación Comunicador Popular con el propósito de construir estrategias comunicacionales efectivas, eficaces y eficientes que generen medios alternativos contrahegemónicos visita, inscríbete y participa en las alternativas comunicacionales para lograr transformaciones sociales.-"</h7>
  				</div>
  			</div>
  		<div class="col-sm-3">
  				<img class="d-block img-fluid" src="http://placehold.it/400x400" alt="First slide">
  				<div class="text-center">
  					<h6 class="card-title">Lorem ipsum dolor sit amet.</h6>
  				</div>
  			</div>
  		</div>
  	</div>
  	<div class="carousel-item">
  		<div class="row">
  			<div class="col-sm-3">
  				<img class="d-block img-fluid" src="http://placehold.it/400x400" alt="First slide">
				<div class="text-center">					
  					<h6 class="card-title">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</h6>
				</div>
  			</div>
  			<div class="col-sm-3">
  				<img class="d-block img-fluid" src="http://placehold.it/400x400" alt="First slide">

  			</div>
  			<div class="col-sm-3">
  				<img class="d-block img-fluid" src="http://placehold.it/400x400" alt="First slide">
  			</div>
  			<div class="col-sm-3">
  				<img class="d-block img-fluid" src="http://placehold.it/400x400" alt="First slide">
  			</div>
  		</div>
  	</div>
  </div>
  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
  	<span class="carousel-control-prev-icon" aria-hidden="true"></span>
  	<span class="sr-only">Anterior</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
  	<span class="carousel-control-next-icon" aria-hidden="true"></span>
  	<span class="sr-only">Siguiente</span>
  </a>
</div>
</div>
</div>
</hr>
<!-- Aqui Cierra el carrosel-->

                        </div>
                        <!-- end page-title -->

                        
                    </div>
                    <!-- container-fluid -->

                </div>
                <!-- content -->

                <footer class="footer">
                    © 2020 SIROET<span class="d-none d-sm-inline-block"> - Sistema Desarrollado por la Dirección de Informatica - Análisis y Desarrollo de Sistemas || MPPPST </span>.
                </footer>

            </div>
        <!-- ============================================================== -->
        <!-- End Right content here -->
        <!-- ============================================================== -->

    </div>
    <!-- END wrapper -->

    <!-- jQuery  -->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/metismenu.min.js"></script>
    <script src="assets/js/jquery.slimscroll.js"></script>
    <script src="assets/js/waves.min.js"></script>

    <!--Morris Chart-->
    <script src="../plugins/morris/morris.min.js"></script>
    <script src="../plugins/raphael/raphael.min.js"></script>

    <script src="assets/pages/dashboard.init.js"></script>

    <!-- App js -->
    <script src="assets/js/app.js"></script>

</body>

</html>