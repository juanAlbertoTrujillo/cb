<?php
require "../Modelos/modelo.php";
Class Clientes extends Modelo{
	
    protected $tabla = 'cliente';

    public function llenarDT($respuesta){
        foreach ($respuesta as $reg) {

            $data[]=array(
                "0"=>$reg["nombreCompleto"],
                "1"=>$reg["nombreComercial"],
                "2"=>$reg["rfc"],
                "3"=>$reg["email"],
                "4"=>$reg["cel"],
                "5"=>'<button class="btn-con btn-detalleLead" id="btn-detalleLead" onclick="mostrarInfoLead(\''.$reg["id"].'\')"><span class="material-symbols-sharp">edit_square</span></button>',
                "6"=>'<button class="btn-con btn-eliminarLead" id="btn-eliminarLead" onclick="eliminarLead(\''.$reg["id"].'\')"><span class="material-symbols-sharp">delete</span></button>'
            );
            } 
            $results = array(
                "sEcho"=>1, //Información para el datatables
                "iTotalRecords"=>count($data), //enviamos el total registros al datatable
                "iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
                "aaData"=>$data);
            echo json_encode($results);
    }

    public function actualizaController($id, $data){
        array_shift($data);
		$campos =[];
		foreach ($data as $key => $value){
			$campos[] = "{$key} = '{$value}'";
		}
		$campos = implode(', ', $campos);
        $this->actualizar($id,$campos);
    }

    public function guardaController($datos){
        array_shift($datos);
		array_shift($datos);
		$columna = array_keys($datos);
		$columna = implode(', ',$columna);

		$valores = array_values($datos);
		$valores = "'" . implode("', '", $valores) . "'";
        $this->guardar($columna, $valores);
    }

    public function busquedaFiltroController($data){
        array_shift($data);
		$campos =[];
		foreach ($data as $key => $value){
			$campos[] = "{$key} = '{$value}'";
		}
		$campos = implode(' and ', $campos);
        return $this->busquedaFiltro($campos);
    }
}
try {
    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        
        switch ($_GET["opcion"]){
            case 'eliminar':
                $cliente = new Clientes();
                $respuesta = $cliente->eliminar($_GET["identificador"]);
            break;
            case 'actualizar':
                $cliente = new Clientes();
                $respuesta = $cliente->busqueda($_GET["identificador"]);
                echo json_encode($respuesta);
            break;
            case 'validar':
                $cliente = new Clientes();
                $respuesta = $cliente->busquedaFiltroController($_GET);
                echo json_encode($respuesta);
            break;
            default:
                $cliente = new Clientes();
                $respuesta = $cliente->todo();
                $cliente->llenarDT($respuesta);
        }
        
    }elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
        
            if ($_POST['guardar'] && $_POST["id"]>0){
                $cliente = new Clientes();
                $cliente->actualizaController($_POST["id"],$_POST);
            }elseif ($_POST['guardar']) {
                $cliente = new Clientes();
                $cliente->guardaController($_POST);
            } 
            header("Location: ../Vistas/clientes.php");
    }
} catch (Exception $e) {
    echo 'Excepción capturada: ',  $e->getMessage(), "\n";
}