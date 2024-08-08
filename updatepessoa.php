<?php

require ('./conexao.php');

$metodo = strtoupper($_SERVER['REQUEST_METHOD']);

if ($metodo === 'PUT') {

    parse_str(file_get_contents("php://input"), $put);

    $id = $put['id'] ?? null;
    $nome = $put['nome'] ?? null;
    $tipoEndereco = $put['tipoEndereco'] ?? null;
    $logradouro = $put['logradouro'] ?? null;
    $numero = $put['numero'] ?? null;
    $complemento = $put['complemento'] ?? null;
    $cidade = $put['cidade'] ?? null;
    $estado = $put['estado'] ?? null;
    $cep = $put['cep'] ?? null;
    $bairro = $put['bairro'] ?? null;

    $id = filter_var($id,FILTER_VALIDATE_INT);
    $nome = filter_var($nome,FILTER_SANITIZE_FULL_SPECIAL_CHARS); 
    $tipoEndereco = filter_var($tipoEndereco,FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $logradouro = filter_var($logradouro,FILTER_SANITIZE_FULL_SPECIAL_CHARS);  
    $numero = filter_var($numero,FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $complemento = filter_var($complemento,FILTER_SANITIZE_FULL_SPECIAL_CHARS);  
    $cidade = filter_var($cidade,FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $estado = filter_var($estado,FILTER_SANITIZE_FULL_SPECIAL_CHARS);  
    $cep = filter_var($cep,FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $bairro = filter_var($bairro,FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    if ($id && $nome && $tipoEndereco && $logradouro && $numero && $complemento && $cidade && $estado && $cep && $bairro) {

        $sql = $pdo->prepare("SELECT * FROM pessoa WHERE idPessoa=:id");
        $sql->bindValue(":id", $id);        
        $sql->execute();

        if ($sql->rowCount()>0) {
            
            $sql = $pdo->prepare("UPDATE pessoa SET nome=:nome,  tipoEndereco=:tipoEndereco, logradouro=:logradouro, numero=:numero, complemento=:complemento, cidade=:cidade, estado=:estado, cep=:cep, bairro=:bairro WHERE idPessoa=:id");

            

        $sql->bindValue(":id", $id);        
        $sql->bindValue(":nome",$nome);
        $sql->bindValue(":tipoEndereco",$tipoEndereco);
        $sql->bindValue(":logradouro",$logradouro);
        $sql->bindValue(":numero",$numero);
        $sql->bindValue(":complemento",$complemento);
        $sql->bindValue(":cidade",$cidade);
        $sql->bindValue(":estado",$estado);
        $sql->bindValue(":cep",$cep);
        $sql->bindValue(":bairro",$bairro);
        $sql->execute();

        $array['result']= [
            
            "id" => $id,
            "nome" => $nome,
            "tipoEndereco" => $tipoEndereco,
            "logradouro" => $logradouro,
            "numero" => $numero,
            "complemento" => $complemento,
            "cidade" => $cidade,
            "estado" => $estado,
            "cep" => $cep,
            "bairro" => $bairro,
        ];


        } else {

            $array['error'] = 'Erro: id inexistente!';
        }

    } else {
        $array['error'] = "Erro: Id nulo ou inválido!";

    }
} else {

    $array['error'] = "Erro: Ação inválida - método permitido apenas PUT";
}

require ('./return.php');


?>