<?php
    require 'config.php';

    $nomecompleto = $_POST['nome'] . ' ' . $_POST['sobrenome'];
    $nome = $_POST['nome'];
    $sobrenome = $_POST['sobrenome'];
    $email = $_POST['email'];

    echo $nomecompleto . ' seu formulário foi enviado com sucesso<br>';
    echo 'Atente-se ao seu e-mail, você receberá as melhores ofertas do Elvis!';

    $dbc = mysqli_connect($host, $user, $senha_banco, 'elvis_store') 
    or die('Erro ao se conectar com o banco de dados!');
    $query = "INSERT INTO email_list (nome, sobrenome, email)" . 
    "VALUES ('$nome', '$sobrenome', '$email')";
    $result = mysqli_query($dbc, $query) or die('Erro ao se conectar com o servidor mysql!');
    mysqli_close($dbc);
?>