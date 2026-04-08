<?php
session_start(); 
$polaczenie = mysqli_connect('localhost','root','','cms');
$zalogowany = isset($_SESSION['zalogowany']) && $_SESSION['zalogowany'] === true;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Strona główna</title>
    <link rel="stylesheet" href="style.css">
    <style>
       
        aside {
            display: <?php echo $zalogowany ? 'flex' : 'none'; ?> !important;
            <?php if(!$zalogowany): ?>
                display: none !important; 
            <?php endif; ?>
        }
        main{
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction:column;
        }
        .dodawanie-box{
            width: 50%;
            height: 400px;
            background-color: gray;
            margin: 40px 0;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }
        .dodawanie-box h1{
            color: white;
            font-size: 60px;
        }
         .usuwanie-box h1{
            color: white;
            font-size: 60px;
        }
        form{
            display: flex;
            width: 80%;
            flex-direction: column;
        }
        form input{
            height: 40px;
            border-radius: 10px;
            border: none;
            margin: 10px;
            font-size:20px;
            font-weight: bold;
        }
        .usuwanie-box{
            width: 50%;
            height: 400px;
            background-color: gray;
            margin: 40px 0;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }
        p{
            color:white;
            text-align:center;
            font: 20px bold;
        }
    </style>
</head>
<body>
    <section class="container">
     
        <aside style="display: <?php echo $zalogowany ? 'flex' : 'none'; ?> !important; flex-direction: column; align-items: center; width: 10%; height: 100vh; background-color: gray; position: absolute;">
            <a href="">Artykuly</a>
            <a href="">Nawigacja</a>
            <a href="">Stopka</a>
            <a href="">Ustawienia</a>
        </aside>

        <div class="header">
            <a href="index.php">Strona glowna</a>
            <a href="">cos</a>
            <a href="">cos</a>
            <a href="">cos</a>
            <div class="login">
                <?php if($zalogowany): ?>
                    <a href="logout.php" id="login">Wyloguj</a>
                <?php else: ?>
                    <a href="zaloguj.php" id="login">Zaloguj sie</a>
                <?php endif; ?>
            </div>
        </div>
        
        <main>
            <div class="dodawanie-box">
                <h1>Zarejestruj się</h1>
            <form  method="POST">
                <input type="text" name="name" placeholder="Wpisz Imię ">
                <input type="text" name="surname" placeholder="Wpisz Nazwisko ">
                <input type="text" name="login" placeholder="Wpisz login ">
                <input type="text" name="haslo" placeholder="Wpisz haslo ">
                <input type="text" name="mail" placeholder="Wpisz Email ">
                <input type="submit" name="send" value="Wyslij"> 
           </form>
            </div>

            <div class="usuwanie-box">
                <h1>Usuń  artykuł</h1>
            <form  method="POST">
                
                <input type="number" name="usun" placeholder="Podaj id artykułu który chcesz usunąć ">
                <input type="submit" name="send2" value="Wyslij"> 
           </form>
                <!-- 
           
               <form  method="POST">
                
                <input type="text" name="title" placeholder="Zmień tytuł: ">
                <input type="text" name="desc" placeholder="Zmień opis: ">
                <input type="text" name="image" placeholder="Zmień zdjecie: ">
                <input type="number" name="id" placeholder="JAkie id chcesz zmienić: ">
                <input type="submit" name="send2" value="Wyslij"> 
           </form>
           
                -->
 


            </div>
           <?php
            $check = $_POST['premium'];
            echo($check);
           if(!empty($_POST['naglowek']) && !empty($_POST['opis']) && !empty($_POST['img']) && isset($_POST['send']) && isset($_POST['premium'])){
            
                 $naglowek = $_POST["naglowek"];
            $opis = $_POST["opis"];
            $img = $_POST["img"];
                    $check = $_POST['premium'];
                    if($check == on){
                        $checked = 'true';
                    }else{
                        $checked = 'false';
                    }
            $query = "INSERT INTO articles VALUES (NULL,'$naglowek','$opis','$img','$checked');";
            mysqli_query($polaczenie, $query);
           }

           if(!empty($_POST['usun'])  && isset($_POST['send2'])){
               
            $usun = $_POST["usun"];

           $query2 = "DELETE FROM `articles` WHERE id = $usun;";
            mysqli_query($polaczenie, $query2);
           }

           
        //           if(!empty($_POST['usun'])  && isset($_POST['send2'])){
               
        //                  $title = $_POST["title"];
        //     $desc = $_POST["desc"];
        //     $image = $_POST["image"];
        //     $id = $_POST['id']

        //    $query3 = "UPDATE `articles` SET ,`title`='$title',`opis`='$desc',`img`='$image' WHERE id= $id;";
        //     mysqli_query($polaczenie, $query3);
        //    }
       

           

           ?>
        </main>
    </section>
</body>
</html>
<?php 

$polaczenie->close();
?>