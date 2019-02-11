<?php 
	if (isset($_SESSION['user']))
		echo '<h1 style="text-align: center;">Użytkownik ' . $_SESSION['user'] . '</h1>';

?>

<div class="container" style="padding: 30px;">
	<form action="actions/upload.php" method="post" enctype="multipart/form-data">
		<?php
				if (isset($_GET['err']))
					echo '<p style="color:red">Dopuszczalny rozmiar pliku to do 1mb, a rozszerzenie jpg lub png</p>';
		?>
		<span class="border" style="padding:15px;">
		    Wybierz plik   
		    <input type="file" name="image" id="image">
		    <input type="checkbox" name="private">Prywatny
		    <input type="submit" value="Upload Image" name="submit" class="btn btn-secondary">
		</span>
	</form>
</div>
<hr>
<br>

<?php require 'my_images.php'; ?>

<div class="container" style="padding: 30px;">
	<h3>Twoje publiczne obrazki</h3>
	<?php 

		foreach ($images_public as $img) {
			echo '<a href="img/upload/' . $img . '"><img src="img/mini/' . $img . '" class="img-responsive img-thumbnail" alt="img"></a>';
		}

	?>
	<hr>
	<br>
	<h3>Twoje prywatne obrazki</h3>
	<?php 

		foreach ($images_private as $img) {
			echo '<a href="img/upload/' . $img . '"><img src="img/mini/' . $img . '" class="img-responsive img-thumbnail" alt="img"></a>';
		}

	?>
	<hr>
	<br>
	<h3>Obrazki zapamiętane: </h3>
	<form action="actions/remove_images.php" method="post">

		<?php
			if (isset($_SESSION['saved'])) {
				foreach ($_SESSION['saved'] as $img) {
					echo '<figure class="figure" style="margin: 10px;">
			                  <a href="img/upload/' . $img . '"><img src="img/mini/' . $img . '" class="figure-img img-fluid img-thumbnail" alt="img"></a>
			                  <figcaption class="figure-caption"><input type="checkbox" name="' . $img . '" id="img/mini/' . $img . '" ><label for="img/mini/' . $img . '" style="margin:5px;"> Usuń</label></figcaption>
			                </figure>';
						}
					}
		?>

		<br>
		<?php 
			if (isset($_SESSION['saved'])) { ?>
				<input type="submit" value="Usuń zaznaczone" class="btn btn-secondary">
		<?php } ?>

	</form>

	<hr>
	<br>
</div>
