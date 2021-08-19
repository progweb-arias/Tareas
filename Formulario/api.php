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
        // llamar la funcion validar llamandola y guardando el resultado en $resultados
        $resultados = $resources->validate(Tools::getValue('texto', ''), (int)Tools::getValue('numero', 0), Tools::getValue('fecha', ''));
        break;
        // Para el caso save_validate
    case 'save_validate':
        // llamar la funcion de validar y guardandola en $validacion
        // $validacion = $resources->validate(Tools::getValue('texto', ''), (int)Tools::getValue('numero', 0), Tools::getValue('fecha', ''));
        // pasar el resultado de la funcion y comprobar que todos los parametros son correctos
        // if (count($validacion['correcto']) == 3) {
        // si lo son llamar la funcion de save_validate y almacenarla en $resultados
        $resultados = $resources->save_validate(Tools::getValue('texto', ''), (int)Tools::getValue('numero', 0), Tools::getValue('fecha', ''));
        // } else {
        // si no almacenar los datos en $resultado
        // $resultados = $validacion;
        // }
        break;
        // Para el caso delete 
    case 'delete':
        // llamar la funcion delete y almacenarla en $resultados
        $resultados = $resources->delete(Tools::getValue('texto', ''));
        break;
        // en caso de que no entren en ningun caso por no establecer bien el action
        // Para el caso showTable
    case 'search':
        $resultados = $resources->search(Tools::getValue('texto', ''), Tools::getValue('fecha_desde', ''), Tools::getValue('fecha_hasta', ''), Tools::getValue('boton', ''));
        break;
    case 'update':
        $resultados = $resources->update(Tools::getValue('texto', ''), (int)Tools::getValue('numero', 0), Tools::getValue('fecha', ''), Tools::getValue('fecha_desde', ''));
        break;
    case 'boton1':
        $resultados = $resources->boton1((int)Tools::getValue('boton1', 0));
        break;
    case 'boton2':
        $resultados = $resources->boton2((int)Tools::getValue('boton2', 0));
        break;
    case 'boton3':
        $resultados = $resources->boton3((int)Tools::getValue('boton3', 0));
        break;
    case 'boton4':
        $resultados = $resources->boton4((int)Tools::getValue('boton4', 0));
        break;
    default:
        // devuelve un string
        $resultados = 'a';
        break;
}
// Envia mediante un formato json $resultados
die(json_encode($resultados));
