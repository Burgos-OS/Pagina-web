<?php include "Templates/head.php" ?>
<?php
require "config.php";
require "common.php";

$con = mysqli_connect($host, $username, $password, $dbname);
if (mysqli_connect_errno()) {
	exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}
$stmt = $con->prepare('SELECT nombre,primer_apellido,segundo_apellido,telefono,codigo_postal,estado,ciudad,colonia,fecha_nacimiento,forma_pago FROM cliente WHERE cliente_id = ?');
$stmt->bind_param('i', $_SESSION['cliente']);
$stmt->execute();
$stmt->store_result();
$stmt->bind_result($nombre,$primer_apellido,$segundo_apellido,$telefono,$codigo_postal,$estado,$ciudad,$colonia,$fecha_nacimiento,$forma_pago);
$stmt->fetch();
$stmt->close();
?>


<div class="row">
  <div class="usuario col-6 col-sm-2 col-md-2 mt-2">
    <div class="card p-4 text-center">
      <div class="avatar rounded-circle" style="background-image: url(style/image/avatar.png)" ></div>
        <h5 class="mt-2">
        <?=$_SESSION['name'];?>
      </h5>
    </div>
  </div>
</div>
<section class="tabla text-center">
  <h4>Datos del usuario</h4>
    <form action="update-cliente.php" method="post">
      <table class="text-center">
        <tr>
          <td>Nombre:</td>
          <td><input class="control" type="text" name="nombre" id="nombre" value="<?=$nombre?>"></td>
          <td><input class="control" type="text" name="primer_apellido" id="primer_apellido" value="<?=$primer_apellido?>"></td>
          <td><input class="control" type="text" name="segundo_apellido" id="segundo_apellido" value="<?=$segundo_apellido?>"></td>
        </tr>
        <tr>
          <td>Fecha de nacimiento:</td>
          <td><input class="control" type="date" name="fecha_nacimiento" id="fecha_nacimiento" value="<?=$fecha_nacimiento?>"></td>
        </tr>
        <tr>
          <td>Telefono:</td>
          <td><input class="control" type="text" name="telefono" id="telefono" value="<?=$telefono?>"></td>
        </tr>
        <tr>
          <td>Codigo_postal:</td>
          <td><input class="control" type="number" name="codigo_postal" id="codigo_postal" value="<?=$codigo_postal?>"></td>
        </tr>
        <tr>
          <td>Estado:</td>
          <td><input class="control" type="text" name="estado" id="estado" value="<?=$estado?>"></td>
          <td>Ciudad:</td>
          <td><input class="control" type="text" name="ciudad" id="ciudad" value="<?=$ciudad?>"></td>
        </tr>
        <tr>
          <td>Direccion: </td>
          <td><input class="control" type="text" name="colonia" id="colonia" value="<?=$colonia?>"></td>
        </tr>
        <tr>
          <td>Forma de pago: </td>
          <td><input class="control" type="text" name="forma_pago" id="forma_pago" value="<?=$forma_pago?>"></td>
        </tr>
      </table>
      <input type="submit" name="submit" value="Submit">
    </form>
  </section>
<?php include "Templates/footer.php" ?>