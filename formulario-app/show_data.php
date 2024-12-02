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

// Consultar los datos de la tabla
$sql = "SELECT * FROM contactos";
$result = $conn->query($sql);

// Comprobar si se obtuvieron resultados
if ($result->num_rows > 0) {
    // Hay datos en la tabla, mostrar los datos
    $dataFound = true;
} else {
    // No se encontraron datos
    $dataFound = false;
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
        <h1>Datos enviados</h1>
        
        <?php if ($dataFound): ?>
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Email</th>
                        <th>Teléfono</th>
                        <th>Dirección</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Re-conectar a la base de datos para obtener los datos
                    $conn = new mysqli($host, $user, $password, $db);
                    $result = $conn->query($sql);
                    
                    // Mostrar los datos
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>" . htmlspecialchars($row['nombre']) . "</td>
                                <td>" . htmlspecialchars($row['apellido']) . "</td>
                                <td>" . htmlspecialchars($row['email']) . "</td>
                                <td>" . htmlspecialchars($row['telefono']) . "</td>
                                <td>" . htmlspecialchars($row['direccion']) . "</td>
                              </tr>";
                    }
                    ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No se han encontrado datos en la base de datos.</p>
        <?php endif; ?>

        <!-- Botón para volver al formulario -->
        <div class="link-container">
            <a href="index.html" class="back-to-form-btn">Volver al formulario</a>
        </div>
    </div>
</body>
</html>

