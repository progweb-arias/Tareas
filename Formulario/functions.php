<?php
class Resources{
    public function validate(){
        if (!isset($_POST['texto']) || !isset($_POST['numero']) || !isset($_POST['fecha'])) {
            return;
        }
        $dato1 = $_POST['texto'];
        $dato2 = $_POST['numero'];
        $dato3 = $_POST['fecha'];
        $resultados = ["correcto" => [], "error" => []];
        $cadena = array("texto" => $dato1, "numero" => $dato2, "fecha" => $dato3);
        foreach ($cadena as $key => $i) {
            if (empty(trim($cadena[$key]))) {
                $resultados["error"][] = $key;
            } else {
                $resultados["correcto"][] = $key;
            }
        }
        die(json_encode($resultados));
    } 
}
