<?php
session_start();
if(isset($_SESSION["user"])){
	include("addOrder.html");
	$table = "orders";
	$link = mysqli_connect("localhost", "root", "", "autopark") or die("Error connection");
	$sql = "SELECT * FROM `manifests`, `drivers` WHERE manifests.id_driver=drivers.id_driver AND id_user=".$_SESSION["user"];
	$responseManifest = mysqli_query($link, $sql) or die("Error select manifests");
	$sql = "SELECT * FROM `clients` WHERE 1";
	$responseClient = mysqli_query($link, $sql) or die("Error select clients");
	?>
	<section class="main-part">
		<div class="container">
	<form action="orders.php" method="POST">
		<table class="update-table">
			<td class="title">Клиент</td>
			<td><select name="id_client" required>
	<?php
	while($rClients = mysqli_fetch_array($responseClient)){
		echo "<option value=\"".$rClients["id_client"]."\">".$rClients["name"]."</option>";
	}
	?>
			<tr>
				<td class="title">Второй пункт</td>
				<td><input type="text" name="second_point" required></td>
			</tr>			
			<tr>
				<td class="title">Направление</td>
				<td><select name="direction" required>
					<option value="К клиенту">К клиенту</option>
					<option value="От клиента">От клиента</option>
				</select></td>
			</tr>			
			<tr>
				<td class="title">Километраж</td>
				<td><input type="text" name="kilometrage" pattern="\d+(\.\d)?" required></td>
			</tr>			
			<tr>
				<td class="title">Вес</td>
				<td><input type="text" name="weight" pattern="\d+(\.\d)?" required></td>
			</tr>			
			<tr>
				<td class="title">Стоимость</td>
				<td><input type="text" name="price" pattern="\d+?" required></td>
			</tr>
			<tr>
				<td class="title">Дата</td>
				<td><select name="id_manifest">
					<option value="NULL"></option>
	<?php
	while($rManifest = mysqli_fetch_array($responseManifest)){
		echo "<option value=\"".$rManifest["id_manifest"]."\">".$rManifest["date"]."</option>";
	}
}
?>
				</select></td>
			</tr>
		</table>
		<input class="btn btn-right" type="submit" value="Сохранить">
	</form>
		</div>
	</section>
<?php
include ("elements/footer.html");
?>