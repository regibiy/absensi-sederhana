<table class="table table-striped table-hover">
    <tr>
        <th>Tanggal Absen</th>
        <th>Nama Pegawai</th>
        <th>Role</th>
        <th>Jam Absen Masuk</th>
        <th>Jam Absen Keluar</th>
    </tr>

    <?php
    include("../connection.php");
    $sql = "SELECT * FROM attendances INNER JOIN users ON attendances.employeeId = users.employeeId INNER JOIN roles ON users.role = roles.id ORDER BY tgl DESC, fullName";
    $result = $db->query($sql);
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['tgl'] . "</td>";
        echo "<td>" . $row['fullName'] . "</td>";
        echo "<td>" . $row['role'] . "</td>";
        echo "<td>" . $row['clock_in'] . "</td>";
        echo "<td>" . $row['clock_out'] . "</td>";
        echo "</tr>";
    }
    ?>

</table>