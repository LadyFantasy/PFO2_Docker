<?php
$servername = "mysql";
$username = "root";
$password = "root";
$dbname = "practica";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Crear tabla si no existe
$sql_create = "
CREATE TABLE IF NOT EXISTS usuarios (
    id_usuario INT(10) NOT NULL AUTO_INCREMENT,
    usuario VARCHAR(20) NOT NULL,
    password VARCHAR(20),
    PRIMARY KEY (id_usuario)
)";
$conn->query($sql_create);

// Insertar datos solo si la tabla está vacía
$sql_check = "SELECT COUNT(*) as total FROM usuarios";
$result = $conn->query($sql_check);
$row = $result->fetch_assoc();

if ($row['total'] == 0) {
    $conn->query("INSERT INTO usuarios (usuario, password) VALUES ('alice', 'pass123')");
    $conn->query("INSERT INTO usuarios (usuario, password) VALUES ('bob', 'qwerty')");
    $conn->query("INSERT INTO usuarios (usuario, password) VALUES ('carol', '123456')");
    $conn->query("INSERT INTO usuarios (usuario, password) VALUES ('dave', 'secret')");
    $conn->query("INSERT INTO usuarios (usuario, password) VALUES ('eve', 'hunter2')");
}

// Mostrar usuarios
$sql = "SELECT * FROM usuarios";
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    echo "<h1>Listado de usuarios</h1>";
    echo "<ul>";
    while ($row = $result->fetch_assoc()) {
        echo "<li>" . htmlspecialchars($row["usuario"]) . "</li>";
    }
    echo "</ul>";
} else {
    echo "No hay usuarios registrados o tabla no existe.";
}

$conn->close();
?>
