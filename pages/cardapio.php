<?php

use App\Lib\DbConnection;

$conn = DbConnection::getConn();
$smtp = $conn->prepare('SELECT * FROM alimento');
$smtp->execute();
$alimentos = $smtp->fetchAll();

$smtp = $conn->prepare('SELECT * FROM categoria');
$smtp->execute();
$categorias = $smtp->fetchAll();
?>

<select name="categorias" id="categorias" class="mb-3 p-2">
  <?php foreach ($categorias as $categoria): ?>
    <option value="<?= $categoria['id'] ?>">
      <?= $categoria['nome'] ?>
    </option>
  <?php endforeach; ?>
</select>

<?php foreach ($alimentos as $alimento): ?>
  <div class="alimento mb-3">
    <div class="alimento-corpo">
      <h6 class="m-0">
        <?= $alimento['nome'] ?>
      </h6>
      <p class="m-0">
        <?= $alimento['descricao'] ?>
      </p>
      <span class="preco-alimento text-danger">
        <?= $alimento['preco'] ?>
      </span>
    </div>
    <div class="alimento-cabecalho">
      <img src="<?= $alimento['foto'] ?>" alt="foto alimento" class="foto-alimento">
    </div>
  </div>
<?php endforeach; ?>
