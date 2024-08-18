<?php

require('./conexao.php');

$metodo = strtoupper($_SERVER['REQUEST_METHOD']);

if ($metodo === 'GET') {

    $_GET['id'] = 2;

    $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

    if ($id) {
        $sql = $pdo->prepare("SELECT pessoa.idPessoa, pessoa.nome, pessoa.tipoEndereco, pessoa.logradouro, pessoa.numero as numeroEndereco, pessoa.complemento, pessoa.cidade, pessoa.estado, pessoa.cep, pessoa.bairro, telefone.DDD, telefone.DDI, telefone.numero as numeroTelefone from pessoa LEFT join telefone on pessoa.idPessoa = telefone.idPessoa WHERE pessoa.idPessoa = :id");
        $sql->bindValue(":id", $id);
        $sql->execute();

        if ($sql->rowCount() > 0) {

            $dados = $sql->fetch(PDO::FETCH_ASSOC);

            $array['result'] = [
                'id' => $dados['idPessoa'],
                'nome' => $dados['nome'],
                'tipoEndereco' => $dados['tipoEndereco'],
                'logradouro' => $dados['logradouro'],
                'numeroEndereco' => $dados['numeroEndereco'],
                'complemento' => $dados['complemento'],
                'cidade' => $dados['cidade'],
                'estado' => $dados['estado'],
                'cep' => $dados['cep'],
                'bairro' => $dados['bairro'],
                'DDD' => $dados['DDD'],
                'DDI' => $dados['DDI'],
                'numeroTelefone' => $dados['numeroTelefone'],
            ];

            foreach ($dados as $row) {
                if ($row['numeroTelefone'] !== null) {
                    $pessoa['telefones'][] = [
                        'DDD' => $row['DDD'],
                        'DDI' => $row['DDI'],
                        'numeroTelefone' => $row['numeroTelefone']
                    ];
                }
            }

            $array['result'] = $pessoa;
        } else {
            $array['error'] = "Erro: Id inexistente!";
        }
    } else {
        $array['error'] = "Erro: Número de id não informado ou inválido!";
    }
} else {
    $array['error'] = "Erro: Ação inválida - método permitido apenas get";
}

require('./return.php');


?>