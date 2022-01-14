<?php
if(!empty($_POST['user']) && !empty($_POST['password'])) {    
    
    $dsn = 'mysql:host=localhost;db_name=novo_banco';
    $usuario = 'root';
    $senha = 'root';

    try{
        $conexao = new PDO($dsn, $usuario, $senha);
        
        //seleciona o banco
        $query='use novo_banco';
        $conexao->query($query);
        
        //forma uma query e iguala o campo email ao :user e a senha à :senha
        $query = "select * from tb_usuarios where";
        $query .=" email = :user";
        $query .= " and senha = :senha";
        $stmt = $conexao->prepare($query);

        //Bind nos dados amostrados relacionando o que está sendo recebido no formulário
        //com os parâmetros novos recebidos
        $stmt->bindValue(':user', $_POST['user']);
        $stmt->bindValue(':senha', $_POST['password']);
        $stmt->execute();

        //extrai um vetor daquilo que o stmt preparou e iguala a $usuario
        $usuario = $stmt->fetch();

        //exibe a senha do usuário selecionado pela query e preparado pelo stmt
        print '<pre>';
        print ($usuario['senha']);
        print '</pre>';
        
        //falta lógica de validação

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

}

?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="segundo.php" method="post">
        <input type="text" name="user" id="user" placeholder="Usuário">
        <input type="password" name="password" id="password" placeholder="Senha">
        <button type="submit">Entrar</button>
    </form>
</body>
</html>