<?php

include_once "Cliente.php";
include_once "Moto.php";
include_once "Moto_Importada.php";
include_once "Moto_nacional.php";
include_once "Venta.php";
include_once "Empresa.php";

function mostrarArray($array){
    
    $i = 1;

    echo "\nInforme de Ventas de Motos Importadas:\n";
    
    foreach($array as $obj){
        echo "[" . $i++ . "]\n" . $obj . "\n";
    }

}

function mostrarValor($value){

    if($value > 0){
        echo "\nEl Valor es: $" . $value . "\n";
    }
    else{
        echo "\nNo se pudo hacer la venta\n";
    }
}

/*
1. Cree 2 instancias de la clase Cliente: $objCliente1, $objCliente2.
2. Cree 4 objetos Motos con la información visualizada en las siguientes tablas: 
código, costo, año fabricación, descripción, porcentaje incremento anual, activo entre otros.
*/

//objCliente
$objCliente1 = new Cliente("111", "francisco", "Pandolfi", true);
$objCliente2 = new Cliente("123", "Esteban", "Pilchuman", true);

//objMotos nacionales
$objMoto1 = new Moto_Nacional(11, "Benelli Imperiale 400", 2022, 85, 2230000, true);

$objMoto2 = new Moto_Nacional(12, "Zanella Zr 150 Ohc", 2021, 70, 584000, true);

$objMoto3 = new Moto_Nacional(13, "Zanella Patagonian Eagle 250", 2023, 55, 999900, false);

//objMotos importada
$objMoto4 = new Moto_Importada(14, "Pitbike Enduro Motocross Apollo Aiii 190cc Plr", 2020, 100, 12499900, true, "Francia", 6244400);

/*
    Se crea un objeto Empresa con la siguiente información: denominación =” Alta Gama”, dirección= “Av Argenetina 123”, colección de motos= [$obMoto11, $obMoto12, $obMoto13, $obMoto14] , colección de clientes = [$objCliente1, $objCliente2 ], la colección de ventas realizadas=[].
*/

//objEmpresa
$objEmpresa = new Empresa("Alta Gama", "Av Argenetina 123", [$objCliente1, $objCliente2], [$objMoto1, $objMoto2, $objMoto3, $objMoto4], []);

/*
4.Invocar al método registrarVenta($colCodigosMoto, $objCliente) de la Clase Empresa donde el $objCliente es una referencia a la clase Cliente almacenada en la variable $objCliente2 (creada en el punto 1) y la colección de códigos de motos es la siguiente [11,12,13,14]. Visualizar el resultado obtenido.
*/
// 4
echo "------------------------------Ejercicio 4-------------------------------------\n";
$valor1 = $objEmpresa->registrarVenta([11,12,13,14], $objCliente2);
mostrarValor($valor1);

/*5. Invocar al método registrarVenta($colCodigosMotos, $objCliente) de la Clase Empresa donde el $objCliente es una referencia a la clase Cliente almacenada en la variable $objCliente2 (creada en el punto 1) y la colección de códigos de motos es la siguiente [13,14]. Visualizar el resultado obtenido.
*/
// 5
echo "\n------------------------------Ejercicio 5-------------------------------------\n";
$valor2 = $objEmpresa->registrarVenta([13,14], $objCliente2);
mostrarValor($valor2);

/*
6. Invocar al método registrarVenta($colCodigosMotos, $objCliente) de la Clase Empresa donde el $objCliente es una referencia a la clase Cliente almacenada en la variable $objCliente2 (creada en el punto 1) y la colección de códigos de motos es la siguiente [14,2]. Visualizar el resultado obtenido.
*/
// 6
echo "\n------------------------------Ejercicio 6-------------------------------------\n";
$valor3 = $objEmpresa->registrarVenta([13,2], $objCliente2);
mostrarValor($valor3);

/*
    7. Invocar al método informarVentasImportadas(). Visualizar el resultado obtenido.
    
    8. Invocar al método informarSumaVentasNacionales(). Visualizar el resultado obtenido.
    
    9. Realizar un echo de la variable Empresa creada en 2.
*/

// 7
$informeImportado = $objEmpresa->informarVentasImportadas();
echo "\n------------------------------Ejercicio 7-------------------------------------\n";
mostrarArray($informeImportado);

// 8
echo "\n------------------------------Ejercicio 8-------------------------------------\n";
echo "\nEl importe total de ventas Nacionales realizadas por la empresa es: $" . $objEmpresa->informarSumaVentasNacionales() . "\n";

// 9
echo "\n------------------------------Ejercicio 9-------------------------------------\n" . $objEmpresa;

?>