<?php
require_once 'db.php';

// CREATE
function crearTarea($titulo) {
    global $conexion;
    $titulo_seguro = htmlspecialchars($titulo);
    $sql = "INSERT INTO tareas (titulo) VALUES ('$titulo_seguro')";
    pg_query($conexion, $sql);
}

// READ
function obtenerTareas() {
    global $conexion;
    $sql = "SELECT * FROM tareas ORDER BY id ASC";
    $resultado = pg_query($conexion, $sql);

    $tareas = [];
    while ($fila = pg_fetch_assoc($resultado)) {
        $tareas[] = $fila;
    }
    return $tareas;
}

// UPDATE
function editarTarea($id, $completada) {
    global $conexion;
    $sql = "UPDATE tareas SET completada=$completada WHERE id=$id";
    pg_query($conexion, $sql);
}

// DELETE
function eliminarTarea($id) {
    global $conexion;
    $sql = "DELETE FROM tareas WHERE id=$id";
    pg_query($conexion, $sql);
}
?>
