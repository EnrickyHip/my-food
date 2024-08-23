<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pedido de Alimento</title>
    <link rel="stylesheet" href="public/css/test.css">
    <script src="public/js/adicionais.js" defer></script>
</head>
<body>

    <a href="?page=cardapio" class="botao-cardapio" title="Fechar">X</a>

    <?php
    use App\Lib\DbConnection;

    $conn = DbConnection::getConn();

    $query = "INSERT INTO pedido (nome, endereco, whatsApp, forma_pagamento_id) VALUES (NULL, NULL, NULL, NULL)";
    $stmt = $conn->prepare($query);
    $stmt->execute();

    $pedidoId = $conn->lastInsertId();

    $alimentoId = $_GET['alimento_id'] ?? null;

    if ($alimentoId) {
        $query = "INSERT INTO alimento_pedido (alimento_id, pedido_id) VALUES (:alimento_id, :pedido_id)";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':alimento_id', $alimentoId, PDO::PARAM_INT);
        $stmt->bindParam(':pedido_id', $pedidoId, PDO::PARAM_INT);
        $stmt->execute();

        $query = "SELECT alimento.id AS alimento_id, alimento.nome AS alimento_nome, alimento.preco AS alimento_preco, alimento.foto AS alimento_foto,
                         adicional.id AS adicional_id, adicional.nome AS adicional_nome, adicional.preco AS adicional_preco, adicional.descricao AS adicional_descricao
                  FROM alimento
                  JOIN alimento_pedido ON alimento.id = alimento_pedido.alimento_id
                  LEFT JOIN alimento_pedido_adicional ON alimento_pedido.id = alimento_pedido_adicional.alimento_pedido_id
                  LEFT JOIN adicional ON alimento_pedido_adicional.adicional_id = adicional.id
                  WHERE alimento_pedido.alimento_id = :alimento_id";

        $stmt = $conn->prepare($query);
        $stmt->bindParam(':alimento_id', $alimentoId, PDO::PARAM_INT);
        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if ($result) {
            $alimento = [
                'id' => $result[0]['alimento_id'],
                'nome' => $result[0]['alimento_nome'],
                'preco' => $result[0]['alimento_preco'],
                'foto' => $result[0]['alimento_foto']
            ];
            echo "<div class='alimento-container'>";
            if ($alimento['foto']) {
                echo "<img src='" . htmlspecialchars($alimento['foto']) . "' alt='Imagem do alimento' />";
            }
            echo "<div class='alimento-nome'>" . htmlspecialchars($alimento['nome']) . "</div>";
            echo "<div class='alimento-preco' data-preco='" . htmlspecialchars($alimento['preco']) . "'>R$ " . htmlspecialchars($alimento['preco']) . "</div>";
            echo "</div>";

            foreach ($result as $row) {
                if ($row['adicional_id']) {
                    echo "<div class='adicional-container' data-adicional-id='" . htmlspecialchars($row['adicional_id']) . "'>";
                    echo "<div class='adicional-info'>";
                    echo "<div class='adicional-nome'>" . htmlspecialchars($row['adicional_nome']) . "</div>";
                    echo "<div class='adicional-preco' data-preco='" . htmlspecialchars($row['adicional_preco']) . "'>R$ " . htmlspecialchars($row['adicional_preco']) . "</div>";
                    echo "<div class='adicional-descricao'>" . htmlspecialchars($row['adicional_descricao']) . "</div>";
                    echo "</div>";
                    echo "<div class='adicional-quantidade'>";
                    echo "<button class='menos-button'>-</button>";
                    echo "<span class='quantidade'>0</span>";
                    echo "<button class='mais-button'>+</button>";
                    echo "</div>";
                    echo "</div>";
                }
            }
        }
    }
    ?>
    <a href="#" class="botao-confirmar">Confirmar</a>
</body>
</html>
