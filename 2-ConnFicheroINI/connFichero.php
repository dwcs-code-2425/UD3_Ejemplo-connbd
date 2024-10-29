<?php

require_once 'connection.php';

try {
    $conn = getConnection();

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