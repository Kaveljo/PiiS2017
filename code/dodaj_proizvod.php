<?php
	session_start();
	require 'db.php';
	
?>
<!DOCTYPE html>
<html>
<head>
		<title>Admin mode</title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
</head>
<body style="background-color:#5174ad">
	<div class="container"><br>
		<div class="col-sm-12"  style="text-align:center">
			<form  action="" method="post">

				<label for=name style="margin= 5px">Ime proizvoda:</label><br>
				<input type="text" name="name" style="width:60%" placeholder="Naziv..."><br><br>
				
				<label for=prc style="margin= 5px">Cijena:</label><br>
				<input type="text" name="prc" style="width:60%" placeholder="Cijena..."><br><br>
				
				<label for=slika style="margin= 5px">Slika:</label><br>
				<input type="text" name="slika" style="width:60%" placeholder="Path slike..."><br><br>
				
				<label for=categ style="margin= 5px">Kategorija:</label><br>
				<input type="text" name="categ" style="width:60%" placeholder="Kategorija..."><br><br>
			
			<input type="submit" name="dodaj" class="btn btn-info" style="width:150px" value="DODAJ"><br><br>
			
			<a href="admin.php" class="btn btn-danger" style="width:100px">Go back</a>
			</form>
		</div>
	</div>
</body>
<?php

if(isset($_POST['name'])){
$pname=$mysqli->escape_string($_POST['name']);
}
if(isset($_POST['prc'])){
$pprc=$_POST['prc'];
}
if(isset($_POST['slika'])){
$pslika=$_POST['slika'];
}
if(isset($_POST['categ'])){
$pcateg=$_POST['categ'];
}


if(isset($_POST["dodaj"])){
		if($pname==""||$pprc==""||$pslika==""||$pcateg==""){
			echo '<script language="javascript">';
			echo 'alert("Morate popuniti sva polja !!!")';
			echo '</script>';
		}
		else{
			$query = mysqli_query($mysqli,"SELECT * FROM products WHERE name='$pname'");
			if(mysqli_num_rows($query)>0){
				echo '<script language="javascript">';
				echo 'alert("Ovaj proizvod je vec dodan !!!")';
				echo '</script>';
			}
			
			else{
			$sql_u = "INSERT INTO products (name,price,image,category,stocked,date_altered) VALUES ('$pname','$pprc','$pslika','$pcateg','yes',NOW())";
			mysqli_query($mysqli,$sql_u);

			header("Location:admin.php");
			
			}
		}	
}
?>
</html>