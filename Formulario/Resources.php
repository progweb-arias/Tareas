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
    public function save_validate(string $nombre, int $edad, string $fecha)
    {
        $variable = $this->validate($nombre, $edad, $fecha);
        if (count($variable['correcto']) == 3) {
            $fecha = date('Y-m-d', strtotime($fecha));
            return Db::getInstance()->execute("INSERT INTO " . _DB_PREFIX_ . "formulario(Nombre,Edad,Fecha,Fecha_creacion,Fecha_Modificacion) VALUES('$nombre',$edad,'$fecha',NOW(),NOW())");
        }
        return $variable;
    }
    /**
     * Funcion de borrar en la tabla
     * @param string $nombre
     * 
     * @return bool
     */
    public function delete(string $nombre)
    {
        $array = [];
        if (count(Db::getInstance()->executeS("SELECT Nombre FROM " . _DB_PREFIX_ . "formulario WHERE Nombre='$nombre'"))) {
            return Db::getInstance()->execute("UPDATE " . _DB_PREFIX_ . "formulario SET Fecha_Modificacion=NOW() , deleted=1 , date_deleted=NOW() WHERE Nombre='$nombre'");
        } else {
            return $array;
        }
    }
    /**
     * Funcion mostrar tabla
     * @param string $nombre
     * @param string $fecha_desde
     * @param string $fecha_hasta
     * @param int $borrado
     * 
     * @return bool
     */
    public function search(string $nombre, string $fecha_desde, string $fecha_hasta, int $borrado)
    {
        if ($borrado < 1) {
            $comprobacion = ['rellenados' => '', 'blanco' => ''];
            $campos = array("texto" => $nombre, "fecha_desde" => $fecha_desde, "fecha_hasta" => $fecha_hasta, "borrados" => $borrado);
            foreach ($campos as $key => $i) {
                if (empty(trim($key))) {
                    $comprobacion['rellenados'][] = $key;
                } else {
                    $comprobacion['blanco'][] = $key;
                }
                if (count($comprobacion['rellenados']) == 3) {
                    return Db::getInstance()->executeS("SELECT * FROM " . _DB_PREFIX_ . "formulario WHERE Nombre=$nombre,deleted=0,Fecha between $fecha_desde and $fecha_hasta");
                } else {
                    if (count($comprobacion['blanco']) == 1) {
                        foreach ($comprobacion['blanco'] as $key => $i) {
                            if ($key = 'texto') {
                                return Db::getInstance()->executeS("SELECT * FROM " . _DB_PREFIX_ . "formulario WHERE deleted=0");
                            }
                            if ($key = 'fecha_desde') {
                                return Db::getInstance()->executeS("SELECT * FROM " . _DB_PREFIX_ . "formulario WHERE Nombre=$nombre,deleted=0,Fecha<$fecha_hasta");
                            }
                            if ($key = 'fecha_hasta') {
                                return Db::getInstance()->executeS("SELECT * FROM " . _DB_PREFIX_ . "formulario WHERE Nombre=$nombre,deleted=0,Fecha>$fecha_desde");
                            }
                        }
                    } else {
                    }
                }
            }
        }
    }
    // $comprobacion = ['rellenados' => '', 'blanco' => ''];
    // $campos = array("texto" => $nombre, "fecha_desde" => $fecha_desde, "fecha_hasta" => $fecha_hasta, "borrados" => $borrado);
    // foreach ($campos as $key => $i) {
    //     if (empty(trim($key))) {
    //         $comprobacion['rellenados'][] = $key;
    //     } else {
    //         $comprobacion['blanco'][] = $key;
    //     }
    // }
    // if (count($comprobacion['rellenados']) == 4) {
    // return Db::getInstance()->executeS("SELECT * FROM " . _DB_PREFIX_ . "formulario WHERE Nombre=$nombre,deleted=$borrado,Fecha between $fecha_desde and $fecha_hasta");

    // }
    // return $comprobacion;

}
