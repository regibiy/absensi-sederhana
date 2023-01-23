<option value="">Pilih Role Pegawai</option>
<?php
include("../connection.php");
$sql = "SELECT * FROM roles ORDER BY role";
$result = $db->query($sql);
while ($row = $result->fetch_assoc()) {
?>
    <option value="<?= $row['id'] ?>"><?= $row['role'] ?></option>
<?php
}
?>