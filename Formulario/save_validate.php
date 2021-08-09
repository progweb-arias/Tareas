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
$resources->save_validate($_POST['texto'], $_POST['edad'], $_POST['fecha']);
