<?php

class Moto{

    private $codigo;
    private $descripcion;
    private $anioFabricacion;
    private $porcentajeAnual;
    private $costo; //int
    private $stock; // boolean

	public function __construct($codigo, $descripcion, $anioFabricacion, $porcentajeAnual, $costo, $stock) {

		$this->codigo = $codigo;
		$this->descripcion = $descripcion;
		$this->anioFabricacion = $anioFabricacion;
        $this->porcentajeAnual = $porcentajeAnual;
		$this->costo = $costo;
		$this->stock = $stock;
        
	}

    // get---------------------------------------------------------------------
	public function getCodigo() {
		return $this->codigo;
	}

	public function getDescripcion() {
		return $this->descripcion;
	}

	public function getAnioFabricacion() {
		return $this->anioFabricacion;
	}

    public function getPorcentajeAnual() {
		return $this->porcentajeAnual;
	}

	public function getCosto() {
		return $this->costo;
	}

	public function getStock() {
		return $this->stock;
	}

    // set---------------------------------------------------------------------
	public function setCodigo($value) {
		$this->codigo = $value;
	}

	public function setDescripcion($value) {
		$this->descripcion = $value;
	}

	public function setAnioFabricacion($value) {
		$this->anioFabricacion = $value;
	}

    public function setPorcentajeAnual($value) {
		$this->porcentajeAnual = $value;
	}

	public function setCosto($value) {
		$this->costo = $value;
	}

	public function setStock($value) {
		$this->stock = $value;
	}

    private function motrarStock($value){
        
        if($value == true){
            $res = "Disponible";
        }
        else{
            $res = "No Disponible";
        }

        return $res;
    }

    public function __toString(){
        
        $info = "     Codigo: " . $this->getCodigo() . "\n";
        $info .= "     Descripcion: " . $this->getDescripcion() . "\n";
        $info .= "     Anio de Fabricacion: " . $this->getAnioFabricacion() . "\n";
        $info .= "     Porcentaje Anual: " . $this->getPorcentajeAnual() . "%\n";
        $info .= "     Costo: $" . $this->getCosto() . "\n";
        $info .= "     Stock: " . $this->motrarStock($this->getStock()) . "\n";

        return $info;

    }

    /*
    Redefinir el método darPrecioVenta para que en el caso de las motos nacionales aplique el porcentaje de descuento sobre el valor calculado inicialmente. Para el caso de las motos importadas, al valor calculado se debe sumar el impuesto que pagó la empresa por su importación. 
    
    A continuación se describe el método darPrecioVenta con el objetivo de tener presente su implementación y realizar las modificaciones que crea necesarias para dar soporte al nuevo requerimiento.

    IMPORTANTE
    Si la moto no se encuentra disponible para la venta retorna un valor < 0. Si la moto está disponible para la venta, el método realiza el siguiente cálculo:

        $_venta = $_compra + $_compra * (anio * por_inc_anual)

    donde $_compra: es el costo de la moto.
    anio: cantidad de años transcurridos desde que se fabricó la moto.
    por_inc_anual: porcentaje de incremento anual de la moto
    */

    public function darPrecioVenta(){

        // incializacion
        $por_inc_anual = $this->getPorcentajeAnual();
        $disponibilidad = $this->getStock();
        $compra = $this->getCosto();
        $anio = (2024 - $this->getAnioFabricacion());
        $venta = 0;

        if($disponibilidad != false){

            $venta = $compra + $compra * (($anio * $por_inc_anual)/100);

        }

        return $venta;

    }

}
?>