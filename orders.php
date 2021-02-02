<?php
session_start();
if(isset($_SESSION["user"])){
	include("orders.html");
	$table = "orders";
	$link = mysqli_connect("localhost", "root", "", "autopark") or die("Error connection");
	
	if(isset($_POST["id_client"])){
		$sql="INSERT INTO `".$table."`(`direction`, `kilometrage`, `weight`, `price`, `second_point`, `id_manifest`, `id_client`) VALUES ('".$_POST["direction"]."',".$_POST["kilometrage"].",".$_POST["weight"].",".$_POST["price"].",'".$_POST["second_point"]."',".$_POST["id_manifest"].",".$_POST["id_client"].")";
		$response = mysqli_query($link, $sql) or die("Ошибка добавления");
	}
	
	if(isset($_POST["id_order"])){
		$sql = "UPDATE `".$table."` SET `id_client`=".$_POST["update_client"].", `second_point`='".$_POST["update_point"]."', `direction`='".$_POST["update_direction"]."', `kilometrage`=".$_POST["update_kilometrage"].", `price`=".$_POST["update_price"].", `weight`=".$_POST["update_weight"].",`id_manifest`=".$_POST["update_manifest"]." WHERE `id_order`=".$_POST["id_order"];
		$response = mysqli_query($link, $sql) or die("Ошибка обновления");
	}
	
	$sql = "SELECT * FROM `".$table."` \n"
    . "LEFT JOIN `manifests` ON `manifests`.id_manifest=`".$table."`.id_manifest\n"
    . "LEFT JOIN `clients` ON `clients`.id_client=`".$table."`.id_client";
	$response = mysqli_query($link, $sql) or die("Error select");
	$sql = "SELECT * FROM `drivers` WHERE 1";
	$responseDrivers = mysqli_query($link, $sql) or die("Error select");?>
	<section class="main-part">
		<div class="container">
			<table class="orders">
				<tr>
					<td><strong>Клиент</strong></td>
					<td><strong>Второй пункт<strong></td>
					<td><strong>Направление</strong></td>
					<td><strong>Километраж</strong></td>
					<td><strong>Вес</strong></td>
					<td><strong>Стоимость</strong></td>
					<td><strong>Дата</strong></td>
				</tr>
	<?php
	while($r = mysqli_fetch_array($response)){
		echo "<tr>";
		echo "<td>".$r['name']."</td>
			<td>".$r['second_point']."</td>
			<td>".$r['direction']."</td>
			<td>".$r['kilometrage']."</td>
			<td>".$r['weight']."</td>
			<td>".$r['price']."</td>
			<td>".$r['date'];
		echo "
				<form action=\"updateOrder.php\" method=\"POST\">
					<input type=\"hidden\" name=\"id_order\" value=\"".$r["id_order"]."\">
					<input class=\"btn btn-small\" type=\"submit\" value=\"Редактировать\">
				</form></td>";
		echo "</tr>";
	}
	echo "</table>";
}
?>
		<div class="add_form">
			<form action="addOrder.php">
				<input class="btn" type="submit" value="Добавить заказ">
			</form>
		</div>
	</div>
</section>
<?php 
include("elements/footer.html");