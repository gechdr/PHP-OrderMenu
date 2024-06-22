<?php
require("function.php");

$key = $_GET["search"];

if ($key == "") {
	// Semua
	$menus = query("SELECT * FROM menu");
} else {
	// Filter
	$menus = query("SELECT * FROM menu WHERE name_menu LIKE '%" . $key . "%'");
}

$ctr = 0;
foreach ($menus as $menu) {
	$id = $menu["id_menu"];
	$name = $menu["name_menu"];
	$image = $menu["image"];
	$description = $menu["description"];
	$price = $menu["price"];

	preg_match_all('!\d+!', $id, $matches);
	$temp = $matches[0][0];
	$num = intval($temp);
	$quantity = intval($_SESSION["quantity"][$num - 1]);

	echo "<div class='col-12 d-flex mb-2 align-items-center text-light'>";
	echo "<div class='thum'>";
	echo "<img src = 'data:assets/jpg;base64," . base64_encode($image) . "' class='' style='width: 150px; height: 150px;' alt='...'/>";
	echo "</div>";
	echo "<div class='detail d-flex flex-column justify-content-start ms-3 me-5'>";
	echo "<span class='fs-2 fw-bold'>" . $name . "</span>";
	echo "<span class='fs-5'>" . $description . "</span>";
	echo "<span class='fs-5 fst-italic'>Rp. " . $price . "</span>";
	echo "</div>";
	echo "<div class='action d-flex flex-row align-items-center justify-content-center ms-auto'>";
	echo "<div class='kiri'>";
	echo "<button type='button' id='kiri" . $num . "' class='btn btn-outline-dark' name='btnMin' onclick='btnClicked(this.id)'>-</button>";
	echo "</div>";
	echo "<div class='label p-3'>";
	echo "<span id='quantity" . $num . "'>" . $quantity . "</span>";
	echo "</div>";
	echo "<div class='kanan'>";
	echo "<button type='button' id='kanan" . $num . "' class='btn btn-outline-dark' name='btnPlus' onclick='btnClicked(this.id)'>+</button>";
	echo "</div>";
	echo "</div>";
	echo "</div>";
	echo "<hr>";

	$ctr++;
}

if ($ctr == 0) {
	echo '<div class="col-12 d-flex mb-2 align-items-center text-light">';
	echo '<h1>Menu Tidak Tersedia!</h1>';
	echo '</div>';
}
