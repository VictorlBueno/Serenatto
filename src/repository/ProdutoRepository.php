<?php

class ProdutoRepository
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    private function formatarObjetos($produtos): array
    {
        // Para cada item(cafe) retorne um novo produto(cria com construtor)
        return array_map(function ($produto) {
            return new Produto(
                $produto['id'],
                $produto['tipo'],
                $produto['nome'],
                $produto['descricao'],
                $produto['imagem'],
                $produto['preco']
            );
        }, $produtos);
    }

    private function opcoesProduto(string $produto): array
    {
        $sql = "SELECT * FROM produtos WHERE tipo = :produto ORDER BY preco";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':produto' => $produto]);
        $produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return formatarObjetos($produtos);
    }

    public function opcoesCafe(): array
    {
        return $this->opcoesProduto('Café');
    }

    public function opcoesAlmoco(): array
    {
        return $this->opcoesProduto('Almoço');
    }

    public function buscarTodos()
    {
        $sql = "SELECT * FROM produtos";
        $stmt = $this->pdo->query($sql);
        $dados = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $todosOsDados = formatarObjetos($dados);
    }
}