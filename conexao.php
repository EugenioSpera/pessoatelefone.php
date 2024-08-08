<?php


//servidor, bd, usuario, senha 

$db_servidor = 'localhost';
$db_database = 'pessoatelefone';
$db_usuario = 'root';
$db_pwd = '';

$pdo = new PDO('mysql:host='.$db_servidor.';dbname='.$db_database,$db_usuario,$db_pwd);
 
 
$array =[
    'error'=>"",
    'result'=>[]
];



?>