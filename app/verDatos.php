<?php
namespace App;
require_once 'EmpleadoPermanente.php';
require_once 'EmpleadoEventual.php';
if($_POST['tipo'] == 'e') {
    $emp = new EmpleadoEventual($_POST['nombre'], $_POST['apellido'], $_POST['dni'], $_POST['salario'],  $_POST['ventas']);
}
elseif ($_POST['tipo'] == 'p') {
    $emp = new EmpleadoPermanente($_POST['nombre'], $_POST['apellido'], $_POST['dni'], $_POST['salario'], new \DateTime($_POST['fechaIngreso']));
}

$datos['empleado'] = $emp->getNombreApellido();
$datos['salario'] = $emp->getSalario();
$datos['comision'] = $emp->calcularComision();
$datos['ingresoTotal'] = $emp->calcularIngresoTotal();

header('Content-Type: application/json');
echo json_encode($datos);
