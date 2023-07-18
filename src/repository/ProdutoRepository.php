<?php

class ProdutoRepository
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function opcoesCafe() : array
    {
        $sql = "SELECT * FROM produtos WHERE tipo = 'Café' ORDER BY preco";
        $stmt = $this->pdo->query($sql);
        $produtosCafe = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Para cada item(cafe) retorne um novo produto(cria com construtor)
        return $dadosCafe = array_map(function($cafe){
            return new Produto(
                $cafe['id'],
                $cafe['tipo'],
                $cafe['nome'],
                $cafe['descricao'],
                $cafe['imagem'],
                $cafe['preco']
            );
        }, $produtosCafe);
    }
}