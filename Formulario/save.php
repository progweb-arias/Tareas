<?php
if (!defined('_PS_VERSION_')) {
    require_once '../../config/config.inc.php';
    require_once '../../init.php';
}


if (!isset($_POST['texto']) || !isset($_POST['numero']) || !isset($_POST['fecha'])) {
    return;
}

$dato1 = $_POST['texto'];
$dato2 = $_POST['numero'];
$dato3 = $_POST['fecha'];

$dato3 = date("Y-m-d", strtotime($dato3));


var_dump(Db::getInstance()->execute("INSERT INTO " . _DB_PREFIX_ . "formulario (Nombre,Edad,Fecha,Fecha_creacion,Fecha_Modificacion) VALUES ('$dato1',$dato2,'$dato3',NOW(),NOW())"));
echo ("INSERT INTO " . _DB_PREFIX_ . "formulario (Nombre,Edad,Fecha,Fecha_creacion,Fecha_Modificacion) VALUES ('$dato1',$dato2,'$dato3',NOW(),NOW()");
