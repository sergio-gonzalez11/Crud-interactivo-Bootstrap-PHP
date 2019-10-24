
<?php

    include '../db/Global.php';
    include '../db/Conexion.php';

    include '../models/Registro.php';

$operacion = $_GET['operacion'];

switch ($operacion) {
    
    case "registro":

        $nombre = $_GET['nombre'];
        $apellidos = $_GET['apellidos'];
        $edad = $_GET['edad'];

        $dao = new Registro();
        $dao -> registroUsuario($nombre, $apellidos, $edad);

        header("location: ../index.php");
        
    break;

    case "borrar":

        $id = $_GET['id_registro'];

        $dao = new Registro();
        $dao -> borrarRegistro($id);

        header("location: ../index.php");
        
        
    break;


    // case "buscar":

    //     $dao = new Registro();

    //     if(isset($_GET['id_registro'])){

    //     $id_registro = $_GET['id_registro'];

    //     $dao -> buscarUsuarioporId($id_registro);
        
    //     header("location: ../index.php");

    //     }else{

    //         echo "<script>alert('No se obtiene datos!');location.href='../index.php'</script>";

    //     }

    // break;


    case "actualizar":

        if(isset($_GET['id_registro'])){

            $dao = new Registro();

            $id_registro = $_GET['id_registro'];
            $nombre = $_GET['nombre'];
            $apellidos = $_GET['apellidos'];
            $edad = $_GET['edad'];
    
            $dao -> actualizarRegistro($id_registro, $nombre, $apellidos, $edad);
            
            header("location: ../index.php");
        
        }else{

            echo "<script>alert('No se obtiene datos!');location.href='../index.php'</script>";
        }

    break;
    

}


?>