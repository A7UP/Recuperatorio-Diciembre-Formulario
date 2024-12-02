<?php
// Conectar a la base de datos
$host = 'localhost';  // Cambiar según tu configuración
$user = 'root';       // Usuario de MySQL
$password = '';       // Contraseña de MySQL
$db = 'formulario_db';  // Nombre de tu base de datos

$conn = new mysqli($host, $user, $password, $db);

// Verificar si la conexión fue exitosa
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Recibir los datos del formulario
$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$email = $_POST['email'];
$telefono = $_POST['telefono'];
$direccion = $_POST['direccion'];

// Insertar los datos en la base de datos
$sql = "INSERT INTO contactos (nombre, apellido, email, telefono, direccion) 
        VALUES ('$nombre', '$apellido', '$email', '$telefono', '$direccion')";

if ($conn->query($sql) === TRUE) {
    // Si la inserción fue exitosa
    $success = true;
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Datos Guardados</title>
    <link rel="stylesheet" href="styles.css"> <!-- Estilos CSS -->
</head>
<body>
    <div class="container">
        <!-- Mensaje de confirmación -->
        <div class="confirmation-message">
            <?php if (isset($success) && $success): ?>
                <h1>¡Gracias por enviar tus datos!</h1>
                <p>Tu información ha sido guardada correctamente.</p>
            <?php else: ?>
                <h1>Hubo un error al guardar tus datos.</h1>
                <p>Por favor, intenta nuevamente.</p>
            <?php endif; ?>
        </div>

        <!-- Mostrar los datos que se han insertado -->
        <?php if (isset($success) && $success): ?>
            <div class="submitted-data">
                <h2>Datos que enviaste:</h2>
                <ul>
                    <li><strong>Nombre:</strong> <?php echo htmlspecialchars($nombre); ?></li>
                    <li><strong>Apellido:</strong> <?php echo htmlspecialchars($apellido); ?></li>
                    <li><strong>Email:</strong> <?php echo htmlspecialchars($email); ?></li>
                    <li><strong>Teléfono:</strong> <?php echo htmlspecialchars($telefono); ?></li>
                    <li><strong>Dirección:</strong> <?php echo htmlspecialchars($direccion); ?></li>
                </ul>
            </div>
        <?php endif; ?>

        <!-- Enlace a la página de visualización de datos -->
        <?php if (isset($success) && $success): ?>
            <div class="link-container">
                <p><a href="show_data.php" class="view-data-link">Ver los datos que enviaste</a></p>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>



