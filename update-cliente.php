<?php
require "config.php";
require "common.php";

$con = mysqli_connect($host, $username, $password, $dbname);
if (mysqli_connect_errno()) {
	exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}
$stmt = $con->prepare('SELECT cliente_id FROM cliente WHERE cliente_id = ?');
$stmt->bind_param('i', $_SESSION['cliente']);
$stmt->execute();
$stmt->store_result();
$stmt->bind_result($clienteid);
$stmt->fetch();
$stmt->close();

if (isset($_POST['submit'])){
  try{
    $connection=new PDO($dsn, $username, $password, $options);
    $user =[
      "nombre"            => $_POST['nombre'],
      "primer_apellido"   => $_POST['primer_apellido'],
      "segundo_apellido"  => $_POST['segundo_apellido'],
      "telefono"          => $_POST['telefono'],
      "codigo_postal"     => $_POST['codigo_postal'],
      "estado"            => $_POST['estado'],
      "ciudad"            => $_POST['ciudad'],
      "colonia"           => $_POST['colonia'],
      "fecha_nacimiento"  => $_POST['fecha_nacimiento'],
      "forma_pago"        => $_POST['forma_pago']
    ];

    $sql = "UPDATE cliente
    SET nombre = :nombre,
    primer_apellido = :primer_apellido,
    segundo_apellido = :segundo_apellido,
    telefono = :telefono,
    codigo_postal = :codigo_postal,
    estado = :estado,
    ciudad = :ciudad,
    colonia = :colonia,
    fecha_nacimiento = :fecha_nacimiento,
    forma_pago = :forma_pago
    WHERE cliente_id = $clienteid";
    $statement = $connection->prepare($sql);
    $statement->execute($user);
  }catch(PDOException $error){
    echo $sql . "<br>" . $error->getMessage();
  }
}

?>
<?php if (isset($_POST['submit']) && $statement): ?>
<?php echo escape($_POST[$nombre]);?> Actualizacion exitosa.
<?php header('Location: cliente.php');?>
<?php endif;?>