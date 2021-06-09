<?php
require_once '../auxiliares/jwthelp.php';
include('../db/infodb.php');
include('../auxiliares/HandleErrors.php');
include ('../auxiliares/dbfunctions.php');
define('ALGORITMO', 'HS512'); // Algoritmo de codificación/firma
define('SECRET_KEY', 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJhdXRvcml6YWRvIjoidHJ1ZSJ9.yzVDphCD7KasXsPZ4bPKOMZKnd7IGrKSdjfmxTdIlVE');

function outputJson($data, $codigo = 200)
{
    header('', true, $codigo);
    header('Content-type: application/json');
    print json_encode($data);
    die;
}

function requireLogin () {
    $authHeader = getallheaders();
    try
    {
        list($jwt) = @sscanf( $authHeader['Authorization'], 'Bearer %s');
        $datos = JWT::decode($jwt, SECRET_KEY, ALGORITMO);
        if (time() > $datos->expira) {
            postLogout();
            throw new Exception("Token expirado", 1);
        }
        $link = conectarBD();
        $resultado = mysqli_query($link, "SELECT 1 FROM tokens WHERE token = '$jwt'");
        if (!($resultado && mysqli_num_rows($resultado)==1)) {
            throw new Exception("Token inválido", 1);
        }
        mysqli_close($link);
    } catch(Exception $e) {
        outputError(401);
    }
}
function getContactos()
{
    $link = conectarBD();
    $sql = "SELECT id, nombre, apellido, email FROM contactos";
    $resultado = mysqli_query($link, $sql);
    if ($resultado === false) {
        print "Falló la consulta: " . mysqli_error($link);
        outputError(500);
    }
    $ret = [];
    while ($fila = mysqli_fetch_assoc($resultado)) {
        $ret[] = [
            'id'       => $fila['id'],
            'apellido' => $fila['apellido'],
            'nombre'   => $fila['nombre'],
            'email'    => $fila['email']
        ];
    }

    mysqli_free_result($resultado);
    mysqli_close($link);
    outputJson($ret);
}

function getContactosConParametros($id)
{
    $id += 0;
    $link = conectarBD();
    $sql = "SELECT * FROM contactos WHERE id=$id";
    $resultado = mysqli_query($link, $sql);
    if ($resultado === false) {
        print "Falló la consulta: " . mysqli_error($link);
        outputError(500);
    }
    if (mysqli_num_rows($resultado) == 0) {
        outputError(404);
    }

    $ret = mysqli_fetch_assoc($resultado);

    mysqli_free_result($resultado);
    mysqli_close($link);
    outputJson($ret);
}

function postContactos()
{
    $link = conectarBD();
    $dato = json_decode(file_get_contents('php://input'), true);

    $nombre = $dato['nombre'];
    $apellido = $dato['apellido'];
    $email = $dato['email'];
    $domicilio = isset($dato['domicilio']) ? ("'" . $dato['domicilio'] . "'") : 'NULL';
    $fdn = isset($dato['fecha_de_nacimiento']) ? ("'" . substr($dato['fecha_de_nacimiento'], 0, 10) . "'") : 'NULL';
    if ($fdn != 'NULL') {
        list($anio, $mes, $dia) = explode('-', str_replace("'", "", $fdn));
        if (!checkdate($mes, $dia, $anio)) {
            outputError(400);
        }
    }
    $sql = "INSERT INTO contactos (nombre, apellido, email, fecha_de_nacimiento, domicilio) 
                VALUES ('$nombre', '$apellido', '$email', $fdn, $domicilio)";
    $resultado = mysqli_query($link, $sql);
    if ($resultado === false) {
        print "Falló la consulta: " . mysqli_error($link);
        outputError(500);
    }
    $ret = [
        'id' => mysqli_insert_id($link)
    ];
    mysqli_close($link);
    outputJson($ret, 201);
}

function patchContactos($id)
{
    $id += 0;
    $link = conectarBD();
    $dato = json_decode(file_get_contents('php://input'), true);

    $nombre = $dato['nombre'];
    $apellido = $dato['apellido'];
    $email = $dato['email'];
    $domicilio = isset($dato['domicilio']) ? ("'" . $dato['domicilio'] . "'") : 'NULL';
    $fdn = isset($dato['fecha_de_nacimiento']) ? ("'" . substr($dato['fecha_de_nacimiento'], 0, 10) . "'") : 'NULL';
    if ($fdn != 'NULL') {
        list($anio, $mes, $dia) = explode('-', str_replace("'", "", $fdn));
        if (!checkdate($mes + 0, $dia + 0, $anio + 0)) {
            outputError(400);
        }
    }

    $sql = "UPDATE contactos SET nombre = '$nombre',
                                 apellido = '$apellido',
                                 email = '$email',
                                 fecha_de_nacimiento = $fdn,
                                 domicilio = $domicilio WHERE id = $id";

    $resultado = mysqli_query($link, $sql);
    if ($resultado === false) {
        print "Falló la consulta: " . mysqli_error($link);
        outputError(500);
    }
    $ret = [];
    mysqli_close($link);
    outputJson($ret, 201);
}

function deleteContactos($id)
{
    $id += 0;
    $link = conectarBD();
    $sql = "SELECT id FROM contactos WHERE id=$id";
    $resultado = mysqli_query($link, $sql);
    if ($resultado === false) {
        print "Falló la consulta: " . mysqli_error($link);
        outputError(500);
    }
    if (mysqli_num_rows($resultado) == 0) {
        outputError(404);
    }
    mysqli_free_result($resultado);
    $sql = "DELETE FROM contactos WHERE id=$id";
    $resultado = mysqli_query($link, $sql);
    if ($resultado === false) {
        print "Falló la consulta: " . mysqli_error($link);
        outputError(500);
    }
    mysqli_close($link);
    outputJson([], 202);
}
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
