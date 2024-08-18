<?php
 
require('./conexao.php');
 
$metodo= strtoupper($_SERVER['REQUEST_METHOD']);
 
if ($metodo==='GET') {
 
    $_GET['id']=2;
 
    $id=filter_input(INPUT_GET,'id',FILTER_VALIDATE_INT);
 
    if ($id) {
        $sql=$pdo->prepare("SELECT * FROM telefone WHERE idTelefone=:id");
        $sql->bindValue(":id",$id);
        $sql->execute();
 
        if ($sql->rowCount()>0) {
 
            $dadoDotelefone=$sql->fetch(PDO::FETCH_ASSOC);
   
                $array['result'] = [
                    'id'=>$dadoDotelefone['idTelefone'],
                    'DDD'=>$dadoDotelefone['DDD'],
                    'DDI'=>$dadoDotelefone['DDI'],
                    'numero'=>$dadoDotelefone['numero'],
                    'idPessoa'=>$dadoDotelefone['idPessoa']                    
                ];
            
            
                }
    else {
        $array['error'] = "Erro: Id inexistente!";
    }
    }
    else {
        $array['error'] = "Erro: Número de id não informado ou inválido!";
    }
 
 
 
 
} else {
    $array['error'] = "Erro: Ação inválida - método permitido apenas get";
}
 
require('./return.php');

?>