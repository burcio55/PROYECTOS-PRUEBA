<?
    $host = "172.17.1.8";
    $dbname = "sigefirrhh";
    $user = "recibos.pagos";
    $pass = "produccionpasswd";

    session_start();

    try {
        $conn = pg_connect("host=$host port=5432 dbname=$dbname user=$user password=$pass");
    } catch (PDOException $error) {
        $conn = $error;
        echo ("Error al conectar en la Base de Datos " . $error);
    }
?>