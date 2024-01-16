<?php
session_start();
require('db.php');
if (!isset($_SESSION['user_id'])) 
{
    header("Location: reg_autor.html");
    exit();
}
$user_id = $_SESSION['user_id'];
$role = $dbreg->query("SELECT role FROM users WHERE id=$user_id");
if ($role->num_rows > 0) {
    $user_role = $role->fetch_assoc()['role'];
    if ($user_role == 'admin') 
    {
        $users = $dbreg->query("SELECT id, username FROM users");
        if ($users->num_rows > 0) 
        {
            echo "<div class='style'>";
            echo "<h3>Пульт управления аккаунтами:</h3>";
            echo "<div class='flex'><table>";
            echo "<tr> <td>ID</td>  <td>Имя пользователя</td></tr>"; 
            while ($eachUser = $users->fetch_assoc()) 
            {
                echo "<tr><td>".$eachUser['id'] . "</td><td>" . $eachUser['username'] . "</td>   <td><button onclick='editUserData(" . $eachUser['id'] . ")'>Изменить</button></td>     <td><button onclick='delete_data(" . $eachUser['id'] . ")'>Удалить</button></td>";
            }
            echo "</table></div>";
            echo "<button onclick='add_user()'>Добавить пользователя</button> ";
            echo "</div>";
        } 
        else 
        {
            echo "Зарегистрированных пользователей еще нет.";
        }
    }
    $result = $dbreg->query("SELECT * FROM users WHERE id=$user_id");
    if ($result->num_rows > 0) 
    {
        $user = $result->fetch_assoc();
        echo "<h2> </h2>";
    } 
    else 
    {
        echo "Пользователь не найден!";
    }
} 
else 
{
    header("Location: reg_autor.html");
    exit();
}
$dbreg->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Личный кабинет</title>
    <style>
        body { 
            
            font-family: 'Arial', sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
            padding: 0;
            background: url('f.jpg') ;
            background-size: cover; 
            background-position: center;

        }

        h2 {
            text-align: center;
            color: #9013fe;
        }

        form {
            background-color: rgba(255, 255, 255, 0.8);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
            max-width: 400px;
            width: 100%;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #333;
        }

        input {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
            box-sizing: border-box;
        }

        button {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
            box-sizing: border-box;
        }

        button[type="submit"] {
            background-color: #9013fe;
            color: white;
            cursor: pointer;
        }

        button[type="submit"]:hover {
            background-color: #6a01c6;
        }
    </style>
</head>
<body>
        <form action="edit_user.php" method="post">
        <p><h2><?php echo $user['username']; ?></h2></p>
        <p>ID аккаунта: <?php echo $user['id']; ?></p>
        <p><h3>Изменить данные аккаунта:</h3></p>
            <input type="hidden" name="edit_user_id" id="edit_user_id" value="<?php echo $user['id'];?>">
            <label for="new_username">Новое имя пользователя:</label>
            <input type="text" id="new_username" name="new_username" value="<?php echo $user['username'];?>" required>
            <label for="new_password">Новый пароль:</label>
            <input type="password" id="new_password" name="new_password" required>
            <button type="submit">Сохранить изменения</button><br><br>
            <button onclick="delete_data(<?php echo $user['id']?>)">Удалить аккаунт </button>
            <br>
            <a href="login_out.php">Выйти из аккаунта</a> 
       <p> <a href="handmade.php">Назад на главную страницу</a> </p>
        </form>


    <script src="admin.js">
    </script>
</body>
</html>