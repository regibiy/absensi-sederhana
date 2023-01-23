<?php
session_start();

include("../connection.php");

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
    <div class="container-fluid p-0 min-vh-100">
        <div class="d-flex justify-content-end align-items-center bg-white p-3">
            <p class="m-0 me-2 fw-semibold">Halo, <?= $_SESSION['fullname'] ?></p>
            <form action="" method="post">
                <button stype="submit" class="btn btn-outline-danger btn-sm fw-semibold" name="logout">Keluar</button>
            </form>
        </div>
        <div class="container d-flex justify-content-center align-items-center mt-4">
            <div class="m-4 cust-col cust-shadow text-center p-2 rounded">
                <a href="index-admin.php" class="cust-a fw-semibold" onclick="showForm(1)">Tambah Pegawai</a>
            </div>
            <div class="m-4 cust-col cust-shadow text-center p-2 rounded">
                <a class="cust-a fw-semibold" onclick="showForm(2)">Daftar Absensi</a>
            </div>
            <div class="m-4 cust-col cust-shadow text-center p-2 rounded">
                <a class="cust-a fw-semibold" onclick="showForm(3)">Daftar Pegawai</a>
            </div>
        </div>
        <div id="tambah_pegawai" class="container cust-col p-4 mt-4 col-md-4 shadow rounded">
            <h5 class="text-center">Form Tambah Pegawai</h5>
            <hr>
            <form action="action-admin.php" method="post">
                <div class="d-flex flex-column gap-2">
                    <label class="form-label fw-semibold">Nomor Induk Pegawai</label>
                    <input type="number" name="employeeid" class="form-control form-control-md" placeholder="cth.100">
                    <label class="form-label fw-semibold">Nama Lengkap Pegawai</label>
                    <input type="text" name="fullname" class="form-control form-control-md" placeholder="cth. Beni Gara" autocapitalize="on" autocomplete="off">
                    <label for="" class="form-label fw-semibold">Role Pegawai <a onclick="showForm(4)" class="btn btn-sm btn-outline-secondary ms-2">Tambah role</a> <button type="submit" class="btn btn-sm btn-outline-danger" name="hapus_role">Hapus role</button></label>
                    <div id="tambah_role">
                        <div class="d-flex justify-content-center align-items-center gap-2">
                            <div class="col-auto">
                                <label class="col-form-label">Nama Role</label>
                            </div>
                            <div class="col-auto">
                                <input type="text" name="role_baru" class="form-control form-control-sm" autocomplete="off">
                            </div>
                            <div class="col-auto">
                                <button type="submit" class="btn btn-sm btn-primary" name="tambah_role">Tambah</button>
                            </div>
                        </div>
                    </div>
                    <select name="role" id="role" class="form-select">
                        <?php include("role.php") ?>
                    </select>
                    <label class="form-label fw-semibold">Kata Sandi</label>
                    <input type="password" name="password" id="password" class="form-control form-control-md" placeholder="******">
                    <label class="form-label"><input type="checkbox" onclick="showPass()"> Lihat kata sandi</label>
                    <?php
                    if (isset($_GET['message'])) {
                        $msg = $_GET['message'];
                        echo "<div class='bg-danger text-white p-1 fw-semibold rounded'>$msg</div>";
                    } else if (isset($_GET['msgsucceed'])) {
                        $msgsucceed = $_GET['msgsucceed'];
                        echo "<div class='bg-success text-white p-1 fw-semibold rounded'>$msgsucceed</div>";
                    }
                    ?>
                    <div class="d-flex justify-content-center mt-2">
                        <button type="submit" class="btn btn-success me-3 fw-semibold" name="tambah">Simpan</button>
                        <a href="index-admin.php" class="btn btn-outline-danger fw-semibold">Batal</a>
                    </div>
                </div>
            </form>
        </div>
        <div id="daftar_absensi" class="container cust-col p-4 mt-4 col-md-5 shadow rounded">
            <h5 class="text-center">Daftar Absensi Pegawai</h5>
            <hr>
            <?php
            include("daftar-absen.php");
            ?>
        </div>
        <div id="daftar_pegawai" class="container cust-col p-4 mt-4 col-md-4 shadow rounded">
            <h5 class="text-center">Daftar Pegawai</h5>
            <?php
            $msg = 0;
            if (isset($_GET['msgdel'])) {
                $msg = $_GET['msgdel'];
                echo "<div class='bg-danger text-white p-1 fw-semibold rounded mb-3'>$msg</div>";
            } else if (isset($_GET['msgdel2'])) {
                $msg = $_GET['msgdel2'];
                echo "<div class='bg-success text-white p-1 fw-semibold rounded mb-3'>$msg</div>";
            } else if (isset($_GET['msged2'])) {
                $msg = $_GET['msged2'];
                echo "<div class='bg-success text-white p-1 fw-semibold rounded mb-3'>$msg</div>";
            }
            include("daftar-pegawai.php");
            ?>
            <hr>
        </div>
        <div id="edit_pegawai" class="container cust-col p-4 mt-4 col-md-4 shadow rounded">
            <?php
            $form = 0;
            if (isset($_GET['form'])) {
                $form = $_GET['form'];
            }
            ?>
            <h5 class="text-center">Edit Data Pegawai</h5>
            <hr>
            <form action="action-admin.php" method="post">
                <?php
                include("edit-pegawai.php");
                ?>
                <div class="d-flex flex-column gap-2">
                    <label class="form-label fw-semibold">Nomor Induk Pegawai</label>
                    <input type="number" name="employeeid_edit" class="form-control form-control-md" value="<?= $_SESSION['employeeid'] ?>" readonly="true">
                    <label class="form-label fw-semibold">Nama Lengkap Pegawai</label>
                    <input type="text" name="fullname_edit" class="form-control form-control-md" autocomplete="off" value="<?= $_SESSION['fullname2'] ?>">
                    <label class="form-label fw-semibold">Role Pegawai</label>
                    <select name="role_edit" class="form-select">
                        <option value="<?= $_SESSION['role'] ?>" selected hidden><?= $_SESSION['rolename']; ?></option>
                        <?php include("role.php") ?>
                    </select>
                    <label class="form-label fw-semibold">Kata Sandi</label>
                    <input type="password" name="password_edit" id="password_edit" class="form-control form-control-md" placeholder="Ketik password baru dan simpan jika lupa atau tidak tahu password">
                    <label class="form-label"><input type="checkbox" onclick="showPass()"> Lihat kata sandi</label>
                    <?php
                    if (isset($_GET['msged'])) {
                        $msg = $_GET['msged'];
                        echo "<div class='bg-danger text-white p-1 fw-semibold rounded'>$msg</div>";
                    }
                    ?>
                    <div class="d-flex justify-content-center mt-2">
                        <button type="submit" class="btn btn-success me-3 fw-semibold" name="edit">Simpan</button>
                        <a href="index-admin.php" class="btn btn-outline-danger fw-semibold">Batal</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <footer class="mt-5 bg-white p-2 text-center fw-semibold ">
        <p class="m-0">&copy; DeaCourse 2023</p>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <script>
        var tambahPegawai = document.getElementById("tambah_pegawai")
        var daftarAbsensi = document.getElementById("daftar_absensi")
        var daftarPegawai = document.getElementById("daftar_pegawai")
        var tambahRole = document.getElementById("tambah_role")
        var editPegawai = document.getElementById("edit_pegawai")
        var password = document.getElementById("password")
        var password_edit = document.getElementById("password_edit")
        var msg = "<?= $msg ?>"
        var form = "<?= $form ?>"

        daftarAbsensi.style.display = "none"
        daftarPegawai.style.display = "none"
        tambahRole.style.display = "none"
        editPegawai.style.display = "none"

        if (msg != 0) {
            tambahPegawai.style.display = "none"
            daftarPegawai.style.display = "block"
        }

        if (form != 0) {
            tambahPegawai.style.display = "none"
            daftarPegawai.style.display = "none"
            editPegawai.style.display = "block"
        }

        function showForm(nilaiForm) {
            if (nilaiForm === 1) {
                tambahPegawai.style.display = "block"
                daftarAbsensi.style.display = "none"
                daftarPegawai.style.display = "none"
                editPegawai.style.display = "none"
            } else if (nilaiForm === 2) {
                tambahPegawai.style.display = "none"
                daftarAbsensi.style.display = "block"
                daftarPegawai.style.display = "none"
                editPegawai.style.display = "none"
            } else if (nilaiForm === 3) {
                tambahPegawai.style.display = "none"
                daftarAbsensi.style.display = "none"
                daftarPegawai.style.display = "block"
                editPegawai.style.display = "none"
            } else if (nilaiForm === 4) {
                tambahRole.style.display = "block"
            }
        }

        function showPass() {
            switch (password.type || password_edit.type) {
                case "password":
                    password.type = "text"
                    password_edit.type = "text"
                    break
                case "text":
                    password.type = "password"
                    password_edit.type = "password"
                    break
            }
        }
    </script>
</body>

</html>