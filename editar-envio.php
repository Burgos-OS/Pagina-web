<?php
require "config.php";
require "common.php";


if (isset($_POST['submit'])){
  try{
    $connection=new PDO($dsn, $username, $password, $options);
    $pack =[
      "paquete_id"     => $_POST['paquete_id'],
      "contenido"      => $_POST['contenido'],
      "peso"           => $_POST['peso'],
      "descripcion"    => $_POST['descripcion'],
      "date"           => $_POST['date']
    ];

    $sql = "UPDATE paquete
    SET paquete_id = :paquete_id,
    contenido = :contenido,
    peso = :peso,
    descripcion = :descripcion,
    date = :date
    WHERE paquete_id = :paquete_id";
    $statement = $connection->prepare($sql);
    $statement->execute($pack);

    $en =[
      "envio_id"               => $_POST['envio_id'],
      "codigo_postal"          => $_POST['codigo_postal'],
      "estado"                 => $_POST['estado'],
      "calle"                  => $_POST['calle'],
      "Descripcion"            => $_POST['Descripcion'],
      "telefono"               => $_POST['telefono'],
      "nombre_destinatario"    => $_POST['nombre_destinatario'],
      "primer_apellido"        => $_POST['primer_apellido'],
      "segundo_apellido"        => $_POST['segundo_apellido'],
      "pago"                   => $_POST['pago'],
      "etapa"                  => $_POST['etapa'],
      "date"                   => $_POST['date']
    ];

    $msql = "UPDATE envio
    SET envio_id = :envio_id,
    codigo_postal = :codigo_postal,
    estado = :estado,
    calle = :calle,
    Descripcion = :Descripcion,
    telefono = :telefono,
    nombre_destinatario = :nombre_destinatario,
    primer_apellido = :primer_apellido,
    segundo_apellido = :segundo_apellido,
    pago = :pago,
    etapa = :etapa,
    date = :date
    WHERE envio_id = :envio_id";
    $statement = $connection->prepare($msql);
    $statement->execute($en);

  }catch(PDOException $error){
    echo $sql . "<br>" . $error->getMessage();
  }
}

if (isset($_GET['id'])){
  try {
    $connection = new PDO($dsn, $username, $password, $options);
    $id = $_GET['id'];
    $sql = "SELECT * FROM paquete WHERE paquete_id =:id";
    $statement = $connection->prepare($sql);
    $statement->bindValue(':id', $id);
    $statement->execute();

    $user = $statement->fetch(PDO::FETCH_ASSOC);

    $env = "SELECT * FROM envio WHERE envio_id =:id";
    $statement = $connection->prepare($env);
    $statement->bindValue(':id', $id);
    $statement->execute();

    $send = $statement->fetch(PDO::FETCH_ASSOC);
  }catch (PDOException $error){
    echo $sql . "<br>" . $error->getMessage();
  }
} else {
  echo "¡Algo salio mal!";
  exit;
}

$echo ='<textare><input class="control" type="text" name="<?php echo $key;?>" id="<?php echo $key;?>" value="<? echo escape($value);?>" placeholder="<?php echo $key;?>"></textare>'
?>

<?php include "Templates/head.php" ?> 

<?php if (isset($_POST['submit'])&& $statement) { ?>
  > <?php echo $_POST['contenido']; ?> agregado exitosamente.
  <?php header("Location: envios.php")?>
<?php 
} ?>

<div class="d-flex justify-content-center align-items-center flex-column" style="color: aliceblue">
<br>
  <h2>Editar envio</h2>
  <a href="envios.php" class="btn btn-dark">
    Regresar
  </a>
</div>
<section class="tabla text-center">
<h4>Datos del usuario</h4>
  <section>
    <form method="post" class="row">
      <section>
      <table class="text-center">
        <tr>
          <td>Paquete</td>
          <td>-----------------<input type="submit" name="submit" value="Submit">-----------------</td>
        </tr>
        <?php foreach ($user as $key=>$value):?>
          <tr>
            <td><input class="control" type="text" name="<?php echo $key;?>" id="<?php echo $key;?>" value="<? echo escape($value);?>" placeholder="<?php echo $key;?>"<?php echo ($key=== 'paquete_id' ? 'readonly' : null);?>>
          </td>
          </tr>
        <?php endforeach;?>
      </table>
      </section>
      <section>
      <table class="text-center">
        <tr>
          <td>Envio</td>
        </tr>
        <?php foreach ($send as $key=>$value):?>
          <tr>
            <td><input class="control" type="text" name="<?php echo $key;?>" id="<?php echo $key;?>" value="<? echo escape($value);?>" placeholder="<?php echo $key;?>"<?php echo ($key=== 'envio_id' ? 'readonly' : null);?>></td>
          </tr>
        <?php endforeach;?>
      </table>
      </section>
    </form>
    </section>
  </section>
      
    <?php include "Templates/foot.php" ?>