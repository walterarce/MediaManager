<?php
include ("DB/infodb.php");

$conn = mysqli_connect(servidor,nombre_usuario,clave,base_datos);
if ($conn-> connect_error)
{
    die("Fallo". mysqli_error($conn));
}
echo "Exito";

//TODO: Resolver todo el CRUD

if (!isset($_GET['accion'])) {
    outputError(400);
}

$metodo = strtolower($_SERVER['REQUEST_METHOD']);
$accion = explode('/', strtolower($_GET['accion']));
$funcionNombre = $metodo . ucfirst($accion[0]);
$parametros = array_slice($accion, 1);
if (count($parametros) >0 && $metodo == 'get') {
    $funcionNombre = $funcionNombre.'ConParametros';
}
if (function_exists($funcionNombre)) {
    call_user_func_array ($funcionNombre, $parametros);
} else {
    outputError(400);
}
