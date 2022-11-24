<?php
  session_start();
  
  function __autoload($class){
      include_once $class.".class.php";
  }
  $conn = new Conexao();

  $user = $_SESSION['valor'];

  $conn->consultar("SELECT * FROM users where username = '$user'");
      if($conn->nResultados()==1){
          $lista = $conn->escrever();
        $nome = $lista["nome_completo"];
      }
    if((isset($_POST["textarea"]))){
        $texto = $_POST["textarea"];
        if($texto != $_SESSION['valida']){
        $hoje = date('d/m/Y');
        $conn->consultar("insert into publicacao(nome,texto,horario) values('$nome','$texto','$hoje')");
        $_SESSION['valida'] = $_POST["textarea"];
        }
    }

   if(isset($_GET["id"])){
      $id = $_GET["id"];
      $conn->consultar("delete from publicacao where id_public = '$id' and nome = '$nome'");
   }

   $contador = 1;
   $conn->consultar("SELECT max(id_public) contagem FROM publicacao");
   $lista = $conn->escrever();
   $total = $lista["contagem"];
   $contador = $total;
   
 
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,400;1,700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="style.css"/> 
  <title>SOSocial</title>
</head>

  
<body>
  <header>
    <strong style= "color: white;">SOSocial</strong>
  </header>
  <main class="main">

    <!-- Formulário de postagem -->
    <div class="newPost">

      <div class="infoUser">
        <div class="imgUser">
        </div>
        <strong><?php echo $nome ?></strong>
      </div>

      <form method="post" action="" class="formPost" id="formPost">
        <textarea name="textarea" placeholder="Deixe aqui sua reclamação" id="textarea"></textarea>
        <div class="iconsAndButton">
          <div class="icons">
            <button class="btnFileForm">
              <img src="./assets/img.svg" alt="Adicionar uma imagem">
            </button>
            <button class="btnFileForm">
              <img src="./assets/gif.svg" alt="Adicionar um gif">
            </button>
            <button class="btnFileForm">
              <img src="./assets/video.svg" alt="Adicionar um vídeo">
            </button>
          </div>

          <button type="submit" id="botao" class="btnSubmitForm">Publicar</button>
        </div>
      </form>
    </div>
    
    <ul class="posts" id="posts">
        <?php while($contador>=1){
            $conn->consultar("SELECT * FROM publicacao where id_public = '$contador'");
            $dadosLista = $conn->escrever();
            $nombre = $dadosLista["nome"];
            $data = $dadosLista["horario"];
            $texto = $dadosLista["texto"];
            $id2 = $dadosLista["id_public"];
            if($conn->nResultados()>0){
        ?>
        <li class="post">
          <div class="infoUserPost">
            <div class="imgUserPost"></div>
              <div class="nameAndHour">
                <strong><?php echo $nombre ?></strong>
                <p><?php echo $data ?></p>
              </div>
          </div>
          <p>
             <?php echo $texto ?>
          </p>
          <form method="get">
          <div class="actionBtnPost">
            <button type="button" class="filesPost like"><img src="./assets/heart.svg" alt="Curtir">Curtir</button>
            <button type="button" class="filesPost comment"><img src="./assets/comment.svg" alt="Comentar">Comentar</button>
            <a href='main.php?id=<?php echo $id2;?>'><button type="button" class="filesPost share">Deletar</button></a>
          </div>
          </form>
            <!--<script type="module" src="./FormPost.js"></script>-->
        </li>
        <?php }$contador--;} ?>
    </ul>

  </main>
  
</body>

</html>

