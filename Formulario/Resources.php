<?php
class Resources
{
    public function validate($nombre, $edad, $fecha)
    {
        $resultados = ["correcto" => [], "error" => []];
        $cadena = array("texto" => $nombre, "numero" => $edad, "fecha" => $fecha);
        foreach ($cadena as $key => $i) {
            if (empty(trim($cadena[$key]))) {
                $resultados["error"][] = $key;
            } else {
                $resultados["correcto"][] = $key;
            }
        }
        return $resultados;
    }
    public function save_validate($nombre, $edad, $fecha)
    {
        $fecha = date('Y-m-d', strtotime($fecha));
        return Db::getInstance()->execute("INSERT INTO " . _DB_PREFIX_ . "formulario(Nombre,Edad,Fecha,Fecha_creacion,Fecha_Modificacion) VALUES('$nombre',$edad,'$fecha',NOW(),NOW())");
    }
    public function delete($nombre, $edad, $fecha)
    {
        return Db::getInstance()->execute("DELETE FROM " . _DB_PREFIX_ . "formulario WHERE Nombre='$nombre'");
    }
}
