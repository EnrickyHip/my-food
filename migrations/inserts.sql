INSERT INTO categoria (nome) VALUES ('Frutas');
INSERT INTO categoria (nome) VALUES ('Vegetais');
INSERT INTO categoria (nome) VALUES ('Carnes');
INSERT INTO categoria (nome) VALUES ('Laticínios');
INSERT INTO categoria (nome) VALUES ('Grãos');

INSERT INTO alimento (nome, preco, descricao, foto, categoria_id)
VALUES ('Maçã', 3.50, 'Maçã vermelha suculenta', '/public/foto_alimentos/maca.jpg', 1);
INSERT INTO alimento (nome, preco, descricao, foto, categoria_id)
VALUES ('Banana', 2.20, 'Banana madura e doce', '/public/foto_alimentos/banana.jpg', 1);
INSERT INTO alimento (nome, preco, descricao, foto, categoria_id)
VALUES ('Alface', 1.80, 'Alface fresca e crocante', '/public/foto_alimentos/alface.jpg', 2);
INSERT INTO alimento (nome, preco, descricao, foto, categoria_id)
VALUES ('Tomate', 2.00, 'Tomate orgânico', '/public/foto_alimentos/tomate.jpg', 2);
INSERT INTO alimento (nome, preco, descricao, foto, categoria_id)
VALUES ('Frango', 12.50, 'Frango inteiro congelado', '/public/foto_alimentos/frango.jpg', 3);
INSERT INTO alimento (nome, preco, descricao, foto, categoria_id)
VALUES ('Leite', 4.00, 'Leite integral 1L', '/public/foto_alimentos/leite.jpg', 4);
INSERT INTO alimento (nome, preco, descricao, foto, categoria_id)
VALUES ('Arroz', 15.00, 'Arroz branco 5kg', '/public/foto_alimentos/arroz.png', 5);
INSERT INTO alimento (nome, preco, descricao, foto, categoria_id)
VALUES ('Feijão', 8.00, 'Feijão preto 1kg', '/public/foto_alimentos/feijao.avif', 5);

INSERT INTO adicional (nome, preco) VALUES ('Granola', 1.50);
INSERT INTO adicional (nome, preco) VALUES ('Mel', 2.00);
INSERT INTO adicional (nome, preco) VALUES ('Canela', 0.50);
INSERT INTO adicional (nome, preco) VALUES ('Iogurte', 3.00);
INSERT INTO adicional (nome, preco) VALUES ('Aveia', 1.20);

-- Primeiro, obtenha o ID do pedido que contém o alimento "Banana"
INSERT INTO alimento_pedido (alimento_id, pedido_id) VALUES (2, 1);

-- Agora, insira os adicionais ao alimento
INSERT INTO alimento_pedido_adicional (alimento_pedido_id, adicional_id) VALUES (1, 1); -- Granola
INSERT INTO alimento_pedido_adicional (alimento_pedido_id, adicional_id) VALUES (1, 2); -- Mel
INSERT INTO alimento_pedido_adicional (alimento_pedido_id, adicional_id) VALUES (1, 3); -- Canela
INSERT INTO alimento_pedido_adicional (alimento_pedido_id, adicional_id) VALUES (1, 4); -- Iogurte
INSERT INTO alimento_pedido_adicional (alimento_pedido_id, adicional_id) VALUES (1, 5); -- Aveia
