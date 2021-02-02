<?php
session_start();
if(isset($_SESSION["user"])){
	include("clients.html");
	$table = "clients";
	$link = mysqli_connect("localhost", "root", "", "autopark") or die("Error connection");
	
	if(isset($_POST["name"]) && isset($_POST["address"])){
		$sql = "INSERT INTO `clients` (`name`, `address`) VALUES ('".$_POST["name"]."','".$_POST["address"]."')";
		$response = mysqli_query($link, $sql) or die("Ошибка добавления");
	}
	
	if(isset($_POST["update_name"]) && isset($_POST["update_address"])){
		$sql = "UPDATE `clients` SET `name`='".$_POST["update_name"]."',`address`='".$_POST["update_address"]."' WHERE `id_client`=".$_POST["update_id"]."";
		$response = mysqli_query($link, $sql) or die("Ошибка добавления");
	}
	
	$sql = "SELECT * FROM `".$table."` WHERE 1;";
	$response = mysqli_query($link, $sql) or die("Error select");
	echo "<section class=\"main-part\">
		<div class=\"container\">";
	while($r = mysqli_fetch_array($response)){
		echo "<div class=\"client\">
		<form action=\"updateClient\" class=\"update_form\" method=\"POST\">
				<h2><a href=\"http://localhost/project/updateClient.php?id=".$r['id_client']."\" class=\"submitlink\">".$r['name']."</a></h2>
				<p class=\"address\">".$r['address']."</p>
			</form>
			</div>";
	}
}
?>
		<div class="add_form">
			<form action="addClient.html">
				<input class="btn" type="submit" value="Добавить клиента">
			</form>
		</div>
	</div>
</section>
<?php
include("elements/footer.html");
?>