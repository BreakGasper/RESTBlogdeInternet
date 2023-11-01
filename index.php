<?php
require_once 'conexion.php'; // incluir el archivo de conexión

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        $action = $_POST['action'];

        switch ($action) {
            case 'insertarEntrada':
                $titulo = $_POST['titulo'];
                $autor = $_POST['autor'];
                $contenido = $_POST['contenido'];

                // prepara el query SQL
                $sql = "INSERT INTO BlogProps (titulo, autor, fecha_publicacion, contenido) 
                        VALUES ('$titulo', '$autor', NOW(), '$contenido')";

                // Ejecuta la consulta
                if ($conexion->query($sql) === TRUE) {
                    echo "Entrada insertada con éxito";
                } else {
                    echo "Error al insertar la entrada: " . $conexion->error;
                }
                break; 

                
            default:
                echo 'Acción desconocida';
                break;
        }
    } else {
        echo 'La clave action no está definida en la solicitud POST';
    }
}
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['action'])) {
        $action = $_GET['action'];

        switch ($action) {
            case 'obtenerEntradas':
                $json = array();
                // Prepara el query SQL para obtener todas las entradas
                $sql = "SELECT * FROM BlogProps";

                // Ejecuta la consulta
                $result = $conexion->query($sql);

                if ($result->num_rows > 0) {
                    // Almacena todas las filas en un array
                    while ($row = $result->fetch_assoc()) {
                        $json['entrys'][] = $row;
                    }
                    echo json_encode($json);
                } else {
                    echo "No se encontraron entradas.";
                }
                break;

                case 'buscarEntradas':
                    $json = array();
                    if (isset($_GET['busqueda'])) {
                        $busqueda = $_GET['busqueda'];
                        // Prepara el query SQL para buscar entradas por título, contenido o autor
                        $sql = "SELECT * FROM BlogProps WHERE titulo LIKE '%$busqueda%' OR contenido LIKE '%$busqueda%' OR autor LIKE '%$busqueda%'";
                    } else {
                        // Si no hay parámetro de búsqueda, obtener todas las entradas
                        $sql = "SELECT * FROM BlogProps";
                    }
                    // Ejecuta la consulta
                    $result = $conexion->query($sql);
    
                    if ($result->num_rows > 0) {
                        // Almacena todas las filas en un array
                        while ($row = $result->fetch_assoc()) {
                            $json['entrys'][] = $row;
                        }
                        echo json_encode($json);
                    } else {
                        echo "No se encontraron entradas.";
                    }
                    break;
            default:
                echo 'Acción desconocida o no especificada en la solicitud GET';
                break;
        }
    } else {
        echo 'La clave action no está definida en la solicitud GET';
    }
} else {
    echo 'Solicitud no válida';
}
 

$conexion->close(); // Se Cierra la conexión a la base de datos al final del script
?>
