<?php
	@session_start();

	if(!isset($_SESSION['user']))
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
			
			<div class="bg-light mt-1 mb-5 content2 d-flex align-items-center justify-content-center row">
			<?php
				if(isset($_POST['submit']) && isset($_FILES['file']))
				{
					$img_name = $_FILES['file']['name'];
					$img_size = $_FILES['file']['size'];
					$tmp_name = $_FILES['file']['tmp_name'];
					$error = $_FILES['file']['error'];	
					
					$img_name2 = $_FILES['file2']['name'];
					$img_size2 = $_FILES['file2']['size'];
					$tmp_name2 = $_FILES['file2']['tmp_name'];
					$error2 = $_FILES['file2']['error'];
					
					if(($error == 0) || ($error == 4))
					{
						if($img_size > 10000000)
						{
							echo '<div class="col-12 text-danger text-center"><b>za duży plik</b></div>';
						}
						else if (($_POST['title'] == "") || ($_POST['description'] == ""))
						{
							echo '<div class="col-12 text-danger text-center"><b>dodaj tytyl i tresc</b></div>';
						}
						else
						{
							$title = $_POST['title'];
							$description = $_POST['description'];
							
							$new_img_name2 = NULL;
							
							if($error != 4)
							{
								$img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
								$img_ex_lc = strtolower($img_ex);
							}
							else
							{
								$img_ex_lc = 'brakpliku';
							}
							if($error2 != 4)
							{
								$img_ex2 = pathinfo($img_name2, PATHINFO_EXTENSION);
								$img_ex_lc2 = strtolower($img_ex2);
							}
							else
							{
								$img_ex_lc2 = 'brakpliku';
							}
							
							$allowed_exs = array('jpg', 'jpeg', 'png', 'brakpliku');

							if(in_array($img_ex_lc, $allowed_exs)) {
								
								if($error != 4)
								{
									$new_img_name = uniqid("img-", true).'.'.$img_ex_lc;
									$upload_path = 'media/'.$new_img_name;
									move_uploaded_file($tmp_name, $upload_path);
								}
								else {
									$new_img_name = NULL;
								}
								
								if(in_array($img_ex_lc2, $allowed_exs)) {
								
									if($error2 != 4)
									{
										$new_img_name2 = uniqid("img-", true).'.'.$img_ex_lc2;
										$upload_path2 = 'media/'.$new_img_name2;
										move_uploaded_file($tmp_name2, $upload_path2);
									}
								}

								require_once "template/connect.php";
								mysqli_report(MYSQLI_REPORT_STRICT);
								try
								{
									$polaczenie = new mysqli($host, $db_user, $db_password, $db_name);
									if($polaczenie->connect_errno == 0)
									{
										$user_id = $_SESSION['user_id'];
										$sql = sprintf("INSERT INTO aktualnosci VALUES (NULL, '$title', '$new_img_name', '$description', '$new_img_name2', CURRENT_TIMESTAMP, '$user_id')"); 
										$rezultat = @$polaczenie->query($sql);

										if($rezultat)
										{
											echo '<div class="col-12 text-center text-success"><b>Aktualności dodane do bazy danych</b></div>';
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
							}
							else {
								echo '<div class="col-12 text-danger text-center"><b>niedozwolony format</b></div>';
							}
							unset($_POST['submit']);
							unset($_FILES['file']);
						}
					}
					else
					{
						echo '<div class="col-12 text-danger text-center"><b>blad podczas ładowania pliku</b></div>';
						echo $error;
					}
					unset($_POST['submit']);
					unset($_FILES['file']);
				}

				?>				
					<form method="post" enctype="multipart/form-data" class="col-12">
						<h3>Aktualności:</h3>
						<label for="title">Tytuł:</label>
						<input type="text" name="title" class="w-100"/> </br>
						<input type="file" name="file" class="mt-1 mb-1 w-100" style=""></br> 
						<textarea rows="20" style="width: 100%;" name="description">
						</textarea></br>
						<input type="file" name="file2" class="mt-1 mb-1 w-100" style=""></br> 
						<input type="submit" value="Dodaj aktualności" name="submit" class="mt-1 mb-1 btn btn-warning font-weight-bold"/>
					</form>
				
			</div>

        </main>

		<?php include 'template/footer.php'; ?>
    </body>