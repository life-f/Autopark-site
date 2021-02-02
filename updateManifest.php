<?php
session_start();
if(isset($_SESSION["user"])){
	include("updateManifest.html");
	$table = "manifests";
	$link = mysqli_connect("localhost", "root", "", "autopark") or die("Error connection");
	$sql = "SELECT * FROM `".$table."` WHERE `id_manifest`=".$_POST["id_manifest"].";";
	$response = mysqli_query($link, $sql) or die("Error select");
	$r = mysqli_fetch_array($response)?>
	<section class="main-part">
		<div class="container">
	<form action="manifests.php" method="POST"><?php
		echo "<input type=\"hidden\" name=\"update_id\" value=\"".$_POST["id_manifest"]."\">";?>
		<table class="update-table">
			<tr>
				<td class="title">Дата</td><?php
				echo "<td><input type=\"date\" name=\"update_date\" value=\"".$r['date']."\" required></td>";?>
			</tr>
			<tr>
				<td class="title">Автомобиль</td>
				<td><select name="update_car" required>
				<?php
	$sql = "SELECT * FROM `cars` WHERE 1";
	$response = mysqli_query($link, $sql) or die("Error select");
	while($rCars = mysqli_fetch_array($response)){
		if($rCars["license_plate"] == $r["license_plate"]){
			echo "<option selected value=\"".$rCars["license_plate"]."\">".$rCars["license_plate"]."</option>";
		} else {
			echo "<option value=\"".$rCars["license_plate"]."\">".$rCars["license_plate"]."</option>";
		}
	}
	?>
			</tr>
		</table>
		<input class="btn btn-right" type="submit" value="Сохранить">
	</form>
		</div>
	</section>
	<?php
include ("elements/footer.html");
}
?>
	