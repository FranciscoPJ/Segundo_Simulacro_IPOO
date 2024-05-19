<?php
/*
Se registra la siguiente información: denominación, dirección, la colección de clientes, colección de motos y la colección de ventas realizadas.
*/
class Empresa{
    
    private $denominacion;
    private $direccion;
    private $colClientes;
    private $colMotos;
    private $colVentas;

	public function __construct($denominacion, $direccion, $colClientes, $colMotos, $colVentas) {

		$this->denominacion = $denominacion;
		$this->direccion = $direccion;
		$this->colClientes = $colClientes;
		$this->colMotos = $colMotos;
		$this->colVentas = $colVentas;
	}

    // get-------------------------------------------------------------------------------
	public function getDenominacion() {
		return $this->denominacion;
	}

	public function getDireccion() {
		return $this->direccion;
	}

	public function getColClientes() {
		return $this->colClientes;
	}

	public function getColMotos() {
		return $this->colMotos;
	}

	public function getColVentas() {
		return $this->colVentas;
	}

    // set-------------------------------------------------------------------------------
	public function setDenominacion($value) {
		$this->denominacion = $value;
	}

	public function setDireccion($value) {
		$this->direccion = $value;
	}

	public function setColClientes($value) {
		$this->colClientes = $value;
	}

	public function setColMotos($value) {
		$this->colMotos = $value;
	}

	public function setColVentas($value) {
		$this->colVentas = $value;
	}

    private function mostrarArray($array){
        
        $lista = "";
        $i = 1;
        
        foreach($array as $obj){
            $lista .= "[" . $i++ . "]\n" . $obj . "\n";
        }

        return $lista;
    }

    public function __toString(){
        
        $colClientes = $this->getColClientes();
        $colMotos = $this->getColMotos();
        $colVentas = $this->getColVentas();

        $info = "Informacion de la Empresa:\n";
        $info .= "# Denominacion: " . $this->getDenominacion() . "\n";
        $info .= "# Direccion: " . $this->getDireccion() . "\n";
        $info .= "# Coleccion de Cliente: \n" . $this->mostrarArray($colClientes);
        $info .= "# Coleccion de Moto: \n" . $this->mostrarArray($colMotos);
        $info .= "# Coleccion de Venta: \n" . $this->mostrarArray($colVentas);

        return $info;
    }

    /*
    Implementar el método informarSumaVentasNacionales() que recorre la colección de ventas realizadas por la empresa y retorna el importe total de ventas Nacionales realizadas por la empresa.
    */
    public function informarSumaVentasNacionales(){
        
        $colVentas = $this->getColVentas();

        $acumuladorVentaTotal = 0;

        for($i = 0; $i < count($colVentas); $i++){

            if($colVentas[$i]->retornarTotalVentaNacional() != 0){

                $acumuladorVentaTotal += $colVentas[$i]->retornarTotalVentaNacional();

            }

        }

        return $acumuladorVentaTotal;
    }

    /*
    Implementar el método informarVentasImportadas() que recorre la colección de ventas realizadas por la empresa y retorna una colección de ventas de motos importadas. 
    
    Si en la venta al menos una de las motos es importada la venta debe ser informada.
    */
    public function informarVentasImportadas(){

        $colVentas = $this->getColVentas();
        $colMotosImportadas = [];
        $o = 0;

        for($i = 0; $i < count($colVentas); $i++){

            foreach($colVentas[$i]->getColMotos() as $obj){

                if($obj instanceof Moto_Importada){

                    $colMotosImportadas[$o] = $obj;

                    $o++;

                } // fin if

            } // fin foreach

        } // fin for

        return $colMotosImportadas;
    }

    /*
    Implementar el método retornarMoto($codigoMoto) que recorre la colección de motos de la Empresa retorna la referencia al objeto moto cuyo código coincide con el recibido por parámetro.
    */
    public function retornarMoto($codigoMoto){
        
        $colMoto = $this->getColMotos();
        $encontrado = false;
        $objMoto = null;
        $i = 0;

        while($i < count($colMoto) && !$encontrado){
            
            if($colMoto[$i]->getCodigo() == $codigoMoto){

                $encontrado = true;
                $objMoto = $colMoto[$i];
            }
            
            $i++;
        }

        return $objMoto;

    }

    /*
    Implementar el método registrarVenta($colCodigosMoto, $objCliente) método que recibe por parámetro una colección de códigos de motos, la cual es recorrida, y por cada elemento de la colección se busca el objeto moto correspondiente al código y se incorpora a la colección de motos de la instancia Venta que debe ser creada.

    Recordar que no todos los clientes ni todas las motos, están disponibles para registrar una venta en un momento determinado.

    El método debe setear los variables instancias de venta que corresponda y retornar el importe final de la venta.
    */

    public function registrarVenta($colCodigosMoto, $objCliente){

        $colVenta = $this->getColVentas();
        $nuevaVenta = new Venta((count($colVenta)+1), date("d-m-Y"), $objCliente, [], 0);

        if($objCliente->getEstado() == true){
            
            for($i = 0; $i < count($colCodigosMoto); $i++){

                $objMoto = $this->retornarMoto($colCodigosMoto[$i]);

                if($objMoto != null){

                    $nuevaVenta->incorporarMoto($objMoto);

                } // fin if

            } // fin for

        } // fin if

        if($nuevaVenta != null){

            // Precio Final
            $precioFinal = $nuevaVenta->getPrecioFinal();

            //agrego la venta a la coleccion de ventas de la empresa
            array_push($colVenta, $nuevaVenta);
            
            $this->setColVentas($colVenta);

        }
        else{
            $precioFinal = 0;
        }

        return $precioFinal;

    }

}
?>