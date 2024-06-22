<?php
session_start();

$conn = mysqli_connect('localhost', 'root', '', 't7_6958');

function alert($message)
{
    echo "<script>alert('$message');</script>";
}

function query($query)
{
    global $conn;

    $result = mysqli_query($conn, $query);
    $rows = [];

    while ($row = mysqli_fetch_assoc($result)) {
        array_push($rows, $row);
    }

    return $rows;
}

// INSERT

function insert($data)
{
    global $conn;

    // DATA

    $query = "INSERT INTO  VALUES ()";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function insertCart($data)
{
    global $conn;

    // DATA
    $id = $data["id"];
    $price = $data["price"];
    $quantity = $data["quantity"];

    $query = "INSERT INTO cart VALUES ('$id','$price','$quantity')";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function insertHTrans($data)
{
    global $conn;

    // DATA
    $nota = $data["nota"];
    $name = $data["name"];
    $subTotal = $data["grandTotal"];

    $query = "INSERT INTO htrans_penjualan VALUES ('$nota','$name','$subTotal')";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function insertDTrans($data)
{
    global $conn;

    // DATA
    $nota = $data["nota"];
    $idMenu = $data["id_menu"];
    $quantity = $data["quantity"];

    $query = "INSERT INTO dtrans_penjualan VALUES ('$nota','$idMenu','$quantity')";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

// UPDATE

function update($data)
{
    global $conn;

    // DATA

    $query = "UPDATE  SET () WHERE ";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function updateCart($data)
{
    global $conn;

    // DATA
    $id = $data["id"];
    // $price = $data["price"];
    $quantity = $data["quantity"];

    $query = "UPDATE cart SET quantity = '$quantity' WHERE id_menu = '$id'";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

// DELETE

function delete($id)
{
    global $conn;

    $query = "DELETE FROM  WHERE = '$id'";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function deleteCart($id)
{
    global $conn;

    $query = "DELETE FROM cart WHERE id_menu = '$id'";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}
