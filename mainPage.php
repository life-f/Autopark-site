<html>
	<head>
		 <meta charset="utf-8">
		 <title>Автопарк</title>
	</head>
	<body>
	</body>
<html>

<?php
session_start();
if(isset($_SESSION["user"])){
	include("mainPage.html");
} else if (isset($_POST["log"])){
	$table = "users";
	$link = mysqli_connect("localhost", "root", "", "autopark") or die("Error connection");
	$sql = "SELECT * FROM `users` WHERE login='".$_POST["log"]."';";
	$response = mysqli_query($link, $sql) or die("Error select");
	$r = mysqli_fetch_array($response);
	do{
		if($_POST["log"] == $r["login"]){
			if($_POST["pass"] == $r["password"]){
				$_SESSION["user"]=$r["id_user"];
				include("mainPage.html");
			} else {
				include("elements/header.html");?>
				<div class="container">
					<div class="alert">Неверный пароль</div>
					<form action="login.html">
						<input class="btn" type="submit" value="Назад">
					</form>
				</div>
			<?php }
		} else {
				include("elements/header.html");?>
			<div class="container">
				<div class="alert">Неверный логин</div>
				<form action="login.html">
					<input class="btn" type="submit" value="Назад">
				</form>
			</div>
		<?php }
		
	} while($r = mysqli_fetch_array($response));
	
	include("elements/footer.html");
}
?>