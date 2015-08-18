<?php
/**
 * Created by PhpStorm.
 * User: manuel
 * Date: 18/08/15
 * Time: 04:25 PM
 */
require 'func/conexiones.php';
$ced = $_POST['cedula'];
 $sql = "SELECT CEDULA, NOMBRES, APELLIDOS, FECHA_NAC, TEL, DIR FROM datospersonales WHERE CEDULA = '$ced'";


$registro = $link->query($sql);
$info = array();

while($datos = $registro->fetch_array()) {
    $nombres = $datos['NOMBRES'];
    $apellidos = $datos['APELLIDOS'];
    $fn = $datos['FECHA_NAC'];
    $tel = $datos['TEL'];
    $dir = $datos['DIR'];

}

$info['ced'] = $ced;
$info['nom'] = $nombres;
$info['apel'] = $apellidos;
$info['fn'] = $fn;
$info['tel'] = $tel;
$info['dir'] = $dir;

echo json_encode($info);