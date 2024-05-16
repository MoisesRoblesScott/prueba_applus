<?php
// Conexión a la base de datos (aquí debes tener tus credenciales)
try {
    $host = 'localhost';
    $dbname = 'prueba_applus_db';
    $username = 'root';
    $password = '12345';
    
    $db = new PDO("mysql:host=$host; dbname=$dbname", $username, $password);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
}