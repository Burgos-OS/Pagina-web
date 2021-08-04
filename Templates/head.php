<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
	header('Location: iniciar-sesion.php');
	exit;
}
?>

<!DOCTYPE html>
<html>
  <head lang="en">
    <title>Paqueteria Burgos</title>
      <meta charset="utf-8"/>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        
    <link rel=stylesheet href="style/paqueteria.css"/>
  </head>
  <body class="ingreso">
    <header>
      <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="Logotipo" href="index.php">
          <img src="style/image/logo.png" alt="logotipo" class="logo">
        </a>
        <span class="navbar-text">
            &nbsp Paqueteria Burgos
        </span>
        <ul class="navbar-nav mx-auto">
          <li class="nav-item">
            <a class="nav-link" href="cliente.php">Usuario</a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="envios.php">Envios</a>
          </li>
        </ul>
        <form class="form-inline">
          <li class="nav-item my-lg-0">
            <a class="btn btn-outline-success" href="logout.php">Cerrar sesión</a>
          </li>
        </form>
      </nav>