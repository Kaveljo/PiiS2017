<?php
	session_start();
	require 'db.php';
	
	$now = new DateTime();
	//echo $now->format('Y-m-d H:i:s'); 

	$price=$_GET['price'];
	$mail=$_GET['mail'];
	
	$query = mysqli_query($mysqli,"SELECT * FROM users WHERE email='$mail'");
	$row = mysqli_fetch_array($query);
	$id = $row['id'];
	$name=$row['name'];
	$lname=$row['lastname'];
	$adr=$row['address'];
	
?>	
<html>
	<head>
		<title>Checkout</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
	</head>
	<body style="background-color:#5174ad">
		<div class="container">
			<div class="col-sm-12"  style="text-align:center">
				<form action="" method="post">
					<h1>Odaberite svoju metodu plaćanja</h1><br>
					<input type="submit" name="card" value="Kartica" class="btn btn-info" style="width:250px"/>
					<input type="submit" name="CoD" value="Placanje po dostavi" class="btn btn-info" style="width:250px"/>
				</form>
				
				<?php
				if(isset($_POST['card'])):?>
					<form action="" method="post">
					<br><br>
					<label for=name style="margin= 5px">Name:</label><br>
					<input type="text" name="korisnik" style="width:300px" placeholder="Name and lastname"><br><br>
				
					<label for=kartica style="margin= 5px">Card number:</label><br>
					<input type="text" name="kartica" style="width:300px" placeholder="Card number..."><br><br>
				
					<label for=datum style="margin= 5px">Exparation datum:</label><br>
					<input type="text" name="datum" style="width:300px" placeholder="Exparation datum..."><br><br>
					
					<label for=csc style="margin= 5px">CSC:</label><br>
					<input type="text" name="csc" style="width:300px" placeholder="CSC..."><br><br>
					
					<input type="submit" name="plati" value="Plati: <?php echo $price?>$" class="btn btn-info" style="width:250px"/>
					</form>
				<?php
				endif;
				

				if(isset($_POST['korisnik'])){
					$korisnik=$_POST['korisnik'];
				}
	
				if(isset($_POST['kartica'])){
					$kartica=$_POST['kartica'];
				}
				
				if(isset($_POST['datum'])){
					$datum=$_POST['datum'];
				}
					
				if(isset($_POST['csc'])){
					$csc=$_POST['csc'];
				}
				
				if(isset($_POST['plati'])):
					$payment = mysqli_query($mysqli,"SELECT name, card_number, datum, csc FROM cards WHERE name='$korisnik' AND card_number='$kartica' AND datum='$datum' AND csc='$csc'");
					if(mysqli_num_rows($payment)>0){
						$sql_u = "INSERT INTO purchases (date,price,user_id) VALUES (NOW(),'$price','$id')";
						mysqli_query($mysqli,$sql_u);
						unset($_SESSION["shopping_cart"]);
						header("Location:index.php");
					}
					else{
						echo '<script language="javascript">';
						echo 'alert("Nisu dobri podaci")';
						echo '</script>';
					}
				endif;
				
				if(isset($_POST['CoD'])):?>
				<div>
					
				</div>
				<?php
				endif;
				?>	
			</div>
		</div>
	</body>
</html>