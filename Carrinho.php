<?php

class Carrinho
{
    private array $produtos;

    private array $items = [];

    private float $desconto = 0;

    public function __construct(
        array $produtos = []
    ) {
        $this->produtos = $produtos;
    }
    
    public function adicionarItemAoCarrinho(int $id, int $quantidade)
    {
        foreach ($this->produtos as $index => $produto) {
            if ($produto['id'] === $id) {
                if ($quantidade <= $produto['estoque']) {
                    // Posso adicionar, quantidade suficiente

                    // Diminui estoque disponível
                    $this->produtos[$index]['estoque'] -= $quantidade;

                    // Verifica se o produto já está no carrinho
                    $adicionado = false;
                    
                    foreach ($this->items as $itemIndex => $item) {
                        if ($item['id'] === $id) {
                            // Produto já está no carrinho, atualiza quantidade
                            $this->items[$itemIndex]['quantidade'] += $quantidade;
                            $adicionado = true;
                            break;
                        }
                    }

                    // Não foi encontrado no carrinho, novo registro
                    if (!$adicionado) {
                        $this->items[] = [
                            'id' => $id,
                            'quantidade' => $quantidade,
                            'preco_unitario' => $produto['preco'],
                        ];
                    }

                    $this->atualizarTotais();
                    return;
                }
                // Não posso adicionar, quantidade maior que o estoque
                return "Estoque insuficiente";
            }
        }

        return "Produto não encontrado";
    }

    public function removerItemDoCarrinho(int $id)
    {
        $indexDoItem = false;
        $quantidadeParaRestaurar = 0;

        foreach ($this->items as $index => $item) {
            if ($item['id'] === $id) {
                $indexDoItem = $index;
                $quantidadeParaRestaurar = $item['quantidade'];
                break;
            }
        }

        if ($indexDoItem === false) {
            return "Produto não está no carrinho";
        }
        
        // Remove do carrinho
        unset($this->items[$indexDoItem]);

        // Restaura a quantidade
        foreach ($this->produtos as $index => $produto) {
            if ($produto['id'] === $id) {
                $this->produtos[$index]['estoque'] += $quantidadeParaRestaurar;
                break;
            }
        }
    }

    public function aplicarCupom(string $cupom)
    {
        if ($cupom === "DESCONTO10") {
            $this->desconto = 0.1;
            $this->atualizarTotais();
            return;
        }

        return "Cupom inválido";
    }

    public function removerCupom()
    {
        $this->desconto = 0;
        $this->atualizarTotais();
    }

    private function atualizarTotais()
    {
        foreach ($this->items as $index => $item) {
            $subtotal = $item['quantidade'] * $item['preco_unitario'];
            $desconto = 0;

            if ($this->desconto > 0) {
                $desconto = $subtotal * $this->desconto;
            }

            $this->items[$index]['subtotal'] = $subtotal;
            $this->items[$index]['total'] = $subtotal - $desconto;
        }
    }

    public function obterResumo()
    {
        $subtotal = 0;
        $total = 0;

        foreach ($this->items as $item) {
            $subtotal += $item['subtotal'];
            $total += $item['total'];
        }

        return [
            'items' => $this->items,
            'subtotal' => $subtotal,
            'total' => $total,
        ];
    }
}

$carrinho = new Carrinho([
    ['id' => 1, 'nome' => 'Camiseta', 'preco' => 59.90, 'estoque' => 10],
    ['id' => 2, 'nome' => 'Calça Jeans', 'preco' => 129.90, 'estoque' => 5],
    ['id' => 3, 'nome' => 'Tênis', 'preco' => 199.90, 'estoque' => 3],
]);