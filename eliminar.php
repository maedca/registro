<?php
require_once 'func/conexiones.php';
$ced = $_POST['cedula'];


$sql = "DELETE FROM datospersonales WHERE CEDULA = '$ced'";
$registro = $link->query($sql);

echo "El estudiante ha sido eliminado satisfactoriamente...".  mysql_error();