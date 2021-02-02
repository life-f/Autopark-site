<?php
session_start();
if(isset($_SESSION["user"])){
	include("manifests.html");
	$table = "manifests";
	$link = mysqli_connect("localhost", "root", "", "autopark") or die("Error connection");
	
	if(isset($_POST["id_driver"]) && isset($_POST["date"]) && isset($_POST["car"])){
		$sql = "INSERT INTO `manifests`(`date`, `license_plate`, `id_driver`) VALUES ('".$_POST["date"]."','".$_POST["car"]."',".$_POST["id_driver"].")";
		$response = mysqli_query($link, $sql) or die("Ошибка добавления");
	}
	
	if (isset($_POST["update_id"]) && isset($_POST["update_date"]) && isset($_POST["update_car"])){
		$sql = "UPDATE `".$table."` SET `date`='".$_POST["update_date"]."',`license_plate`='".$_POST["update_car"]."' WHERE `id_manifest`=".$_POST["update_id"];
		$response = mysqli_query($link, $sql) or die("Ошибка обновления");
	}
	
	if (isset($_POST["id_manifest"])){
		$sql = "DELETE FROM `".$table."` WHERE `id_manifest`=".$_POST["id_manifest"];
		$response = mysqli_query($link, $sql) or die("Ошибка удаления");
	}
	
	$sql = "SELECT * FROM `".$table."`,`drivers` WHERE drivers.id_driver=manifests.id_driver;";
	$response = mysqli_query($link, $sql) or die("Error select");
	echo "<section class=\"main-part\">
	<div class=\"container\">
		<table>
		<tr>
			<td><strong>Дата</strong></td>
			<td><strong>Автомобиль</strong></td>
			<td><strong>Водитель</strong></td>
		</tr>";
	while($r = mysqli_fetch_array($response)){
		echo "<tr>";
		echo "<td>".$r['date']."</td>
			<td>".$r['license_plate']."</td>
			<td>".$r['last_name']."</td>";
		if($_SESSION["user"] == $r["id_user"]){
			echo "<td  class=\"no-border\">
					<form action=\"updateManifest.php\" method=\"POST\">
						<input type=\"hidden\" name=\"id_manifest\" value=\"".$r["id_manifest"]."\">
					<input class=\"btn btn-small\" type=\"submit\" value=\"Редактировать\">
					</form>";
			echo "<form action=\"manifests.php\" method=\"POST\">
						<input type=\"hidden\" name=\"id_manifest\" value=\"".$r["id_manifest"]."\">
						<input class=\"btn btn-small\" type=\"submit\" value=\"Удалить\">
					</form>
				</td>";
		}
		echo "
		</tr>";
	}
	echo "</table>";
}
?>
			<div class="add_form">
				<form action="addManifest.php">
					<input class="btn" type="submit" value="Добавить поездку">
				</form>
			</div>
		</div>
	</section>
<?php
include("elements/footer.html");
?>