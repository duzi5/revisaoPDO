<?php

$dsn = 'mysql:host=localhost;db_name=novo_banco';
$usuario = 'root';
$senha = 'root';

try{
    $conexao = new PDO($dsn, $usuario, $senha);
    
    $query = 'use novo_banco';
    $stmt = $conexao->query($query);
        
    $query = ' select * from tb_usuarios';
    $stmt = $conexao->query($query);
    $lista =  $stmt->fetchAll(PDO::FETCH_OBJ);
    print'<pre>'; 
    print_r($lista);
    print'</pre>'; 
        
    $query = 'select * from tb_usuarios where id = 2';
    $stmt = $conexao->query($query);    
    $usuario = $stmt->fetch(PDO::FETCH_OBJ);
    print $usuario->senha;

}catch(PDOException $e){
    if($e->getCode() == 1045){
        print "<h1>Senha do banco de dados é inválida !!</h1>";
    }elseif($e->getCode()=='3D000'){
        print "<h1>Banco de dados não foi selecionado!!!</h1>";      
    }else{
        print "<h1> Erro encontrado </h1> <br>";
        print $e->getMessage() . '<br>';
        print $e->getCode();
    }
}