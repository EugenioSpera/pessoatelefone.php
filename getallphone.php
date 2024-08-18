<?php

require('./conexao.php');

$metodo= strtoupper($_SERVER['REQUEST_METHOD']);

if ($metodo==="GET"){

    $sql=$pdo->query("SELECT * FROM telefone");

    if ($sql->rowCount()>0) {

        $dados=$sql->fetchAll(PDO::FETCH_ASSOC);

        foreach ($dados as $linha) {

            $array['result'] []= [
                "id"=>$linha['idTelefone'],
                "DDI"=>$linha['DDI'],
                "DDD"=>$linha['DDD'],
                "numero"=>$linha['numero'],
                "idPessoa"=>$linha['idPessoa']
            ];
        }


    }else {
        $array['error'] = 'Erro: Não há telefones válidos';
    }

} else{
    $array['error'] = "Erro: Ação inválida - método permitido apenas get";
}

require('./return.php');



?>