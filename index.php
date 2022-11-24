<?php
  session_start();
  
  function __autoload($class){
      include_once $class.".class.php";
  }

  $conn = new Conexao();
  $logado = false;
  if(isset($_POST['email'])){
      $u = $_POST['email'];
      $s = $_POST['password'];
      $_SESSION['valor'] = $u;
      $conn->consultar("SELECT * FROM users where username = '$u' and senha = '$s'");
      if($conn->nResultados()>=1){
        $logado = True;
      }
  }

  
?>
 <?php if($logado){?>
    <meta http-equiv="refresh" content="0;url=main.php">
   <?php }else{?> 
        <!DOCTYPE html>
        <html lang="en">
        
        <head>
            <meta charset="UTF-8" />
            <!-- Cadeia de caracteres a ser usada -->
            <meta http-equiv="X-UA-Compatible" content="IE=edge" />
            <!-- meta é exclusiva para Internet Explorer, ela pode configurar a página para ser renderizada como em outra versão do Internet Explorer. -->
            <meta name="viewport" content="width=device-width, initial-scale=1.0" />
            <!-- define o nível de zoom inicial quando a página é carregada pela primeira vez pelo navegador -->
            <link rel="stylesheet" href="login.css" />
            <!-- Link para o .css -->
            <link rel="preconnect" href="https://fonts.googleapis.com" />
            <!-- Pré carregamento da fonte -->
            <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
            <!-- Pré carregamento da fonte -->
            <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;400;500;700;900&display=swap" rel="stylesheet" />
            <!-- Fonte ROBOTO-->
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
            <script>
                function redireciona(){
                    location.href="http://sosocial2.000webhostapp.com/cadastro.php";
            
                }   
            </script>
            <title>Login - SOSocial</title>
            <!-- Título do cabeçalho -->
        </head
        
        <body>
          
        <main>
            <h1>SOSocial</h1>
            <!-- Título do Site -->
            <form method="post" action="">
                <div class="field">
                    <strong>E-mail</strong>
                    <!-- Subtítulo da div E-mail -->
                    <input type="email" name="email" id="email" placeholder="Ex: Everton@gmail.com" />
                    <!-- Pré texto na caixa de digitação -->
                </div>
                <div class="field">
                    <strong>Senha</strong>
                    <!-- Subtítulo da div Senha -->
                    
                    <input type="password" name="password" id="password" placeholder="*********" />
                    
                    <!-- Pré texto na caixa de digitação -->
                </div>
            
                <div class="btn-actions">
                    <button type="submit">Entrar</button>
                    <!-- Submit para entrar -->
                    <a href="cadastro.php">Cadastrar</a>
                    <!-- Link para a tela de cadastro do usuário -->
                </div>
            </form>
        </main>
         
        </body>
        </html>
<?php } ?>