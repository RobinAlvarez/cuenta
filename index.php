
<?php

// Consulta para obtener la suma de la columna 'valor'
include 'conexion.php';

//*************INGRESOS************ */
$sql = "SELECT SUM(valor) AS total FROM ingresos";
$result = $conn->query($sql);

if ($result === false) {
    // Manejar el error de la consulta
    die("Error en la consulta SQL: " . $conn->error);
}

// Verificar si se encontraron resultados
if ($result->num_rows > 0) {
    // Obtener el resultado de la consulta
    $row = $result->fetch_assoc();
    $total = $row["total"];
} else {
    $total = 0; // Si no hay resultados, establecer el total en 0
}

//*************EGRESOS************ */

$sql = "SELECT SUM(valor) AS total FROM egresos";
$result = $conn->query($sql);

if ($result === false) {
    // Manejar el error de la consulta
    die("Error en la consulta SQL: " . $conn->error);
}

// Verificar si se encontraron resultados
if ($result->num_rows > 0) {
    // Obtener el resultado de la consulta
    $row = $result->fetch_assoc();
    $tegreso = $row["total"];
} else {
    $tegreso = 0; // Si no hay resultados, establecer el total en 0
}

// Cerrar la conexión (esto no es necesario si estás incluyendo este archivo en otras páginas)
//$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/bootstrap-grid.rtl.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="css/bootstrap-grid.css">
    <link rel="stylesheet" href="css/estilos.css">
    <link href="css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Ingreso y Egreso</title>
</head>
<body>
    <div >
        <div class="p-4 mb-3 bg-primary text-white text-center h3 ">
          CONTROL DE CUENTAS
        </div>
      </div>
<br>

  <div class="container text-center ">
      
        <div class="row">
          <div class="col marco">           
            <!-- Button trigger modal -->
<button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">
    INGRESOS
  </button>
  
  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Registro de ingresos</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <!---Fromulario-->
          <form action="ingreso.php" class="row g-3 needs-validation" method="post">
         
            <input class="form-control" type="date" placeholder="Fecha" aria-label="default input example" name="fecha">
            <input class="form-control" type="text" placeholder="Descripción" aria-label="default input example" name="descripcion">           
         <input class="form-control" type="text" placeholder="Valor del ingreso" aria-label="default input example" name="valor" ">


            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Salir</button>
              <button type="submit" class="btn btn-primary">Guardar</button>
           
            </div>
          </form>
        </div>
      
      </div>
    </div>
  </div> 
            <hr>                 
           
            <p class="text-fw-bold ">
    Total <b id="total" class="text-success">$<?php echo number_format($total, 0, '.', ','); ?></b>
</p>


            <hr>
            
            
            <div style="max-height: 380px; overflow-y: auto;">
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Fecha</th>
                <th scope="col">Descripción</th>
                <th scope="col">Valor</th>
                <th scope="col"><i class="fa-regular fa-pen-to-square"></i></th>
            </tr>
        </thead>
        <tbody>
            <?php
            include "conexion.php";
            $sql = $conn->query("select * from ingresos");
            while ($datos = $sql->fetch_object()) { ?>
                <tr>
                    <th scope="row"><?= $datos->id ?></th>
                    <td><?= $datos->fecha ?></td>
                    <td><?= $datos->descripcion ?></td>
                    <td>$<?= number_format($datos->valor) ?></td>
                    <td>
                        <select class="form-select form-select-sm" aria-label=".form-select-sm example">
                            <option selected>Acción</option>
                            <option class="text-success" value="1">Editar</option>
                            <option class="text-danger" value="2">Eliminar</option>
                        </select>
                    </td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
</div>

          </div>

          
            <div class="col marco">           
            <!-- Button trigger modal -->
<button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal1">
    EGRESOS
  </button>
  
  <!-- Modal -->
  <div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Registro de egresos</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <!---Fromulario-->
          <form action="egresos.php" class="row g-3 needs-validation" method="post">
         
          <input class="form-control" type="date" placeholder="Fecha" aria-label="default input example" name="fechar">
            <input class="form-control" type="text" placeholder="Descripción" aria-label="default input example" name="descripcionr">
            <input class="form-control" type="text" placeholder="Valor del ingreso" aria-label="default input example" name="valorr">
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Salir</button>
              <button type="submit" class="btn btn-primary">Guardar</button>
       
          </form>
        </div>
        </div>
        
      </div>
    </div>
  </div> 
            <hr>                 
           
            <p class="text-fw-bold ">
    Total <b id="tegreso" class="text-danger">$<?php echo number_format($tegreso, 0, '.', ','); ?></b>
</p>

            <hr>
            <table class="table table-striped">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Fecha</th>
                    <th scope="col">Descripción</th>
                    <th scope="col">Valor</th>
                    <th scope="col">♫</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <th scope="row">1</th>
                    <td>xxxx</td>
                    <td>xxx/td>
                    <td>20.000</td>
                    <td><select class="form-select form-select-sm" aria-label=".form-select-sm example">
                      <option selected>Acción</option>
                      <option class="text-success" value="1">Editar</option>
                      <option class="text-danger" value="2">Eliminar</option>
                   </select>
                  </td>
                  </tr>
                  <tr>
                    <th scope="row">2</th>
                    <td>xxxx</td>
                    <td>xxx/td>
                    <td>20.000</td>
                    <td><select class="form-select form-select-sm" aria-label=".form-select-sm example">
                      <option selected>Acción</option>
                      <option class="text-success" value="1">Editar</option>
                      <option class="text-danger" value="2">Eliminar</option>
                   </select>
                  </td>
                  </tr>
                  <tr>
                    <th scope="row">3</th>
                    <td>xxxx</td>
                    <td>xxx/td>
                    <td>20.000</td>
                    <td><select class="form-select form-select-sm" aria-label=".form-select-sm example">
                      <option selected>Acción</option>
                      <option class="text-success" value="1">Editar</option>
                      <option class="text-danger" value="2">Eliminar</option>
                   </select>
                  </td>
                  </tr>
                  <th scope="row">4</th>
                  <td>xxxx</td>
                  <td>xxx/td>
                  <td>20.000</td>
                  <td><select class="form-select form-select-sm" aria-label=".form-select-sm example">
                    <option selected>Acción</option>
                    <option class="text-success" value="1">Editar</option>
                    <option class="text-danger" value="2">Eliminar</option>
                 </select>
                </td>
                </tr>
                <th scope="row">5</th>
                <td>xxxx</td>
                <td>xxx/td>
                <td>20.000</td>
                <td><select class="form-select form-select-sm" aria-label=".form-select-sm example">
                  <option selected>Acción</option>
                  <option class="text-success" value="1">Editar</option>
                  <option class="text-danger" value="2">Eliminar</option>
               </select>
              </td>
              </tr>
              <th scope="row">6</th>
              <td>xxxx</td>
              <td>xxx/td>
              <td>20.000</td>
              <td><select class="form-select form-select-sm" aria-label=".form-select-sm example">
                <option selected>Acción</option>
                <option class="text-success" value="1">Editar</option>
                <option class="text-danger" value="2">Eliminar</option>
             </select>
            </td>
            </tr>
            
          </tr>
                </tbody>
              </table>
          </div>

          <div class="container text-center ">
          <div class="row">
            <div class="col marco">                
                <h5 class="card-title">Consulta</h5>
                <hr>
                <label for="exampleFormControlInput1" class="form-label">Fecha Inicio</label>
                <input type="date">
                <br>
                <label for="exampleFormControlInput1" class="form-label">Fecha Final</label>
                <input type="date">
                <br>
                  <a href="#" class="btn btn-primary">Consultar</a>

                  <hr>
                  <p class="lh-1 text-start mx-2  ">El informe, con fecha de inicio del <b>01/02/2024</b> y fecha de finalización el <b class="text-warnign ">01/02/2024</b>, presenta los siguientes resultados:</p>


                  
                  <p class=" fw-bold">Total Ingresos: <a  class="text-success text-decoration-none fw-normal">$2.000.000</a></p>
                  <p class=" fw-bold">Total Egresos: <a  class="text-danger text-decoration-none fw-normal">$2.000.000</a></p>
                  <hr>

                  <div class="alert alert-success" role="alert">
                    <H2>$2.500.000</H2>
                    <label for="exampleFormControlInput1" class="form-label fw-bold">Utilidad</label>
                  </div>
                  
                 

                                 

                  
            </div>
            <div class="col marco">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title">Special title treatment</h5>
                  <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                  <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
              </div>
            </div>
            <div class="col marco">
                <div class="card">
                  <div class="card-body">
                    <h5 class="card-title">Special title treatment</h5>
                    <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                    <a href="#" class="btn btn-primary">Go somewhere</a>
                  </div>
                </div>
              </div>
          </div>

          </div> 
        </div> 

         
          
          
          
        
               
      </div>


      
      <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

</body>
</html>