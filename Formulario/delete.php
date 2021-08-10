<?php
if (!defined(_PS_VERSION_)) {
    require_once "/../../config/config.inc.php";
    require_once "/../../init.php";
}
require_once "Resources.php";

if (!isset($_POST['texto'])) {
    return;
}

$resources = new Resources();
$resources->delete($_POST['numero']);
