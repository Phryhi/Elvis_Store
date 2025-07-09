<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MakeMeElvis.com</title>
</head>
<body>
    <header>
        <h1>MakeMeElvis.com</h1>
        <h3>Delete emails da lista do Elvis!</h3>
    </header>
    <form action="delete.php" method="post">
        <?php
            require 'config.php';

            $email = $_POST['email'];
            $dbc = mysqli_connect($host, $user, $senha_banco, 'elvis_store') 
            or die("Erro ao se conectar com o banco de dados!");

            if(isset($_POST['enviar'])){
                foreach($_POST['select'] as $delete_id){
                    $query = "DELETE FROM email_list WHERE id = $delete_id";
                    $result = mysqli_query($dbc, $query) or die("Erro ao se conectar com o servidor!");
                }
                echo "Email $email deletado do banco de dados.<br/>";
            }

            $query = "SELECT * FROM email_list";
            $result = mysqli_query($dbc, $query);
            while ($row = mysqli_fetch_array($result)){
                echo '<input type="checkbox" name="select[]" value="' . $row['id'] . '">';
                echo $row['nome'] . ' ' . $row['sobrenome'] . ' ' . $row['email'];
                echo '<br/>';
            }

            mysqli_close($dbc);
        ?>
        <input type="submit" name="enviar" value="Deletar">
    </form>
    
</body>
</html>