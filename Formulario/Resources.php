<?php

use Doctrine\DBAL\Types\IntegerType;

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
     * @param string $borrado
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
     * @param string $borrado
     * 
     * @return bool
     */
    public function search(string $nombre, string $fecha_desde, string $fecha_hasta, string $borrado, string $boton)
    {
        $array = array('Nombre' => $nombre, 'Fecha_creacion' => $fecha_desde, 'Fecha_creacion2' => $fecha_hasta, 'deleted' => $borrado);
        $query = "SELECT * FROM "  . _DB_PREFIX_ .  "formulario WHERE ";
        $where = [];
        $limit = ' LIMIT 1,5';
        foreach ($array as $columna => $valor) {
            if ($columna == 'Nombre') {
                if (!empty(trim($valor))) {
                    $where[] =  "$columna LIKE '$valor%'";
                }
            } elseif ($columna == 'Fecha_creacion') {
                if (!empty(trim($valor))) {
                    $valor = date('Y-m-d', strtotime($fecha_desde));
                    $where[] = "Fecha_creacion > '$valor'";
                }
            } elseif ($columna == 'Fecha_creacion2') {
                if (!empty(trim($valor))) {
                    $valor = date('Y-m-d', strtotime($fecha_hasta));
                    $where[] = "Fecha_creacion < '$valor'";
                }
            } else {
                if ($valor == 'true') {
                    $where[] = "$columna=1";
                } else {
                    $where[] = "$columna=0";
                }
            }
            continue;
        }
        if ($boton == 'uno') {
            $limit = ' LIMIT 1,5';
        }
        if ($boton == 'dos') {
            $limit = ' LIMIT 5,5';
        }
        if ($boton == 'tres') {
            $limit = ' LIMIT 10,5';
        }
        if ($boton == 'cuatro') {
            $limit = ' LIMIT 15,5';
        }
        if ($boton == 'cinco') {
            $limit = ' LIMIT 20,5';
        }

        $query .= implode(' AND ', $where);
        $query .= $limit;
        return Db::getInstance()->executeS($query);
    }
    public function update(string $nombre, int $edad, string $fecha, string $fecha_desde)
    {
        $array = array("Nombre" => $nombre, "Edad" => $edad, "Fecha" => $fecha);
        foreach ($array as $variables) {
            if (!$variables) {
                return $array;
            }
        }
        return Db::getInstance()->execute("UPDATE " . _DB_PREFIX_ . "formulario SET Nombre='$nombre', Edad=$edad, Fecha='$fecha' WHERE Fecha_creacion= '$fecha_desde'");
    }
    //     public function contador(string $nombre)
    //     {
    //         // echo "SELECT COUNT(*) FROM " . _DB_PREFIX_ . "formulario";
    //         return Db::getInstance()->executeS("SELECT COUNT('$nombre') FROM " . _DB_PREFIX_ . "formulario");
    //     }
}
