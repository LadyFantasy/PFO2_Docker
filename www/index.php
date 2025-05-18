<?php
$servername = "app-docker-mysql-1";
$username = "root";
$password = "root";
$dbname = "practica";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$sql = "SELECT * FROM usuarios";
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    echo "<h1>Listado de usuarios</h1>";
    echo "<ul>";
    while($row = $result->fetch_assoc()) {
        echo "<li>" . htmlspecialchars($row["usuario"]) . "</li>";
    }
    echo "</ul>";
} else {
    echo "No hay usuarios registrados o tabla no existe.";
}

$conn->close();
?>
