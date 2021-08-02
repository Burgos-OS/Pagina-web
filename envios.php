<?php include "Templates/head.php" ?>
<?php
require "config.php";
require "common.php";

if (isset($_GET['id'])){
  try{
    $connection=new PDO($dsn, $username, $password, $options);
    $id = $_GET['id'];
    $sql = "DELETE FROM envio WHERE envio_id = :id";
    $statement = $connection->prepare($sql);
    $statement->bindParam(':id',$id);
    $statement->execute();

    $msql = "DELETE FROM paquete WHERE paquete_id = :id";
    $statement = $connection->prepare($msql);
    $statement->bindParam(':id',$id);
    $statement->execute();

    $sucess = "Usuario eliminado exitosamente";
  }catch(PDOException $error){
    echo $sql . "<br>" . $error->getMessage();
  }
}  

$con = mysqli_connect($host, $username, $password, $dbname);
$stmt = $con->prepare('SELECT id FROM accounts WHERE id = ?');
$stmt->bind_param('i', $_SESSION['id']);
$stmt->execute();
$stmt->store_result();
$stmt->bind_result($cuentaid);
$stmt->fetch();
$stmt->close();

try{

  $connection = new PDO($dsn, $username, $password, $options);

  $sql= "SELECT * FROM envio WHERE cuenta = :cuentaid";

  $statement = $connection->prepare($sql);
  $statement->bindParam(':cuentaid',$cuentaid);
  $statement->execute();

  $result = $statement-> fetchAll();
}catch(PDOException $error){
  echo $sql . "<br>" . $error->getMessage();
}
?>

<br>
<div class="portada d-flex justify-content-center align-items-center flex-column" >
  <h3>Registra tus envios</h3>
  <a href="agregar-envio.php" class="btn btn-dark">
     Agregar envio
  </a>
</div> 
<section class="envio text-center">
  <h4>Envios del usuario</h4>
  <p>Al eliminar el envio se borra instantaneamente el paquete y el envio</p>
    <form>
      <table>
        <tr class="control">
          <th>ID Envio:</th><th>-</th>
          <th>Destinatario:</th><th>-</th>
          <th>Direccion:</th><th>-</th>
          <th>Descripcion:</th><th>-</th>
          <th>Pago:</th><th>-</th>
          <th>Fecha de envio:</th><th>-</th>
          <th>Fecha de entrega:</th><th>-</th>
          <th>Observar:</th><th>-</th>
          <th>Eliminar:</th>
        </tr>
          <?php foreach($result as $row) : ?>
          <tr class="control">
            <td><?php echo escape($row["envio_id"]); ?></td><td></td>
            <td><?php echo escape($row["nombre_destinatario"]); ?><?php echo escape(" ")?><?php echo escape($row["primer_apellido"]); ?></td><td></td>
            <td><?php echo escape($row["estado"]); ?></td><td></td>
            <td><?php echo escape($row["Descripcion"]); ?></td><td></td>
            <td><?php echo escape($row["pago"]); ?></td><td></td>
            <td><?php echo escape($row["date"]); ?></td><td></td>
            <td>---</td><td></td>
            <td><a href="editar-envio.php?id=<?php echo escape($row["envio_id"]);?>">Editar</a></td>
            <td>-</td>
            <td><a href="envios.php?id=<?php echo escape($row["envio_id"]);?>">Eliminar</a></td>
          </tr>
          <?php endforeach;?>
        
      </table>
    </form>
  </section>
<?php include "Templates/foot.php" ?>