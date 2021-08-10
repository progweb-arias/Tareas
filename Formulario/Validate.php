<?php
if (!defined('_PS_VERSION_')) {
    require_once '../../config/config.inc.php';
    require_once '../../init.php';
}

require_once "Resources.php";


if (!isset($_POST['texto']) || !isset($_POST['numero']) || !isset($_POST['fecha'])) {
    return;
}

$resources = new Resources();
$resultados = $resources->validate($_POST['texto'], (int)$_POST['numero'], $_POST['fecha']);

die(json_encode($resultados));

// CreacionTabla
// CREATE TABLE _DB_PREFIX_ . formulario(id int autoincrement,Nombre Varchar(20) NOT NULL,Edad int NOT NULL,Fecha date NOT NULL,Fecha_creacion date NOT NULL,Fecha_Modificacion date NOT NULL);
// InsertarValores
// INSERT INTO Datos(Nombre,Edad,Fecha,Fecha_creacion,Fecha_Modificacion) VALUES ("Alejandro",20,'05/08/2021',NOW(),NOW());
// ModificarValores
// UPDATE Datos SET Edad = 22 and SET Fecha_Modificacion = NOW() WHERE Nombre = Alejandro;
// BorrarDatos
// DELETE FROM Datos WHERE id = 1;