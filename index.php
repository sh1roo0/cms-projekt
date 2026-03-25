<?php
session_start();
$polaczenie = mysqli_connect('localhost', 'root', '', 'cms');
$zalogowany = isset($_SESSION['zalogowany']) && $_SESSION['zalogowany'] === true;

if (isset($_POST['zmien']) && isset($_POST['kolor'])) {
    $nowy_kolor = $_POST['kolor'];
    $query_update = "UPDATE `nawigacja` SET `bg_color` = '$nowy_kolor' WHERE id = 1";
    mysqli_query($polaczenie, $query_update);
}
if (isset($_POST['zmien']) && isset($_POST['kolorek'])) {
    $nowy_kolor_stopy = $_POST['kolorek'];
    $nowy_tekst_stopy = $_POST['tekscik'];
    $query_update2 = "UPDATE `stopka` SET `tekst`='$nowy_tekst_stopy',`bg_color`='$nowy_kolor_stopy' WHERE id=1;";
    mysqli_query($polaczenie, $query_update2);
}


$query_select = "SELECT bg_color FROM `nawigacja` WHERE id = 1";
$query_select2 = "SELECT bg_color, tekst FROM `stopka` WHERE id = 1";
$wynik_select = mysqli_query($polaczenie, $query_select);
$wynik_select2 = mysqli_query($polaczenie, $query_select2);
$row = mysqli_fetch_assoc($wynik_select);
$row2 = mysqli_fetch_assoc($wynik_select2);
$wybrany_kolor = $row['bg_color'] ?? 'gray';
$wybrany_tekst = $row2['tekst'] ?? 'lorem';

$wybrany_kolor2 = $row2['bg_color'] ?? 'gray';
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Strona główna</title>
    <link rel="stylesheet" href="style.css">
    <style>
     
        aside {
            display: <?php echo $zalogowany ? 'flex' : 'none'; ?> !important;
            flex-direction: column;
            align-items: center;
            width: 200px;
            height: 100vh;
          
            position: absolute;
            color: white;
            left: 0;
            top: 0;
            padding-top: 20px;
            z-index: 100;
        }
        aside a { margin: 10px; text-decoration: none; color: white; font-weight: bold; }
        .nawigacja-box {
            display: none;
            background-color: white;
            padding: 10px;
            border: 1px solid black;
            position: absolute;
            left: 100%;
            top: 50px;
            width: 150px;
            color: black;
        }
        #stopkaBox{
                 display: none;
            background-color: white;
            padding: 10px;
            border: 1px solid black;
            position: absolute;
            left: 100%;
            top: 50px;
            width: 150px;
            color: black;
        }
    </style>
</head>
<body>
    <section class="container">
        <aside>
            <a href="articles.php">Artykuly</a>
            <a href="#" id="nav" onclick='shownav()'>Nawigacja</a>
            <a href="#" onclick='showstopa()'>Stopka</a>
            <a href="">Ustawienia</a>

            <div class="nawigacja-box" id="navBox">
                <p>Zmień kolor tła:</p>
                <form method="post">
                 
                    <input type="color" name="kolor" value="<?php echo $wybrany_kolor; ?>">
                    <input type="submit" name="zmien" value="Zmien kolor">
                </form>
            </div>
                <div class="stopkaBox" id="stopkaBox" onclick='showstopa()'>
                <p>Zmień kolor tłą stopki:</p>
                <form method="post">
                 
                    <input type="color" name="kolorek" value="<?php echo $wybrany_kolor2; ?>">
                    <input type="text" name="tekscik" value="<?php echo $wybrany_tekst?>">
                    <input type="submit" name="zmien" value="Zmien stopke">
                </form>
            </div>
        </aside>

        <div class="header" style="background-color: <?php echo $wybrany_kolor; ?>; ">
            <a href="/">Strona glowna</a>
            <div class="login">
                <?php if($zalogowany): ?>
                    <a href="logout.php">Wyloguj</a>
                <?php else: ?>
                    <a href="zaloguj.php">Zaloguj sie</a>
                <?php endif; ?>
            </div>
        </div>

        <main>
            <div class="article-wrapper">
                <?php
                $query = "SELECT id, title, opis, img FROM articles";
                $wynik = mysqli_query($polaczenie, $query);
                while ($row = mysqli_fetch_assoc($wynik)){
                    echo "<article><img src='".$row['img']."'><br><h1>".$row['title']."</h1><p>".$row['opis']."</p> </article>";
                }
                ?>
            </div>
        </main>
    </section>
    <footer>
        <h1  style=' text-align:center;color: <?php ?>; background-color: <?php echo $wybrany_kolor2; ?>;' ><?php echo $wybrany_tekst ?> </h1>
    </footer>

    <script>
        function shownav() {
            var box = document.getElementById("navBox");
            box.style.display = (box.style.display === "block") ? "none" : "block";
        }

             function showstopa() {
            var box = document.getElementById("stopkaBox");
            box.style.display = (box.style.display === "block") ? "none" : "block";
        }
    </script>
</body>
</html>
<?php mysqli_close($polaczenie); ?>
