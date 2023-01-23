<?php
include("../connection.php");
$id = $_GET['id'];

$sql = "SELECT * FROM users WHERE employeeId = '$id'";
$result = $db->query($sql);
$data = $result->fetch_assoc();
if ($data['role'] == 1) {
    header('Location:index-admin.php?msgdel=Administrator tidak dapat dihapus');
} else {
    $sql = "SELECT * FROM attendances WHERE employeeId = '$id'";
    $result = $db->query($sql);
    if ($result->num_rows > 0) {
        header('Location:index-admin.php?msgdel=Pegawai memiliki riwayat absen');
    } else {
        $sql = "DELETE FROM users WHERE employeeId = '$id'";
        $db->query($sql);
        header('Location:index-admin.php?msgdel2=Pegawai berhasil dihapus');
    }
}
