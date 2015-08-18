<?php
/**
 * Created by PhpStorm.
 * User: manuel
 * Date: 18/08/15
 * Time: 02:28 PM
 */

function Conectar(){
    $servidor = "localhost";
    $usuarios = "root";
    $clave = "root";
    $db = "estudiante";

    $con = mysql_connect($servidor, $usuarios, $clave) or die("no se puede conectar");
    mysql_select_db($db);

    return $con;
}