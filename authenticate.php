<?php
session_start();
require "config.php";
require "common.php";
$con = mysqli_connect($host, $username, $password, $dbname);
if ( !isset($_POST['username'], $_POST['password']) ) {
	echo "<script>alert('Usuario ya existe');</script>";
}
if ($stmt = $con->prepare('SELECT id, cliente, password FROM accounts WHERE username = ?')) {
	$stmt->bind_param('s', $_POST['username']);
	$stmt->execute();
	$stmt->store_result();

  if ($stmt->num_rows > 0) {
    $stmt->bind_result($id, $cliente, $password);
    $stmt->fetch();
    if (password_verify($_POST['password'], $password)) {
      session_regenerate_id();
      $_SESSION['loggedin'] = TRUE;
      $_SESSION['name'] = $_POST['username'];
      $_SESSION['id'] = $id;
      $_SESSION['cliente'] = $cliente;
      header('Location: cliente.php');
    } else {
      echo 'Contraseña y/o usuario incorrecto';
      header('Location: iniciar-sesion.php');
    }
  } else {
    echo 'Contraseña y/o usuario incorrecto';
    header('Location: iniciar-sesion.php');
  }
	$stmt->close();
}
?>