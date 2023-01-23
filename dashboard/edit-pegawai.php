<?php

include("../connection.php");
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT users.id, employeeId, fullName, users.role, password, roles.id, roles.role as nama_role FROM users INNER JOIN roles ON users.role = roles.id WHERE employeeId = '$id'";
    $result = $db->query($sql);
    while ($row = $result->fetch_assoc()) {
        $_SESSION['employeeid'] = $row['employeeId'];
        $_SESSION['fullname2'] = $row['fullName'];
        $_SESSION['role'] = $row['role'];
        $_SESSION['rolename'] = $row['nama_role'];
        $_SESSION['password2'] = $row['password'];
    }
}
