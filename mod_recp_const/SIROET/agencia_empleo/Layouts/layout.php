<!DOCTYPE html>
<html lang="es">
<head>

	<title> SIROET</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- LIBRERIAS BOOTSTRAP-->

	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">

	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

	<!-- Latest compiled JavaScript -->
	<script src="bootstrap/js/bootstrap.min.js"></script>
</head>
<style type="text/css">
	
	.content-page {

  display: inline-block; /* the default for span */
  width: 900px;
  height: 1200px;
  padding: 12px;

}
</style>
<body>
<header>
	<?php 
		require_once('header.php');
	?>	
</header>

<section>	
	<!--<div class="container">
	<?php 
			// carga el archivo routing.php para direccionar a la página .php que se incrustará entre la header y el footer
			//require_once('routing.php');
	 ?>

	</div>--> 
<!--//style="max-width: 800px; max-height:700px"-->

<div class="container">
	<div class="content-page" >
	       <?php 
			// carga el archivo routing.php para direccionar a la página .php que se incrustará entre la header y el footer
			require_once('routing.php');
	       ?>
    </div>
	</div>

</section>

<footer>
	<?php 
		include_once('footer.php');
	?>
</footer>
</body>
</html>