<?php 

include_once('./src/Carrinho.php');

$carrinho = new Carrinho([
    ['id' => 1, 'nome' => 'Camiseta', 'preco' => 59.90, 'estoque' => 10],
    ['id' => 2, 'nome' => 'Calça Jeans', 'preco' => 129.90, 'estoque' => 5],
    ['id' => 3, 'nome' => 'Tênis', 'preco' => 199.90, 'estoque' => 3],
]);

/**
 * Caso de uso 1: Adicionar item válido ao carrinho
 * Resultado: $err vazio, carrinho com produto adicionado
 */
echo"Caso 1 - Adicionar item válido ao carrinho <br>";
$err = $carrinho->adicionarItemAoCarrinho(1, 2);
print $err . "<br><br>";
//var_dump($carrinho->obterResumo());

/**
 * Caso de uso 2: Adicionar item além do estoque
 * Resultado: $err com mensagem, produto não adicionou no carrinho
 */
echo"Caso 2 - Adicionar item além do estoque <br>";
$err = $carrinho->adicionarItemAoCarrinho(3, 10) . "<br>";
print $err . "<br>";

/**
 * Caso de uso adicional: Adicionar produto não existente
 * Resultado: $err com mensagem, produto não encontrado
 */
echo"Caso de uso adicional - Adicionar produto não existente <br>";
$err = $carrinho->adicionarItemAoCarrinho(4, 1) . "<br>";
print $err  . "<br>";

/**
 * Caso de uso adicional: Adicionar quantidade 1 do mesmo produto duas vezes
 * Resultado: Carrinho com quantidade 2
 */
echo"Caso de uso adicional - Adicionar quantidade 1 do mesmo produto duas vezes <br>"; 
$err = $carrinho->adicionarItemAoCarrinho(1,1);
print $err . "<br>";
$err = $carrinho->adicionarItemAoCarrinho(1,1);
print $err . "<br><br>";
//var_dump($carrinho->obterResumo()) . "<br><br>";

/**
 * Caso de uso 3: Remover produto do carrinho
 * Antes de remover, é preciso adicionar primeiro
 * Resultado: Estoque restaurado, carrinho vazio
 */
echo"Caso de uso 3 - Remover produto do carrinho <br>";
$err = $carrinho->adicionarItemAoCarrinho(1,1);
print $err . "<br>";
//var_dump($carrinho->obterResumo()); // 1 produto no carrinho, estoque 9
$err = $carrinho->removerItemDoCarrinho(1);
print $err . "<br>";
//var_dump($carrinho->obterResumo()) . "<br><br>"; // carrinho vazio, estoque retorna pra 10

/**
 * Caso de uso 4: Aplicando cupom de desconto
 * Adiciona o produto 1 ,2 e 3, aplica desconto e mostra o resumo
 * Resultado: Carrinho com subtotal mostrando o preço cheio, e o total mostrando preço com desconto.
 * Cenário adicional: remover o cupom deve voltar os totais
 */
echo"Caso de uso 4 - Aplicando cupom de desconto <br>";
$carrinho->adicionarItemAoCarrinho(1, 1);
$carrinho->adicionarItemAoCarrinho(2, 1);
$carrinho->adicionarItemAoCarrinho(3, 1);
$err = $carrinho->aplicarCupom('DESCONTO10');
print $err . "<br>";
//var_dump($carrinho->obterResumo()) . "<br>";
$carrinho->removerCupom();
print $err . "<br>";
//var_dump($carrinho->obterResumo()) . "<br>";

?>