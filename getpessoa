<?php
 
require('./config.php');
 
$metodo= strtoupper($_SERVER['REQUEST_METHOD']);
 
if ($metodo==='GET') {
 
    $_GET['id']=2;
 
    $id=filter_input(INPUT_GET,'id',FILTER_VALIDATE_INT);
 
    if ($id) {
        $sql=$pdo->prepare("SELECT * FROM lembrete WHERE idLembrete=:id");
        $sql->bindValue(":id",$id);
        $sql->execute();
 
        if ($sql->rowCount()>0) {
 
            $dadoDoLembrete=$sql->fetch(PDO::FETCH_ASSOC);
   
                $array['result'] = [
                    'id'=>$dadoDoLembrete['idLembrete'],
                    'titulo'=>$dadoDoLembrete['tituloLembrete'],
                    'corpo'=>$dadoDoLembrete['corpoLembrete']
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