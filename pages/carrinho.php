<h5>Carrinho</h5>

<hr>

<!-- formlário -->

<h6>Preencha o formulário com seus dados</h6>

<form action="<?= $base_url ?>pages/process/faz_pedido.php" method="POST"
id="pedidoForm" autocomplete="off">
  <div class="form-group">
    <label for="nome">Seu nome</label>
    <input type="text" name="nome" id="nome" class="form-control" required>
  </div>
  <div class="form-group">
    <label for="endereco">Seu endereço</label>
    <textarea name="endereco" id="endereco" class="form-control" required></textarea>
  </div>
  <div class="form-group">
    <label for="whats">Seu WhatsApp</label>
    <input type="number" name="whats" id="whats" class="form-control" required>
  </div>

  <!-- formas de pagamento -->

  <h6>Escolha a forma de pagamento</h6>

  <?php
  use App\Lib\DbConnection;

  $conn = DbConnection::getConn();
  $stmt = $conn->prepare('SELECT * FROM forma_de_pagamento');
  $stmt->execute();
  $formasDePagamento = $stmt->fetchAll();
  ?>

  <select name="formaPagamento" id="formaPagamento" class="form-select" required>
    <?php if ($formasDePagamento && count($formasDePagamento) > 0): ?>
      <?php foreach ($formasDePagamento as $formaDePagamento): ?>
        <option value="<?= $formaDePagamento['id'] ?>">
          <?= $formaDePagamento['nome'] ?>
        </option>
      <?php endforeach; ?>
    <?php endif; ?>
  </select>

  <hr class="mt-4">

  <div class="btns-carrinho">
    <div>
      <div>
        <button class="botao" type="button" data-bs-toggle="modal"
        data-bs-target="#staticBackdrop">
          Revisar lista de alimentos
        </button>
      </div>
      <div class="mt-3">
        <button class="botao" type="button" id="addMaisPratos">
          Adicionar mais pratos
        </button>
      </div>
      <div class="mt-4">
        <button class="botao" type="submit" id="finalizarPedidoBtn">
          Finalizar pedido
        </button>
      </div>
    </div>
  </div>
</form>

<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static"
data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">
          Lista de alimentos
        </h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal"
        aria-label="Close"></button>
      </div>
      <div class="modal-body" id="listaAlimentosModalBody"></div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
          Fechar
        </button>
      </div>
    </div>
  </div>
</div>

<script>
  document.getElementById('addMaisPratos')
  .addEventListener('click', () =>  {
    window.location.href = '<?= $base_url ?>?page=inicio';
  });

  document.getElementById('pedidoForm')
  .addEventListener('submit', (e) => {
    if (!localStorage.getItem('pedido')) {
      alert('Nenhum produto foi adicionado');
      e.preventDefault();
      return;
    }
    const pedido = localStorage.getItem('pedido');
    const pedidoForm = document.getElementById('pedidoForm');
    const pedidoEscaped = pedido.replace(/"/g, '&quot;');
    const input = document.createElement('input');
    input.type = 'hidden';
    input.name = 'pedido';
    input.value = pedidoEscaped;
    pedidoForm.appendChild(input);
    localStorage.removeItem('pedido');
  });

  const myModal = document.getElementById('staticBackdrop');
  myModal.addEventListener('show.bs.modal', () => {
    if (localStorage.getItem('pedido')) {
      const pedido = JSON.parse(localStorage.getItem('pedido'));
      const ul = document.createElement('ul');
    }
  });
</script>
