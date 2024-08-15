<?php

require ('./conexao.php');

$metodo = strtoupper($_SERVER['REQUEST_METHOD']);

if ($metodo === 'PUT') {

    parse_str(file_get_contents("php://input"), $put);

    $id = $put['id'] ?? null;
    $DDD = $put['DDD'] ?? null;
    $DDI = $put['DDI'] ?? null;
    $numero = $put['numero'] ?? null;
    $idPessoa = $put['idPessoa'] ?? null;
    

    $id = filter_var($id,FILTER_VALIDATE_INT);
    $DDD = filter_var($DDD,FILTER_SANITIZE_FULL_SPECIAL_CHARS); 
    $DDI = filter_var($DDI,FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $numero = filter_var($numero,FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $idPessoa = filter_var($idPessoa,FILTER_SANITIZE_FULL_SPECIAL_CHARS);  
    

    if ($id && $DDD && $DDI && $numero && $idPessoa) {

        $sql = $pdo->prepare("SELECT * FROM telefone WHERE idTelefone=:id");
        $sql->bindValue(":id", $id);        
        $sql->execute();

        if ($sql->rowCount()>0) {
            
            $sql = $pdo->prepare("UPDATE telefone SET DDD=:DDD,  DDI=:DDI, numero=:numero, idPessoa=:idPessoa WHERE idPessoa=:id");

            

        $sql->bindValue(":id", $id);        
        $sql->bindValue(":DDD",$DDD);
        $sql->bindValue(":DDI",$DDI);
        $sql->bindValue(":numero",$numero);
        $sql->bindValue(":idPessoa",$idPessoa);
        $sql->execute();

        $array['result']= [
            
            "id" => $id,
            "DDD" => $DDD,
            "DDI" => $DDI,
            "numero" => $numero,
            "idPessoa" => $idPessoa,
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