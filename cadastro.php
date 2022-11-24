<?php
  session_start();
  
  function __autoload($class){
      include_once $class.".class.php";
  }
  $conn = new Conexao();

  if((isset($_POST['name']))and(isset($_POST['email']))and(isset($_POST['password']))and(isset($_POST['repeat-password']))and($_POST['password'] == $_POST['repeat-password'])){
      $u = $_POST['email'];
      $s = $_POST['password'];
      $n = $_POST['name'];
      
      $conn->consultar("insert into users values('$u','$s','$n')");
      echo "<meta http-equiv='refresh' content='0;url=index.php'>";
  }

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="login.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;400;500;700;900&display=swap"
      rel="stylesheet"
    />
    <title>Cadastro</title>
  </head>
  <body>
    <main>
      <h1>Cadastro</h1>
      <form method="post" action="">
        <div class="field">
          <strong>Nome</strong>
          <input type="text" name="name" id="name" placeholder="Seu Bento" />
        </div>
        <div class="field error">
          <strong>E-mail</strong>
          <input
            type="email"
            name="email"
            id="email"
            placeholder="Ex: Everton@gmail.com"
          />
        </div>
        <div class="field">
          <strong>Senha</strong>
          <input
            type="password"
            name="password"
            id="password"
            placeholder="*******"
          />
        </div>
        <div class="field">
          <strong>Digite sua senha novamente</strong>
          <input
            type="password"
            name="repeat-password"
            id="repeat-password"
            placeholder="*******"
          />
        </div>
      <div class="btn-actions">
        <button type="submit">Criar Conta</button>
        <a href="index.php">voltar</a>
      </div>
      </form>
    </main>
  </body>
</html>
