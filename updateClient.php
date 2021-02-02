<?php
session_start();
if(isset($_SESSION["user"])){
	include("updateClient.html");
	$table = "clients";
	$link = mysqli_connect("localhost", "root", "", "autopark") or die("Error connection");
	$sql = "SELECT * FROM `".$table."` WHERE `id_client`=".$_GET["id"].";";
	$response = mysqli_query($link, $sql) or die("Error select");
	while($r = mysqli_fetch_array($response)){?>
	<section class="main-part">
		<div class="container">
	<form action="clients.php" method="POST"><?php
		echo "<input type=\"hidden\" name=\"update_id\" value=\"".$_GET["id"]."\">";?>
		<table class="update-table">
			<tr>
				<td class="title">Название организации</td><?php
				echo "<td><input type=\"text\" name=\"update_name\" value=\"".$r['name']."\" required></td>";?>
			</tr>
			<tr>
				<td class="title">Адрес</td><?php
				echo "<td><input type=\"text\" name=\"update_address\" value=\"".$r['address']."\" required></td>";?>
			</tr>
		</table>
		<input class="btn btn-right" type="submit" value="Сохранить">
	</form>
		</div>
	</section>
	<?php
	}
	include("elements/footer.html");
}
?>
	