<?php
if (!defined('_PS_VERSION_')) {
    require_once '../../config/config.inc.php';
    require_once '../../init.php';
}
require_once 'Resources.php';
if (!isset($_POST['texto']) || !isset($_POST['numero']) || !isset($_POST['fecha'])) {
    return;
}
$resources = new Resources();
$validacion = $resources->validate($_POST['texto'], $_POST['numero'], $_POST['fecha']);
if (count($validacion['correcto']) == 3) {
    $resultados = $resources->save_validate($_POST['texto'], $_POST['numero'], $_POST['fecha']);
} else {
    $resultados = $validacion;
}


die(json_encode($resultados));
