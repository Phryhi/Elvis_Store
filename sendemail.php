<?php
    require 'config.php';

    if (isset($_POST['enviar'])){
        $elvismail = "elvinhooo@makemeelvis.com";
        $assunto = $_POST['assunto'];
        $conteudo = $_POST['conteudo'];
        $output_form = false;

        if(!empty($assunto) && !empty($conteudo)){
            $dbc = mysqli_connect($host, $user, $senha_banco, 'elvis_store') 
            or die('Erro ao se conectar com o banco de dados!');
            $query = "SELECT * FROM email_list";
            $result = mysqli_query($dbc ,$query) or die("Erro ao se conectar com o servidor!");

            while($row = mysqli_fetch_array($result)){
                $nome = $row['nome'] . ' ' . $row['sobrenome'];
                $msg = "Querido(a) $nome, " . "<br>" . $conteudo;
                $to = $row['email'];
                mail($to, $assunto, $msg);

                echo "Email enviado para: $nome" . '<br>';
            }

            mysqli_close($dbc);
        }
        else if(empty($assunto) && !empty($conteudo)){
            echo "Você se esqueceu do assunto...";
            $output_form = true;
        }
        else if(!empty($assunto) && empty($conteudo)){
            echo "Você se esqueceu do conteúdo...";
            $output_form = true;
        }
        else if(empty($assunto) && empty($conteudo)){
            echo "Você se esqueceu do assunto e do conteúdo do email...";
            $output_form = true;
        }
    }
    else{
        $output_form = true;
    }
    if ($output_form){
?>
<header>
    <h1>MakeMeElvis.com</h1>
    <h3>Apenas para administradores!</h3>
    <h4>Envie emails automaticamente para todos os seus clientes!</h4>
    </header>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <label for="assunto">Assunto: </label><br>
    <input type="text" name="assunto" value="<?php echo $assunto; ?>"><br>
    <label for="conteudo">Conteúdo: </label><br>
    <textarea rows="6" cols="40" name="conteudo"><?php echo $conteudo; ?></textarea><br>
    <input type="submit" name="enviar" value="Enviar">
</form>
<?php
    }
?>