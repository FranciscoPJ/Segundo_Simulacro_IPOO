<?php

class Moto_Nacional extends Moto{

    private $porDescuento;

	public function __construct($codigo, $descripcion, $anioFabricacion, $importeAnual, $costo, $stock) {

        parent::__construct($codigo, $descripcion, $anioFabricacion, $importeAnual, $costo, $stock);
		$this->porDescuento = 15;

	}

	public function getporDescuento() {
		return $this->porDescuento;
	}

	public function setporDescuento($value) {
		$this->porDescuento = $value;
	}

    public function __toString(){
        
        $info = parent::__toString();

        return $info;

    }

    /*
    Redefinir el método darPrecioVenta para que en el caso de las motos nacionales aplique el importe de descuento sobre el valor calculado inicialmente. 
    
    Para el caso de las motos importadas, al valor calculado se debe sumar el impuesto que pagó la empresa por su importación. 
    
    A continuación se describe el método darPrecioVenta con el objetivo de tener presente su implementación y realizar las modificaciones que crea necesarias para dar soporte al nuevo requerimiento.
    */

    public function darPrecioVenta(){

        //incializacion
        $porDescuento = $this->getporDescuento();
        $costoMoto = parent::darPrecioVenta();

        $descuento = (($costoMoto * $porDescuento) / 100);
        $importe =  $costoMoto - $descuento;

        return $importe;

    }
}
?>