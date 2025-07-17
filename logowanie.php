<?php
    @session_start();

    if(isset($_SESSION['user']))
    {
        header('Location: domowa');
    }
?>

<!DOCTYPE HTML>
<html lang="pl">

    <head>
    <?php include 'template/header.php'; ?>
</head>

    <body>
    
        <?php include 'template/menu.php'; ?>

        <main class="container">
            
            <div class="mt-5 content text-center">
<?php

                if(isset($_SESSION['blad']))
                {
                    echo $_SESSION['blad'];
                    unset($_SESSION['blad']);
                }
?>
                <h3 class="font-weight-bold mb-5">Logowanie:</h3>
                <form action="zaloguj.php" method="post" class="font-weight-bold">
                    <b>Login:</b></br> <input type="text" name="login" class="mb-2"/> </br> 
                    <b>Hasło:</b></br> <input type="password" name="haslo" class="mb-2"/> </br> 
                    <input type="submit" value="Zaloguj się" class="mt-1 mb-1 btn btn-light font-weight-bold"/>
                </form>
            </div>
        </main>

        <?php include 'template/footer.php'; ?>
    </body>
