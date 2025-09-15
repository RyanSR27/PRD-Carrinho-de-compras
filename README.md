Nome: Ryan dos Santos Rodrigiues
RA: 2018710
Curso: Análise e Desenvolvimento de Sistemas
Disciplina: Desing Patterns & Clean Code
Professor: Valdir Amancio Pereira Junior

Nome: Leonardo dos Santos da Silva
RA: 2034122
Curso: Análise e Desenvolvimento de Sistemas
Disciplina: Desing Patterns & Clean Code
Professor: Valdir Amancio Pereira Junior

PRD - Carrinho de compras

Desenvolvido para a operação de checkout em um ecommerce, com a criação de produtos, adicionar ou remover do carrinho, alterar estoque de produto de acordo com a operação a ser realizada.
Foi desenvolvido utilizando PHP.

Como rodar

Para rodar o projeto é necessário ter um servidor local Apache, e para esse servidor, foi utilizado o XAMPP para o LocalHost. Caso não tenha o XAMPP instalado, siga os passos abaixo para executa-lo:

1 - Instale o app pelo Link: https://www.apachefriends.org/pt_br/index.html
2 - Após intalar, execute o app e conceda as permissões necessárias.
3 - Abra o app e clique em Star na opção de servidor Apache.
4 - Abra o navegador e digite "localhost" na busca.
5 - Selecione o repositório que salvou o projeto.
6 - Execute o arquivo "index.php".

Funcionalidades

Função adicionarItemAoCarrinho adiciona um produto ao carrinho, conferindo se ele existe e se tem estoque suficiente no carrinho, aumenta a quantidade, se não, cria um novo item. Em seguida, atualiza o total do carrinho.

Função removerItemDoCarrinho remove um produto do carrinho e restaura o estoque do produto removido.

Função aplicarCupom ela aplica um cupom de desconto fixo no carrinho.

Função atualizarTotais recalcula os valores parciais(subtotal) e o valor total com desconto de cada item do carrinho.

Função obterResumo serve como um complemento da função atualizarTotais, onde junta as informações do carrinho e devolve um resumo.

Exemplos de uso e casos de teste

Caso de uso 1: Adicionar item válido ao carrinho
Resultado: $err vazio, carrinho com produto adicionado

Caso de uso 2: Adicionar item além do estoque
Resultado: $err com mensagem, produto não adicionou no carrinho

Caso de uso 3: Remover produto do carrinho antes de remover, é preciso adicionar primeiro
Resultado: Estoque restaurado, carrinho vazio

Caso de uso 4: Aplicando cupom de desconto adiciona o produto 1 ,2 e 3, aplica desconto e mostra o resumo
Resultado: Carrinho com subtotal mostrando o preço cheio, e o total mostrando preço com desconto. 
Cenário adicional: remover o cupom deve voltar os totais

Caso de uso adicional: Adicionar quantidade 1 do mesmo produto duas vezes
Resultado: Carrinho com quantidade 2

Caso de uso adicional: Adicionar produto não existente
Resultado: $err com mensagem, produto não encontrado