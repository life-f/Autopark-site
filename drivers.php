<?php
session_start();
if(isset($_SESSION["user"])){
	include("drivers.html");
	$table = "drivers";
	$link = mysqli_connect("localhost", "root", "", "autopark") or die("Error connection");
	$sql = "SELECT * FROM `".$table."` WHERE 1;";
	$response = mysqli_query($link, $sql) or die("Error select");
	echo "<section class=\"main-part\">
		<div class=\"container\">
			<table>
				<tr>
					<td>Фамилия</td>
					<td>Имя</td>
					<td>Категория</td>
					<td>Опыт</td>
					<td>Год рождения</td>
				</tr>";
	while($r = mysqli_fetch_array($response)){
		echo "<tr>";
		echo "<td>".$r['last_name']."</td>
			<td>".$r['first_name']."</td>
			<td>".$r['category']."</td>
			<td>".$r['experience']."</td>
			<td>".$r['birth_year']."</td>";
		echo "</tr>";
	}
	echo "</table>
	</div>
	</section>";
	include("elements/footer.html");
}
?>