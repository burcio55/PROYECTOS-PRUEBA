<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Prueba</title>
  <link rel="stylesheet" href="../css/cdn.datatables.net_1.13.6_css_jquery.dataTables.min.css" />
  <link rel="stylesheet" href="../css/bootstrap5.1.3/css/bootstrap.min.css">
  <link rel="stylesheet" href="../css/bootstrap.css">
  <link rel="stylesheet" href="../css/bootstrap.min.css">
</head>

<body>
  <table id="example" class="table table-dark table-striped display">
    <thead>
      <tr>
        <th scope="col">Cédula de Identidad</th>
        <th scope="col">Primer Nombre</th>
        <th scope="col">Segundo Nombre</th>
        <th scope="col">Primer Apellido</th>
        <th scope="col">Segundo Apellido</th>
        <th scope="col">Teléfono Personal</th>
        <th scope="col">Teléfono de Habitación</th>
        <th scope="col">Acciones</th>
      </tr>
    </thead>
    <tbody>
      <?php
      // Realizar la consulta
      $host = "10.46.1.93";
      $dbname = "minpptrasse";
      $user = "postgres";
      $pass = "postgres";

      session_start();
      include('../include/BD.php');
      $conn = Conexion::ConexionBD();

      try {
        $conn = pg_connect("host=$host port=5432 dbname=$dbname user=$user password=$pass");
      } catch (PDOException $error) {
        $conn = $error;
        echo ("Error al conectar en la Base de Datos " . $error);
      }

      $query = "SELECT * FROM snirlpcd.persona WHERE benabled = 'true';";
      /* echo $query;
      die(); */
      $row = pg_query($conn, $query);
      /* echo $persona;
      die(); */
      // Iterar sobre los resultados

      while ($persona = pg_fetch_assoc($row)) {
      ?>
        <tr>
          <td>
            <?php echo $persona['ncedula']; ?>
          </td>
          <td>
            <?php echo $persona['sprimer_nombre']; ?>
          </td>
          <td>
            <?php echo $persona['ssegundo_nombre']; ?>
          </td>
          <td>
            <?php echo $persona['sprimer_apellido']; ?>
          </td>
          <td>
            <?php echo $persona['ssegundo_apellido']; ?>
          </td>
          <td>
            <?php echo $persona['stelefono_personal']; ?>
          </td>
          <td>
            <?php echo $persona['stelefono_habitacion']; ?>
          </td>
          <td>
            <button id="btnEditar" type='button' class='btn btn-primary' data-id="<?= $persona["id"]; ?>" onclick='editar("<?php echo $persona["id"]; ?>")'>Editar</button>
            <button type='button' class='btn btn-danger' onclick='eliminar("<?php echo $persona["id"]; ?>")'>Eliminar</button>
          </td>
        </tr>
      <?php
      }
      /* foreach ($persona as $dato) {
      ?>
        <tr>
          <td>
            <?php echo $dato['ncedula']; ?>
          </td>
          <td>
            <?php echo $dato['sprimer_nombre']; ?>
          </td>
          <td>
            <?php echo $dato['ssegundo_nombre']; ?>
          </td>
          <td>
            <?php echo $dato['sprimer_apellido']; ?>
          </td>
          <td>
            <?php echo $dato['ssegundo_apellido']; ?>
          </td>
          <td>
            <?php echo $dato['stelefono_personal']; ?>
          </td>
          <td>
            <?php echo $dato['stelefono_habitacion']; ?>
          </td>
          <td>
            <button type='button' class='btn btn-primary' onclick='editar("<?php echo $dato["id"]; ?>")'>Editar</button>
            <button type='button' class='btn btn-danger' onclick='eliminar("<?php echo $dato["id"]; ?>")'>Eliminar</button>
          </td>
        </tr>
      <?php
      } */
      ?>
    </tbody>
  </table>
  <script src="../js/code.jquery.com_jquery-3.7.0.js"></script>
  <script src="../js/cdn.tailwindcss.com_3.3.3"></script>
  <script src="../js/cdn.datatables.net_1.13.6_js_dataTables.tailwindcss.min.js"></script>
  <script src="../js/cdn.datatables.net_1.13.6_js_jquery.dataTables.min.js"></script>
  <script>
    new DataTable("#example");
  </script>
  <script src="example.js"></script>
</body>

</html>