<?php
require_once("function.php");

$edit = false;

if (isset($_REQUEST["id"])) {
    $id = $_REQUEST["id"];
    $quantity = $_REQUEST["quantity"];
    $edit = true;
}

if ($edit) {
    preg_match_all('!\d+!', $id, $matches);
    $temp = $matches[0][0];
    $num = intval($temp);
    $_SESSION["quantity"][$num - 1] = $quantity;

    $num_length = strlen((string)$num);
    if ($num_length == 1) {
        $idMenu = "MENU00" . $num;
    } else if ($num_length == 2) {
        $idMenu = "MENU0" . $num;
    } else if ($num_length == 3) {
        $idMenu = "MENU" . $num;
    }

    if ($quantity > 0) {
        // Insert or Update
        $carts = query("SELECT * FROM cart WHERE id_menu = '$idMenu'");
        $menus = query("SELECT * FROM menu WHERE id_menu = '$idMenu'");
        foreach ($menus as $menu) {
            $price = $menu["price"];
        }

        if (count($carts) == 0) {
            // Insert
            $data = [
                "id" => $idMenu,
                "price" => $price,
                "quantity" => $quantity
            ];
            insertCart($data);
        } else {
            // Update
            $data = [
                "id" => $idMenu,
                "price" => $price,
                "quantity" => $quantity
            ];
            updateCart($data);
        }
    } else {
        // Delete
        deleteCart($idMenu);
    }

    $transdate = date('ymd', time());

    $notas = query("SELECT * FROM htrans_penjualan WHERE nota_jual LIKE '%" . $transdate . "%'");
    $countNotas = count($notas);

    if ($countNotas > 0) {
        $nota = $notas[$countNotas - 1];
        $lastNota = $nota["nota_jual"];
        $nextNum = substr($lastNota, 6);
        $nextNum = intval($nextNum) + 1;
    } else {
        $nextNum = 1;
    }

    $lengthNotas = (strlen((string)$nextNum));
    if ($lengthNotas == 1) {
        $nota_jual = $transdate . "00" . $nextNum;
    } else if ($lengthNotas == 2) {
        $nota_jual = $transdate . "0" . $nextNum;
    } else if ($lengthNotas == 3) {
        $nota_jual = $transdate . $nextNum;
    }

    $_SESSION["nota"] = $nota_jual;
}

$nota_jual = $_SESSION["nota"];

$carts = query("SELECT * FROM cart,menu WHERE cart.id_menu = menu.id_menu");

echo "<h3 class='text-light'>Nota : " . $nota_jual . "</h3>";
echo "<table class='text-light w-100 fs-4 mt-3 ms-3'>";
echo "<tr>";
echo     "<th>Nama</th>";
echo     "<th>Quantity</th>";
echo     "<th>Subtotal</th>";
echo "</tr>";

$grandTotal = 0;
foreach ($carts as $cart) {
    $name = $cart["name_menu"];
    $quantity = $cart["quantity"];
    $price = $cart["price"];
    $subTotal = $price * $quantity;

    echo "<tr>";
    echo     "<td>" . $name . "</td>";
    echo     "<td class='d-flex justify-content-evenly'>" . $quantity . "</td>";
    echo     "<td> Rp. " . $subTotal . "</td>";
    echo "</tr>";

    $grandTotal += $subTotal;
}

$_SESSION["grandTotal"] = $grandTotal;

echo "</table>";
echo "<div class='d-flex justify-content-start mt-4 ms-2'>";
echo "<span class='fs-3 text-light'>Grand Total: Rp. " . $grandTotal . "</span>";
echo "</div>";
