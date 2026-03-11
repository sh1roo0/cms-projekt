<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        *{
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}
.container{
    width: 100%;
    background-color: gray;
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
}
form{
    width: 30%;
    height: 600px;
    background-color: white;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
}
input{
    width: 80%;
    height: 35px;
    margin: 10px 0;
}


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

    
 <?php
    $users =  array(
        array("User" => "login1" , "Password" => "1234"),
        array("User" => "login2" , "Password" => "1234"),
        array("User" => "login3" , "Password" => "1234"),
        array("User" => "login4" , "Password" => "1234"),
        array("User" => "login5" , "Password" => "1234")
    );

    $login = isset($_POST['login']);
    $haslo = isset($_POST['haslo']);

   
   
    


    

    

    
      $islogged = false;  

    
     foreach($users as $u){
    if($login == $u["User"] && $haslo == $u["Password"] ){
        $islogged = true;
        break;
    }
        
    }
    if($islogged ==true){
        header("Location: index.php");
    }
    

   
    ?> 
</body>
</html>