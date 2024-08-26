<?php

$page = filter_input(INPUT_GET, 'page', FILTER_SANITIZE_SPECIAL_CHARS);

?>

<div class="sidebar">
  <h1>MY FOOD</h1>
  <a class="<?= $page === "admin_home" ? "selected" : "" ?>" href="#">Inicio</a>
  <a class="<?= $page === "admin_pedidos" ? "selected" : "" ?>" href="#">Pedidos</a>
  <a class="<?= $page === "admin_alimentos" ? "selected" : "" ?>" href="#">Alimentos</a>
  <a class="<?= $page === "admin_categorias" ? "selected" : "" ?>" href="#">Categorias</a>
  <a href="#">Sair</a>
</div>

<div class="main-content">
  <?php
  $filePath = __DIR__ . '/' . $page . '.php';
  if (file_exists($filePath)) {
    require($filePath);
  } else {
    require('pages/not_found.php');
  }
  ?>
</div>