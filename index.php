<?php
session_start();
$polaczenie = mysqli_connect('localhost', 'root', '', 'cms');
$zalogowany = isset($_SESSION['zalogowany']) && $_SESSION['zalogowany'] === true;
$isAdmin = isset($_SESSION['Admin']) && $_SESSION['Admin'] === true;
$isPremium = isset($_SESSION['Premium']) && $_SESSION['Premium'] === true;
 
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
if (isset($_POST['zmien_ustawienia'])) {
    $nowy_bgColor = mysqli_real_escape_string($polaczenie, $_POST['BG_kolorek']);
    $nowy_textColor = mysqli_real_escape_string($polaczenie, $_POST['COLOR_tekscik']);
    $nowy_asideColor = mysqli_real_escape_string($polaczenie, $_POST['aside_kolorek']);
    

    $query_update3 = "UPDATE `settings` SET `bgColor`='$nowy_bgColor', `textColor`='$nowy_textColor', `asideColor`='$nowy_asideColor' WHERE id=1";
    mysqli_query($polaczenie, $query_update3);
}

$query_select = "SELECT bg_color FROM `nawigacja` WHERE id = 1";
$query_select2 = "SELECT bg_color, tekst FROM `stopka` WHERE id = 1";
$query_select3 = "SELECT bgColor,textColor,asideColor FROM `settings` WHERE id = 1";

$wynik_select = mysqli_query($polaczenie, $query_select);
$wynik_select2 = mysqli_query($polaczenie, $query_select2);
$wynik_select3 = mysqli_query($polaczenie, $query_select3);
$row = mysqli_fetch_assoc($wynik_select);
$row2 = mysqli_fetch_assoc($wynik_select2);
$row3 = mysqli_fetch_assoc($wynik_select3);
$wybrany_kolor = $row['bg_color'] ?? 'gray';
$wybrany_tekst = $row2['tekst'] ?? 'lorem';
$wybrany_tekst = $row2['tekst'] ?? 'lorem';

$wybrany_bgColor = $row3['bgColor'] ?? 'white';
$wybrany_textColor = $row3['textColor'] ?? 'white';
$wybrany_asideColor = $row3['asideColor'] ?? 'gray';


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
            display: <?php echo $isAdmin ? 'flex' : 'none'; ?> !important;
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
                #ustawieniaBox{
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
        *{
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}
.container{
    display: flex;
    flex-direction: column;
    height: 100%;
}
.header{
    width: 100%;    
    display: flex;
    justify-content: center;
    background-color: gray;
    padding: 20px;
}
.header a {
    margin: 0 30px;
    text-decoration: none;
    font-size: 25px;
    color: black;
}
main{
    width: 100%;
    display: flex;
    flex-wrap: wrap;
}
article{
    width: 20%;
    height: 392px;
    background-color: aqua;
    margin: 30px 60px;
    border-radius: 10px;
     display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
}
#true{
    display: <?php echo $isPremium,$isAdmin ? 'flex' : 'none'; ?> !important;
}
#false{
    display: flex;
}
.footer{
    width: 100%;
    display: flex;
    background-color: gray;
    justify-content: center;
    padding: 20px;
   
}
.nav{
    cursor: pointer;
}
.article-wrapper{
    width: 100%;
    display: flex;
    flex-wrap: wrap;
    justify-content: center ;
    overflow: auto;
    height: 70vh;
}
article img{
    width: 80%;
    border-radius: 10px;
}

aside a {
    text-decoration: none;
    color: white;
    font-size: 30px;
    margin: 10px 0;
}
#login{
    color: white;
}
.nawigacja-box{
    width: 80%;
    height: 100px;
    background-color: rgb(66, 66, 66);
    display: none;
    justify-content: center;
    color: white;
    font-size: 25px;
    flex-direction: column;
    align-items: center;
}
.nawigacja-box .visible{
display: flex;
}
.nawigacja-box form{
    display: flex;
    flex-direction: column;
}



    </style>
</head>
<body style="color: <?php echo $wybrany_textColor; ?>; background-color: <?php echo $wybrany_bgColor; ?>; ">
    <section class="container">
        <aside style="background-color: <?php echo $wybrany_asideColor; ?>" >
            <a href="articles.php">Artykuly</a>
            <a href="#" id="nav" onclick='shownav()'>Nawigacja</a>
            <a href="#" onclick='showstopa()'>Stopka</a>
            <a href="#" onclick='showustawienia()'>Ustawienia</a>

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
            </div>
                <div class="ustawieniaBox" id="ustawieniaBox" >
                <p>Zmień ustawienia strony</p>
                <br>
                <form method="post">
                 <p>Zmień kolor tła strony:</p>
                    <input type="color" name="BG_kolorek" value="<?php echo $wybrany_bgColor; ?>">
                    <p>Zmień kolor czcionki:</p>
                    <input type="color7" name="COLOR_tekscik" value="<?php echo $wybrany_textColor; ?>">
                    <p>Zmień kolor boku:</p>
                    <input type="color" name="aside_kolorek" value="<?php echo $wybrany_asideColor; ?>">
                    <input type="submit" name="zmien_ustawienia" value="Zmien ustawienia">

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
                $query = "SELECT id, title, opis, img , is_true FROM articles";
                $wynik = mysqli_query($polaczenie, $query);
                while ($row = mysqli_fetch_assoc($wynik)){
                    echo "<article id=".$row['is_true']."><img src='".$row['img']."'><br><h1>".$row['title']."</h1><p>".$row['opis']."</p> </article>";
                }
                ?>
            </div>
        </main>
    </section>
    <footer>
        <h1  style=' text-align:center;color: <?php ?>; background-color: <?php echo $wybrany_kolor2; ?>;' ><?php echo $wybrany_tekst; ?> </h1>
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
             function showustawienia() {
            var box = document.getElementById("ustawieniaBox");
            box.style.display = (box.style.display === "block") ? "none" : "block";
        }


    </script>
</body>
</html>
<?php mysqli_close($polaczenie); ?>
