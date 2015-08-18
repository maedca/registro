<?php
/**
 * Created by PhpStorm.
 * User: manuel
 * Date: 18/08/15
 * Time: 03:23 PM
 */

require_once 'func/conexiones.php';
$ced = $_POST['txtCedula'];
$nom = $_POST['txtNombres'];
$apel = $_POST['txtApellidos'];
$nac = $_POST['txtFechaNac'];
$tel = $_POST['txtTel'];
$dir = $_POST['txtDir'];

$sql = "INSERT INTO datospersonales (CEDULA, NOMBRES, APELLIDOS, FECHA_NAC, TEL, DIR) VALUES ('$ced', '$nom', '$apel', '$nac', '$tel', '$dir')";

$consulta = $link->query($sql);

if(!$consulta){
    echo "problemas en la insercion";
}else{
    echo 'guardado';
}