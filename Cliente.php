<?php
class Cliente{

    private $dni; 
    private $nombre;
    private $apellido;
    private $estado; // boolean

	public function __construct($dni, $nombre, $apellido, $estado) {

		$this->dni = $dni;
		$this->nombre = $nombre;
		$this->apellido = $apellido;
		$this->estado = $estado;

	}

    // get------------------------------------------------------------
	public function getDni() {
		return $this->dni;
	}

	public function getNombre() {
		return $this->nombre;
	}

	public function getApellido() {
		return $this->apellido;
	}

	/**
	 * @return BOOLEAN
	 */
	public function getEstado() {
		return $this->estado;
	}

    // set------------------------------------------------------------
	public function setDni($value) {
		$this->dni = $value;
	}

	public function setNombre($value) {
		$this->nombre = $value;
	}

	public function setApellido($value) {
		$this->apellido = $value;
	}

	public function setEstado($value) {
		$this->estado = $value;
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
        
        $info = "     DNI: " . $this->getDni() . "\n";
        $info .= "     Nombre: " . $this->getNombre() . "\n";
        $info .= "     Apellido: " . $this->getApellido() . "\n";
        $info .= "     Estado: " . $this->motrarStock($this->getEstado()) . "\n";

        return $info;

    }

}
?>