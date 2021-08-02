<?php
require "config.php";
require "common.php";

$con = mysqli_connect($host, $username, $password, $dbname);
if (mysqli_connect_errno()) {
	exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}
$stmt = $con->prepare('SELECT cliente_id FROM cliente order by cliente_id desc limit 1');
$stmt->execute();
$stmt->store_result();
$stmt->bind_result($clienteid);
$stmt->fetch();
$stmt->close();

if (isset($_POST['submit'])) {
  try {
    $connection = new PDO($dsn, $username, $password, $options);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $new_user = array(
          "cliente"    => $clienteid,
          "username"   => $_POST['username'],
          "password"   => $password,
          "email"      => $_POST['email']
          );
     
    $sql = sprintf("INSERT INTO %s (%s) values (%s)","accounts", implode(", ",array_keys($new_user)),":" . implode(", :",array_keys($new_user)));
    
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
  <?php header("Location: index.php");?>
<?php 
} ?>

<div class="d-flex justify-content-center align-items-center flex-column" >
        <h3 class="portada">
          !Unetenos!
        </h3>
        <botton class="btn btn-dark">
           Conoce más
        </botton>
      </div> 
    </header>
    <form class="form-register" method="post">
      <h4>Formulario de Registro</h4>
      <input class="control" type="text" name="username" id="username" placeholder="Nombre de usuario" required/>
      <input class="control" type="Password" name="password" id="password" placeholder="Contraseña" required/>
      <input class="control" type="text" name="email" id="email" placeholder="Correo electronico" required/>
      <p>
        Estoy deacuerdo con<a href="#">Terminos y Condiciones</a>
        <input type="submit" name="submit" id="submit" class="btn btn-light">
      </p>
      <br>
      <p>
        <u><a href="paqueteria-iniciar-sesion.html">Ya tengo cuenta</a></u>
      </p>
    </form>

<?php include "Templates/footer.php" ?>