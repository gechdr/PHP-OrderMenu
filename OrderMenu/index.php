<!-- <pre> -->
<?php
require("function.php");

// Reset Database Cart
mysqli_query($conn, "TRUNCATE TABLE cart");

if (!isset($_SESSION["quantity"])) {
    $_SESSION["quantity"] = [];
    $menus = query("SELECT * FROM menu");

    foreach ($menus as $menu) {
        array_push($_SESSION["quantity"], 0);
    }
}

if (!isset($_SESSION["cart"])) {
    $_SESSION["cart"] = [];
}

if (!isset($_SESSION["nota"])) {
    $_SESSION["nota"] = "";
}

if (!isset($_SESSION["grandTotal"])) {
    $_SESSION["grandTotal"] = "";
}

if (isset($_POST["next"])) {
    $safe = true;
    $name = $_POST["name"];

    if ($name == "") {
        $safe = false;
        alert("Nama Tidak Boleh Kosong!");
    } else if (preg_match('~[0-9]+~', $name)) {
        $safe = false;
        alert("Nama Tidak Boleh Mengandung Angka!");
    }

    if ($safe) {
        header("Location: menu.php?customer=$name");
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="vh-100 gradient-custom">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                    <div class="card bg-dark text-white" style="border-radius: 1rem;">
                        <div class="card-body p-5 text-center">
                            <form action="" method="post" class="mb-md-1 mt-md-4 pb-5">
                                <h2 class="fw-bold mb-2 text-uppercase">Customer</h2>
                                <p class="text-white-50 mb-5">Please enter your Name!</p>

                                <div class="form-outline form-white mb-4">
                                    <input type="text" name="name" id="name" class="form-control form-control-lg" placeholder="Name" />
                                </div>

                                <button class="btn btn-outline-light btn-lg mt-4 px-5" type="submit" name="next">Next</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>

</html>