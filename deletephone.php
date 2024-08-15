<?php
 
require('./conexao.php');
 
$metodo= strtoupper($_SERVER['REQUEST_METHOD']);
 
if ($metodo==='DELETE') {
 
    parse_str(file_get_contents("php://input"),$delete);
 
    $id = $delete['idTelefone'] ?? null;
 
    //para proteger o id de colocarem letras//
    $id = filter_var($id,FILTER_VALIDATE_INT);
        //código delete
        if ($id) {
            $sql=$pdo->prepare("SELECT * FROM telefone WHERE idTelefone=:idTelefone");
            $sql->bindValue(":idTelefone",$id);
            $sql->execute();
   
            if ($sql->rowCount()>0) {
       
                $sql = $pdo->prepare("DELETE FROM telefone WHERE idTelefone=:idTelefone");
                $sql->bindValue(":idTelefone", $id);
                $sql->execute();
               
                $array['result']='Telefone excluíd0 com sucesso!';
 
        }
        else {
            $array['error'] = "Erro: Id inexistente!";
        }
    } else {
 
        $array['error'] = "Erro: Id Inválido";
    }
 
} else {
    $array['error'] = "Erro: Ação inválida - método permitido apenas DELETE";
}
 
require('./return.php');

?>