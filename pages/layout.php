<?php

use App\Lib\DbConnection;

$conn = DbConnection::getConn();
$smtp = $conn->prepare('SELECT * FROM categoria ORDER BY nome');
$smtp->execute();
$categorias = $smtp->fetchAll();
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Bootstrap css -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <!-- My css -->
  <link rel="stylesheet" href="/public/css/styles.css">
  <title>My food</title>
</head>

<body>

  <?php
  $page = filter_input(INPUT_GET, 'page', FILTER_SANITIZE_SPECIAL_CHARS);
  ?>

  <?php if ($page == 'cardapio'): ?>
    <header>
      <div class="cardapio-banner">
        <h3>Cardapio</h3>
      </div>
      <nav>
        <ul>
          <?php foreach ($categorias as $categoria): ?>
            <li>
              <a href="#categoria_<?= $categoria['id'] ?>">
                <?= $categoria['nome'] ?>
              </a>
            </li>
          <?php endforeach; ?>
        </ul>
      </nav>
    </header>
  <?php endif; ?>
  

  <div class="container mt-4">
    <?php
    $filePath = __DIR__ . '/' . $page . '.php';
    if (file_exists($filePath)) {
      require($filePath);
    } else {
      require('pages/not_found.php');
    }
    ?>
  </div>

  <nav class="navbar">
    <a href="#" class="active">
      <span class="icon">&#8962;</span>
      Início
    </a>
    <a href="#">
      <span class="icon">&#128722;</span>
      Carrinho
      <span class="cart-badge">1</span>
    </a>
    <a href="#">
      <span class="icon">&#128278;</span>
      Histórico
    </a>
  </nav>

  <!-- Bootstrap js -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>

</html>