<?php
$nombre_usuario ="warce";
$clave ="thor2021";
$base_datos ="socialnet";
$servidor = "localhost";

$conn = mysqli_connect($servidor,$nombre_usuario,$clave,$base_datos);
if ($conn-> connect_error)
{
    die("Fallo". mysqli_error($conn));
}
echo "Exito";
