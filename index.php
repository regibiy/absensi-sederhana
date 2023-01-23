<?php
session_start();
if (isset($_SESSION['status']) && $_SESSION['status'] == "Login") {
    header('Location: dashboard/index.php');
}

?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>

<body class="login">
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="d-flex flex-column shadow p-4 cust-col rounded col-md-4">
            <h4 class="text-center">Masuk</h4>
            <hr>
            <form action="login.php" method="post">
                <div class="d-flex flex-column gap-2 mt-2">
                    <label for="" class="form-label fw-semibold">Nomor Induk</label>
                    <input type="number" name="employeeid" class="form-control form-control-md" placeholder="cth. 100">
                    <label for="" class="form-label fw-semibold">Kata Sandi</label>
                    <input type="password" id="password" name="password" class="form-control form-control-md" placeholder="******">
                    <label for="show_pass" class="form-label"><input type="checkbox" onclick="showPass()" id="showpass"> Lihat kata sandi</label>
                    <?php
                    if (isset($_GET['message'])) {
                        $msg = $_GET['message'];
                        echo "<div class='bg-danger text-white p-1 fw-semibold rounded'>$msg</div>";
                    }
                    ?>
                    <button type="submit" class="btn btn-primary fw-bold mt-2 text-light" name="login">Masuk</button>
                </div>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <script>
        var password = document.getElementById("password")

        function showPass() {
            switch (password.type) {
                case "password":
                    password.type = "text"
                    break
                case "text":
                    password.type = "password"
                    break
            }
        }
    </script>
</body>

</html>