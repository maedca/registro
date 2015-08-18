<?php
/**
 * Created by PhpStorm.
 * User: manuel
 * Date: 18/08/15
 * Time: 02:28 PM
 */

$link = new mysqli("localhost", "root", "root", "estudiante");
if ($link->connect_error)
    die("no se puede conectar a la base de datos");