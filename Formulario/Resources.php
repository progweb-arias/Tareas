<?php
class Resources
{
    /**
     * Funcion validar campos
     * @param string $nombre 
     * @param int $edad 
     * @param string $fecha
     * 
     * @return array      
     */
    public function validate(string $nombre, int $edad, string $fecha)
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
    /**
     * Funcion de validar y guardar los datos en una tabla
     * @param string $nombre
     * @param int $edad  
     * @param string $fecha
     * 
     * @return bool
     */
    public function save_validate(string $nombre, int $edad, string $fecha): bool
    {
        $fecha = date('Y-m-d', strtotime($fecha));
        return Db::getInstance()->execute("INSERT INTO " . _DB_PREFIX_ . "formulario(Nombre,Edad,Fecha,Fecha_creacion,Fecha_Modificacion) VALUES('$nombre',$edad,'$fecha',NOW(),NOW())");
    }
    /**
     * Funcion de borrar en la tabla
     * @param string $nombre
     * 
     * @return bool
     */
    public function delete(string $nombre): bool
    {
        return Db::getInstance()->execute("DELETE FROM " . _DB_PREFIX_ . "formulario WHERE Nombre='$nombre'");
    }
}
