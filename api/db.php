<?php
// Conexión PostgreSQL (Railway)
$connString = sprintf(
    "host=%s port=%s dbname=%s user=%s password=%s",
    getenv("DB_HOST"),
    getenv("DB_PORT"),
    getenv("DB_NAME"),
    getenv("DB_USER"),
    getenv("DB_PASSWORD")
);

$conexion = pg_connect($connString);

// Validación de conexión
if (!$conexion) {
    echo "❌ Error al conectar a la base de datos.";
    exit();
}
?>
