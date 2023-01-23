<?php
include("../connection.php");
session_start();

date_default_timezone_set("Asia/Jakarta"); //GMT +07
$employeeid = $_SESSION['employeeid'];
$tgl = date('Y-m-d');
$clock_in = date('H:i:s');

if (isset($_POST['absen'])) {

    $cek_absen = "SELECT * FROM attendances WHERE employeeId = $employeeid AND tgl = '$tgl'";
    $check = $db->query($cek_absen);

    if ($check->num_rows > 0) {
        header('Location:index.php?message=Anda telah Absen');
    } else {
        $sql = "INSERT INTO attendances (id, employeeId, tgl, clock_in, clock_out) VALUES (NULL, $employeeid, '$tgl', '$clock_in', NULL)";

        $result = $db->query($sql);
        if ($result === TRUE) {
            header('Location:index.php?msgsucceed=Absen Sukses');
        } else {
            header('Location:index.php?message=Absen Gagal');
        }
    }
}
