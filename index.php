<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Metode Biseksi</title>
<link href="css/bootstrap.css" rel="stylesheet" type="text/css" />
<style>
  body {
    background-color: #f0f8ff; /* Warna background */
    font-family: Arial, sans-serif;
  }
  #container {
    background-color: #e6f7ff; /* Warna biru keputihan */
    border: 2px solid #000; /* Garis tepi hitam */
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    margin: 50px auto;
    padding: 20px;
    max-width: 800px; /* Perluas lebar kontainer */
  }
  h2 {
    color: #333;
  }
  .input-container {
    display: grid;
    grid-template-columns: auto 1fr;
    gap: 10px;
    margin-bottom: 20px;
  }
  .input-group {
    display: contents;
  }
  .input-group label {
    font-weight: bold;
    align-self: center;
  }
  .input-group input {
    max-width: 200px; /* Lebar maksimal input */
  }
  .input-group .btn-primary {
    grid-column: span 2;
    justify-self: start;
  }
  .table-result {
    background-color: #f5f5f5; /* Warna latar belakang tabel hasil */
    width: 100%; /* Pastikan tabel memenuhi lebar kontainer */
    border: 1px solid #ccc; /* Garis tepi tabel hasil */
    margin-top: 20px; /* Jarak atas tabel hasil dari input */
  }
  .table-result th,
  .table-result td {
    padding: 10px; /* Padding sel untuk memperbaiki tampilan */
    text-align: center; /* Ratakan teks di tengah */
  }
  .table-info {
    background-color: #e9ecef;
  }
</style>
</head>

<body>
<div id="container">
  <h2 align="center">Metode Biseksi</h2>
  <div class="container">
    <p>Carilah akar persamaan <strong>f(x) = x<sup>2</sup> - 2x - 4</strong></p>
    <?php
    //----Fungsi menentukan persamaan
    function persamaan($x) {
        return pow($x, 2) - 2 * $x - 4; // Ubah fungsi sesuai dengan persamaan yang baru
    }
    $a = isset($_GET['a']) ? $_GET['a'] * 1 : 0;
    $b = isset($_GET['b']) ? $_GET['b'] * 1 : 0;
    $n = isset($_GET['n']) ? $_GET['n'] * 1 : 0;
    //----End fungsi persamaan
    ?>
    <div class="input-container">
      <div class="input-group">
        <label for="a">Batas Bawah (a)</label>
        <input type="text" class="form-control-sm" id="a" value="<?php echo $a;?>" />
      </div>
      <div class="input-group">
        <label for="b">Batas Atas (b)</label>
        <input type="text" class="form-control-sm" id="b" value="<?php echo $b;?>" />
      </div>
      <div class="input-group">
        <label for="n">Jumlah Iterasi</label>
        <input type="text" class="form-control-sm" id="n" value="<?php echo $n;?>" />
      </div>
      <div class="input-group">
        <button class="btn btn-primary" onclick="proses()">Proses</button>
      </div>
    </div>
    <?php
    $data_r = "";
    if ($n > 0) {
        $fa = persamaan($a);
        $fb = persamaan($b);
        if ($fa * $fb >= 0) {
            echo " f(a)xf(b)>0, proses dihentikan karena tidak ada akar!";
        } else {
    ?>
    <table class="table table-result table-bordered table-hover table-sm">
      <thead>
        <tr class="table-info" align="center">
          <th>Iterasi</th>
          <th>a</th>
          <th>b</th>
          <th>c</th>
          <th>f(c)</th>
          <th>f(b)</th>
          <th>Action</th>
        </tr>
      </thead>
    <?php
        for ($k = 1; $k <= $n; $k++) {
            $x = ($a + $b) / 2;
            $fx = persamaan($x);
            $data_r .= "[" . $x . "," . $fx . "]";
            $ket = "";
            if ($fa * $fx < 0) {
                $ket = "a = c";
            } else {
                $ket = "b = c";
            }
    ?>
        <tr bgcolor="#FFFFFF">
          <td><?php echo $k;?></td>
          <td><?php echo number_format($a, 5, ",", ".");?></td>
          <td><?php echo number_format($b, 5, ",", ".");?></td>
          <td><?php echo number_format($x, 5, ",", ".");?></td>
          <td><?php echo number_format($fx, 5, ",", ".");?></td>
          <td><?php echo number_format($fb, 5, ",", ".");?></td>
          <td><?php echo $ket; ?></td>
        </tr>
    <?php
            if ($fa * $fx < 0) {
                $b = $x;
                $fb = $fx;
            } else {
                $a = $x;
                $fa = $fx;
            }
            if ($k < $n) {
                $data_r .= ",";
            }
        }
    ?>
    </table>
    <?php
        }
    } else {
        echo "Jumlah iterasi harus lebih besar dari 0!";
    }
    ?>
  </div>
</div>

<script>
  function proses() {
    var a = document.getElementById('a').value;
    var b = document.getElementById('b').value;
    var n = document.getElementById('n').value;
    window.location.href = "<?php echo $_SERVER['PHP_SELF']; ?>?a=" + a + "&b=" + b + "&n=" + n;
  }
</script>
</body>
</html>
