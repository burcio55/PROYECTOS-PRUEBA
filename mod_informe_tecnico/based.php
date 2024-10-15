<?
    $host = "10.46.1.93";
    $dbname = "minpptrassi";
    $user = "postgres";
    $pass = "postgres";

    session_start();

    try {
        $conn = pg_connect("host=$host port=5432 dbname=$dbname user=$user password=$pass");
    } catch (PDOException $error) {
        $conn = $error;
        echo ("Error al conectar en la Base de Datos " . $error);
    }
?>