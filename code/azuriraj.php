<?php

	session_start();
	require 'db.php';
?>
	
	
	<html>
		<head>
			<title>Admin mode</title>
			<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
		</head>	
		<body style="background-color:#5174ad">
			<div class="container">
				<div style="text-align:center" class="col-sm-12" style="margin:5px">
		<?php
			$id=$_GET['id'];
				if(isset($id)):
					$sql = "SELECT * FROM products WHERE id='$id'";
						$result = mysqli_query($mysqli,$sql)or die(mysqli_error());
							while($row = mysqli_fetch_array($result)):?>
								<form action="" method="post">
									<br><br>
									<h3>Ažurirajte podatke za ovaj proizvod:</h3><br><br>
									<label for=ime_p style="margin= 5px">Naziv proizvoda:</label><br>
									<input type="text" name="ime_p" style="width:60%" value="<?php echo $row['name'];?>"><br><br>
								
									<label for=cijena style="margin= 5px">Cijena:</label><br>
									<input type="text" name="cijena" style="width:60%" value="<?php echo $row['price'];?>"><br><br>
									
									<p>Zadnji put ažurirano:<?php echo $row['date_altered'];?></p><br><br>
									<input type="submit" name="sendit" value="Ažuriraj" class="btn btn-info" style="width:150px"/>
								</form>
							<?php endwhile; endif;
							
							if(isset($_POST['sendit'])){
								if(isset($_POST['ime_p']) && isset($_POST['cijena'])){
									$ime_p=$_POST['ime_p'];
									$cijena=$_POST['cijena'];
									$sql_u = "UPDATE products SET name='$ime_p', price='$cijena', date_altered=NOW() WHERE id='$id'";
									mysqli_query($mysqli,$sql_u);
									header("Location:admin.php");
								}
							}
						?><form action="" method="post">
						<input type="submit" name="del" value="IZBRIŠI" class="btn btn-danger" style="width:150px"/>
						</form>
						
						<?php
							if(isset($_POST['del'])){
								?><form action="" method="post">
									<p>DA LI STE SIGURNI ?</p>
									<input type="submit" name="sigurno" value="DA" class="btn btn-info" style="width:150px"/>
								</form>
								<?php
								}
							
						if(isset($_POST['sigurno'])){
									mysqli_query($mysqli,"DELETE FROM products WHERE products.id='$id'");
									header("Location:admin.php");
								}
						?>
			</div>
		</div>
	</body>
</html>