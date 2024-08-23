document.addEventListener('DOMContentLoaded', () => {
    const adicionais = document.querySelectorAll('.adicional-container');
    let precoTotal = parseFloat(document.querySelector('.alimento-preco').dataset.preco);
    const adicionaisQuantidades = {};

    adicionais.forEach(adicional => {
        const adicionalId = adicional.dataset.adicionalId;
        const menosButton = adicional.querySelector('.menos-button');
        const maisButton = adicional.querySelector('.mais-button');
        const quantidadeSpan = adicional.querySelector('.quantidade');
        const precoElemento = adicional.querySelector('.adicional-preco');
        
        let quantidade = 0;
        const precoAdicional = parseFloat(precoElemento.dataset.preco);

        const atualizarPrecoTotal = (diferenca) => {
            precoTotal += diferenca;
            document.querySelector('.alimento-preco').textContent = `R$ ${precoTotal.toFixed(2)}`;
        };

        const atualizarObjetoAdicionais = () => {
            console.log('Atualizando objeto adicionais: ', adicionaisQuantidades);
            if (quantidade > 0) {
                adicionaisQuantidades[adicionalId] = quantidade;
            } else {
                delete adicionaisQuantidades[adicionalId];
            }
        };

        menosButton.addEventListener('click', () => {
            if (quantidade > 0) {
                quantidade--;
                quantidadeSpan.textContent = quantidade;
                atualizarPrecoTotal(-precoAdicional);
                atualizarObjetoAdicionais();
            }
        });

        maisButton.addEventListener('click', () => {
            quantidade++;
            quantidadeSpan.textContent = quantidade;
            atualizarPrecoTotal(precoAdicional);
            atualizarObjetoAdicionais();
        });
    });
});