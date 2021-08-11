<?php
if (!defined('_PS_VERSION_')) {
    require_once '../../config/config.inc.php';
    require_once '../../init.php';
}

if (Db::getInstance()->execute("ALTER TABLE " . _DB_PREFIX_ . "formulario ADD COLUMN deleted bool NOT NULL,ADD COLUMN date_deleted datetime NULL")) {
    echo "Tabla actualizada";
} else {
    echo "Error al añadir columnas.";
}
