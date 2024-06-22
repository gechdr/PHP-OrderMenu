<?php
require("function.php");

$nota = $_SESSION["nota"];
$name = $_REQUEST["customer"];
$subtotal = $_SESSION["grandTotal"];

$data = [
    "nota" => $nota,
    "name" => $name,
    "grandTotal" => $subtotal
];

insertHTrans($data);


$carts = query("SELECT * FROM cart");
foreach ($carts as $cart) {
    $idMenu = $cart["id_menu"];
    $quantity = $cart["quantity"];

    $data = [
        "nota" => $nota,
        "id_menu" => $idMenu,
        "quantity" => $quantity
    ];

    insertDTrans($data);
}
