<?php
if (!defined('_PS_VERSION_')) {
    require_once '../../config/config.inc.php';
    require_once '../../init.php';
}


if (Db::getInstance()->execute("CREATE TABLE IF NOT EXISTS " . _DB_PREFIX_ . "formulario(id int auto_increment,Nombre Varchar(20) NOT NULL,Edad int NOT NULL,Fecha date NOT NULL,Fecha_creacion datetime NOT NULL,Fecha_Modificacion datetime NOT NULL,PRIMARY KEY(ID))")) {
    echo "Se crea correctamente";
} else {
    echo "No se creo. Error desconocido";
}