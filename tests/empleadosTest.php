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
        $e = new \App\EmpleadoEventual("", "Perez", 40251489,15445,[4000,1500,3000,3500]); //nombre empty
    }

    public function testApellido()
    {   
        $this -> expectException(\Exception::class);
        $e = new \App\EmpleadoEventual("Juan","", 40251489,15445,[4000,1500,3000,3500]); // apellido empty

    }

    public function testDNI()
    {   
        $this -> expectException(\Exception::class);
        $e = new \App\EmpleadoEventual("Juan", "Perez ",  0 ,15445, [4000,1500,3000,3500] ); // dni=0, empty
    }
    public function testSector()
    {
        $e = new \App\EmpleadoEventual("Juan", "Perez ",40251489,15445,[4000,1500,3000,3500] ); //sector no especificado
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


/*------------------tests para la clase empleadoPermanente------------*/


class EmpleadoPermanenteTest extends EmpleadoTest
{
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



    public function testfechaingreso()
    {
        $hoy= new DateTime();
        $hoy-> format('Y-m-d');
        $hoy= new \DateTime($hoy->format('Y-m-d'));
        $ep = new \App\EmpleadoPermanente("Juan", "Perez ",40251489,15445,NULL);
        $variable= $ep->getFechaIngreso();
        $variable->format('Y-m-d');
        $variable= new \DateTime($variable->format('Y-m-d'));
        $this -> assertEquals($hoy, $variable);
        $mañana= new DateTime();
        $mañana -> add (new DateInterval ('P1D'));
        $this -> expectException(\Exception::class );
        $ep = new \App\EmpleadoPermanente("Juan", "Perez ",40251489,15445,$mañana);
    }

    public function testCalcularComision()
    {
       $Ingreso = date_create('2010-10-15 08:00:00');
        $ep = new \App\EmpleadoPermanente("Juan", "Perez ",40251489,15445,$Ingreso);
        $this-> assertEquals("11%", $ep->calcularComision());
    }
    public function testcalcularIngresoTotal()
    {
        $Ingreso = date_create('2010-10-15 08:00:00');
        $ep = new \App\EmpleadoPermanente("Juan", "Perez ",40251489,15445,$Ingreso);
        $this-> assertEquals(17143.95, $ep->calcularIngresoTotal());
    }

    public function testcalcularAntiguedad()
    {
        $Ingreso = date_create('2010-10-15 08:00:00');
        $ep = new \App\EmpleadoPermanente("Juan", "Perez ",40251489,15445,$Ingreso);
        $this->assertEquals(11, $ep->calcularAntiguedad());
    }

    public function testfecha_y_Antiguedad()
    {
        $Fecha_ing = NULL;
        $hoy = new DateTime();
        $hoy->format('Y-m-d');
        $hoy= new \DateTime($hoy->format('Y-m-d')); /* saca el formato de los segundos ya que al haber diferencias de milisegundos entre la creacion de variables puede dar errores*/

        $ep = new \App\EmpleadoPermanente("Juan", "Perez ",40251489,15445,$Fecha_ing);
        $variable = $ep->getFechaIngreso();
        $variable->format('Y-m-d');
        $variable= new \DateTime($variable->format('Y-m-d'));
        $this-> assertEquals($hoy, $variable);
        $this-> assertEquals(0, $ep->calcularAntiguedad());

    }
}

?>