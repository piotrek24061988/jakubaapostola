<!DOCTYPE HTML>
<html lang="pl">

    <head>
        <?php include 'template/header.php'; ?>
    </head>

    <body>
        <?php include 'template/menu.php'; ?>

        <main class="container">
        <h1>Parafia Rzymskokatolicka świętego Jakuba Apostoła w Wielowiczu</h1>

            <?php
                @session_start();

                require_once "template/connect.php";
                mysqli_report(MYSQLI_REPORT_STRICT);
                try
                {
                    $polaczenie = new mysqli($host, $db_user, $db_password, $db_name);
                    if($polaczenie->connect_errno == 0)
                    {
                        $sql = "SELECT * FROM aktualnosci ORDER BY id DESC LIMIT 5";
                        $rezultat = @$polaczenie->query($sql);
                        if(!$rezultat) throw new Exception($polaczenie->error);
                            $counter = 1;
                            while($wiersz = $rezultat->fetch_assoc())
                            {
                                echo '<div class="text-center text-wrap text-break">';
                                    echo '<h2>'.$counter.'</h2>';
                                
                                    echo '<div class="my-img mb-2">';
                                        echo '<h2>'.$wiersz['tytul'].'<h2>';
                                        echo '<h2>'.$wiersz['zdjecie1'].'</h2>';
                                        echo '<img src="media/'.$wiersz['zdjecie1'].'" alt="'.$wiersz['tytul'].'" class="img-fluid"/>';
                                    echo '</div>';
                                
                                    echo '<div class="my-img mb-2">';
                                        if(array_key_exists('tresc', $wiersz) ) {
                                            echo '<h2>'.$wiersz['tresc'].'</h2>';
                                        }
                                        if(array_key_exists('zdjecie2', $wiersz) && array_key_exists('tresc', $wiersz)) {
                                            echo '<h2>'.$wiersz['zdjecie2'].'</h2>';
                                            echo '<img src="media/'.$wiersz['zdjecie2'].'" alt="'.$wiersz['tresc'].'" class="img-fluid"/>';
                                        }
                                    echo '</div>';
                                
                                echo '</div>';
                                
                                $counter++;
                            }

                        $polaczenie->close();
                    }
                }
                catch(Exception $e)
                {
                    echo '<div class="text-danger"><b>Błąd serwera. Nie można nawiązać połączenia z bazą danych</b></div>';
                    exit();
                }
            ?>

        </main>

        <?php include 'template/footer.php'; ?>
    </body>

</html>