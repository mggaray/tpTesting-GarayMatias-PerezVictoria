<?php 
use App\Empleado;

class EmpleadoTest extends \PHPUnit\Framework\TestCase
{
    public function testNombre()
    {
        $this -> expectException(\Exception::class);
        $e = new \App\Empleado(" ", "Perez", 40251489,15445,"Produccion" );
    }

    public function testApellido()
    {
        $e = new \App\Empleado("Juan", " ", 40251489,15445,"Produccion" );
        $this -> expectException(\Exception::class);
    }

    public function testDNI()
    {
        $e = new \App\Empleado("Juan", "Perez ", NULL ,15445,"Produccion" );
        $this -> expectException(\Exception::class);
    }
    public function testSector()
    {
        $e = new \App\Empleado("Juan", "Perez ",40251489,15445," " );
        $this -> assertEquals("No especificado", $e->getSector());
    }
}


?>