<?php
	@session_start();

	if(!isset($_SESSION['user']))
	{
		$_SESSION['biezace'] = '<div class="text-danger"><b>nie masz uprawnień do aktualizacji zdjęć</b></div>';
		header('Location: aktualnosci');
		exit();
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
			
			<div class="bg-light mt-1 mb-5 d-flex align-items-center justify-content-center row">
			<?php
				if(isset($_POST['submit']))
				{
					if(!isset($_SESSION['id_aktualnosci']))
					{
						echo '<div class="col-12 text-danger text-center"><b>blad id aktualnosci</b></div>';
					}
					else if (($_POST['title'] == "") || ($_POST['description'] == ""))
					{
						echo '<div class="col-12 text-danger text-center"><b>dodaj tytyl i tresc</b></div>';
					}
					else
					{
						$title = $_POST['title'];
						$description = $_POST['description'];
						$id = $_SESSION['id_aktualnosci'];

						require_once "template/connect.php";
						mysqli_report(MYSQLI_REPORT_STRICT);
						try
						{
							$polaczenie = new mysqli($host, $db_user, $db_password, $db_name);
							if($polaczenie->connect_errno == 0)
							{
								$sql = sprintf("UPDATE aktualnosci SET tytul='%s', tresc1='%s' WHERE id='%s'", $title, $description, $id); 
								$rezultat = @$polaczenie->query($sql);

								if($rezultat)
								{
									echo '<div class="col-12 text-center text-success"><b>Aktualności zaktualizowane</b></div>';
								}
								else
								{
									throw new Exception($polaczenie->error);
								}	
						
								$polaczenie->close();
							}
						}
						catch(Exception $e)
						{
							echo '<div class="text-danger col-12 text-center"><b>Blad serwera. Nie można nawiązać połączenia z bazą danych</b></div>';
							exit();
						}
						unset($_POST['submit']);
						unset($_SESSION['id_aktualnosci']);
					}
				}			
			
				if(isset($_GET['id']))
				{
					$_SESSION['id_aktualnosci'] = $_GET['id'];
					
					require_once "template/connect.php";
					mysqli_report(MYSQLI_REPORT_STRICT);
					try
					{
						$polaczenie = new mysqli($host, $db_user, $db_password, $db_name);
						if($polaczenie->connect_errno == 0)
						{
							$sql = $sql = "SELECT * FROM aktualnosci WHERE id=".$_SESSION['id_aktualnosci']; 
							$rezultat = @$polaczenie->query($sql);

							if($rezultat)
							{
								if($wiersz = $rezultat->fetch_assoc())
								{
									$_SESSION['tytul_aktualnosci'] = $wiersz['tytul'];
									$_SESSION['tresc_aktualnosci'] = $wiersz['tresc1'];
								}
							}
							else
							{
								throw new Exception($polaczenie->error);
							}	
					
							
							$polaczenie->close();
						}
					}
					catch(Exception $e)
					{
						echo '<div class="text-danger col-12 text-center"><b>Blad serwera. Nie można nawiązać połączenia z bazą danych</b></div>';
					}
				}

			?>				
				<form method="post" enctype="multipart/form-data" class="col-12 text-dark">
					<h3 class="font-weight-bold">Aktualności:</h3>
					<label for="title">Tytuł:</label>
					<input type="text" name="title" value="<?php 
							if(isset($_SESSION['tytul_aktualnosci']))
							{
								echo $_SESSION['tytul_aktualnosci'];
								unset($_SESSION['tytul_aktualnosci']);
							}
						?>" class="w-100"/> </br> 
					<textarea rows="20" style="width: 100%;" name="description">
					<?php 
							if(isset($_SESSION['tresc_aktualnosci']))
							{
								echo $_SESSION['tresc_aktualnosci'];
								unset($_SESSION['tresc_aktualnosci']);
							}
					?>
					</textarea></br>
					<input type="submit" value="Aktualizuj" name="submit" class="mt-1 mb-1 btn btn-warning font-weight-bold"/>
				</form>
			</div>

        </main>

		<?php include 'template/footer.php'; ?>
    </body>