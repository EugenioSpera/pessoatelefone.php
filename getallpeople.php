<?php

require('./conexao.php');

$metodo = strtoupper($_SERVER['REQUEST_METHOD']);

if ($metodo === "GET") {

    $sql = $pdo->query("SELECT * FROM pessoa");

    if ($sql->rowCount() > 0) {

        $dados = $sql->fetchAll(PDO::FETCH_ASSOC);

        foreach ($dados as $linha) {

            $array['result'][] = [
                "id" => $linha['idPessoa'],
                "nome" => $linha['nome'],
                "tipoEndereco" => $linha['tipoEndereco'],
                "logradouro" => $linha['logradouro'],
                "numero" => $linha['numero'],
                "complemento" => $linha['complemento'],
                "cidade" => $linha['cidade'],
                "estado" => $linha['estado'],
                "cep" => $linha['cep'],
                "bairro" => $linha['bairro'],
            ];
        }
    } else {
        $array['error'] = 'Erro: Não há pessoas cadastradas';
    }
} else {
    $array['error'] = "Erro: Ação inválida - método permitido apenas get";
}

require('./return.php');

?>