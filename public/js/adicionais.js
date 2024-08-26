document.addEventListener('DOMContentLoaded', () => {
  const adicionais = document.querySelectorAll('.adicional-container');
  let precoTotal = parseFloat(document.querySelector('.alimento-preco').dataset.preco);
  let adicionaisLista = [];

  adicionais.forEach(adicional => {
    const adicionalId = adicional.dataset.adicionalId;
    const adicionalNome = adicional.dataset.adicionalNome;
    const toogleAdicional = adicional.querySelector('.toogle-adicional');
    const precoElemento = adicional.querySelector('.adicional-preco');

    const precoAdicional = parseFloat(precoElemento.dataset.preco);

    const somaPrecoTotal = (valor) => {
      precoTotal += valor;
      document.querySelector('.alimento-preco').textContent = `R$ ${precoTotal.toFixed(2)}`;
    };

    const subtraiPrecoTotal = (valor) => {
      precoTotal -= valor;
      document.querySelector('.alimento-preco').textContent = `R$ ${precoTotal.toFixed(2)}`;
    }

    const atualizarObjetoAdicionais = (e) => {
      const btn = e.target;
      const statusValue = btn.dataset.value;
      if (statusValue == '0') {
        btn.innerHTML = 'Não';
        btn.dataset.value = '1';
        adicionaisLista.push(adicionalId);
        somaPrecoTotal(precoAdicional);
      } else {
        btn.innerHTML = 'Sim';
        btn.dataset.value = '0';
        adicionaisLista = adicionaisLista.filter((valor) => valor != adicionalId);
        subtraiPrecoTotal(precoAdicional);
      }
    };

    toogleAdicional.addEventListener('click', atualizarObjetoAdicionais);
  });

  document.getElementById('botaoConfirmar').addEventListener('click', (e) => {
    e.preventDefault();

    const btn = e.target;
    const alimentoId = btn.dataset.alimentoid;

    if (localStorage.getItem('pedido')) {
      const pedido = JSON.parse(localStorage.getItem('pedido'));
      pedido.push({
        alimentoId,
        adicionais: adicionaisLista
      });
      localStorage.setItem('pedido', JSON.stringify(pedido));
    } else {
      localStorage.setItem('pedido', JSON.stringify(
        [
          {
            alimentoId,
            adicionais: adicionaisLista
          }
        ]
      ));
    }

    window.location.href = '/?page=carrinho';
  });
});
