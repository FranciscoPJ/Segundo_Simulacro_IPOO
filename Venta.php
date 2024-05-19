<?php

class Venta{

    /*Se registra la siguiente información: número, fecha, referencia al cliente, referencia a una colección de motos y el precio final.
    */

    private $numero;
    private $fecha;
    private $objCliente;
    private $colMotos;
    private $precioFinal;

	public function __construct($numero, $fecha, $objCliente, $colMotos, $precioFinal) {

		$this->numero = $numero;
		$this->fecha = $fecha;
		$this->objCliente = $objCliente;
		$this->colMotos = $colMotos;
		$this->precioFinal = $precioFinal;
	}

    // get-------------------------------------------------------------------------------
	public function getNumero() {
		return $this->numero;
	}

	public function getFecha() {
		return $this->fecha;
	}

	public function getObjCliente() {
		return $this->objCliente;
	}

	public function getColMotos() {
		return $this->colMotos;
	}

	public function getPrecioFinal() {
		return $this->precioFinal;
	}

    // set-------------------------------------------------------------------------------
	public function setNumero($value) {
		$this->numero = $value;
	}

	public function setFecha($value) {
		$this->fecha = $value;
	}

	public function setObjCliente($value) {
		$this->objCliente = $value;
	}

	public function setColMotos($value) {
		$this->colMotos = $value;
	}

	public function setPrecioFinal($value) {
		$this->precioFinal = $value;
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
        
        $colMotos = $this->getColMotos();

        $info = "Numero de Venta: " . $this->getNumero() . "\n";
        $info .= "Fecha de Venta: " . $this->getFecha() . "\n";
        $info .= "Cliente: \n" . $this->getObjCliente() . "\n";
        $info .= "Coleccion de Moto: \n" . $this->mostrarArray($colMotos);
        $info .= "Precio Final Venta: $" . $this->getPrecioFinal() . "\n";

        return $info;

    }

    /*
    Implementar el método incorporarMoto($objMoto) que recibe por parámetro un objeto moto y lo incorpora a la colección de motos de la venta, siempre y cuando sea posible la venta. 
    
    El método cada vez que incorpora una moto a la venta, debe actualizar la variable instancia precio final de la venta. 
    
    Utilizar el método que calcula el precio de venta de la moto donde crea necesario.
    */

    public function incorporarMoto($objMoto){
        
        $colMotos = $this->getColMotos();
        $precioFinal = $this->getPrecioFinal();

        if($objMoto->getStock() == true){

            $costoMoto = $objMoto->darPrecioVenta();
            $precio = $precioFinal + $costoMoto;
            $this->setPrecioFinal($precio);
            
            array_push($colMotos, $objMoto);
            $this->setColMotos($colMotos);  

        }

    }

    /*
    Implementar el método retornarTotalVentaNacional() que retorna la sumatoria del precio venta de cada una de las motos Nacionales vinculadas a la venta.
    */

    public function retornarTotalVentaNacional(){
        
        $colMotos = $this->getColMotos();
        $acumuladorVentaTotal = 0;

        for($i = 0; $i < count($colMotos); $i++){

            if($colMotos[$i] instanceof Moto_Nacional){

                $acumuladorVentaTotal += $colMotos[$i]->darPrecioVenta();

            }

        }

        return $acumuladorVentaTotal;

    }

    /*
    Implementar el método retornarMotosImportadas() que retorna una colección de motos importadas vinculadas a la venta. 
    
    Si la venta solo se corresponde con motos Nacionales la colección retornada debe ser vacía.
    */

    public function retornarMotosImportadas(){
        
        $colMotos = $this->getColMotos();
        $colMotosImportadas = [];
        $o = 0;

        for($i = 0; $i < count($colMotos); $i++){

            if($colMotos[$i] instanceof Moto_Importada){

                $colMotosImportadas[$o] = $colMotos[$i];

                $o++;

            }

        }

        return $colMotosImportadas;
    }

}
?>