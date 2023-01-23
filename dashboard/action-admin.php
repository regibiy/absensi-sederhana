<?php
include("../connection.php");
include("../Users.php");

$user = new Users();
if (isset($_POST['tambah'])) {
    if (empty(trim($_POST['employeeid'])) || empty(trim($_POST['fullname'])) || empty(trim($_POST['role'])) || empty(trim($_POST['password']))) {
        header('Location: index-admin.php?message=Data tidak boleh kosong');
    } else if (strlen($_POST['employeeid']) > 8) {
        header('Location:index-admin.php?message=Panjang nomor induk pegawai tidak boleh lebih dari delapan angka');
    } else {
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $user->set_profile_data($_POST['employeeid'], $_POST['fullname'], $_POST['role'], $password);
        $id = $user->get_employee_id();
        $fullname = $user->get_fullname();
        $role = $user->get_role();
        $password = $user->get_password();
        $sql = "SELECT * FROM users WHERE employeeId = '$id'";
        $cek_id = $db->query($sql);
        if ($cek_id->num_rows > 0) {
            header('Location:index-admin.php?message=Nomor induk pegawai sudah digunakan');
        } else {
            $sql = "INSERT INTO users (employeeId, fullName, role, password) VALUES ('$id', '$fullname', '$role', '$password')";
            $result = $db->query($sql);
            if ($result === TRUE) {
                header('Location:index-admin.php?msgsucceed=Data pegawai berhasil disimpan');
            }
        }
    }
}

if (isset($_POST['tambah_role'])) {
    $user->set_role($_POST['role_baru']);
    $role = $user->get_role();
    if (empty(trim($role))) {
        header('Location:index-admin.php?message=Role tidak boleh kosong');
    } else {
        $sql = "INSERT INTO roles (role) VALUES ('$role')";
        $db->query($sql);
        header('Location:index-admin.php?msgsucceed=Role berhasil ditambahkan');
    }
}

if (isset($_POST['edit'])) {
    $user->set_profile_data($_POST['employeeid_edit'], $_POST['fullname_edit'], $_POST['role_edit'], $_POST['password_edit']);
    $employeeid = $user->get_employee_id();
    $fullname = $user->get_fullname();
    $role = $user->get_role();
    $password = $user->get_password();
    if (empty(trim($fullname)) || empty(trim($role))) {
        header('Location:index-admin.php?form=5&msged=Data tidak boleh kosong');
    } else {
        if (empty(trim($password))) {
            session_start();
            $pass_hash = $_SESSION['password2'];
        } else {
            $pass_hash = password_hash($password, PASSWORD_DEFAULT);
        }
        $sql = "UPDATE users SET fullName = '$fullname', role = '$role', password = '$pass_hash' WHERE employeeId = '$employeeid'";
        $db->query($sql);
        header('Location:index-admin.php?msged2=Data berhasil diperbarui');
    }
}

if (isset($_POST['hapus_role'])) {
    $user->set_role($_POST['role']);
    $role = $user->get_role();
    if (empty(trim($role))) {
        header('Location:index-admin.php?message=Pilih role pegawai terlebih dahulu menggunakan opsi yang ada di atas');
    } else {
        $sql = "SELECT * FROM users WHERE role = '$role'";
        $result = $db->query($sql);
        if ($result->num_rows > 0) {
            header('Location:index-admin.php?message=Role digunakan oleh pegawai');
        } else {
            $sql = "DELETE FROM roles WHERE id = '$role'";
            $db->query($sql);
            header('Location:index-admin.php?msgsucceed=Role berhasil dihapus');
        }
    }
}
