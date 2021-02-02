<?php
session_start();
if(isset($_SESSION["user"])){
	include("cars.html");
	$table = "cars";
	$link = mysqli_connect("localhost", "root", "", "autopark") or die("Error connection");
	$sql = "SELECT * FROM `".$table."` WHERE 1;";
	$response = mysqli_query($link, $sql) or die("Error select");
	echo "<section class=\"main-part\">
	<div class=\"container\">
		<table>
		<tr>
			<td>Номер автомобиля</td>
			<td>Пробег</td>
			<td>Модель</td>
		</tr>";
	while($r = mysqli_fetch_array($response)){
		echo "<tr>";
		echo "<td>".$r['license_plate']."</td>
			<td>".$r['run']."</td>
			<td>".$r['model']."</td>";
		echo "</tr>";
	}
	echo "</table>
		</div>
	</section>";
	include("elements/footer.html");
}
?>