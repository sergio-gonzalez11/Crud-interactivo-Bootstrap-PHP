
<?php 

class Conexion {

    public function conectar(){

    $servidor = "mysql:dbname=".BD."; host=".SERVIDOR;

    try {
     
        $pdo = new PDO($servidor, USUARIO, PASSWORD,
                        array(PDO::MYSQL_ATTR_INIT_COMMAND=>"SET NAMES utf8")
                    );

                    // echo "<script> alert('Conectando a la base de datos')</script>";

                    return $pdo;
                    /*echo "Conectado a la base de datos<br/>";*/

                    

                    

        } catch (PDOException $e){
            
            echo "<script> alert('Error al conectar con la base de datos')</script>";
            echo "Error!" . $e->getMessage() . "</br>";
        }

    }  
    
}

?>