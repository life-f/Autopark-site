<?php
session_start();
if(isset($_SESSION["user"])){
	include("addManifest.html");
	$table = "manifests";
	$link = mysqli_connect("localhost", "root", "", "autopark") or die("Error connection");
	$sql = "SELECT * FROM `drivers` WHERE id_user=".$_SESSION["user"];
	$response = mysqli_query($link, $sql) or die("Error select");
	$rDriver = mysqli_fetch_array($response);
	$sql = "SELECT * FROM `cars` WHERE 1";
	$response = mysqli_query($link, $sql) or die("Error select");
	?>
	<section class="main-part">
		<div class="container">
	<form action="manifests.php" method="POST">
	<?php
	echo "<input type=\"hidden\" name=\"id_driver\" value=\"".$rDriver["id_driver"]."\">";
	?>
		<table class="update-table">
			<tr>
				<td class="title">Дата</td>
				<td><input type="date" name="date" required></td>
			</tr>
			<tr>
				<td class="title">Автомобиль</td>
				<td><select name="car" required>
	<?php
	while($rCars = mysqli_fetch_array($response)){
		echo "<option value=\"".$rCars["license_plate"]."\">".$rCars["license_plate"]."</option>";
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
include("elements/footer.html");