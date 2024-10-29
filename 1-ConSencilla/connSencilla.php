
<?php
$usuario = "admin";
$contrasenha = "secreto";
try {
    $mbd = new PDO('mysql:host=localhost;port=3306;dbname=w3schools', $usuario, $contrasenha);
    foreach($mbd->query('SELECT * from categories') as $fila) {
    echo "<pre>";
        print_r($fila);
        echo "</pre>";
    }
    $mbd = null;
} catch (PDOException $e) {
    print "¡Error!: " . $e->getMessage() . "<br/>";
    die();
}
?>
