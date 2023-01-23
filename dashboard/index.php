<?php
session_start();

if (($_SESSION['role']) === "Administrator") {
    header('Location:index-admin.php');
}

if (!isset($_SESSION['status']) || $_SESSION['status'] != "Login") {
    header('Location:../index.php?message=Silahkan masuk terlebih dahulu');
}

if (isset($_POST['logout'])) {
    session_destroy();
    header('Location:../index.php?message=Anda keluar dari sistem');
}

?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="../style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>

<body class="dashboard">
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="shadow cust-col rounded col-md-6">
            <div class="d-flex justify-content-end">
                <form action="" method="post">
                    <button class="btn btn-sm btn-outline-danger m-2 fw-semibold" name="logout" type="submit">Keluar</button>
                </form>
            </div>
            <div class="d-flex flex-column align-items-center p-3">
                <img src="../assets/user.jpg" alt="employee's photo" class="rounded-circle img-thumbnail m-2" width="150" height="150">
                <p class="mb-1 fw-semibold"><?= $_SESSION['fullname'] ?></p>
                <p><?= $_SESSION['role'] ?></p>
                <!-- tabel absen -->
                <?php
                if (isset($_GET['message'])) {
                    $msg =  $_GET['message'];
                    echo "<div class='bg-danger fw-semibold p-1 text-white rounded mb-3'>$msg</div>";
                } else {
                    if (isset($_GET['msgsucceed'])) {
                        $msgsucceed = $_GET['msgsucceed'];
                        echo "<div class='bg-success fw-semibold p-1 text-white rounded mb-3'>$msgsucceed</div>";
                    }
                }
                ?>
                <?php include("absensi.php"); ?>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>

</html>