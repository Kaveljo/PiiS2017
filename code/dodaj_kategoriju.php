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

				<label for=name style="margin= 5px">Ime Kategorije:</label><br>
				<input type="text" name="name" style="width:60%" placeholder="Naziv..."><br><br>
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


if(isset($_POST["dodaj"])){
		if($pname==""){
			echo '<script language="javascript">';
			echo 'alert("Morate popuniti sva polja !!!")';
			echo '</script>';
		}
		else{
			$query = mysqli_query($mysqli,"SELECT * FROM categories WHERE name='$pname'");
			if(mysqli_num_rows($query)>0){
				echo '<script language="javascript">';
				echo 'alert("Postoji ova kategorija!!!")';
				echo '</script>';
			}
			
			else{
			$sql_u = "INSERT INTO categories (name) VALUES ('$pname')";
			mysqli_query($mysqli,$sql_u);

			header("Location:admin.php");
			
			}
		}	
}
?>
</html>