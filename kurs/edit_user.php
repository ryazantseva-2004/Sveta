<?php
require('db.php');
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $editUserId = $_POST['edit_user_id'];
    $newUsername = $_POST['new_username'];
    $newPassword = password_hash($_POST['new_password'], PASSWORD_DEFAULT);
    if ($dbreg->query("UPDATE users SET username='$newUsername', password='$newPassword' WHERE id=$editUserId")) 
    {
        $userId=$_SESSION['user_id'];
        $role=$dbreg->query("SELECT role FROM users WHERE id=$userId");
        $userRole=$role->fetch_assoc()['role'];
        if ($userRole =='admin') 
        {
            header("Location: ak.php"); 
            exit();
        }
        else
        {
            header("Location: reg_autor.html");
            exit();
        }
    } 
    else 
    {
        echo "При обновлении данных возникла ошибка: " . $dbreg->error;
    }
} 
else 
{
    echo "Некорректный запрос";
}
$dbreg->close();
?>