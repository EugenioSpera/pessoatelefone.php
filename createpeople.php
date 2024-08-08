<?php
 
require('./conexao.php');
 
$metodo= strtoupper($_SERVER['REQUEST_METHOD']);
 
if ($metodo==='POST') {
 
    $nome = filter_input(INPUT_POST,'nome');
    $tipoEndereco = filter_input(INPUT_POST,'tipoEndereco'); 
    $logradouro = filter_input(INPUT_POST,'logradouro');
    $numero = filter_input(INPUT_POST,'numero');
    $complemento = filter_input(INPUT_POST,'complemento');
    $cidade = filter_input(INPUT_POST,'cidade'); 
    $estado = filter_input(INPUT_POST,'estado');
    $cep = filter_input(INPUT_POST,'cep'); 
    $bairro = filter_input(INPUT_POST,'bairro');
 
    if ($nome && $tipoEndereco && $logradouro && $numero && $complemento && $cidade && $estado && $cep && $bairro) {
 
        $sql=$pdo->prepare("INSERT INTO pessoa (nome,tipoEndereco,logradouro,numero,complemento,cidade,estado,cep,bairro) VALUES (:nome, :tipoEndereco, :logradouro, :numero, :complemento, :cidade, :estado, :cep, :bairro)");

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
        $id = $pdo->lastInsertId();

        $array['result'] = [
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
        $array['error'] = 'Erro: Valores nulos ou inválidos';
    }
 
} else {
    $array['error'] = "Erro: Ação inválida - método permitido apenas POST";
}
 
require('./return.php');


 
?>