
<?php

class Registro {

        private $id_registro;
        private $nombre;
        private $apellidos;
        private $edad;

        public function _construct($id_registro, $nombre, $apellidos, $edad) {

            $this->id_registro = $id_registro;
            $this->nombre = $nombre;
            $this->apellidos = $apellidos;
            $this->edad = $edad;
            
        }

        public function getId_registro() {
            return $this->id_registro;
        }

        public function setId_registro($id_registro) {
            $this->id_usuario = $id_registro;
        }

        public function getNombre() {
            return $this->nombre;
        }

        public function setNombre($nombre) {
            $this->nombre = $nombre;
        }

        public function getApellidos() {
            return $this->apellidos;
        }

        public function setApellidos($apellidos) {
            $this->apellidos = $apellidos;
        }

        public function getEdad() {
            return $this->edad;
        }

        public function setEdad($edad) {
            $this->edad = $edad;
        }
        

        public function registroUsuario($nombre, $apellidos, $edad){

            $conexion = new Conexion();
            $pdo = $conexion->conectar();

            try{

                    $stmt = $pdo->prepare("INSERT INTO registro VALUES (null,?,?,?)");

                    $stmt->bindParam(1, $nombre, PDO::PARAM_STR);
                    $stmt->bindParam(2, $apellidos, PDO::PARAM_STR);
                    $stmt->bindParam(3, $edad, PDO::PARAM_STR);

                    $stmt->execute();  


            }catch(PDOException $e){

                echo "Error!" . $e->getMessage() . "</br>";
         
            }finally{
                //vaciar memoria
                $pdo = null;
           } 

           
        }
        

        public function mostrarRegistros(){

            $conexion = new Conexion();
            $pdo = $conexion->conectar();

            try{

                    $stmt = $pdo->prepare("SELECT * FROM registro");

                    $stmt->execute();  

                    $listadoRegistros = $stmt->fetchAll(PDO::FETCH_ASSOC);
                

            }catch(PDOException $e){

                echo "Error!" . $e->getMessage() . "</br>";
         
            }finally{
                //vaciar memoria
                $pdo = null;
           } 

           return $listadoRegistros;

        }


        public function borrarRegistro($id_registro){

            $conexion = new Conexion();
            $pdo = $conexion->conectar();

            try{
                
                $stmt = $pdo->prepare("DELETE FROM registro WHERE id_registro = ?");

                $stmt->bindParam(1, $id_registro, PDO::PARAM_INT);

                $stmt->execute();

            }catch(PDOException $e){

                echo "Error!" . $e->getMessage() . "</br>";
            
            }finally{
                //vaciar memoria
               $pdo = null;
           }   
        }


        public function buscarUsuarioporId($id_registro){

            $conexion = new Conexion();
            $pdo = $conexion -> conectar();

            try{
                
                $stmt = $pdo->prepare("SELECT * FROM registro WHERE id_registro = ?");

                $stmt->bindParam(1, $id_registro, PDO::PARAM_INT);

                $stmt->execute(); 
            

            }catch(PDOException $e){

                echo "Error!" . $e->getMessage() . "</br>";
            
            }finally{
                //vaciar memoria
               $pdo = null;
           }   


        }


        public function actualizarRegistro($id_registro, $nombre, $apellidos, $edad){

            $conexion = new Conexion();
            $pdo = $conexion->conectar();

            try{

                $stmt = $pdo->prepare("UPDATE registro SET nombre = ?, apellidos = ?, edad = ? WHERE id_registro = ?");

                $stmt->bindParam(1, $nombre, PDO::PARAM_STR);
                $stmt->bindParam(2, $apellidos, PDO::PARAM_STR);
                $stmt->bindParam(3, $edad, PDO::PARAM_INT);

                $stmt->bindParam(4, $id_registro, PDO::PARAM_INT);

                $stmt->execute(); 


            }catch(PDOException $e){

                echo "Error!" . $e->getMessage() . "</br>";
            
            }finally{
                //vaciar memoria
               $pdo = null;
           }   
           
        }



    
    }
    


?>