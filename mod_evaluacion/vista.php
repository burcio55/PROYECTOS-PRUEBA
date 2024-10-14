<?php
include("header.php");

include("BD.php");

$mes = date('m');

if ($mes >= 1 && $mes <= 3) {
	$periodo = 1;
} else
if ($mes >= 4 && $mes <= 6) {
	$periodo = 2;
} else
if ($mes >= 7 && $mes <= 9) {
	$periodo = 3;
} else
if ($mes >= 10 && $mes <= 12) {
	$periodo = 4;
}

$_SESSION["Periodo"] = $periodo;

?>

<div class="sep"></div>
<div class="sep"></div>

<!-- Main -->
<main>
	<div class="content-todo">
		<?
		include "menu2.php";
		?>
		<div class="sep"></div>
		<center>
			<div class="col-md-12">

				<form method="POST" action="" class="col-md-12">
					<div class="card-header" style="border-radius: 30px 30px 0 0; padding: 30px 0 10px 20px; background-color: #fff">
						<!-- Parte superior del formulario -->
						<img src="img/logo.png" style="width: 80%; height: auto; margin: auto">
						<!-- Título del logo -->
						<hr>
						<div class="sep"></div>

					</div>
				</form>

			</div>
		</center>
	</div>
</main>
<div class="sep"></div>
<div class="sep"></div>

<?php include("footer.php"); ?>