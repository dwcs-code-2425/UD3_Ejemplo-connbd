<?php
require_once 'PDOSingleton.php';

try {
    //Se llama al constructor del padre, la clase PDO
    $conn = PDOSingleton::getInstance();
    foreach ($conn->query('SELECT * from categories') as $fila) {
        echo "<pre>";
        print_r($fila);
        echo "</pre>";
    }
    $conn = null;
} catch (PDOException $e) {
    print "¡Error!: " . $e->getMessage() . "<br/>";
    die();
}
?>