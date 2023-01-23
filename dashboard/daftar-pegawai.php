<table class="table table-striped table-hover">
    <tr>
        <th>Nama Pegawai</th>
        <th>Role</th>
        <th>Aksi</th>
    </tr>
    </script>

    <?php
    include("../connection.php");

    $sql = "SELECT * FROM users INNER JOIN roles ON users.role = roles.id ORDER BY fullName";
    $result = $db->query($sql);
    while ($row = $result->fetch_assoc()) {
    ?>
        <tr>
            <td><?= $row['fullName'] ?></td>
            <td><?= $row['role'] ?></td>
            <td>
                <a href="index-admin.php?form=5&id=<?= $row['employeeId'] ?>" class="btn btn-sm btn-outline-primary">Edit</a>
                <a href="hapus-pegawai.php?id=<?= $row['employeeId'] ?>" onclick="return confirm('Yakin untuk hapus data?')" class="btn btn-sm btn-outline-danger">Hapus</a>
            </td>
        </tr>
    <?php
    }
    ?>

</table>