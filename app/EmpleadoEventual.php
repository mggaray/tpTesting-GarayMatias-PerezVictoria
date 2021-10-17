<?php
namespace App;
require_once 'Empleado.php';

//La clase debe heredar de la clase Empleado:
class EmpleadoEventual extends Empleado
{
    protected $montosDeVentas = Array();

    //El constructor recibe los datos y el array de ventas:
    public function __construct($nombre, $apellido, $dni, $salario, Array $montos = [])
    {
        //Si alguno de los elementos del array no es positivo, se lanza una 
        //excepción:
        foreach ($montos as $unMonto) {
            if ( (int) $unMonto <= 0 ) {
                throw new \Exception();
            }
        }

        //Se invoca al constructor de la superclase Empleado:
        parent::__construct($nombre, $apellido, $dni, $salario);
        //Y luego se asigna el array completo a la la propiedad:
        $this->montosDeVentas = $montos;
    }

    public function calcularComision() {
        $suma = 0;
        foreach ($this->montosDeVentas as $unaVenta) {
            $suma += $unaVenta;
        }
        // La comisión es el 5% del promedio de ventas:
        return ($suma / count($this->montosDeVentas)) * 0.05;
    }

    public function calcularIngresoTotal() {
        return $this->salario + $this->calcularComision();
    }
}
