<?php
require('db.php');
$username = $_POST['username'];
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $select = $dbreg->query("SELECT id FROM users WHERE username='$username'");
    if ($select->num_rows > 0)
    {
        echo "Такой пользователь уже существует!";
    }
    else
    {
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        if ($dbreg->query("INSERT INTO users (username, password, role) VALUES ('$username', '$password', 'user')")) 
        {
            
            header("Location: reg_autor.html");
        }
        else 
        {
            echo "Ошибка: " . $dbreg->error;
        }
    }
}
$dbreg->close();
?>