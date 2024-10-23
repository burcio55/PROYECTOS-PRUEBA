<?php
include('based.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $rol = $_POST['rol'];


    // La consulta busca solo los registros donde rol_id coincide con el valor seleccionado
    $busqueda = "SELECT DISTINCT personales_cedula, primer_apellido, segundo_apellido, primer_nombre, segundo_nombre 
                 FROM public.personales_rol 
                 LEFT JOIN public.personales ON personales_rol.personales_cedula = personales.cedula
                 WHERE rol_id = $rol AND public.personales_rol.nenabled = '1'";

    

    $row = pg_query($conn, $busqueda);

     $i = 0; // Inicializar $i
    $element = ""; // Inicializar $element

    if ($row) {
        // Verificar si la consulta devolvió resultados vacíos
        if (pg_num_rows($row) == 0) {
            echo "<tr><td colspan='3'>No se encontraron datos.</td></tr>";
        } else {
            while ($persona = pg_fetch_assoc($row)) {
                $i++;
                $element .= "<tr>
                    <td>" . $i . "</td>
                    <td>" . $persona['personales_cedula'] . "</td>
                    <td>" . $persona['primer_nombre'] . ' ' . $persona['segundo_nombre'] . ' ' . $persona['primer_apellido'] . ' ' . $persona['segundo_apellido'] . "</td>
                </tr>";
            }
            echo $element;
        }
    } else {
        echo "<tr><td colspan='3'>Error: La consulta a la base de datos falló.</td></tr>";
        echo pg_last_error($conn);
    }
} else {
    echo "<tr><td colspan='3'>No se ha buscado ningún rol.</td></tr>"; 
}
?>