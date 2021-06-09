<?php
function conectarBD()
{
    $link = mysqli_connect(DBHOST, DBUSER, DBPASS, DBBASE);
    if ($link === false) {
        print "Falló la conexión: " . mysqli_connect_error();
        outputError(500);
    }
    return $link;
}