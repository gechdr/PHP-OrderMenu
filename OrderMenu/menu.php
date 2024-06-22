<?php
require("function.php");

if (isset($_GET["customer"])) {
    $nama = $_GET["customer"];
}

// $lastNota = 221116008;
// $nextNum = substr($lastNota, 6);
// $nextNum = intval($nextNum) + 1;

// alert($nextNum);
// $nota = 

// alert($_SESSION["grandTotal"]);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<script>
    function load() {
        // alert("x");
        // 1. Inisialisai buat object dulu
        r = new XMLHttpRequest();
        search = document.getElementById("search").value;
        // 2. Callback Function apa yang akan dikerjakan
        // NB: Jangan menggunakan Arrow Function () => {} di sini
        //     karena akan return undefined dan null
        r.onreadystatechange = function() {
            // Kalau dapat data dan status selesai > Lakukan sesuatu
            if ((this.readyState == 4) && (this.status == 200)) {
                console.log("ajax ok!");
                document.getElementById("listMenu").innerHTML = this.responseText;
            }
        }
        // 3. Memanggil dan mengeksekusi AJAX
        r.open('GET', 'menu_fetch.php?search=' + search);
        r.send();

        loadSummary();
    }

    function btnClicked(id) {
        var input = id.split(/(\d+)/);
        var side = input[0];
        var num = input[1];

        var quantity = 0;
        var label;

        if (side == "kiri") {
            // Min
            label = document.getElementById("quantity" + num);
            quantity = parseInt(label.innerText);

            quantity -= 1;

            if (quantity <= 0) {
                quantity = 0;
            }

            label.innerText = quantity;

        } else if (side == "kanan") {
            // Plus
            label = document.getElementById("quantity" + num);
            quantity = parseInt(label.innerText);

            quantity += 1;

            label.innerText = quantity;
        }

        r = new XMLHttpRequest();
        search = label.value;
        // 2. Callback Function apa yang akan dikerjakan
        // NB: Jangan menggunakan Arrow Function () => {} di sini
        //     karena akan return undefined dan null
        r.onreadystatechange = function() {
            // Kalau dapat data dan status selesai > Lakukan sesuatu
            if ((this.readyState == 4) && (this.status == 200)) {
                console.log("ajax ok!");
                document.getElementById("listCart").innerHTML = this.responseText;
            }
        }
        // 3. Memanggil dan mengeksekusi AJAX
        r.open('GET', 'summary_fetch.php?id=' + id + '&quantity=' + quantity);
        r.send();
    }

    function loadSummary() {
        r = new XMLHttpRequest();
        // 2. Callback Function apa yang akan dikerjakan
        // NB: Jangan menggunakan Arrow Function () => {} di sini
        //     karena akan return undefined dan null
        r.onreadystatechange = function() {
            // Kalau dapat data dan status selesai > Lakukan sesuatu
            if ((this.readyState == 4) && (this.status == 200)) {
                console.log("ajax ok!");
                document.getElementById("listCart").innerHTML = this.responseText;
            }
        }
        // 3. Memanggil dan mengeksekusi AJAX
        r.open('GET', 'summary_fetch.php?');
        r.send();
    }

    function checkOut() {
        alert("Terima Kasih!");

        var name = document.getElementById("customer").value;
        r = new XMLHttpRequest();
        // 2. Callback Function apa yang akan dikerjakan
        // NB: Jangan menggunakan Arrow Function () => {} di sini
        //     karena akan return undefined dan null
        r.onreadystatechange = function() {
            // Kalau dapat data dan status selesai > Lakukan sesuatu
            if ((this.readyState == 4) && (this.status == 200)) {
                console.log("ajax ok!");
                // document.getElementById("listCart").innerHTML = this.responseText;
            }
        }
        // 3. Memanggil dan mengeksekusi AJAX
        r.open('GET', 'transaksi.php?customer=' + name);
        r.send();

        window.location.href = 'destroy.php';
    }
</script>

<body onload="load()">
    <input type="hidden" name="customer" id="customer" value="<?= $nama ?>">
    <div class="gradient-custom min-vh-100 d-flex flex-row justify-content-evenly pt-4 pb-5">
        <!-- Bagian A -->
        <div class="row bagianA pt-3 px-4 rounded-5 overflow-scroll glass">
            <div class="mb-md-1 mt-md-4 pb-5">
                <div class="form-outline form-white mb-4">
                    <input type="text" name="search" id="search" class="form-control form-control-lg" placeholder="Search..." onkeypress="load()" onkeypress="load()" />
                </div>
                <div class="row" id="listMenu">

                </div>
            </div>
        </div>

        <!-- Bagian B -->
        <div class="row bagianB p-4 rounded-5 overflow-scroll glass d-flex flex-column align-items-start">
            <h1 class="text-light fs-1">Summary</h1>
            <hr>
            <h3 class="text-light">Customer : <?= $nama ?></h3>
            <div class="row" id="listCart">


            </div>
            <div class="transaksi w-100 mt-2">
                <button type="button" id="btnBuy" class="btn btnBuy btn-dark w-100 fs-4 rounded-4 gradient-custom border-0" onclick="checkOut()">Buy</button>
            </div>
        </div>


    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>

</html>