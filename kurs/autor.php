<?php
session_start();
require('db.php');
if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{
    $loginUsername = $_POST['loginUsername'];
    $select = $dbreg->query("SELECT * FROM users WHERE username='$loginUsername'");
    if ($select->num_rows > 0)
    {
        $array = $select->fetch_assoc();
        if (password_verify($_POST['Lopassword'], $array['password'])) 
        {
            $_SESSION['user_id'] = $array['id'];
            header("Location: handmade.php");
        } 
        else 
        {
            echo "Неверный пароль!";
        }
    } 
    else 
    {
        echo "Ошибка: такого пользователя нет";
    }
}
$dbreg->close();
?>
