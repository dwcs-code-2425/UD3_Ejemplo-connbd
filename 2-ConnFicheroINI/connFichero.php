<?php

//Introducimos configuración de conexión en un fichero:
$file = "db_settings.ini";

//https://www.php.net/manual/es/function.parse-ini-file.php
//carga el fichero ini especificado en filename, y devuelve las configuraciones que hay en él a un array asociativo $settings 
//o false si hay algún error y no consigue leer el fichero. 
if (!$settings = parse_ini_file($file, TRUE))
    throw new exception('Unable to open ' . $file . '.');

$dsn = $settings['database']['driver'] .
    ':host=' . $settings['database']['host'] .
    ((!empty($settings['database']['port'])) ? (';port=' . $settings['database']['port']) : '') .
    ';dbname=' . $settings['database']['schema'];



try {
    //Se llama al constructor del padre, la clase PDO
    $conn = new PDO($dsn, $settings['database']['username'], $settings['database']['password']);
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