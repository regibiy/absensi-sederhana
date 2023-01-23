    <table class="table table-striped text-center w-100">
      <tr>
        <th>Tanggal</th>
        <th>Jam Masuk</th>
        <th>Jam Keluar</th>
        <th>Performa</th>
      </tr>

      <?php
      include("../connection.php");

      date_default_timezone_set("Asia/Jakarta"); //GMT +07

      $tgl = date('Y-m-d');
      $time = date('H:i:s');

      $employee_id = $_SESSION['employeeid'];

      $sql = "SELECT * FROM attendances WHERE employeeId = $employee_id";
      $result = $db->query($sql);

      while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['tgl'] . "</td>";
        echo "<td>" . $row['clock_in'] . "</td>";

        if (empty($row['clock_out']) && !empty($row['clock_in']) && $tgl == $row['tgl']) {
          echo "<td>
      <form action='' method='post' onsubmit='return alert(`Terima kasih telah bekerja`)'>
      <button class='btn btn-outline-secondary' type='submit' name='keluar'>Keluar</button>
      </form>
      </td>";
        } else {
          echo "<td>" . $row['clock_out'] . "</td>";
        }
        echo "<td>Gahar</td>";
        echo "</tr>";
      }

      ?>
    </table>
    <form action="action.php" method="post">
      <button class="btn btn-primary fw-semibold m-3" type="submit" name="absen">Absen Sekarang</button>
    </form>

    <?php
    if (isset($_POST['keluar'])) {
      $update = "UPDATE attendances SET clock_out= '$time' WHERE employeeId = $employee_id AND tgl = '$tgl'";

      $clock_out = $db->query($update);
      if ($clock_out === TRUE) {
        session_start();
        session_destroy();
        header('Location:../index.php');
      }
    }
    ?>