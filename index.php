<?php

include 'db/Global.php';
include 'db/Conexion.php';

    $conexion = new Conexion();
    $pdo = $conexion->conectar();
    

    $stmt = $pdo->prepare("SELECT * FROM registro");
    $stmt->execute();

    $listadoRegistros = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // echo "<pre>";
    //   print_r($listadoRegistros);
    // echo "</pre>";

?>

<!DOCTYPE html>
<html lang="en">

<head>

  <title>Crud PHP - Sergio</title>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">

  <link href="assets/bootstrap-4.3.1-dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/bootstrap-4.3.1-dist/style.css" rel="stylesheet">
  <link href="assets/estilo.css" rel="stylesheet">
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

</head>

<body>

  <div class="jumbotron w-75 py-5 mt-5 mx-auto jumbotron-fluid text-center sombraJumbo">
    <div class="container">
      <h1 class="display-4">Crud PHP</h1>
      <hr class="my-4">
      <p class="lead">Ejemplo de crud PHP - sergio</p>
    </div>
  </div>

  <div class="container w-75">
    <div class="row">
      <div class="col-md-4 py-2 formu">
        <h4 class="text-center pt-2 pb-3">Registro</h4>

        <!-- Form -->
        <form action="controller/controller_registro.php" method="GET" role="form d-flex justify-content-center">
          <div class="form-group row d-flex justify-content-center">
            <div class="col-md-8">
              <input class="form-control" type="text" placeholder="Nombre" name="nombre" required>
            </div>
          </div>
          <div class="form-group row d-flex justify-content-center">
            <div class="col-md-8">
              <input class="form-control" type="text" placeholder="Apellidos" name="apellidos" required>
            </div>
          </div>
          <div class="form-group row d-flex justify-content-center">
            <div class="col-md-8">
              <input class="form-control" type="number" placeholder="Edad" name="edad" required>
            </div>
          </div>
          <div class="form-group row d-flex justify-content-center pt-2">
            <div class="col-md-8 d-flex justify-content-center">
              <button class="btn btn-primary ml-2" name="operacion" value="registro"><b>+</b> Añadir Registro </button>
            </div>
          </div>
        </form>

      </div>



      <div class="col-md-8">
        <div class="table-responsive">
          <h4 class="text-center pb-3">Listado</h4>

          <table class="table table-hover table-sm text-center">
            <tbody>
              <tr>
                <th class="w-5">Id</th>
                <th class="w-25">Nombre</th>
                <th class="w-25">Apellidos</th>
                <th class="w-10">Edad</th>
                <th class="w-10">Acciones</th>
              </tr>

              <?php foreach($listadoRegistros as $registro){ ?>

              <tr>
                <td><?php echo $registro['id_registro'] ?></td>
                <td><?php echo $registro['nombre'] ?></td>
                <td><?php echo $registro['apellidos'] ?></td>
                <td><?php echo $registro['edad'] ?></td>
                <td>

                  <a href="" class="edit" data-toggle="modal" data-target="#form<?php echo $registro['id_registro'] ?>" title="Edit"><i class="material-icons"></i></a>
                    


                  <div class="modal fade" id="form<?php echo $registro['id_registro'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">

                      <?php

                          $conexion = new Conexion();
                          $pdo = $conexion->conectar();

                          $id = $registro['id_registro'];

                          $stmt = $pdo->prepare("SELECT * FROM registro WHERE id_registro = ? ");
                          
                          $stmt->bindParam(1, $id, PDO::PARAM_INT);

                          $stmt->execute();

                          $seleccionarRegistro = $stmt->fetchAll();

                            // print_r(var_dump($busquedaRegistro));

                          foreach($seleccionarRegistro as $busqueda){  

                  ?>

                      <div class="modal-content">
                        <div class="modal-header border-bottom-0">
                          <h5 class="modal-title text-center" id="exampleModalLabel">Editar Registro</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>

                        <form action="controller/controller_registro.php" method="GET">

                          <div class="modal-body">
                            <div class="form-group">
                              <!-- <label for="email1">Id Registro</label>  -->
                              <input type="hidden" class="form-control" value="<?php echo $busqueda['id_registro'] ?>"
                                name="id_registro">
                            </div>
                            <div class="form-group">
                              <label for="email1">Nombre</label>
                              <input type="text" class="form-control" value="<?php echo $busqueda['nombre'] ?>"
                                name="nombre">
                            </div>
                            <div class="form-group">
                              <label for="email1">Apellidos</label>
                              <input type="text" class="form-control" value="<?php echo $busqueda['apellidos'] ?>"
                                name="apellidos">
                            </div>
                            <div class="form-group">
                              <label for="email1">Edad</label>
                              <input type="number" class="form-control" value="<?php echo $busqueda['edad'] ?>"
                                name="edad">
                            </div>
                          </div>
                          <!-- 
                          <?php 

                            echo "<pre>";
                              print_r($busqueda);
                            echo "</pre>";

                          ?> -->

                          <div class="modal-footer border-top-0 d-flex justify-content-center">
                            <button type="submit" name="operacion" value="actualizar"
                              class="btn btn-success">Actualizar</button>
                          </div>


                        </form>
                      </div>

                      <?php } ?>

                    </div>
                  </div> 

                  <a href="controller/controller_registro.php?operacion=borrar&id_registro=<?php echo $registro['id_registro'] ?>"
                    class="delete" title="Delete"><i class="material-icons"></i></a>

                </td>
              </tr>

              <?php } ?>

            </tbody>

          </table>

        </div>
      </div>
    </div>
  </div>


  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
    integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
  </script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
    integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
  </script>

  <script src="assets/bootstrap-4.3.1-dist/js/bootstrap.js"></script>

</body>

</html>