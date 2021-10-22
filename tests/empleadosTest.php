<?php 
use App\Empleado;
require("app\EmpleadoEventual.php");
require("app\EmpleadoPermanente.php");


abstract class EmpleadoTest extends \PHPUnit\Framework\TestCase
{ 
    public function testNombre()
    {

    }

    public function testApellido()
    {

    }

    public function testDNI()
    {

    }
    public function testSector()
    {

    }
}



class EmpleadoEventualTest extends EmpleadoTest{
    public function testNombre()
    {
        $this -> expectException(\Exception::class);
        $e = new \App\EmpleadoEventual("", "Perez", 40251489,15445,[4000,1500,3000,3500]);
    }

    public function testApellido()
    {   
        $this -> expectException(\Exception::class);
        $e = new \App\EmpleadoEventual("Juan","", 40251489,15445,[4000,1500,3000,3500]);

    }

    public function testDNI()
    {   
        $this -> expectException(\Exception::class);
        $e = new \App\EmpleadoEventual("Juan", "Perez ",  0 ,15445, [4000,1500,3000,3500] );
    }
    public function testSector()
    {
        $e = new \App\EmpleadoEventual("Juan", "Perez ",40251489,15445,[4000,1500,3000,3500] );
        $this -> assertEquals("No especificado", $e->getSector());
    }

    public function testcalcularComision()
    {
     $ev = new \App\EmpleadoEventual("Juan", "Perez ",40251489,15445,[4000,1500,3000,3500]);
     $this -> assertEquals(150, $ev->calcularComision());
    }

    public function testcalcularIngresoTotal()
    {
     $ev = new \App\EmpleadoEventual("Juan", "Perez ",40251489,15445,[4000,1500,3000,3500]);
     $this -> assertEquals(15595, $ev->calcularIngresoTotal());
    }
    
    public function testmontonegativo()
   {
    $this -> expectException(\Exception::class);
    $ev = new \App\EmpleadoEventual("Juan", "Perez ",40251489,15445,[40,15,-2,16]);
    }
}





?>