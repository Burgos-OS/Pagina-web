<?php include "Templates/heater.php" ?>

    </header>
    <section class="form-register">
      <h4>Iniciar sesion</h4>
      <form action="authenticate.php" method="post">
        <input class="control" name="username" id="username" placeholder="Nombre de usuario" required/>
        <input class="control" type="Password" name="password" id="password" placeholder="Contraseña"required/>      
        <p>
          <input type="submit" value="Login">
        </p>
      </form>
      <br>
      <p>
        <u><a href="registrar.php">Registrarse</a></u>
      </p>
    </section>
<?php include "Templates/footer.php"?>