<div class="h-header" style="padding: 70px;">
	<div class="h-logo"><a href="registrado.php"><img src="img/logo2.png" width="130"></a></div>
	<div class="h-search">
	
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
	
	
	
	
	</div>
	<div class="h-account">
		<a href="registrado/subir.php"><img src="img/icons/mas.png" width="50" title ="Sube una foto ó video" ></a>
		<a href="registrado/perfil.php?nombre=<?php echo $_SESSION['nombre'];?>">
			<img src="img/icons/perfil.png" class="i-icon">
		</a>
		<a href="registrado.php"><img src="img/logo2.png" width="130"></a>
	</div>
</div>