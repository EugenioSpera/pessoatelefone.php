<?php
 
require('./conexao.php');
 
$metodo= strtoupper($_SERVER['REQUEST_METHOD']);
 
if ($metodo==='GET') {
 
    $_GET['id']=2;
 
    $id=filter_input(INPUT_GET,'id',FILTER_VALIDATE_INT);
 
    if ($id) {
        $sql=$pdo->prepare("SELECT pessoa.idPessoa, pessoa.nome, pessoa.tipoEndereco, pessoa.logradouro, pessoa.numero as numeroEndereco, pessoa.complemento, pessoa.cidade, pessoa.estado, pessoa.cep, pessoa.bairro, telefone.DDD, telefone.DDI, telefone.numero as numeroTelefone from pessoa inner join telefone on pessoa.idPessoa= :id");
        $sql->bindValue(":id",$id);
        $sql->execute();
 
        if ($sql->rowCount()>0) {
 
            $dadoDaPessoaTelefone=$sql->fetch(PDO::FETCH_ASSOC);
   
                $array['result'] = [
                    'id'=>$dadoDaPessoaTelefone['idPessoa'],
                    'nome'=>$dadoDaPessoaTelefone['nome'],
                    'tipoEndereco'=>$dadoDaPessoaTelefone['tipoEndereco'],
                    'logradouro'=>$dadoDaPessoaTelefone['logradouro'],
                    'numeroEndereco'=>$dadoDaPessoaTelefone['numeroEndereco'],
                    'complemento'=>$dadoDaPessoaTelefone['complemento'],
                    'cidade'=>$dadoDaPessoaTelefone['cidade'],
                    'estado'=>$dadoDaPessoaTelefone['estado'],
                    'cep'=>$dadoDaPessoaTelefone['cep'],
                    'bairro'=>$dadoDaPessoaTelefone['bairro'],                    
                    'DDD'=>$dadoDaPessoaTelefone['DDD'],
                    'DDI'=>$dadoDaPessoaTelefone['DDI'],
                    'numeroTelefone'=>$dadoDaPessoaTelefone['numeroTelefone'],
                     
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