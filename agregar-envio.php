<?php include "Templates/head.php" ?>
<?php
require "config.php";
require "common.php";

$con = mysqli_connect($host, $username, $password, $dbname);
$stmt = $con->prepare('SELECT cliente_id FROM cliente WHERE cliente_id = ?');
$stmt->bind_param('i', $_SESSION['id']);
$stmt->execute();
$stmt->store_result();
$stmt->bind_result($cuenta);
$stmt->fetch();
$stmt->close();

if (isset($_POST['submit'])) {
  try {
    $connection = new PDO($dsn, $username, $password, $options);

        $pack = array(
        "contenido"     => $_POST['contenido'],
        "peso"          => $_POST['peso'],
        "descripcion"   => $_POST['descripcion']
        );

    $sql = sprintf("INSERT INTO %s (%s) values (%s)","paquete", implode(", ",array_keys($pack)),":" . implode(", :",array_keys($pack)));
    
    $statement = $connection->prepare($sql);
    $statement->execute($pack);

    $con = mysqli_connect($host, $username, $password, $dbname);
    $stmt = $con->prepare('SELECT paquete_id FROM paquete order by paquete_id desc limit 1');
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($paquete);
    $stmt->fetch();
    $stmt->close();

    $envio = array(
      "cuenta"                => $cuenta,
      "paquete"               => $paquete,
      "codigo_postal"         => $_POST['codigo_postal'],
      "estado"                => $_POST['estado'],
      "colonia"               => $_POST['colonia'],
      "calle"                 => $_POST['calle'],
      "Descripcion"           => $_POST['Descripcion'],
      "nombre_destinatario"   => $_POST['nombre_destinatario'],
      "primer_apellido"       => $_POST['primer_apellido'],
      "segundo_apellido"      => $_POST['segundo_apellido']
      );
    $sql = sprintf("INSERT INTO %s (%s) values (%s)","envio", implode(", ",array_keys($envio)),":" . implode(", :",array_keys($envio)));
    
    $statement = $connection->prepare($sql);
    $statement->execute($envio);
  }
    catch(PDOException $error){
    echo $sql . "<br>" . $error->getMessage();
  }
}
?>


<?php if (isset($_POST['submit'])&& $statement) { ?>
  > <?php echo $_POST['nombre_destinatario']; ?> agregado exitosamente.
  <?php header("Location: envios.php")?>
<?php 
} ?>

      <div class="d-flex justify-content-center align-items-center flex-column" style="color: aliceblue">
        <h2>
          Agregar envio
        </h2>
        <a href="envios.php" class="btn btn-dark">
           Regresar
        </a>
      </div>
      <section class="envio text-center">
        <form method="post">
          <h1>Paquete</h1>
          <input class="control" type="text" name="contenido" placeholder="Contenido"/>
          <input class="control" type="text" name="peso" placeholder="Peso (kg)"/>
          <input class="control" type="text" name="descripcion" placeholder="Descripcion"/> 
          
          
          <h1>Envio</h1>
          <input class="control" type="text" name="nombre_destinatario" placeholder="Nombre del destinatario"/>
          <input class="control" type="text" name="primer_apellido" placeholder="Primer apellido"/>
          <input class="control" name="segundo_apellido" placeholder="Segundo apellido"/>
          <input class="control" type="text" name="estado" placeholder="Estado"/>
          <input class="control" type="number" name="codigo_postal" placeholder="Codigo Postal"/> 
          <input class="control" type="text" name="colonia" placeholder="Colonia"/> 
          <input class="control" type="text" name="calle" placeholder="Calle"/> 
          <textarea class="control" type="text" name="Descripcion" placeholder="Descripcion del destino"/></textarea> 
          <p>
            <input class="btn btn-light" type="submit" name="submit" value="Submit">
          </p>
        </form>
      </section>
      
    <?php include "Templates/foot.php" ?>