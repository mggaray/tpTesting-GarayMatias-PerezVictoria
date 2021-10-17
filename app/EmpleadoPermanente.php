<?php
namespace App;

require_once 'Empleado.php';

class EmpleadoPermanente extends Empleado
{
    private $fechaIngreso;

    //El constructor recibe los datos, entre ellos un objeto DateTime:
    public function __construct(
        $nombre, $apellido, $dni, $salario, \DateTime $fechaIngreso = null
    )
    {
        parent::__construct($nombre, $apellido, $dni, $salario);
        if (is_null($fechaIngreso)) {
            //Asigna la fecha de hoy como fecha de ingreso:
            $this->fechaIngreso = new \DateTime();
        }
        else {
            //Si la fecha de ingreso es futura, lanza una excepción:
            if ($fechaIngreso > new \DateTime()) {
                throw new \Exception();
            }
            else {
                $this->fechaIngreso = $fechaIngreso;
            }
        }
    }

    public function getFechaIngreso() {
        //Retorna la fecha de ingreso, que es un objeto DateTime.
        return $this->fechaIngreso;
    }

    public function calcularAntiguedad() {
        //Retorna la antigüedad en años. (Puede ser cero).
        $antiguedad = $this->fechaIngreso->diff(new \DateTime()); 
        return $antiguedad->y;
    }

    public function calcularComision() {
        return "{$this->calcularAntiguedad()}%";
    }
    
    public function calcularIngresoTotal() {
        return $this->salario + $this->salario * $this->calcularAntiguedad() / 100;
    }

}
