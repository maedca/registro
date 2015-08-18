<?php
require_once 'func/conexiones.php';
$ced = $_POST['txtCedula'];
$nom = $_POST['txtNombres'];
$apel = $_POST['txtApellidos'];
$nac = $_POST['txtFechaNac'];
$tel = $_POST['txtTel'];
$dir = $_POST['txtDir'];

$sql = "UPDATE datospersonales SET NOMBRES = '$nom', APELLIDOS = '$apel', FECHA_NAC = '$nac', TEL = '$tel', DIR = '$dir' WHERE CEDULA = '$ced'";
$registro = $link->query($sql);
if(!$registro)
{
    echo "Ha ocurrido un error en el procesamiento de la informacion". $sql;
}
else
{
    echo "El estudiante ha sido actualizado satisfactoriamente...";
}
