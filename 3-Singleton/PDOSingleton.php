<?php



class PDOSingleton
{

//Se declara un atributo estático PDO nullable 
    private static ?PDO $connection = null;
    //fichero con datos de configuración de acceso a DB
    private static $ruta_fichero = "db_settings.ini";

    private function __construct()
    {

    }

    private function __clone()
    {
    }

    public static function getInstance()
    {


        if (is_null(self::$connection)) {
         

            if (!$settings = parse_ini_file(self::$ruta_fichero, TRUE)) {
                throw new Exception('Unable to open ' . self::$ruta_fichero . '.');
            }

            $dns = $settings['database']['driver'] .
                ':host=' . $settings['database']['host'] .
                ((!empty($settings['database']['port'])) ? (';port=' . $settings['database']['port']) : '') .
                ';dbname=' . $settings['database']['schema'];

            self::$connection = new PDO(
                $dns,
                $settings['database']['username'],
                $settings['database']['password'],
                //Creamos una conexión persistente dependiendo del valor persistent del fichero de configuración
                array(
                    PDO::ATTR_PERSISTENT => $settings['database']['persistent']
                )
            );
        }
        //Se devuelve el atributo estático de la propia clase (se verá en más detalle en POO)
        return self::$connection;
    }
}