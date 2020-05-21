<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
 
</head>
<body>
<section>
  <div>
  <!--<h1>Buscar</h1>-->
<ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item">
    <a class="nav-link active" id="categoria-tab" data-toggle="tab" href="#categoria" role="tab" aria-controls="categoria" aria-selected="true">Categoria</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="usuario-tab" data-toggle="tab" href="#usuario" role="tab" aria-controls="usuario" aria-selected="false">Texto</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Usuario</a>
  </li>

  <li class="nav-item">
    <a  class="nav-link "  href="registrado.php"   aria-selected="false">Inicio</a>
  </li>
</ul>

<div class="tab-content" id="myTabContent">
  <div class="tab-pane fade show active" id="categoria" role="tabpanel" aria-labelledby="categoria-tab">
  Categoria
  <form action="search_cat.php" method="post">
    <input type="text" name="categoria" id="">
    <input type="submit" value="Buscar">
  </form>
  
  </div>
  <div class="tab-pane fade" id="usuario" role="tabpanel" aria-labelledby="usuario-tab">
  Texto
  <form action="search_text.php" method="post">
    <input type="text" name="texto" id="">
    <input type="submit" value="Buscar">
  </form>
  
  </div>
  <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab"> 
  Usuario
  <form action="search_user.php" method="post">
    <input type="text" name="usuario" id="">
    <input type="submit" value="Buscar">
  </form>
   </div>
</div>

  </div>
</section>
</body>
</html>