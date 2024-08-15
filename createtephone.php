<?php
 
require('./conexao.php');
 
$metodo= strtoupper($_SERVER['REQUEST_METHOD']);
 
if ($metodo==='POST') {
 
    $DDI = filter_input(INPUT_POST,'DDI');
    $DDD = filter_input(INPUT_POST,'DDD'); 
    $numero = filter_input(INPUT_POST,'numero');
    $idPessoa = filter_input(INPUT_POST,'idPessoa');

 
    if ($DDI && $DDD && $numero && $idPessoa) {
 
        $sql=$pdo->prepare("INSERT INTO telefone (DDI,DDD,numero,idPessoa) VALUES (:DDI, :DDD, :numero, :idPessoa)");

        $sql->bindValue(":DDI",$DDI);
        $sql->bindValue(":DDD",$DDD);
        $sql->bindValue(":numero",$numero);
        $sql->bindValue(":idPessoa",$idPessoa);
        $sql->execute();
        $id = $pdo->lastInsertId();

        $array['result'] = [
            "id" => $id,
            "DDI" => $DDI,
            "DDD" => $DDD,
            "numero" => $numero,
            "idPessoa" => $idPessoa,
            
        ];
 
 
    } else {
        $array['error'] = 'Erro: Valores nulos ou inválidos';
    }
 
} else {
    $array['error'] = "Erro: Ação inválida - método permitido apenas POST";
}
 
require('./return.php');


 
?>