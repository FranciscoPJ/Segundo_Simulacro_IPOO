<?php

class Moto_Importada extends Moto{

    private $paisDeImportacion;
    private $importeImpuestoImportacion; // la empresa paga por el ingreso al país para importar

	public function __construct($codigo, $descripcion, $anioFabricacion, $importeAnual, $costo, $stock, $paisDeImportacion, $importeImpuestoImportacion) {

        parent::__construct($codigo, $descripcion, $anioFabricacion, $importeAnual, $costo, $stock);
		$this->paisDeImportacion = $paisDeImportacion;
		$this->importeImpuestoImportacion = $importeImpuestoImportacion;

	}

	public function getPaisDeImportacion() {
		return $this->paisDeImportacion;
	}

	public function getImporteImpuestoImportacion() {
		return $this->importeImpuestoImportacion;
	}

	public function setPaisDeImportacion($value) {
		$this->paisDeImportacion = $value;
	}

	public function setImporteImpuestoImportacion($value) {
		$this->importeImpuestoImportacion = $value;
	}

    public function __toString(){
        
        $info = parent::__toString();
        $info .= "     Pais de Importacion: " . $this->getPaisDeImportacion() . "\n";
        $info .= "     Importe Impuesto Importacion: $" . $this->getImporteImpuestoImportacion() . "\n";

        return $info;

    }

    /*
    Redefinir el método darPrecioVenta para que en el caso de las motos nacionales aplique el importe de descuento sobre el valor calculado inicialmente. 
    
    Para el caso de las motos importadas, al valor calculado se debe sumar el impuesto que pagó la empresa por su importación. 
    
    A continuación se describe el método darPrecioVenta con el objetivo de tener presente su implementación y realizar las modificaciones que crea necesarias para dar soporte al nuevo requerimiento.
    */

    public function darPrecioVenta(){

        //incializacion
        $importeImpuesto = $this->getImporteImpuestoImportacion();
        $costoMotoSinImpuesto = parent::darPrecioVenta();

        $importe = $importeImpuesto + $costoMotoSinImpuesto;

        return $importe;

    }
}
?>