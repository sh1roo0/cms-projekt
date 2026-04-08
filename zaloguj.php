<?php
session_start();
$polaczenie = mysqli_connect('localhost','root','','cms');


$users = array(
    array("User" => "login1" , "Password" => "1234", "Rola" => "Admin"),
    array("User" => "login2" , "Password" => "1234","Rola" => "Normal"),
    array("User" => "login3" , "Password" => "1234","Rola" => "Premium"),
);

$islogged = false;


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $login = $_POST['login'] ?? '';
    $haslo = $_POST['haslo'] ?? '';

    foreach($users as $u){
        if($login == $u["User"] && $haslo == $u["Password"]  ){
            if( $u["Rola"] == 'Admin'){
              $Admin = true;   
              $islogged = true;
            }
            if( $u["Rola"] == 'Premium'){
                $Premium = true;
                $islogged = true;
            }
            if($u["Rola"] == 'Normal'){
                $Normal = true;
                $islogged = true;
            }
            
           
            break;
        }

    }

    if($islogged == true){
        if($Admin == true){
            $_SESSION['Admin'] = true; 
            $_SESSION['zalogowany'] = true; 
            header("Location: index.php");
            exit();
        }
        if($Premium == true){
            $_SESSION['Premium'] = true; 
            $_SESSION['zalogowany'] = true; 
            header("Location: index.php");
            exit();
        }
        if($Normal == true){
            $_SESSION['Normal'] = true; 
            $_SESSION['zalogowany'] = true; 
            header("Location: index.php");
            exit();
        }
        $_SESSION['zalogowany'] = true; 
        
 
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logowanie</title>
    <style>
        *{ margin: 0; padding: 0; box-sizing: border-box; }
        .container{ width: 100%; background-color: gray; height: 100vh; display: flex; justify-content: center; align-items: center; }
        form{ width: 30%; height: 600px; background-color: white; display: flex; flex-direction: column; justify-content: center; align-items: center; }
        input{ width: 80%; height: 35px; margin: 10px 0; }
    </style>
</head>
<body>
    <div class="container">
        <form action="zaloguj.php" method="post">
            <h1>Logowanie</h1>
            <label for="login">Login:</label>
            <input type="text" name="login" id="login" placeholder="Wpisz Login:">
            <label for="haslo">Haslo:</label>
            <input type="password" name="haslo" id="haslo" placeholder="Wpisz Haslo:">
            <input type="submit" value="Zaloguj" id="button">
        </form>
    </div>
</body>
</html>
