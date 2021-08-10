<?php
if (!defined('_PS_VERSION_')) {
    require_once '../../config/config.inc.php';
    require_once '../../init.php';
}
require_once "Resources.php";

if (!isset($_POST['texto'])) {
    return;
}

$resources = new Resources();
$resultados = $resources->delete($_POST['texto']);

die(json_encode($resultados));
