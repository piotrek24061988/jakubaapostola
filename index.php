<!DOCTYPE HTML>
<html lang="pl">

    <head>
        <?php include 'template/header.php'; ?>
    </head>

    <body>
        <?php include 'template/menu.php'; ?>

        <main class="container">

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
                                echo '<div class="text-center text-wrap text-break my-5">';
                                
                                    echo '<div class="my-img mb-5">';
                                        echo '<h3 class="font-weight-bold">'.$wiersz['tytul'].'<h3>';
                                        echo '<a class="nodecoration" href="szczegolyAktualnosci?id='.$wiersz['id'].'">'.'<img src="media/'.$wiersz['zdjecie1'].'" alt="'.$wiersz['tytul'].'" class="img-fluid"/></a>';
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

            <div class="text-center text-wrap text-break my-5">
                                
                <div class="my-txt mb-5">
                    <h3 class="font-weight-bold">Parafia pw. św. Jakuba Apostoła w Wielowiczu</h3><br>

                    <h3 class="font-weight-bold">Wielowicz 13, 89-412 Sośno</h3><br>
                        
                    <h4 class="font-weight-bold">proboszcz: ks. Ryszard Szymkowiak</h4>

                    <hr size="2" color="black">
 
                    <h4 class="font-weight-bold">Msze święte:</h4>

                    <h5 class="font-weight-bold">
                    w niedzielę: 7.30 (latem), 8.00 (zimą), 9.30, 11.00<br><br>

                    w święta zniesione: 9.30, 17.00 (zimą), 18.00 (latem)<br><br>

                    w dni powszednie: 17.00 (zimą), 18.00 (latem)<br>
                    </h5>
                    
                </div>
                                
            </div>

        </main>

        <?php include 'template/footer.php'; ?>
    </body>

</html>