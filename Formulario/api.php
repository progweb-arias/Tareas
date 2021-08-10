<?php
// Verificacion de acceso a prestashop. Si no accedio requerir
// estos archivos
if (!defined('_PS_VERSION_')) {
    require_once '../../config/config.inc.php';
    require_once '../../init.php';
}
// Requerir acceso al Resources.php para poder acceder a las funciones
require_once 'Resources.php';
//Obtener el valor action del metodo GET
$action = Tools::getValue('action', '');
//Entrar en el switch con el valor del action obtenido anteriormente y realizar las distintas llamadas en funcion 
//dicho valor
$resources = new Resources();
switch ($action) {
        // Para el caso validate
    case 'validate':
        $resultados = $resources->validate(Tools::getValue('texto', ''), (int)Tools::getValue('numero', ''), Tools::getValue('fecha', ''));
        die(json_encode($resultados));
        break;
        // Para el caso save_validate
    case 'save_validate':
        $validacion = $resources->validate(Tools::getValue('texto', ''), Tools::getValue('numero', ''), Tools::getValue('fecha', ''));
        if (count($validacion['correcto']) == 3) {
            $resultados = $resources->save_validate(Tools::getValue('texto', ''), Tools::getValue('numero', ''), Tools::getValue('fecha', ''));
        } else {
            $resultados = $validacion;
        }
        die(json_encode($resultados));
        break;
        // Para el caso delete
    case 'delete':
        $resultados = $resources->delete(Tools::getValue('texto', ''));
        die(json_encode($resultados));
        break;
    default:
        break;
}
