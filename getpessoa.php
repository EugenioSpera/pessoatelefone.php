<?php
 
require('./conexao.php');
 
$metodo= strtoupper($_SERVER['REQUEST_METHOD']);
 
if ($metodo==='GET') {
 
    $_GET['id']=2;
 
    $id=filter_input(INPUT_GET,'id',FILTER_VALIDATE_INT);
 
    if ($id) {
        $sql=$pdo->prepare("SELECT * FROM pessoa WHERE idPessoa=:id");
        $sql->bindValue(":id",$id);
        $sql->execute();
 
        if ($sql->rowCount()>0) {
 
            $dadoDaPessoa=$sql->fetch(PDO::FETCH_ASSOC);
   
                $array['result'] = [
                    'id'=>$dadoDaPessoa['idPessoa'],
                    'nome'=>$dadoDaPessoa['nome'],
                    'tipoEndereco'=>$dadoDaPessoa['tipoEndereco'],
                    'logradouro'=>$dadoDaPessoa['logradouro'],
                    'numero'=>$dadoDaPessoa['numero'],
                    'complemento'=>$dadoDaPessoa['complemento'],
                    'cidade'=>$dadoDaPessoa['cidade'],
                    'estado'=>$dadoDaPessoa['estado'],
                    'cep'=>$dadoDaPessoa['cep'],
                    'bairro'=>$dadoDaPessoa['bairro']
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