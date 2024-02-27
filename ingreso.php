<?php

// Establecer la conexión a la base de datos (reemplaza los valores con los de tu base de datos)
require 'conexion.php';
// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Verificar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recuperar los datos del formulario
    $fecha = $_POST['fecha'];
    $descripcion = $_POST['descripcion'];
    $valor = $_POST['valor'];

    // Preparar la consulta SQL para insertar los datos
    $sql = "INSERT INTO ingresos (fecha, descripcion, valor) VALUES ('$fecha', '$descripcion', '$valor')";

    // Ejecutar la consulta
    if ($conn->query($sql) === TRUE) {
        echo "Datos insertados correctamente";
        header("Location: index.php");
    } else {
        echo "Error al insertar datos: " . $conn->error;
    }
}

// Cerrar la conexión
$conn->close();




?>