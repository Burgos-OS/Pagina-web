<?php
require "config.php";
require "common.php";

if (isset($_POST['submit'])) {
  try {
    $connection = new PDO($dsn, $username, $password, $options);

        $new_user = array(
          "nombre"            => $_POST['nombre'],
          "primer_apellido"   => $_POST['primer_apellido'],
          "segundo_apellido"  => $_POST['segundo_apellido'],
          "telefono"          => $_POST['telefono'],
          "codigo_postal"     => $_POST['codigo_postal'],
          "estado"            => $_POST['estado'],
          "ciudad"            => $_POST['ciudad'],
          "colonia"           => $_POST['colonia'],
          "fecha_nacimiento"  => $_POST['fecha_nacimiento']
          );
     
    $sql = sprintf("INSERT INTO %s (%s) values (%s)","cliente", implode(", ",array_keys($new_user)),":" . implode(", :",array_keys($new_user)));
    
    $statement = $connection->prepare($sql);
    $statement->execute($new_user);
  }
    catch(PDOException $error){
    echo $sql . "<br>" . $error->getMessage();
  }
}
?>
<?php include "Templates/heater.php" ?>

<?php if (isset($_POST['submit'])&& $statement) { ?>
  > <?php echo $_POST['nombre']; ?> agregado exitosamente.
  <?php header("Location: registrar-correo.php");?>
<?php 
} ?>

<div class="d-flex justify-content-center align-items-center flex-column" >
        <h2 class="portada">
          !Unetenos!
        </h2>
        <botton class="btn btn-dark">
           Conoce más
        </botton>
      </div> 
    </header>
    <form class="form-register" method="post">
      <h4>Formulario de Registro</h4>
      <input class="control" type="text" name="nombre" id="nombre" placeholder="Ingrese su nombre" required/>
      <input class="control" type="text" name="primer_apellido" id="primer_apellido" placeholder="Ingrese su Primer apellido" required/>
      <input class="control" type="text" name="segundo_apellido" id="segundo_apellido" placeholder="Ingrese su Segundo apellido" required/>
      <input class="control" type="text" name="telefono" id="telefono" placeholder="Telefono" required/>
      <input class="control" type="number" name="codigo_postal" id="codigo_postal" placeholder="Codigo Postal" required/>
      <input class="control" type="text" name="estado" id="estado" placeholder="Estado" required/>
      <input class="control" type="text" name="ciudad" id="ciudad" placeholder="Ciudad" required/>
      <input class="control" type="text" name="colonia" id="colonia" placeholder="Colonia" required/><br>
      <label for="start">Fecha de nacimiento:</label>
      <input class="control" type="date" id="start" name="fecha_nacimiento"
       value="2018-07-22"
       min="2000-01-01" max="2021-12-31" required>
      <p>
        Estoy deacuerdo con<a href="#">Terminos y Condiciones</a>
        <input type="submit" name="submit" id="submit" class="btn btn-light">
      </p>
      <br>
      <p>
        <u><a href="iniciar-sesion.php">Ya tengo cuenta</a></u>
      </p>
    </form>

<?php include "Templates/footer.php" ?>