<?php
session_start();
if(isset($_SESSION["user"])){
	include("updateOrder.html");
	$table = "orders";
	$link = mysqli_connect("localhost", "root", "", "autopark") or die("Error connection");
	$sql = "SELECT * FROM `".$table."` WHERE `id_order`=".$_POST["id_order"];
	$response = mysqli_query($link, $sql) or die("Error select");
	$r = mysqli_fetch_array($response);
	
	
	$sql = "SELECT * FROM `manifests`, `drivers` WHERE manifests.id_driver=drivers.id_driver AND id_user=".$_SESSION["user"];
	$responseManifest = mysqli_query($link, $sql) or die("Error select manifests");
	$sql = "SELECT * FROM `clients` WHERE 1";
	$responseClient = mysqli_query($link, $sql) or die("Error select clients");
	?>
	<section class="main-part">
		<div class="container">
	<form action="orders.php" method="POST">
	<?php
	echo "<input type=\"hidden\" name=\"id_order\" value=\"".$_POST["id_order"]."\">";
	?>
		<table class="update-table">
			<td class="title">Клиент</td>
			<td><select name="update_client" required>
	<?php
	while($rClients = mysqli_fetch_array($responseClient)){
		if($r["id_client"] == $rClients["id_client"])
			echo  "<option selected value=\"".$rClients["id_client"]."\">".$rClients["name"]."</option>";
		else
			echo "<option value=\"".$rClients["id_client"]."\">".$rClients["name"]."</option>";
	}?>
			<tr>
				<td class="title">Второй пункт</td>
				<td>
				<?php
				echo "<input type=\"text\" name=\"update_point\" value=\"".$r["second_point"]."\" required></td>";
				?>
			</tr>			
			<tr>
				<td class="title">Направление</td>
				<td><select name="update_direction" required>
				<?php
				if($r["direction"] == "К клиенту")
					echo "<option selected value=\"К клиенту\">К клиенту</option>";
				else 
					echo "<option value=\"К клиенту\">К клиенту</option>";
				if($r["direction"] == "От клиента")
					echo "<option selected value=\"От клиента\">К клиенту</option>";
				else 
					echo "<option value=\"От клиента\">От клиента</option>";
				?>
				</select></td>
			</tr>			
			<tr>
				<td class="title">Километраж</td>
				<td>
				<?php
				echo "<input type=\"text\" name=\"update_kilometrage\" pattern=\"\d+(\.\d)?\" value=\"".$r["kilometrage"]."\" required>";
				?>
				</td>
			</tr>			
			<tr>
				<td class="title">Вес</td>
				<td>
				<?php
				echo "<input type=\"text\" name=\"update_weight\" pattern=\"\d+(\.\d)?\" value=\"".$r["weight"]."\" required>";
				?>
				</td>
			</tr>			
			<tr>
				<td class="title">Стоимость</td>
				<td>
				<?php
				echo "<input type=\"text\" name=\"update_price\" pattern=\"\d+?\" value=\"".$r["price"]."\" required>";
				?>
				</td>
			</tr>
			<tr>
				<td class="title">Дата</td>
				<td><select name="update_manifest">
					<option value="NULL"></option>
	<?php
	while($rManifest = mysqli_fetch_array($responseManifest)){
		if ($r["id_manifest"] == $rManifest["id_manifest"])
			echo "<option selected value=\"".$rManifest["id_manifest"]."\">".$rManifest["date"]."</option>";
		else
			echo "<option value=\"".$rManifest["id_manifest"]."\">".$rManifest["date"]."</option>";
	}?>
			</tr>
		</table>
		<input class="btn btn-right" type="submit" value="Сохранить">
	</form>
		</div>
	</section>
	<?php
	include("elements/footer.html");
}
?>
	