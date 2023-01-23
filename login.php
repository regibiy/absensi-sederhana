<?php
include("./connection.php");
include("./Users.php");
session_start();

$user = new Users();
if (isset($_POST['login'])) {
    if (empty($_POST['employeeid']) || empty($_POST['password'])) {
        header('location: index.php?message=Nomor induk atau password kosong');
    } else {
        // -> ambil function di class
        $user->set_login_data($_POST['employeeid'], $_POST['password']);
        $id = $user->get_employee_id();
        $password = $user->get_password();
        $sql = "SELECT * FROM users WHERE employeeId = '$id'";
        $result = $db->query($sql);
        if ($result->num_rows > 0) {
            //data yang masuk ke bagian dashboard
            while ($row = $result->fetch_assoc()) {
                $pass_hash = $row['password'];
                if (password_verify($password, $pass_hash) == true) {
                    $_SESSION['status'] = "Login";
                    $_SESSION['employeeid'] = $row['employeeId'];
                    $_SESSION['fullname'] = $row['fullName'];
                    $role = $row['role'];
                    $sql2 = "SELECT role FROM roles WHERE id = '$role'";
                    $result2 = $db->query($sql2);
                    while ($row2 = $result2->fetch_assoc()) {
                        $_SESSION['role'] = $row2['role'];
                    }
                    if ($_SESSION['role'] === "Administrator") header('Location:dashboard/index-admin.php');
                    else header('Location: dashboard/index.php');
                } else {
                    header('location: index.php?message=Nomor induk atau password salah');
                }
            }
        } else {
            header('location: index.php?message=Nomor induk atau password salah');
        }
    }
}
