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
    </style>
</head>
<body>
    <section class="container">
     
        <aside style="display: <?php echo $zalogowany ? 'flex' : 'none'; ?> !important; flex-direction: column; align-items: center; width: 10%; height: 100vh; background-color: gray; position: absolute;">
            <a href="articles.php">Artykuly</a>
            <a href="">Nawigacja</a>
            <a href="">Stopka</a>
            <a href="">Ustawienia</a>
        </aside>

        <div class="header">
            <a href="/">Strona glowna</a>
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
            <div class="article-wrapper">
                <!-- 
            
              <article> <img src="https://picsum.photos/200/140" alt=""> <h1>fajny artykul1</h1> </article>
                <article> <img src="https://picsum.photos/200/140" alt=""> <h1>fajny artykul1</h1> </article>
            
            
                -->
              <?php 
              $query = "SELECT articles.id, articles.title,articles.opis,articles.img FROM articles;";
              $wynik = mysqli_query($polaczenie, $query);

              while ($row = $wynik-> fetch_assoc()){
                echo "<article><img src=".$row['img']." > <br> <h1>".$row['title']."</h1><br> <p>".$row['opis']."</p></article>";
              }
              
              
              ?>
            </div>
        </main>
    </section>
</body>
</html>
<?php 

$polaczenie->close();
?>