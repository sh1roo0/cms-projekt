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
        }
        .dodawanie-box{
            width: 50%;
            height: 600px;
            background-color: gray;
            margin: 100px 0;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }
        .dodawanie-box h1{
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
                <h1>Dodaj Swój artykuł</h1>
            <form action="index.php" method="post">
                <input type="text" name="naglowek" placeholder="Wpisz Naglowek artykulu">
                <input type="text" name="opis" placeholder="Wpisz zawartosc artykulu">
                <input type="text" name="img" placeholder="Wklej link do zdjecia ">
                <input type="submit" name="send" value="Wyslij"> 
           </form>
            </div>
           <?php
           if(!empty($_POST['naglowek']) && !empty($_POST['opis']) && !empty($_POST['img'])){
                 $naglowek = $_POST["naglowek"];
            $opis = $_POST["opis"];
            $img = $_POST["img"];
           }
       

            $query = "INSERT INTO `articles`( `title`, `opis`, `img`) VALUES ('$naglowek','$opis','$img');";
            mysqli_query($polaczenie, $query);

           ?>
        </main>
    </section>
</body>
</html>
<?php 

$polaczenie->close();
?>