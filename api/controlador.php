<?php
// api/controlador.php
// Controlador central para la API de tareas

// Habilitar CORS (en producción reemplazar * por tu dominio)
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type, Authorization");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Content-Type: application/json; charset=UTF-8");

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(204);
    exit;
}

require_once __DIR__ . '/modelo.php';

// Obtener el método y los inputs JSON (si existen)
$metodo = $_SERVER['REQUEST_METHOD'];
$input = json_decode(file_get_contents('php://input'), true);

// Rutas simples: si quieres usar PATH_INFO para rutas más limpias, se puede mejorar
try {
    switch ($metodo) {
        case 'GET':
            // GET -> listar todas las tareas
            $tareas = obtenerTareas();
            echo json_encode($tareas);
            break;

        case 'POST':
            // POST -> crear nueva tarea
            if (empty($input['titulo'])) {
                http_response_code(400);
                echo json_encode(['error' => 'El campo titulo es requerido']);
                exit;
            }
            $titulo = trim($input['titulo']);
            $id = crearTarea($titulo);
            echo json_encode(['mensaje' => 'Tarea creada', 'id' => $id]);
            break;

        case 'PUT':
            // PUT -> actualizar (id requerido)
            if (empty($input['id'])) {
                http_response_code(400);
                echo json_encode(['error' => 'El campo id es requerido']);
                exit;
            }
            $id = (int)$input['id'];
            $titulo = isset($input['titulo']) ? $input['titulo'] : null;
            $completada = array_key_exists('completada', $input) ? (bool)$input['completada'] : null;
            $ok = actualizarTarea($id, $titulo, $completada);
            if ($ok) {
                echo json_encode(['mensaje' => 'Tarea actualizada']);
            } else {
                http_response_code(500);
                echo json_encode(['error' => 'No se pudo actualizar la tarea']);
            }
            break;

        case 'DELETE':
            // DELETE -> eliminar por id (puede venir por query string o body)
            $id = $_GET['id'] ?? ($input['id'] ?? null);
            if (!$id) {
                http_response_code(400);
                echo json_encode(['error' => 'id requerido']);
                exit;
            }
            $ok = eliminarTarea((int)$id);
            if ($ok) {
                echo json_encode(['mensaje' => 'Tarea eliminada']);
            } else {
                http_response_code(500);
                echo json_encode(['error' => 'No se pudo eliminar la tarea']);
            }
            break;

        default:
            http_response_code(405);
            echo json_encode(['error' => 'Método no permitido']);
            break;
    }
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Error del servidor', 'detalle' => $e->getMessage()]);
}
