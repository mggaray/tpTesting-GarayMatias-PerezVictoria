<?php
namespace App;

abstract class Empleado 
{
    protected $nombre;
    protected $apellido;
    protected $sector;
    protected $salario;
    protected $dni;

    public function __construct(
        $nombre, $apellido, $dni, $salario, $sector="No especificado"
    )
    {
        //Si algún parámetro falta, lanza una excepción:
        if (
            empty($nombre) || empty($apellido) || 
            empty($dni) || (int) $dni === 0 ||
            empty($salario)
        ) {
            throw new \Exception();
        }
        else {
            $this->nombre = $nombre;
            $this->apellido = $apellido;
            $this->dni = $dni;
            $this->salario = $salario;
            $this->sector = $sector;
        }
    }


    public function getNombreApellido()
    {
        return $this->nombre . " " . $this->apellido;
    }

    public function getDNI()
    {
        return $this->dni;
    }

    public function getSalario()
    {
        return $this->salario;
    }

    public function setSector($sector) 
    {
        $this->sector = $sector;
    }

    public function getSector() 
    {
        return $this->sector;
    }

    //Si se intenta convertir al objeto Empleado en cadena, php busca el método 
    //"mágico" __toString():
    public function __toString()
    {
      return "{$this->nombre} {$this->apellido} {$this->dni} {$this->salario}";
    }
}
