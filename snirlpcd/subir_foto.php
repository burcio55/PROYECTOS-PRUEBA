<?php

// DECLARACION DE VARIABLES PARA CONECTAR A LA BASE DE DATOS

$host = "10.46.1.93";
$dbname = "minpptrasse";
$user = "postgres";
$pass = "postgres";

//OBTENER DATOS DE LA SESION Y HACER UNA CONSULTA DE LOS DATOS DEL REGUISTRO
//CONEXION CON SIRE

session_start();
include('../include/BD.php');
$conn2 = Conexion::ConexionBD();

//CONEXION CON SNIRLPCD

try {
    $conn = pg_connect("host=$host port=5432 dbname=$dbname user=$user password=$pass");
    $echo = ("Se conectó la Base de Datos ");
} catch (PDOException $error) {
    $conn = $error;
    echo ("Error al conectar en la Base de Datos " . $error);
}

if (isset($_SESSION['cedula'])) {

    $cedula = substr($_SESSION["cedula"], 1);

    $consulta = ("SELECT * FROM snirlpcd.persona WHERE ncedula = '" . $cedula . "';");
    $row = pg_query($conn, $consulta);
    $persona = pg_fetch_assoc($row);

    $persona_id = $persona["id"];
    /* $nombre_arc = $persona["id"];
    $nombre_arc .= $persona["sprimer_nombre"];
    $nombre_arc .= $persona["sprimer_apellido"];
    $nombre_arc .= $cedula;
    $nombre_arc .= rand(1, 10000000);

    $nombre_arc_new = str_replace(" ", "_", $nombre_arc); */
}

if ($_FILES["archivo_img"]) {
    $name_arc = basename($_FILES["archivo_img"]["name"]);
    $name_final = date("d-m-y") . "-" . date("H-i-s") . "-" . $name_arc;
    $ruta = "../imagenes/fotos/" . $name_final;
    $tipo = $_FILES["type"];
    $tmp = $_FILES['tmp_name'];
    $size = $_FILES["size"];
    $dimensiones = getimagesize($tmp);
    $width = $dimensiones[0];
    $height = $dimensiones[1];
    $subir_archivo = move_uploaded_file($_FILES["archivo_img"]["tmp_name"], $ruta);
    echo $name_arc . "<br>" . $name_final . "<br>" . $ruta . "<br>" . $tipo . "<br>" . $tipo . "<br>" . $tmp . "<br>" . "$size" . "<br>" . $dimensiones . "<br>" . $width . "<br>" . $height . "<br>" . $subir_archivo;
    if ($tipo != 'image/jpg' && $tipo != 'image/JPG' && $tipo != 'image/jpeg' && $tipo != 'image/png' && $tipo != 'image/gif') {
        echo '
            <script>
                alert ("Error, el archivo no es una imagen");
                window.location="foto.php";
            </script>
        ';
    } else
    if ($size > 3 * 1024 * 1024) {
        echo '
            <script>
                alert ("Error, el tamaño máximo de imagen permitido son 1.5MB");
                window.location="foto.php";
            </script>
        ';
    } else
    if ($subir_archivo) {
        // Insertar imagen en la Base de Datos
        $query = "INSERT INTO";
        $query .= " snirlpcd.persona_foto";
        $query .= " (";
        $query .= " persona_id,";
        $query .= " simagen,";
        $query .= " nusuario_creacion,";
        $query .= " )";
        $query .= " VALUES";
        $query .= " (";
        $query .= " '$persona_id',";
        $query .= " '$name_final',";
        $query .= " '$persona_id'";
        $query .= " )";

        if ($resultado = pg_query($conn, $query)) {
            echo '
                <script>
                    alert ("Se subió la foto correctamente");
                    window.location="foto.php";
                </script>
            ';
        } else {
            echo '
                <script>
                    alert ("Error, no se pudo subir la foto");
                    window.location="foto.php";
                </script>
            ';
        }
    } else {
        echo '
        <script>
            alert ("Ocurrió un error ineserado, vuelva a intentarlo");
            window.location="foto.php";
        </script>
    ';
    }
} else {
    echo '
        <script>
            alert ("No seleccionó ninguna imagen");
            window.location="foto.php";
        </script>
    ';
}

// Extrayendo la imagen
/* if (isset($_FILES["foto"])) { */
/* echo $files = $_FILES["foto"] . "<br>";
echo $name = $files["name"] . "<br>";
echo $tipo = $files["type"] . "<br>";
echo $ruta_tmp = $files["tmp_name"] . "<br>";
echo $size = $files["size"] . "<br>";
echo $dimensiones = getimagesize($ruta_tmp) . "<br>";
echo $width = $dimensiones[0] . "<br>";
echo $height = $dimensiones[1] . "<br>";
echo $carpeta = "../imagenes/fotos/" . "<br>";
die();
if ($tipo != 'image/jpg' && $tipo != 'image/JPG' && $tipo != 'image/jpeg' && $tipo != 'image/png' && $tipo != 'image/gif') {
    echo " Error, el archivo no es una imagen)";
    die();
} else
if ($size > 3 * 1024 * 1024) {
    echo "Error, el tamaño máximo de imagen permitido son 1.5MB";
    die();
} else {
    $src = $carpeta . $name;
    move_uploaded_file($ruta_tmp, $src);
    $imagen = "../imagenes/fotos/" . $name . $tipo;
} */
/* } else {
    $query = "INSERT INTO";
    $query .= " snirlpcd.persona_foto";
    $query .= " (";
    $query .= " persona_id,";
    $query .= " simagen,";
    $query .= " nusuario_creacion,";
    $query .= " )";
    $query .= " VALUES";
    $query .= " (";
    $query .= " '$persona_id',";
    $query .= " '$name',";
    $query .= " '$persona_id'";
    $query .= " )";

    if ($resultado = pg_query($conn, $query)) {
        echo "Se subió la foto correctamente";
        /* header('location: foto.php'); 
        die();
    } else {
        echo "Error, no se pudo subir la foto";
        /* header('location: foto.php'); 
        die();
    }
} */
